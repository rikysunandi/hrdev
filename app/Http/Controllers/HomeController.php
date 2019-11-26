<?php

namespace App\Http\Controllers;

use Illuminate\Http\RequData(){

}est;
use Illuminate\Support\Facades\DB;

class HomeController extends Data(){

}
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
        $pegawai = DB::table('pegawai')->get();
 
        return view('index',['pegawai' => $pegawai]);
    }

    public function getData()
    {

    }
}
