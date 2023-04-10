<?php

namespace App\Http\Controllers;

use App\Models\Story;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $story = Story::all();
        return response()->json($story);
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
        $request->validate([
            'author' => 'required|min:4|max:40',
            'title' => 'required|unique:stories|min:4|max:100',
            'content' => 'required|max:3000',
            'url' => 'required|image'
        ]);

        $story = new Story;
        $story->author = $request->author;
        $story->title = $request->title;
        $story->content = $request->content;
        $image = Storage::put('public/images',$request->file('url'));
        $story->url = env('APP_URL').Storage::url($image);
        $story->save();
        $data= [
            'message'=> 'Story created successfully',
            'story'=> $story
        ];
        return response()->json($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Story  $story
     * @return \Illuminate\Http\Response
     */
    public function show(Story $story)
    {
        //
        // if(!$story){
        //     return response()->json([
        //         'message' => 'Story not found'
        //     ]);
        // }
        return response()->json($story);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Story  $story
     * @return \Illuminate\Http\Response
     */
    public function edit(Story $story)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Story  $story
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Story $story)
    {
        $request->validate([
            'author' => 'required|min:4|max:40',
            'title' => 'required|min:4|max:100|unique:stories,title,'.$story->id,
            'content' => 'required|max:3000',
            'url' => 'required|image'
        ]);

        $story->author = $request->author;
        $story->title = $request->title;
        $story->content = $request->content;
        //checking for a new image
        $test=Story::find($story->id);
        $test->url;
        if ($test->url == $request->url) {
            $story->save();
            $data= [
                'message'=> 'Story updated successfully',
                'story'=> $story
            ];
            return response()->json($data);
        }else{
            //Delete in storage before to update
            $path= env('APP_URL');
            $url = str_replace($path."/storage", "public", $story->url);
            Storage::delete($url);
            //end
            $image = Storage::put('public/images',$request->file('url'));
            $story->url = env('APP_URL').Storage::url($image);
            $story->save();
            $data= [
                'message'=> 'Story updated successfully',
                'story'=> $story
            ];
            return response()->json($data);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Story  $story
     * @return \Illuminate\Http\Response
     */
    public function destroy(Story $story)
    {
        //
        $path= env('APP_URL');
        $url = str_replace($path."/storage", "public", $story->url);
        Storage::delete($url);
        $story->delete();
        $data=[
            'message' => 'Story deleted successfully',
            'story' => $story
        ];
        return response()->json($data);
    }
}
