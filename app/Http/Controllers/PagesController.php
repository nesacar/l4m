<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function proba(){
        $post = Post::first();
        return $post->datum;
    }
}
