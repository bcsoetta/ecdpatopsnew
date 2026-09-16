(function($) {
    var Monitor = {
        params: {
            page: 1,
            dateFrom: '',
            dateUntil: '',
            docNumber: '',
            name: '',
            passport: '',
            periode: '',
            status: '',
            bpjStatus: '',
            bpjOp: '',
            bpjDays: '',
            sortBy: 'bpjStatus',
            sortDir: 'ASC',
            headline: '',
            attachments: [],
            notifyFields: []
        },
        summary: {
            dateFrom: '2020-01-01',
            dateUntil: '',
            defaultDateFrom: '2020-01-01',
            ready: false
        },
        reekspor: {
            page: 1,
            sortBy: 'doc_date',
            sortDir: 'ASC',
            timer: null
        },
        jaminan: {
            page: 1,
            sortBy: 'doc_date',
            sortDir: 'ASC',
            timer: null
        },
        editorOptions: {
            height: 220,
            tabsize: 2,
            dialogsInBody: true,
            placeholder: 'Tulis isi notifikasi...',
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'italic', 'underline', 'clear']],
                ['fontsize', ['fontsize']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['insert', ['link']],
                ['view', ['codeview']]
            ]
        },
        timer: null,
        basePath: function() {
            var path = window.location.pathname;
            var idx = path.toLowerCase().indexOf('/import');
            return (idx >= 0) ? path.substring(0, idx) : '';
        },
        setIdr: function(value) {
            var output = value.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.");
            return output;
        },
        myEncrypt: function(data) {
            var salt = 100 * 99 * 98 * 1 * 2 * 3;
            return salt * data;
        },
        collectFilters: function() {
            Monitor.params.docNumber = $.trim($('[name="filterDocNumber"]').val());
            Monitor.params.name = $.trim($('[name="filterName"]').val());
            Monitor.params.passport = $.trim($('[name="filterPassport"]').val());
            Monitor.params.periode = $.trim($('[name="filterPeriode"]').val());
            Monitor.params.status = $('[name="filterStatus"]').val();
            Monitor.params.bpjOp = $('[name="filterBpjOp"]').val();
            Monitor.params.bpjDays = $.trim($('[name="filterBpjDays"]').val());
            Monitor.params.bpjStatus = $.trim($('[name="filterBpjStatus"]').val());
        },
        updateSortIcons: function() {
            $('#monitorTable th.is-sortable').each(function() {
                var icon = $(this).find('i.fa');
                icon.removeClass('fa-sort-up fa-sort-down').addClass('fa-sort');
                if ($(this).data('sort') === Monitor.params.sortBy) {
                    icon.removeClass('fa-sort');
                    icon.addClass(Monitor.params.sortDir === 'ASC' ? 'fa-sort-up' : 'fa-sort-down');
                }
            });
        },
        renderData: function(data) {
            var result = $('[name="searchResult"]');
            var template = result.find('[template="searchResultRow"]');
            var rows = result.find('tbody').empty();
            var nav = result.find('[name="searchNav"]');

            if (!data.rows || data.rows.length === 0) {
                rows.append('<tr><td colspan="9" class="text-center text-muted py-8">Tidak ada data</td></tr>');
            }
            $('#checkAllNotify').prop('checked', false);

            $.each(data.rows, function(index, value) {
                if (value.status == '3') {
                    return;
                }
                var row = template.clone().removeClass('d-none').removeAttr('template');
                row.attr('id', value.import);
                row.find('[view="docNumber"]').html(value.docNumber);
                row.find('[view="docDate"]').html(value.docDate);
                row.find('[view="name"]').html(value.name);
                row.find('[view="passport"]').html(value.passport);
                row.find('[view="bpjStatus"]').html(value.bpjStatus);
                row.find('[view="periode"]').html(value.periode);

                var bpjStatusInt = parseInt(value.bpjStatus);
                if (bpjStatusInt <= 14) {
                    row.find('[view="bpjStatus"]').addClass('bg-danger');
                } else if (bpjStatusInt >= 15 && bpjStatusInt <= 60) {
                    row.find('[view="bpjStatus"]').addClass('bg-warning');
                } else {
                    row.find('[view="bpjStatus"]').addClass('bg-success');
                }

                var status = '';
                if (value.status == '1') {
                    status = '<button class="btn btn-sm btn-info">Created</button>';
                } else if (value.status == '2') {
                    status = '<button class="btn btn-sm btn-danger">Open</button>';
                }

                row.find('[view="status"]').html(status);
                row.find('[view="status"]').attr('value-status', value.status);
                row.attr('data-email', value.email || '');
                if (!(value.email || '')) {
                    row.find('.row-notify-check').attr('title', 'Email pemberitahu kosong');
                }
                row.appendTo(rows);
            });

            if (data.nav.page == 1) nav.find('[name="prev"]').attr('disabled', 'disabled');
            else nav.find('[name="prev"]').removeAttr('disabled');
            nav.find('[name="page"]').html(data.nav.page);
            if (data.nav.last) nav.find('[name="next"]').attr('disabled', 'disabled');
            else nav.find('[name="next"]').removeAttr('disabled');
        },
        doSearch: function() {
            Monitor.collectFilters();
            Monitor.updateSortIcons();
            var data = {
                page: Monitor.params.page,
                dateFrom: Monitor.params.dateFrom,
                dateUntil: Monitor.params.dateUntil,
                docNumber: Monitor.params.docNumber,
                name: Monitor.params.name,
                passport: Monitor.params.passport,
                periode: Monitor.params.periode,
                status: Monitor.params.status,
                bpjOp: Monitor.params.bpjOp,
                bpjDays: Monitor.params.bpjDays,
                bpjStatus: Monitor.params.bpjStatus,
                sortBy: Monitor.params.sortBy,
                sortDir: Monitor.params.sortDir,
                headline: Monitor.params.headline
            };

            $.ajax({
                url: Monitor.basePath() + '/import/search_monitoring',
                type: 'post',
                dataType: 'json',
                data: JSON.stringify(data)
            }).done(function(result) {
                if (result) {
                    Monitor.renderData(result.searchResult);
                    Monitor.renderHeadline(result.headline);
                }
            }).fail(function() {
                alert('terjadi kesalahan, coba lagi nanti..');
            });
        },
        renderHeadline: function(counts) {
            counts = counts || {};
            $('#headlineOverdue').text(counts.overdue != null ? counts.overdue : 0);
            $('#headlineD7').text(counts.d7 != null ? counts.d7 : 0);
            $('#headlineD30').text(counts.d30 != null ? counts.d30 : 0);
            $('#monitorHeadline .headline-card').removeClass('is-active');
            if (Monitor.params.headline) {
                $('#monitorHeadline .headline-card[data-headline="' + Monitor.params.headline + '"]').addClass('is-active');
            }
        },
        applyHeadline: function() {
            var bucket = $(this).attr('data-headline');
            if (Monitor.params.headline === bucket) {
                Monitor.params.headline = '';
            } else {
                Monitor.params.headline = bucket;
                $('[name="filterBpjStatus"], [name="filterBpjDays"]').val('');
                $('[name="filterBpjOp"]').val('');
            }
            Monitor.params.page = 1;
            Monitor.doSearch();
        },
        formatIdr: function(value) {
            var num = Math.round(Number(value) || 0);
            return Monitor.setIdr(String(num));
        },
        renderSummary: function(summary) {
            summary = summary || {};
            $('#summaryTotal').text(summary.total != null ? summary.total : 0);
            $('#summaryActive').text(summary.active != null ? summary.active : 0);
            $('#summaryReekspor').text(summary.reekspor != null ? summary.reekspor : 0);
            $('#summaryJaminanCount').text(summary.jaminanCount != null ? summary.jaminanCount : 0);
            $('#summaryJaminanValue').text(Monitor.formatIdr(summary.jaminanValue));
            if (summary.dateFrom) {
                Monitor.summary.dateFrom = summary.dateFrom;
            }
            if (summary.dateUntil) {
                Monitor.summary.dateUntil = summary.dateUntil;
            }
            if (Monitor.summary.dateFrom && Monitor.summary.dateUntil) {
                $('#summaryDateRange').val(Monitor.summary.dateFrom + ' - ' + Monitor.summary.dateUntil);
            }
        },
        todayYmd: function() {
            if (typeof moment === 'function') {
                return moment().format('YYYY-MM-DD');
            }
            var now = new Date();
            var m = String(now.getMonth() + 1);
            var d = String(now.getDate());
            if (m.length < 2) m = '0' + m;
            if (d.length < 2) d = '0' + d;
            return now.getFullYear() + '-' + m + '-' + d;
        },
        loadSummary: function() {
            if (!Monitor.summary.dateFrom) {
                Monitor.summary.dateFrom = Monitor.summary.defaultDateFrom;
            }
            if (!Monitor.summary.dateUntil) {
                Monitor.summary.dateUntil = Monitor.todayYmd();
            }
            $.ajax({
                url: Monitor.basePath() + '/import/monitoring_summary',
                type: 'post',
                dataType: 'json',
                data: JSON.stringify({
                    dateFrom: Monitor.summary.dateFrom,
                    dateUntil: Monitor.summary.dateUntil
                })
            }).done(function(result) {
                if (result && result.status && result.summary) {
                    Monitor.renderSummary(result.summary);
                    if (!Monitor.summary.ready && typeof moment === 'function' && $('#summaryDateRange').data('daterangepicker')) {
                        $('#summaryDateRange').data('daterangepicker').setStartDate(moment(Monitor.summary.dateFrom));
                        $('#summaryDateRange').data('daterangepicker').setEndDate(moment(Monitor.summary.dateUntil));
                    }
                    Monitor.summary.ready = true;
                }
            });
        },
        resetSummaryDate: function() {
            Monitor.summary.dateFrom = Monitor.summary.defaultDateFrom;
            Monitor.summary.dateUntil = Monitor.todayYmd();
            if (typeof moment === 'function' && $('#summaryDateRange').data('daterangepicker')) {
                $('#summaryDateRange').data('daterangepicker').setStartDate(moment(Monitor.summary.dateFrom));
                $('#summaryDateRange').data('daterangepicker').setEndDate(moment(Monitor.summary.dateUntil));
            }
            Monitor.loadSummary();
        },
        updateModalSortIcons: function(tableSelector, sortBy, sortDir) {
            $(tableSelector + ' th.is-sortable').each(function() {
                var icon = $(this).find('i.fa');
                icon.removeClass('fa-sort-up fa-sort-down').addClass('fa-sort');
                if ($(this).data('sort') === sortBy) {
                    icon.removeClass('fa-sort');
                    icon.addClass(sortDir === 'ASC' ? 'fa-sort-up' : 'fa-sort-down');
                }
            });
        },
        renderNav: function(navSelector, nav) {
            var $nav = $(navSelector);
            if (!nav || nav.page == 1) {
                $nav.find('[name="prev"]').attr('disabled', 'disabled');
            } else {
                $nav.find('[name="prev"]').removeAttr('disabled');
            }
            $nav.find('[name="page"]').html(nav && nav.page ? nav.page : 1);
            if (!nav || nav.last) {
                $nav.find('[name="next"]').attr('disabled', 'disabled');
            } else {
                $nav.find('[name="next"]').removeAttr('disabled');
            }
        },
        openReeksporModal: function() {
            Monitor.reekspor.page = 1;
            Monitor.reekspor.sortBy = 'doc_date';
            Monitor.reekspor.sortDir = 'ASC';
            $('#reeksporModal').find('input').val('');
            $('#reeksporModal').modal('show');
            Monitor.loadReekspor();
        },
        loadReekspor: function() {
            Monitor.updateModalSortIcons('#reeksporTable', Monitor.reekspor.sortBy, Monitor.reekspor.sortDir);
            $.ajax({
                url: Monitor.basePath() + '/import/search_reekspor',
                type: 'post',
                dataType: 'json',
                data: JSON.stringify({
                    page: Monitor.reekspor.page,
                    dateFrom: Monitor.summary.dateFrom,
                    dateUntil: Monitor.summary.dateUntil,
                    docNumber: $.trim($('[name="reeksporDocNumber"]').val()),
                    name: $.trim($('[name="reeksporName"]').val()),
                    passport: $.trim($('[name="reeksporPassport"]').val()),
                    reDate: $.trim($('[name="reeksporReDate"]').val()),
                    reDocNumber: $.trim($('[name="reeksporReDoc"]').val()),
                    reOffice: $.trim($('[name="reeksporOffice"]').val()),
                    sortBy: Monitor.reekspor.sortBy,
                    sortDir: Monitor.reekspor.sortDir
                })
            }).done(function(result) {
                var data = (result && result.searchResult) ? result.searchResult : { rows: [], nav: { page: 1, last: true } };
                var template = $('#reeksporTable [template="reeksporRow"]');
                var rows = $('#reeksporTable tbody').empty();
                if (!data.rows || !data.rows.length) {
                    rows.append('<tr><td colspan="7" class="text-center text-muted py-8">Tidak ada data</td></tr>');
                } else {
                    $.each(data.rows, function(i, value) {
                        var row = template.clone().removeClass('d-none').removeAttr('template');
                        row.find('[view="docNumber"]').text(value.docNumber || '');
                        row.find('[view="docDate"]').text(value.docDate || '');
                        row.find('[view="name"]').text(value.name || '');
                        row.find('[view="passport"]').text(value.passport || '');
                        row.find('[view="reDate"]').text(value.reDate || '');
                        row.find('[view="reDocNumber"]').text(value.reDocNumber || '');
                        row.find('[view="reOffice"]').text(value.reOffice || '');
                        row.appendTo(rows);
                    });
                }
                Monitor.renderNav('[name="reeksporNav"]', data.nav);
            }).fail(function() {
                alert('Gagal memuat data Reekspor.');
            });
        },
        scheduleReekspor: function() {
            clearTimeout(Monitor.reekspor.timer);
            Monitor.reekspor.timer = setTimeout(function() {
                Monitor.reekspor.page = 1;
                Monitor.loadReekspor();
            }, 400);
        },
        openJaminanModal: function() {
            Monitor.jaminan.page = 1;
            Monitor.jaminan.sortBy = 'doc_date';
            Monitor.jaminan.sortDir = 'ASC';
            $('#jaminanModal').find('input').val('');
            $('#jaminanModal').modal('show');
            Monitor.loadJaminan();
        },
        loadJaminan: function() {
            Monitor.updateModalSortIcons('#jaminanTable', Monitor.jaminan.sortBy, Monitor.jaminan.sortDir);
            $.ajax({
                url: Monitor.basePath() + '/import/search_jaminan_definitif',
                type: 'post',
                dataType: 'json',
                data: JSON.stringify({
                    page: Monitor.jaminan.page,
                    dateFrom: Monitor.summary.dateFrom,
                    dateUntil: Monitor.summary.dateUntil,
                    bpjNumber: $.trim($('[name="jaminanBpj"]').val()),
                    docNumber: $.trim($('[name="jaminanDocNumber"]').val()),
                    name: $.trim($('[name="jaminanName"]').val()),
                    nominal: $.trim($('[name="jaminanNominal"]').val()),
                    sortBy: Monitor.jaminan.sortBy,
                    sortDir: Monitor.jaminan.sortDir
                })
            }).done(function(result) {
                var data = (result && result.searchResult) ? result.searchResult : { rows: [], nav: { page: 1, last: true } };
                var template = $('#jaminanTable [template="jaminanRow"]');
                var rows = $('#jaminanTable tbody').empty();
                if (!data.rows || !data.rows.length) {
                    rows.append('<tr><td colspan="5" class="text-center text-muted py-8">Tidak ada data</td></tr>');
                } else {
                    $.each(data.rows, function(i, value) {
                        var row = template.clone().removeClass('d-none').removeAttr('template');
                        row.find('[view="bpjNumber"]').text(value.bpjNumber || '');
                        row.find('[view="docNumber"]').text(value.docNumber || '');
                        row.find('[view="docDate"]').text(value.docDate || '');
                        row.find('[view="name"]').text(value.name || '');
                        row.find('[view="nominal"]').text('Rp ' + Monitor.formatIdr(value.nominal));
                        row.appendTo(rows);
                    });
                }
                Monitor.renderNav('[name="jaminanNav"]', data.nav);
            }).fail(function() {
                alert('Gagal memuat data Jaminan Definitif.');
            });
        },
        scheduleJaminan: function() {
            clearTimeout(Monitor.jaminan.timer);
            Monitor.jaminan.timer = setTimeout(function() {
                Monitor.jaminan.page = 1;
                Monitor.loadJaminan();
            }, 400);
        },
        initSummaryDateRange: function() {
            Monitor.summary.dateFrom = Monitor.summary.defaultDateFrom;
            Monitor.summary.dateUntil = Monitor.todayYmd();
            if (typeof $.fn.daterangepicker !== 'function') {
                Monitor.loadSummary();
                return;
            }
            $('#summaryDateRange').daterangepicker({
                autoUpdateInput: false,
                autoApply: false,
                opens: 'left',
                drops: 'down',
                startDate: moment(Monitor.summary.dateFrom),
                endDate: moment(Monitor.summary.dateUntil),
                buttonClasses: 'btn',
                applyClass: 'btn-primary',
                cancelClass: 'btn-secondary',
                locale: {
                    format: 'YYYY-MM-DD',
                    separator: ' - ',
                    applyLabel: 'Pilih',
                    cancelLabel: 'Hapus',
                    fromLabel: 'Dari',
                    toLabel: 'Sampai',
                    customRangeLabel: 'Custom',
                    weekLabel: 'M',
                    daysOfWeek: ['Min', 'Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab'],
                    monthNames: ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'],
                    firstDay: 1
                }
            });

            $('#summaryDateRange').on('apply.daterangepicker', function(ev, picker) {
                Monitor.summary.dateFrom = picker.startDate.format('YYYY-MM-DD');
                Monitor.summary.dateUntil = picker.endDate.format('YYYY-MM-DD');
                $(this).val(Monitor.summary.dateFrom + ' - ' + Monitor.summary.dateUntil);
                Monitor.loadSummary();
            });

            $('#summaryDateRange').on('cancel.daterangepicker', function() {
                Monitor.resetSummaryDate();
            });

            $('#btnResetSummaryDate').on('click', Monitor.resetSummaryDate);
            Monitor.loadSummary();
        },
        scheduleSearch: function() {
            clearTimeout(Monitor.timer);
            Monitor.timer = setTimeout(function() {
                Monitor.params.page = 1;
                Monitor.doSearch();
            }, 400);
        },
        showAttachments: function() {
            var modal = $('#imageViewer');
            var template = $('[template="carousel-img"]');
            var body = $('.carousel-inner').empty();

            $.each(Monitor.params.attachments, function(index, value) {
                var row = template.clone().removeClass('d-none').removeAttr('template');
                if (index == 0) {
                    row.addClass('active');
                }
                row.find('img').attr('src', '/assets/custom/temps/' + value.name);
                row.appendTo(body);
            });

            modal.modal('show');
        },
        getDetail: function() {
            var row = $(this).closest('tr');
            var data = parseInt(row.attr('id'));
            var msg = {
                header_id: Monitor.myEncrypt(data)
            };

            $.ajax({
                url: Monitor.basePath() + '/import/get_detail',
                type: 'post',
                dataType: 'json',
                data: JSON.stringify(msg)
            }).done(function(result) {
                if (result) {
                    var modal = $('#reviewModal');
                    modal.find('[view="title"]').html(result.header.doc);
                    modal.find('[view="identity_type"]').html(result.header.identity_type);
                    modal.find('[view="identity_number"]').html(result.header.identity_number);
                    modal.find('[view="name"]').html(result.header.name);
                    modal.find('[view="address"]').html(result.header.address);
                    modal.find('[view="airport_in"]').html(result.header.airport_in);
                    modal.find('[view="airport_out"]').html(result.header.airport_out);
                    modal.find('[view="inv_number"]').html(result.header.inv_number);
                    modal.find('[view="inv_date"]').html(result.header.inv_date);
                    modal.find('[view="carrier"]').html(result.header.carrier);
                    modal.find('[view="return_type"]').html(result.header.return_type);
                    modal.find('[view="periode"]').html(result.header.periode + ' Hari');
                    modal.find('[view="account_number"]').html(result.account.number);
                    modal.find('[view="account_name"]').html(result.account.name);
                    modal.find('[view="account_bank"]').html(result.account.bank);
                    modal.find('[view="use_location"]').html(result.sponsor.location);
                    modal.find('[view="use_reason"]').html(result.sponsor.reason);
                    modal.find('[view="date_out"]').html(result.header.date_out);

                    var table = $('table[name="reviewItems"]');
                    var template = table.find('[template="reviewItemsBody"]');
                    var tbody = table.find('tbody').empty();
                    var theTotal = 0;
                    $.each(result.items, function(index, value) {
                        var theDesc = value.hs + '<br />' + value.bmIdr + ' + ' + value.ppnIdr + ' + ' + value.ppnbmIdr + ' + ' + value.pphIdr
                            + ' = Rp. ' + value.total;
                        var itemRow = template.clone().removeClass('d-none').removeAttr('template');
                        itemRow.attr('id', value.item);
                        itemRow.find('[view="number"]').html(index + 1);
                        itemRow.find('[view="qty"]').html(value.qty + ' ' + value.type);
                        itemRow.find('[view="desc"]').html(value.name + ' ' + value.desc);
                        itemRow.find('[view="itemValue"]').html(value.cif + ' ' + value.currency + ' / Rp. ' + value.itemValue);
                        itemRow.find('[view="total"]').html(theDesc);
                        Monitor.params.attachments = value.attachments;
                        itemRow.find('[view="itemFile"]').on('click', Monitor.showAttachments);
                        itemRow.appendTo(tbody);
                        theTotal += parseInt(String(value.total).replace(/\./g, '')) || 0;
                    });
                    var total = '<tr><td colspan="4">Total</td><td colspan="2">Rp. ' + Monitor.setIdr(theTotal) + '</td></tr>';
                    tbody.append(total);
                    modal.modal('show');
                }
            }).fail(function() {
                alert('terjadi kesalahan, coba lagi nanti..');
            });
        },
        printPage: function() {
            var row = $(this).closest('tr');
            var data = row.attr('id');
            var value = $(this).attr('value');
            var link = '/import/print_form/';
            if (value == '1') link = '/import/print_form_is/';
            else if (value == '2') {
                var valueStatus = row.find('[view="status"]').attr('value-status');
                if (valueStatus != '3') {
                    alert('Update Status Penyelesaian terlebih dahulu...');
                    return false;
                }
                link = '/import/print_form_return/';
            }

            var msg = (typeof myEncrypt === 'function') ? myEncrypt(data) : Monitor.myEncrypt(data);
            var base_url = window.location.origin + Monitor.basePath() + link + msg;
            var win = window.open(base_url, '_blank');
            if (win) {
                win.focus();
            } else {
                alert('Please allow popups for this website');
            }
        },
        resetFilters: function() {
            $('[name="filterDocNumber"], [name="filterName"], [name="filterPassport"], [name="filterPeriode"], [name="filterBpjStatus"], [name="filterBpjDays"]').val('');
            $('[name="filterStatus"], [name="filterBpjOp"]').val('');
            $('#filterDocDate').val('');
            Monitor.params.dateFrom = '';
            Monitor.params.dateUntil = '';
            Monitor.params.sortBy = 'bpjStatus';
            Monitor.params.sortDir = 'ASC';
            Monitor.params.headline = '';
            Monitor.params.page = 1;
            Monitor.doSearch();
        },
        selectedRows: function() {
            var selected = [];
            $('#monitorTable tbody .row-notify-check:checked').each(function() {
                var row = $(this).closest('tr');
                selected.push({
                    id: row.attr('id'),
                    email: $.trim(row.attr('data-email') || '')
                });
            });
            return selected;
        },
        initNotifyEditor: function() {
            var $textarea = $('#notifyBody');
            if (!$textarea.length || typeof $.fn.summernote !== 'function') {
                return;
            }
            if ($textarea.next('.note-editor').length) {
                return;
            }
            $textarea.summernote(Monitor.editorOptions);
        },
        destroyNotifyEditor: function() {
            var $textarea = $('#notifyBody');
            if (typeof $.fn.summernote === 'function' && $textarea.next('.note-editor').length) {
                $textarea.summernote('destroy');
            }
        },
        getNotifyBody: function() {
            var $textarea = $('#notifyBody');
            if (typeof $.fn.summernote === 'function' && $textarea.next('.note-editor').length) {
                return $textarea.summernote('code');
            }
            return $textarea.val() || '';
        },
        setNotifyBody: function(html) {
            var $textarea = $('#notifyBody');
            if (typeof $.fn.summernote === 'function' && $textarea.next('.note-editor').length) {
                $textarea.summernote('code', html || '');
            } else {
                $textarea.val(html || '');
            }
        },
        escapeHtml: function(value) {
            return $('<div>').text(value == null ? '' : String(value)).html();
        },
        renderNotifyChips: function(fields) {
            var $wrap = $('#notifyFieldChips').empty();
            Monitor.params.notifyFields = fields || [];
            $.each(Monitor.params.notifyFields, function(i, item) {
                var value = item && item.value != null ? String(item.value) : '';
                var label = value !== '' ? value : '—';
                var $btn = $('<button type="button" class="btn btn-sm btn-light-primary mb-1 mr-1 btn-row-field"></button>');
                $btn.attr('data-value', value);
                $btn.attr('title', (item.key || '') + (value ? ': ' + value : ''));
                $btn.text(label);
                $wrap.append($btn);
            });
        },
        insertNotifyValue: function(text) {
            var $subject = $('#notifySubject');
            var $body = $('#notifyBody');
            if ($subject.is(':focus')) {
                var el = $subject.get(0);
                var start = el.selectionStart;
                var end = el.selectionEnd;
                var val = $subject.val();
                $subject.val(val.substring(0, start) + text + val.substring(end));
                $subject.focus();
                el.selectionStart = el.selectionEnd = start + String(text).length;
                return;
            }
            if (typeof $.fn.summernote === 'function' && $body.next('.note-editor').length) {
                $body.summernote('focus');
                $body.summernote('insertText', text);
            } else {
                $body.val(($body.val() || '') + text);
            }
        },
        confirmNotify: function() {
            var row = $(this).closest('tr');
            var email = $.trim(row.attr('data-email') || '');
            var importId = row.attr('id');
            if (!email) {
                alert('Email pemberitahu belum diisi. Notifikasi tidak dapat dikirim.');
                return;
            }
            $.ajax({
                url: Monitor.basePath() + '/import/preview_notification',
                type: 'post',
                dataType: 'json',
                data: JSON.stringify({ importId: importId })
            }).done(function(result) {
                if (!result || !result.status) {
                    alert((result && result.message) ? result.message : 'Gagal memuat template default.');
                    return;
                }
                $('#notifyConfirmModal').data('import-ids', [importId]);
                $('#notifyConfirmModal').data('format-id', result.formatId || '');
                $('#notifyConfirmModal').data('editable', true);
                $('#notifyConfirmText').text('Periksa/ubah template default sebelum dikirim ke ' + (result.email || email) + '.');
                $('#notifyToEmail').val(result.email || email);
                $('#notifySubject').val(result.subject || '');
                $('#notifyEditFields').show();
                $('#notifyFieldChipsWrap').show();
                Monitor.renderNotifyChips(result.fields || []);
                $('#notifyConfirmModal').data('pending-body', result.body || '');
                $('#notifyConfirmModal').modal('show');
            }).fail(function() {
                alert('Gagal memuat template default. Coba lagi nanti.');
            });
        },
        confirmNotifySelected: function() {
            var selected = Monitor.selectedRows();
            if (!selected.length) {
                alert('Pilih dulu data yang akan dikirimi notifikasi.');
                return;
            }
            var withEmail = [];
            var withoutEmail = 0;
            $.each(selected, function(i, item) {
                if (item.email) {
                    withEmail.push(item.id);
                } else {
                    withoutEmail += 1;
                }
            });
            if (!withEmail.length) {
                alert('Data terpilih belum punya email pemberitahu.');
                return;
            }
            var text = 'Kirim template default ke ' + withEmail.length + ' data terpilih?';
            if (withoutEmail) {
                text += ' ' + withoutEmail + ' data tanpa email akan dilewati.';
            }
            $('#notifyConfirmModal').data('import-ids', withEmail);
            $('#notifyConfirmModal').data('editable', false);
            $('#notifyConfirmText').text(text);
            $('#notifyToEmail').val('');
            $('#notifySubject').val('');
            $('#notifyBody').val('');
            $('#notifyFieldChips').empty();
            $('#notifyEditFields').hide();
            Monitor.destroyNotifyEditor();
            $('#notifyConfirmModal').modal('show');
        },
        sendNotify: function() {
            var importIds = $('#notifyConfirmModal').data('import-ids') || [];
            if (!importIds.length) {
                alert('Tidak ada data yang dipilih.');
                return;
            }
            var payload = { importIds: importIds };
            if ($('#notifyConfirmModal').data('editable')) {
                var subject = $.trim($('#notifySubject').val());
                if (!subject) {
                    alert('Subjek masih kosong.');
                    $('#notifySubject').focus();
                    return;
                }
                payload.subject = subject;
                payload.body = Monitor.getNotifyBody();
                payload.formatId = $('#notifyConfirmModal').data('format-id') || '';
            }
            var $btn = $('#btnConfirmNotify');
            $btn.attr('disabled', 'disabled');
            $.ajax({
                url: Monitor.basePath() + '/import/send_notification',
                type: 'post',
                dataType: 'json',
                data: JSON.stringify(payload)
            }).done(function(result) {
                alert((result && result.message) ? result.message : 'Notifikasi selesai.');
                $('#notifyConfirmModal').modal('hide');
                $('#checkAllNotify').prop('checked', false);
                $('#monitorTable tbody .row-notify-check').prop('checked', false);
            }).fail(function() {
                alert('Gagal mengirim notifikasi. Coba lagi nanti.');
            }).always(function() {
                $btn.removeAttr('disabled');
            });
        },
        initDateRange: function() {
            if (typeof $.fn.daterangepicker !== 'function') {
                return;
            }
            $('#filterDocDate').daterangepicker({
                autoUpdateInput: false,
                autoApply: false,
                opens: 'center',
                drops: 'down',
                buttonClasses: 'btn',
                applyClass: 'btn-primary',
                cancelClass: 'btn-secondary',
                locale: {
                    format: 'YYYY-MM-DD',
                    separator: ' - ',
                    applyLabel: 'Pilih',
                    cancelLabel: 'Hapus',
                    fromLabel: 'Dari',
                    toLabel: 'Sampai',
                    customRangeLabel: 'Custom',
                    weekLabel: 'M',
                    daysOfWeek: ['Min', 'Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab'],
                    monthNames: ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'],
                    firstDay: 1
                }
            });

            $('#filterDocDate').on('apply.daterangepicker', function(ev, picker) {
                $(this).val(picker.startDate.format('YYYY-MM-DD') + ' - ' + picker.endDate.format('YYYY-MM-DD'));
                Monitor.params.dateFrom = picker.startDate.format('YYYY-MM-DD');
                Monitor.params.dateUntil = picker.endDate.format('YYYY-MM-DD');
                Monitor.params.page = 1;
                Monitor.doSearch();
            });

            $('#filterDocDate').on('cancel.daterangepicker', function() {
                $(this).val('');
                Monitor.params.dateFrom = '';
                Monitor.params.dateUntil = '';
                Monitor.params.page = 1;
                Monitor.doSearch();
            });
        }
    };

    $(function() {
        Monitor.initDateRange();
        Monitor.initSummaryDateRange();

        $('[name="filterDocNumber"], [name="filterName"], [name="filterPassport"], [name="filterPeriode"], [name="filterBpjStatus"], [name="filterBpjDays"]').on('keyup input', function() {
            Monitor.scheduleSearch();
        });

        $('[name="filterStatus"], [name="filterBpjOp"]').on('change', function() {
            Monitor.params.page = 1;
            Monitor.doSearch();
        });

        $('#monitorHeadline').on('click', '.headline-card', Monitor.applyHeadline);
        $('#cardReekspor').on('click', Monitor.openReeksporModal);
        $('#cardJaminan').on('click', Monitor.openJaminanModal);

        $('#reeksporModal').on('keyup input', '.filter-row input', Monitor.scheduleReekspor);
        $('#reeksporTable').on('click', 'th.is-sortable', function() {
            var sortBy = $(this).data('sort');
            if (Monitor.reekspor.sortBy === sortBy) {
                Monitor.reekspor.sortDir = (Monitor.reekspor.sortDir === 'ASC') ? 'DESC' : 'ASC';
            } else {
                Monitor.reekspor.sortBy = sortBy;
                Monitor.reekspor.sortDir = 'ASC';
            }
            Monitor.reekspor.page = 1;
            Monitor.loadReekspor();
        });
        $('[name="reeksporNav"] [name="next"]').on('click', function() {
            Monitor.reekspor.page = Monitor.reekspor.page + 1;
            Monitor.loadReekspor();
        });
        $('[name="reeksporNav"] [name="prev"]').on('click', function() {
            Monitor.reekspor.page = Monitor.reekspor.page - 1;
            Monitor.loadReekspor();
        });

        $('#jaminanModal').on('keyup input', '.filter-row input', Monitor.scheduleJaminan);
        $('#jaminanTable').on('click', 'th.is-sortable', function() {
            var sortBy = $(this).data('sort');
            if (Monitor.jaminan.sortBy === sortBy) {
                Monitor.jaminan.sortDir = (Monitor.jaminan.sortDir === 'ASC') ? 'DESC' : 'ASC';
            } else {
                Monitor.jaminan.sortBy = sortBy;
                Monitor.jaminan.sortDir = 'ASC';
            }
            Monitor.jaminan.page = 1;
            Monitor.loadJaminan();
        });
        $('[name="jaminanNav"] [name="next"]').on('click', function() {
            Monitor.jaminan.page = Monitor.jaminan.page + 1;
            Monitor.loadJaminan();
        });
        $('[name="jaminanNav"] [name="prev"]').on('click', function() {
            Monitor.jaminan.page = Monitor.jaminan.page - 1;
            Monitor.loadJaminan();
        });

        $('#notifyConfirmModal').on('shown.bs.modal', function() {
            if (!$('#notifyConfirmModal').data('editable')) {
                return;
            }
            setTimeout(function() {
                Monitor.initNotifyEditor();
                Monitor.setNotifyBody($('#notifyConfirmModal').data('pending-body') || '');
            }, 200);
        });
        $('#notifyConfirmModal').on('hidden.bs.modal', function() {
            Monitor.destroyNotifyEditor();
            $('#notifyConfirmModal').data('pending-body', '');
            $('#notifyFieldChips').empty();
        });
        $('#notifyConfirmModal').on('click', '.btn-row-field', function() {
            var value = $(this).attr('data-value') || '';
            if (value === '') {
                return;
            }
            Monitor.insertNotifyValue(value);
        });
        $('#btnResetFilter').on('click', Monitor.resetFilters);
        $('#monitorTable').on('click', '[view="actionNotify"]', Monitor.confirmNotify);
        $('#btnNotifySelected').on('click', Monitor.confirmNotifySelected);
        $('#btnConfirmNotify').on('click', Monitor.sendNotify);
        $('#checkAllNotify').on('change', function() {
            $('#monitorTable tbody .row-notify-check').prop('checked', $(this).is(':checked'));
        });
        $('#monitorTable').on('change', '.row-notify-check', function() {
            var all = $('#monitorTable tbody .row-notify-check').length;
            var checked = $('#monitorTable tbody .row-notify-check:checked').length;
            $('#checkAllNotify').prop('checked', all > 0 && all === checked);
        });

        $('#monitorTable').on('click', 'th.is-sortable', function() {
            var sortBy = $(this).data('sort');
            if (Monitor.params.sortBy === sortBy) {
                Monitor.params.sortDir = (Monitor.params.sortDir === 'ASC') ? 'DESC' : 'ASC';
            } else {
                Monitor.params.sortBy = sortBy;
                Monitor.params.sortDir = 'ASC';
            }
            Monitor.params.page = 1;
            Monitor.doSearch();
        });

        $('[name="next"]').on('click', function() {
            Monitor.params.page = Monitor.params.page + 1;
            Monitor.doSearch();
        });
        $('[name="prev"]').on('click', function() {
            Monitor.params.page = Monitor.params.page - 1;
            Monitor.doSearch();
        });

        Monitor.doSearch();
    });
})(jQuery);
