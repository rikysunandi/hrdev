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
        $ko5 = $request->input('ko5');
        $fungsional = ($request->input('fungsional')=='false')?'T':'Y';
        $blth = $request->input('blth');
        $bulan = substr($blth,0,2);
        $tahun = substr($blth,3,4);


        $data = DB::select("select a.*, case when tags='kosong' then bso.get_tgl_mulai_kosong(a.pos_code) else null end tgl_mulai_kosong from bso.sp_organisasi_get_chart(?, ?, ?, ?, ?, ?, ?, ?, ?) a", [$prev_per_no, $ko1, $ko2, $ko3, $ko4, $ko5, $fungsional, $tahun, $bulan]);


        $pilih = $data[0];
        foreach ($data as $k => $v) {
            if(file_exists(public_path().'/assets/images/photos/'.$v->prev_per_no.'.jpg'))
                $data[$k]->img = asset('assets/images/photos/'.$v->prev_per_no.'.jpg');
            else
                $data[$k]->img = asset('assets/images/users/blank-avatar.jpg');

            if($prev_per_no<>'' and $v->prev_per_no==$prev_per_no)
                $pilih = $v;
        }

        if($prev_per_no==''){
            $ftk = DB::select("select * from bso.vw_ftk where org_code IN (?, ?, ?, ?, ?) order by pagu_ftk LIMIT 1", [$ko1, $ko2, $ko3, $ko4, $ko5]);
        }
        else{
            $ftk = DB::select("select * from bso.vw_ftk where org_code IN (?, ?, ?, ?, ?) order by pagu_ftk LIMIT 1", [$pilih->org1_code, $pilih->org2_code, $pilih->org3_code, $pilih->org4_code, $pilih->org5_code]);
        }

        $data_ftk = (count($ftk)>0)?$ftk[0]:null;

        return response()->json([$data, $pilih, $data_ftk]);
    }
}
