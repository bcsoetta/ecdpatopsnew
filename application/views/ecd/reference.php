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
                        <!--begin::Subheader-->
                        <div class="subheader py-2 py-lg-6 subheader-solid" id="kt_subheader">
                            <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
                                <!--begin::Info-->
                                <div class="d-flex align-items-center flex-wrap mr-1">
                                    <!--begin::Page Heading-->
                                    <div class="d-flex align-items-baseline flex-wrap mr-5">
                                        <!--begin::Page Title-->
                                        <h5 class="text-dark font-weight-bold my-1 mr-5">PATOPS</h5>
                                        <!--end::Page Title-->
                                        <!--begin::Breadcrumb-->
                                        <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                                            <li class="breadcrumb-item text-muted">
                                                <a href="" class="text-muted">Applcations</a>
                                            </li>
                                            <li class="breadcrumb-item text-muted">
                                                <a href="" class="text-muted">ECD</a>
                                            </li>
                                            <li class="breadcrumb-item text-muted active">
                                                <a href="" class="text-muted">Tabel Referensi</a>
                                            </li>
                                        </ul>
                                        <!--end::Breadcrumb-->
                                    </div>
                                    <!--end::Page Heading-->
                                </div>
                                <!--end::Info-->
                            </div>
                        </div>
                        <!--end::Subheader-->
                        <!--begin::Entry-->
                        <div class="d-flex flex-column-fluid">
                            <!--begin::Container-->
                            <div class="container">
                                <!--begin::Card-->
                                <div class="card card-custom">
                                    <div class="card-header">
                                        <div class="card-title">
                                            <span class="card-icon">
                                                <i class="fa fa-table text-primary"></i>
                                            </span>
                                            <h3 class="card-label">Electronic CD - Tabel Referensi</h3>
                                        </div>
                                        <div class="card-toolbar">
                                            <!--begin::Button-->
                                            <button class="btn btn-sm btn-primary" id="add_atensi">
                                                <i class="fa fa-plus"></i> Tambah Atensi
                                            </button>
                                            <!--end::Button-->
                                        </div>
                                    </div>
                                    <!-- end card header -->
                                    <div class="card-body">
                                        <!-- search form -->
                                        <form name="searchForm">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="dateFrom">Dari</label>
                                                        <div class="input-group mb-3">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text" id="basic-addon1"><i class="fa fa-calendar"></i></span>
                                                            </div>
                                                            <input type="text" name="dateFrom" class="form-control bc-date" id="dateFrom" />
                                                        </div>
                                                        
                                                    </div>  
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="dateUntil">Sampai</label>
                                                        <div class="input-group mb-3">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text" id="basic-addon1"><i class="fa fa-calendar"></i></span>
                                                            </div>
                                                            <input type="text" name="dateUntil" class="form-control bc-date" id="dateUntil" />
                                                        </div>
                                                    </div>  
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="flightNumber">Kata Kunci</label>
                                                        <input type="text" name="flightNumber" class="form-control" id="flightNumber" placeholder="nama/paspor/dokumen" />
                                                    </div>  
                                                </div>
                                                <div class="col-md-1">&nbsp;</div>
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label>&nbsp;</label>
                                                        <button type="submit" class="btn btn-primary form-control"><i class="fa fa-search"></i></button>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- end row in card header -->
                                        </form>
                                        <div class="d-none" name="searchResult">
                                            <div class="card">
                                                <table class="table table-bordered table-striped">
                                                    <thead>
                                                        <tr class="text-center">
                                                            <th>No</th>
                                                            <th>Nama</th>
                                                            <th>Paspor</th>
                                                            <th>Tgl Lahir</th>
                                                            <th>Jenis Dokumen</th>
                                                            <th>No Dokumen</th>
                                                            <th>Tgl Dokumen</th>
                                                        </tr>
                                                        <tr class="d-none" template="searchResultRow">
                                                            <td class="text-center" view="number"></td>
                                                            <td class="text-center" view="name"></td>
                                                            <td class="text-center" view="passport"></td>
                                                            <td class="text-center" view="birthDate"></td>
                                                            <td class="text-center" view="docType"></td>
                                                            <td class="text-center" view="docNumber"></td>
                                                            <td class="text-center" view="docDate"></td>
                                                        </tr>
                                                    </thead>
                                                    <tbody><!-- Appended by Ajax --></tbody>
                                                </table>
                                            </div>
                                            
                                            <div class="text-center">
                                                <div class="btn-group" role="group" name="searchNav">
                                                    <button type="button" class="btn btn-primary" name="prev"><span aria-hidden="true" class="fa fa-chevron-left"></span></button>
                                                    <button type="button" class="btn btn-default">Halaman <span name="page"></span></button>
                                                    <button type="button" class="btn btn-primary" name="next"><span aria-hidden="true" class="fa fa-chevron-right"></span></button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- end body -->
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
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-success">
                        <h4 class="modal-title">
                        <span class="card-icon text-white">
                            <img style="width: 40px;" src="assets/media/logos/bc_logo.png" />
                            History Data Barang
                        </span>
                        </h4>
                        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">&times;</button>
                    </div>
                    <div class="modal-body">
                        <h4>Detail Barang</h4><hr />
                        <table name="detail_goods" class="table table-bordered table-sm">
                            <thead>
                                <tr>
                                    <th class="text-center" scope="col">No</th>
                                    <th class="text-center" scope="col">Uraian Barang</th>
                                    <th class="text-center" scope="col">Jumlah Barang</th>
                                    <th class="text-center" scope="col">Satuan Barang</th>
                                    <th class="text-center" scope="col">Total Pungutan (Rp)</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Tutup</button>
                    </div>
                </div>
                <!-- end modal content -->
            </div>
            <!-- end modal dialog -->
        </div>
        <!-- end modal detail -->

        <!-- add new -->
        <div class="modal fade" id="addModal" name="addModal" data-backdrop="static" style="overflow: scroll !important;">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-success">
                        <h4 class="modal-title">
                        <span class="card-icon text-white">
                            <img style="width: 40px;" src="assets/media/logos/bc_logo.png" />
                            Tambah Atensi
                        </span>
                        </h4>
                        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">&times;</button>
                    </div>
                    <form name="atensiForm">
                    <div class="modal-body">
                        <div class="form-group mb-3">
                            <label for="newName">Nama Penumpang</label>
                            <input placeholder="Nama Penumpang" type="text" name="newName" class="form-control" id="newName" required />
                        </div>
                        <div class="form-group mb-3">
                            <label for="newPaspor">Paspor</label>
                            <input type="text" name="newPaspor" class="form-control" id="newPaspor" required />
                        </div>
                        <div class="form-group mb-3">
                            <label for="newBirth">Tanggal Lahir</label>
                            <input type="text" name="newBirth" class="form-control bc-date" id="newBirth" required />
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group mb-3">
                                    <label for="newDocNumber">No Dokumen</label>
                                    <input type="text" name="newDocNumber" class="form-control" id="newDocNumber" value="Otomatis" readonly />
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group mb-3">
                                    <label for="newDocType">Jenis Dokumen</label>
                                    <select name="newDocType" id="newDocType" class="form-control selectpicker" data-live-search="false" required>
                                        <option value="NPP">NPP</option>
                                        <option value="HVG">HVG</option>
                                        <option value="JASTIP">JASTIP</option>
                                        <option value="TPPU">TPPU</option>
                                        <option value="CITES">CITES</option>
                                        <option value="TERORISME">TERORISME</option>
                                        <option value="SENJATA API">SENJATA API</option>
                                        <option value="LAINNYA">LAINNYA</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <label for="newDocDate">Tanggal Dokumen</label>
                            <input type="text" name="newDocDate" class="form-control" id="newDocDate" value="<?=date('Y-m-d');?>" readonly />
                        </div>
                        <div class="form-group mb-3">
                            <label for="newDesc">Uraian atensi</label>
                            <textarea type="text" name="newDesc" class="form-control" id="newDesc" required></textarea>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group mb-3 d-none">
                                    <label for="newQty">Jumlah Barang</label>
                                    <input type="text" name="newQty" class="form-control" id="newQty" value="0" />
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group mb-3 d-none">
                                    <label for="newType">Satuan</label>
                                    <select name="newType" id="newType" class="form-control">
                                        <option value="">-- Pilih --</option>
                                        <option value="PCE">PCE</option>
                                        <option value="SET">SET</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group mb-3 d-none">
                            <label for="newTotal">Total Pungutan</label>
                            <input type="text" name="newTotal" class="form-control" id="newTotal" value="0" />
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-light-primary font-weight-bold">Simpan</button>
                    </div>
                </form>
                </div>
                <!-- end modal content -->
            </div>
            <!-- end modal dialog -->
        </div>
        <!-- end add new -->

        <?php $this->load->view('aside/user');?>    
        <?php $this->load->view('aside/script');?>
        <script src="<?=base_url('assets/js/app.ecd_reference.js'); ?>"></script>
    </body>
</html>
