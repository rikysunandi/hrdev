<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrganisasiController extends Controller
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
    public function chart()
    {
        // $pegawai = DB::table('pegawai')->get();

        return view('orgchart');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function getKO1()
    {
        $ko = DB::select('select * from vw_ko_1');
        return response()->json($ko);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function getKO2($ko1)
    {
        $ko = DB::select("select * from vw_ko_2 where kode LIKE '$ko1%' ");
        return response()->json($ko);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function getKO3($ko2)
    {
        $ko = DB::select("select * from vw_ko_3 where kode LIKE '$ko2%' ");
        return response()->json($ko);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function getKO4($ko3)
    {
        $ko = DB::select("select * from vw_ko_4 where kode LIKE '$ko3%' ");
        return response()->json($ko);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function getChartData(Request $request)
    {
    	// dd($request);
        $prev_per_no = $request->input('prev_per_no');
    	$ko1 = $request->input('ko1');
    	$ko2 = $request->input('ko2');
    	$ko3 = $request->input('ko3');
        $ko4 = $request->input('ko4');
    	$fungsional = ($request->input('fungsional')=='false')?'T':'Y';
    	$blth = $request->input('blth');
        $bulan = substr($blth,0,2);
    	$tahun = substr($blth,3,4);

        $data = DB::select('call sp_organisasi_get_chart(?, ?, ?, ?, ?, ?, ?, ?)', [$prev_per_no, $ko1, $ko2, $ko3, $ko4, $fungsional, $tahun, $bulan]);

        $ftk = DB::select("select * from vw_ko_unit
                            where (select kode_ko from pegawai_log where tahun=? and bulan=? and prev_per_no=?) like concat(kode,'%')
                            order by LENGTH(kode) DESC LIMIT 1", [$tahun, $bulan, $prev_per_no]);

        foreach ($data as $k => $v) {
            if(file_exists(public_path().'/assets/images/photos/'.$v->prev_per_no.'.jpg'))
                $data[$k]->img = asset('assets/images/photos/'.$v->prev_per_no.'.jpg');
            else
                $data[$k]->img = asset('assets/images/users/blank-avatar.jpg');
        }

        return response()->json([$data, $ftk[0]]);
    }
}
