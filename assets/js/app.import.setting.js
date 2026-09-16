(function($) {
    var Setting = {
        formats: [],
        editIndex: -1,
        table: null,
        whenLabels: {
            '7': '7 hari sebelum jatuh tempo',
            '6': '6 hari sebelum jatuh tempo',
            '5': '5 hari sebelum jatuh tempo',
            '4': '4 hari sebelum jatuh tempo',
            '3': '3 hari sebelum jatuh tempo',
            '2': '2 hari sebelum jatuh tempo',
            '1': '1 hari sebelum jatuh tempo',
            '0': 'Saat jatuh tempo',
            created: 'Saat status Open (cetak Form IS)',
            overdue: 'Lewat jatuh tempo',
            closed: 'Saat status Closed',
            default: 'Template default (lonceng)'
        },
        editorOptions: {
            height: 220,
            tabsize: 2,
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
        basePath: function() {
            var path = window.location.pathname;
            var idx = path.toLowerCase().indexOf('/import');
            return (idx >= 0) ? path.substring(0, idx) : '';
        },
        escapeHtml: function(value) {
            return $('<div>').text(value == null ? '' : String(value)).html();
        },
        whenLabel: function(when) {
            return Setting.whenLabels[String(when)] || (when ? String(when) : '-');
        },
        initEditor: function() {
            var $textarea = $('#notifBody');
            if (!$textarea.length || typeof $.fn.summernote !== 'function') {
                return;
            }
            if ($textarea.next('.note-editor').length) {
                return;
            }
            $textarea.summernote(Setting.editorOptions);
        },
        destroyEditor: function() {
            var $textarea = $('#notifBody');
            if (typeof $.fn.summernote === 'function' && $textarea.next('.note-editor').length) {
                $textarea.summernote('destroy');
            }
        },
        getBody: function() {
            var $textarea = $('#notifBody');
            if (typeof $.fn.summernote === 'function' && $textarea.next('.note-editor').length) {
                return $textarea.summernote('code');
            }
            return $textarea.val() || '';
        },
        setBody: function(html) {
            var $textarea = $('#notifBody');
            if (typeof $.fn.summernote === 'function' && $textarea.next('.note-editor').length) {
                $textarea.summernote('code', html || '');
            } else {
                $textarea.val(html || '');
            }
        },
        fillSmtp: function(smtp) {
            if (!smtp) return;
            $('#smtpHost').val(smtp.host || '');
            $('#smtpPort').val(smtp.port || '');
            $('#smtpCrypto').val(smtp.crypto || '');
            $('#smtpUser').val(smtp.user || '');
            $('#smtpFromEmail').val(smtp.fromEmail || '');
            $('#smtpFromName').val(smtp.fromName || '');
            $('#testEmail').val(smtp.testEmail || '');
            $('#smtpPass').val('');
            if (smtp.hasPassword) {
                $('#smtpPass').attr('placeholder', 'Tersimpan. Kosongkan jika tidak diubah');
            }
        },
        collectSmtp: function() {
            return {
                host: $.trim($('#smtpHost').val()),
                port: $.trim($('#smtpPort').val()),
                crypto: $('#smtpCrypto').val(),
                user: $.trim($('#smtpUser').val()),
                pass: $('#smtpPass').val(),
                fromEmail: $.trim($('#smtpFromEmail').val()),
                fromName: $.trim($('#smtpFromName').val())
            };
        },
        collectFormats: function() {
            return Setting.formats.slice();
        },
        renderTable: function() {
            if (!$('#notifFormatTable').length) {
                return;
            }
            if (Setting.table) {
                Setting.table.destroy();
                Setting.table = null;
            }
            var $body = $('#notifFormatTable tbody').empty();
            $.each(Setting.formats, function(index, format) {
                var isDefault = String(format.sendWhen) === 'default';
                var title = Setting.escapeHtml(Setting.whenLabel(format.sendWhen));
                if (isDefault) {
                    title += ' <span class="badge badge-primary ml-1">Default</span>';
                }
                var delBtn = isDefault
                    ? '<button type="button" class="btn btn-sm btn-secondary" disabled title="Template default tidak dapat dihapus"><i class="fa fa-lock"></i></button>'
                    : '<button type="button" class="btn btn-sm btn-danger btn-remove-notif" title="Hapus"><i class="fa fa-trash"></i></button>';
                $body.append(
                    '<tr data-index="' + index + '">' +
                    '<td>' + title + '</td>' +
                    '<td><code>' + Setting.escapeHtml(format.sendWhen || '-') + '</code></td>' +
                    '<td>' + Setting.escapeHtml(format.subject || '-') + '</td>' +
                    '<td class="text-center">' +
                    '<button type="button" class="btn btn-sm btn-warning btn-edit-notif mr-1" title="Ubah"><i class="fa fa-cog"></i></button>' +
                    delBtn +
                    '</td>' +
                    '</tr>'
                );
            });
            if (typeof $.fn.DataTable === 'function') {
                Setting.table = $('#notifFormatTable').DataTable({
                    destroy: true,
                    autoWidth: false,
                    pageLength: 10,
                    ordering: true,
                    columnDefs: [{ orderable: false, targets: 3 }],
                    language: {
                        search: 'Cari:',
                        lengthMenu: 'Tampil _MENU_ data',
                        info: 'Showing _START_ to _END_ of _TOTAL_ entries',
                        infoEmpty: 'Showing 0 to 0 of 0 entries',
                        infoFiltered: '(disaring dari _MAX_ data)',
                        emptyTable: 'Belum ada template. Klik Tambah Template.',
                        zeroRecords: 'Tidak ada data',
                        paginate: {
                            first: 'First',
                            previous: 'Previous',
                            next: 'Next',
                            last: 'Last'
                        }
                    }
                });
            }
        },
        openModal: function(index) {
            Setting.editIndex = (typeof index === 'number') ? index : -1;
            var data = Setting.editIndex >= 0 ? Setting.formats[Setting.editIndex] : { sendWhen: '', subject: '', body: '' };
            var isDefault = String(data.sendWhen) === 'default';
            $('#notifWhen option[value="default"]').toggle(isDefault);
            $('#notifWhen').val(data.sendWhen || '').prop('disabled', isDefault);
            $('#notifSubject').val(data.subject || '');
            $('#notifFormatModal').modal('show');
            setTimeout(function() {
                Setting.initEditor();
                Setting.setBody(data.body || '');
            }, 200);
        },
        collectModal: function() {
            var existing = Setting.editIndex >= 0 ? Setting.formats[Setting.editIndex] : {};
            var sendWhen = $('#notifWhen').is(':disabled') ? (existing.sendWhen || 'default') : $('#notifWhen').val();
            return {
                id: existing.id,
                sendWhen: sendWhen,
                subject: $.trim($('#notifSubject').val()),
                body: Setting.getBody()
            };
        },
        save: function(extraMessage) {
            var $btn = $('#btnSaveSetting');
            $btn.attr('disabled', 'disabled');
            $('#btnSaveNotifFormat').attr('disabled', 'disabled');
            var payload = {};
            if ($('#smtpHost').length) {
                payload.smtp = Setting.collectSmtp();
            }
            if ($('#testEmail').length) {
                payload.testEmail = $.trim($('#testEmail').val());
            }
            if ($('#notifFormatTable').length) {
                payload.formats = Setting.collectFormats();
            }
            $.ajax({
                url: Setting.basePath() + '/import/save_setting',
                type: 'post',
                dataType: 'json',
                data: JSON.stringify(payload)
            }).done(function(result) {
                alert(extraMessage || ((result && result.message) ? result.message : 'Pengaturan disimpan.'));
                if (result && result.smtp) {
                    Setting.fillSmtp(result.smtp);
                }
                if (result && result.formats && $('#notifFormatTable').length) {
                    Setting.formats = result.formats;
                    Setting.renderTable();
                }
            }).fail(function() {
                alert('Gagal menyimpan pengaturan. Coba lagi nanti.');
            }).always(function() {
                $btn.removeAttr('disabled');
                $('#btnSaveNotifFormat').removeAttr('disabled');
            });
        },
        saveModal: function() {
            var data = Setting.collectModal();
            if (!data.sendWhen) {
                alert('Pilih kapan template ini dikirim.');
                $('#notifWhen').focus();
                return;
            }
            if (!data.subject) {
                alert('Subjek masih kosong.');
                $('#notifSubject').focus();
                return;
            }
            if (Setting.editIndex >= 0) {
                Setting.formats[Setting.editIndex] = data;
            } else {
                Setting.formats.push(data);
            }
            $('#notifFormatModal').modal('hide');
            Setting.renderTable();
            Setting.save('Template berhasil disimpan.');
        },
        sendTest: function() {
            var testEmail = $.trim($('#testEmail').val());
            if (!testEmail) {
                alert('Isi email tes terlebih dahulu.');
                $('#testEmail').focus();
                return;
            }
            var data = Setting.collectModal();
            if (!data.subject) {
                alert('Subjek format ini masih kosong.');
                $('#notifSubject').focus();
                return;
            }
            var smtp = $('#smtpHost').length ? Setting.collectSmtp() : {};
            if ($('#smtpHost').length && (!smtp.host || !smtp.fromEmail)) {
                alert('Lengkapi SMTP Host dan From Email sebelum tes kirim.');
                return;
            }

            var $btn = $('#btnTestNotif');
            $btn.attr('disabled', 'disabled');

            $.ajax({
                url: Setting.basePath() + '/import/test_notification',
                type: 'post',
                dataType: 'json',
                data: JSON.stringify({
                    testEmail: testEmail,
                    subject: data.subject,
                    body: data.body,
                    when: data.sendWhen,
                    smtp: smtp
                })
            }).done(function(result) {
                alert((result && result.message) ? result.message : 'Tes notifikasi selesai.');
            }).fail(function() {
                alert('Gagal mengirim tes notifikasi. Coba lagi nanti.');
            }).always(function() {
                $btn.removeAttr('disabled');
            });
        },
        loadInitial: function() {
            var data = window.importSettingData || {};
            if ($('#smtpHost').length || $('#testEmail').length) {
                Setting.fillSmtp(data.smtp || {});
            }
            if ($('#notifFormatTable').length) {
                Setting.formats = data.formats || [];
                Setting.renderTable();
            }
        }
    };

    $(function() {
        Setting.loadInitial();

        $('#btnAddNotifFormat').on('click', function() {
            Setting.openModal(-1);
        });

        $('#notifFormatTable').on('click', '.btn-edit-notif', function() {
            var index = parseInt($(this).closest('tr').attr('data-index'), 10);
            Setting.openModal(index);
        });

        $('#notifFormatTable').on('click', '.btn-remove-notif', function() {
            var index = parseInt($(this).closest('tr').attr('data-index'), 10);
            var format = Setting.formats[index] || {};
            if (String(format.sendWhen) === 'default') {
                alert('Template default tidak dapat dihapus.');
                return;
            }
            if (!confirm('Hapus template ini?')) {
                return;
            }
            Setting.formats.splice(index, 1);
            Setting.renderTable();
            Setting.save('Template dihapus.');
        });

        $('#btnSaveNotifFormat').on('click', Setting.saveModal);
        $('#btnTestNotif').on('click', Setting.sendTest);

        $('#notifFormatModal').on('hidden.bs.modal', function() {
            Setting.destroyEditor();
            $('#notifWhen').prop('disabled', false).val('');
            $('#notifWhen option[value="default"]').hide();
            $('#notifSubject').val('');
            $('#notifBody').val('');
            Setting.editIndex = -1;
        });

        $('#notifFormatModal').on('click', '.btn-placeholder', function() {
            var token = $(this).data('token');
            var $subject = $('#notifSubject');
            var $body = $('#notifBody');
            if ($subject.is(':focus')) {
                var el = $subject.get(0);
                var start = el.selectionStart;
                var end = el.selectionEnd;
                var val = $subject.val();
                $subject.val(val.substring(0, start) + token + val.substring(end));
                $subject.focus();
                el.selectionStart = el.selectionEnd = start + String(token).length;
                return;
            }
            if (typeof $.fn.summernote === 'function' && $body.next('.note-editor').length) {
                $body.summernote('focus');
                $body.summernote('insertText', token);
            } else {
                $body.val(($body.val() || '') + token);
            }
        });

        $('form[name="importSettingForm"]').on('submit', function(e) {
            e.preventDefault();
            Setting.save();
            return false;
        });
    });
})(jQuery);
