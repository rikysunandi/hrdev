<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TalentController extends Controller
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
    public function daftar_talent()
    {
        // $pegawai = DB::table('pegawai')->get();

        return view('talent/daftar_talent');
    }
    
    public function getdaftar_talentData(Request $request)
    {
    	// dd($request);
    	$ko1 = $request->input('ko1');
    	$ko2 = $request->input('ko2');
    	$ko3 = $request->input('ko3');
    	$ko4 = $request->input('ko4');
    	$fungsional = ($request->input('fungsional')=='false')?'T':'Y';
        $no=1; 
        $transaksi_data = DB::select('
        SELECT
	a.nipeg,
	e.branch_of_study_text,
	e.org2_code,
	e.org2_sname,
	e.org3_sname,
	e.org4_sname,
	e.org5_sname,
	e.org5_lname,
	e.org6_sname,
	e.fullname,
	e.permanent_date,
	b.jabatan,
	b.profesi,
	c.nama_grade,
	d.nama_pendidikan,
	a.STATUS  as aktif
FROM
	data_talent a
	LEFT JOIN peg_history_data_for_statistic e ON e.nipeg = a.nipeg
	LEFT JOIN jabatan b ON e.position_ltext = b.jabatan
	LEFT JOIN grade c ON e.grade_name = c.nama_grade2
	LEFT JOIN pendidikan d ON e.education_type_code = d.education_type_code 
GROUP BY
	a.nipeg,
	e.branch_of_study_text,
	e.org2_code,
	e.org2_sname,
	e.org3_sname,
	e.org4_sname,
	e.org5_sname,
	e.org5_lname,
	e.org6_sname,
	e.fullname,
	e.permanent_date,
	b.jabatan,
	b.profesi,
	c.nama_grade,
	d.nama_pendidikan,
	a.STATUS');
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

        foreach ($transaksi_data as $transaksi) {
        // $data = array_map("objToArray",$data);

        if ($transaksi->aktif == 1) {
            $aktif='<a class="btn btn-xs btn-success">ASSES</a>';
        } else {
            $aktif='<a class="btn btn-xs btn-danger">BLM ASSES</a>';
        }

        $query[] = array(
            'no'=>$no++,     
            'unit'=>$transaksi->org2_sname,
            'unit2'=>$transaksi->org3_sname,
            'unit3'=>$transaksi->org4_sname,
            'unit4'=>$transaksi->org5_lname,
            'nipeg'=>$transaksi->nipeg,        
            'fullname'=>$transaksi->fullname,  
            'jabatan'=>$transaksi->jabatan,  
            'nama_grade'=>$transaksi->nama_grade,   
            'profesi'=>$transaksi->profesi,   
            'nama_pendidikan'=>$transaksi->nama_pendidikan,  
            'aktif'=>$aktif
            
        );
    }
    $result=array('data'=>$query);
        return response()->json($result);
    }

}
