<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePropertyRequest;
use App\Property;
use Illuminate\Http\Request;

class PropertiesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $properties = Property::select('id', 'title', 'order', 'publish', 'created_at')->orderBy('order', 'ASC')->paginate(50);

        return response()->json([
            'properties' => $properties
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreatePropertyRequest $request)
    {
        $property = Property::create(request()->all());
        $property->slug = request('slug')?: request('title');
        $property->publish = request('publish')?: false;
        $property->update();

        if(request('sets')){ $property->set()->sync(request('sets')); }

        return response()->json([
            'property' => $property
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Property  $property
     * @return \Illuminate\Http\Response
     */
    public function show(Property $property)
    {
        $sets = $property->set()->pluck('sets.id');

        return response()->json([
            'property' => $property,
            'sets' => $sets,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Property  $property
     * @return \Illuminate\Http\Response
     */
    public function update(CreatePropertyRequest $request, Property $property)
    {
        $property->update(request()->all());
        $property->slug = request('slug')?: request('title');
        $property->publish = request('publish')?: false;
        $property->update();

        if(request('sets')){ $property->set()->sync(request('sets')); }
        $sets = $property->set()->pluck('sets.id');

        return response()->json([
            'property' => $property,
            'sets' => $sets
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Property  $property
     * @return \Illuminate\Http\Response
     */
    public function destroy(Property $property)
    {
        $property->delete();

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
        $properties = Property::where('publish', 1)->orderBy('title', 'ASC')->pluck('title', 'id')->prepend('Bez osobine', 0);

        return response()->json([
            'properties' => $properties
        ]);
    }
}
