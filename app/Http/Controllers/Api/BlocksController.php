<?php

namespace App\Http\Controllers\Api;

use App\Block;
use App\Category;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateBlockRequest;
use Illuminate\Http\Request;

class BlocksController extends Controller
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
        $blocks = Block::select('id', 'category_id', 'title', 'publish', 'created_at')->with('category')->orderBy('created_at', 'DESC')->paginate(50);

        return response()->json([
            'blocks' => $blocks
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateBlockRequest $request)
    {
        $block = Block::create(request()->all());
        $block->publish = request('publish')?: false;
        $block->update();

        return response()->json([
            'block' => $block
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Block  $block
     * @return \Illuminate\Http\Response
     */
    public function show(Block $block)
    {
        $categories = Category::where('publish', 1)->where('parent', 0)->orderBy('created_at', 'DESC')->get();

        return response()->json([
            'block' => $block,
            'categories' => $categories,
            'category' => Category::select('id', 'title')->find($block->category_id),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Block  $block
     * @return \Illuminate\Http\Response
     */
    public function update(CreateBlockRequest $request, Block $block)
    {
        $block->update(request()->all());
        $block->publish = request('publish')?: false;
        $block->update();

        return response()->json([
            'block' => $block
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Block  $block
     * @return \Illuminate\Http\Response
     */
    public function destroy(Block $block)
    {
        $block->delete();

        return response()->json([
            'message' => 'deleted'
        ]);
    }

    /**
     * Block lists
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function lists(){
        $blocks = Block::where('publish', 1)->orderBy('title', 'ASC')->get();

        return response()->json([
            'blocks' => $blocks,
            'lists' => $blocks->pluck('title', 'id'),
        ]);
    }
}
