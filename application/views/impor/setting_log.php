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
                                            <li class="breadcrumb-item text-muted"><a href="" class="text-muted">Log Notifikasi</a></li>
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
                                            <span class="card-icon"><i class="fa fa-list text-primary"></i></span>
                                            <h3 class="card-label">Log Notifikasi</h3>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <form name="notifLogForm">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label>Kata kunci</label>
                                                        <input type="text" class="form-control" name="keyword" placeholder="Email / nomor / subjek" />
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label>Dari</label>
                                                        <input type="text" class="form-control bc-date" name="dateFrom" />
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label>Sampai</label>
                                                        <input type="text" class="form-control bc-date" name="dateUntil" />
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label>Status</label>
                                                        <select class="form-control" name="status">
                                                            <option value="">Semua</option>
                                                            <option value="success">Sukses</option>
                                                            <option value="failed">Gagal</option>
                                                            <option value="test">Tes</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-1">
                                                    <div class="form-group">
                                                        <label>&nbsp;</label>
                                                        <button type="submit" class="btn btn-primary form-control"><i class="fa fa-search"></i></button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-hover">
                                                <thead>
                                                    <tr class="text-center">
                                                        <th>Waktu</th>
                                                        <th>Nomor IS</th>
                                                        <th>Email</th>
                                                        <th>Kapan</th>
                                                        <th>Subjek</th>
                                                        <th>Status</th>
                                                        <th>Keterangan</th>
                                                    </tr>
                                                </thead>
                                                <tbody name="notifLogBody">
                                                    <tr><td colspan="7" class="text-center text-muted">Klik cari untuk menampilkan log.</td></tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="text-center mt-4">
                                            <div class="btn-group" role="group">
                                                <button type="button" class="btn btn-primary" id="logPrev"><span class="fa fa-chevron-left"></span></button>
                                                <button type="button" class="btn btn-default">Halaman <span id="logPage">1</span></button>
                                                <button type="button" class="btn btn-primary" id="logNext"><span class="fa fa-chevron-right"></span></button>
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
        <script>
            (function($) {
                var page = 1;
                var last = true;
                function basePath() {
                    var path = window.location.pathname;
                    var idx = path.toLowerCase().indexOf('/import');
                    return (idx >= 0) ? path.substring(0, idx) : '';
                }
                function searchLog() {
                    $.ajax({
                        url: basePath() + '/import/search_notif_log',
                        type: 'post',
                        dataType: 'json',
                        data: JSON.stringify({
                            page: page,
                            keyword: $.trim($('[name="keyword"]').val()),
                            dateFrom: $('[name="dateFrom"]').val(),
                            dateUntil: $('[name="dateUntil"]').val(),
                            status: $('[name="status"]').val()
                        })
                    }).done(function(result) {
                        var data = (result && result.searchResult) ? result.searchResult : { rows: [], nav: { page: 1, last: true } };
                        var $body = $('[name="notifLogBody"]').empty();
                        if (data.available === false) {
                            $body.append('<tr><td colspan="7" class="text-center text-muted">Tabel import_notif_log belum ada. Jalankan SQL pembuatan tabel terlebih dahulu.</td></tr>');
                        } else if (!data.rows || !data.rows.length) {
                            $body.append('<tr><td colspan="7" class="text-center text-muted">Tidak ada data</td></tr>');
                        } else {
                            $.each(data.rows, function(i, row) {
                                var badge = row.status === 'success' ? 'success' : (row.status === 'test' ? 'info' : 'danger');
                                $body.append(
                                    '<tr>' +
                                    '<td>' + (row.sentAt || '') + '</td>' +
                                    '<td>' + (row.docNumber || '-') + '</td>' +
                                    '<td>' + (row.email || '-') + '</td>' +
                                    '<td>' + (row.sendWhen || '-') + '</td>' +
                                    '<td>' + (row.subject || '-') + '</td>' +
                                    '<td class="text-center"><span class="badge badge-' + badge + '">' + (row.status || '') + '</span></td>' +
                                    '<td>' + (row.message || '') + '</td>' +
                                    '</tr>'
                                );
                            });
                        }
                        page = data.nav.page;
                        last = data.nav.last;
                        $('#logPage').text(page);
                        $('#logPrev').prop('disabled', page <= 1);
                        $('#logNext').prop('disabled', last);
                    }).fail(function() {
                        alert('Gagal memuat log. Pastikan tabel import_notif_log sudah dibuat.');
                    });
                }
                $('.bc-date').datepicker({ todayHighlight: true, autoclose: true, orientation: 'bottom left', format: 'yyyy-mm-dd' });
                $('form[name="notifLogForm"]').on('submit', function(e) {
                    e.preventDefault();
                    page = 1;
                    searchLog();
                    return false;
                });
                $('#logPrev').on('click', function() { if (page > 1) { page -= 1; searchLog(); } });
                $('#logNext').on('click', function() { if (!last) { page += 1; searchLog(); } });
                searchLog();
            })(jQuery);
        </script>
    </body>
</html>
