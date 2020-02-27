<?php

namespace App\Http\Controllers\Karir;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class KandidatController extends Controller
{
    public function show(Request $request)
    {
    	$daftarKandidat = DB::table("vw_data_talent")->get();

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
