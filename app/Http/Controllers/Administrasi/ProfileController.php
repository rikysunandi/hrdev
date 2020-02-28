<?php

namespace App\Http\Controllers\Administrasi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class ProfileController extends Controller
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

        return view('administrasi/profile');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function getData($pers_no)
    {
    	// dd($request);

        $data = DB::select('select a.*, bso.get_tgl_jabat(a.reference_code, a.position_code) tgl_jabat from vw_pegawai a where reference_code=? LIMIT 1', [$pers_no]);

        return response()->json($data);
    } 

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function getRJab($pers_no)
    {
        // dd($request);

        $data = DB::select('select * from public.peg_internal_organization where reference_code=? order by start_date desc', [$pers_no]);

        return response()->json((object) array('data' => $data));
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function getTalenta($pers_no)
    {
        // dd($request);

        $data = DB::select("select * from public.peg_talenta_history where reference_code=? AND substring(grade,1,1) not in ('1','2','3','4','5')  order by start_date desc", [$pers_no]);

        return response()->json((object) array('data' => $data));
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function getPendidikan($pers_no)
    {
        // dd($request);

        $data = DB::select("select * from public.peg_education where reference_code=? AND branch_of_study like '900%'  order by start_date desc", [$pers_no]);

        return response()->json((object) array('data' => $data));
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function getDiklat($pers_no)
    {
        // dd($request);

        $data = DB::select("select * from public.peg_education where reference_code=? AND branch_of_study not like '900%'  order by start_date desc", [$pers_no]);

        return response()->json((object) array('data' => $data));
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function getKeluarga($pers_no)
    {
        // dd($request);

        $data = DB::select("select * from public.vw_peg_family_member where reference_code=? order by start_date desc", [$pers_no]);

        return response()->json((object) array('data' => $data));
    }

}
