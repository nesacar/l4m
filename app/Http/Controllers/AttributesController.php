<?php

namespace App\Http\Controllers;

use App\Attribute;
use App\Http\Requests\CreateAttributeRequest;
use Illuminate\Http\Request;

class AttributesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $attributes = Attribute::select('attributes.id', 'attributes.title', 'attributes.order', 'attributes.publish', 'attributes.created_at', 'properties.title as property')
            ->join('properties', 'attributes.property_id', '=', 'properties.id')->orderBy('attributes.order', 'ASC')->groupBy('attributes.id')->paginate(50);

        return response()->json([
            'attributes' => $attributes
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateAttributeRequest $request)
    {
        $attribute = Attribute::create(request()->all());
        $attribute->slug = request('slug')?: request('title');
        $attribute->publish = request('publish')?: false;
        $attribute->update();

        return response()->json([
            'attribute' => $attribute
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Attribute  $attribute
     * @return \Illuminate\Http\Response
     */
    public function show(Attribute $attribute)
    {
        return response()->json([
            'attribute' => $attribute
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Attribute  $attribute
     * @return \Illuminate\Http\Response
     */
    public function update(CreateAttributeRequest $request, Attribute $attribute)
    {
        $attribute->update(request()->all());
        $attribute->slug = request('slug')?: request('title');
        $attribute->publish = request('publish')?: false;
        $attribute->update();

        return response()->json([
            'attribute' => $attribute,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Attribute  $attribute
     * @return \Illuminate\Http\Response
     */
    public function destroy(Attribute $attribute)
    {
        $attribute->delete();

        return response()->json([
            'message' => 'deleted'
        ]);
    }

    /**
     * Attribute lists
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function lists(){
        $attributes = Attribute::where('publish', 1)->orderBy('title', 'ASC')->pluck('title', 'id')->prepend('Bez atributa', 0);

        return response()->json([
            'attributes' => $attributes
        ]);
    }
}
