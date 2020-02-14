<?php

namespace App\Http\Controllers\Karir;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class StrukturalPensiunController extends Controller
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
        // $pegawai = DB::table('pegawai')->get();

        return view('karir/struktural-pensiun');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function getData(Request $request)
    {
        // dd($request);
        $ko1 = $request->input('ko1');
        $ko2 = $request->input('ko2');
        $ko3 = $request->input('ko3');
        $ko4 = $request->input('ko4');

        $data = DB::select('call sp_karir_get_struktural_pensiun(?, ?, ?, ?)', [$ko1, $ko2, $ko3, $ko4]);
        
        return response()->json((object) array('data' => $data));
    }
}
