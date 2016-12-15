<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    /**
     * [test description]
     * @return [type] [description]
     */
    public function test()
    {
        $str = 'abc123DDD';
        $id = 5;
        $name = $id . '_' . strtolower($str) . '_' . substr(md5(time()), 0 , 8);

        dd($name);
    }
}
