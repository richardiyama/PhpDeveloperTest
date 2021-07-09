<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class CategoryController extends Controller
{


    public function __construct()
    {
       //
    }

    public function show($slug)
    {
        $genre = Genre::find($id);  
     
        return view('frontend.pages.category', compact('genre'));
    }
}
