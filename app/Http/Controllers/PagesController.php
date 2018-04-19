<?php

namespace App\Http\Controllers;

use App\Category;
use App\Post;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function proba(){
        return Category::with('parentCategory')->get();
    }
}
