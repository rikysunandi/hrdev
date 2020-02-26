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
}
