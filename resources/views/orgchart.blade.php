@extends('layouts.master')

@section('css')
<link rel="stylesheet" href="{{ URL::asset('assets/plugins/morris/morris.css')}}">
<link rel="stylesheet" href="{{ URL::asset('assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css')}}">
@endsection

@section('content')
            <div class="container-fluid">

                <div class="row">
                    <div class="col-sm-12">
                        <div class="page-title-box">
                            <h4 class="page-title">Struktur Organisasi</h4>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="javascript:void(0);">HRDev</a></li>
                                <li class="breadcrumb-item"><a href="javascript:void(0);">Organisasi</a></li>
                                <li class="breadcrumb-item active">Struktur Organisasi</li>
                            </ol>
                        </div>
                    </div>
                </div>
                <!-- end row -->

                <div class="row">
                    <div class="col-lg-12">
                        <div class="card m-b-30">
                            <div class="card-body">
                                <h4 class="mt-0 m-b-20 header-title">Pilih Organisasi</h4>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <select id="ko_2" class="custom-select">
                                            <option selected disabled>Pilih Organisasi I</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-3">
                                        <select id="ko_3" class="custom-select">
                                            <option selected disabled>Pilih Organisasi II</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-3">
                                        <select id="ko_4" class="custom-select">
                                            <option selected disabled>Pilih Organisasi III</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="row">
                                            <div class="col-sm-4 m-l-10 p-0">
                                                <div class="input-group">
                                                    <label class="m-r-10">Fungsional</label>
                                                    <input type="checkbox" id="switch1" switch="none" checked/>
                                                        <label for="switch1" data-on-label="Ya"
                                                                data-off-label="Tidak"></label>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 m-0 p-0">
                                                <div class="input-group">
                                                    <input type="text" class="form-control" placeholder="dd/yyyy" id="datepicker-autoclose">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                                    </div>
                                                </div><!-- input-group -->
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="text-right m-t-15">
                                    <button type="button" class="btn btn-primary waves-effect waves-light"><i class="ti-search"></i> Cari</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end row -->

            </div> <!-- container-fluid -->
@endsection

@section('script')
        <script src="{{ URL::asset('assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js')}}"></script>
        <script src="{{ URL::asset('assets/plugins/select2/js/select2.min.js')}}"></script>

		<script src="{{ URL::asset('assets/pages/orgchart.js')}}"></script>
@endsection
