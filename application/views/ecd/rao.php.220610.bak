<!DOCTYPE html>
<html lang="en">
    <?php $this->load->view('aside/head');?>
    <!--begin::Body-->
    <body id="kt_body" class="header-fixed header-mobile-fixed subheader-enabled subheader-fixed aside-enabled aside-fixed aside-minimize-hoverable page-loading">
    
    <!--begin::Main-->
        <!--begin::Header Mobile-->
        <div id="kt_header_mobile" class="header-mobile align-items-center header-mobile-fixed">
            <!--begin::Logo-->
            <a href="<?=base_url()?>">
                <img alt="Logo" src="<?=base_url('./assets/media/logos/logo-light.png')?>" />
            </a>
            <!--end::Logo-->
            <!--begin::Toolbar-->
            <div class="d-flex align-items-center">
                <!--begin::Aside Mobile Toggle-->
                <button class="btn p-0 burger-icon burger-icon-left" id="kt_aside_mobile_toggle">
                    <span></span>
                </button>
                <!--end::Aside Mobile Toggle-->
                <!--begin::Header Menu Mobile Toggle-->
                <button class="btn p-0 burger-icon ml-4" id="kt_header_mobile_toggle">
                    <span></span>
                </button>
                <!--end::Header Menu Mobile Toggle-->
                <!--begin::Topbar Mobile Toggle-->
                <button class="btn btn-hover-text-primary p-0 ml-2" id="kt_header_mobile_topbar_toggle">
                    <span class="svg-icon svg-icon-xl">
                        <!--begin::Svg Icon | path:assets/media/svg/icons/General/User.svg-->
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <polygon points="0 0 24 0 24 24 0 24" />
                                <path d="M12,11 C9.790861,11 8,9.209139 8,7 C8,4.790861 9.790861,3 12,3 C14.209139,3 16,4.790861 16,7 C16,9.209139 14.209139,11 12,11 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />
                                <path d="M3.00065168,20.1992055 C3.38825852,15.4265159 7.26191235,13 11.9833413,13 C16.7712164,13 20.7048837,15.2931929 20.9979143,20.2 C21.0095879,20.3954741 20.9979143,21 20.2466999,21 C16.541124,21 11.0347247,21 3.72750223,21 C3.47671215,21 2.97953825,20.45918 3.00065168,20.1992055 Z" fill="#000000" fill-rule="nonzero" />
                            </g>
                        </svg>
                        <!--end::Svg Icon-->
                    </span>
                </button>
                <!--end::Topbar Mobile Toggle-->
            </div>
            <!--end::Toolbar-->
        </div>
        <!--end::Header Mobile-->
        <div class="d-flex flex-column flex-root">
            <div class="d-flex flex-row flex-column-fluid page">
                <?php $this->load->view('aside/menu');?>
                <!--begin::Wrapper-->
                <div class="d-flex flex-column flex-row-fluid wrapper" id="kt_wrapper">
                    <?php $this->load->view('aside/topbar');?>
                    <!--begin::Content-->
                    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
                        <!--begin::Entry-->
                        <div class="d-flex flex-column-fluid">
                            <!--begin::Container-->
                            <div class="container" style="margin-top: -70px;">
                                <!--begin::Card-->
                                <div class="card card-custom">
                                    <div class="card-header  bc-bg-green">
                                        <div class="card-title">
                                            <span class="card-icon text-white">
                                                <img style="width: 40px;" src="assets/media/logos/bc_logo.png" />
                                                E - Customs Declaration - soekarno hatta
                                            </span>
                                            
                                        </div>
                                        <div class="card-toolbar">
                                            <input type="text" name="qrcode" class="form-control" id="qrcode" placeholder="QR Code Number" />
                                        </div>
                                    </div>
                                    <!-- end card header -->
                                    <div name="bc-data" class="card-body d-none">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <h4>Data Personal</h4><hr />
                                                <div class="mb-3">
                                                    <label for="fullName" class="form-label">Nama Lengkap</label>
                                                    <input type="text" class="form-control" id="fullName" name="fullName" readonly />
                                                </div>
                                                <div class="mb-3">
                                                    <label for="birth" class="form-label">Tanggal Kelahiran</label>
                                                    <input type="text" class="form-control" id="birth" name="birth" readonly />
                                                </div>
                                                <div class="mb-3">
                                                    <label for="occupation" class="form-label">Pekerjaan</label>
                                                    <input type="text" class="form-control" id="occupation" name="occupation" readonly />
                                                </div>
                                                <div class="mb-3">
                                                    <label for="nationality" class="form-label">Kebangsaan</label>
                                                    <input type="text" class="form-control" id="nationality" name="nationality" readonly />
                                                </div>
                                                <div class="mb-3">
                                                    <label for="passport" class="form-label">Nomor Paspor</label>
                                                    <input type="text" class="form-control" id="passport" name="passport" readonly />
                                                </div>
                                                <div class="mb-3">
                                                    <label for="address" class="form-label">Alamat di Indonesia</label>
                                                    <textarea type="text" class="form-control" id="address" name="address" readonly></textarea>
                                                </div>
                                                <!-- 
                                                <div class="mb-3">
                                                    <button name="btnPersonalDetail" type="button" class="btn btn-primary float-right btn-sm">Detail</button>
                                                </div>
                                                -->
                                                <h4>Informasi Keluarga</h4><hr />
                                                <table name="familyTable" class="table table-bordered table-sm">
                                                    <thead>
                                                        <tr>
                                                            <th class="text-center" scope="col">No</th>
                                                            <th class="text-center" scope="col">Nama</th>
                                                            <th class="text-center" scope="col">Tgl Lahir</th>
                                                            <th class="text-center" scope="col">Paspor</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody></tbody>
                                                </table>
                                            </div>
                                            <!-- end col md 3 -->
                                            <div class="col-md-6">
                                                <h4>Jumlah Bagasi</h4><hr />
                                                <div class="row">
                                                    <div class="col-md-6">bersamaan <b><span view="baggage_in"></span> Pkg</b></div>
                                                    <div class="col-md-6">tidak bersamaan <b><span view="baggage_ex"></span> Pkg</b></div>
                                                </div>
                                                <hr />
                                                <h4>Pemberitahuan / Declare</h4><hr />
                                                <table name="tableDeclare">
                                                    <!-- 
                                                    <tr>
                                                        <td style="vertical-align: top;">1.</td><td>uang dan/atau instrumen pembayaran lainnya dalam bentuk cek, cek perjalanan, surat sanggup bayar, atau bilyet giro, dalam rupiah atau dalam mata uang asing senilai Rp100.000.000,00 (seratus juta rupiah) atau lebih, atau</td>
                                                    </tr>
                                                    <tr>
                                                        <td style="vertical-align: top;">2.</td><td>uang kertas asing paling sedikit setara dengan Rp1.000.000.000,00 (satu milyar rupiah).</td>
                                                    </tr>
                                                    -->
                                                </table>
                                                <hr />
                                                <h4>Detail Barang</h4><hr />
                                                <table name="detail_goods" class="table table-bordered table-sm">
                                                    <thead>
                                                        <tr>
                                                            <th class="text-center" scope="col">No</th>
                                                            <th class="text-center" scope="col">Uraian Barang</th>
                                                            <th class="text-center" scope="col">Jumlah</th>
                                                            <th class="text-center" scope="col">Nilai</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody></tbody>
                                                </table>
                                                <hr />
                                                <h4>Riwayat Pemeriksaan</h4><hr />
                                                <table name="historyTable" class="table table-bordered table-sm">
                                                    <thead>
                                                        <tr>
                                                            <th class="text-center" scope="col">No</th>
                                                            <th class="text-center" scope="col">Jenis Dok</th>
                                                            <th class="text-center" scope="col">Tanggal Dok</th>
                                                            <th class="text-center" scope="col">Barang</th>
                                                            <th class="text-center" scope="col">Total Pungutan</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody></tbody>
                                                </table>
                                            </div>
                                            <!-- end div col md 6 -->
                                            <div class="col-md-3">
                                                <h4>Pesawat / Tgl Kedatangan</h4>
                                                <div class="card text-white text-center bc-bg-black">
                                                    <span class="pt-3 bc-font-flight" view="flight"></span>
                                                    <span class="pb-3" view="arrival"></span>
                                                </div>

                                                <h3 class="mt-3">Penjaluran</h3>
                                                <div view="detail-zone" class="card bc-bg-green text-white text-center">
                                                    <span view="detail-zone-text" class="pt-5 pb-5">HIJAU</span>
                                                </div>

                                                <h3 class="mt-3">Intercept RAO</h3>
                                                <div view="detail-change-zone" class="card bc-bg-red text-center">
                                                    <span class="pt-5 pb-5 text-white"><i class="fa fa-bullseye text-white"></i> Ubah Merah</span>
                                                </div>
                                            </div>
                                            <!-- end div col md 3 -->
                                        </div>
                                        <!-- end row -->
                                    </div>
                                    <!-- end body -->
                                    <div name="bc-none" class="card-body">
                                        <div class="alert alert-danger" role="alert">
                                            Tidak ada data ditemukan, silahkan scan ulang!
                                        </div>
                                    </div>
                                </div>
                                <!-- end card-->
                            </div>
                        </div>
                    </div>
                    <!-- end content -->
                    <?php $this->load->view('aside/foot');?>
                </div>
                <!-- end wrapper -->
            </div>
            <!-- end page -->
        </div>


        <!-- modal detail -->
        <div class="modal fade" id="detailModal" name="detailModal" data-backdrop="static" style="overflow: scroll !important;">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header bg-success"> 
                        <div class="row">
                            <div class="col-1 text-right"><img style="width: 100%;" src="assets/media/logos/bc_logo.png" /></div>
                            <div class="col-6 text-white"><h4 class="modal-title text-white">E - Customs Declaration</h4>Soekarno Hatta</div>
                            <!-- <div class="col-5"><input type="text" name="qrcode" class="form-control" id="qrcode" placeholder="QR Code Number" /></div> -->
                        </div>   
                    </div>
                    <div class="modal-body">
                        
                    </div>
                    <!-- 
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Tutup</button>
                    </div>
                     -->
                </div>
                <!-- end modal content -->
            </div>
            <!-- end modal dialog -->
        </div>
        <!-- end modal detail -->
        
        <!-- modal personal detail -->
        <!-- 
        <div class="modal fade" id="personalDetailModal" name="personalDetailModal" data-backdrop="static" style="overflow: scroll !important;">
            <div class="modal-dialog">
                <div class="modal-content bg-dark text-white">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="arrival" class="form-label">Tanggal Kedatangan</label>
                            <input type="text" class="form-control" id="arrival" name="arrival" readonly />
                        </div>
                        <div class="mb-3">
                            <label for="baggage_in" class="form-label">Jumlah bagasi yang dibawa</label>
                            <input type="text" class="form-control" id="baggage_in" name="baggage_in" readonly />
                        </div>
                        <div class="mb-3">
                            <label for="baggage_ex" class="form-label">Jumlah bagasi yang datang tidak bersamaan</label>
                            <input type="text" class="form-control" id="baggage_ex" name="baggage_ex" />
                        </div>
                        <div class="mb-3">
                            <label for="family_num" class="form-label">Informasi Keluarga</label>
                            <input type="text" class="form-control" id="family_num" name="family_num" />
                        </div>
                        <table name="familyTable" class="table table-striped table-sm table-dark">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">Nomor Paspor</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Tutup</button>
                    </div>
                </div>
            </div>
        </div>
        -->
        <!-- end modal personal detail -->
        
        <?php $this->load->view('aside/user');?>    
        <?php $this->load->view('aside/script');?>
        <script src="<?=base_url('assets/js/app.ecd_rao.js'); ?>"></script>
    </body>
</html>
