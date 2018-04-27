<?php

namespace App\Http\Controllers;

use App\Attribute;
use App\Http\Requests\CreateAttributeRequest;
use Illuminate\Http\Request;

class AttributesController extends Controller
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
        $attributes = Attribute::with(['property' => function($query){ $query->with(['set' => function($q){ $q->select('title'); }]); }])
            ->orderBy('attributes.id', 'DESC')->groupBy('attributes.id')->paginate(50);

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

    /**
     * Attribute search
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function search(){
        $text = request('text');
        $property_id = request('list')?: false;
        $attributes = Attribute::with(['property' => function($query){ $query->with(['set' => function($q){ $q->select('title'); }]); }])
            ->where(function ($query) use ($text){
                if($text != ''){
                    $query->where('attributes.title', 'like', '%'.$text.'%')->orWhere('attributes.slug', 'like', '%'.$text.'%');
                }
            })
            ->where(function ($query) use ($property_id){
                if($property_id){
                    $query->where('attributes.property_id', $property_id);
                }
            })
            ->groupBy('attributes.id')->orderBy('attributes.id', 'DESC')->paginate(50);

        return response()->json([
            'attributes' => $attributes,
        ]);
    }
}
