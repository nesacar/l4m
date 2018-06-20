<?php

namespace App\Http\Controllers\Api;

use App\Attribute;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreatePropertyRequest;
use App\Product;
use App\Property;
use Illuminate\Http\Request;

class PropertiesController extends Controller
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
        $properties = Property::with('category')->orderBy('order', 'ASC')->paginate(50);

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

        //$property->set()->sync(request('set_ids'));
        $property->category()->sync(request('cat_ids'));

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
        //$sets = $property->set()->pluck('sets.id');
        $categories = $property->category()->pluck('categories.id');

        return response()->json([
            'property' => $property,
            //'sets' => $sets,
            'categories' => $categories,
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

        //$property->set()->sync(request('set_ids'));
        $property->category()->sync(request('cat_ids'));

        //$sets = $property->set()->pluck('sets.id');
        $cats = $property->category()->pluck('categories.id');

        return response()->json([
            'property' => $property,
            //'sets' => $sets,
            'categories' => $cats,
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
        $properties = Property::with(['set', 'attribute'])->where('properties.publish', 1)->orderBy('properties.title', 'ASC')->get();

        return response()->json([
            'properties' => $properties,
            'lists' => $properties->pluck('title', 'id'),
        ]);
    }

    /**
     * Property lists related to Set
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function listsBySet($set_id){
        $properties = Property::with(['Set' => function($query) use ($set_id){
                $query->where('sets.id', $set_id);
            }])->with(['Attribute' => function($query){
                $query->where('attributes.publish', 1)->orderBy('attributes.order', 'ASC');
            }])->where('properties.publish', 1)->orderBy('properties.order', 'ASC')->get();

        return response()->json([
            'properties' => $properties
        ]);
    }

    public function listsByCategories(){
        $properties = Property::getPropertyByCategories(request('ids'));
        $newAttIds = Attribute::getAttributeIdsByCategories(request('ids'));

        return response()->json([
            'properties' => $properties,
            'newIds' => $newAttIds,
        ]);
    }
}
