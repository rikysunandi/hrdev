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
    public function getData($prev_per_no)
    {
    	// dd($request);

        $data = DB::select('call sp_administrasi_get_profile(?)', [$prev_per_no]);

        return response()->json($data);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function getRJab($prev_per_no)
    {
        // dd($request);

        $data = DB::select('select * from vw_rjab where prev_per_no=? order by start_date desc', [$prev_per_no]);

        return response()->json((object) array('data' => $data));
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function getTalenta($prev_per_no)
    {
        // dd($request);

        $data = DB::select('select * from talenta where nipeg=? order by start_date desc', [$prev_per_no]);

        return response()->json((object) array('data' => $data));
    }

}
