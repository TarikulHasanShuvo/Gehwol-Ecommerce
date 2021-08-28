<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductStoreRequest;
use App\Models\ProductBlCategory;
use App\Models\ProductCategory;
use App\Models\ProductImage;
use App\Models\ProductRange;
use App\Models\ProductType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use App\Models\Product;
use phpDocumentor\Reflection\Types\This;

class ProductController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(Request $request)
    {
        return view('backend.admin.product.index');
    }

    /**
     * @return array
     */
    public function getProductRelatedData()
    {
        $data['categories'] = ProductCategory::all(['id','name']);
        $data['blCategories'] = ProductBlCategory::all(['id','name']);
        $data['ranges'] = ProductRange::all(['id','name']);
        $data['types'] = ProductType::all(['id','name']);
        return $data;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create(Request $request)
    {
        return view('backend.admin.product.create');
    }

    /***
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        return view('backend.admin.product.edit')->with('productId', $id);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getProducts(Request $request)
    {
        $products = Product::with('images')->latest()->paginate(10);
        return response()->json($products);
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Request $request, $id)
    {
        $product = Product::where('id',$id)->with('images','product_category:id,name')->first();
        return response()->json($product);
    }

    /**
     * @param ProductStoreRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(ProductStoreRequest $request)
    {
        $product = new Product();
        $product->fill($request->all());
        $product->save();
        $product_id = $product->id;
        $product->sku = 'SKU'.'-'.$request->product_category_id.'-'.$product_id;
        $product->save();

        if (is_array($request->images)) {
            foreach ($request->images as $key => $image) {
                $fileName = uniqid() . time() . $image->getClientOriginalName();
                $image->storeAs('images', $fileName, 'public');

                ProductImage::create([
                    'product_id' => $product_id,
                    'image'=>$fileName
                ]);
            }
        }
        return response()->json($product);
    }

    /**
     * @param ProductStoreRequest $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(ProductStoreRequest $request, $id)
    {
        $product = Product::find($id);
        $product->fill($request->all());
        $product->save();
        $product_id = $product->id;
        // for delete old images
        if (array_key_exists('images', $request->all())) {
            $old_images =  ProductImage::where('product_id',$id)->get();
            foreach ($old_images as $key => $images){
                $path = 'public/images/'.$images->image;
                if(Storage::exists($path)){
                    Storage::delete($path);
                }
                $old_images[$key]->delete();
            }
            // Insert New Images
            foreach ($request->images as $key => $image) {
                $fileName = uniqid() . time() . $image->getClientOriginalName();
                $image->storeAs('images', $fileName, 'public');
                ProductImage::create([
                    'product_id' => $product_id,
                    'image'=>$fileName
                ]);
            }
        }
        return response()->json($product);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete($id)
    {
        $product = Product::find($id);
        $old_images =  ProductImage::where('product_id',$id)->get();
        if (!empty($old_images)){
            foreach ($old_images as $key => $images){
                $path = 'public/images/'.$images->image;
                if(Storage::exists($path)){
                    Storage::delete($path);
                }
                $old_images[$key]->delete();
            }
        }
        $product->delete();
        return response()->json('Successfully Category Deleted.', 200);
    }
}
