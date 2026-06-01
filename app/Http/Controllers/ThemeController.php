<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;
class ThemeController extends Controller
{
    public function index(){
        $blogs=Blog::paginate(3);
        return view('themes.index', compact('blogs'));
    }
    public function category($id){
        $categories = \App\Models\Category::all();
        $categoryName = $categories->where('id', $id)->first()->name;
        $blogs = Blog::where('category_id', $id)->paginate(8);
        return view('themes.category', compact('categories', 'categoryName', 'blogs'));
    }
    public function contact(){
        return view('themes.contact');
    }
   
    public function login(){
        return view('themes.login');
    }
    public function register(){
        return view('themes.register');
    }
}
