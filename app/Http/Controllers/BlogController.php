<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use App\Http\Requests\BlogRequest;
use App\Http\Requests\UpdateBlogRequest;
use Illuminate\Support\Facades\Storage;
class BlogController extends Controller
{
  
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = \App\Models\Category::all();
        return view('themes.blogs.create', compact('categories'));
    }

    /** 
     * Store a newly created resource in storage.
     */
    public function store(BlogRequest $request)
    {
        $validated = $request->validated();

        // Assuming you have a logged-in user, you can associate the blog with the user
        $validated['user_id'] = auth()->id();
        $image = $request->file('image');
        $imageName = uniqid().'.'. $image->getClientOriginalName();
        $image->storeAs('blogs', $imageName, 'public');
        $validated['image'] = $imageName;
        
        Blog::create($validated);

        return back()->with('blogstatus', 'Blog created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Blog $blog)
    {

         return view('themes.singleblog', compact('blog'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Blog $blog)
    {
        $categories = \App\Models\Category::all();
       
        return view('themes.blogs.edit', compact('blog', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBlogRequest $request, Blog $blog)
    {
      
        
        $validated = $request->validated();
      
        
        if($request->hasFile('image')){
            Storage::delete('public/blogs/'.$blog->image);
        $image = $request->file('image');
        $imageName = uniqid().'.'. $image->getClientOriginalName();
        $image->storeAs('blogs', $imageName, 'public');
        $validated['image'] = $imageName;
        }
        $blog->update($validated);
        return redirect('/myblogs')->with('blogstatus', 'Blog updated successfully!');
    } 

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Blog $blog)
    {
       Storage::delete('public/blogs/'.$blog->image);
        Blog::destroy($blog->id);
        return back()->with('blogstatus', 'Blog deleted successfully!');
    }
    public function myblogs(){
        if(!auth()->check()){
            return redirect()->route('login');
        }
        $blogs= Blog::where('user_id', auth()->id())->paginate(8);
        return view('themes.blogs.myblogs', compact('blogs'));
    }
}
