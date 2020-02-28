@extends('layouts.master')

@section('css')
        <!-- DataTables -->
        <link href="{{ URL::asset('assets/plugins/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{ URL::asset('assets/plugins/datatables/buttons.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
        <!-- Responsive datatable examples -->
        <link href="{{ URL::asset('assets/plugins/datatables/responsive.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />

        <link href="{{ URL::asset('assets/plugins/ion-rangeslider/ion.rangeSlider.skinModern.css')}}" rel="stylesheet" type="text/css"/>
@endsection

@section('content')

<div class="container-fluid">
    <div class="row p-t-20">
        <div class="col-md-4 pr-md-5">
            <img id="avatar" class="w-100 rounded border" src="{{ URL::asset('assets/images/users/blank-avatar.jpg')}}" />
            <div class="pt-4 mt-2">
                <section class="mb-4 pb-1">
                    <h3 class="h6 font-weight-light text-secondary text-uppercase">Pengalaman Kerja</h3>
                    <div class="work-experience pt-2">
                        {{-- <div class="work mb-4">
                            <strong class="h5 d-block text-secondary font-weight-bold mb-1">Prodesign Inc</strong>
                            <strong class="h6 d-block text-warning mb-1">Front End Developer</strong>
                            <p class="text-secondary">Southern Street Floral Park, NY 11001</p>
                        </div>
                        <div class="work mb-4">
                            <strong class="h5 d-block text-secondary font-weight-bold mb-1">Blue Tech</strong>
                            <strong class="h6 d-block text-warning mb-1">Senior Programmer</strong>
                            <p class="text-secondary">George Avenue Mobile, AL 36608</p>
                        </div> --}}
                    </div>    
                </section>
                <section class="mb-5 mb-md-0">
                    <h3 class="h6 font-weight-light text-secondary text-uppercase">Skills</h3>
                    <div class="skills pt-1 row">
                        {{-- <div class="col-4 mb-2">
                            <div class="chart" data-percent="95" data-scale-color="#fff"><span>PHP</span></div>
                        </div>
                        <div class="col-4 mb-2">
                            <div class="chart" data-percent="85" data-scale-color="#fff"><span>Ruby</span></div>
                        </div>
                        <div class="col-4 mb-2">
                            <div class="chart" data-percent="90" data-scale-color="#fff"><span>Java</span></div>
                        </div>
                        <div class="col-4 mb-2">
                            <div class="chart" data-percent="82" data-scale-color="#fff"><span>Python</span></div>
                        </div>
                        <div class="col-4 mb-2">
                            <div class="chart" data-percent="70" data-scale-color="#fff"><span>C++</span></div>
                        </div>
                        <div class="col-4 mb-2">
                            <div class="chart" data-percent="60" data-scale-color="#fff"><span>ASP</span></div>
                        </div> --}}
                        <canvas id="radar" height="300"></canvas>
                        
                    </div>
                </section>
            </div>
        </div>
        <div class="col-md-8">
            <div class="d-flex align-items-center">
                <h2 id="personnel_number" class="font-weight-bold m-0">
                    &nbsp;
                </h2>
                <address id="city" class="m-0 pt-2 pl-0 pl-md-4 font-weight-light text-secondary">
                    &nbsp;
                </address>
            </div>
            <p id="position" class="h5 text-primary mt-2 d-block font-weight-light">
                &nbsp;
            </p>
            <p id="overview" class="lead mt-4">&nbsp;</p>
            {{-- <section class="mt-5">
                <h3 class="h6 font-weight-light text-secondary text-uppercase">Rankings</h3>
                <div class="d-flex align-items-center">
                    <strong class="h1 font-weight-bold m-0 mr-3">4.85</strong>
                    <div>
                        <input data-filled="fa fa-2x fa-star mr-1 text-warning" data-empty="fa fa-2x fa-star-o mr-1 text-light" value="5" type="hidden" class="rating" data-readonly />
                    </div>
                </div>
            </section> --}}
            <section class="d-flex mt-5">
                <button id="btn_whatsapp" class="btn btn-outline-primary waves-effect waves-light mr-3 mb-3">
                    <i class="fab fa-whatsapp"></i>
                    Whatsapp
                </button>
                <button id="btn_email" class="btn btn-outline-primary waves-effect waves-light mr-3 mb-3">
                    <i class="far fa-envelope"></i>
                    Email
                </button>
                <button id="btn_orgchart" class="btn btn-outline-primary waves-effect waves-light mb-3">
                    <i class="fas fa-boxes"></i>
                    Struktur Organisasi
                </button>
            </section> 
            <section class="mt-4">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">
                            About
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="pendidikan-tab" data-toggle="tab" href="#pendidikan" role="tab" aria-controls="pendidikan" aria-selected="false">
                            Pendidikan
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="diklat-tab" data-toggle="tab" href="#diklat" role="tab" aria-controls="diklat" aria-selected="false">
                            Diklat
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="rjab-tab" data-toggle="tab" href="#rjab" role="tab" aria-controls="rjab" aria-selected="false">
                            Riwayat Jabatan    
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="talenta-tab" data-toggle="tab" href="#talenta" role="tab" aria-controls="talenta" aria-selected="false">
                            Talenta
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="keluarga-tab" data-toggle="tab" href="#keluarga" role="tab" aria-controls="keluarga" aria-selected="false">
                            Keluarga
                        </a>
                    </li>
                </ul>
                <div class="tab-content py-4" id="myTabContent">
                    <div class="tab-pane py-3 fade show active p-10" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <h6 class="text-uppercase font-weight-light text-secondary">
                            Basic Information
                        </h6>
                        <dl class="row mt-4 mb-4 pb-3">
                            <input type="hidden" name="pers_no" id="pers_no" value="<?php echo (isset($_POST['pers_no']))?$_POST['pers_no']:''; ?>">
                            <dt class="col-sm-3">NIP</dt>
                            <dd id="prev_per_no" class="col-sm-9"></dd>

                            <dt class="col-sm-3">Tempat, Tgl Lahir</dt>
                            <dd id="ttl" class="col-sm-9"></dd>
                            
                            <dt class="col-sm-3">Jenis Kelamin</dt>
                            <dd id="gender_key" class="col-sm-9"></dd>

                            <dt class="col-sm-3">Agama</dt>
                            <dd id="religious_denomination_key" class="col-sm-9"></dd>

                            <dt class="col-sm-3">Status Menikah</dt>
                            <dd id="marital_status_key" class="col-sm-9"></dd>

                            <dt class="col-sm-3">Tanggal Masuk</dt>
                            <dd id="tanggal_masuk" class="col-sm-9"></dd>
                        </dl>

                        <h6 class="text-uppercase font-weight-light text-secondary">
                            Contact Information
                        </h6>
                        <dl class="row mt-4 mb-4 pb-3">
                            <dt class="col-sm-3">Telepon</dt>
                            <dd id="telephone_no" class="col-sm-9"></dd>
                            
                            <dt class="col-sm-3">Alamat</dt>
                            <dd class="col-sm-9">
                                <address id="alamat" class="mb-0">
                                </address>
                            </dd>
                            
                            <dt class="col-sm-3">Email</dt>
                            <dd class="col-sm-9">
                                <a id="email" href=""></a>
                            </dd>
                        </dl>
                    </div>
                    <div class="tab-pane fade p-10" id="pendidikan" role="tabpanel" aria-labelledby="pendidikan-tab">
                        <table id="datatable-pendidikan" class="table table-striped table-bordered dt-responsive" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                            <tr>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Sekolah/Universitas</th>
                            </tr>
                            </thead>
                        </table>
                    </div>
                    <div class="tab-pane fade p-10" id="diklat" role="tabpanel" aria-labelledby="diklat-tab">
                        <table id="datatable-diklat" class="table table-striped table-bordered dt-responsive" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                            <tr>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Institusi</th>
                                <th>Judul</th>
                            </tr>
                            </thead>
                        </table>
                    </div>
                    <div class="tab-pane fade p-10" id="rjab" role="tabpanel" aria-labelledby="rjab-tab">
                        <table id="datatable-rjab" class="table table-striped table-bordered dt-responsive" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                            <tr>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Jabatan</th>
                                <th>Unit</th>
                                <th>Jenjang</th>
                            </tr>
                            </thead>
                        </table>
                    </div>
                    <div class="tab-pane fade p-10" id="talenta" role="tabpanel" aria-labelledby="talenta-tab">
                        <table id="datatable-talenta" class="table table-striped table-bordered dt-responsive" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                            <tr>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Talenta</th>
                                <th>Nilai</th>
                                <th>Grade</th>
                            </tr>
                            </thead>
                        </table>
                    </div>
                    <div class="tab-pane fade p-10" id="keluarga" role="tabpanel" aria-labelledby="keluarga-tab">
                        <table id="datatable-keluarga" class="table table-striped table-bordered dt-responsive" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                            <tr>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Nama</th>
                                <th>Jenis</th>
                                <th>Gender</th>
                                <th>Tgl Lahir</th>
                            </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>
