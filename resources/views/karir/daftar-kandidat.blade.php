@extends('layouts.master')

@section('css')
<link href="{{ URL::asset('assets/css/compare.css')}}" rel="stylesheet" type="text/css" />
@endsection

@section('title')
    <title>Kandidat</title>
@endsection

@section('content')
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-12">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('posisi.kososng') }}">Posisi Kosong</a></li>
                            <li class="breadcrumb-item active">Daftar Kandidat</li>
                        </ol>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="page-title-box">
                            <h4 class="page-title">Kandidat</h4>
                        </div>
                    </div>
                </div>


                    <div class="col-md-12">

                                <div class="card m-b-20">
                                    <div class="card-body">
                                        <div class="row m-l-5">
                                            <select id="ko_2" class="custom-select custom-select-sm col-3 col-sm-3 m-r-10">
                                                <option selected disabled>Pilih Organisasi I</option>
                                            </select>
                                            <select id="ko_3" class="custom-select custom-select-sm col-3 col-sm-3 m-r-10">
                                                <option selected disabled>Pilih Organisasi II</option>
                                            </select>
                                            <select id="ko_4" class="custom-select custom-select-sm col-3 col-sm-3 m-r-10">
                                                <option selected disabled>Pilih Organisasi III</option>
                                            </select>
                                        </div>
                                        <div class="text-right m-t-15">
                                            <button id="btn_cari" type="button" class="btn btn-primary waves-effect waves-light"><i class="ti-search"></i> Cari</button>
                                        </div>
                                    </div>
                                </div>


                        @card
                            @slot('title')

                            @endslot

                            @if (session('error'))
                                @alert(['type' => 'danger'])
                                    {!! session('error') !!}
                                @endalert
                            @endif

                            <div class="w3-container">
                                <div class="w3-row-padding">

                                    @foreach ($kandidat as $key => $row)
                                        <div class="w3-col l3 m6  relPos w3-center ">
                                            <div class="selectProduct w3-padding" data-nip="Nexus5" data-nama="Nexus 5" data-jabatan="" data-unit="130 g">
                                                <a class="w3-btn-floating w3-light-grey addButtonCircular addToCompare">+</a>
                                                <div>
                                                    <img src="https://www.yaantra.com/ItemImages/Catalog/Products/ThumbNail/RCOne0054_4.jpg" class="imgFill productImg">
                                                </div>
                                                <div>
                                                    <table>
                                                        <tr>
                                                            <td>NIP</td>
                                                            <td>{{ $row->nipeg }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Nama</td>
                                                            <td>{{ $row->fullname }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Jabatan</td>
                                                            <td>{{ $row->profesi }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Unit</td>
                                                            <td>unit</td>
                                                        </tr>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach

                                </div>
                            </div>
                            <!--preview panel-->
                            <div class="w3-container  w3-center">
                                <div class="w3-row w3-card-4 w3-grey w3-round-large w3-border comparePanle w3-margin-top">
                                    <div class="w3-row">
                                        <div class="w3-col l9 m8 s6 w3-margin-top">
                                            <h4>Added for comparison</h4>
                                        </div>
                                        <div class="w3-col l3 m4 s6 w3-margin-top">

                                            <button class="w3-btn w3-round-small w3-white w3-border notActive cmprBtn" disabled>Compare</button>
                                        </div>
                                    </div>
                                    <div class=" titleMargin w3-container comparePan">
                                    </div>
                                </div>
                            </div>
                            <!--end of preview panel-->

                            <!-- comparision popup-->
                            <div id="id01" class="w3-animate-zoom w3-white w3-modal modPos">
                                <div class="w3-container">
                                    <a onclick="document.getElementById('id01').style.display='none'" class="whiteFont w3-padding w3-closebtn closeBtn">×</a>
                                </div>
                                <div class="w3-row contentPop w3-margin-top">
                                </div>

                            </div>
                            <!--end of comparision popup-->

                            <!--  warning model  -->
                            <div id="WarningModal" class="w3-modal">
                                <div class="w3-modal-content warningModal">
                                    <header class="w3-container w3-teal">
                                        <h3><span>⚠</span>Error</h3>
                                    </header>
                                    <div class="w3-container">
                                        <h4>Maximum of Three products are allowed for comparision</h4>

                                    </div>
                                    <footer class="w3-container w3-right-align">
                                        <button id="warningModalClose" onclick="document.getElementById('id01').style.display='none'" class="w3-btn w3-hexagonBlue w3-margin-bottom  ">Ok</button>
                                    </footer>
                                </div>
                            </div>
                            <!--  end of warning model  -->

                            @slot('footer')

                            @endslot
                        @endcard
                    </div>

            </div>
@endsection
