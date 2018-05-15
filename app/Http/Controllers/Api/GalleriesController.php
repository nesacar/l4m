<?php

namespace App\Http\Controllers\Api;

use App\Gallery;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use File;

class GalleriesController extends Controller
{
    public function __construct(){
        $this->middleware('auth:api');
    }

    public function destroy($id){
        $gallery = Gallery::find($id);
        File::delete($gallery->file_path);
        File::delete($gallery->file_path_small);

        $gallery->delete();

        return response()->json([
            'message' => 'done'
        ]);
    }
}
