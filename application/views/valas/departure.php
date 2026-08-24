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
                                            <h3 class="card-label">DATA PEMBAWAAN MATA UANG - KEBERANGKATAN (BC 3.2)</h3>
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
                                                            <th>Tanggal Keberangkatan</th>
                                                            <th>Penumpang</th>
                                                            <th>Paspor</th>
                                                            <!-- <th>Lokasi</th> -->
                                                            <th>No. Flight</th>
                                                            <!-- <th>Nominal Pembawaan</th> -->
                                                            <th>Negara Tujuan</th>
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
																<button view="actionReview" class="btn btn-sm btn-primary"><i class="fa fa-eye"></i></button>
                                                                <!-- create button menu for print -->
                                                                <div class="dropdown btn p-0">
                                                                    <button class="btn btn-primary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                        <i class="fa fa-print"></i>
                                                                    </button>
                                                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                                        <a class="dropdown-item" view="actionDeparture">Form Keberangkatan (BC 3.2)</a>
                                                                        <a class="dropdown-item" view="actionArrival">Form Pernyataan Tambahan</a>
                                                                    </div>
                                                                </div>
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
								<!-- RT -->
								<!-- Personal details -->
								<div class="col-md-12">
									<div class="row">
										<div class="col-md-12">
											<h5>DATA DIRI</h5> <hr />
										</div>
									</div>
									<div class="row">
										<div class="col-md-9">
											<div class="form-group">
												<label for="name">Nama Lengkap</label>
												<input type="text" name="name" class="form-control" id="name" required/>
											</div>
										</div>
										<div class="col-md-3">
											<div class="form-group">
												<label for="birth">Tanggal Lahir</label>
												<div class="input-group mb-3">
													<div class="input-group-prepend">
														<span class="input-group-text" id="basic-addon1"><i class="fa fa-calendar"></i></span>
													</div>
													<input type="text" name="birth" class="form-control" id="birth" required/>
												</div>    
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-4">
											<div class="form-group">
												<label for="nationality">Kebangsaan</label>
												<select class="form-control selectpicker" data-size="7" data-live-search="true" id="nationality" name="nationality" required>
													<option value="">Select</option>
													<?php foreach($countries as $val) { ?>
														<option value="<?=$val['id'];?>"><?=$val['name'];?></option>
													<?php } ?>
												</select>
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label for="identity">Nomor Paspor/Nomor Kartu Tanda Penduduk</label>
												<input type="text" name="identity" class="form-control" id="identity" required/>
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label for="occupation">Pekerjaan</label>
												<input type="text" name="occupation" class="form-control" id="occupation" required/>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-8">
											<div class="form-group">
												<label for="id_street">Alamat Identitas</label>
												<input type="text" name="id_street" class="form-control" id="id_street" required/>
											</div> 
										</div>
										<div class="col-md-2">
											<div class="form-group">
												<label for="id_rt">RT</label>
												<input type="text" name="id_rt" class="form-control" id="id_rt"/>
											</div> 
										</div>
										<div class="col-md-2">
											<div class="form-group">
												<label for="id_rw">RW</label>
												<input type="text" name="id_rw" class="form-control" id="id_rw"/>
											</div> 
										</div>
									</div>
									<div class="row">
										<div class="col-md-4">
											<div class="form-group">
												<label for="id_country">Negara</label>
												<select class="form-control selectpicker" data-size="7" data-live-search="true" id="id_country" name="id_country" required>
													<option value="">Select</option>
													<?php foreach($countries as $val) { ?>
														<option value="<?=$val['id'];?>"><?=$val['name'];?></option>
													<?php } ?>
												</select>
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label for="id_province">Provinsi/Negara Bagian</label>
												<input type="text" name="id_province" class="form-control" id="id_province" required/>
											</div> 
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label for="id_city">Kota/Kabupaten</label>
												<input type="text" name="id_city" class="form-control" id="id_city" required/>
											</div> 
										</div>
									</div>
									<div class="row">
										<div class="col-md-4">
											<div class="form-group">
												<label for="id_kecamatan">Kecamatan</label>
												<input type="text" name="id_kecamatan" class="form-control" id="id_kecamatan" required/>
											</div> 
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label for="id_kelurahan">Kelurahan</label>
												<input type="text" name="id_kelurahan" class="form-control" id="id_kelurahan" required/>
											</div> 
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label for="id_postal_code">Kode Pos</label>
												<input type="text" name="id_postal_code" class="form-control" id="id_postal_code"/>
											</div> 
										</div>
									</div>
								</div>
							</div>

							<!-- Kepemilikan -->
							<div class="row">
								<div class="col-md-12">
									<div class="form-group row">
										<div class="col-md-4">
											<label for="reason">Kepemilikan Uang</label>
											<select name="reason" id="reason" class="form-control selectpicker">
												<option value="1">Milik Sendiri</option>
												<option value="2">Milik Orang Lain</option>
												<option value="3">Perusahaan</option>
											</select>
										</div>
									</div>

									<!-- Orang Lain -->
									<div name="othersTemplate" class="d-none">
										<div class="row">
											<div class="col-md-12">
												<h5>DATA ORANG LAIN</h5> <hr />
											</div>
										</div>
										<div class="row">
											<div class="col-md-9">
												<div class="form-group">
													<label for="other_name">Nama Lengkap</label>
													<input type="text" name="other_name" class="form-control" id="other_name"/>
												</div>
											</div>
											<div class="col-md-3">
												<div class="form-group">
													<label for="other_birth">Tanggal Lahir</label>
													<div class="input-group mb-3">
														<div class="input-group-prepend">
															<span class="input-group-text" id="basic-addon2"><i class="fa fa-calendar"></i></span>
														</div>
														<input type="text" name="other_birth" class="form-control" id="other_birth" />
													</div>    
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-md-4">
												<div class="form-group">
													<label for="other_nationality">Kebangsaan</label>
													<select class="form-control selectpicker" data-size="7" data-live-search="true" id="other_nationality" name="other_nationality">
														<option value="">Select</option>
														<?php
															foreach($countries as $val) { ?>
																<option value="<?=$val['id'];?>"><?=$val['name'];?></option>
															<?php } ?>
													</select>
												</div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
													<label for="other_identity">Nomor Paspor/Nomor Kartu Tanda Penduduk</label>
													<input type="text" name="other_identity" class="form-control" id="other_identity"/>
												</div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
													<label for="other_occupation">Pekerjaan</label>
													<input type="text" name="other_occupation" class="form-control" id="other_occupation"/>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-md-8">
												<div class="form-group">
													<label for="other_street">Alamat Identitas</label>
													<input type="text" name="other_street" class="form-control" id="other_street"/>
												</div> 
											</div>
											<div class="col-md-2">
												<div class="form-group">
													<label for="other_rt">RT</label>
													<input type="text" name="other_rt" class="form-control" id="other_rt"/>
												</div> 
											</div>
											<div class="col-md-2">
												<div class="form-group">
													<label for="other_rw">RW</label>
													<input type="text" name="other_rw" class="form-control" id="other_rw"/>
												</div> 
											</div>
										</div>
										<div class="row">
											<div class="col-md-4">
												<div class="form-group">
													<label for="other_country">Negara</label>
													<select class="form-control selectpicker" data-size="7" data-live-search="true" id="other_country" name="other_country">
														<option value="">Select</option>
														<?php foreach($countries as $val) { ?>
															<option value="<?=$val['id'];?>"><?=$val['name'];?></option>
														<?php } ?>
													</select>
												</div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
													<label for="other_province">Provinsi/Negara Bagian</label>
													<input type="text" name="other_province" class="form-control" id="other_province"/>
												</div> 
											</div>
											<div class="col-md-4">
												<div class="form-group">
													<label for="other_city">Kota/Kabupaten</label>
													<input type="text" name="other_city" class="form-control" id="other_city"/>
												</div> 
											</div>
										</div>
										<div class="row">
											<div class="col-md-4">
												<div class="form-group">
													<label for="other_kecamatan">Kecamatan</label>
													<input type="text" name="other_kecamatan" class="form-control" id="other_kecamatan"/>
												</div> 
											</div>
											<div class="col-md-4">
												<div class="form-group">
													<label for="other_kelurahan">Kelurahan</label>
													<input type="text" name="other_kelurahan" class="form-control" id="other_kelurahan"/>
												</div> 
											</div>
											<div class="col-md-4">
												<div class="form-group">
													<label for="other_postal_code">Kode Pos</label>
													<input type="text" name="other_postal_code" class="form-control" id="other_postal_code"/>
												</div> 
											</div>
										</div>
									</div>

									<!-- Perusahaan -->
									<div name="companyTemplate" class="d-none">
										<div class="row">
											<div class="col-md-12">
												<h5>DATA PERUSAHAAN</h5> <hr />
											</div>
										</div>
										<div class="row">
											<div class="col-md-9">
												<div class="form-group">
													<label for="corporate_name">Nama Perusahaan</label>
													<input type="text" name="corporate_name" class="form-control" id="corporate_name"/>
												</div>
											</div>
											<div class="col-md-3">
												<label for="corporate_type">Jenis Usaha</label>
												<select name="corporate_type" id="corporate_type" class="form-control selectpicker">
													<option value="1">Bank</option>
													<option value="2">Usaha Penukaran Valas</option>
													<option value="3">Lainnya</option>
												</select>
											</div>
										</div>
										<div class="row">
											<div class="col-md-8">
												<div class="form-group">
													<label for="corp_street">Alamat Perusahaan</label>
													<input type="text" name="corp_street" class="form-control" id="corp_street"/>
												</div> 
											</div>
											<div class="col-md-2">
												<div class="form-group">
													<label for="corp_rt">RT</label>
													<input type="text" name="corp_rt" class="form-control" id="corp_rt"/>
												</div> 
											</div>
											<div class="col-md-2">
												<div class="form-group">
													<label for="corp_rw">RW</label>
													<input type="text" name="corp_rw" class="form-control" id="corp_rw"/>
												</div> 
											</div>
										</div>
										<div class="row">
											<div class="col-md-4">
												<div class="form-group">
													<label for="corp_country">Negara</label>
													<select class="form-control selectpicker" data-size="7" data-live-search="true" id="corp_country" name="corp_country">
														<option value="">Select</option>
														<?php foreach($countries as $val) { ?>
															<option value="<?=$val['id'];?>"><?=$val['name'];?></option>
														<?php } ?>
													</select>
												</div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
													<label for="corp_province">Provinsi/Negara Bagian</label>
													<input type="text" name="corp_province" class="form-control" id="corp_province"/>
												</div> 
											</div>
											<div class="col-md-4">
												<div class="form-group">
													<label for="corp_city">Kota/Kabupaten</label>
													<input type="text" name="corp_city" class="form-control" id="corp_city"/>
												</div> 
											</div>
										</div>
										<div class="row">
											<div class="col-md-4">
												<div class="form-group">
													<label for="corp_kecamatan">Kecamatan</label>
													<input type="text" name="corp_kecamatan" class="form-control" id="corp_kecamatan"/>
												</div> 
											</div>
											<div class="col-md-4">
												<div class="form-group">
													<label for="corp_kelurahan">Kelurahan</label>
													<input type="text" name="corp_kelurahan" class="form-control" id="corp_kelurahan"/>
												</div> 
											</div>
											<div class="col-md-4">
												<div class="form-group">
													<label for="corp_postal_code">Kode Pos</label>
													<input type="text" name="corp_postal_code" class="form-control" id="corp_postal_code"/>
												</div> 
											</div>
										</div>
									</div>
								</div>
							</div>

							<!-- Data Perjalanan -->
							<div class="row">
								<div class="col-md-12">
									<div class="row">
										<div class="col-md-12">
											<h5>DATA PERJALANAN</h5> <hr />
										</div>
									</div>
									<div class="row">
										<div class="col-md-9">
											<div class="form-group">
												<label for="flight_number">Nomor dan Nama Penerbangan</label>
												<input type="text" name="flight_number" class="form-control" id="flight_number" required/>
											</div> 
										</div>
										<div class="col-md-3">
											<div class="form-group">
												<label for="arrival_date">Tanggal Kedatangan</label>
												<div class="input-group mb-3">
													<div class="input-group-prepend">
														<span class="input-group-text" id="basic-addon1"><i class="fa fa-calendar"></i></span>
													</div>
													<input type="text" name="arrival_date" class="form-control" id="arrival_date" value="<?= date('Y-m-d'); ?>" required/>
												</div>
											</div> 
										</div>
									</div>
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label for="last_port">Pelabuhan/Tempat Asal</label>
												<input type="text" name="last_port" class="form-control" id="last_port" required/>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label for="next_port">Pelabuhan/Tempat Tujuan</label>
												<input type="text" name="next_port" class="form-control" id="next_port" required/>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-8">
											<div class="form-group">
												<label for="local_street">Alamat di Indonesia</label>
												<input type="text" name="local_street" class="form-control" id="local_street" required/>
											</div> 
										</div>
										<div class="col-md-2">
											<div class="form-group">
												<label for="local_rt">RT</label>
												<input type="text" name="local_rt" class="form-control" id="local_rt"/>
											</div> 
										</div>
										<div class="col-md-2">
											<div class="form-group">
												<label for="local_rw">RW</label>
												<input type="text" name="local_rw" class="form-control" id="local_rw"/>
											</div> 
										</div>
									</div>
									<div class="row">
										<div class="col-md-4">
											<div class="form-group">
												<label for="local_province">Provinsi</label>
												<input type="text" name="local_province" class="form-control" id="local_province" required/>
											</div> 
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label for="local_city">Kota/Kabupaten</label>
												<input type="text" name="local_city" class="form-control" id="local_city" required/>
											</div> 
										</div>
									</div>
									<div class="row">
										<div class="col-md-4">
											<div class="form-group">
												<label for="local_kecamatan">Kecamatan</label>
												<input type="text" name="local_kecamatan" class="form-control" id="local_kecamatan" required/>
											</div> 
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label for="local_kelurahan">Kelurahan</label>
												<input type="text" name="local_kelurahan" class="form-control" id="local_kelurahan" required/>
											</div> 
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label for="local_postal_code">Kode Pos</label>
												<input type="text" name="local_postal_code" class="form-control" id="local_postal_code"/>
											</div> 
										</div>
									</div>
									<div class="row">
										<div class="col-md-4">
											<div class="form-group">
												<label for="purpose">Maksud Perjalanan</label>
												<select class="form-control" name="purpose" id="purpose" required>
													<option value="">Select</option>
													<option value="1">Bisnis/Dinas</option>
													<option value="2">Kunjungan/Liburan</option>
													<option value="3">Bekerja/Pelajar</option>
													<option value="4">Lainnya</option>
												</select>
											</div> 
										</div>
									</div>
								</div>
							</div>
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
							<!-- Kantor Pabean -->
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<div class="row">
											<label class="col-form-label col-md-3" for="office"><b>Kantor Pabean Pendaftaran</b></label>
											<select class="form-control selectpicker col-md-9" data-size="7" data-live-search="true" name="office">
												<option value=""> - </option>
												<option value="BLBC KELAS II SURABAYA"> BLBC KELAS II SURABAYA</option>
												<option value="KANWIL DJBC ACEH"> KANWIL DJBC ACEH</option>
												<option value="KANWIL DJBC BALI, NTB DAN NTT"> KANWIL DJBC BALI, NTB DAN NTT</option>
												<option value="KANWIL DJBC BANTEN"> KANWIL DJBC BANTEN</option>
												<option value="KANWIL DJBC JAKARTA"> KANWIL DJBC JAKARTA</option>
												<option value="KANWIL DJBC JAWA BARAT"> KANWIL DJBC JAWA BARAT</option>
												<option value="KANWIL DJBC JAWA TENGAH DAN D.I. YOGYAKARTA"> KANWIL DJBC JAWA TENGAH DAN D.I. YOGYAKARTA</option>
												<option value="KANWIL DJBC JAWA TIMUR I"> KANWIL DJBC JAWA TIMUR I</option>
												<option value="KANWIL DJBC JAWA TIMUR II"> KANWIL DJBC JAWA TIMUR II</option>
												<option value="KANWIL DJBC KALIMANTAN BAGIAN BARAT"> KANWIL DJBC KALIMANTAN BAGIAN BARAT</option>
												<option value="KANWIL DJBC KALIMANTAN BAGIAN SELATAN"> KANWIL DJBC KALIMANTAN BAGIAN SELATAN</option>
												<option value="KANWIL DJBC KALIMANTAN BAGIAN TIMUR"> KANWIL DJBC KALIMANTAN BAGIAN TIMUR</option>
												<option value="KANWIL DJBC KHUSUS KEPULAUAN RIAU"> KANWIL DJBC KHUSUS KEPULAUAN RIAU</option>
												<option value="KANWIL DJBC KHUSUS PAPUA"> KANWIL DJBC KHUSUS PAPUA</option>
												<option value="KANWIL DJBC MALUKU"> KANWIL DJBC MALUKU</option>
												<option value="KANWIL DJBC RIAU"> KANWIL DJBC RIAU</option>
												<option value="KANWIL DJBC SULAWESI BAGIAN SELATAN"> KANWIL DJBC SULAWESI BAGIAN SELATAN</option>
												<option value="KANWIL DJBC SULAWESI BAGIAN UTARA"> KANWIL DJBC SULAWESI BAGIAN UTARA</option>
												<option value="KANWIL DJBC SUMATERA BAGIAN BARAT"> KANWIL DJBC SUMATERA BAGIAN BARAT</option>
												<option value="KANWIL DJBC SUMATERA BAGIAN TIMUR"> KANWIL DJBC SUMATERA BAGIAN TIMUR</option>
												<option value="KANWIL DJBC SUMATERA UTARA"> KANWIL DJBC SUMATERA UTARA</option>
												<option value="KPPBC ATAPUPU"> KPPBC ATAPUPU</option>
												<option value="KPPBC BAGAN SIAPIAPI"> KPPBC BAGAN SIAPIAPI</option>
												<option value="KPPBC BAJOE"> KPPBC BAJOE</option>
												<option value="KPPBC BENOA "> KPPBC BENOA </option>
												<option value="KPPBC BINTUNI"> KPPBC BINTUNI</option>
												<option value="KPPBC DABO SINGKEP"> KPPBC DABO SINGKEP</option>
												<option value="KPPBC FAK-FAK"> KPPBC FAK-FAK</option>
												<option value="KPPBC KAIMANA"> KPPBC KAIMANA</option>
												<option value="KPPBC NABIRE"> KPPBC NABIRE</option>
												<option value="KPPBC PANGKALAN SUSU"> KPPBC PANGKALAN SUSU</option>
												<option value="KPPBC PEKALONGAN"> KPPBC PEKALONGAN</option>
												<option value="KPPBC POMALAA"> KPPBC POMALAA</option>
												<option value="KPPBC SIAK SRI INDRAPURA"> KPPBC SIAK SRI INDRAPURA</option>
												<option value="KPPBC TAREMPA "> KPPBC TAREMPA </option>
												<option value="KPPBC TMC KEDIRI"> KPPBC TMC KEDIRI</option>
												<option value="KPPBC TMC KUDUS"> KPPBC TMC KUDUS</option>
												<option value="KPPBC TMC MALANG"> KPPBC TMC MALANG</option>
												<option value="KPPBC TMP A BANDUNG"> KPPBC TMP A BANDUNG</option>
												<option value="KPPBC TMP A BEKASI"> KPPBC TMP A BEKASI</option>
												<option value="KPPBC TMP A BOGOR"> KPPBC TMP A BOGOR</option>
												<option value="KPPBC TMP A DENPASAR"> KPPBC TMP A DENPASAR</option>
												<option value="KPPBC TMP A JAKARTA"> KPPBC TMP A JAKARTA</option>
												<option value="KPPBC TMP A MARUNDA"> KPPBC TMP A MARUNDA</option>
												<option value="KPPBC TMP A PASURUAN"> KPPBC TMP A PASURUAN</option>
												<option value="KPPBC TMP A PURWAKARTA"> KPPBC TMP A PURWAKARTA</option>
												<option value="KPPBC TMP A SEMARANG"> KPPBC TMP A SEMARANG</option>
												<option value="KPPBC TMP A TANGERANG"> KPPBC TMP A TANGERANG</option>
												<option value="KPPBC TMP B ATAMBUA"> KPPBC TMP B ATAMBUA</option>
												<option value="KPPBC TMP B BALIKPAPAN"> KPPBC TMP B BALIKPAPAN</option>
												<option value="KPPBC TMP B BANDAR LAMPUNG"> KPPBC TMP B BANDAR LAMPUNG</option>
												<option value="KPPBC TMP B BANJARMASIN"> KPPBC TMP B BANJARMASIN</option>
												<option value="KPPBC TMP B DUMAI"> KPPBC TMP B DUMAI</option>
												<option value="KPPBC TMP B GRESIK"> KPPBC TMP B GRESIK</option>
												<option value="KPPBC TMP B JAMBI"> KPPBC TMP B JAMBI</option>
												<option value="KPPBC TMP B KUALANAMU"> KPPBC TMP B KUALANAMU</option>
												<option value="KPPBC TMP B MAKASSAR"> KPPBC TMP B MAKASSAR</option>
												<option value="KPPBC TMP B MEDAN"> KPPBC TMP B MEDAN</option>
												<option value="KPPBC TMP B PALEMBANG"> KPPBC TMP B PALEMBANG</option>
												<option value="KPPBC TMP B PEKANBARU"> KPPBC TMP B PEKANBARU</option>
												<option value="KPPBC TMP B PONTIANAK"> KPPBC TMP B PONTIANAK</option>
												<option value="KPPBC TMP B SAMARINDA"> KPPBC TMP B SAMARINDA</option>
												<option value="KPPBC TMP B SIDOARJO"> KPPBC TMP B SIDOARJO</option>
												<option value="KPPBC TMP B SURAKARTA"> KPPBC TMP B SURAKARTA</option>
												<option value="KPPBC TMP B TANJUNG BALAI KARIMUN"> KPPBC TMP B TANJUNG BALAI KARIMUN</option>
												<option value="KPPBC TMP B TANJUNGPINANG"> KPPBC TMP B TANJUNGPINANG</option>
												<option value="KPPBC TMP B TARAKAN"> KPPBC TMP B TARAKAN</option>
												<option value="KPPBC TMP B TELUK BAYUR"> KPPBC TMP B TELUK BAYUR</option>
												<option value="KPPBC TMP B YOGYAKARTA"> KPPBC TMP B YOGYAKARTA</option>
												<option value="KPPBC TMP BELAWAN"> KPPBC TMP BELAWAN</option>
												<option value="KPPBC TMP C AMAMAPARE"> KPPBC TMP C AMAMAPARE</option>
												<option value="KPPBC TMP C AMBON"> KPPBC TMP C AMBON</option>
												<option value="KPPBC TMP C BABO"> KPPBC TMP C BABO</option>
												<option value="KPPBC TMP C BANDA ACEH"> KPPBC TMP C BANDA ACEH</option>
												<option value="KPPBC TMP C BANYUWANGI"> KPPBC TMP C BANYUWANGI</option>
												<option value="KPPBC TMP C BENGKALIS"> KPPBC TMP C BENGKALIS</option>
												<option value="KPPBC TMP C BENGKULU"> KPPBC TMP C BENGKULU</option>
												<option value="KPPBC TMP C BIAK"> KPPBC TMP C BIAK</option>
												<option value="KPPBC TMP C BITUNG"> KPPBC TMP C BITUNG</option>
												<option value="KPPBC TMP C BLITAR"> KPPBC TMP C BLITAR</option>
												<option value="KPPBC TMP C BOJONEGORO"> KPPBC TMP C BOJONEGORO</option>
												<option value="KPPBC TMP C BONTANG"> KPPBC TMP C BONTANG</option>
												<option value="KPPBC TMP C CILACAP"> KPPBC TMP C CILACAP</option>
												<option value="KPPBC TMP C CIREBON"> KPPBC TMP C CIREBON</option>
												<option value="KPPBC TMP C ENTIKONG"> KPPBC TMP C ENTIKONG</option>
												<option value="KPPBC TMP C GORONTALO"> KPPBC TMP C GORONTALO</option>
												<option value="KPPBC TMP C JAGOI BABANG"> KPPBC TMP C JAGOI BABANG</option>
												<option value="KPPBC TMP C JAYAPURA"> KPPBC TMP C JAYAPURA</option>
												<option value="KPPBC TMP C JEMBER"> KPPBC TMP C JEMBER</option>
												<option value="KPPBC TMP C KANTOR POS PASAR BARU"> KPPBC TMP C KANTOR POS PASAR BARU</option>
												<option value="KPPBC TMP C KENDARI"> KPPBC TMP C KENDARI</option>
												<option value="KPPBC TMP C KETAPANG"> KPPBC TMP C KETAPANG</option>
												<option value="KPPBC TMP C KOTABARU"> KPPBC TMP C KOTABARU</option>
												<option value="KPPBC TMP C KUALA LANGSA"> KPPBC TMP C KUALA LANGSA</option>
												<option value="KPPBC TMP C KUALA TANJUNG"> KPPBC TMP C KUALA TANJUNG</option>
												<option value="KPPBC TMP C KUPANG"> KPPBC TMP C KUPANG</option>
												<option value="KPPBC TMP C LHOKSEUMAWE"> KPPBC TMP C LHOKSEUMAWE</option>
												<option value="KPPBC TMP C LUWUK"> KPPBC TMP C LUWUK</option>
												<option value="KPPBC TMP C MADIUN"> KPPBC TMP C MADIUN</option>
												<option value="KPPBC TMP C MADURA"> KPPBC TMP C MADURA</option>
												<option value="KPPBC TMP C MAGELANG"> KPPBC TMP C MAGELANG</option>
												<option value="KPPBC TMP C MALILI"> KPPBC TMP C MALILI</option>
												<option value="KPPBC TMP C MANADO"> KPPBC TMP C MANADO</option>
												<option value="KPPBC TMP C MANOKWARI"> KPPBC TMP C MANOKWARI</option>
												<option value="KPPBC TMP C MATARAM"> KPPBC TMP C MATARAM</option>
												<option value="KPPBC TMP C MAUMERE"> KPPBC TMP C MAUMERE</option>
												<option value="KPPBC TMP C MERAUKE"> KPPBC TMP C MERAUKE</option>
												<option value="KPPBC TMP C MEULABOH"> KPPBC TMP C MEULABOH</option>
												<option value="KPPBC TMP C MOROWALI"> KPPBC TMP C MOROWALI</option>
												<option value="KPPBC TMP C NANGA BADAU"> KPPBC TMP C NANGA BADAU</option>
												<option value="KPPBC TMP C NUNUKAN"> KPPBC TMP C NUNUKAN</option>
												<option value="KPPBC TMP C PANGKALAN BUN"> KPPBC TMP C PANGKALAN BUN</option>
												<option value="KPPBC TMP C PANGKALPINANG"> KPPBC TMP C PANGKALPINANG</option>
												<option value="KPPBC TMP C PANTOLOAN"> KPPBC TMP C PANTOLOAN</option>
												<option value="KPPBC TMP C PAREPARE"> KPPBC TMP C PAREPARE</option>
												<option value="KPPBC TMP C PEMATANGSIANTAR"> KPPBC TMP C PEMATANGSIANTAR</option>
												<option value="KPPBC TMP C PROBOLINGGO"> KPPBC TMP C PROBOLINGGO</option>
												<option value="KPPBC TMP C PULANG PISAU"> KPPBC TMP C PULANG PISAU</option>
												<option value="KPPBC TMP C PURWOKERTO"> KPPBC TMP C PURWOKERTO</option>
												<option value="KPPBC TMP C SABANG"> KPPBC TMP C SABANG</option>
												<option value="KPPBC TMP C SAMPIT"> KPPBC TMP C SAMPIT</option>
												<option value="KPPBC TMP C SANGATTA"> KPPBC TMP C SANGATTA</option>
												<option value="KPPBC TMP C SIBOLGA"> KPPBC TMP C SIBOLGA</option>
												<option value="KPPBC TMP C SINTETE"> KPPBC TMP C SINTETE</option>
												<option value="KPPBC TMP C SORONG"> KPPBC TMP C SORONG</option>
												<option value="KPPBC TMP C SUMBAWA"> KPPBC TMP C SUMBAWA</option>
												<option value="KPPBC TMP C TANJUNGPANDAN"> KPPBC TMP C TANJUNGPANDAN</option>
												<option value="KPPBC TMP C TASIKMALAYA"> KPPBC TMP C TASIKMALAYA</option>
												<option value="KPPBC TMP C TEGAL"> KPPBC TMP C TEGAL</option>
												<option value="KPPBC TMP C TELUK NIBUNG"> KPPBC TMP C TELUK NIBUNG</option>
												<option value="KPPBC TMP C TEMBILAHAN"> KPPBC TMP C TEMBILAHAN</option>
												<option value="KPPBC TMP C TERNATE"> KPPBC TMP C TERNATE</option>
												<option value="KPPBC TMP C TUAL"> KPPBC TMP C TUAL</option>
												<option value="KPPBC TMP CIKARANG"> KPPBC TMP CIKARANG</option>
												<option value="KPPBC TMP JUANDA"> KPPBC TMP JUANDA</option>
												<option value="KPPBC TMP MERAK"> KPPBC TMP MERAK</option>
												<option value="KPPBC TMP NGURAH RAI"> KPPBC TMP NGURAH RAI</option>
												<option value="KPPBC TMP TANJUNG EMAS"> KPPBC TMP TANJUNG EMAS</option>
												<option value="KPPBC TMP TANJUNG PERAK"> KPPBC TMP TANJUNG PERAK</option>
												<option value="KPPBC TULUNG AGUNG"> KPPBC TULUNG AGUNG</option>
												<option value="KPU BEA DAN CUKAI TIPE A TANJUNG PRIOK"> KPU BEA DAN CUKAI TIPE A TANJUNG PRIOK</option>
												<option value="KPU BEA DAN CUKAI TIPE B BATAM"> KPU BEA DAN CUKAI TIPE B BATAM</option>
												<option value="KPU BEA DAN CUKAI TIPE C SOEKARNO-HATTA" selected> KPU BEA DAN CUKAI TIPE C SOEKARNO-HATTA</option>
												<option value="PANGSAROP BC TIPE A TANJUNG BALAI KARIMUN"> PANGSAROP BC TIPE A TANJUNG BALAI KARIMUN</option>
												<option value="PANGSAROP BC TIPE B PANTOLOAN"> PANGSAROP BC TIPE B PANTOLOAN</option>
												<option value="PANGSAROP BC TIPE B SORONG"> PANGSAROP BC TIPE B SORONG</option>
												<option value="PANGSAROP BC TIPE B TANJUNG PRIOK"> PANGSAROP BC TIPE B TANJUNG PRIOK</option>
											</select>
										</div>
									</div>
								</div>
							</div>

							<!-- Detail Data -->
							<div class="row">
								<div class="col-md-8">
									<!-- Start of money data -->
									<div class="row">
										<div class="col-md-12">
											<div class="row">
												<div class="col-md-12">
													<h5>Detail Uang</h5> 
													<hr />
												</div>
											</div>
											<div class="row">
												<div class="col-md-4">
													<div class="form-group">
														<button id="btnAddCash" view="cash" type="button" class="btn btn-sm btn-success form-control"><i class="fa fa-plus"></i> Detail Uang</button>
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-md-12">
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
																<td class="text-center">
																	<button view="cashAction" class="btn btn-sm btn-danger"><i class="fa fa-minus"></i></button>
																</td>
															</tr>
														</thead>
														<tbody><!-- Appended by Ajax --></tbody>
													</table>
												</div>
											</div>
										</div>
									</div>

									<!-- Start of instrument data -->
									<div class="row">
										<div class="col-md-12">
											<div class="row mt-8">
												<div class="col-md-12">
													<h5>Detail IPL</h5>
													<hr /> 
												</div>
											</div>
											<div class="row">
												<div class="col-md-4">
													<div class="form-group">
														<button id="btnAddInstrument" view="instrument" type="button" class="btn btn-sm btn-success form-control"><i class="fa fa-plus"></i> Detail IPL</button>
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-md-12">
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
												</div>
											</div>
										</div>
									</div>
								</div>

								<!-- Start of flag input -->
								<div class="col-md-4">
									<div class="row">
										<div class="col-md-12">
											<h5>Keterangan</h5>
											<hr /> 
										</div>
									</div>
									<div class="form-group mb-4">
										<div class="row">
											<label class="col-form-label col-sm-12 pt-0" for="cashReason"><b>Maksud penggunaan uang</b></label>
											<select class="form-control col-sm-10 ml-4" name="cashReason" id="cashReason">
												<option value="1">Personal Expense (Pengeluaran Pribadi)</option>
												<option value="2">Education (Pendidikan)</option>
												<option value="3">Business (bisnis)</option>
												<option value="4">Other (Lainnya)</option>
											</select>
										</div>
									</div>
									<hr />
									<fieldset class="form-group mb-4">
										<div class="row">
											<legend class="col-form-label col-sm-12 pt-0"><b>Hitung Jumlah</b></legend>
											<div class="col-sm-12">
												<div class="row ml-4">
													<div class="form-check col-sm-6">
														<input class="form-check-input" type="radio" name="is_count" id="is_count1" value="1" >
														<label class="form-check-label" for="is_count1">
															Ya
														</label>
													</div>
													<div class="form-check col-sm-6">
														<input class="form-check-input" type="radio" name="is_count" id="is_count2" value="0" checked>
														<label class="form-check-label" for="is_count2">
															Tidak
														</label>
													</div>
												</div>
											</div>
										</div>
									</fieldset>
									<hr />
									<fieldset class="form-group mb-4">
										<div class="row">
											<legend class="col-form-label col-sm-12 pt-0"><b>Pembawaan Mencurigakan</b></legend>
											<div class="col-sm-12">
												<div class="row ml-4">
													<div class="form-check col-sm-6">
														<input class="form-check-input" type="radio" name="is_suspicious" id="is_suspicious1" value="1" >
														<label class="form-check-label" for="is_suspicious1">
															Ya
														</label>
													</div>
													<div class="form-check col-sm-6">
														<input class="form-check-input" type="radio" name="is_suspicious" id="is_suspicious2" value="0" checked>
														<label class="form-check-label" for="is_suspicious2">
															Tidak
														</label>
													</div>
												</div>
											</div>
										</div>
									</fieldset>
									<hr />
									<fieldset class="form-group mb-4">
										<div class="row">
											<legend class="col-form-label col-sm-12 pt-0"><b>Hasil Pemberitahuan</b></legend>
											<div class="col-sm-12">
												<div class="row ml-4">
													<div class="form-check col-sm-6">
														<input class="form-check-input" type="radio" name="is_result" id="is_result1" value="1" checked>
														<label class="form-check-label" for="is_result1">
															Benar
														</label>
													</div>
													<div class="form-check col-sm-6">
														<input class="form-check-input" type="radio" name="is_result" id="is_result2" value="0">
														<label class="form-check-label" for="is_result2">
															Salah
														</label>
													</div>
												</div>
											</div>
										</div>
									</fieldset>
									<hr />
									<fieldset class="form-group mb-4">
										<div class="row">
											<legend class="col-form-label col-sm-12 pt-0"><b>Izin Bank Indonesia</b></legend>
											<div class="col-sm-12">
												<div class="row ml-4">
													<div class="form-check col-sm-6">
														<input class="form-check-input" type="radio" name="is_bank_permit" id="is_bank_permit1" value="1" checked>
														<label class="form-check-label" for="is_bank_permit1">
															Ada
														</label>
													</div>
													<div class="form-check col-sm-6">
														<input class="form-check-input" type="radio" name="is_bank_permit" id="is_bank_permit2" value="0">
														<label class="form-check-label" for="is_bank_permit2">
															Tidak Ada
														</label>
													</div>
												</div>
											</div>
											<div id="permitDetail" class="col-sm-12">
												<div class="row mt-2">
													<label for="permitNumber" class="col-md-3 col-form-label">Nomor</label>
													<div class="col-md-9">
														<input type="text" class="form-control" id="permitNumber" name="permitNumber" required>
													</div>
												</div>
												<div class="row mt-2">
													<label for="permitDate" class="col-md-3 col-form-label">Tanggal</label>
													<div class="col-md-9">
														<input type="text" class="form-control" id="permitDate" name="permitDate" required>
													</div>
												</div>
											</div>
										</div>
									</fieldset>
								</div>
								<!-- End of flag input -->
							</div>
							
							<!-- Lampiran -->
							<div class="row">
								<div class="col-md-12">
									<div class="row">
										<div class="col-md-12">
											<h5>Lampiran</h5>
											<hr /> 
										</div>
									</div>
									<div class="row">
										<div id="defaultAttachment" class="col-md-12">
											<div class="form-group row">
												<label class="col-sm-2" for="attachPassport">Paspor</label>
												<input type="file" class="form-control col-sm-10" name="attachPassport" id="attachPassport" accept="image/png, image/jpeg" required/>
											</div>
											<div class="form-group row">
												<label class="col-sm-2" for="attachKtp">KTP</label>
												<input type="file" class="form-control col-sm-10" name="attachKtp" id="attachKtp" accept="image/png, image/jpeg" />
											</div>
											<div id="permitAttachment" class="form-group row">
												<label class="col-sm-2" for="attachPermit">Izin BI</label>
												<input type="file" class="form-control col-sm-10" name="attachPermit" id="attachPermit" accept="image/png, image/jpeg" required/>
											</div>
										</div>
									</div>
									<div class="row">
										<div id="otherAttachments" class="col-md-12">
											<div class="row">
												<div class="col-md-2">
													<div class="form-group">
														<button id="btnAddAttachment" type="button" class="btn btn-sm btn-success form-control"><i class="fa fa-plus"></i> Lampiran lainnya</button>
													</div>
												</div>
											</div>
											<!-- Add from click #btnAddAttachment -->
										</div>
									</div>
								</div>
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

		<!-- modal cash new -->
		<div class="modal fade" id="cashModal" name="cashModal" data-backdrop="static" style="overflow: scroll !important;">
			<div class="modal-dialog">
				<div class="modal-content">
					<form name="cashForm">
						<div class="modal-header">
							<h4 class="modal-title"><span view="title"></span> Tambah Detail Uang</h4>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						</div>
						<div class="modal-body">
							<div class="form-group row">
								<label for="cashCurrency" class="col-md-4">Mata Uang</label>
								<div class="col-md-8">
									<select class="form-control selectpicker" data-size="7" data-live-search="true" id="cashCurrency" name="cashCurrency" required>
										<option value="">Select</option>
										<?php foreach($currencies as $val) { ?>
											<option value="<?=$val['code'];?>"><?=$val['code'] . ' - ' . $val['description'];?></option>
										<?php } ?>
									</select>
								</div>
							</div>
							<div class="form-group row">
								<label for="cashAmount" class="col-md-4">Jumlah</label>
								<div class="col-md-8">
									<input type="text" name="cashAmount" class="form-control" id="cashAmount" />
								</div>
							</div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Tutup</button>
							<button type="submit" class="btn btn-primary font-weight-bold">Simpan</button>
						</div>
					</form>
				</div>
			</div>
		</div>

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
									<select class="form-control selectpicker" data-size="7" data-live-search="true" id="instrumentValas" name="instrumentValas" required>
										<option value="">Select</option>
										<?php foreach($currencies as $val) { ?>
											<option value="<?=$val['code'];?>"><?=$val['code'] . ' - ' . $val['description'];?></option>
										<?php } ?>
									</select>
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

		<!-- Start of modal view -->
		<div class="modal fade" id="reviewModal" name="reviewModal" data-backdrop="static" style="overflow: scroll !important;">
			<div class="modal-dialog modal-xl">
				<div class="modal-content">
					<div class="modal-header">
						<h4 class="modal-title">Data Valas</h4>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					</div>
					<div class="modal-body">
						<!-- No Dokumen -->
						<div class="row">
							<div class="col-md-12 mb-4">
								<h4><span view="no_dok"></span> tanggal <span view="tgl_dok"></span></h4>
							</div>
						</div>
						
						<!-- Data Diri -->
						<div class="row">
							<div class="col-md-6">
								<h5>Data Diri</h5><hr/>
								<table class="table table-bordered">
									<tbody>
										<tr>
											<td class="col-md-4">Nama Lengkap</td>
											<td class="col-md-8"><span view="name"></span></td>
										</tr>
										<tr>
											<td>Kebangsaan</td>
											<td><span view="nationality"></span></td>
										</tr>
										<tr>
											<td>No. Identitas</td>
											<td><span view="identity"></span></td>
										</tr>
										<tr>
											<td>Tanggal Lahir</td>
											<td><span view="birth"></span></td>
										</tr>
										<tr>
											<td>Alamat Identitas</td>
											<td><span view="address"></span></td>
										</tr>
										<tr>
											<td>Pekerjaan</td>
											<td><span view="occupation"></span></td>
										</tr>
										<tr>
											<td>Kepemilikan</td>
											<td><span view="reason"></span></td>
										</tr>
									</tbody>
								</table>
							</div>
							<div class="col-md-6">
								<div class="row">
									<div class="col-md-12">
										<h5>Kepemilikan Pihak Lain</h5><hr/>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<b>Pribadi</b>
									</div>
									<div class="col-md-12">
										<table class="table table-bordered">
											<tbody>
												<tr>
													<td class="col-md-4">Nama</td>
													<td class="col-md-8"><span view="othername"></span></td>
												</tr>
												<tr>
													<td>Kebangsaan</td>
													<td><span view="othernationality"></span></td>
												</tr>
												<tr>
													<td>No. Identitas</td>
													<td><span view="otheridentity"></span></td>
												</tr>
												<tr>
													<td>Tanggal Lahir</td>
													<td><span view="otherbirth"></span></td>
												</tr>
												<tr>
													<td>Alamat</td>
													<td><span view="otheraddress"></span></td>
												</tr>
												<tr>
													<td>Pekerjaan</td>
													<td><span view="otheroccupation"></span></td>
												</tr>
											</tbody>
										</table>
									</div>
									<div class="col-md-12">
										<b>Perusahaan</b>
									</div>
									<div class="col-md-12">
										<table class="table table-bordered">
											<tbody>
												<tr>
													<td class="col-md-4">Nama Perusahaan</td>
													<td class="col-md-8"><span view="corporatename"></span></td>
												</tr>
												<tr>
													<td>Alamat Perusahaan</td>
													<td><span view="corporateaddress"></span></td>
												</tr>
												<tr>
													<td>Jenis Usaha</td>
													<td><span view="corporatetype"></span></td>
												</tr>
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>

						<!-- Data Perjalanan -->
						<div class="row mb-4">
							<div class="col-md-12">
								<h5>Data Perjalanan</h5><hr/>
							</div>
							<div class="col-md-12">
								<table class="table table-bordered">
									<tbody>
										<tr>
											<td class="col-md-3">No. Penerbangan</td>
											<td class="col-md-9"><span view="flightNumber"></span></td>
										</tr>
										<tr>
											<td>Pelabuhan/Tempat Asal</td>
											<td><span view="lastPort"></span></td>
										</tr>
										<tr>
											<td>Pelabuhan/Tempat Tujuan</td>
											<td><span view="nextPort"></span></td>
										</tr>
										<tr>
											<td>Tanggal Tiba</td>
											<td><span view="arrivalDate"></span></td>
										</tr>
										<tr>
											<td>Alamat di Indonesia</td>
											<td><span view="indonesianaddress"></span></td>
										</tr>
										<tr>
											<td>Maksud Perjalanan</td>
											<td><span view="purpose"></span></td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>

						<!-- Data Uang -->
						<div class="row mb-4">
							<div class="col-md-12">
								<h5>Detail Uang</h5><hr/>
							</div>
							<div class="col-md-12">
								<table id="cashTableView" class="table table-bordered">
									<thead>
										<tr>
											<td class="text-center" style="width: 25px;">No</td>
											<td class="text-center">Mata Uang</td>
											<td class="text-center">Jumlah</td>
										</tr>
									</thead>
									<tbody>
										<!-- From get detail data -->
									</tbody>
								</table>
							</div>
						</div>

						<!-- Data IPL -->
						<div class="row mb-4">
							<div class="col-md-12">
								<h5>Detail Instrumen Pembayaran Lain</h5><hr/>
							</div>
							<div class="col-md-12">
								<table id="instrumentTableView" class="table table-bordered">
									<thead>
										<tr>
											<td class="text-center" style="width: 25px;">No</td>
											<td class="text-center">Mata Uang</td>
											<td class="text-center">Jumlah</td>
											<td class="text-center">Jenis</td>
											<td class="text-center">Nomor</td>
											<td class="text-center">Tanggal</td>
											<td class="text-center">Penerbit</td>
										</tr>
									</thead>
									<tbody>
										<!-- From get detail data -->
									</tbody>
								</table>
							</div>
						</div>

						<!-- Data Official -->
						<div class="row mb-4">
							<div class="col-md-12">
								<h5>Keterangan Pejabat BC</h5><hr/>
							</div>
							<div class="col-md-12">
								<table class="table table-bordered">
									<tbody>
										<tr>
											<td class="col-md-3">Hitung Jumlah</td>
											<td class="col-md-9"><span view="count"></span></td>
										</tr>
										<tr>
											<td>Pembawaan Mencurigakan</td>
											<td><span view="suspicion"></span></td>
										</tr>
										<tr>
											<td>Ada Izin BI</td>
											<td><span view="permit"></span></td>
										</tr>
										<tr>
											<td>Hasil</td>
											<td><span view="result"></span></td>
										</tr>
										<tr>
											<td>Pejabat</td>
											<td><span view="officer"></span></td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>

						<!-- Attachments -->
						<div class="row">
							<div class="col-md-12">
								<h5>Lampiran</h5><hr/>
							</div>
							<div class="col-md-12">
								<table id="attachmentTableView" class="table table-bordered">
									<thead>
										<tr>
											<td class="text-center" style="width: 25px;">No</td>
											<td class="text-center">Keterangan</td>
											<td class="text-center">File</td>
										</tr>
									</thead>
									<tbody>
										<!-- From get detail data -->
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
		<!-- End of modal view -->

        <?php $this->load->view('aside/user');?>    
        <?php $this->load->view('aside/script');?>

        <script src="<?=base_url('assets/js/app.departure.js'); ?>"></script>
    </body>
</html>
