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
                                                <a href="<?=base_url('import/setting')?>" class="text-muted">Setting</a>
                                            </li>
                                            <li class="breadcrumb-item text-muted">
                                                <a href="" class="text-muted">SMTP Email</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex flex-column-fluid">
                            <div class="container-fluid">
                                <form name="importSettingForm" id="importSettingForm">
                                    <div class="card card-custom mb-6">
                                        <div class="card-header">
                                            <div class="card-title">
                                                <span class="card-icon">
                                                    <i class="fa fa-envelope text-primary"></i>
                                                </span>
                                                <h3 class="card-label">SMTP Email</h3>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="smtpHost">Host</label>
                                                        <input type="text" class="form-control" name="smtpHost" id="smtpHost" placeholder="smtp.contoh.go.id" />
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="smtpPort">Port</label>
                                                        <input type="text" class="form-control" name="smtpPort" id="smtpPort" placeholder="587" />
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="smtpCrypto">Enkripsi</label>
                                                        <select class="form-control" name="smtpCrypto" id="smtpCrypto">
                                                            <option value="">None</option>
                                                            <option value="tls">TLS</option>
                                                            <option value="ssl">SSL</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="smtpUser">Username</label>
                                                        <input type="text" class="form-control" name="smtpUser" id="smtpUser" />
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="smtpPass">Password</label>
                                                        <input type="password" class="form-control" name="smtpPass" id="smtpPass" placeholder="Kosongkan jika tidak diubah" autocomplete="new-password" />
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group mb-md-0">
                                                        <label for="smtpFromEmail">From Email</label>
                                                        <input type="email" class="form-control" name="smtpFromEmail" id="smtpFromEmail" placeholder="noreply@contoh.go.id" />
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group mb-0">
                                                        <label for="smtpFromName">From Name</label>
                                                        <input type="text" class="form-control" name="smtpFromName" id="smtpFromName" placeholder="PATOPS - Impor Sementara" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="card card-custom">
                                        <div class="card-footer d-flex justify-content-end">
                                            <button type="submit" class="btn btn-primary" id="btnSaveSetting">Simpan</button>
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

        <script>
            window.importSettingData = <?= json_encode(array(
                'smtp' => isset($smtp) ? $smtp : array()
            ), JSON_HEX_TAG | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE); ?>;
        </script>
        <script src="<?=base_url('assets/js/app.import.setting.js'); ?>?v=20260908c"></script>
    </body>
</html>
