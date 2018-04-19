<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateSetRequest;
use App\Set;
use Illuminate\Http\Request;

class SetsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sets = Set::select('id', 'title', 'short', 'publish', 'created_at')->orderBy('created_at', 'DESC')->paginate(50);

        return response()->json([
            'sets' => $sets
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateSetRequest $request)
    {
        $set = Set::create(request()->all());
        $set->slug = request('slug')?: request('title');
        $set->publish = request('publish')?: false;
        $set->update();

        return response()->json([
            'set' => $set
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Set  $set
     * @return \Illuminate\Http\Response
     */
    public function show(Set $set)
    {
        return response()->json([
            'set' => $set
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Set  $set
     * @return \Illuminate\Http\Response
     */
    public function update(CreateSetRequest $request, Set $set)
    {
        $set->update(request()->all());
        $set->slug = request('slug')?: request('title');
        $set->publish = request('publish')?: false;
        $set->update();

        return response()->json([
            'set' => $set
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Set  $set
     * @return \Illuminate\Http\Response
     */
    public function destroy(Set $set)
    {
        if($set->property){
            foreach ($set->property as $property){
                $property->set_id = 0;
                $property->update();
            }
        }
        $set->delete();

        return response()->json([
            'message' => 'deleted'
        ]);
    }

    /**
     * Property lists
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function lists(){
        $sets = Set::where('publish', 1)->orderBy('title', 'ASC')->pluck('title', 'id')->prepend('Bez seta', 0);

        return response()->json([
            'sets' => $sets
        ]);
    }
}
