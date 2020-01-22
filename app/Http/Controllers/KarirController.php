<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KarirController extends Controller
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
    public function posisiKosong()
    {
        // $pegawai = DB::table('pegawai')->get();

        return view('posisi-kosong');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function getPosisiKosongData(Request $request)
    {
    	// dd($request);
    	$ko1 = $request->input('ko1');
    	$ko2 = $request->input('ko2');
    	$ko3 = $request->input('ko3');
    	$ko4 = $request->input('ko4');
    	$fungsional = ($request->input('fungsional')=='false')?'T':'Y';

        $data = DB::select('call sp_karir_get_posisi_kosong(?, ?, ?, ?, ?)', [$ko1, $ko2, $ko3, $ko4, $fungsional]);
        // foreach ($data as $k => $v) {
        //     if(file_exists(public_path().'/assets/images/photos/'.$v->prev_per_no.'.jpg'))
        //         $data[$k]->img = asset('assets/images/photos/'.$v->prev_per_no.'.jpg');
        //     else
        //         $data[$k]->img = asset('assets/images/users/blank-avatar.jpg');
        // }
        //$result->data = $data;
        // function objToArray($x)
        // {
        //   return (array) $x;
        // }

        // $data = array_map("objToArray",$data);
        return response()->json((object) array('data' => $data));
    }
}
