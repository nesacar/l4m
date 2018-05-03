<?php

namespace App\Http\Controllers;

use App\Gallery;
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
