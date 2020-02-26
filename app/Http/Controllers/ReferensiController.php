<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReferensiController extends Controller
{
    //
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function getKO1()
    {
        $ko = DB::select('select * from vw_org_1');
        return response()->json($ko);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function getKO2($ko1)
    {
        $ko = DB::select("select * from vw_org_2 where parent = '$ko1' ");
        return response()->json($ko);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function getKO3($ko2)
    {
        $ko = DB::select("select * from vw_org_3 where parent = '$ko2' ");
        return response()->json($ko);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function getKO4($ko3)
    {
        $ko = DB::select("select * from vw_org_4 where parent = '$ko3' ");
        return response()->json($ko);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function getKO5($ko4)
    {
        $ko = DB::select("select * from vw_org_5 where parent = '$ko4' ");
        return response()->json($ko);
    }
}
