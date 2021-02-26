<?php

namespace App\Http\Controllers;

use App\Traits\Search;
use App\category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    use Search;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('categories.index');
    }
    public function get(Request $request)
    {
        $name=$request->name ?:'';
        $description=$request->description ?:'';
        $categories=Category::search('name',$name)
                            ->search('description',$description)
                            ->orderBy('id','desc')
                            ->paginate(10);
        return response()->json([
            'categories' => $categories
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->id)
        {
            $request->validate(
                [
                    'name'=> 'required|unique:categories,name,'.$request->id,
                    'description'=> 'required'
                ]
                );
                $message="Category Updated";
        }
        else
        {
            $request->validate(
                [
                    'name'=> 'required|unique:categories,name,',
                    'description'=> 'required'
                ]
                );
                $message="Category Added";
        }
        $category=Category::UpdateOrCreate(
            ['id'=>$request->id],
            ['name'=> $request->name,
             'description'=>$request->description
            ]
        );
        
        return response()->json([
            'category' => $category,
            'message'=>$message
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, category $category)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\category  $category
     * @return \Illuminate\Http\Response
     */
    public function delete($category)
    {
        $category_destroy=Category::find($category);
        // dd($category_destroy);
        $category_destroy->delete();
        $message="Category Deleted";

        return response()->json([
            'message'=>$message
        ], 200);
    }
    public function destroy(category $category)
    {
        //
    }
}
