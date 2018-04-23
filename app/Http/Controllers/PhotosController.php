<?php

namespace App\Http\Controllers;

use App\Photo;
use Illuminate\Http\Request;
use File;

class PhotosController extends Controller
{
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
