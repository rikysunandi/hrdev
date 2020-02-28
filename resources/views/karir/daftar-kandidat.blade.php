@extends('layouts.master')

@section('css')
<link href="{{ URL::asset('assets/css/compare.css')}}" rel="stylesheet" type="text/css" />
@endsection

@section('title')
    <title>Kandidat</title>
@endsection

@section('content')
            <div class="container-fluid">

                <div class="row">
                    <div class="col-sm-12">
                        <div class="page-title-box">
                            <h4 class="page-title">Kandidat</h4>
                        </div>
                    </div>
                </div>


                    <div class="col-md-12">
                        <form class="form-horizontal m-t-30" method="POST" action="{{ route('login') }}" aria-label="{{ __('Login') }}">
                            <div class="card m-b-20">
                                <div class="card-body">
                                    <div class="row m-l-5">
                                        <select id="ko_2" class="custom-select custom-select-sm col-3 col-sm-3 m-r-10">
                                            <option selected disabled>Jabatan</option>
                                        </select>
                                        <select id="ko_3" class="custom-select custom-select-sm col-3 col-sm-3 m-r-10">
                                            <option selected disabled>Profesi</option>
                                        </select>
                                        <select id="ko_4" class="custom-select custom-select-sm col-3 col-sm-3 m-r-10">
                                            <option selected disabled>Pendidikan</option>
                                        </select>
                                    </div>
                                    <div class="text-right m-t-15">
                                        <button id="btn_cari" type="submit" class="btn btn-primary waves-effect waves-light"><i class="ti-search"></i> Cari</button>
                                    </div>
                                </div>
                            </div>
                        </form>

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
                                            <div class="selectProduct w3-padding w3-profile-block" data-title="{{ $row->nipeg }}" data-id="{{ $row->fullname }}" data-nipeg="{{ $row->nipeg }}" data-nama="{{ $row->fullname }}" data-jabatan="{{ $row->jabatan }}" data-unit="{{ $row->org2_sname }}">
                                                <a class="w3-btn-floating w3-light-grey addButtonCircular addToCompare">+</a>
                                                <div>
                                                    <img width="100%" src="{{ URL::asset('assets/images/photos') }}/{{ $row->nipeg }}.jpg" class="imgFill productImg" onerror="this.onerror=null; this.src='{{ URL::asset('assets/images/users/blank-avatar.jpg') }}'">
                                                </div>
                                                <div class="w3-profile-table">
                                                    <button id="{{ $row->nipeg }}" type="button"class="btn btn-primary addToCandidate">Pilih Kandidat</button>
                                                    <table>
                                                        <tr>
                                                            <td>NIP</td>
                                                            <td>:</td>
                                                            <td>{{ $row->nipeg }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Nama</td>
                                                            <td>:</td>
                                                            <td>{{ $row->fullname }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Jabatan</td>
                                                            <td>:</td>
                                                            <td>{{ $row->jabatan }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Unit</td>
                                                            <td>:</td>
                                                            <td>{{ $row->org2_sname }}</td>
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
                                <form class="form-horizontal m-t-30" method="POST" action="{{ route('login') }}" aria-label="{{ __('Login') }}">
                                    <div class="w3-row w3-card-4 w3-grey w3-round-large w3-border candidatePanle w3-margin-top">
                                        <div class="w3-row">
                                            <div class="w3-col l9 m8 s6 w3-margin-top">
                                                <h4>Kandidat</h4>
                                            </div>
                                            <div class="w3-col l3 m4 s6 w3-margin-top">

                                                <button type="submit" class="w3-btn w3-round-small w3-white w3-border">Simpan</button>
                                            </div>
                                        </div>
                                        <div class=" titleMargin w3-container candidatePan">
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <!--end of preview panel-->

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
                                        <h4>Maksimum hanya tiga kandidat untuk dibandingkan</h4>

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
