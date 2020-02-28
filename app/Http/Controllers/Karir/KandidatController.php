<?php

namespace App\Http\Controllers\Karir;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class KandidatController extends Controller
{
    public function show(Request $request)
    {
    	$jabatan = DB::table("jabatan")->where('id',$request->input('jabatan_id'))->get();
        $pendidikan = explode(";",preg_replace('/\s+/', '', $jabatan[0]->pendidikan));
        $level_kompetensi = explode(";",preg_replace('/\s+/', '', $jabatan[0]->level_kompetensi));
        //print_r($level_kompetensi);
        //exit;
        $daftarKandidat = DB::table("vw_data_talent")
            ->where('profesi',$jabatan[0]->profesi)
            ->whereIn('nama_grade',$level_kompetensi)
            ->whereIn('nama_pendidikan', $pendidikan)
        ->get();


        return view('karir.daftar-kandidat',['kandidat' => $daftarKandidat]);
    }

    public function store(Request $request)
    {
    }

    public function edit(Request $request)
    {
    }

    public function update(Request $request)
    {
    }
}
