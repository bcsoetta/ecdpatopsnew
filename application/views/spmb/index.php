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
                    <!--begin::Page-->
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
                                                        <a href="" class="text-muted">SPMB</a>
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
                                                    <h3 class="card-label">Data SPMB</h3>
                                                </div>
                                                <div class="card-toolbar">
                                                    <!--begin::Dropdown-->
                                                    <div class="dropdown dropdown-inline mr-2">
                                                        <button type="button" class="btn btn-light-primary font-weight-bolder dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <span class="svg-icon svg-icon-md">
                                                            <!--begin::Svg Icon | path:assets/media/svg/icons/Design/PenAndRuller.svg-->
                                                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                    <rect x="0" y="0" width="24" height="24" />
                                                                    <path d="M3,16 L5,16 C5.55228475,16 6,15.5522847 6,15 C6,14.4477153 5.55228475,14 5,14 L3,14 L3,12 L5,12 C5.55228475,12 6,11.5522847 6,11 C6,10.4477153 5.55228475,10 5,10 L3,10 L3,8 L5,8 C5.55228475,8 6,7.55228475 6,7 C6,6.44771525 5.55228475,6 5,6 L3,6 L3,4 C3,3.44771525 3.44771525,3 4,3 L10,3 C10.5522847,3 11,3.44771525 11,4 L11,19 C11,19.5522847 10.5522847,20 10,20 L4,20 C3.44771525,20 3,19.5522847 3,19 L3,16 Z" fill="#000000" opacity="0.3" />
                                                                    <path d="M16,3 L19,3 C20.1045695,3 21,3.8954305 21,5 L21,15.2485298 C21,15.7329761 20.8241635,16.200956 20.5051534,16.565539 L17.8762883,19.5699562 C17.6944473,19.7777745 17.378566,19.7988332 17.1707477,19.6169922 C17.1540423,19.602375 17.1383289,19.5866616 17.1237117,19.5699562 L14.4948466,16.565539 C14.1758365,16.200956 14,15.7329761 14,15.2485298 L14,5 C14,3.8954305 14.8954305,3 16,3 Z" fill="#000000" />
                                                                </g>
                                                            </svg>
                                                            <!--end::Svg Icon-->
                                                        </span>Export</button>
                                                        <!--begin::Dropdown Menu-->
                                                        <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                                                            <!--begin::Navigation-->
                                                            <ul class="navi flex-column navi-hover py-2">
                                                                <li class="navi-header font-weight-bolder text-uppercase font-size-sm text-primary pb-2">Choose an option:</li>
                                                                <li class="navi-item">
                                                                    <a href="#" class="navi-link">
                                                                        <span class="navi-icon">
                                                                            <i class="la la-print"></i>
                                                                        </span>
                                                                        <span class="navi-text">Print</span>
                                                                    </a>
                                                                </li>
                                                                <li class="navi-item">
                                                                    <a href="#" class="navi-link">
                                                                        <span class="navi-icon">
                                                                            <i class="la la-copy"></i>
                                                                        </span>
                                                                        <span class="navi-text">Copy</span>
                                                                    </a>
                                                                </li>
                                                                <li class="navi-item">
                                                                    <a href="#" class="navi-link">
                                                                        <span class="navi-icon">
                                                                            <i class="la la-file-excel-o"></i>
                                                                        </span>
                                                                        <span class="navi-text">Excel</span>
                                                                    </a>
                                                                </li>
                                                                <li class="navi-item">
                                                                    <a href="#" class="navi-link">
                                                                        <span class="navi-icon">
                                                                            <i class="la la-file-text-o"></i>
                                                                        </span>
                                                                        <span class="navi-text">CSV</span>
                                                                    </a>
                                                                </li>
                                                                <li class="navi-item">
                                                                    <a href="#" class="navi-link">
                                                                        <span class="navi-icon">
                                                                            <i class="la la-file-pdf-o"></i>
                                                                        </span>
                                                                        <span class="navi-text">PDF</span>
                                                                    </a>
                                                                </li>
                                                            </ul>
                                                            <!--end::Navigation-->
                                                        </div>
                                                        <!--end::Dropdown Menu-->
                                                    </div>
                                                    <!--end::Dropdown-->
                                                    <!--begin::Button-->
                                                    <button class="btn btn-primary" id="add_spmb">
                                                        <span class="svg-icon svg-icon-md">
                                                            <!--begin::Svg Icon | path:assets/media/svg/icons/Design/Flatten.svg-->
                                                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                    <rect x="0" y="0" width="24" height="24" />
                                                                    <circle fill="#000000" cx="9" cy="15" r="6" />
                                                                    <path d="M8.8012943,7.00241953 C9.83837775,5.20768121 11.7781543,4 14,4 C17.3137085,4 20,6.6862915 20,10 C20,12.2218457 18.7923188,14.1616223 16.9975805,15.1987057 C16.9991904,15.1326658 17,15.0664274 17,15 C17,10.581722 13.418278,7 9,7 C8.93357256,7 8.86733422,7.00080962 8.8012943,7.00241953 Z" fill="#000000" opacity="0.3" />
                                                                </g>
                                                            </svg>
                                                            <!--end::Svg Icon-->
                                                        </span><i class="fa fa-plus"></i> SPMB Baru
                                                    </button>
                                                    <!--end::Button-->
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <!--begin: Datatable-->
                                                <table class="table table-bordered table-hover table-checkable" id="kt_datatable" style="margin-top: 13px !important">
                                                    <thead>
                                                        <tr>
                                                            <!-- <th>ID</th> -->
                                                            <th>No. Dokumen</th>
                                                            <th>Tanggal Dokumen</th>
                                                            <th>Penumpang</th>
                                                            <th>Nomor identitas</th>
                                                            <th>No. Penerbangan</th>
                                                            <th>Status</th>
                                                            <th>Actions</th>
                                                        </tr>
                                                    </thead>
                                                </table>
                                                <!--end: Datatable-->
                                            </div>
                                        </div>
                                        <!--end::Card-->
                                    </div>
                                    <!--end::Container-->
                                </div>
                                <!--end::Entry-->


                            </div>
                            <!--end::Content-->

                            <?php $this->load->view('aside/foot');?>
                        </div>
                        <!--end::Wrapper-->
                    </div>
                    <!--end::Page-->
                </div>
        <!--end::Main-->
        
        <!-- Modal Passenger-->
        <div class="modal fade" id="staticBackdrop" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="overflow-y:auto;">
            <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
                <div class="modal-content">
                    <form class="form" id="spmb_form">
                        <input type="hidden" name="key_header" id="key_header" />
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Buat SPMB</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <i aria-hidden="true" class="ki ki-close"></i>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-form-label text-right col-md-5">Kantor Keberangkatan <span class="text-danger">*</span></label>
                                        <div class="col-md-7">
                                            <select class="form-control selectpicker" data-size="7" data-live-search="true" name="spmb_pab_depart">
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
                                    <div class="form-group row">
                                        <label class="col-form-label text-right col-md-5">Kantor Tujuan <span class="text-danger">*</span></label>
                                        <div class="col-md-7">
                                            <select class="form-control selectpicker" data-size="7" data-live-search="true" name="spmb_pab_arrival">
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
                                    <div class="form-group row">
                                        <label class="col-form-label text-right col-md-3">No. Penerbangan <span class="text-danger">*</span></label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" name="spmb_flight_numb" required />
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-form-label text-right col-md-3">No. Paspor <span class="text-danger">*</span></label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" name="spmb_pass_numb" required />
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-form-label text-right col-md-3">Nama <span class="text-danger">*</span></label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" name="spmb_name" required />
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-form-label text-right col-md-3">Tanggal Lahir <span class="text-danger">*</span></label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" id="kt_datepicker_1" placeholder="Select date" name="spmb_datebirth" />
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-form-label text-right col-md-3">Pekerjaan</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" name="spmb_occupation" required />
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-form-label text-right col-md-3">No. NPWP/NIB/NIK</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" name="spmb_npwp" required />
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-form-label text-right col-md-2">Handphone</label>
                                        <div class="col-md-4">
                                            <input type="text" class="form-control" name="spmb_phone" required />
                                        </div>
                                        <label class="col-form-label text-right col-md-1">Email</label>
                                        <div class="col-md-5">
                                            <input type="email" class="form-control" placeholder="name@example.com" name="spmb_email" required />
                                        </div>
                                    </div>
                                    
                                    <div class="form-group row">
                                        <label class="col-form-label text-right col-md-3">Kebangsaan</label>
                                        <div class="col-md-9">
                                            <select class="form-control selectpicker" data-size="7" data-live-search="true" name="spmb_nationality">
                                                <!-- set indo as selected value -->
                                                <!-- <option value="">Select</option> -->
                                                <?php
                                                    foreach($countries as $val) { ?>
                                                        <option <?= ($val['id'] == '76') ? 'selected' : '';?> value="<?=$val['id'];?>"><?=$val['name'];?></option>
                                                    <?php
                                                    }
                                                 ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-form-label text-right col-md-3">Alamat</label>
                                        <div class="col-md-9">
                                            <textarea class="form-control" rows="2" name="spmb_address" required></textarea>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group row">
                                        <label class="col-form-label text-right col-md-4">Negara Tujuan</label>
                                        <div class="col-md-8">
                                            
                                            <select class="form-control selectpicker" data-size="7" data-live-search="true" name="spmb_airport_arrival" required> 
                                                <option value=""> - </option>
                                                 <?php
                                                    foreach($countries as $val) { ?>
                                                        <option value="<?=$val['id'];?>"><?=$val['name'];?></option>
                                                    <?php
                                                    }
                                                 ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-form-label text-right col-md-4">Maksud Pembawaan</label>
                                        <div class="col-md-8">
                                            <input type="text" name="spmb_reason" class="form-control" required />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="row">
                                        <button type="button" id="add_item" class="btn btn-success btn-lg btn-block" data-toggle="modal" data-target="#GoodsModal"><i class="fa fa-plus"></i> Data Barang</button>
                                    </div>
                                    <div class="separator separator-dashed mt-4 mb-8"></div>
                                    <div class="row">
                                        <table id="show_item_list_new_spmb" class="table table-bordered table-hover">
                                            <thead>
                                                <!-- <th>No. Dokumen</th> -->
                                                <th>Nama Barang</th>
                                                <th>Jumlah</th>
                                                <th>Kemasan</th>
                                                <th>Berat</th>
                                                <th>Harga</th>
                                                <!-- <th>Lampiran</th> -->
                                                <th>Menu</th>
                                            </thead>
                                            <tbody></tbody>
                                        </table>
                                    </div>
                                    <!-- Dokumen pelengkap -->
                                    <div class="row">
                                        <button type="button" id="add_docs" class="btn btn-success btn-lg btn-block" data-toggle="modal" data-target="#docs_modal"><i class="fa fa-plus"></i> Dokumen Pelengkap</button>
                                    </div>
                                    <!-- <div class="separator separator-dashed mt-4 mb-8"></div> -->
                                    <div class="row">
                                        <table id="show_docs" class="table table-bordered table-hover">
                                            <thead>
                                                <th>Jenis</th>
                                                <th>No. Dokumen</th>
                                                <th>Tanggal</th>
                                                <th>Menu</th>
                                            </thead>
                                            <tbody></tbody>
                                        </table>
                                    </div>
                                </div>
                                <!-- end col right -->
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

        <!-- dokumen pelengkap form -->
        <div class="modal fade" id="docs_modal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <form class="form" id="spmb_docs_form" name="spmb_docs_form" enctype="multipart/form-data">
                        <input type="hidden" name="key_doc" id="key_doc" />
                        <div class="modal-header" style="background-color: #1BC5BD;">
                            <h5 class="modal-title" id="exampleModalLabel">Dokumen Pelengkap</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <i aria-hidden="true" class="ki ki-close"></i>
                            </button>
                        </div>
                        <!-- end modal header -->
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group row">
                                        <label class="col-form-label col-md-4">Jenis Dokumen</label>
                                        <div class="col-md-4">
                                            <input type="text" class="form-control" name="doc_type" required />
                                        </div>
                                        <div class="col-md-4">&nbsp;</div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-form-label col-md-4">Nomor Dokumen</label>
                                        <div class="col-md-4">
                                            <input type="text" class="form-control" name="doc_number" required />
                                        </div>
                                        <div class="col-md-4">&nbsp;</div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-form-label col-md-4">Tanggal Dokumen</label>
                                        <div class="col-md-4">
                                            <input type="text" placeholder="yyyy-mm-dd" class="form-control" id="doc_date" name="doc_date" value="<?= date('Y-m-d');?>" required />
                                        </div>
                                        <div class="col-md-4">&nbsp;</div>
                                    </div>
                                    <div class="form-group">
                                        <label for="itemAttach">Lampiran</label>
                                        <input type="file" class="form-control" name="itemAttach1" id="itemAttach1" accept="image/png, image/gif, image/jpeg" />
                                        <input type="file" class="form-control" name="itemAttach2" id="itemAttach2" accept="image/png, image/gif, image/jpeg" />
                                        <input type="file" class="form-control" name="itemAttach3" id="itemAttach3" accept="image/png, image/gif, image/jpeg" />
                                    </div>
                                </div>      
                            </div>
                        </div>
                        <!-- end modal body -->
                        <div class="modal-footer" style="background-color: #1BC5BD;">
                            <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary font-weight-bold">Add</button>
                        </div>
                    </form>
                </div> 
                <!-- end modal content -->
            </div>
        </div>
        <!-- Modal Goods-->
        <div class="modal fade" id="GoodsModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <form class="form" id="spmb_goods_form" name="spmb_goods_form">
                        <input type="hidden" name="itemID" id="itemID" />
                        <input type="hidden" name="key_item" id="key_item" />
                        <div class="modal-header" style="background-color: #1BC5BD;">
                            <h5 class="modal-title" id="exampleModalLabel">Tambah Data Barang</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <i aria-hidden="true" class="ki ki-close"></i>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-form-label text-right col-md-2">Name Barang</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" name="goods_name" required />
                                        </div>
                                    </div> 
                                    <div class="form-group row">
                                        <label class="col-form-label text-right col-md-2">Jumlah</label>
                                        <div class="col-md-4">
                                            <input type="text" class="form-control" id="goods_quantity" name="goods_quantity" required />
                                        </div>
                                        <div class="col-md-6">
                                            <select class="form-control selectpicker" data-size="9" data-live-search="true" name="goods_jenis_satuan" required>
                                                <option value=""> - </option>
                                                <?php
                                                foreach($qty_type as $val) { ?>
                                                    <option value="<?=$val['id'];?>"><?=$val['name'];?></option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-form-label text-right col-md-2">Kemasan </label>
                                        <div class="col-md-4">
                                            <input type="text" class="form-control" name="goods_jumlah_kemasan" />
                                        </div>
                                        <div class="col-md-6">
                                            <select class="form-control selectpicker" data-size="9" data-live-search="true" name="goods_jenis_kemasan" required>
                                                <option value=""> - </option>
                                                    <!-- Top 3 -->
                                                    <option value="SU (Suitcase)">SU (Suitcase)</option>
                                                    <option value="CT (Carton)">CT (Carton)</option>
                                                    <option value="CS (Case)">CS (Case)</option>

                                                    <option value="1A (Drum, steel)">1A (Drum, steel)</option>
                                                    <option value="1B (Drum, aluminium)">1B (Drum, aluminium)</option>
                                                    <option value="1D (Drum, plywood)">1D (Drum, plywood)</option>
                                                    <option value="1G (Drum, fibre)">1G (Drum, fibre)</option>
                                                    <option value="1W (Drum, wooden)">1W (Drum, wooden)</option>
                                                    <option value="2C (Barrel, wooden)">2C (Barrel, wooden)</option>
                                                    <option value="3A (Jerrican, steel)">3A (Jerrican, steel)</option>
                                                    <option value="3H (Jerrican, plastic)">3H (Jerrican, plastic)</option>
                                                    <option value="43 (Bag, super bulk)">43 (Bag, super bulk)</option>
                                                    <option value="4A (Box, steel)">4A (Box, steel)</option>
                                                    <option value="4B (Box, aluminium)">4B (Box, aluminium)</option>
                                                    <option value="4C (Box, natural wood)">4C (Box, natural wood)</option>
                                                    <option value="4D (Box, plywood)">4D (Box, plywood)</option>
                                                    <option value="4F (Box, reconstituted wood)">4F (Box, reconstituted wood)</option>
                                                    <option value="4G (Box, fibreboard)">4G (Box, fibreboard)</option>
                                                    <option value="4H (Box, plastic)">4H (Box, plastic)</option>
                                                    <option value="5H (Bag, woven plastic)">5H (Bag, woven plastic)</option>
                                                    <option value="5L (Bag, textile)">5L (Bag, textile)</option>
                                                    <option value="5M (Bag, paper)">5M (Bag, paper)</option>
                                                    <option value="6H (Composite packaging, plastic receptacle)">6H (Composite packaging, plastic receptacle)</option>
                                                    <option value="6P (Composite packaging, glass receptacle)">6P (Composite packaging, glass receptacle)</option>
                                                    <option value="AA (Intermediate bulk container, rigid plastic)">AA (Intermediate bulk container, rigid plastic)</option>
                                                    <option value="AB (Receptacle, fibre)">AB (Receptacle, fibre)</option>
                                                    <option value="AC (Receptacle, paper)">AC (Receptacle, paper)</option>
                                                    <option value="AD (Receptacle, wooden)">AD (Receptacle, wooden)</option>
                                                    <option value="AE (Aerosol)">AE (Aerosol)</option>
                                                    <option value="AF (Pallet, modular, collars 80cms * 60cms)">AF (Pallet, modular, collars 80cms * 60cms)</option>
                                                    <option value="AG (Pallet, shrinkwrapped)">AG (Pallet, shrinkwrapped)</option>
                                                    <option value="AH (Pallet, 100cms * 110cms)">AH (Pallet, 100cms * 110cms)</option>
                                                    <option value="AI (Clamshell)">AI (Clamshell)</option>
                                                    <option value="AJ (Cone)">AJ (Cone)</option>
                                                    <option value="AM (Ampoule, non protected)">AM (Ampoule, non protected)</option>
                                                    <option value="AP (Ampoule, protected)">AP (Ampoule, protected)</option>
                                                    <option value="AT (Atomizer)">AT (Atomizer)</option>
                                                    <option value="AV (Capsule)">AV (Capsule)</option>
                                                    <option value="BA (Barrel)">BA (Barrel)</option>
                                                    <option value="BB (Bobbin)">BB (Bobbin)</option>
                                                    <option value="BC (Bottlecrate, bottlerack)">BC (Bottlecrate, bottlerack)</option>
                                                    <option value="BD (Board)">BD (Board)</option>
                                                    <option value="BE (Bundle)">BE (Bundle)</option>
                                                    <option value="BF (Balloon, non-protected)">BF (Balloon, non-protected)</option>
                                                    <option value="BG (Bag)">BG (Bag)</option>
                                                    <option value="BH (Bunch)">BH (Bunch)</option>
                                                    <option value="BI (Bin)">BI (Bin)</option>
                                                    <option value="BJ (Bucket)">BJ (Bucket)</option>
                                                    <option value="BK (Basket)">BK (Basket)</option>
                                                    <option value="BL (Bale, compressed)">BL (Bale, compressed)</option>
                                                    <option value="BM (Basin)">BM (Basin)</option>
                                                    <option value="BN (Bale, non -compressed)">BN (Bale, non -compressed)</option>
                                                    <option value="BO (Bottle, non-protected, cylindrical)">BO (Bottle, non-protected, cylindrical)</option>
                                                    <option value="BP (Balloon, protected)">BP (Balloon, protected)</option>
                                                    <option value="BQ (Bottle, protected cylindrical)">BQ (Bottle, protected cylindrical)</option>
                                                    <option value="BR (Bar)">BR (Bar)</option>
                                                    <option value="BS (Bottle, non-protected, bulbous)">BS (Bottle, non-protected, bulbous)</option>
                                                    <option value="BT (Bolt)">BT (Bolt)</option>
                                                    <option value="BU (Butt)">BU (Butt)</option>
                                                    <option value="BV (Bottle, protected bulbous)">BV (Bottle, protected bulbous)</option>
                                                    <option value="BW (Box, for liquids)">BW (Box, for liquids)</option>
                                                    <option value="BX (Box)">BX (Box)</option>
                                                    <option value="BY (Board, in bundle/bunch/truss)">BY (Board, in bundle/bunch/truss)</option>
                                                    <option value="BZ (Bars, in bundle/bunch/truss)">BZ (Bars, in bundle/bunch/truss)</option>
                                                    <option value="CA (Can, rectangular)">CA (Can, rectangular)</option>
                                                    <option value="CB (Beer crate)">CB (Beer crate)</option>
                                                    <option value="CC (Churn)">CC (Churn)</option>
                                                    <option value="CD (Can, with handle and spout)">CD (Can, with handle and spout)</option>
                                                    <option value="CE (Creel)">CE (Creel)</option>
                                                    <option value="CF (Coffer)">CF (Coffer)</option>
                                                    <option value="CG (Cage)">CG (Cage)</option>
                                                    <option value="CH (Chest)">CH (Chest)</option>
                                                    <option value="CI (Canister)">CI (Canister)</option>
                                                    <option value="CJ (Coffin)">CJ (Coffin)</option>
                                                    <option value="CK (Cask)">CK (Cask)</option>
                                                    <option value="CL (Coil)">CL (Coil)</option>
                                                    <option value="CM (Card)">CM (Card)</option>
                                                    <option value="CN (Cont,not otherwise specfied as transport equipment)">CN (Cont,not otherwise specfied as transport equipment)</option>
                                                    <option value="CO (Carboy, non-protected)">CO (Carboy, non-protected)</option>
                                                    <option value="CP (Carboy, protected)">CP (Carboy, protected)</option>
                                                    <option value="CQ (Cartridge)">CQ (Cartridge)</option>
                                                    <option value="CR (Crate)">CR (Crate)</option>
                                                    
                                                    
                                                    <option value="CU (Cup)">CU (Cup)</option>
                                                    <option value="CV (Cover)">CV (Cover)</option>
                                                    <option value="CW (Cage, roll)">CW (Cage, roll)</option>
                                                    <option value="CX (Can, cylindical)">CX (Can, cylindical)</option>
                                                    <option value="CY (Cylinder)">CY (Cylinder)</option>
                                                    <option value="CZ (Canvas)">CZ (Canvas)</option>
                                                    <option value="DA (Crate, multiple layer, plastic)">DA (Crate, multiple layer, plastic)</option>
                                                    <option value="DB (Crate, multiple layer, wooden)">DB (Crate, multiple layer, wooden)</option>
                                                    <option value="DC (Crate, multiple layer, cardboard)">DC (Crate, multiple layer, cardboard)</option>
                                                    <option value="DG (Cage, Commonwealth Handling Equipment Pool  (CHEP))">DG (Cage, Commonwealth Handling Equipment Pool  (CHEP))</option>
                                                    <option value="DH (Box,Commnwealth Hndling Equipmnt Pool/CHEP,Eurobox)">DH (Box,Commnwealth Hndling Equipmnt Pool/CHEP,Eurobox)</option>
                                                    <option value="DI (Drum, iron)">DI (Drum, iron)</option>
                                                    <option value="DJ (Demijohn, non-protected)">DJ (Demijohn, non-protected)</option>
                                                    <option value="DK (Crate, bulk, cardboard)">DK (Crate, bulk, cardboard)</option>
                                                    <option value="DL (Crate, bulk, plastic)">DL (Crate, bulk, plastic)</option>
                                                    <option value="DM (Crate, bulk, wooden)">DM (Crate, bulk, wooden)</option>
                                                    <option value="DN (Dispenser)">DN (Dispenser)</option>
                                                    <option value="DP (Demijohn, protected)">DP (Demijohn, protected)</option>
                                                    <option value="DR (Drum)">DR (Drum)</option>
                                                    <option value="DS (Tray, one layer no cover, plastic)">DS (Tray, one layer no cover, plastic)</option>
                                                    <option value="DT (Tray, one layer no cover, wooden)">DT (Tray, one layer no cover, wooden)</option>
                                                    <option value="DU (Tray, one layer no cover, polystyrene)">DU (Tray, one layer no cover, polystyrene)</option>
                                                    <option value="DV (Tray, one layer no cover, cardboard)">DV (Tray, one layer no cover, cardboard)</option>
                                                    <option value="DW (Tray, two layers no cover, plastic tray)">DW (Tray, two layers no cover, plastic tray)</option>
                                                    <option value="DX (Tray, two layers no cover, wooden)">DX (Tray, two layers no cover, wooden)</option>
                                                    <option value="DY (Tray, two layers no cover, cardboard)">DY (Tray, two layers no cover, cardboard)</option>
                                                    <option value="EC (Bag, plastic)">EC (Bag, plastic)</option>
                                                    <option value="ED (Case, with pallet base)">ED (Case, with pallet base)</option>
                                                    <option value="EE (Case, with pallet base, wooden)">EE (Case, with pallet base, wooden)</option>
                                                    <option value="EF (Case, with pallet base, cardboard)">EF (Case, with pallet base, cardboard)</option>
                                                    <option value="EG (Case, with pallet base, plastic)">EG (Case, with pallet base, plastic)</option>
                                                    <option value="EH (Case, with pallet base, metal)">EH (Case, with pallet base, metal)</option>
                                                    <option value="EI (Case, isothermic)">EI (Case, isothermic)</option>
                                                    <option value="EN (Envelope)">EN (Envelope)</option>
                                                    <option value="FC (Fruit crate)">FC (Fruit crate)</option>
                                                    <option value="FD (Framed crate)">FD (Framed crate)</option>
                                                    <option value="FI (Firkin)">FI (Firkin)</option>
                                                    <option value="FL (Flask)">FL (Flask)</option>
                                                    <option value="FO (Footlocker)">FO (Footlocker)</option>
                                                    <option value="FP (Filmpack)">FP (Filmpack)</option>
                                                    <option value="FR (Frame)">FR (Frame)</option>
                                                    <option value="FT (Foodtainer)">FT (Foodtainer)</option>
                                                    <option value="FW (Cart, flatbed)">FW (Cart, flatbed)</option>
                                                    <option value="FX (Bag, flexible container)">FX (Bag, flexible container)</option>
                                                    <option value="GB (Gas bottle)">GB (Gas bottle)</option>
                                                    <option value="GI (Girder)">GI (Girder)</option>
                                                    <option value="GR (Receptacle, glass)">GR (Receptacle, glass)</option>
                                                    <option value="GU (Tray, containing horizontally stacked flat items)">GU (Tray, containing horizontally stacked flat items)</option>
                                                    <option value="GZ (Girders, in bundle/bunch/truss)">GZ (Girders, in bundle/bunch/truss)</option>
                                                    <option value="HA (Basket, with handle, plastic)">HA (Basket, with handle, plastic)</option>
                                                    <option value="HB (Basket, with handle, wooden)">HB (Basket, with handle, wooden)</option>
                                                    <option value="HC (Basket, with handle, cardboard)">HC (Basket, with handle, cardboard)</option>
                                                    <option value="HG (Hogshead)">HG (Hogshead)</option>
                                                    <option value="HR (Hamper)">HR (Hamper)</option>
                                                    <option value="IA (Package, display, wooden)">IA (Package, display, wooden)</option>
                                                    <option value="IB (Package, display, cardboard)">IB (Package, display, cardboard)</option>
                                                    <option value="IC (Package, display, plastic)">IC (Package, display, plastic)</option>
                                                    <option value="ID (Package, display, metal)">ID (Package, display, metal)</option>
                                                    <option value="IE (Package, show)">IE (Package, show)</option>
                                                    <option value="IF (Package, flow)">IF (Package, flow)</option>
                                                    <option value="IG (Package, paper wrapped)">IG (Package, paper wrapped)</option>
                                                    <option value="IH (Drum, plastic)">IH (Drum, plastic)</option>
                                                    <option value="IK (Package, cardboard, with bottle grip-holes)">IK (Package, cardboard, with bottle grip-holes)</option>
                                                    <option value="IL (Tray, rigid, lidded stackable (CEN TS 14482:2002))">IL (Tray, rigid, lidded stackable (CEN TS 14482:2002))</option>
                                                    <option value="IN (Ingot)">IN (Ingot)</option>
                                                    <option value="IZ (ingots, in bundle/bunch/truss)">IZ (ingots, in bundle/bunch/truss)</option>
                                                    <option value="JC (Jerrican, rectangular)">JC (Jerrican, rectangular)</option>
                                                    <option value="JG (Jug)">JG (Jug)</option>
                                                    <option value="JR (Jar)">JR (Jar)</option>
                                                    <option value="JT (Jutebag)">JT (Jutebag)</option>
                                                    <option value="JY (Jerrican, cylindrical)">JY (Jerrican, cylindrical)</option>
                                                    <option value="KG (Keg)">KG (Keg)</option>
                                                    <option value="KR (karung)">KR (karung)</option>
                                                    <option value="LG (Log)">LG (Log)</option>
                                                    <option value="LT (Lot)">LT (Lot)</option>
                                                    <option value="LV (Liftvan)">LV (Liftvan)</option>
                                                    <option value="LZ (Logs, in bundle/bunch/truss)">LZ (Logs, in bundle/bunch/truss)</option>
                                                    <option value="MB (Multiply bag)">MB (Multiply bag)</option>
                                                    <option value="MC (milk crate)">MC (milk crate)</option>
                                                    <option value="MR (Receptacle, metal)">MR (Receptacle, metal)</option>
                                                    <option value="MS (Multiwall sack)">MS (Multiwall sack)</option>
                                                    <option value="MT (Mat)">MT (Mat)</option>
                                                    <option value="MW (Receptacle, plastic wrapped)">MW (Receptacle, plastic wrapped)</option>
                                                    <option value="MX (Macth box)">MX (Macth box)</option>
                                                    <option value="NA (Not available)">NA (Not available)</option>
                                                    <option value="NE (Unpacked or unpackaged)">NE (Unpacked or unpackaged)</option>
                                                    <option value="NF (Unpacked or unpackaged, single unit)">NF (Unpacked or unpackaged, single unit)</option>
                                                    <option value="NG (Unpacked or unpackaged, multiple units)">NG (Unpacked or unpackaged, multiple units)</option>
                                                    <option value="NS (Nest)">NS (Nest)</option>
                                                    <option value="NT (Net)">NT (Net)</option>
                                                    <option value="NU (Net, tube, plastic)">NU (Net, tube, plastic)</option>
                                                    <option value="NV (Net, tube, textile)">NV (Net, tube, textile)</option>
                                                    <option value="OA (Pallet, CHEP 40 cm x 60 cm)">OA (Pallet, CHEP 40 cm x 60 cm)</option>
                                                    <option value="OB (Pallet, CHEP 80 cm x 120 cm)">OB (Pallet, CHEP 80 cm x 120 cm)</option>
                                                    <option value="OC (Pallet, CHEP 100 cm x 120 cm)">OC (Pallet, CHEP 100 cm x 120 cm)</option>
                                                    <option value="OD (Pallet, AS 4068-1993)">OD (Pallet, AS 4068-1993)</option>
                                                    <option value="OE (Pallet, ISO T11)">OE (Pallet, ISO T11)</option>
                                                    <option value="OF (Platform, unspecified weight or dimension)">OF (Platform, unspecified weight or dimension)</option>
                                                    <option value="OK (Block)">OK (Block)</option>
                                                    <option value="PA (Packet)">PA (Packet)</option>
                                                    <option value="PB (Pallet, box Combined open-ended box and pallet)">PB (Pallet, box Combined open-ended box and pallet)</option>
                                                    <option value="PC (Parcel)">PC (Parcel)</option>
                                                    <option value="PD (Pallet, modular, collars 80cms * 100cms)">PD (Pallet, modular, collars 80cms * 100cms)</option>
                                                    <option value="PE (Pallet, modular, collars 80cms * 120cms)">PE (Pallet, modular, collars 80cms * 120cms)</option>
                                                    <option value="PF (Pen)">PF (Pen)</option>
                                                    <option value="PG (Plate)">PG (Plate)</option>
                                                    <option value="PH (Pitcher)">PH (Pitcher)</option>
                                                    <option value="PI (Pipe)">PI (Pipe)</option>
                                                    <option value="PJ (Punnet)">PJ (Punnet)</option>
                                                    <option value="PK (Package)">PK (Package)</option>
                                                    <option value="PL (Pail)">PL (Pail)</option>
                                                    <option value="PN (Plank)">PN (Plank)</option>
                                                    <option value="PO (Pouch)">PO (Pouch)</option>
                                                    <option value="PR (Receptacle, plastic)">PR (Receptacle, plastic)</option>
                                                    <option value="PT (Pot)">PT (Pot)</option>
                                                    <option value="PU (Tray)">PU (Tray)</option>
                                                    <option value="PV (Pipes, in bundle/bunch/truss)">PV (Pipes, in bundle/bunch/truss)</option>
                                                    <option value="PX (Pallet)">PX (Pallet)</option>
                                                    <option value="PY (Plates, in bundle/bunch/truss)">PY (Plates, in bundle/bunch/truss)</option>
                                                    <option value="PZ (Pipes, in bundle/bunch/truss)">PZ (Pipes, in bundle/bunch/truss)</option>
                                                    <option value="QA (Drum, steel, non-removable head)">QA (Drum, steel, non-removable head)</option>
                                                    <option value="QB (Drum, steel, removable head)">QB (Drum, steel, removable head)</option>
                                                    <option value="QC (Drum, aluminium, non-removable head)">QC (Drum, aluminium, non-removable head)</option>
                                                    <option value="QD (Drum, aluminium, removable head)">QD (Drum, aluminium, removable head)</option>
                                                    <option value="QF (Drum, plastic, non-removable head)">QF (Drum, plastic, non-removable head)</option>
                                                    <option value="QG (Drum, plastic, removable head)">QG (Drum, plastic, removable head)</option>
                                                    <option value="QH (Barrel, wooden, bung type)">QH (Barrel, wooden, bung type)</option>
                                                    <option value="QJ (Barrel, wooden, removable head)">QJ (Barrel, wooden, removable head)</option>
                                                    <option value="QK (Jerrican, steel, non-removable head)">QK (Jerrican, steel, non-removable head)</option>
                                                    <option value="QL (Jerrican, steel, removable head)">QL (Jerrican, steel, removable head)</option>
                                                    <option value="QM (Jerrican, plastic, non-removable head)">QM (Jerrican, plastic, non-removable head)</option>
                                                    <option value="QN (Jerrican, plastic, removable head)">QN (Jerrican, plastic, removable head)</option>
                                                    <option value="QP (Box, wooden, natural wood, ordinary)">QP (Box, wooden, natural wood, ordinary)</option>
                                                    <option value="QQ (Box, wooden, natural wood, with sift proof walls)">QQ (Box, wooden, natural wood, with sift proof walls)</option>
                                                    <option value="QR (Box, plastic, expanded)">QR (Box, plastic, expanded)</option>
                                                    <option value="QS (Box, plastic, solid)">QS (Box, plastic, solid)</option>
                                                    <option value="RD (Rod)">RD (Rod)</option>
                                                    <option value="RG (Ring)">RG (Ring)</option>
                                                    <option value="RJ (Rack, clothing hanger)">RJ (Rack, clothing hanger)</option>
                                                    <option value="RK (Rack)">RK (Rack)</option>
                                                    <option value="RL (Reel)">RL (Reel)</option>
                                                    <option value="RO (Roll)">RO (Roll)</option>
                                                    <option value="RT (Rednet)">RT (Rednet)</option>
                                                    <option value="RZ (Rods, in bundle/ bunch/truss)">RZ (Rods, in bundle/ bunch/truss)</option>
                                                    <option value="SA (Sack)">SA (Sack)</option>
                                                    <option value="SB (Slab)">SB (Slab)</option>
                                                    <option value="SC (Shallow crate)">SC (Shallow crate)</option>
                                                    <option value="SD (Spindle)">SD (Spindle)</option>
                                                    <option value="SE (Sea-chest)">SE (Sea-chest)</option>
                                                    <option value="SH (Sachet)">SH (Sachet)</option>
                                                    <option value="SI (Skid)">SI (Skid)</option>
                                                    <option value="SK (Skeleton case)">SK (Skeleton case)</option>
                                                    <option value="SL (Slipsheet)">SL (Slipsheet)</option>
                                                    <option value="SM (Sheetmetal)">SM (Sheetmetal)</option>
                                                    <option value="SO (Spool)">SO (Spool)</option>
                                                    <option value="SP (Sheet, plastic wrapping)">SP (Sheet, plastic wrapping)</option>
                                                    <option value="SS (Case, steel)">SS (Case, steel)</option>
                                                    <option value="ST (Sheet)">ST (Sheet)</option>
                                                    
                                                    <option value="SV (Envelope, steel)">SV (Envelope, steel)</option>
                                                    <option value="SW (Shrinkwrapped)">SW (Shrinkwrapped)</option>
                                                    <option value="SX (Set)">SX (Set)</option>
                                                    <option value="SY (Sleeve)">SY (Sleeve)</option>
                                                    <option value="SZ (Sheets, in bundle/bunch/truss)">SZ (Sheets, in bundle/bunch/truss)</option>
                                                    <option value="TB (Tub)">TB (Tub)</option>
                                                    <option value="TC (Tea-chest)">TC (Tea-chest)</option>
                                                    <option value="TD (Collapsible tube)">TD (Collapsible tube)</option>
                                                    <option value="TI (Tierce)">TI (Tierce)</option>
                                                    <option value="TK (Tank, rectangular)">TK (Tank, rectangular)</option>
                                                    <option value="TL (Tub, with lid)">TL (Tub, with lid)</option>
                                                    <option value="TN (Tin)">TN (Tin)</option>
                                                    <option value="TO (Tun)">TO (Tun)</option>
                                                    <option value="TP (Tray)">TP (Tray)</option>
                                                    <option value="TR (Trunk)">TR (Trunk)</option>
                                                    <option value="TS (Truss)">TS (Truss)</option>
                                                    <option value="TU (Tube)">TU (Tube)</option>
                                                    <option value="TV (Tube, with nozzle)">TV (Tube, with nozzle)</option>
                                                    <option value="TY (Tank, cylindrical)">TY (Tank, cylindrical)</option>
                                                    <option value="TZ (Tubes, in bundle/bunch/truss)">TZ (Tubes, in bundle/bunch/truss)</option>
                                                    <option value="UC (Uncaged)">UC (Uncaged)</option>
                                                    <option value="UN (Unpackage)">UN (Unpackage)</option>
                                                    <option value="VA (Vat)">VA (Vat)</option>
                                                    <option value="VG (Bulk, gas ( at 1031 mbar and 15C ))">VG (Bulk, gas ( at 1031 mbar and 15C ))</option>
                                                    <option value="VI (Vial)">VI (Vial)</option>
                                                    <option value="VK (Vanpack)">VK (Vanpack)</option>
                                                    <option value="VL (Bulk, liquid)">VL (Bulk, liquid)</option>
                                                    <option value="VN (Vehicle)">VN (Vehicle)</option>
                                                    <option value="VO (Bulk, solid, large particles ("nodules"))">VO (Bulk, solid, large particles ("nodules"))</option>
                                                    <option value="VP (Vacuumpacked)">VP (Vacuumpacked)</option>
                                                    <option value="VQ (Bulk,liquefied gas (at abnorml temprture/pressure))">VQ (Bulk,liquefied gas (at abnorml temprture/pressure))</option>
                                                    <option value="VR (Bulk, solid, granular particles ("grains"))">VR (Bulk, solid, granular particles ("grains"))</option>
                                                    <option value="VY (Bulk, solid, fine particles ("powders"))">VY (Bulk, solid, fine particles ("powders"))</option>
                                                    <option value="WA (Intermediate bulk container)">WA (Intermediate bulk container)</option>
                                                    <option value="WB (Wickerbottle)">WB (Wickerbottle)</option>
                                                    <option value="WC (Intermediate bulk container, steel)">WC (Intermediate bulk container, steel)</option>
                                                    <option value="WD (Intermediate bulk container, aluminium)">WD (Intermediate bulk container, aluminium)</option>
                                                    <option value="WF (Intermediate bulk container, metal)">WF (Intermediate bulk container, metal)</option>
                                                    <option value="WG (Intermediate bulk cont,steel,pressurised >10 kpa)">WG (Intermediate bulk cont,steel,pressurised >10 kpa)</option>
                                                    <option value="WH (Intermedt bulk cont,aluminium,pressurised >10 kpa)">WH (Intermedt bulk cont,aluminium,pressurised >10 kpa)</option>
                                                    <option value="WJ (Intermediate bulk container,metal, pressure 10 kpa)">WJ (Intermediate bulk container,metal, pressure 10 kpa)</option>
                                                    <option value="WK (Intermediate bulk container, steel, liquid)">WK (Intermediate bulk container, steel, liquid)</option>
                                                    <option value="WL (Intermediate bulk container, aluminium, liquid)">WL (Intermediate bulk container, aluminium, liquid)</option>
                                                    <option value="WM (Intermediate bulk container, metal, liquid)">WM (Intermediate bulk container, metal, liquid)</option>
                                                    <option value="WN (Intermd bulk cont,woven plastic,without coat/liner)">WN (Intermd bulk cont,woven plastic,without coat/liner)</option>
                                                    <option value="WP (Intermediate bulk container, woven plastic, coated)">WP (Intermediate bulk container, woven plastic, coated)</option>
                                                    <option value="WQ (Intermediate bulk cont,woven plastic,with liner)">WQ (Intermediate bulk cont,woven plastic,with liner)</option>
                                                    <option value="WR (Intermedt bulk cont,woven plastic,coated and liner)">WR (Intermedt bulk cont,woven plastic,coated and liner)</option>
                                                    <option value="WS (Intermediate bulk container, plastic film)">WS (Intermediate bulk container, plastic film)</option>
                                                    <option value="WT (Intermediate bulk cont,textile with out coat/liner)">WT (Intermediate bulk cont,textile with out coat/liner)</option>
                                                    <option value="WU (Intermdte bulk cont,natural wood,with inner liner)">WU (Intermdte bulk cont,natural wood,with inner liner)</option>
                                                    <option value="WV (Intermediate bulk container, textile, coated)">WV (Intermediate bulk container, textile, coated)</option>
                                                    <option value="WW (Intermediate bulk container, textile, with liner)">WW (Intermediate bulk container, textile, with liner)</option>
                                                    <option value="WX (Intermediate bulk cont,textile,coated and liner)">WX (Intermediate bulk cont,textile,coated and liner)</option>
                                                    <option value="WY (Intermediate bulk cont,plywood,with inner liner)">WY (Intermediate bulk cont,plywood,with inner liner)</option>
                                                    <option value="WZ (Intermd bulk cont,reconstttd wood,with inner liner)">WZ (Intermd bulk cont,reconstttd wood,with inner liner)</option>
                                                    <option value="XA (Bag, woven plastic, without inner coat/liner)">XA (Bag, woven plastic, without inner coat/liner)</option>
                                                    <option value="XB (Bag, woven plastic, sift proof)">XB (Bag, woven plastic, sift proof)</option>
                                                    <option value="XC (Bag, woven plastic, water resistant)">XC (Bag, woven plastic, water resistant)</option>
                                                    <option value="XD (Bag, plastics film)">XD (Bag, plastics film)</option>
                                                    <option value="XF (Bag, textile, without inner coat/liner)">XF (Bag, textile, without inner coat/liner)</option>
                                                    <option value="XG (Bag, textile, sift proof)">XG (Bag, textile, sift proof)</option>
                                                    <option value="XH (Bag, textile, water resistant)">XH (Bag, textile, water resistant)</option>
                                                    <option value="XJ (Bag, paper, multi-wall)">XJ (Bag, paper, multi-wall)</option>
                                                    <option value="XK (Bag, paper, multi-wall, water resistant)">XK (Bag, paper, multi-wall, water resistant)</option>
                                                    <option value="YA (Compsite packging,plastic receptacle in steel drum)">YA (Compsite packging,plastic receptacle in steel drum)</option>
                                                    <option value="YB (Compste packgng,plastc recptcle in steel crate box)">YB (Compste packgng,plastc recptcle in steel crate box)</option>
                                                    <option value="YC (Compste packgng,plastic recptcle in aluminium drum)">YC (Compste packgng,plastic recptcle in aluminium drum)</option>
                                                    <option value="YD (Compste packgng,plastic recptcle in alumnium crate)">YD (Compste packgng,plastic recptcle in alumnium crate)</option>
                                                    <option value="YF (Compsite packging,plastic receptacle in wooden box)">YF (Compsite packging,plastic receptacle in wooden box)</option>
                                                    <option value="YG (Compste packgng,plastic receptacle in plywood drum)">YG (Compste packgng,plastic receptacle in plywood drum)</option>
                                                    <option value="YH (Compste packging,plastic receptacle in plywood box)">YH (Compste packging,plastic receptacle in plywood box)</option>
                                                    <option value="YJ (Compsite packging,plastic receptacle in fibre drum)">YJ (Compsite packging,plastic receptacle in fibre drum)</option>
                                                    <option value="YK (Compste packgng,plastic recptcle in fibreboard box)">YK (Compste packgng,plastic recptcle in fibreboard box)</option>
                                                    <option value="YL (Compste packgng,plastic receptacle in plastic drum)">YL (Compste packgng,plastic receptacle in plastic drum)</option>
                                                    <option value="YM (Compsite packgng,plstc recptcle in solid plstc box)">YM (Compsite packgng,plstc recptcle in solid plstc box)</option>
                                                    <option value="YN (Composite packaging,glass receptacle in steel drum)">YN (Composite packaging,glass receptacle in steel drum)</option>
                                                    <option value="YP (Compste packgng,glass recptacle in steel crate box)">YP (Compste packgng,glass recptacle in steel crate box)</option>
                                                    <option value="YQ (Compste packgng,glass receptacle in aluminium drum)">YQ (Compste packgng,glass receptacle in aluminium drum)</option>
                                                    <option value="YR (Compste packgng,glass recptacle in aluminium crate)">YR (Compste packgng,glass recptacle in aluminium crate)</option>
                                                    <option value="YS (Composite packaging,glass receptacle in wooden box)">YS (Composite packaging,glass receptacle in wooden box)</option>
                                                    <option value="YT (Compsite packging,glass receptacle in plywood drum)">YT (Compsite packging,glass receptacle in plywood drum)</option>
                                                    <option value="YV (Compste packgng,glass recptcle in wickrwork hamper)">YV (Compste packgng,glass recptcle in wickrwork hamper)</option>
                                                    <option value="YW (Composite packaging,glass receptacle in fibre drum)">YW (Composite packaging,glass receptacle in fibre drum)</option>
                                                    <option value="YX (Compste packgng,glass receptacle in fibreboard box)">YX (Compste packgng,glass receptacle in fibreboard box)</option>
                                                    <option value="YY (Compste pckgng,glss recptcl in expndbl plastc pack)">YY (Compste pckgng,glss recptcl in expndbl plastc pack)</option>
                                                    <option value="YZ (Compsite packgng,glass recptcle in solid plstc pck)">YZ (Compsite packgng,glass recptcle in solid plstc pck)</option>
                                                    <option value="ZA (Intermediate bulk container, paper, multi-wall)">ZA (Intermediate bulk container, paper, multi-wall)</option>
                                                    <option value="ZB (Bag, large)">ZB (Bag, large)</option>
                                                    <option value="ZC (Intermd bulk cont,paper,multi-wall,water resistant)">ZC (Intermd bulk cont,paper,multi-wall,water resistant)</option>
                                                    <option value="ZD (Intermd bulk cont,rgd plstc,w/strctrl equipm,solid)">ZD (Intermd bulk cont,rgd plstc,w/strctrl equipm,solid)</option>
                                                    <option value="ZF (Intermd bulk cont,rgid plstc,freestandng,solds)">ZF (Intermd bulk cont,rgid plstc,freestandng,solds)</option>
                                                    <option value="ZG (Intermdbulk cnt,rgd plstc,w/strctrl equipm,pressrd)">ZG (Intermdbulk cnt,rgd plstc,w/strctrl equipm,pressrd)</option>
                                                    <option value="ZH (Intermd bulk cont,rgd plstc,freestnd,pressurised)">ZH (Intermd bulk cont,rgd plstc,freestnd,pressurised)</option>
                                                    <option value="ZJ (Intermd bulk cont,rgd plstc,w/strctrl equipm,lquid)">ZJ (Intermd bulk cont,rgd plstc,w/strctrl equipm,lquid)</option>
                                                    <option value="ZK (Intermd bulk cont,rgid plstc,freestanding,liquids)">ZK (Intermd bulk cont,rgid plstc,freestanding,liquids)</option>
                                                    <option value="ZL (Intermd bulk cont,composite,rigid plastic,solids)">ZL (Intermd bulk cont,composite,rigid plastic,solids)</option>
                                                    <option value="ZM (Intermd bulk cont,compste,flexbl plastic, solids)">ZM (Intermd bulk cont,compste,flexbl plastic, solids)</option>
                                                    <option value="ZN (Intermd bulk cont,compsit,rgid plstc,pressurised)">ZN (Intermd bulk cont,compsit,rgid plstc,pressurised)</option>
                                                    <option value="ZP (Intermd bulk cont,compsit,flexbl plstc,pressurised)">ZP (Intermd bulk cont,compsit,flexbl plstc,pressurised)</option>
                                                    <option value="ZQ (Intermd bulk cont,composite,rigid plastic,liquids)">ZQ (Intermd bulk cont,composite,rigid plastic,liquids)</option>
                                                    <option value="ZR (Intermd bulk cont,compsite,flexible plastc,liquids)">ZR (Intermd bulk cont,compsite,flexible plastc,liquids)</option>
                                                    <option value="ZS (Intermediate bulk container, composite)">ZS (Intermediate bulk container, composite)</option>
                                                    <option value="ZT (Intermediate bulk container, fibreboard)">ZT (Intermediate bulk container, fibreboard)</option>
                                                    <option value="ZU (Intermediate bulk container, flexible)">ZU (Intermediate bulk container, flexible)</option>
                                                    <option value="ZV (Intermediate bulk container,metal,other than steel)">ZV (Intermediate bulk container,metal,other than steel)</option>
                                                    <option value="ZW (Intermediate bulk container, natural wood)">ZW (Intermediate bulk container, natural wood)</option>
                                                    <option value="ZX (Intermediate bulk container, plywood)">ZX (Intermediate bulk container, plywood)</option>
                                                    <option value="ZY (Intermediate bulk container, reconstituted wood)">ZY (Intermediate bulk container, reconstituted wood)</option>
                                                    <option value="ZZ (Mutually defined)">ZZ (Mutually defined)</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-form-label text-right col-md-2">Harga satuan</label>
                                        <div class="col-md-4">
                                            <select type="text" class="form-control" name="currency" required>
                                                <option value="1">IDR</option>
                                                <option value="2">USD</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="text" class="form-control" id="price" name="price" required />
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-form-label text-right col-md-2">Total</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" id="goods_custom" name="goods_custom" readonly />
                                        </div>
                                    </div>  
                                    
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-form-label text-right col-md-3">Kategori</label>
                                        <div class="col-md-9">
                                            <select class="form-control selectpicker" data-size="7" data-live-search="true" name="goods_category" required>
                                                <option value=""> - </option>
                                                <?php
                                                foreach($categories as $val) { ?>
                                                    <option value="<?=$val['id'];?>"><?=$val['name'];?></option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-form-label text-right col-md-3">Berat Kotor</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" name="goods_bruto" required />
                                        </div>
                                    </div> 
                                    <div class="form-group">
                                        <label for="itemAttach">Lampiran</label>
                                        <input type="file" class="form-control" name="itemAttach1" id="itemAttach1" accept="image/png, image/gif, image/jpeg" />
                                        <input type="file" class="form-control" name="itemAttach2" id="itemAttach2" accept="image/png, image/gif, image/jpeg" />
                                        <input type="file" class="form-control" name="itemAttach3" id="itemAttach3" accept="image/png, image/gif, image/jpeg" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer" style="background-color: #1BC5BD;">
                            <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-primary font-weight-bold">Tambah</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Modal Update-->
        <div class="modal fade" id="UpdateModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <form class="form" id="spmb_goods_form">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel"><span class="card-icon">
                                <i class="flaticon2-supermarket text-primary"></i>
                            </span> Daftar Barang</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <i aria-hidden="true" class="ki ki-close"></i>
                            </button>
                        </div>
                        <div class="modal-body">
                                <table class="table table-bordered table-hover table-checkable" id="kt_item_datatable" style="margin-top: 13px !important">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>No. Dokumen</th>
                                            <th>Nama Barang</th>
                                            <th>Jumlah</th>
                                            <th>tipe</th>
                                            <th>Sisa</th>
                                            <th>Status</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                </table>
                        </div>
                        <div class="modal-footer">
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Modal Verification-->
        <div class="modal fade" id="VerificationModal" style="z-index: 11000;" data-backdrop="static" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-sm" role="document" style="min-width: 400px;">
                <div class="modal-content" style="background-color: orange;">
                    <form class="form" id="spmb_goods_verification">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel"><span class="card-icon">
                                <i class="flaticon2-supermarket text-primary"></i>
                            </span> Verifikasi data barang</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <i aria-hidden="true" class="ki ki-close"></i>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row"> 
                                <div class="form-group row" style="display: none;">
                                    <label class="col-form-label text-right col-md-3">ID</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control spmb_item_id" name="spmb_item_id" readonly="" />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-form-label text-right col-md-3">Status</label>
                                    <div class="col-md-9">
                                        <select class="form-control" id="item_status" name="item_status">
                                            <option value="1">Tidak Sesuai</option>
                                            <option value="2">Sesuai Sebagian</option>
                                            <option value="3">Sesuai Seluruhnya</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-form-label text-right col-md-3">Jumlah</label>
                                    <div class="col-md-9">
                                        <input type="text" placeholder="jumlah item tidak sesuai" class="form-control" disabled name="spmb_item_verified"/>
                                    </div>
                                </div>
                                <div class="form-group row">
                                        <label class="col-form-label text-right col-md-3">Keterangan</label>
                                        <div class="col-md-9">
                                            <textarea class="form-control" rows="3" name="spmb_verified_note"></textarea>
                                        </div>
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

        <!-- Modal review-->
        <div class="modal fade" id="ReviewModal" data-backdrop="static" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <form class="form" id="spmb_review_form">
                        <input type="hidden" name="itemListHeaderID" id="itemListHeaderID" />
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel"><span class="card-icon">
                                <i class="flaticon2-supermarket text-primary"></i>
                            </span> Review Data SPMB</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <i aria-hidden="true" class="ki ki-close"></i>
                            </button>
                        </div>
                        <div class="modal-body">
                                <table class="table table-bordered">
                                    <tbody>
                                        <tr>
                                            <td>Nama</td>
                                            <td class="text-center">:</td>
                                            <td><span view="cust_name"></span></td>
                                        </tr>
                                        <tr>
                                            <td>Tanggal Lahir</td>
                                            <td class="text-center">:</td>
                                            <td><span view="cust_birth"></span></td>
                                        </tr>
                                        <tr>
                                            <td>Nomor Paspor</td>
                                            <td class="text-center">:</td>
                                            <td><span view="pas_num"></span></td>
                                        </tr>
                                        <tr>
                                            <td>Handphone</td>
                                            <td class="text-center">:</td>
                                            <td><span view="phone"></span></td>
                                        </tr>
                                        <tr>
                                            <td>No. Identitas</td>
                                            <td class="text-center">:</td>
                                            <td><span view="identity"></span></td>
                                        </tr>
                                        <tr>
                                            <td>Kebangsaan</td>
                                            <td class="text-center">:</td>
                                            <td><span view="Nationality"></span></td>
                                        </tr>
                                        <tr>
                                            <td>Email</td>
                                            <td class="text-center">:</td>
                                            <td><span view="email"></span></td>
                                        </tr>
                                        <tr>
                                            <td>Kantor Keberangkatan</td>
                                            <td class="text-center">:</td>
                                            <td><span view="office_dep"></span></td>
                                        </tr>
                                        <tr>
                                            <td>Kantor Tujuan</td>
                                            <td class="text-center">:</td>
                                            <td><span view="office_arr"></span></td>
                                        </tr>
                                        <tr>
                                            <td>No. Penerbangan</td>
                                            <td class="text-center">:</td>
                                            <td><span view="flight_num"></span></td>
                                        </tr>
                                        <tr>
                                            <td>No. Dokumen</td>
                                            <td class="text-center">:</td>
                                            <td><span view="doc_no"></span></td>
                                        </tr>
                                        <tr>
                                            <td>Tanggal Dokumen</td>
                                            <td class="text-center">:</td>
                                            <td><span view="doc_date"></span></td>
                                        </tr>
                                        <tr>
                                            <td>Alamat</td>
                                            <td class="text-center">:</td>
                                            <td><span view="address"></span></td>
                                        </tr>
                                        <tr>
                                            <td>Negara Tujuan</td>
                                            <td class="text-center">:</td>
                                            <td><span view="country_arr"></span></td>
                                        </tr>
                                        <tr>
                                            <td>Maksud Pembawaan</td>
                                            <td class="text-center">:</td>
                                            <td><span view="reason"></span></td>
                                        </tr>
                                    </tbody>
                                </table>
                                <table id="show_item_list" class="table table-bordered table-hover">
                                    <thead>
                                        <th>No. Dokumen</th>
                                        <th>Nama Barang</th>
                                        <th>Jumlah</th>
                                        <th>Tipe</th>
                                        <th>Harga</th>
                                        <th>Sisa</th>
                                        <th>Lampiran</th>
                                        <th>Status</th>
                                        <th>&nbsp;</th>
                                    </thead>
                                    <tbody></tbody>
                                </table>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Tutup</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
            
        <!-- Modal Verification-->
        <div class="modal fade" id="imageViewer" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
                <div class="modal-content">
                    
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel"><span class="card-icon">
                                <i class="flaticon2-supermarket text-primary"></i>
                            </span> Detail Foto Barang</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <i aria-hidden="true" class="ki ki-close"></i>
                            </button>
                        </div>
                        <div class="modal-body">
                            <img style="max-width: 100%;" id="imageItem" />
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Tutup</button>
                        </div>
                </div>
            </div>
        </div>
        
        <!-- Ajax Progress -->
        <div class="modal fade" id="pleaseWaitDialog" data-backdrop="static" data-keyboard="false" style="z-index: 11000;">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h1>Uploading...</h1>
                </div>
                <div class="modal-body">
                    <div class="progress">
                    <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
                        <span class="sr-only">Loading...</span>
                    </div>
                    </div>
                </div>
                </div>
            </div>
        </div>
        <!-- end ajax progress -->
        <?php $this->load->view('aside/user');?>    
        <?php $this->load->view('aside/script');?>
        </body>
        <!--end::Body-->
    </html>