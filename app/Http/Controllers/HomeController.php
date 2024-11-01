<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Conversation;

use Illuminate\Http\Request;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $chatList = User::select('id', 'name')->where('id', '!=', Auth::user()->id)->get();
        
        return view('home', compact('chatList') );
    }
}
