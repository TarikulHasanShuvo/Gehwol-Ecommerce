<?php

namespace App\Http\Controllers;
use App\Models\Blog;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductReview;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class SiteController extends Controller
{

    public function home(Request $request) {
        $allProducts = Product::orderBy('id', 'desc')->with('images')->take(10)->get();
        $newProducts = Product::orderBy('id', 'desc')->where('new', 1)->with('images')->take(10)->get();
        $professionalProducts = Product::orderBy('id', 'desc')->where('professional', 1)->with('images')->take(10)->get();
        $recentlyViewdProducts = [];
        if($request->hasCookie('recently_viewed_products')) {
            $cookie = $request->cookie('recently_viewed_products');
            $cookieData = json_decode($cookie, true);
            $recentlyViewdProducts = Product::orderBy('id', 'desc')->whereIn('id', $cookieData)->with('images')->take(10)->get();
        }

        $blogs = Blog::orderBy('id', 'desc')->take(10)->get();
        return view('site.home', compact('allProducts', 'newProducts', 'professionalProducts', 'recentlyViewdProducts', 'blogs'));
    }

    public function viewCategoryProducts(Request $request)
    {
        $category = null;
        $categories = ProductCategory::all();
        if ($request->has('filter_by')) {
            if($request->filter_by == 'new') {
                $query = Product::where('new', 1);
            } else if($request->filter_by == 'professional') {
                $query = Product::where('professional', 1);
            } else if($request->filter_by == 'all') {
                $query = Product::orderBy('created_at', 'desc');
            } else {
                $category = ProductCategory::find($request->filter_by);
                $query = Product::where('product_category_id', $request->filter_by);
            }
            $filterBy = $request->filter_by;
        } else {
            $query = Product::orderBy('created_at', 'desc');
            $filterBy = 'all';
        }
        if($filterBy != 'all') {
            $query->orderBy('created_at', 'desc');
        }
        $products = $query->paginate(10);
        return view('site.category')->with('products', $products)->with('categories', $categories)->with('category', $category)->with('filterBy', $filterBy);
    }

    public function viewCategoryNewProducts()
    {
        $products = Product::where('new', 1)->with('images')->with('images')->paginate(10);
        return view('site.category')->with('products', $products)->with('new', true);
    }

    public function viewCategoryProfessionalProducts()
    {
        $products = Product::where('professional', 1)->with('images')->paginate(10);
        return view('site.category')->with('products', $products)->with('professional', true);
    }

    public function viewProductDetails(Request $request, $id)
    {
        $product = Product::where('id', $id)
            ->with('product_category')
            ->with('productBlCategory:id,name')
            ->with('productRange:id,name')
            ->with('productType:id,name')
            ->with('images')
            ->first();
//        dd($product->toArray());
        $recentlyViewdProducts = [];
        if($request->hasCookie('recently_viewed_products')) {
            $cookie = $request->cookie('recently_viewed_products');
            $cookieData = json_decode($cookie, true);
            $recentlyViewdProducts = Product::whereIn('id', $cookieData)->with('images')->take(10)->get();
            $data = array($product->id);
            $mergedArray = array_merge($cookieData, $data);
            $multipleProductId = array_unique($mergedArray);
            Cookie::queue(Cookie::make('recently_viewed_products', json_encode($multipleProductId), 10080));
        } else {
            $productItem = json_encode(array($product->id));
            Cookie::queue(Cookie::make('recently_viewed_products', $productItem, 10080));
        }

        $relatedProducts = Product::where('product_category_id', $product->product_category_id)->whereNotIn('id', [$product->id])->with('images')->take(10)->get()->toArray();
        $productReviews = ProductReview::where('product_id', $id)->get()->toArray();
        return view('site.product')->with('product', $product)->with('recentlyViewdProducts', $recentlyViewdProducts)->with('relatedProducts', $relatedProducts)->with('productReviews', $productReviews);
    }

    public function storeProductReviews(Request $request, $id) {
        $review = ProductReview::where('product_id', $id)->where('reviewer_email', $request->email)->first();
        if(!$review) {
            $productReview = new ProductReview();
            $productReview->reviewer_name = $request->name;
            $productReview->reviewer_email = $request->email;
            $productReview->message = $request->message;
            $productReview->rating = $request->rating;
            $productReview->product_id = $id;
            $productReview->save();

            return response()->json([
                'message' => 'Successfully Product Review Placed.',
                'success'=> true
            ], 200);

        } else {
            return response()->json([
                'message' => 'Already you reviewed this product.',
                'success'=> false
            ], 500);
        }
    }
}
