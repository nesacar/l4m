<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Photo;
use Illuminate\Http\Request;
use File;

class PhotosController extends Controller
{
    public function __construct(){
        $this->middleware('auth:api');
    }

    public function destroy($id){
        $photo = Photo::find($id);
        File::delete($photo->file_path);
        File::delete($photo->file_path_small);

        $photo->delete();

        return response()->json([
            'message' => 'done'
        ]);
    }
}
