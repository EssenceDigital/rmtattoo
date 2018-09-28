<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;

class AppController extends Controller
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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('app');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect('/login');
    }
}
