<?php

namespace App\Http\Controllers\Admin;

use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use App\Http\Controllers\Controller;

class BlogController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        return view('backend.admin.blog.index');
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function getAllBlog()
    {
        $blogs = Blog::latest()->paginate(5);
        return view('site.blog')->with('blogs',$blogs);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function getBlogDetails($id)
    {
        $blog = Blog::where('id',$id)->with('user:id,first_name,last_name')->first();
        $latestBlogs = Blog::latest()->paginate(10);
        return view('site.blog_post',['blog'=>$blog,'latestBlogs'=>$latestBlogs]);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function getBlogs()
    {
        $blogs = Blog::latest()->paginate(5);
        return response()->json($blogs);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        if ($request->hasFile('image')) {
            $fileName = uniqid() . time() . $request->image->getClientOriginalName();
            $request->image->storeAs('images', $fileName, 'public');
        }

        $blog              = new Blog();
        $blog->user_id     = auth()->id();
        $blog->title       = $request->title;
        $blog->description = $request->description;
        $blog->image       = $fileName;
        $blog->save();
        return response()->json($blog);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request)
    {
        $blog = Blog::find($request->id);
        if ($request->hasFile('image')) {
            $path = 'public/images/' . $blog->image;
            if (Storage::exists($path)) {
                Storage::delete($path);
                $fileName = uniqid() . time() . $request->image->getClientOriginalName();
                $request->image->storeAs('images', $fileName, 'public');
                $blog->image = $fileName;
            }
        }
        $blog->user_id     = auth()->id();
        $blog->title       = $request->title;
        $blog->description = $request->description;
        $blog->save();
        return response()->json($blog);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete($id)
    {
        $blog = Blog::find($id);
        if (isset($blog->image)) {
            Storage::delete('public/images/' . $blog->image);
        }
        $blog->delete();
        return response()->json('Successfully Blog Deleted.', 200);
    }
}
