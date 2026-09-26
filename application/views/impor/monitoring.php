<!DOCTYPE html>
<html lang="en">
    <?php $this->load->view('aside/head');?>
    <body id="kt_body" class="header-fixed header-mobile-fixed subheader-enabled subheader-fixed aside-enabled aside-fixed aside-minimize-hoverable page-loading">
        <div id="kt_header_mobile" class="header-mobile align-items-center header-mobile-fixed">
            <a href="<?=base_url()?>">
                <img alt="Logo" src="<?=base_url('./assets/media/logos/logo-light.png')?>" />
            </a>
            <div class="d-flex align-items-center">
                <button class="btn p-0 burger-icon burger-icon-left" id="kt_aside_mobile_toggle">
                    <span></span>
                </button>
                <button class="btn p-0 burger-icon ml-4" id="kt_header_mobile_toggle">
                    <span></span>
                </button>
                <button class="btn btn-hover-text-primary p-0 ml-2" id="kt_header_mobile_topbar_toggle">
                    <span class="svg-icon svg-icon-xl">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <polygon points="0 0 24 0 24 24 0 24" />
                                <path d="M12,11 C9.790861,11 8,9.209139 8,7 C8,4.790861 9.790861,3 12,3 C14.209139,3 16,4.790861 16,7 C16,9.209139 14.209139,11 12,11 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />
                                <path d="M3.00065168,20.1992055 C3.38825852,15.4265159 7.26191235,13 11.9833413,13 C16.7712164,13 20.7048837,15.2931929 20.9979143,20.2 C21.0095879,20.3954741 20.9979143,21 20.2466999,21 C16.541124,21 11.0347247,21 3.72750223,21 C3.47671215,21 2.97953825,20.45918 3.00065168,20.1992055 Z" fill="#000000" fill-rule="nonzero" />
                            </g>
                        </svg>
                    </span>
                </button>
            </div>
        </div>
        <div class="d-flex flex-column flex-root">
            <div class="d-flex flex-row flex-column-fluid page">
                <?php $this->load->view('aside/menu');?>
                <div class="d-flex flex-column flex-row-fluid wrapper" id="kt_wrapper">
                    <?php $this->load->view('aside/topbar');?>
                    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
                        <div class="subheader py-2 py-lg-6 subheader-solid" id="kt_subheader">
                            <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
                                <div class="d-flex align-items-center flex-wrap mr-1">
                                    <div class="d-flex align-items-baseline flex-wrap mr-5">
                                        <h5 class="text-dark font-weight-bold my-1 mr-5">PATOPS</h5>
                                        <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                                            <li class="breadcrumb-item text-muted">
                                                <a href="" class="text-muted">Applications</a>
                                            </li>
                                            <li class="breadcrumb-item text-muted">
                                                <a href="<?=base_url('import')?>" class="text-muted">Impor Sementara</a>
                                            </li>
                                            <li class="breadcrumb-item text-muted">
                                                <a href="" class="text-muted">Monitoring</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex flex-column-fluid">
                            <div class="container-fluid">
                                <div class="card card-custom">
                                    <div class="card-header">
                                        <div class="card-title">
                                            <span class="card-icon">
                                                <i class="flaticon2-list-2 text-primary"></i>
                                            </span>
                                            <h3 class="card-label">MONITORING IMPOR SEMENTARA</h3>
                                        </div>
                                        <div class="card-toolbar">
                                            <button type="button" class="btn btn-sm btn-warning" id="btnNotifySelected">
                                                <i class="fa fa-bell"></i> Kirim notifikasi terpilih
                                            </button>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <style>
                                            #monitorTable th.is-sortable { cursor: pointer; white-space: nowrap; user-select: none; }
                                            #monitorTable th.is-sortable:hover { color: #3699FF; }
                                            #monitorTable .filter-row th { font-weight: 400; vertical-align: middle; background: #f3f6f9; }
                                            #monitorTable .filter-row .form-control { min-width: 80px; }
                                            #monitorTable td { vertical-align: middle; }
                                            #monitorHeadline { border: 1px solid #e4e6ef; border-radius: 4px; overflow: hidden; margin-bottom: 1.25rem; }
                                            #monitorHeadline .headline-labels { background: #eef0f4; }
                                            #monitorHeadline .headline-labels > div { padding: 8px 10px; font-weight: 600; color: #3f4254; text-align: center; }
                                            #monitorHeadline .headline-cards { padding: 10px; background: #fff; }
                                            #monitorHeadline .headline-card { display: block; border: 0; border-radius: 6px; min-height: 72px; font-size: 2.25rem; font-weight: 300; color: #1e1e2d; line-height: 72px; text-align: center; cursor: pointer; }
                                            #monitorHeadline .headline-card.is-overdue { background: #f1556c; }
                                            #monitorHeadline .headline-card.is-d7 { background: #f7b84b; }
                                            #monitorHeadline .headline-card.is-d30 { background: #fef08a; }
                                            #monitorHeadline .headline-card.is-active { box-shadow: inset 0 0 0 3px #1bc5bd; }
                                            #monitorHeadline .headline-card:hover { opacity: 0.92; }
                                            #notifyFieldChips .btn-row-field { max-width: 220px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; vertical-align: middle; }
                                            /* Popup daterangepicker harus di atas sidebar (.aside z-index 98) */
                                            .daterangepicker { z-index: 1060 !important; }
                                            #monitorSummary { border: 1px solid #e4e6ef; border-radius: 4px; margin-bottom: 1.25rem; background: #fff; }
                                            #monitorSummary .summary-filter { background: #f3f6f9; padding: 12px 16px; border-bottom: 1px solid #e4e6ef; }
                                            #monitorSummary .summary-card { border: 1px solid #e4e6ef; border-radius: 6px; padding: 16px; height: 100%; background: #fff; }
                                            #monitorSummary .summary-card .summary-title { font-size: 0.9rem; font-weight: 600; color: #7e8299; margin-bottom: 8px; }
                                            #monitorSummary .summary-card .summary-value { font-size: 1.75rem; font-weight: 600; color: #181c32; line-height: 1.2; }
                                            #monitorSummary .summary-card .summary-sub { font-size: 0.95rem; color: #3f4254; margin-top: 6px; }
                                            #monitorSummary .summary-card.is-total { border-top: 3px solid #3699FF; }
                                            #monitorSummary .summary-card.is-reekspor { border-top: 3px solid #1BC5BD; cursor: pointer; }
                                            #monitorSummary .summary-card.is-jaminan { border-top: 3px solid #FFA800; cursor: pointer; }
                                            #monitorSummary .summary-card.is-reekspor:hover,
                                            #monitorSummary .summary-card.is-jaminan:hover { box-shadow: 0 0 0 2px rgba(54,153,255,.25); }
                                            #reeksporTable th.is-sortable,
                                            #jaminanTable th.is-sortable { cursor: pointer; white-space: nowrap; user-select: none; }
                                            #reeksporTable .filter-row th,
                                            #jaminanTable .filter-row th { font-weight: 400; background: #f3f6f9; }
                                        </style>
                                        <div id="monitorSummary">
                                            <div class="summary-filter">
                                                <div class="row align-items-end">
                                                    <div class="col-md-5 col-lg-4">
                                                        <label class="mb-1 font-weight-bold text-dark">Periode tanggal dokumen</label>
                                                        <input type="text" class="form-control" id="summaryDateRange" placeholder="Pilih rentang tanggal" readonly />
                                                    </div>
                                                    <div class="col-md-auto mt-2 mt-md-0">
                                                        <button type="button" class="btn btn-light" id="btnResetSummaryDate" title="Kembali ke default">
                                                            <i class="fa fa-undo"></i> Reset periode
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="p-4">
                                                <div class="row">
                                                    <div class="col-md-4 mb-4 mb-md-0">
                                                        <div class="summary-card is-total">
                                                            <div class="summary-title">Dokumen Impor Sementara</div>
                                                            <div class="summary-value"><span id="summaryTotal">0</span></div>
                                                            <div class="summary-sub">Aktif: <strong id="summaryActive">0</strong></div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4 mb-4 mb-md-0">
                                                        <div class="summary-card is-reekspor" id="cardReekspor" role="button" title="Klik untuk lihat detail">
                                                            <div class="summary-title">Reekspor</div>
                                                            <div class="summary-value"><span id="summaryReekspor">0</span></div>
                                                            <div class="summary-sub">Dokumen selesai (sesuai) — klik untuk detail</div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="summary-card is-jaminan" id="cardJaminan" role="button" title="Klik untuk lihat detail">
                                                            <div class="summary-title">Jaminan Definitif</div>
                                                            <div class="summary-value"><span id="summaryJaminanCount">0</span></div>
                                                            <div class="summary-sub">Nilai: Rp <strong id="summaryJaminanValue">0</strong> — klik untuk detail</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="monitorHeadline">
                                            <div class="row headline-labels no-gutters">
                                                <div class="col-4">Jatuh Tempo</div>
                                                <div class="col-4">7 Hari Sebelum</div>
                                                <div class="col-4">30 Hari Sebelum</div>
                                            </div>
                                            <div class="row headline-cards no-gutters">
                                                <div class="col-4 px-1">
                                                    <button type="button" class="headline-card is-overdue w-100" data-headline="overdue" id="headlineOverdue">0</button>
                                                </div>
                                                <div class="col-4 px-1">
                                                    <button type="button" class="headline-card is-d7 w-100" data-headline="d7" id="headlineD7">0</button>
                                                </div>
                                                <div class="col-4 px-1">
                                                    <button type="button" class="headline-card is-d30 w-100" data-headline="d30" id="headlineD30">0</button>
                                                </div>
                                            </div>
                                        </div>
                                        <div name="searchResult">
                                            <div class="table-responsive">
                                                <table class="table table-bordered table-hover" id="monitorTable">
                                                    <thead>
                                                        <tr class="text-center">
                                                            <th style="width:40px;">
                                                                <input type="checkbox" id="checkAllNotify" title="Pilih semua" />
                                                            </th>
                                                            <th>Nomor Lengkap</th>
                                                            <th class="is-sortable" data-sort="doc_date">Tanggal Dok <i class="fa fa-sort"></i></th>
                                                            <th class="is-sortable" data-sort="bpj_number">Nomor BPJ <i class="fa fa-sort"></i></th>
                                                            <th>Penumpang</th>
                                                            <th>Paspor</th>
                                                            <th class="is-sortable" data-sort="bpjStatus">Status BPJ <i class="fa fa-sort"></i></th>
                                                            <th class="is-sortable" data-sort="periode">Jangka Waktu IS <i class="fa fa-sort"></i></th>
                                                            <th>Status</th>
                                                            <th>Aksi</th>
                                                        </tr>
                                                        <tr class="filter-row">
                                                            <th></th>
                                                            <th>
                                                                <input type="text" class="form-control form-control-sm" name="filterDocNumber" placeholder="Cari nomor" />
                                                            </th>
                                                            <th>
                                                                <input type="text" class="form-control form-control-sm" name="filterDocDate" id="filterDocDate" placeholder="Pilih tanggal" readonly />
                                                            </th>
                                                            <th>
                                                                <input type="text" class="form-control form-control-sm" name="filterBpjNumber" placeholder="Cari BPJ" />
                                                            </th>
                                                            <th>
                                                                <input type="text" class="form-control form-control-sm" name="filterName" placeholder="Cari nama" />
                                                            </th>
                                                            <th>
                                                                <input type="text" class="form-control form-control-sm" name="filterPassport" placeholder="Cari paspor" />
                                                            </th>
                                                            <th>
                                                                <div class="d-flex align-items-center mb-1">
                                                                    <select class="form-control form-control-sm mr-1" name="filterBpjOp" style="width: 58px; min-width: 58px;">
                                                                        <option value="">-</option>
                                                                        <option value="lt">&lt;</option>
                                                                        <option value="lte">&le;</option>
                                                                        <option value="gte">&ge;</option>
                                                                        <option value="gt">&gt;</option>
                                                                    </select>
                                                                    <input type="text" class="form-control form-control-sm mr-1" name="filterBpjDays" placeholder="0" style="width: 52px; min-width: 52px;" />
                                                                    <span class="text-muted text-nowrap">hari</span>
                                                                </div>
                                                                <input type="text" class="form-control form-control-sm" name="filterBpjStatus" placeholder="Hari tertentu" />
                                                            </th>
                                                            <th>
                                                                <input type="text" class="form-control form-control-sm" name="filterPeriode" placeholder="Hari" />
                                                            </th>
                                                            <th>
                                                                <select class="form-control form-control-sm" name="filterStatus">
                                                                    <option value="">Semua</option>
                                                                    <option value="1">Created</option>
                                                                    <option value="2">Open</option>
                                                                </select>
                                                            </th>
                                                            <th class="text-center">
                                                                <button type="button" class="btn btn-sm btn-light" id="btnResetFilter" title="Reset filter">
                                                                    <i class="fa fa-undo"></i>
                                                                </button>
                                                            </th>
                                                        </tr>
                                                        <tr class="d-none" template="searchResultRow">
                                                            <td class="text-center">
                                                                <input type="checkbox" class="row-notify-check" />
                                                            </td>
                                                            <td view="docNumber"></td>
                                                            <td view="docDate"></td>
                                                            <td view="bpjNumber"></td>
                                                            <td view="name"></td>
                                                            <td view="passport"></td>
                                                            <td class="text-center" view="bpjStatus"></td>
                                                            <td class="text-center" view="periode"></td>
                                                            <td view="status"></td>
                                                            <td class="text-center">
                                                                <button type="button" class="btn btn-sm btn-icon btn-light-warning" view="actionNotify" title="Kirim notifikasi">
                                                                    <i class="fa fa-bell"></i>
                                                                </button>
                                                            </td>
                                                        </tr>
                                                    </thead>
                                                    <tbody><!-- Appended by Ajax --></tbody>
                                                </table>
                                            </div>
                                            <div class="text-center mt-4">
                                                <div class="btn-group" role="group" name="searchNav">
                                                    <button type="button" class="btn btn-primary" name="prev"><span aria-hidden="true" class="fa fa-chevron-left"></span></button>
                                                    <button type="button" class="btn btn-default">Halaman <span name="page"></span></button>
                                                    <button type="button" class="btn btn-primary" name="next"><span aria-hidden="true" class="fa fa-chevron-right"></span></button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php $this->load->view('aside/foot');?>
                </div>
            </div>
        </div>

        <?php $this->load->view('aside/user');?>
        <?php $this->load->view('aside/script');?>

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

        <div class="modal fade" id="imageViewer" name="imageViewer" data-backdrop="static">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">
                            <span class="card-icon"><i class="flaticon2-supermarket text-primary"></i></span> Lampiran Data Barang
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <i aria-hidden="true" class="ki ki-close"></i>
                        </button>
                    </div>
                    <div class="modal-body">
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

        <div class="modal fade" id="notifyConfirmModal" data-backdrop="static">
            <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Kirim Notifikasi</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p class="mb-3" id="notifyConfirmText">Kirim notifikasi ke email pemberitahu?</p>
                        <div id="notifyEditFields">
                            <div class="form-group">
                                <label>Kepada</label>
                                <input type="text" class="form-control" id="notifyToEmail" readonly />
                            </div>
                            <div class="form-group">
                                <label>Subjek</label>
                                <input type="text" class="form-control" id="notifySubject" />
                            </div>
                            <div class="form-group mb-0">
                                <label>Isi notifikasi</label>
                                <textarea class="form-control" id="notifyBody" rows="8"></textarea>
                                <div class="form-text mt-3" id="notifyFieldChipsWrap">
                                    Klik untuk sisipkan ke isi (boleh juga diketik di subjek):
                                    <div class="mt-2" id="notifyFieldChips"></div>
                                    <span class="text-muted">nama, email, nomor dokumen, tanggal dok, paspor, jangka waktu, jatuh tempo, sisa hari, status.</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-dismiss="modal">Batal</button>
                        <button type="button" class="btn btn-warning" id="btnConfirmNotify">
                            <i class="fa fa-bell"></i> Kirim
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="reeksporModal" data-backdrop="static">
            <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Detail Reekspor</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover" id="reeksporTable">
                                <thead>
                                    <tr class="text-center">
                                        <th class="is-sortable" data-sort="doc_number">Nomor IS <i class="fa fa-sort"></i></th>
                                        <th class="is-sortable" data-sort="doc_date">Tanggal IS <i class="fa fa-sort"></i></th>
                                        <th class="is-sortable" data-sort="name">Importir <i class="fa fa-sort"></i></th>
                                        <th class="is-sortable" data-sort="passport">Paspor <i class="fa fa-sort"></i></th>
                                        <th class="is-sortable" data-sort="re_date">Tgl Reekspor <i class="fa fa-sort"></i></th>
                                        <th class="is-sortable" data-sort="re_doc_number">No. Dok Reekspor <i class="fa fa-sort"></i></th>
                                        <th>Kantor</th>
                                    </tr>
                                    <tr class="filter-row">
                                        <th><input type="text" class="form-control form-control-sm" name="reeksporDocNumber" placeholder="Cari nomor" /></th>
                                        <th></th>
                                        <th><input type="text" class="form-control form-control-sm" name="reeksporName" placeholder="Cari nama" /></th>
                                        <th><input type="text" class="form-control form-control-sm" name="reeksporPassport" placeholder="Cari paspor" /></th>
                                        <th><input type="text" class="form-control form-control-sm" name="reeksporReDate" placeholder="YYYY-MM-DD" /></th>
                                        <th><input type="text" class="form-control form-control-sm" name="reeksporReDoc" placeholder="Cari no dok" /></th>
                                        <th><input type="text" class="form-control form-control-sm" name="reeksporOffice" placeholder="Cari kantor" /></th>
                                    </tr>
                                    <tr class="d-none" template="reeksporRow">
                                        <td view="docNumber"></td>
                                        <td view="docDate"></td>
                                        <td view="name"></td>
                                        <td view="passport"></td>
                                        <td view="reDate"></td>
                                        <td view="reDocNumber"></td>
                                        <td view="reOffice"></td>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                        <div class="text-center mt-3">
                            <div class="btn-group" role="group" name="reeksporNav">
                                <button type="button" class="btn btn-primary" name="prev"><span class="fa fa-chevron-left"></span></button>
                                <button type="button" class="btn btn-default">Halaman <span name="page">1</span></button>
                                <button type="button" class="btn btn-primary" name="next"><span class="fa fa-chevron-right"></span></button>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-dismiss="modal">Tutup</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="jaminanModal" data-backdrop="static">
            <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Detail Jaminan Definitif</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover" id="jaminanTable">
                                <thead>
                                    <tr class="text-center">
                                        <th class="is-sortable" data-sort="bpj_number">Nomor BPJ <i class="fa fa-sort"></i></th>
                                        <th class="is-sortable" data-sort="doc_number">Nomor Impor Sementara <i class="fa fa-sort"></i></th>
                                        <th class="is-sortable" data-sort="doc_date">Tanggal IS <i class="fa fa-sort"></i></th>
                                        <th class="is-sortable" data-sort="name">Importir <i class="fa fa-sort"></i></th>
                                        <th class="is-sortable" data-sort="nominal">Nilai Jaminan <i class="fa fa-sort"></i></th>
                                    </tr>
                                    <tr class="filter-row">
                                        <th><input type="text" class="form-control form-control-sm" name="jaminanBpj" placeholder="Cari BPJ" /></th>
                                        <th><input type="text" class="form-control form-control-sm" name="jaminanDocNumber" placeholder="Cari nomor IS" /></th>
                                        <th></th>
                                        <th><input type="text" class="form-control form-control-sm" name="jaminanName" placeholder="Cari importir" /></th>
                                        <th><input type="text" class="form-control form-control-sm" name="jaminanNominal" placeholder="Cari nilai" /></th>
                                    </tr>
                                    <tr class="d-none" template="jaminanRow">
                                        <td view="bpjNumber"></td>
                                        <td view="docNumber"></td>
                                        <td view="docDate"></td>
                                        <td view="name"></td>
                                        <td class="text-right" view="nominal"></td>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                        <div class="text-center mt-3">
                            <div class="btn-group" role="group" name="jaminanNav">
                                <button type="button" class="btn btn-primary" name="prev"><span class="fa fa-chevron-left"></span></button>
                                <button type="button" class="btn btn-default">Halaman <span name="page">1</span></button>
                                <button type="button" class="btn btn-primary" name="next"><span class="fa fa-chevron-right"></span></button>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-dismiss="modal">Tutup</button>
                    </div>
                </div>
            </div>
        </div>

        <script src="<?=base_url('assets/js/app.import.monitoring.js'); ?>?v=20260926c"></script>
    </body>
</html>
