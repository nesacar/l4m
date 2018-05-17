<?php

namespace App\Http\Controllers\Api;

use App\Brand;
use App\BrandLink;
use App\Http\Requests\CreateBrandLinkRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BrandLinksController extends Controller
{
    public function __construct(){
        $this->middleware('auth:api');
    }

    /**
     * @param CreateBrandLinkRequest $request
     * @param $brand_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(CreateBrandLinkRequest $request, $brand_id){
        $link = Brand::find($brand_id)->links()->save(new BrandLink(request()->all()));

        return response()->json([
            'link' => $link,
        ]);
    }

    public function show($id){
        $link = BrandLink::with('brand')->find($id);

        return response()->json([
            'link' => $link,
        ]);
    }

    public function update(CreateBrandLinkRequest $request, $id){
        $link = BrandLink::find($id)->update(request()->all());

        return response()->json([
            'link' => $link,
        ]);
    }

    public function destroy($id){
        $link = BrandLink::find($id);
        $link->delete();

        return response()->json([
            'message' => 'done',
        ]);
    }
}
