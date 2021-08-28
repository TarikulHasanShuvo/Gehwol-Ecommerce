<?php

namespace App\Http\Controllers\Frontend\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Orders\OrderRequestValidation;
use App\Models\Cart;
use App\Models\GiftCertificate;
use App\Models\GiftCertificateTransaction;
use App\Models\Order;
use App\Models\OrderGiftCertificate;
use App\Models\OrderProduct;
use App\Models\Payment;
use App\Models\Product;
use App\Models\UserAddress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;

class OrdersController extends Controller
{
    private $shippingCharges = ['canada_post' => 11.95, 'courier' => 19.95];

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $orders = Order::active()->where('user_id', auth()->id())->orderBy('id', 'desc')->get();
        return view('dashboard.orders')->with('orders', $orders);
    }

    /**
     * @param $uid
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show($uid)
    {
        $order = Order::with('products')->where('order_uid', $uid)->where('user_id', auth()->id())->first();
        return view('dashboard.order')->with('order', $order);
    }

    /**
     * @param OrderRequestValidation $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function store(OrderRequestValidation $request)
    {
        DB::beginTransaction();

        try {
            $carts = Cart::where('user_id', auth()->id())->get();
            $priceArray = $this->calculatePricing($carts, $request);
            $order = $this->createOrder($request, $priceArray);
            $this->storeOrderItems($order, $carts);
            DB::commit();

            return redirect()->to('/cart/payment?u='.$order->order_uid);
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }

    /**
     * @param OrderRequestValidation $request
     * @param array $priceArray
     * @return Order
     */
    public function createOrder(OrderRequestValidation $request, array $priceArray): Order
    {
        $order = new Order();
        $order->user_id = auth()->id();
        $order->order_uid = $this->orderUidGenerate();
        $order->order_date = date('Y-m-d H:i:s');
        $order->status = 'PENDING';
        $order->shipping_method = $request->shipping_method;
        $order->ship_first_name = $request->ship_first_name;
        $order->ship_last_name = $request->ship_last_name;
        $order->ship_phone = $request->ship_phone;
        $order->ship_business_name = $request->ship_business_name;
        $order->ship_address_line_1 = $request->ship_address_line_1;
        $order->ship_address_line_2 = $request->ship_address_line_2;
        $order->ship_postal_code = $request->ship_postal_code;
        $order->ship_city = $request->ship_city;
        $order->ship_state = $request->ship_state;
        $order->ship_country = $request->ship_country;
        $order->comments = $request->comments;
        $order->shipping_charge = $request->shipping_method?$this->shippingCharges[$request->shipping_method]:0;
        $order->gst = $priceArray['gst'];
        $order->total = $priceArray['total'];
        $order->save();

        if(isset($request->address)&&$request->address == 'new') {
            $address = new UserAddress();
            $address->first_name = $request->ship_first_name;
            $address->last_name = $request->ship_last_name;
            $address->business_name = $request->ship_business_name;
            $address->phone = $request->ship_phone;
            $address->address_line_1 = $request->ship_address_line_1;
            $address->address_line_2 = $request->ship_address_line_2;
            $address->postal_code = $request->ship_postal_code;
            $address->city = $request->ship_city;
            $address->state = $request->ship_state;
            $address->country = $request->ship_country;
            $address->is_default = 0;
            $address->user_id = Auth::id();
            $address->save();
        }

        return $order;
    }

    /**
     * @param Order $order
     * @param $carts
     * @return Order
     */
    public function storeOrderItems(Order $order, $carts): Order
    {
        foreach ($carts as $cart) {
            if($cart->cartable_type === Product::class) {
                $this->storeOrderProduct($order, $cart);
            } else {
                $this->storeOrderGiftCertificate($order, $cart);
            }
        }
        return $order;
    }

    /**
     * @param Order $order
     * @param Cart $cart
     * @return OrderProduct
     */
    public function storeOrderProduct(Order $order, Cart $cart)
    {
        $newItem = new OrderProduct();
        $newItem->order_id = $order->id;
        $newItem->product_id = $cart->cartable_id;
        $newItem->quantity = $cart->quantity;
        $newItem->unit_price = $cart->price;
        $newItem->save();
        return $newItem;
    }

    /**
     * @param Order $order
     * @param Cart $cart
     * @return OrderGiftCertificate
     */
    public function storeOrderGiftCertificate(Order $order, Cart $cart)
    {
        $newItem = new OrderGiftCertificate();
        $newItem->order_id = $order->id;
        $newItem->gift_certificate_id = $cart->cartable_id;
        $newItem->quantity = $cart->quantity;
        $newItem->unit_price = $cart->price;
        $newItem->save();
        return $newItem;
    }

    /**
     * @param $carts
     * @param $request
     * @return array
     */
    public function calculatePricing($carts, $request): array
    {
        $total = 0;
        foreach ($carts as $cart) {
            $total += $cart->price * $cart->quantity;
        }
        $total += $request->shipping_method?$this->shippingCharges[$request->shipping_method]:0;
        $gst = $total*0.05;
        $total += $gst;
        return ['total' => round($total,2), 'gst' => $gst];
    }

    /**
     * @return string
     */
    public function orderUidGenerate(): string
    {
        $latest = Order::latest()->first();
        if (! $latest) {
            return 'ORD-'.date('Y-m').'-0001';
        }

        $arr = explode('-', $latest->order_uid);
        return 'ORD-'.date('Y-m').'-'. sprintf('%04d', $arr[3]+1);
    }

    public function payment(Request $request, $orderId)
    {
        $user          = $request->user();
        $paymentMethod = $request->input('payment_method');
        $order = Order::find($orderId);

        DB::beginTransaction();

        try {
            if($order->is_payment_completed) {
                return back()->with('error', 'Your order amount already paid!');
            }

            $discount = 0;
            if($request->gift_code) {
                $discount = $this->discountCalculate($order, $request->gift_code);
            }

            $payableAmount = $order->total - $discount;

            if($payableAmount > 0){
                $user->createOrGetStripeCustomer();
                $user->updateDefaultPaymentMethod($paymentMethod);
            }

            $order->is_payment_completed = true;
            $order->discount = $discount;
            $order->status = 'PROCESSING';
            $order->total = $payableAmount;
            $order->save();

            $giftIds = $order->gift_certificates->pluck('gift_certificate_id');
            GiftCertificate::whereIn('id', $giftIds)->update(['is_active'=>1,'is_payment_completed'=>1,'purchased_at'=>date('Y-m-d H:i:s')]);

            if($payableAmount > 0) {
                $charge = $user->charge($payableAmount * 100, $paymentMethod);
                $this->createPayment($order, $charge);
            }
            Cart::where('user_id', auth()->id())->delete();
            DB::commit();

            if(count($giftIds)) {
                dispatch(new \App\Jobs\SendGiftEmailJob($giftIds))->delay(now()->addSeconds(2));
            }

            if($request->hasCookie('_gft_au_'.auth()->id())) {
                Cookie::queue(Cookie::forget('_gft_au_'.auth()->id()));
            }

            return redirect()->to('/cart/payment?u='.$order->order_uid.'&payment=success');
        } catch (\Exception $exception) {
            DB::rollback();
            return back()->with('error', $exception->getMessage());
        }
    }

    public function discountCalculate(Order $order, $giftCode)
    {
        $discount = 0;
        $gift = GiftCertificate::paid()->where('gift_card_code', $giftCode)->first();
        if($gift) {
            if($gift->available_balance > $order->total) {
                $discount = $order->total;
            } else {
                $discount = $gift->available_balance;
            }

            $gift->available_balance -= $discount;
            $gift->save();

            $cerTrans = new GiftCertificateTransaction();
            $cerTrans->order_id = $order->id;
            $cerTrans->gift_certificate_id = $gift->id;
            $cerTrans->amount = $discount;
            $cerTrans->balance = $gift->available_balance;
            $cerTrans->save();
        }
        return $discount;
    }

    /**
     * @param Order $order
     * @param $charge
     * @return Payment
     */
    public function createPayment(Order $order, $charge):Payment
    {
        $payment = new Payment();
        $payment->order_id = $order->id;
        $payment->user_id = auth()->id();
        $payment->stripe_payment_id = $charge->id;
        $payment->stripe_payment_method = $charge->payment_method;
        $payment->stripe_customer_id = $charge->customer;
        $payment->status = $charge->status;
        $payment->amount = $order->total;
        $payment->save();
        return $payment;
    }


    public function updateOrder(Request $request,$orderId)
    {
        Order::find($orderId)->update($request->all());
        return "Update Successfully";
    }
    /**
     * @param $orderId
     * @return string
     */
    public function deleteOrder($orderId): string
    {
        Order::find($orderId)->delete();
        OrderGiftCertificate::where('order_id',$orderId)->delete();
        OrderProduct::where('order_id',$orderId)->delete();
        return "Delete Successfully";
    }
}
