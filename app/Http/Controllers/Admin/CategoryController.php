<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductCategoryStoreRequest;
use App\Models\ProductCategory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    public function __construct()
    {

    }

    public function index(Request $request)
    {
        return view('backend.admin.category.index');
    }

    public function getCategories(Request $request)
    {
        !empty($request->all()) ? $pageNumber = 7 : $pageNumber = null;
        $productCategories = ProductCategory::latest()->paginate($pageNumber);
        return response()->json($productCategories);
    }

    public function store(ProductCategoryStoreRequest $request)
    {
        if($request->hasFile('image')){
            $fileName =  uniqid(). time() .  $request->image->getClientOriginalName();
            $request->image->storeAs('images',$fileName,'public');
        }
        $productCategory = new ProductCategory();
        $productCategory->name = $request->name;
        $productCategory->image = $fileName;
        $productCategory->save();
        return response()->json($productCategory);
    }

    public function show($id)
    {
        $productCategory = ProductCategory::find($id);
        return response()->json($productCategory);
    }

    public function update(ProductCategoryStoreRequest $request, $id)
    {
        $productCategory = ProductCategory::find($id);
        $productCategory->name = $request->name;
        if($request->hasFile('image')) {
            $path = 'public/images/'.$productCategory->image;
            if(Storage::exists($path)){
                Storage::delete($path);
                $fileName =  uniqid(). time() .  $request->image->getClientOriginalName();
                $request->image->storeAs('images',$fileName,'public');
                $productCategory->image = $fileName;
            }
        }
        $productCategory->save();
        return response()->json($productCategory);
    }

    public function delete($id)
    {
        $productCategory = ProductCategory::find($id);
        if(isset($productCategory->image)) {
            Storage::delete('public/images/'.$productCategory->image);
        }
        $productCategory->delete();
        return response()->json('Successfully Category Deleted.', 200);
    }
}
