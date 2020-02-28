<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // $pegawai = DB::table('pegawai')->get();
        $user = Auth::user();
        $request->session()->put('theme', $user->theme);
        return view('index', compact('user'));
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
<<<<<<< Updated upstream
        $pegawai = DB::select('select pers_no, prev_per_no, personnel_number, position, business_area, personnel_subarea from pegawai');
=======
        $pegawai = DB::select("select pers_no, prev_per_no, personnel_number
            from vw_pegawai where org2_code='15000001' ");

        foreach ($pegawai as $k => $v) {
            if(file_exists(public_path().'/assets/images/photos/'.$v->prev_per_no.'.jpg'))
                $pegawai[$k]->img = asset('assets/images/photos/'.$v->prev_per_no.'.jpg');
            else
                $pegawai[$k]->img = asset('assets/images/users/blank-avatar.jpg');
        }
>>>>>>> Stashed changes

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
