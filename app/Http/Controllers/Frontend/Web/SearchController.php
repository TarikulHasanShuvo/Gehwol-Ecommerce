<?php

namespace App\Http\Controllers\Frontend\Web;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $q = $request->q;
        $itemType = $request->item_type?$request->item_type:'all';

        $productQuery = Product::with('first_image');
        if($q) {
            $productQuery->where('name', 'like', '%'. $q .'%')
                    ->orWhere('description', 'like', '%'. $q .'%')
                    ->orWhere('brand', 'like', '%'. $q .'%')
                    ->orWhere('ingredient', 'like', '%'. $q .'%');
        }

        if($itemType === 'all' || $itemType === 'product') {
            $products = $productQuery->get();
            $products->map(function ($item) {
                $item->item_type = 'product';
                return $item;
            });
        }


        $blogQuery = Blog::orderBy('id', 'desc');
        if($q) {
            $blogQuery->where('title', 'like', '%'. $q .'%')
                ->orWhere('description', 'like', '%'. $q .'%');
        }


        if($itemType === 'all' || $itemType === 'content') {
            $blogs = $blogQuery->get();

            $blogs->map(function ($item) {
                $item->item_type = 'blog';
                return $item;
            });
        }

        $perPage = 10;
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        if($itemType === 'all') {
            $searchResults = array_merge($products->toArray(), $blogs->toArray());
            $collection = (new Collection($searchResults))->sortByDesc('created_at');
            $currentPageSearchResults = $collection->slice(($currentPage-1) * $perPage, $perPage)->all();

            //Create our paginator and pass it to the view
            $searchResults= new LengthAwarePaginator($currentPageSearchResults, count($collection), $perPage, $currentPage);
            $searchResults->total_product = count($products);
            $searchResults->total_blog = count($blogs);
        } else {
            if($itemType === 'product') {
                $currentPageSearchResults = $products->slice(($currentPage-1) * $perPage, $perPage)->all();
                $searchResults= new LengthAwarePaginator($currentPageSearchResults, count($products), $perPage, $currentPage);
                $searchResults->total_product = count($products);
                $searchResults->total_blog = $blogQuery->count();
            } else {
                $currentPageSearchResults = $blogs->slice(($currentPage-1) * $perPage, $perPage)->all();
                $searchResults= new LengthAwarePaginator($currentPageSearchResults, count($blogs), $perPage, $currentPage);
                $searchResults->total_product = $productQuery->count();
                $searchResults->total_blog = count($blogs);
            }
        }

        $searchResults->withPath('/search?q='.$q.'&item_type='.$itemType);

        return view('site.search', compact('q', 'searchResults', 'itemType'));
    }
}
