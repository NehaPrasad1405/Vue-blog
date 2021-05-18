<?php

namespace App\Http\Controllers;

use App\Tag;
use App\Traits\Search;
use Illuminate\Http\Request;
class TagController extends Controller
{
    use Search;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function get(Request $request)
    {
        $name=$request->name ?:'';
        $tags=Tag::search('name',$name)
        ->orderBy('id','desc')
        ->paginate(10);
        return response()->json([
            'tags' => $tags
        ], 200);
    }
    public function index()
    {
        $tags=Tag::all();
        return view('tags.index')->withTags($tags);
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
                    'name'=> 'required|unique:tags,name,'.$request->id,
                ]
                );
                $message="Tag Updated";
        }
        else
        {
            $request->validate(
                [
                    'name'=> 'required|unique:tags,name,',
                ]
                );
                $message="Tag Added";
        }
        $tag=Tag::UpdateOrCreate(
            ['id'=>$request->id],
            ['name'=> $request->name
            ]
        );
        
        return response()->json([
            'tag' => $tag,
            'message'=>$message
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function show(Tag $tag)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function edit(Tag $tag)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tag $tag)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tag $tag)
    {
        //
    }
}
