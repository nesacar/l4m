<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateTagRequest;
use App\Tag;
use Illuminate\Http\Request;

class TagsController extends Controller
{
    public function __construct(){
        $this->middleware('auth:api');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tags = Tag::withCount(['product', 'post'])->orderBy('title', 'ASC')->paginate(50);

        return response()->json([
            'tags' => $tags,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateTagRequest $request)
    {
        $tag = new Tag();
        $tag->title = request('title');
        $tag->slug = request('slug')?: request('title');
        $tag->publish = request('publish')?: false;
        $tag->save();

        return response()->json([
            'tag' => $tag
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tag = Tag::find($id);

        return response()->json([
            'tag' => $tag
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CreateTagRequest $request, $id)
    {
        $tag = Tag::find($id);
        $tag->title = request('title');
        $tag->slug = request('slug')?: request('title');
        $tag->publish = request('publish')?: false;
        $tag->update();

        return response()->json([
            'tag' => $tag
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Tag::destroy($id);

        return response()->json([
            'message' => 'deleted'
        ]);
    }

    public function lists(){
        $tags = Tag::select('id', 'title')->where('publish', 1)->orderBy('title', 'ASC')->get();

        return response()->json([
            'tags' => $tags
        ]);
    }

    /**
    * Tags search
    *
    * @return \Illuminate\Http\JsonResponse
    */
    public function search(){
        $text = request('text');
        $tags = Tag::withCount(['product', 'post'])->where(function ($query) use ($text){
                if($text != ''){
                    $query->where('title', 'like', '%'.$text.'%')->orWhere('slug', 'like', '%'.$text.'%');
                }
            })
            ->orderBy('created_at', 'DESC')->groupBy('id')->paginate(50);

        return response()->json([
            'tags' => $tags,
        ]);
    }
}
