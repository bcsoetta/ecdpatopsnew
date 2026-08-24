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
                                                <a href="" class="text-muted">Temporary Import</a>
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
                                                <i class="flaticon2-supermarket text-primary"></i>
                                            </span>
                                            <h3 class="card-label">DATA IMPOR SEMENTARA - PENUMPANG</h3>
                                        </div>
                                        <div class="card-toolbar">
                                            <!--begin::Button-->
                                            <button class="btn btn-sm btn-primary" id="add_valas">
                                                <i class="fa fa-plus"></i> NEW IS
                                            </button>
                                            <!--end::Button-->
                                        </div>
                                    </div>
                                    <!-- end card header -->
                                    <div class="card-body">
                                        <!-- search form -->
                                        <form name="searchValasForm">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="docNumber">Kata Kunci</label>
                                                        <input type="text" name="docNumber" class="form-control" id="docNumber" placeholder="Nomor/Nama/Negara" />
                                                    </div>  
                                                </div>
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
                                                <table class="table table-bordered">
                                                    <thead>
                                                        <tr class="text-center">
                                                            <!-- <th>No.</th> -->
                                                            <th>Nomor Lengkap</th>
                                                            <th>Tanggal Dok</th>
                                                            <th>Penumpang</th>
                                                            <th>Paspor</th>
                                                            <!-- <th>No. Flight</th> -->
                                                            <th>Status BPJ</th>
                                                            <th>Jangka Waktu IS</th>
                                                            <th>Status</th>
                                                            <th>Aksi</th>
                                                        </tr>
                                                        <tr class="d-none" template="searchResultRow">
                                                            <!-- <td view="number"></td> -->
                                                            <td view="docNumber"></td>
                                                            <td view="docDate"></td>
                                                            <td view="name"></td>
                                                            <td view="passport"></td>
                                                            <!-- <td view="flightNumber"></td> -->
                                                            <td class="text-center" view="bpjStatus"></td>
                                                            <td class="text-center" view="periode"></td>
                                                            <td view="status"></td>
                                                            <td>
                                                                <div class="dropdown dropdown-inline">
                                                                    <a href="javascript:;" class="btn btn-sm btn-clean btn-icon" data-toggle="dropdown">
                                                                        <i class="la la-cog"></i>
                                                                    </a>
                                                                    <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                                                                        <ul class="nav nav-hoverable flex-column">
                                                                            <li class="nav-item"><a class="nav-link" view="actionDetail" style="cursor: pointer;"><i class="nav-icon la la-eye"></i><span class="nav-text">Review</span></a></li>
                                                                            <li class="nav-item"><a class="nav-link" view="actionPrintIS" value="1" style="cursor: pointer;"><i class="nav-icon la la-print"></i><span class="nav-text">Form IS</span></a></li>
                                                                            <li class="nav-item"><a class="nav-link" view="actionPrint" value="0" style="cursor: pointer;"><i class="nav-icon la la-print"></i><span class="nav-text">Form Jaminan</span></a></li>
                                                                            <li class="nav-item"><a class="nav-link" view="actionPrintReturn" value="2" style="cursor: pointer;"><i class="nav-icon la la-print"></i><span class="nav-text">Form Pengembalian</span></a></li>
                                                                            <li class="nav-item"><a class="nav-link" view="actionConfirm" style="cursor: pointer;"><i class="nav-icon la la-edit"></i><span class="nav-text">Status</span></a></li>
                                                                            <li class="nav-item"><a class="nav-link" view="actionDelete" style="cursor: pointer;"><i class="nav-icon la la-remove"></i><span class="nav-text">Hapus</span></a></li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </td>
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

        <?php $this->load->view('aside/user');?>    
        <?php $this->load->view('aside/script');?>

        <!-- Modal for new valas -->
        <div class="modal fade" id="newModal" name="newModal" data-backdrop="static" style="overflow: scroll !important;">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <form name="newForm">
                        <div class="modal-header">
                            <h4 class="modal-title"><span view="title"></span> Input Impor Sementara - Penumpang</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-4" style="border-right: 1px dashed;">
                                    <fieldset class="form-group">
                                        <div class="row">
                                            <legend class="col-form-label col-sm-4 pt-0">Jenis Identitas</legend>
                                            <div class="col-sm-8">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="identityType" id="identityType1" value="1" required>
                                                    <label class="form-check-label" for="identityType1">
                                                        NPWP
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="identityType" id="identityType2" value="2" required>
                                                    <label class="form-check-label" for="identityType2">
                                                        KTP
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="identityType" id="identityType3" value="3" required>
                                                    <label class="form-check-label" for="identityType3">
                                                        Paspor
                                                    </label>
                                                </div>
                                            </div>
                                            <!-- end col -->
                                        </div>
                                        <!-- end row -->
                                    </fieldset>
                                    <div class="form-group">
                                        <label for="name">Nama Lengkap</label>
                                        <input type="text" name="name" class="form-control" id="name" />
                                    </div>
                                    <div class="form-group">
                                        <label for="address">Alamat Lengkap</label>
                                        <textarea name="address" class="form-control" id="address"></textarea>
                                    </div>  
                                    <div class="form-group">
                                        <label for="identity">Nomor Paspor</label>
                                        <input type="text" name="identity" class="form-control" id="identity" />
                                    </div>
                                    <h5>DATA SPONSOR</h5> <hr />
                                    <div class="form-group">
                                        <label for="sponsName">Nama Lengkap</label>
                                        <input type="text" name="sponsName" class="form-control" id="sponsName" />
                                    </div>
                                    <div class="form-group">
                                        <label for="sponsAddress">Alamat di Indonesia</label>
                                        <textarea name="sponsAddress" class="form-control" id="sponsAddress"></textarea>
                                    </div>  
                                    <div class="form-group">
                                        <label for="sponsPhone">Nomor Telepon</label>
                                        <input type="text" name="sponsPhone" class="form-control" id="sponsPhone" />
                                    </div>
                                    <div class="form-group">
                                        <label for="sponsNik">NIK</label>
                                        <input type="text" name="sponsNik" class="form-control" id="sponsNik" />
                                    </div>
                                    <div class="form-group">
                                        <label for="sponsLocation">Lokasi Penggunaan</label>
                                        <input type="text" name="sponsLocation" class="form-control" id="sponsLocation" />
                                    </div>
                                    <div class="form-group">
                                        <label for="sponsReason">Tujuan Penggunaan</label>
                                        <input type="text" name="sponsReason" class="form-control" id="sponsReason" />
                                    </div>
                                    <h5>Jaminan</h5> <hr />
                                    <fieldset class="form-group">
                                        <div class="row">
                                            <legend class="col-form-label col-sm-4 pt-0">Pengembalian</legend>
                                            <div class="col-sm-8">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="returnGuarantee" id="returnGuarantee1" value="1" required>
                                                    <label class="form-check-label" for="returnGuarantee1">
                                                        Diambil sendiri
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="returnGuarantee" id="returnGuarantee2" value="2" required>
                                                    <label class="form-check-label" for="returnGuarantee2">
                                                        Transfer bank
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="returnGuarantee" id="returnGuarantee3" value="3" required>
                                                    <label class="form-check-label" for="returnGuarantee3">
                                                        Sponsor
                                                    </label>
                                                </div>
                                            </div>
                                            <!-- end col -->
                                        </div>
                                        <!-- end row -->
                                    </fieldset>
                                </div>
                                <div class="col-md-8">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="airportIn">Bandara Masuk</label>
                                                <select class="form-control selectpicker" data-size="7" data-live-search="true" name="airportIn" id="airportIn" >
                                                    <option value="">-- Pilih --</option>
                                                    <?php
                                                    foreach ($office as $val) {?>
                                                    <option value="<?=$val['id'];?>" <?= ($val['id'] == 143) ? 'selected' : '' ;?> ><?=$val['name'];?></option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="invNumber">No. Invoice</label>
                                                <input type="text" name="invNumber" class="form-control" id="invNumber" />
                                            </div>
                                            <div class="form-group">
                                                <label for="invDate">Tanggal Invoice</label>
                                                <input type="text" name="invDate" class="form-control bc-date" id="invDate" />
                                            </div>
                                            <div class="form-group">
                                                <label for="carrierName">Nama & Nomor Sarana Pengangkut</label>
                                                <input type="text" name="carrierName" class="form-control" id="carrierName" />
                                            </div>
                                        </div>
                                        <!-- end col-md-6 -->
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="airportOut">Bandara Keluar</label>
                                                <select class="form-control selectpicker" data-size="7" data-live-search="true" name="airportOut" id="airportOut">
                                                    <option value="">-- Pilih --</option>
                                                    <?php
                                                    foreach ($office as $val) {?>
                                                    <option value="<?=$val['id'];?>" <?= ($val['id'] == 143) ? 'selected' : '' ;?>><?=$val['name'];?></option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div> 
                                            <div style="height: 64px; margin-bottom: 1.75rem;"></div>
                                            <div class="form-group">
                                                <label for="invDateOut">Perkiraan Tanggal Keluar</label>
                                                <input type="text" name="invDateOut" class="form-control bc-date" id="invDateOut" />
                                            </div>
                                            <div class="form-group">
                                                <label for="periode">Jangka Waktu Impor Sementara (Hari)</label>
                                                <input type="text" name="periode" class="form-control" id="periode" value="90" />
                                            </div>
                                        </div>
                                        <!-- end col-md-6 -->
                                    </div>
                                    <!-- end row --> 
                                    <hr /><h5>REKENING</h5> <hr />
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="accountNumber">Nomor</label>
                                                <input type="text" name="accountNumber" class="form-control" id="accountNumber" />
                                            </div>
                                            <div class="form-group">
                                                <label for="accountName">Name</label>
                                                <input type="text" name="accountName" class="form-control" id="accountName" />
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="accountBank">Bank</label>
                                                <input type="text" name="accountBank" class="form-control" id="accountBank" />
                                            </div>
                                        </div>
                                    </div>
                                    <!-- end row -->
                                    <div class="row">
                                        <div class="col-md-8">
                                            <h5>Data Barang</h5> <hr />
                                        </div>
                                        <div class="col-md-4">
                                            <button id="btnAddItem" type="button" class="btn btn-sm btn-success form-control"><i class="fa fa-plus"></i> Detail Barang</button>
                                        </div>
                                    </div>

                                    <table name="importTable" class="table table-striped table-hover table-bordered">
                                        <thead>
                                            <tr>
                                                <!-- <th>No.</th> -->
                                                <th>Nama Barang</th>
                                                <th>Jumlah</th>
                                                <th>HS Code & Tarif</th>
                                                <th>Nilai Pabean (CIF)</th>
                                                <th class="d-none">Pembebasan</th>
                                                <th>Jml BM PDRI</th>
                                                <th>Aksi</th>
                                            </tr>
                                            <tr class="d-none" template="importTableBody">
                                                <!-- <td view="imNumber"></td> -->
                                                <td view="imName"></td>
                                                <td view="imQty"></td>
                                                <td view="imHscode"></td>
                                                <td view="imPabean"></td>
                                                <td class="d-none" view="imFree"></td>
                                                <td view="imCollect"></td>
                                                <td>
                                                    <button view="actionItemDelete" class="btn btn-sm btn-danger"><i class="fa fa-minus"></i></button>
                                                </td>
                                            </tr>
                                        </thead>
                                        <tbody><!-- Appended by Ajax --></tbody>
                                    </table>
                                    <table name="importSummaryTable" class="table table-striped table-hover table-bordered">
                                        <tbody>
                                            <tr>
                                                <td colspan="2">Summary</td>
                                            </tr>
                                            <tr>
                                                <td>Total Bea Masuk</td>
                                                <td view="summBM"></td>
                                            </tr>
                                            <tr>
                                                <td>Total Ppn</td>
                                                <td view="summPpn"></td>
                                            </tr>
                                            <tr>
                                                <td>Total Pph Impor</td>
                                                <td view="summPph"></td>
                                            </tr>
                                            <tr>
                                                <td>Total Ppnbm Impor</td>
                                                <td view="summPpnbm"></td>
                                            </tr>
                                            <tr>
                                                <td>Total Denda Impor</td>
                                                <td view="summFine"></td>
                                            </tr>
                                            <tr>
                                                <td>Total Bea Masuk dan Pajak</td>
                                                <td view="summTotal"></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <!-- end col -->
                            </div>
                            <!-- end row -->
                        </div>
                        <!-- end modal-body -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-primary font-weight-bold">Selanjutnya</button>
                        </div>
                    </form>
                </div>
            <!-- end modal content -->
        </div>
        <!-- end modal dialog -->
        </div>

        <!-- modal add item -->
        <div class="modal fade" id="addItemModal" name="addItemModal" data-backdrop="static" style="overflow: scroll !important;">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <form name="addItemForm">
                    <div class="modal-header">
                        <h4 class="modal-title"><span view="title"></span> Tambah Detail Barang dan Pungutan</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="itemName">Nama Barang</label>
                                    <input type="text" name="itemName" class="form-control" id="itemName" />
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="itemTotal">Jumlah</label>
                                            <input type="text" name="itemTotal" class="form-control" id="itemTotal" />
                                        </div>
                                        <div class="form-group">
                                            <label for="itemBruto">Bruto</label>
                                            <input type="text" name="itemBruto" class="form-control" id="itemBruto" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="itemPackage">Kemasan</label>
                                            <select name="itemPackage" id="itemPackage" class="form-control selectpicker" data-size="7" data-live-search="true">
                                                <option value="">-- Pilih --</option>
                                                <?php
                                                foreach ($packages as $val) {?>
                                                <option value="<?=$val['id'];?>"><?=$val['name'];?></option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <!-- end col -->
                                </div>
                                <!-- end row in col-->
                                <div class="form-group">
                                    <label for="itemSpec">Spesifikasi/Identitas/Uraian</label>
                                    <textarea type="text" name="itemSpec" class="form-control" id="itemSpec"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="itemCom">Tag Komoditi</label>
                                    <select name="itemCom" id="itemCom" class="form-control selectpicker" data-size="7" data-live-search="true">
                                        <option value="">-- Pilih --</option>
                                        <?php
                                        foreach ($categories as $val) {?>
                                            <option value="<?=$val['id'];?>"><?=$val['name'];?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="itemCurrency">Mata Uang</label>
                                    <select name="itemCurrency" id="itemCurrency" class="form-control selectpicker" data-size="7" data-live-search="true">
                                        <option value="">-- Pilih --</option>
                                        <?php
                                        $kurs_usd = 0;
                                        foreach ($kurs as $val) {
                                            if ($val->kode_valas == 'USD') {
                                                $kurs_usd = $val->kurs_idr;
                                            }
                                        ?>
                                            
                                            <option value="<?=$val->kurs_idr;?>"><?=$val->kode_valas;?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="itemFob">FOB</label>
                                    <input type="text" name="itemFob" class="form-control" id="itemFob" value="0" />
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="itemFreight">Freight</label>
                                            <input type="text" name="itemFreight" class="form-control" id="itemFreight" value="0" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="itemInsurance">Insurance</label>
                                            <input type="text" name="itemInsurance" class="form-control" id="itemInsurance" value="0" />
                                        </div>
                                    </div>
                                </div>
                                <!-- end row in col -->
                                <div class="form-group">
                                    <label for="itemCif">CIF</label>
                                    <input type="text" name="itemCif" class="form-control" id="itemCif" value="0" readonly />
                                </div>
                                <div class="form-group">
                                    <label for="itemKurs">Kurs / NDPBM</label>
                                    <input type="text" name="itemKurs" class="form-control" id="itemKurs" value="0" readonly />
                                </div>
                                <div class="row d-none">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="itemFreeCurrency">Mata Uang</label>
                                            <select name="itemFreeCurrency" id="itemFreeCurrency" class="form-control selectpicker" data-size="7" data-live-search="true">
                                                <option value="0">-- Pilih --</option>
                                                <?php
                                                foreach ($kurs as $val) {
                                                ?>
                                                    <option value="<?=$val->kurs_idr;?>"><?=$val->kode_valas;?></option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="itemFree">Pembebasan</label>
                                            <input type="text" name="itemFree" class="form-control" id="itemFree" value-kurs="<?= $kurs_usd; ?>" value="0" />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="itemFreeIDR">IDR</label>
                                            <input type="text" name="itemFreeIDR" class="form-control" id="itemFreeIDR" value="0" readonly />
                                        </div>
                                    </div>
                                </div>
                                <!-- row of free -->
                                <div class="form-group">
                                    <label for="itemValue">Nilai Pabean (Rp)</label>
                                    <input type="text" name="itemValue" class="form-control" id="itemValue" value="0" readonly />
                                </div>
                            </div>
                            <!-- end col -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="itemCode">Pos Tarif HS Code</label>
                                    <select class="form-control selectpicker" data-size="7" data-live-search="true" name="itemCode" id="itemCode" >
                                        <option value="">-- Pilih --</option>
                                    </select>
                                    <!-- <textarea type="text" name="itemCode" class="form-control" id="itemCode"></textarea> -->
                                </div>
                                <!-- set other values but not for display-->
                                <input type="hidden" name="itemPosCode" id="itemPosCode"  />
                                <input type="hidden" name="itemPosDesc" id="itemPosDesc" />
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="itemPabeanIn">Bea masuk (%)</label>
                                            <input type="text" name="itemPabeanIn" class="form-control" id="itemPabeanIn" value="0" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="itemPabeanInIDR">IDR</label>
                                            <input type="text" name="itemPabeanInIDR" class="form-control" id="itemPabeanInIDR" value="0" readonly />
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="itemPpn">Ppn Impor (%)</label>
                                            <input type="text" name="itemPpn" class="form-control" id="itemPpn" value="0" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="itemPpnIDR">IDR</label>
                                            <input type="text" name="itemPpnIDR" class="form-control" id="itemPpnIDR" value="0" readonly />
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="itemPph">Pph Impor (%)</label>
                                            <input type="text" name="itemPph" class="form-control" id="itemPph" value="0" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="itemPphIDR">IDR</label>
                                            <input type="text" name="itemPphIDR" class="form-control" id="itemPphIDR" value="0" readonly />
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="itemPpnbm">PpnBM Impor (%)</label>
                                            <input type="text" name="itemPpnbm" class="form-control" id="itemPpnbm" value="0" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="itemPpnbmIDR">IDR</label>
                                            <input type="text" name="itemPpnbmIDR" class="form-control" id="itemPpnbmIDR" value="0" readonly />
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="itemFine">Denda (%)</label>
                                            <input type="text" name="itemFine" class="form-control" id="itemFine" value="0" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="itemFineIDR">IDR</label>
                                            <input type="text" name="itemFineIDR" class="form-control" id="itemFineIDR" value="0" readonly />
                                        </div>
                                    </div>
                                </div>
                                <!-- 
                                        <div class="form-group">
                                            <label for="itemFine">Denda (%)</label>
                                            <input type="text" name="itemFine" class="form-control" id="itemFine" value="0" />
                                        </div>
                                    </div>
                                </div>
                                 -->
                                <!-- end row in col -->
                                <div class="form-group">
                                    <label for="itemTotalCollect">Total Pungutan</label>
                                    <input type="text" name="itemTotalCollect" class="form-control" id="itemTotalCollect" readonly />
                                </div>
                                <div class="form-group">
                                    <label for="itemAttach">Lampiran</label>
                                    <input type="file" class="form-control" name="itemAttach1" id="itemAttach1" accept="image/png, image/gif, image/jpeg" />
                                    <input type="file" class="form-control" name="itemAttach2" id="itemAttach2" accept="image/png, image/gif, image/jpeg" />
                                    <input type="file" class="form-control" name="itemAttach3" id="itemAttach3" accept="image/png, image/gif, image/jpeg" />
                                </div>
                            </div>
                            <!-- end col -->
                        </div>
                        <!-- end row -->
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary font-weight-bold">Tambah</button>
                    </div>  
                    </form>
                </div>
                <!-- end modal content -->
            </div>
        </div>
        <!-- end new modal -->
        <!-- Guarantee modal -->
        <div class="modal fade" id="guaranteeModal" name="guaranteeModal" data-backdrop="static" style="overflow: scroll !important;">
            <div class="modal-dialog">
                <form name="guaranteeForm">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title"><span view="title"></span> Data Jaminan</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <fieldset class="form-group">
                                    <div class="row">
                                        <legend class="col-form-label col-sm-4 pt-0">Bentuk Jaminan</legend>
                                        <div class="col-sm-8">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="guaranteeType" id="guaranteeType1" value="1">
                                                <label class="form-check-label" for="guaranteeType1">
                                                    Tunai
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="guaranteeType" id="guaranteeType2" value="2">
                                                <label class="form-check-label" for="guaranteeType2">
                                                    Bank
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="guaranteeType" id="guaranteeType3" value="3">
                                                <label class="form-check-label" for="guaranteeType3">
                                                    Customs Bond
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="guaranteeType" id="guaranteeType4" value="4">
                                                <label class="form-check-label" for="guaranteeType4">
                                                    Lainnya
                                                </label>
                                            </div>
                                        </div>
                                        <!-- end col -->
                                    </div>
                                    <!-- end row -->
                                </fieldset>
                                <div class="form-group">
                                    <label for="guaranteeName">Penjamin</label>
                                    <input type="text" name="guaranteeName" class="form-control" id="guaranteeName" />
                                </div>
                                <div class="form-group">
                                    <label for="guaranteeAddress">Alamat Penjamin</label>
                                    <textarea type="text" name="guaranteeAddress" class="form-control" id="guaranteeAddress"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="guaranteeNominal">Jumlah Jaminan</label>
                                    <input type="text" name="guaranteeNominal" class="form-control" id="guaranteeNominal" readonly />
                                </div>
                                <!-- 
                                <div class="form-group">
                                    <label for="guaranteeNominalSpelling">Dengan Huruf</label>
                                    <textarea type="text" name="guaranteeNominalSpelling" class="form-control" id="guaranteeNominalSpelling"></textarea>
                                </div>
                                 -->
                                <div class="form-group">
                                    <label for="source">Dokumen Sumber Penyerahan Jaminan 	</label>
                                    <input type="text" name="source" class="form-control" id="source" />
                                </div>
                                <div class="form-group">
                                    <label for="sourceNumber">Nomor</label>
                                    <input type="text" name="sourceNumber" class="form-control" id="sourceNumber" />
                                </div>
                                <div class="form-group">
                                    <label for="sourceDate">Tanggal</label>
                                    <input type="text" name="sourceDate" class="form-control bc-date" id="sourceDate" />
                                </div>
                                <div class="form-group">
                                    <label for="treasurerName">Nama Bendahara</label>
                                    <input type="text" name="treasurerName" class="form-control" id="treasurerName" />
                                </div>
                                <div class="form-group">
                                    <label for="treasurerNip">NIP</label>
                                    <input type="text" name="treasurerNip" class="form-control" id="treasurerNip" />
                                </div>
                            </div>
                            <!-- end col -->
                        </div>
                        <!-- end row -->
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Tutup</button>
                        <button id="prepPage" type="button" class="btn btn-light-primary font-weight-bold">Sebelumnya</button>
                        <button type="submit" class="btn btn-primary font-weight-bold">Simpan</button>
                    </div>
                </div>
                </form>
            </div>
        </div>
        <!-- End Guarantee modal -->

        <!-- review modal -->
        <div class="modal fade" id="reviewModal" name="reviewModal" data-backdrop="static" style="overflow: scroll !important;">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Review IS <span view="title"></span></h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <h5>Data Pribadi</h5><hr />
                                <table class="table table-bordered">
                                    <tbody>
                                        <tr>
                                            <td>Jenis Identitas</td>
                                            <td class="text-center">:</td>
                                            <td><span view="identity_type"></span></td>
                                        </tr>
                                        <tr>
                                            <td>Nomor Identitas</td>
                                            <td class="text-center">:</td>
                                            <td><span view="identity_number"></span></td>
                                        </tr>
                                        <tr>
                                            <td>Nama</td>
                                            <td class="text-center">:</td>
                                            <td><span view="name"></span></td>
                                        </tr>
                                        <tr>
                                            <td>Alamat</td>
                                            <td class="text-center">:</td>
                                            <td><span view="address"></span></td>
                                        </tr>
                                    </tbody>
                                </table>
                                <h5>Data Jaminan</h5><hr />
                                <table class="table table-bordered">
                                    <tbody>
                                        <tr>
                                            <td>Pengembalian</td>
                                            <td class="text-center">:</td>
                                            <td><span view="return_type"></span></td>
                                        </tr>
                                    </tbody>
                                </table>
                                <h5>Data Sponsor</h5><hr />
                                <table class="table table-bordered">
                                    <tbody>
                                        <tr>
                                            <td>Lokasi Penggunaan</td>
                                            <td class="text-center">:</td>
                                            <td><span view="use_location"></span></td>
                                        </tr>
                                        <tr>
                                            <td>Tujuan Penggunaan</td>
                                            <td class="text-center">:</td>
                                            <td><span view="use_reason"></span></td>
                                        </tr>
                                        <tr>
                                            <td>Tamggal Perkiraan Keluar</td>
                                            <td class="text-center">:</td>
                                            <td><span view="date_out"></span></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <!-- end col md 6 -->
                            <div class="col-md-6">
                                <h5>Rekening</h5><hr />
                                <table class="table table-bordered">
                                    <tbody>
                                        <tr>
                                            <td>Nomor</td>
                                            <td class="text-center">:</td>
                                            <td><span view="account_number"></span></td>
                                        </tr>
                                        <tr>
                                            <td>Nama</td>
                                            <td class="text-center">:</td>
                                            <td><span view="account_name"></span></td>
                                        </tr>
                                        <tr>
                                            <td>Bank</td>
                                            <td class="text-center">:</td>
                                            <td><span view="account_bank"></span></td>
                                        </tr>
                                    </tbody>
                                </table>
                                <table class="table table-bordered">
                                    <tbody>
                                        <tr>
                                            <td>Bandara Masuk</td>
                                            <td class="text-center">:</td>
                                            <td><span view="airport_in"></span></td>
                                        </tr>
                                        <tr>
                                            <td>Bandara Keluar</td>
                                            <td class="text-center">:</td>
                                            <td><span view="airport_out"></span></td>
                                        </tr>
                                        <tr>
                                            <td>Nomor Invoice</td>
                                            <td class="text-center">:</td>
                                            <td><span view="inv_number"></span></td>
                                        </tr>
                                        <tr>
                                            <td>Tanggal Invoice</td>
                                            <td class="text-center">:</td>
                                            <td><span view="inv_date"></span></td>
                                        </tr>
                                        <tr>
                                            <td>Nama & Nomor Sarana Pengangkut</td>
                                            <td class="text-center">:</td>
                                            <td><span view="carrier"></span></td>
                                        </tr>
                                        <tr>
                                            <td>Jangka Waktu</td>
                                            <td class="text-center">:</td>
                                            <td><span view="periode"></span></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- end row -->
                        <div class="row">
                            <div class="col-md-12">
                                <h5>Data Barang</h5><hr />
                                <table name="reviewItems" class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <td>No</td>
                                            <td>Deskripsi barang</td>
                                            <td>Jumlah</td>
                                            <td>Nilai Barang</td>
                                            <td>Bea Masuk PDRI yang dijaminkan</td>
                                            <td>Lampiran</td>
                                        </tr>
                                        <tr class="d-none" template="reviewItemsBody">
                                            <td view="number"></td>
                                            <td view="desc"></td>
                                            <td view="qty"></td>
                                            <td view="itemValue"></td>
                                            <td view="total"></td>
                                            <td view="attach">
                                                <button view="itemFile" class="btn btn-sm btn-primary"><i class="fa fa-eye"></i></button>
                                            </td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <!-- appended by ajax -->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Tutup</button>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- image viewer -->
        <div class="modal fade" id="imageViewer" name="imageViewer" data-backdrop="static">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"><span class="card-icon">
                            <i class="flaticon2-supermarket text-primary"></i>
                        </span> Lampiran Data Barang</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <i aria-hidden="true" class="ki ki-close"></i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- <img style="max-width: 100%;" id="imageItem" /> -->
                        <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                            <div class="carousel-item d-none" template="carousel-img">
                                <img class="d-block w-100" src="">
                            </div>
                            <div class="carousel-inner">
                            </div>
                            <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Tutup</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- end image viewer -->
        
        <!-- modal update status -->
        <div class="modal fade" id="statusModal" name="statusModal" data-backdrop="static">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form name="statusForm">
                        <input type="hidden" name="headerID" />
                    <div class="modal-header">
                        <h4 class="modal-title"></span> UPDATE STATUS - PENYELESAIAN <span view="title"></h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <ul class="nav nav-tabs nav-bold nav-tabs-line">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#kt_tab_pane_1_4">
                                    <span class="nav-icon"><i class="fa fa-check-circle"></i></span>
                                    <span class="nav-text">SESUAI</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#kt_tab_pane_2_4">
                                    <span class="nav-icon"><i class="fa fa-minus-circle"></i></span>
                                    <span class="nav-text">TIDAK SESUAI</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#kt_tab_pane_3_4">
                                    <span class="nav-icon"><i class="fa fa-exclamation-circle"></i></span>
                                    <span class="nav-text">LEWAT JATUH TEMPO</span>
                                </a>
                            </li>
                        </ul>
            
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="kt_tab_pane_1_4" role="tabpanel" aria-labelledby="kt_tab_pane_1_4">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="reOffice">Kantor Re-ekspor</label>
                                            <select class="form-control selectpicker" data-size="7" data-live-search="true" name="reOffice" id="reOffice" >
                                                <option value="">-- Pilih --</option>
                                                <?php
                                                foreach ($office as $val) {?>
                                                <option value="<?=$val['id'];?>" <?= ($val['id'] == 143) ? 'selected' : '' ;?> ><?=$val['name'];?></option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="reDate">Tanggal Re-ekspor</label>
                                            <input id="reDate" name="reDate" class="form-control bc-date" />
                                        </div>
                                        <div class="form-group">
                                            <label for="reDocNumber">Nomor Dokumen</label>
                                            <input id="reDocNumber" name="reDocNumber" class="form-control" />
                                        </div>
                                        <div class="form-group">
                                            <label for="reName">Nama Penerima</label>
                                            <input id="reName" name="reName" class="form-control" />
                                        </div>
                                        <div class="form-group">
                                            <label for="reNotes">Catatan</label>
                                            <textarea id="reNotes" name="reNotes" class="form-control"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="reAttach1">Lampiran</label>
                                            <input type="file" class="form-control" name="reAttach1" id="reAttach1" accept="image/png, image/gif, image/jpeg" />
                                            <input type="file" class="form-control" name="reAttach2" id="reAttach2" accept="image/png, image/gif, image/jpeg" />
                                            <input type="file" class="form-control" name="reAttach3" id="reAttach3" accept="image/png, image/gif, image/jpeg" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="kt_tab_pane_2_4" role="tabpanel" aria-labelledby="kt_tab_pane_2_4">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="reNotesNOK">Catatan</label>
                                            <textarea id="reNotesNOK" name="reNotesNOK" class="form-control"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="reAttachNOK1">Lampiran</label>
                                            <input type="file" class="form-control" name="reAttachNOK1" id="reAttachNOK1" accept="image/png, image/gif, image/jpeg" />
                                            <input type="file" class="form-control" name="reAttachNOK2" id="reAttachNOK2" accept="image/png, image/gif, image/jpeg" />
                                            <input type="file" class="form-control" name="reAttachNOK3" id="reAttachNOK3" accept="image/png, image/gif, image/jpeg" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="kt_tab_pane_3_4" role="tabpanel" aria-labelledby="kt_tab_pane_3_4">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="reDocNumberLJT">Nomor Dokumen</label>
                                            <input id="reDocNumberLJT" name="reDocNumberLJT" class="form-control" />
                                        </div>
                                        <div class="form-group">
                                            <label for="reDateLTJ">Tanggal</label>
                                            <input id="reDateLTJ" name="reDateLTJ" class="form-control bc-date" />
                                        </div>
                                        <div class="form-group">
                                            <label for="reNotesLJT">Catatan</label>
                                            <textarea id="reNotesLJT" name="reNotesLJT" class="form-control"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="reAttachLJT1">Lampiran</label>
                                            <input type="file" class="form-control" name="reAttachLJT1" id="reAttachLJT1" accept="image/png, image/gif, image/jpeg" />
                                            <input type="file" class="form-control" name="reAttachLJT2" id="reAttachLJT2" accept="image/png, image/gif, image/jpeg" />
                                            <input type="file" class="form-control" name="reAttachLJT3" id="reAttachLJT3" accept="image/png, image/gif, image/jpeg" />
                                        </div>
                                    </div>
                                </div> 
                            </div>
                        </div>
                        <!-- end tab content -->
                    </div>
                    <!-- end modal body -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary font-weight-bold" >Simpan</button>
                    </div>
                    </form>
                </div>
             </div>
        </div>
        <!-- modal update status -->

        <!-- modal confirm -->
        <div class="modal fade" id="confirmModal" name="confirmModal" data-backdrop="static">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title"><span view="title"></span> KONFIRMASI</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <p>Sebelum proses simpan, anda akan ditampilkan data-data sebelumnya yang telah anda isi.</p>
                        <p><b>Ubah data jika ada yang tidak sesuai, dan tekan simpan kembali jika anda sudah yakin.</b></p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Tutup</button>
                        <button type="button" name="confirmYes" class="btn btn-primary font-weight-bold" >Ya</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- end modal -->

        <!-- modal delete -->
        <div class="modal fade" id="deleteModal" name="deleteModal" data-backdrop="static">
            <div class="modal-dialog">
                <div class="modal-content bg-danger">
                    <input type="hidden" name="valasID">
                    <div class="modal-header">
                        <h4 class="modal-title"><span view="title"></span> KONFIRMASI</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <p>Apakah anda yakin akan menghapus data dengan no dokumen <b><span view="deleteModalDocNumber"></span></b> ?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Tutup</button>
                        <button type="button" name="confirmDelete" class="btn btn-primary font-weight-bold" >Ya</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- end modal -->

        <script src="<?=base_url('assets/js/app.import.js'); ?>"></script>
    </body>
</html>
