<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subscriber;
use Illuminate\Support\Facades\Auth;
class SubscriberController extends Controller
{
   public function subscribe(Request $request){

    $validated=$request->validate([
        'email' => 'required|email|unique:subscribers,email',
    ]);
    
           Subscriber::create($validated);
    return back()->with('status', 'Subscribed successfully!');
   }
    
    
   
}
