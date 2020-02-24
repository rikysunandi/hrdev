<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FitproController extends Controller
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
    public function mBidang()
    {
        // $pegawai = DB::table('pegawai')->get();

        return view('fitpro/mBidang');
    }
    
    public function mSoftKompetensi()
    {
        return view('fitpro/mSoftKompetensi');
    }
    
    public function mKompetensi()
    {
        return view('fitpro/mKompetensi');
    }

    public function mKeyBehaviour()
    {
        return view('fitpro/mKeyBehaviour');
    }

    public function getmBidangData(Request $request)
    {
    	// dd($request);
    	$ko1 = $request->input('ko1');
    	$ko2 = $request->input('ko2');
    	$ko3 = $request->input('ko3');
    	$ko4 = $request->input('ko4');
    	$fungsional = ($request->input('fungsional')=='false')?'T':'Y';
        $no=1; 
        $transaksi_data = DB::select('select * from mFPjabatan order by id asc');
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
            $aktif='<a class="btn btn-xs btn-success">Aktif</a>';
        } else {
            $aktif='<a class="btn btn-xs btn-danger">Not Aktif</a>';
        }

        $query[] = array(
            'no'=>$no++,
            'id'=>$transaksi->id,      
            'position'=>$transaksi->jabatan,        
            'nama_panjang'=>$transaksi->nama_jabatan,  
            'unit'=>$transaksi->unit,  
            'ket'=>$transaksi->ket,  
            'aktif'=>$aktif
        );
    }
    $result=array('data'=>$query);
        return response()->json($result);
    }

    public function getmSoftKompetensiData(Request $request)
    {
    	// dd($request);
    	$ko1 = $request->input('ko1');
    	$ko2 = $request->input('ko2');
    	$ko3 = $request->input('ko3');
    	$ko4 = $request->input('ko4');
    	$fungsional = ($request->input('fungsional')=='false')?'T':'Y';
        $no=1; 
        $transaksi_data = DB::select('select * from mFPsoftkompetensi order by id asc');
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
            $aktif='<a class="btn btn-xs btn-success">Aktif</a>';
        } else {
            $aktif='<a class="btn btn-xs btn-danger">Not Aktif</a>';
        }

        $query[] = array(
            'no'=>$no++,
            'id'=>$transaksi->id,      
            'nama_kompetensi'=>$transaksi->nama_kompetensi,        
            'ket'=>$transaksi->ket,  
            'aktif'=>$aktif
        );
    }
    $result=array('data'=>$query);
        return response()->json($result);
    }

    public function getmKompetensiData(Request $request)
    {
    	// dd($request);
    	$ko1 = $request->input('ko1');
    	$ko2 = $request->input('ko2');
    	$ko3 = $request->input('ko3');
    	$ko4 = $request->input('ko4');
    	$fungsional = ($request->input('fungsional')=='false')?'T':'Y';
        $no=1; 
        $transaksi_data = DB::select('select a.id,a.id_kompetensi,b.nama_kompetensi,a.nama_kompetensi namakomp,a.ket ket,a.aktif from mFPkompetensi a left join
        mFPsoftkompetensi b
        on b.id=a.id_soft 
        order by id_soft,id_kompetensi asc');
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
            $aktif='<a class="btn btn-xs btn-success">Aktif</a>';
        } else {
            $aktif='<a class="btn btn-xs btn-danger">Not Aktif</a>';
        }

        $query[] = array(
            'no'=>$no++,
            'id'=>$transaksi->id,      
            'id_kompetensi'=>$transaksi->id_kompetensi,        
            'kompetensi'=>$transaksi->nama_kompetensi,        
            'nama_kompetensi'=>$transaksi->namakomp,  
            'ket'=>$transaksi->ket,  
            'aktif'=>$aktif
        );
    }
    $result=array('data'=>$query);
        return response()->json($result);
    }

    public function getmKeyBehaviourData(Request $request)
    {
    	// dd($request);
    	$ko1 = $request->input('ko1');
    	$ko2 = $request->input('ko2');
    	$ko3 = $request->input('ko3');
    	$ko4 = $request->input('ko4');
    	$fungsional = ($request->input('fungsional')=='false')?'T':'Y';
        $no=1; 
        $transaksi_data = DB::select('select c.nama_kompetensi id_komp,b.ket ket_komp,a.id,a.id_key,a.nama_behaviour,b.nama_kompetensi,a.ket ket,a.aktif 
        from mFPkeybehavior a left join
        mFPkompetensi b
        on b.id_kompetensi=a.id_kompetensi and b.id_soft = a.id_soft
        left join mFPsoftkompetensi c
        on c.id=a.id_soft
        order by a.id_kompetensi,a.id_key asc');
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
            $aktif='<a class="btn btn-xs btn-success">Aktif</a>';
        } else {
            $aktif='<a class="btn btn-xs btn-danger">Not Aktif</a>';
        }

        $query[] = array(
            'no'=>$no++,
            'id'=>$transaksi->id,      
            'id_komp'=>$transaksi->id_komp,        
            'id_key'=>$transaksi->id_key,        
            'nama_kompetensi'=>$transaksi->nama_kompetensi,        
            'ket_komp'=>$transaksi->ket_komp,        
            'nama_behaviour'=>$transaksi->nama_behaviour,  
            'ket'=>$transaksi->ket,  
            'aktif'=>$aktif
        );
    }
    $result=array('data'=>$query);
        return response()->json($result);
    }
}
