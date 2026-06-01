<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CommentRequest;
use App\Models\Blog;
class CommentController extends Controller
{
  public function store(Request $request, Blog $blog){
    
      $validated=$request->validate([
        'message' => 'required|string|max:255'
      ]);
        $validated['blog_id'] = $blog->id;
        $validated['user_id'] = auth()->id();
      
      \App\Models\Comment::create($validated);

      return back()->with('status', 'Comment added successfully!');
  }
}
