<?php

namespace App\Http\Controllers\APIs;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Category::all();
        return response()->json([
            "success" => true,
            "data" => $data
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
        if($request->hasFile("category_image")){
            $image = $request->file('category_image');
            $image_name = time()."_".$image->getClientOriginalName();
            $image->storeAs("public/category_images", $image_name);
        }
        $data = Category::create([
            "category" => $request->category,
            "category_image" => $image_name,
            "status" => $request->status,
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
        //
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
        $category = Category::find($id);

        if ($request->hasFile('category_image')) {
            $image = $request->file('category_image');
            $image_name = time() . '_' . $image->getClientOriginalName();
            $image->storeAs('public/category_images', $image_name);
    
            $data = $category->update([
                'category' => $request->category,
                'category_image' => $image_name,
                'status' => $request->status,
            ]);
        }
        else{
            $data = $category->update([
                'category' => $request->category,
                'status' => $request->status,
            ]);
        }

        return response()->json([
            "success" => $data
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::find($id);

        if($category){
            $category->delete();
        }

        return response()->json([
            'success' => true,
            'message' => 'Category deleted successfully',
        ]);
    }
}
