<?php

namespace App\Http\Controllers\Karir;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class PosisiKosongController extends Controller
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

        return view('karir/posisi-kosong');
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
    	$fungsional = ($request->input('fungsional')=='false')?'T':'Y';

        $data = DB::select('call sp_karir_get_posisi_kosong(?, ?, ?, ?, ?)', [$ko1, $ko2, $ko3, $ko4, $fungsional]);

        return response()->json((object) array('data' => $data));
    }

}
