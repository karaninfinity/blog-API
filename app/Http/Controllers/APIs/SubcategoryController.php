<?php

namespace App\Http\Controllers\APIs;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Subcategory;

class SubcategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Subcategory::all();

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
        if($request->hasFile("subcategory_image")){
            $image = $request->file('subcategory_image');
            $image_name = time()."_".$image->getClientOriginalName();
            $image->storeAs("public/subcategory_image", $image_name);
        }
        $data = Subcategory::create([
            "subcategory" => $request->subcategory,
            "subcategory_image" => $image_name,
            "category_id" => $request->category_id,
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
        $data = Subcategory::with(["category"])->where("id", $id)->first();

        return response()->json([
            "success" => true,
            "data" => $data
        ]);
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
        $subcategory = Subcategory::find($id);

        if ($request->hasFile('subcategory_image')) {
            $image = $request->file('subcategory_image');
            $image_name = time() . '_' . $image->getClientOriginalName();
            $image->storeAs('public/subcategory_image', $image_name);
    
            $data = $subcategory->update([
                'subcategory' => $request->subcategory,
                'category_id' => $request->category_id,
                'subcategory_image' => $image_name,
                'status' => $request->status,
            ]);
        }
        else{
            $data = $subcategory->update([
                'subcategory' => $request->subcategory,
                'category_id' => $request->category_id,
                'status' => $request->status,
            ]);
        }

        return response()->json([
            "success" => true,
            "message" => "Subcategory Updated"
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Subcategory::find($id);

        if($category){
            $category->delete();
        }

        return response()->json([
            'success' => true,
            'message' => 'Subategory deleted successfully',
        ]);
    }

    public function subcatogories(string $id)
    {
        $subcategory = Subcategory::where("category_id", $id)->get();

        if(!$subcategory->isEmpty()){
            return response()->json([
                "success" => true,
                "data" => $subcategory,
                "message" => "Subcategories Retrived"
            ]);
        } else {
            return response()->json([
                "success" => false,
                "data" => [],
                "message" => "Subcategories Not Found"
            ]);
        }
    }
}
