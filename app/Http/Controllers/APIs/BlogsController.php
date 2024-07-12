<?php

namespace App\Http\Controllers\APIs;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog;

class BlogsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $blogs = Blog::with(["category", "subcategory"])->get();

        return response()->json([
            "success" => true,
            "data" => $blogs
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $image_name = null;
        if($request->hasFile("image")){
            $image = $request->file('image');
            $image_name = time()."_".$image->getClientOriginalName();
            $image->storeAs("public/blog_images", $image_name);
        }
        $data = Blog::create([
            "category_id" => $request->category_id,
            "subcategory_id" => $request->subcategory_id,
            "title" => $request->title,
            "description" => $request->description,
            "content" => $request->content,
            "image" => $image_name,
        ]);

        return response()->json([
            "success" => true,
            "data" => $data
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $blog = Blog::with(["category", "subcategory"])->find($id);

        if($blog){
            return response()->json([
                "success" => true,
                "data" => $blog
            ]);
        } else {
            return response()->json([
                "success" => false,
                "data" => "Blog Not Found"
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $blog = Blog::find($id);

        if ($blog) {
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $image_name = time() . '_' . $image->getClientOriginalName();
                $image->storeAs('public/blog_images', $image_name);
        
                $data = $blog->update([
                    "category_id" => $request->category_id,
                    "subcategory_id" => $request->subcategory_id,
                    "title" => $request->title,
                    "description" => $request->description,
                    "content" => $request->content,
                    "image" => $image_name,
                ]);
            }
            else{
                $data = $blog->update([
                    "category_id" => $request->category_id,
                    "subcategory_id" => $request->subcategory_id,
                    "title" => $request->title,
                    "description" => $request->description,
                    "content" => $request->content,
                ]);
            }
        }

        return response()->json([
            "success" => true,
            "message" => "Blog Updated Successfully"
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $blog = Blog::find($id);

        if($blog){
            $blog->delete();
        }

        return response()->json([
            "success" => true,
            "message" => "Blog Deleted Successfully"
        ]);
    }
}