@endsection

@section('script')
        <!-- Required datatable js -->
        <script src="{{ URL::asset('assets/plugins/datatables/jquery.dataTables.min.js')}}"></script>
        <script src="{{ URL::asset('assets/plugins/datatables/dataTables.bootstrap4.min.js')}}"></script>
        <!-- Buttons examples -->
        <script src="{{ URL::asset('assets/plugins/datatables/dataTables.buttons.min.js')}}"></script>
        <script src="{{ URL::asset('assets/plugins/datatables/buttons.bootstrap4.min.js')}}"></script>
        <script src="{{ URL::asset('assets/plugins/datatables/jszip.min.js')}}"></script>
        <script src="{{ URL::asset('assets/plugins/datatables/pdfmake.min.js')}}"></script>
        <script src="{{ URL::asset('assets/plugins/datatables/vfs_fonts.js')}}"></script>
        <script src="{{ URL::asset('assets/plugins/datatables/buttons.html5.min.js')}}"></script>
        <script src="{{ URL::asset('assets/plugins/datatables/buttons.print.min.js')}}"></script>
        <script src="{{ URL::asset('assets/plugins/datatables/buttons.colVis.min.js')}}"></script>
        <!-- Responsive examples -->
        <script src="{{ URL::asset('assets/plugins/datatables/dataTables.responsive.min.js')}}"></script>
        <script src="{{ URL::asset('assets/plugins/datatables/responsive.bootstrap4.min.js')}}"></script>

        <script src="{{ URL::asset('assets/plugins/moment/moment.js')}}"></script>
        <script src="{{ URL::asset('assets/plugins/moment/moment-with-locales.min.js')}}"></script>
        <script src="{{ URL::asset('assets/plugins/chart.js/chart.min.js')}}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-rating/1.5.0/bootstrap-rating.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/easy-pie-chart/2.1.6/jquery.easypiechart.min.js"></script>

        <!-- Datatable init js -->
        <script src="{{ URL::asset('assets/pages/profile.js')}}"></script>
@endsection
