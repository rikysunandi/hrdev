<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        // $pegawai = DB::table('pegawai')->get();

        return view('index');
    }


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function getDashboardData()
    {
        $summary = DB::select('call sp_dashboard_get_data("SYSTEM")');
        $rekap_per_unit = DB::select('select * from vw_demografi_unit');

        return response()->json([$summary[0], $rekap_per_unit]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function getPegawai()
    {
        $pegawai = DB::select('select pers_no, prev_per_no, personnel_number, position, business_area, personnel_subarea from pegawai');

        return response()->json($pegawai);
    }


    public function getMutasiTebaru(){
        $newest_mutasi = DB::select('select * from vw_newest_mutasi');
        return response()->json($newest_mutasi);

    }

    public function getPensiunTebaru(){
        $newest_pensiun = DB::select('select * from vw_newest_pensiun');
        return response()->json($newest_pensiun);

    }

}
