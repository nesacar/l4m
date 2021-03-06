<?php

namespace App\Http\Controllers\Api;

use App\Attribute;
use App\Category;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreatePropertyRequest;
use App\Product;
use App\Property;
use App\Set;
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
        $categories = $property->category()->get(['categories.id', 'categories.title']);

        return response()->json([
            'property' => $property,
            'cat_ids' => $categories,
            'categories' => Category::select('id', 'title')->where('publish', 1)->where('parent', 0)->orderBy('created_at', 'DESC')->get(),
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
        $property->category()->sync(request('cat_ids'));
        $cats = $property->category()->pluck('categories.id');

        return response()->json([
            'property' => $property,
            'cat_ids' => $cats,
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
        $properties = Property::with(['attribute'])->where('properties.publish', 1)->orderBy('properties.title', 'ASC')->get();

        return response()->json([
            'properties' => $properties,
            'lists' => $properties->pluck('title', 'id'),
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

    /**
     * Get properties for given set
     *
     * @param null $set_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function listsBySet($set_id = null)
    {
        $setProperties = Set::with('property')->find($set_id);
        return response()->json([
            'setProperties' => $setProperties->property
        ]);
    }
}
