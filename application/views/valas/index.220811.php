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
                                                <a href="" class="text-muted">Valas</a>
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
                                            <h3 class="card-label">DATA PEMBAWAAN MATA UANG - KEDATANGAN</h3>
                                        </div>
                                        <div class="card-toolbar">
                                            <!--begin::Button-->
                                            <button class="btn btn-sm btn-primary" id="add_valas">
                                                <i class="fa fa-plus"></i> NEW VALAS
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
                                                            <input type="text" name="dateFrom" class="form-control" id="dateFrom" />
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
                                                            <input type="text" name="dateUntil" class="form-control" id="dateUntil" />
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
                                                <table class="table table-striped table-hover table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th>No.</th>
                                                            <th>Nomor Lengkap</th>
                                                            <th>Tanggal Kedatangan</th>
                                                            <th>Penumpang</th>
                                                            <th>Paspor</th>
                                                            <!-- <th>Lokasi</th> -->
                                                            <th>No. Flight</th>
                                                            <!-- <th>Nominal Pembawaan</th> -->
                                                            <th>Negara Asal</th>
                                                            <th>Status</th>
                                                            <th>Aksi</th>
                                                        </tr>
                                                        <tr class="d-none" template="searchResultRow">
                                                            <td view="number"></td>
                                                            <td view="docNumber"></td>
                                                            <td view="arrivalDate"></td>
                                                            <td view="name"></td>
                                                            <td view="passport"></td>
                                                            <!-- <td view="location"></td> -->
                                                            <td view="flightNumber"></td>
                                                            <!-- <td view="nominal"></td> -->
                                                            <td view="country"></td>
                                                            <td view="status"></td>
                                                            <td>
                                                                <button view="actionDetail" class="btn btn-sm btn-primary"><i class="fa fa-print"></i></button>
                                                                <button view="actionDelete" class="btn btn-sm btn-danger"><i class="fa fa-minus"></i></button>
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

        <!-- Modal List -->
        <!-- Modal for new valas -->
        <div class="modal fade" id="newValasModal" name="newValasModal" data-backdrop="static" style="overflow: scroll !important;">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <form name="newValasForm">
                        <div class="modal-header">
                            <h4 class="modal-title"><span view="title"></span> Tambah Data</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <!-- personal detail -->
                                <div class="col-md-4">
                                    <h5><i>PERSONAL DETAILS</i> (DATA DIRI)</h5> <hr />
                                    <div class="form-group">
                                        <label for="name"><i>Full Name</i> (Nama Lengkap)</label>
                                        <input type="text" name="name" class="form-control" id="name" />
                                    </div>
                                    <div class="form-group">
                                        <label for="nationality"><i>Nationality</i> (Kebangsaan)</label>
                                        <!-- <input type="text" name="nationality" class="form-control" id="nationality" placeholder="Kebangsaan"  /> -->
                                        <select class="form-control selectpicker" data-size="7" data-live-search="true" id="nationality" name="nationality" required>
                                            <option value="">Select</option>
                                            <?php
                                                foreach($countries as $val) { ?>
                                                    <option value="<?=$val['id'];?>"><?=$val['name'];?></option>
                                                <?php
                                                }
                                                ?>
                                        </select>
                                    </div>  
                                    <div class="form-group">
                                        <label for="identity"><i>Pasport No/National Registration Identification Card</i> (Nomor Paspor/Nomor Kartu Tanda Penduduk)</label>
                                        <input type="text" name="identity" class="form-control" id="identity" />
                                    </div> 
                                    <div class="form-group">
                                        <label for="birth"><i>Date of Birth</i> (Tanggal Lahir)</label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1"><i class="fa fa-calendar"></i></span>
                                            </div>
                                            <input type="text" name="birth" class="form-control" id="birth" />
                                        </div>    
                                    </div> 
                                    <div class="form-group">
                                        <label for="address"><i>Residence Address</i> (Alamat Tempat Tinggal)</label>
                                        <input type="text" name="address" class="form-control" id="address" />
                                    </div>
                                    <div class="form-group">
                                        <label for="occupation"><i>Occupation</i> (Pekerjaan)</label>
                                        <input type="text" name="occupation" class="form-control" id="occupation" />
                                    </div>
                                    <div class="form-group">
                                        <label for="country"><i>Origin Country</i> (Negara Asal)</label>
                                        <select class="form-control selectpicker" data-size="7" data-live-search="true" id="country" name="country" required>
                                            <option value="">Select</option>
                                            <?php
                                                foreach($countries as $val) { ?>
                                                    <option value="<?=$val['id'];?>"><?=$val['name'];?></option>
                                                <?php
                                                }
                                            ?>
                                        </select>
                                    </div>
                                    <fieldset class="form-group">
                                        <div class="row">
                                            <legend class="col-form-label col-sm-4 pt-0">Pembawaan Uang Tunai</legend>
                                            <div class="col-sm-8">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="reason" id="gridRadios1" value="1" checked>
                                                    <label class="form-check-label" for="gridRadios1">
                                                        Milik Pribadi
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="reason" id="gridRadios2" value="2">
                                                    <label class="form-check-label" for="gridRadios2">
                                                        Milik Orang Lain
                                                    </label>
                                                </div>
                                                <div class="form-check disabled">
                                                    <input class="form-check-input" type="radio" name="reason" id="gridRadios3" value="3">
                                                    <label class="form-check-label" for="gridRadios3">
                                                        Perusahaan
                                                    </label>
                                                </div>
                                            </div>
                                            <!-- end col -->
                                        </div>
                                        <!-- end row -->
                                    </fieldset>
                                </div>
                                <div name="othersTemplate" class="col-md-4 d-none">
                                    <h5><i>OTHER PERSONAL DETAILS</i> (DATA ORANG LAINNYA)</h5> <hr />
                                    <div class="form-group">
                                        <label for="othername"><i>Full Name</i> (Nama Lengkap)</label>
                                        <input type="text" name="othername" class="form-control" id="othername" />
                                    </div>
                                    <div class="form-group">
                                        <label for="othernationality"><i>Nationality</i> (Kebangsaan)</label>
                                        <input type="text" name="othernationality" class="form-control" id="othernationality" />
                                    </div>  
                                    <div class="form-group">
                                        <label for="otheridentity"><i>Pasport No/National Registration Identification Card</i> (Nomor Paspor/Nomor Kartu Tanda Penduduk)</label>
                                        <input type="text" name="otheridentity" class="form-control" id="otheridentity" />
                                    </div> 
                                    <div class="form-group">
                                        <label for="otherbirth"><i>Date of Birth</i> (Tanggal Lahir)</label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1"><i class="fa fa-calendar"></i></span>
                                            </div>
                                            <input type="text" name="otherbirth" class="form-control" id="otherbirth" />
                                        </div>    
                                    </div> 
                                    <div class="form-group">
                                        <label for="otheraddress"><i>Residence Address</i> (Alamat Tempat Tinggal)</label>
                                        <input type="text" name="otheraddress" class="form-control" id="otheraddress" />
                                    </div>
                                    <div class="form-group">
                                        <label for="otheroccupation"><i>Occupation</i> (Pekerjaan)</label>
                                        <input type="text" name="otheroccupation" class="form-control" id="otheroccupation" />
                                    </div>
                                </div>
                                <div name="companyTemplate" class="col-md-4 d-none">
                                    <h5>CORPORATE (PERUSAHAAN)</h5> <hr />
                                    <div class="form-group">
                                        <label for="corporatename"><i>Corporate Name</i> (Nama Perusahaan)</label>
                                        <input type="text" name="corporatename" class="form-control" id="corporatename" />
                                    </div>
                                    <div class="form-group">
                                        <label for="corporateaddress"><i>Address of Corporate</i> (Alamat Perusahaan)</label>
                                        <input type="text" name="corporateaddress" class="form-control" id="corporateaddress" />
                                    </div>
                                    <fieldset class="form-group">
                                        <div class="row">
                                            <legend class="col-form-label col-sm-4 pt-0">Type of Business (Jenis Usaha)</legend>
                                            <div class="col-sm-8">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="corporatetype" id="corporatetypeRadios1" value="1" checked>
                                                    <label class="form-check-label" for="corporatetypeRadios1">
                                                        Bank
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="corporatetype" id="corporatetypeRadios2" value="2">
                                                    <label class="form-check-label" for="corporatetypeRadios2">
                                                        Money Changer
                                                    </label>
                                                </div>
                                                <div class="form-check disabled">
                                                    <input class="form-check-input" type="radio" name="corporatetype" id="corporatetypeRadios3" value="3">
                                                    <label class="form-check-label" for="corporatetypeRadios3">
                                                        Others
                                                    </label>
                                                </div>
                                            </div>
                                            <!-- end col -->
                                        </div>
                                        <!-- end row -->
                                    </fieldset>
                                </div>
                                <!-- travel detail -->
                                <div class="col-md-4">
                                    <h5>TRAVEL DETAIL</h5> <hr />
                                    <div class="form-group">
                                        <label for="flightNumber"><i>Flight No and Name</i> (Nomor dan Nama Kapal)</label>
                                        <input type="text" name="flightNumber" class="form-control" id="flightNumber" />
                                    </div> 
                                    <div class="form-group">
                                        <label for="arrivalDate"><i>Arrival Date</i> (Tanggal Kedatangan)</label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1"><i class="fa fa-calendar"></i></span>
                                            </div>
                                            <input type="text" name="arrivalDate" class="form-control" id="arrivalDate" value="<?= date('Y-m-d'); ?>" />
                                        </div>
                                    </div> 
                                    <div class="form-group">
                                        <label for="place"><i>Last Port/Place</i> (Pelabuhan/Tempat Asal)</label>
                                        <input type="text" name="place" class="form-control" id="place" />
                                    </div> 
                                    <div class="form-group">
                                        <label for="destination"><i>Next Port/Destination</i> (Pelabuhan/Tempat Tujuan)</label>
                                        <input type="text" name="destination" class="form-control" id="destination" />
                                    </div>
                                    <div class="form-group">
                                        <label for="indonesianaddress"><i>Address in Indonesia</i> (Alamat di Indonesia)</label>
                                        <input type="text" name="indonesianaddress" class="form-control" id="indonesianaddress" />
                                    </div> 
                                    <div class="form-group">
                                        <label for="purpose"><i>Purpose of Visit</i> (Maksud Perjalanan)</label>
                                        <select class="form-control" name="purpose" id="purpose" required>
                                            <option value="">Select</option>
                                            <option value="1">Business/Official (Bisnis/Dinas)</option>
                                            <option value="2">Visiting/Holiday (Kunjungan/Liburan)</option>
                                            <option value="3">Employment/Student (Bekerja/Pelajar)</option>
                                            <option value="4">Others (Lainnya)</option>
                                        </select>
                                    </div> 
                                </div>
                                
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

        <!-- modal step 2 -->
        <div class="modal fade" id="newValasModalStep2" name="newValasModalStep2" data-backdrop="static" style="overflow: scroll !important;">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <form name="newValasFormStep2">
                        <div class="modal-header">
                            <h4 class="modal-title"><span view="title"></span> Tambah Data Step 2</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <!-- personal detail -->
                                <div class="col-md-6">
                                    <h5>Declaration</h5> <hr />
                                    <!-- no choice for arr / dep, set value always 1 for arrival-->
                                    <!--  
                                    <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                        <label class="btn btn-primary active">
                                            <input type="radio" name="valasType" value="arr" id="valasType1" autocomplete="off" checked> Arrival
                                        </label>
                                        <label class="btn btn-primary">
                                            <input type="radio" name="valasType" value="dep" id="valasType2" autocomplete="off"> Departure
                                        </label>
                                    </div>
                                    -->
                                    <br />
                                    <!-- form cash -->
                                    <div class="row">
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <label for="cashcurrency"><i>Currency</i> (Mata Uang)</label>
                                                <input type="text" name="cashcurrency" class="form-control" id="cashcurrency" />
                                            </div>
                                        </div>
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <label for="cashamount"><i>Amount</i> (Jumlah)</label>
                                                <input type="text" name="cashamount" class="form-control" id="cashamount" />
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label>&nbsp;</label>
                                                <button id="btnAddCash" view="cash" type="button" class="btn btn-sm btn-success form-control"><i class="fa fa-plus"></i></button>
                                            </div>
                                        </div>
                                    </div>

                                    <table name="cashTable" class="table table-striped table-hover table-bordered">
                                        <thead>
                                            <tr>
                                                <th>No.</th>
                                                <th>Mata Uang (Currency)</th>
                                                <th>Amount (Jumlah)</th>
                                                <th>Action (Aksi)</th>
                                            </tr>
                                            <tr class="d-none" template="cashBody">
                                                <td view="cashNumber"></td>
                                                <td view="cashCurrency"></td>
                                                <td view="cashAmount"></td>
                                                <td class="text-center"><button view="cashAction" class="btn btn-sm btn-danger"><i class="fa fa-minus"></i></button></td>
                                            </tr>
                                        </thead>
                                        <tbody><!-- Appended by Ajax --></tbody>
                                    </table>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="cashReason"><i>Intended Use</i> (Maksud penggunaan uang)</label>
                                                <select class="form-control" name="cashReason" id="cashReason">
                                                    <option value="1">Personal Expense (Pengeluaran Pribadi)</option>
                                                    <option value="2">Education (Pendidikan)</option>
                                                    <option value="3">Business (bisnis)</option>
                                                    <option value="4">Other (Lainnya)</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">&nbsp;</div>
                                    </div>
                                    <p class="text-justify">
                                        I have read the important notice and certify that the above declaration are true and complete.
                                        This declaration is made pursuant to the provisions og the Customs Act 1995 and the Anti-Money Laundering
                                        Act 2020 and Anti-Terrorism Financing Act 2013 and shall be appendix of customs declaration.
                                    </p>
                                    <p class="text-justify">
                                        Saya telah membaca dan menyatakan bahwa pemberitahuan di atas telah benar dan lengkap. Pemberitahuan ini dibuat
                                        sesuai dengan Undang-undang Nomor 10 tahun 1995 tentang kepabeanan sebagaimana telah diubah dengan undang-undang nomor 17
                                        tahun 2006 dan undang-undang nomor 8 tahun 2010 tentang pencegahan dan pemberantasan tindak pidana pencucian uang dan Undang-undang
                                        nomor 9 tahun 2013 tentang pencegahan dan pemberantasan tindak pidana pendanaan Terorisme, serta akan menjadi lampiran dalam pemberitahuan
                                        pabean.
                                    </p>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="agreement" required>
                                        <label class="form-check-label" for="agreement">Setuju</label>
                                    </div>
                                </div>
                                <!-- end col -->
                                <div class="col-md-6">
                                    <h5>Detail IPL</h5> <hr />
                                    <!-- ipl has changed -->
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>&nbsp;</label>
                                                <button id="btnAddInstrument" view="instrument" type="button" class="btn btn-sm btn-success form-control"><i class="fa fa-plus"></i> Detail Barang</button>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- end row -->
                                    <table name="instrumentTable" class="table table-striped table-hover table-bordered">
                                        <thead>
                                            <tr>
                                                <th>No.</th>
                                                <th>Mata Uang</th>
                                                <th>Nominal</th>
                                                <th>Jenis Instrumen</th>
                                                <th>Nomor</th>
                                                <th>Tanggal</th>
                                                <th>Bank Penerbit</th>
                                            </tr>
                                            <tr class="d-none" template="instrumentBody">
                                                <td view="instrumentNumber"></td>
                                                <td view="instrumentValas"></td>
                                                <td view="instrumentDenom"></td>
                                                <td view="instrumentType"></td>
                                                <td view="instrumentNumberContent"></td>
                                                <td view="instrumentDate"></td>
                                                <td view="instrumentBank"></td>
                                                <td class="text-center"><button view="instrumentAction" class="btn btn-sm btn-danger"><i class="fa fa-minus"></i></button></td>
                                            </tr>
                                        </thead>
                                        <tbody><!-- Appended by Ajax --></tbody>
                                    </table>
                                    
                                    <!-- suspicious and result -->
                                    <hr />
                                    <fieldset class="form-group">
                                        <div class="row">
                                            <legend class="col-form-label col-sm-6 pt-0"><b>Hitung Jumlah</b></legend>
                                            <div class="col-sm-6">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="is_count" id="is_count1" value="1" >
                                                    <label class="form-check-label" for="is_count1">
                                                        Ya
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="is_count" id="is_count2" value="0" checked>
                                                    <label class="form-check-label" for="is_count2">
                                                        Tidak
                                                    </label>
                                                </div>
                                            </div>
                                            <!-- end col -->
                                        </div>
                                        <!-- end row -->
                                    </fieldset>
                                    <hr />
                                    <fieldset class="form-group">
                                        <div class="row">
                                            <legend class="col-form-label col-sm-6 pt-0"><b>Pembawaan Mencurigakan</b></legend>
                                            <div class="col-sm-6">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="is_suspicious" id="is_suspicious1" value="1" >
                                                    <label class="form-check-label" for="is_suspicious1">
                                                        Ya
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="is_suspicious" id="is_suspicious2" value="0" checked>
                                                    <label class="form-check-label" for="is_suspicious2">
                                                        Tidak
                                                    </label>
                                                </div>
                                            </div>
                                            <!-- end col -->
                                        </div>
                                        <!-- end row -->
                                    </fieldset>
                                    <hr />
                                    <fieldset class="form-group">
                                        <div class="row">
                                            <legend class="col-form-label col-sm-6 pt-0"><b>Hasil</b></legend>
                                            <div class="col-sm-6">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="is_result" id="is_result1" value="1" checked>
                                                    <label class="form-check-label" for="is_result1">
                                                        Pemberitahuan Benar
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="is_result" id="is_result2" value="0">
                                                    <label class="form-check-label" for="is_result2">
                                                        Pemberitahuan Salah
                                                    </label>
                                                </div>
                                            </div>
                                            <!-- end col -->
                                        </div>
                                        <!-- end row -->
                                    </fieldset>
                                </div>  
                                <!-- end col -->
                            </div>
                            <!-- end row -->
                        </div>
                        <!-- end modal-body -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Tutup</button>
                            <button type="button" name="btnBack" class="btn btn-secondary font-weight-bold">Back</button>
                            <button type="submit" class="btn btn-primary font-weight-bold" view="btnPage2">Simpan</button>
                        </div>
                    </form>
                </div>
            <!-- end modal content -->
        </div>
        <!-- end modal dialog -->
        </div>
        <!-- end modal -->

        <!-- modal IPL New -->
        <div class="modal fade" id="instrumentModal" name="instrumentModal" data-backdrop="static" style="overflow: scroll !important;">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form name="instrumentForm">
                        <div class="modal-header">
                            <h4 class="modal-title"><span view="title"></span> Tambah Instrument Pembayaran Lain</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group row">
                                <label for="instrumentValas" class="col-md-4">Mata Uang</label>
                                <div class="col-md-8">
                                    <input type="text" name="instrumentValas" class="form-control" id="instrumentValas" />
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="instrumentNominal" class="col-md-4">Nominal</label>
                                <div class="col-md-8">
                                    <input type="text" name="instrumentNominal" class="form-control" id="instrumentNominal" />
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="instrumentType" class="col-md-4">Jenis Instrumen</label>
                                <div class="col-md-8">
                                    <select name="instrumentType" class="form-control" id="instrumentType">
                                        <option value="1">Bilyet Giro</option>
                                        <option value="2">Warkat</option>
                                        <option value="3">Cek Perjalanan</option>
                                        <option value="4">Surat Sanggup Bayar</option>
                                        <option value="5">Sertifikat Deposito</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="instrumentNumber" class="col-md-4">Nomor</label>
                                <div class="col-md-8">
                                    <input type="text" name="instrumentNumber" class="form-control" id="instrumentNumber" />
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="instrumentDate" class="col-md-4">Tanggal</label>
                                <div class="input-group mb-3 col-md-8">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1"><i class="fa fa-calendar"></i></span>
                                    </div>
                                    <input type="text" name="instrumentDate" class="form-control" id="instrumentDate" />
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="instrumentBank" class="col-md-4">Bank Penerbit</label>
                                <div class="col-md-8">
                                    <input type="text" name="instrumentBank" class="form-control" id="instrumentBank" />
                                </div>
                            </div>
                        </div>
                        <!-- end modal body -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-primary font-weight-bold">Simpan</button>
                        </div>
                    </form>
                </div>
                <!-- end modal content -->
            </div>
            <!-- end modal dialog -->
        </div>
        <!-- end modal -->

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

        <?php $this->load->view('aside/user');?>    
        <?php $this->load->view('aside/script');?>

        <script src="<?=base_url('assets/js/app.valas.js'); ?>"></script>
    </body>
</html>
