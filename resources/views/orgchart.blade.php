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

                <div id="accordion" class="row">
                    <div class="col-lg-12">
                        <div id="panel_pencarian" class="card m-t-30 m-b-30">
                          <div class="card-header">
                            <a class="card-link" data-toggle="collapse" href="#collapseOne">
                              Kriteria Pencarian
                            </a>
                          </div>
                          <div id="collapseOne" class="collapse show" data-parent="#accordion">
                            <div class="card-body">
                              <form >
                                    <div class="form-row">
                                        <div class="form-group col-md-3 col-lg-3 col-sm-12">
                                            <input id="prev_per_no_cari" type="text" class="form-control typeahead" autocomplete="off" spellcheck="false" " placeholder="NIP / Nama Pegawai">
                                        </div>
                                        <input type="hidden" id="prev_per_no" name="prev_per_no" value="<?php echo (isset($_POST['prev_per_no']))? $_POST['prev_per_no']:'' ?>">

                                        <div class="form-group col-md-3 col-lg-3 col-sm-12">
                                            <div class="input-group">
                                                <label class="m-r-10">Periode:</label>
                                                <input id="blth" type="text" class="form-control form-control-sm" placeholder="dd/yyyy" value="<?php echo date('m/Y') ?>" />
                                                <div class="input-group-append">
                                                    <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-3 col-lg-3 col-sm-12">
                                            <div class="input-group">
                                                <label class="m-r-10">Berikut Fungsional?</label>
                                                <input type="checkbox" id="sw_fungsional" switch="none" checked/>
                                                    <label for="sw_fungsional" data-on-label="Ya"
                                                            data-off-label="Tidak"></label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-3 col-lg-3 col-sm-12">
                                            <select id="ko_2" class="custom-select custom-select-sm">
                                                <option selected disabled>Pilih Organisasi I</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-3 col-lg-3 col-sm-12">
                                            <select id="ko_3" class="custom-select custom-select-sm">
                                                <option selected disabled>Pilih Organisasi II</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-3 col-lg-3 col-sm-12">
                                            <select id="ko_4" class="custom-select custom-select-sm">
                                                <option selected disabled>Pilih Organisasi III</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-3 col-lg-3 col-sm-12">
                                            <select id="ko_5" class="custom-select custom-select-sm">
                                                <option selected disabled>Pilih Organisasi IV</option>
                                            </select>
                                        </div>
                                    </div>
                                </form>
                                <div class="text-right m-t-10">
                                    <button id="btn_cari" type="button" class="btn btn-primary waves-effect waves-light"><i class="ti-search"></i> Cari</button>
                                </div>
                            </div>
                          </div>
                        </div>
                    </div> 
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <div class="card m-b-10">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-9 col-sm-9 p-10">
                                        <div style="width: 100%; height: 560px;" id="orgchart"></div>
                                    </div>
                                    <div class="col-3 col-sm-3 p-10">
                                        <div class="profile-card hidden">
                                            <div class="box">
                                                <div class="img">
                                                    <img id="avatar" src="{{ URL::asset('assets/images/users/') }}/blank-avatar.jpg">
                                                </div>
                                                <h2><div id="nama">&nbsp;</div><br><span id="jabatan"></span></h2>
                                                <dl class="row text-left">
                                                  <dt class="col-sm-5">NIP</dt>
                                                  <dd id="nip" class="col-sm-7">&nbsp;</dd>
                                                  <dt class="col-sm-5">TTL</dt>
                                                  <dd id="ttl" class="col-sm-7">&nbsp;</dd>
                                                  <dt class="col-sm-5">GRADE</dt>
                                                  <dd id="grade" class="col-sm-7">&nbsp;</dd>
                                                  <dt class="col-sm-5">JENJANG</dt>
                                                  <dd id="jenjang" class="col-sm-7">&nbsp;</dd>
                                                  <dt class="col-sm-5">STUDI</dt>
                                                  <dd id="pendidikan" class="col-sm-7">&nbsp;</dd>
                                                  <dt class="col-sm-5">UNIT</dt>
                                                  <dd id="unit" class="col-sm-7">&nbsp;</dd>
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

                                                <button id="btn_kandidat" type="button" class="btn btn-primary waves-effect waves-light"><i class="ti-search"></i> Cari Kandidat</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 p-10">
                                        <div class="legend">
                                            <h6><span class="badge badge-primary">
                                                <i class="mdi mdi-account-multiple"></i>
                                            &nbsp;FTK Realisasi/Pagu:&nbsp;</span></h6>
                                            <span id="ftk"></span>
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
        <script src="{{ URL::asset('assets/plugins/moment/moment.js')}}"></script>
        <script src="{{ URL::asset('assets/plugins/moment/moment-with-locales.min.js')}}"></script>

        <script src="{{ URL::asset('assets/pages/orgchart.js')}}"></script>
@endsection
