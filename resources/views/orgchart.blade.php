@extends('layouts.master')

@section('css')
<link rel="stylesheet" href="{{ URL::asset('assets/plugins/morris/morris.css')}}">
<link rel="stylesheet" href="{{ URL::asset('assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css')}}">
<style type="text/css">
    /*partial*/
    .node.fungsional rect {
        fill: #F57C00;
    }

    .node.struktural rect {
        fill: #008299;
    }

    .node.plt rect {
        fill: #03B3B2;
    }

    .node.kosong rect {
        fill: #AC193D;
    }
</style>
@endsection

@section('content')
            <div class="container-fluid">

                {{-- <div class="row">
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
                </div> --}}
                <!-- end row -->

                <div class="row">
                    <div class="col-lg-12">
                        <div id="panel_pencarian" class="card m-t-20 m-b-20">
                            <div class="card-body">
                                <h4 class="mt-0 m-b-10 header-title">Pilih Organisasi</h4>
                                <form class="form-inline">
                                    <div class="form-group">
                                        <div class="col-2 input-group m-r-10">
                                            <input id="prev_per_no" type="text" class="form-control col-sm" autocomplete="off" spellcheck="false" " placeholder="NIP / Nama Pegawai">
                                        </div>
                                        <select id="ko_2" class="custom-select custom-select-sm m-r-10 col-2">
                                            <option selected disabled>Pilih Organisasi I</option>
                                        </select>
                                        <select id="ko_3" class="custom-select custom-select-sm m-r-10 col-2">
                                            <option selected disabled>Pilih Organisasi II</option>
                                        </select>
                                        <select id="ko_4" class="custom-select custom-select-sm m-r-10 col-2">
                                            <option selected disabled>Pilih Organisasi III</option>
                                        </select>
                                        <div class="input-group col-1">
                                            <label class="m-r-10">Fungsional</label>
                                            <input type="checkbox" id="sw_fungsional" switch="none" checked/>
                                                <label for="sw_fungsional" data-on-label="Ya"
                                                        data-off-label="Tidak"></label>
                                        </div>
                                        <div class="input-group col-1">
                                            <input id="blth" type="text" class="form-control" placeholder="dd/yyyy" value="<?php echo date('m/Y') ?>">
                                            <div class="input-group-append">
                                                <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                            </div>
                                        </div><!-- input-group -->

                                        <div class="text-right m-t-15">
                                            <button id="btn_cari" type="button" class="btn btn-primary waves-effect waves-light"><i class="ti-search"></i> Cari</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <div class="card m-t-30 m-b-30">
                            <div class="card-body">
                                <div style="width: 100%; height: 100%;" id="orgchart"></div>

                                <!-- Modal -->
                                <div class="modal fade" id="modal_detail" tabindex="-1" role="dialog" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content p-0" style="background-color: transparent; width:360px;">
                                            {{-- <div class="modal-header">
                                                <h5 class="modal-title">Modal title</h5>
                                                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                                                </button>
                                            </div> --}}
                                            <div class="modal-body p-0">
                                                {{-- <div class="card user-card4">
                                                    <div class="card-body">
                                                        <div class="text-center">
                                                            <img id="avatar" class="img-fluid rounded-circle mb-4 mt-4" src=""
                                                                alt="">
                                                            <h4 id="nama"></h4>
                                                            <h5 id="jabatan" class="text-muted"></h5>
                                                            <a href="javascript:void()" class="btn btn-outline-primary"><i class="ti-plus"></i>
                                                                Follow</a> <a href="javascript:void()" class="btn btn-outline-dark"><i class="ti-user"></i>
                                                                Profile</a>
                                                            <div class="social-icon3 social-icons-muted mt-4">
                                                                <ul>
                                                                    <li><a href="javascript:void()"><i class="fa fa-facebook"></i></a>
                                                                    </li>
                                                                    <li><a href="javascript:void()"><i class="fa fa-envelope"></i></a>
                                                                    </li>
                                                                    <li><a href="javascript:void()"><i class="fa fa-twitter"></i></a>
                                                                    </li>
                                                                    <li><a href="javascript:void()"><i class="fa fa-google-plus"></i></a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div> --}}
                                                <div class="card profile-card m-0">
                                                    <div class="box"><button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                                                </button>
                                                        <div class="img">
                                                            <img id="avatar" src="">
                                                        </div>
                                                        <h2><div id="nama">Ashiful Islam</div><br><span id="jabatan">Web Designer</span></h2>
                                                        <dl class="row text-left">
                                                          <dt class="col-sm-5">NIP</dt>
                                                          <dd id="nip" class="col-sm-7">XXXXX</dd>
                                                          <dt class="col-sm-5">TTL</dt>
                                                          <dd id="ttl" class="col-sm-7">XXXXX</dd>
                                                          <dt class="col-sm-5">GRADE</dt>
                                                          <dd id="grade" class="col-sm-7">XXXXX</dd>
                                                          <dt class="col-sm-5">JENJANG</dt>
                                                          <dd id="jenjang" class="col-sm-7">XXXXX</dd>
                                                          <dt class="col-sm-5">PENDIDIKAN</dt>
                                                          <dd id="pendidikan" class="col-sm-7">XXXXX</dd>
                                                        </dl>
                                                        <span>
                                                            <ul>
                                                                <li><a id="email" href="#" target="_blank"><i class="fas fa-envelope " aria-hidden="true"></i></a></li>
                                                                <li><a id="telepon" href="#" target="_blank"><i class="far fa-comments" aria-hidden="true"></i></a></li>
                                                                <li><a id="linkedin" href="#" target="_blank"><i class="fab fa-linkedin" aria-hidden="true"></i></a></li>
                                                                <li><a id="instagram" href="#" target="_blank"><i class="fab fa-instagram" aria-hidden="true"></i></a></li>
                                                                <li><a id="detail" href="#"><i class="fas fa-info-circle" aria-hidden="true"></i></a></li>
                                                            </ul>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>  
                    </div>
                </div>
                <!-- end row -->

                <div class="row">
                </div>

            </div> <!-- container-fluid -->
@endsection

@section('script')
        <script>
            // "global" vars, built using blade
            var photosUrl = '{{ URL::asset('assets/images/photos/') }}';

            $('#panel_pencarian').collapse();

            var prev_per_no = '<?php echo (isset($_POST["prev_per_no"]))?$_POST["prev_per_no"]:""; ?>';

        </script>
        <script src="{{ URL::asset('assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js')}}"></script>
        <script src="{{ URL::asset('assets/plugins/select2/js/select2.min.js')}}"></script>
        <script src="{{ URL::asset('assets/plugins/orgchart/orgchart.js')}}"></script>

		<script src="{{ URL::asset('assets/pages/orgchart.js')}}"></script>
@endsection
