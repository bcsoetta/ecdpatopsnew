<!DOCTYPE html>
<html lang="en">
    <?php $this->load->view('aside/head');?>
    <body id="kt_body" class="header-fixed header-mobile-fixed subheader-enabled subheader-fixed aside-enabled aside-fixed aside-minimize-hoverable page-loading">
        <div id="kt_header_mobile" class="header-mobile align-items-center header-mobile-fixed">
            <a href="<?=base_url()?>">
                <img alt="Logo" src="<?=base_url('./assets/media/logos/logo-light.png')?>" />
            </a>
            <div class="d-flex align-items-center">
                <button class="btn p-0 burger-icon burger-icon-left" id="kt_aside_mobile_toggle"><span></span></button>
                <button class="btn p-0 burger-icon ml-4" id="kt_header_mobile_toggle"><span></span></button>
                <button class="btn btn-hover-text-primary p-0 ml-2" id="kt_header_mobile_topbar_toggle">
                    <span class="svg-icon svg-icon-xl">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
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
                                            <li class="breadcrumb-item text-muted"><a href="" class="text-muted">Applications</a></li>
                                            <li class="breadcrumb-item text-muted"><a href="<?=base_url('import')?>" class="text-muted">Impor Sementara</a></li>
                                            <li class="breadcrumb-item text-muted"><a href="<?=base_url('import/setting')?>" class="text-muted">Setting</a></li>
                                            <li class="breadcrumb-item text-muted"><a href="" class="text-muted">Format/Template Notifikasi</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex flex-column-fluid">
                            <div class="container-fluid">
                                <form name="importSettingForm" id="importSettingForm">
                                    <div class="card card-custom">
                                        <div class="card-header">
                                            <div class="card-title">
                                                <span class="card-icon"><i class="fa fa-bell text-primary"></i></span>
                                                <h3 class="card-label">Format/Template Notifikasi</h3>
                                            </div>
                                            <div class="card-toolbar">
                                                <button type="button" class="btn btn-sm btn-primary" id="btnAddNotifFormat">
                                                    <i class="fa fa-plus"></i> Tambah Template
                                                </button>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <p class="text-muted">
                                                Template email mengatur isi notifikasi yang dikirim ke pemberitahu.
                                                Setiap baris terikat ke momen tertentu (hook). Template default dipakai tombol lonceng di Monitoring dan tidak dapat dihapus.
                                            </p>
                                            <div class="form-group">
                                                <label for="testEmail">Email tes</label>
                                                <div class="input-group">
                                                    <input type="email" class="form-control" name="testEmail" id="testEmail" placeholder="Isi email tes sebelum mengirim notifikasi tes" />
                                                    <div class="input-group-append">
                                                        <button type="submit" class="btn btn-primary" id="btnSaveSetting">Simpan email tes</button>
                                                    </div>
                                                </div>
                                                <span class="form-text text-muted">Email ini dipakai tombol Tes Notifikasi di dalam form template.</span>
                                            </div>
                                            <div class="table-responsive">
                                                <table class="table table-bordered table-hover table-striped w-100" id="notifFormatTable" style="width:100%">
                                                    <thead>
                                                        <tr>
                                                            <th>Title</th>
                                                            <th>Hook</th>
                                                            <th>Subjek</th>
                                                            <th class="text-center" style="width: 110px;">Options</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody></tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <?php $this->load->view('aside/foot');?>
                </div>
            </div>
        </div>

        <?php $this->load->view('aside/user');?>
        <?php $this->load->view('aside/script');?>

        <div class="modal fade" id="notifFormatModal" data-backdrop="static">
            <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Isian Template Notifikasi</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Kapan dikirim</label>
                                    <select class="form-control" id="notifWhen">
                                        <option value="">-- Pilih --</option>
                                        <option value="default" style="display:none;">Template default (lonceng)</option>
                                        <optgroup label="Status Created — sisa hari">
                                            <option value="7">7 hari sebelum jatuh tempo</option>
                                            <option value="6">6 hari sebelum jatuh tempo</option>
                                            <option value="5">5 hari sebelum jatuh tempo</option>
                                            <option value="4">4 hari sebelum jatuh tempo</option>
                                            <option value="3">3 hari sebelum jatuh tempo</option>
                                            <option value="2">2 hari sebelum jatuh tempo</option>
                                            <option value="1">1 hari sebelum jatuh tempo</option>
                                            <option value="0">Saat jatuh tempo</option>
                                        </optgroup>
                                        <optgroup label="Status lain">
                                            <option value="created">Saat status Open (cetak Form IS)</option>
                                            <option value="overdue">Lewat jatuh tempo</option>
                                            <option value="closed">Saat status Closed</option>
                                        </optgroup>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Subjek</label>
                                    <input type="text" class="form-control" id="notifSubject" placeholder="Contoh: Pengingat IS {nomor} — sisa {sisa_hari} hari" />
                                </div>
                            </div>
                        </div>
                        <div class="form-group mb-0">
                            <label>Isi notifikasi</label>
                            <textarea class="form-control" id="notifBody"></textarea>
                            <div class="form-text mt-3">
                                Klik untuk sisipkan ke isi (boleh juga diketik di subjek):
                                <div class="mt-2">
                                    <button type="button" class="btn btn-sm btn-light-primary mb-1 btn-placeholder" data-token="{nama}">{nama}</button>
                                    <button type="button" class="btn btn-sm btn-light-primary mb-1 btn-placeholder" data-token="{email}">{email}</button>
                                    <button type="button" class="btn btn-sm btn-light-primary mb-1 btn-placeholder" data-token="{nomor}">{nomor}</button>
                                    <button type="button" class="btn btn-sm btn-light-primary mb-1 btn-placeholder" data-token="{tanggal}">{tanggal}</button>
                                    <button type="button" class="btn btn-sm btn-light-primary mb-1 btn-placeholder" data-token="{paspor}">{paspor}</button>
                                    <button type="button" class="btn btn-sm btn-light-primary mb-1 btn-placeholder" data-token="{periode}">{periode}</button>
                                    <button type="button" class="btn btn-sm btn-light-primary mb-1 btn-placeholder" data-token="{jatuh_tempo}">{jatuh_tempo}</button>
                                    <button type="button" class="btn btn-sm btn-light-primary mb-1 btn-placeholder" data-token="{sisa_hari}">{sisa_hari}</button>
                                    <button type="button" class="btn btn-sm btn-light-primary mb-1 btn-placeholder" data-token="{status}">{status}</button>
                                </div>
                                <span class="text-muted">nama, email, nomor dokumen, tanggal dok, paspor, jangka waktu, jatuh tempo, sisa hari, status.</span>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light-primary" id="btnTestNotif">Tes Notifikasi</button>
                        <button type="button" class="btn btn-light" data-dismiss="modal">Batal</button>
                        <button type="button" class="btn btn-primary" id="btnSaveNotifFormat">Simpan Template</button>
                    </div>
                </div>
            </div>
        </div>

        <script>
            window.importSettingData = <?= json_encode(array(
                'smtp' => isset($smtp) ? $smtp : array(),
                'formats' => isset($formats) ? $formats : array()
            ), JSON_HEX_TAG | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE); ?>;
        </script>
        <script src="<?=base_url('assets/js/app.import.setting.js'); ?>?v=20260908c"></script>
    </body>
</html>
