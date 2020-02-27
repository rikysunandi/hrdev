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

                        <div class="row">
                            <div class="col-sm-12">
                                <div class="page-title-box">
                                    <h4 class="page-title">Daftar Talent</h4>
                                </div>
                            </div>
                        </div>
                        <!--div class="row">
                            <div class="col-12">
                                <div class="card m-b-20">
                                    <div class="card-body">
                                        <div class="row m-l-5">
                                            <select id="ko_1" class="custom-select custom-select-sm col-3 col-sm-2 m-r-10">
                                                <option selected disabled>Pilih Organisasi I</option>
                                            </select>
                                            <select id="ko_2" class="custom-select custom-select-sm col-3 col-sm-2 m-r-10">
                                                <option selected disabled>Pilih Organisasi II</option>
                                            </select>
                                            <select id="ko_3" class="custom-select custom-select-sm col-3 col-sm-2 m-r-10">
                                                <option selected disabled>Pilih Organisasi III</option>
                                            </select>
                                            <select id="ko_4" class="custom-select custom-select-sm col-3 col-sm-2 m-r-10">
                                                <option selected disabled>Pilih Organisasi IV</option>
                                            </select>
                                        </div>
                                        <div class="text-right m-t-15">
                                            <button id="btn_cari" type="button" class="btn btn-primary waves-effect waves-light"><i class="ti-search"></i> Cari</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div-->

                        <div class="row">
                            <div class="col-12">
                                <div class="card m-b-20">
                                    <div class="card-body">

                                        {{-- <h4 class="mt-0 header-title">Buttons example</h4>
                                        <p class="text-muted m-b-30 font-14">The Buttons extension for DataTables
                                            provides a common set of options, API methods and styling to display
                                            buttons on a page that will interact with a DataTable. The core library
                                            provides the based framework upon which plug-ins can built.
                                        </p> --}}
                                        <table id="datatable-daftar-talent" class="table table-striped table-bordered dt-responsive table-hover" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                            <thead>
                                            <tr>
                                                <th>no</th>
                                                <th>unit</th>
                                                <th>unit</th>
                                                <th>unit</th>
                                                <th>unit</th>
                                                <th>nipeg</th>
                                                <th>nama</th>
                                                <th>jabatan</th>
                                                <th>grade</th>
                                                <th>profesi</th>
                                                <th>pendidikan</th>
                                                <th>status</th>
                                            </tr>
                                            </thead>


                                            
                                        </table>
                                    </div>
                                </div>
                            </div> <!-- end col -->
                        </div> <!-- end row -->



                    </div> <!-- container-fluid -->
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

        <!-- Datatable init js -->
        <script src="{{ URL::asset('assets/pages/talent/daftar_talent.js')}}"></script>
@endsection