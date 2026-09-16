(function($) {
    var Import = {
        params: {
            page: 1,
            dateFrom: '',
            dateUntil: '',
            docNumber: '',
            confirmSave: 0,
            currentTab: 1,
            maxReachedTab: 1,
            dataPost: {
                personal: {},
                items: [],
                guarantee: {}
            },
            keyHeaderPost: '',
            keyItemPost: '',
            headerID: '',
            attachments: [],
            bm: 0,
            ppn: 0,
            pph: 0,
            ppnbm: 0,
            fine: 0,
            total: 0,
            emailValidated: false,
            emailValidatedValue: ''
        },
        setIdr: function(value) {
            var output = value.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.");
            return output;
        },
        unsetIdr: function(value) {
            if (value === undefined || value === null) return '0';
            newValue = value.toString().split('.').join('');
            return newValue;
        },
        toNumber: function(value) {
            var n = parseFloat(Import.unsetIdr(value));
            return isFinite(n) ? n : 0;
        },
        pctNumber: function(value) {
            if (value === undefined || value === null || value === '') return 0;
            var n = parseFloat(String(value).replace(',', '.'));
            return isFinite(n) ? n : 0;
        },
        recalcItem: function() {
            var fob = Import.pctNumber($('#itemFob').val());
            var freight = Import.pctNumber($('#itemFreight').val());
            var insurance = Import.pctNumber($('#itemInsurance').val());
            var kurs = Import.pctNumber($('#itemKurs').val());
            var cif = fob + freight + insurance;
            var pabean = Math.round(cif * kurs);
            if (!isFinite(pabean) || pabean < 0) {
                pabean = 0;
            }

            $('#itemCif').val(cif);
            $('#itemValue').val(Import.setIdr(pabean));
            Import.recalcPungutan();
        },
        recalcPungutan: function() {
            var pabean = Import.toNumber($('#itemValue').val());
            var bmPct = 10;
            $('#itemPabeanIn').val('10');
            var ppnPct = Import.pctNumber($('#itemPpn').val());
            var ppnbmPct = Import.pctNumber($('#itemPpnbm').val());
            var pphPct = Import.pctNumber($('#itemPph').val());
            var finePct = Import.pctNumber($('#itemFine').val());

            var bmIdr = Math.ceil(((pabean * bmPct) / 100) / 1000) * 1000;
            if (!isFinite(bmIdr)) bmIdr = 0;
            var ppnIdr = Math.ceil((((pabean + bmIdr) * ppnPct) / 100) / 1000) * 1000;
            if (!isFinite(ppnIdr)) ppnIdr = 0;
            var ppnbmIdr = Math.ceil((((pabean + bmIdr) * ppnbmPct) / 100) / 1000) * 1000;
            if (!isFinite(ppnbmIdr)) ppnbmIdr = 0;
            var pphIdr = Math.ceil((((pabean + bmIdr) * pphPct) / 100) / 1000) * 1000;
            if (!isFinite(pphIdr)) pphIdr = 0;
            var fineIdr = (bmIdr * finePct) / 100;
            if (!isFinite(fineIdr)) fineIdr = 0;

            $('#itemPabeanInIDR').val(Import.setIdr(bmIdr));
            $('#itemPpnIDR').val(Import.setIdr(ppnIdr));
            $('#itemPpnbmIDR').val(Import.setIdr(ppnbmIdr));
            $('#itemPphIDR').val(Import.setIdr(pphIdr));
            $('#itemFineIDR').val(Import.setIdr(fineIdr));
            $('#itemTotalCollect').val(Import.setIdr(bmIdr + ppnIdr + ppnbmIdr + pphIdr + fineIdr));
        },
        resetForm: function() {
            var modal = $('#newModal');
            modal.find('input[type=text], input[type=email], textarea').val('');
            modal.find('input[type=radio]').prop('checked', false);
            modal.find('#periode').val('90');
            modal.find('#airportIn, #airportOut').val('143');
            $('table[name="importTable"]').find('tbody').empty();
            $('table[name="reviewCreateItems"]').find('tbody').empty();

            Import.params.bm = 0;
            Import.params.ppn = 0;
            Import.params.pph = 0;
            Import.params.ppnbm = 0;
            Import.params.fine = 0;
            Import.params.total = 0;
            Import.params.currentTab = 1;
            Import.params.maxReachedTab = 1;
            Import.params.confirmSave = 0;

            var summaryTable = $('table[name="importSummaryTable"]');
            summaryTable.find('[view="summBM"]').html(Import.setIdr(Import.params.bm));
            summaryTable.find('[view="summPpn"]').html(Import.setIdr(Import.params.ppn));
            summaryTable.find('[view="summPph"]').html(Import.setIdr(Import.params.pph));
            summaryTable.find('[view="summPpnbm"]').html(Import.setIdr(Import.params.ppnbm));
            summaryTable.find('[view="summFine"]').html(Import.setIdr(Import.params.fine));
            summaryTable.find('[view="summTotal"]').html(Import.setIdr(Import.params.total));
            modal.find('input[name=guaranteeNominal]').val('');
            Import.params.emailValidated = false;
            Import.params.emailValidatedValue = '';
            $('#emailValidateMsg').text('').removeClass('text-success text-danger');
            Import.showTab(1);
        },
        saveDraft: function() {
            if (!Import.params.keyHeaderPost) {
                return;
            }
            $.ajax({
                url: Import.basePath() + '/import/save_draft',
                type: 'post',
                dataType: 'json',
                data: JSON.stringify({
                    keyHeader: Import.params.keyHeaderPost,
                    currentTab: Import.params.currentTab,
                    payload: {
                        personal: Import.collectPersonal(),
                        guarantee: Import.collectGuarantee(),
                        emailValidated: Import.params.emailValidated,
                        emailValidatedValue: Import.params.emailValidatedValue,
                        maxReachedTab: Import.params.maxReachedTab
                    }
                })
            });
        },
        fillForm: function(personal, guarantee) {
            var modal = $('#newModal');
            personal = personal || {};
            guarantee = guarantee || {};
            if (personal.identityType) {
                modal.find('input[name=identityType][value="' + personal.identityType + '"]').prop('checked', true).trigger('change');
            }
            modal.find('input[name=name]').val(personal.name || '');
            modal.find('textarea[name=address]').val(personal.address || '');
            modal.find('input[name=identity]').val(personal.identity || '');
            modal.find('input[name=pemberitahuEmail]').val(personal.email || '');
            modal.find('input[name=sponsName]').val(personal.sponsName || '');
            modal.find('input[name=sponsNik]').val(personal.sponsNik || '');
            modal.find('input[name=sponsLocation]').val(personal.sponsLocation || '');
            modal.find('input[name=sponsReason]').val(personal.sponsReason || '');
            modal.find('textarea[name=sponsAddress]').val(personal.sponsAddress || '');
            modal.find('input[name=sponsPhone]').val(personal.sponsPhone || '');
            if (personal.returnGuarantee) {
                modal.find('input[name=returnGuarantee][value="' + personal.returnGuarantee + '"]').prop('checked', true);
                Import.toggleAccountSection();
            }
            modal.find('select[name=airportIn]').val(personal.airportIn || '143');
            modal.find('select[name=airportOut]').val(personal.airportOut || '143');
            modal.find('input[name=invDate]').val(personal.invDate || '');
            modal.find('input[name=invNumber]').val(personal.invNumber || '');
            modal.find('input[name=carrierName]').val(personal.carrierName || '');
            modal.find('input[name=invDateOut]').val(personal.invDateOut || '');
            modal.find('input[name=periode]').val(personal.periode || '90');
            modal.find('input[name=accountNumber]').val(personal.accountNumber || '');
            modal.find('input[name=accountName]').val(personal.accountName || '');
            modal.find('input[name=accountBank]').val(personal.accountBank || '');
            if (guarantee.guaranteeType) {
                modal.find('input[name=guaranteeType][value="' + guarantee.guaranteeType + '"]').prop('checked', true);
            }
            modal.find('input[name=guaranteeNominal]').val(guarantee.guaranteeNominal || '');
            modal.find('input[name=source]').val(guarantee.source || '');
            modal.find('input[name=sourceNumber]').val(guarantee.sourceNumber || '');
            modal.find('input[name=sourceDate]').val(guarantee.sourceDate || '');
            modal.find('input[name=treasurerName]').val(guarantee.treasurerName || '');
            modal.find('input[name=treasurerNip]').val(guarantee.treasurerNip || '');
        },
        applyDraft: function(draft) {
            Import.resetForm();
            Import.params.keyHeaderPost = draft.keyHeader;
            Import.params.dataPost = {
                personal: (draft.payload && draft.payload.personal) ? draft.payload.personal : {},
                items: [],
                guarantee: (draft.payload && draft.payload.guarantee) ? draft.payload.guarantee : {}
            };
            Import.fillForm(Import.params.dataPost.personal, Import.params.dataPost.guarantee);
            Import.params.emailValidated = !!(draft.payload && draft.payload.emailValidated);
            Import.params.emailValidatedValue = (draft.payload && draft.payload.emailValidatedValue) ? draft.payload.emailValidatedValue : '';
            if (Import.params.emailValidated && Import.params.emailValidatedValue) {
                Import.setEmailMsg('Email sudah divalidasi.', true);
            }
            Import.params.maxReachedTab = (draft.payload && draft.payload.maxReachedTab) ? parseInt(draft.payload.maxReachedTab, 10) : 1;
            if (draft.items && draft.items.length) {
                Import.renderItemTemp(draft.items);
            }
            var tab = parseInt(draft.currentTab, 10) || 1;
            if (tab > Import.params.maxReachedTab) {
                Import.params.maxReachedTab = tab;
            }
            Import.showTab(tab);
        },
        openCreateModal: function() {
            $.ajax({
                url: Import.basePath() + '/import/get_draft',
                type: 'post',
                dataType: 'json',
                data: JSON.stringify({})
            }).done(function(result) {
                if (result && result.status && result.draft && result.draft.keyHeader) {
                    Import.applyDraft(result.draft);
                } else {
                    Import.params.dataPost = { personal: {}, items: [], guarantee: {} };
                    Import.params.keyHeaderPost = Import.generateKey();
                    Import.resetForm();
                }
                $('#newModal').modal('show');
                Import.saveDraft();
            }).fail(function() {
                Import.params.dataPost = { personal: {}, items: [], guarantee: {} };
                Import.params.keyHeaderPost = Import.generateKey();
                Import.resetForm();
                $('#newModal').modal('show');
            });
        },
        lookupLabel: function(map, key) {
            return map[key] || '-';
        },
        basePath: function() {
            var path = window.location.pathname;
            var idx = path.toLowerCase().indexOf('/import');
            return (idx >= 0) ? path.substring(0, idx) : '';
        },
        setEmailMsg: function(text, ok) {
            var $msg = $('#emailValidateMsg');
            $msg.removeClass('text-success text-danger');
            $msg.addClass(ok ? 'text-success' : 'text-danger');
            $msg.text(text || '');
        },
        validateEmail: function() {
            var email = $.trim($('#pemberitahuEmail').val());
            if (!email) {
                Import.params.emailValidated = false;
                Import.setEmailMsg('Isi email terlebih dahulu.', false);
                return;
            }
            var $btn = $('#btnValidateEmail');
            $btn.attr('disabled', 'disabled');
            Import.setEmailMsg('Memeriksa email...', false);
            $.ajax({
                url: Import.basePath() + '/import/validate_email',
                type: 'post',
                dataType: 'json',
                data: JSON.stringify({ email: email })
            }).done(function(result) {
                if (result && result.status) {
                    Import.params.emailValidated = true;
                    Import.params.emailValidatedValue = email;
                    Import.setEmailMsg(result.message || 'Email valid.', true);
                } else {
                    Import.params.emailValidated = false;
                    Import.params.emailValidatedValue = '';
                    Import.setEmailMsg((result && result.message) ? result.message : 'Email tidak valid.', false);
                }
            }).fail(function() {
                Import.params.emailValidated = false;
                Import.params.emailValidatedValue = '';
                Import.setEmailMsg('Gagal memvalidasi email. Coba lagi.', false);
            }).always(function() {
                $btn.removeAttr('disabled');
            });
        },
        collectPersonal: function() {
            var modal = $('#newModal');
            return {
                identityType: modal.find('input[name=identityType]:checked').val(),
                name: modal.find('input[name=name]').val(),
                address: modal.find('textarea[name=address]').val(),
                identity: modal.find('input[name=identity]').val(),
                email: $.trim(modal.find('input[name=pemberitahuEmail]').val()),
                sponsName: modal.find('input[name=sponsName]').val(),
                sponsNik: modal.find('input[name=sponsNik]').val(),
                sponsLocation: modal.find('input[name=sponsLocation]').val(),
                sponsReason: modal.find('input[name=sponsReason]').val(),
                sponsAddress: modal.find('textarea[name=sponsAddress]').val(),
                sponsPhone: modal.find('input[name=sponsPhone]').val(),
                returnGuarantee: modal.find('input[name=returnGuarantee]:checked').val(),
                airportIn: modal.find('select[name=airportIn]').val() ? modal.find('select[name=airportIn]').val() : 143,
                invDate: modal.find('input[name=invDate]').val(),
                invNumber: modal.find('input[name=invNumber]').val(),
                carrierName: modal.find('input[name=carrierName]').val(),
                airportOut: modal.find('select[name=airportOut]').val() ? modal.find('select[name=airportOut]').val() : 143,
                invDateOut: modal.find('input[name=invDateOut]').val(),
                periode: modal.find('input[name=periode]').val(),
                accountNumber: modal.find('input[name=accountNumber]').val(),
                accountName: modal.find('input[name=accountName]').val(),
                accountBank: modal.find('input[name=accountBank]').val()
            };
        },
        collectGuarantee: function() {
            var modal = $('#newModal');
            return {
                guaranteeType: modal.find('input[name=guaranteeType]:checked').val(),
                guaranteeName: '',
                guaranteeAddress: '',
                guaranteeNominal: modal.find('input[name=guaranteeNominal]').val(),
                source: modal.find('input[name=source]').val(),
                sourceNumber: modal.find('input[name=sourceNumber]').val(),
                sourceDate: modal.find('input[name=sourceDate]').val(),
                treasurerName: modal.find('input[name=treasurerName]').val(),
                treasurerNip: modal.find('input[name=treasurerNip]').val()
            };
        },
        validateTab: function(tab) {
            var modal = $('#newModal');
            if (tab == 1) {
                if (!modal.find('input[name=identityType]:checked').val()) {
                    alert('Pilih jenis identitas');
                    return false;
                }
                if (!$.trim(modal.find('input[name=name]').val())) {
                    alert('Nama lengkap wajib diisi');
                    return false;
                }
                if (!$.trim(modal.find('input[name=identity]').val())) {
                    alert('Nomor identitas wajib diisi');
                    return false;
                }
                var email = $.trim(modal.find('input[name=pemberitahuEmail]').val());
                if (!email) {
                    alert('Email wajib diisi');
                    return false;
                }
                if (!Import.params.emailValidated || Import.params.emailValidatedValue !== email) {
                    alert('Validasi email terlebih dahulu');
                    return false;
                }
            }
            if (tab == 2) {
                if (!$.trim(modal.find('input[name=invDateOut]').val())) {
                    alert('Perkiraan tanggal keluar wajib diisi');
                    return false;
                }
                var periode = parseInt(modal.find('input[name=periode]').val(), 10);
                if (!periode || periode < 1) {
                    alert('Jangka waktu IS wajib diisi');
                    return false;
                }
                if (periode > 90) {
                    alert('Jangka waktu tidak boleh lebih dari 90 hari');
                    return false;
                }
            }
            if (tab == 3) {
                if ($('table[name="importTable"]').find('tbody tr').length < 1) {
                    alert('Minimal 1 barang harus ditambahkan');
                    return false;
                }
            }
            if (tab == 4) {
                if (!modal.find('input[name=returnGuarantee]:checked').val()) {
                    alert('Pilih cara pengembalian jaminan');
                    return false;
                }
                if (modal.find('input[name=returnGuarantee]:checked').val() == '2') {
                    if (!$.trim(modal.find('input[name=accountNumber]').val()) ||
                        !$.trim(modal.find('input[name=accountName]').val()) ||
                        !$.trim(modal.find('input[name=accountBank]').val())) {
                        alert('Data rekening wajib diisi untuk pengembalian transfer bank');
                        return false;
                    }
                }
                if (!modal.find('input[name=guaranteeType]:checked').val()) {
                    alert('Pilih bentuk jaminan');
                    return false;
                }
            }
            return true;
        },
        populateReview: function() {
            var modal = $('#newModal');
            var personal = Import.collectPersonal();
            var guarantee = Import.collectGuarantee();
            Import.params.dataPost.personal = personal;
            Import.params.dataPost.guarantee = guarantee;

            var identityMap = { '1': 'NPWP', '2': 'KTP', '3': 'Paspor' };
            var returnMap = { '1': 'Diambil sendiri', '2': 'Transfer bank', '3': 'Sponsor' };
            var guaranteeMap = { '1': 'Tunai', '2': 'Bank', '3': 'Customs Bond', '4': 'Lainnya' };

            modal.find('[view="revIdentityType"]').html(Import.lookupLabel(identityMap, personal.identityType));
            modal.find('[view="revIdentity"]').html(personal.identity || '-');
            modal.find('[view="revName"]').html(personal.name || '-');
            modal.find('[view="revAddress"]').html(personal.address || '-');
            modal.find('[view="revEmail"]').html(personal.email || '-');
            modal.find('[view="revAirportIn"]').html(modal.find('#airportIn option:selected').text());
            modal.find('[view="revAirportOut"]').html(modal.find('#airportOut option:selected').text());
            modal.find('[view="revInvoice"]').html((personal.invNumber || '-') + ' / ' + (personal.invDate || '-'));
            modal.find('[view="revCarrier"]').html(personal.carrierName || '-');
            modal.find('[view="revPeriode"]').html((personal.invDateOut || '-') + ' / ' + (personal.periode || '-') + ' hari');
            modal.find('[view="revSponsor"]').html(personal.sponsName || '-');
            modal.find('[view="revUse"]').html((personal.sponsLocation || '-') + ' / ' + (personal.sponsReason || '-'));
            modal.find('[view="revReturnType"]').html(Import.lookupLabel(returnMap, personal.returnGuarantee));
            modal.find('[view="revAccount"]').html(
                personal.accountNumber
                    ? (personal.accountNumber + ' a.n. ' + (personal.accountName || '-') + ' (' + (personal.accountBank || '-') + ')')
                    : '-'
            );
            modal.find('[view="revGuaranteeType"]').html(Import.lookupLabel(guaranteeMap, guarantee.guaranteeType));
            modal.find('[view="revGuaranteeNominal"]').html(Import.setIdr(Import.params.total));
            modal.find('[view="revTreasurer"]').html(
                guarantee.treasurerName
                    ? (guarantee.treasurerName + ' / ' + (guarantee.treasurerNip || '-'))
                    : '-'
            );

            modal.find('[view="revSummBM"]').html(Import.setIdr(Import.params.bm));
            modal.find('[view="revSummPpn"]').html(Import.setIdr(Import.params.ppn));
            modal.find('[view="revSummPph"]').html(Import.setIdr(Import.params.pph));
            modal.find('[view="revSummPpnbm"]').html(Import.setIdr(Import.params.ppnbm));
            modal.find('[view="revSummFine"]').html(Import.setIdr(Import.params.fine));
            modal.find('[view="revSummTotal"]').html(Import.setIdr(Import.params.total));

            var reviewBody = $('table[name="reviewCreateItems"]').find('tbody').empty();
            $('table[name="importTable"]').find('tbody tr').each(function() {
                var row = $(this);
                reviewBody.append(
                    '<tr>' +
                        '<td>' + row.find('[view="imName"]').html() + '</td>' +
                        '<td>' + row.find('[view="imQty"]').html() + '</td>' +
                        '<td>' + row.find('[view="imHscode"]').html() + '</td>' +
                        '<td>' + row.find('[view="imPabean"]').html() + '</td>' +
                        '<td>' + row.find('[view="imCollect"]').html() + '</td>' +
                    '</tr>'
                );
            });
        },
        showTab: function(tab) {
            var modal = $('#newModal');
            tab = parseInt(tab, 10) || 1;
            Import.params.currentTab = tab;
            if (tab > Import.params.maxReachedTab) {
                Import.params.maxReachedTab = tab;
            }

            modal.find('[data-tab-pane]').addClass('d-none').removeClass('active show');
            modal.find('[data-tab-pane="' + tab + '"]').removeClass('d-none').addClass('active');
            modal.find('#isWizardTabs .nav-link').removeClass('active');
            modal.find('#isWizardTabs .nav-link[data-tab="' + tab + '"]').addClass('active');

            if (tab == 1) {
                modal.find('#btnPrevTab').addClass('d-none');
            } else {
                modal.find('#btnPrevTab').removeClass('d-none');
            }
            if (tab == 5) {
                modal.find('#btnNextTab').addClass('d-none');
                modal.find('#btnSaveImport').removeClass('d-none');
                Import.populateReview();
            } else {
                modal.find('#btnNextTab').removeClass('d-none');
                modal.find('#btnSaveImport').addClass('d-none');
            }
            if (tab == 2 && $.fn.selectpicker) {
                setTimeout(function() {
                    try {
                        var inVal = modal.find('#airportIn').val() || '143';
                        var outVal = modal.find('#airportOut').val() || '143';
                        modal.find('#airportIn').selectpicker('val', inVal);
                        modal.find('#airportOut').selectpicker('val', outVal);
                        modal.find('#airportIn, #airportOut').selectpicker('refresh');
                    } catch (err) {}
                }, 150);
            }
        },
        goNextTab: function(e) {
            if (e) {
                e.preventDefault();
            }
            var tab = parseInt(Import.params.currentTab, 10) || 1;
            if (!Import.validateTab(tab)) {
                return;
            }
            if (tab == 1 || tab == 2 || tab == 4) {
                Import.params.dataPost.personal = Import.collectPersonal();
                Import.params.dataPost.guarantee = Import.collectGuarantee();
            }
            Import.saveDraft();
            if (tab < 5) {
                Import.showTab(tab + 1);
            }
        },
        goPrevTab: function() {
            if (Import.params.currentTab > 1) {
                Import.showTab(Import.params.currentTab - 1);
                Import.saveDraft();
            }
        },
        toggleAccountSection: function() {
            var value = $('#newModal').find('input[name=returnGuarantee]:checked').val();
            if (value == '2') {
                $('#wizardAccountSection').removeClass('d-none');
            }
        },
        enabled: function(formName, value) {
            if (value) $('form[name="'+formName+'"]').find('[name^="search"], button').removeAttr('disabled');
            else $('form[name="'+formName+'"]').find('[name^="search"], button').attr('disabled', 'disabled');
        },
        myEncrypt: function(data) {
            var salt = 100*99*98*1*2*3;
            return salt * data;
        },
        renderItemTemp: function(data) {
            Import.params.bm = 0;
            Import.params.ppn = 0;
            Import.params.pph = 0;
            Import.params.ppnbm = 0;
            Import.params.fine = 0;
            Import.params.total = 0;
            
            var importTable = $('table[name="importTable"]'),
                template = importTable.find('[template="importTableBody"]'),
                rows = importTable.find('tbody').empty();
            $.each(data, function(index, value) {
                var row = template.clone().removeClass('d-none').removeAttr('template');
                row.attr('id', value.id);
                row.find('[view="imName"]').html(value.name);
                row.find('[view="imQty"]').html(value.quantity);
                var hscode = 'BM: ' + value.bm_tax + '%<br /> Ppn: ' + value.ppn_tax + '%<br /> Pph: ' + value.pph_tax + '%<br /> Ppnbm: ' + value.ppnbm_tax + '%<br /> Denda: ' +  value.fine_tax + '%';
                row.find('[view="imHscode"]').html(hscode);
                var pabeanValue = Math.round(value.kurs * value.cif);
                row.find('[view="imPabean"]').html(Import.setIdr(pabeanValue));
                row.find('[view="imFree"]').html(value.free_value + ' ' + value.free_currency);
                var bmValue = Math.ceil((((pabeanValue - value.free) * value.bm_tax) / 100) / 1000) * 1000;
                var ppnValue = Math.ceil((((pabeanValue - value.free + bmValue) * value.ppn_tax) / 100) / 1000) * 1000;
                var pphValue = Math.ceil((((pabeanValue - value.free + bmValue) * value.pph_tax) / 100) / 1000) * 1000;
                var ppnbmValue = Math.ceil((((pabeanValue - value.free + bmValue) * value.ppnbm_tax) / 100) / 1000) * 1000;
                var fineValue = (bmValue * value.fine_tax) / 100;
                var collect = 'BM: ' + Import.setIdr(bmValue) + '<br /> Ppn: ' + Import.setIdr(ppnValue) + '<br /> Pph: ' + Import.setIdr(pphValue) + '<br /> Ppnbm: ' + Import.setIdr(ppnbmValue) + '<br /> Denda: ' + Import.setIdr(fineValue);
                row.find('[view="imCollect"]').html(collect);
                row.find('[view="actionItemDelete"]').on('click', Import.removeItemTemp);

                row.appendTo(rows);

                Import.params.bm += bmValue;
                Import.params.ppn += ppnValue;
                Import.params.pph += pphValue;
                Import.params.ppnbm += ppnbmValue;
                Import.params.fine += fineValue;
                var totalValue = Import.params.bm + Import.params.ppn + Import.params.pph + Import.params.ppnbm + Import.params.fine;
                Import.params.total = totalValue;
            });

            var summaryTable = $('table[name="importSummaryTable"]');
            summaryTable.find('[view="summBM"]').html(Import.setIdr(Import.params.bm));
            summaryTable.find('[view="summPpn"]').html(Import.setIdr(Import.params.ppn));
            summaryTable.find('[view="summPph"]').html(Import.setIdr(Import.params.pph));
            summaryTable.find('[view="summPpnbm"]').html(Import.setIdr(Import.params.ppnbm));
            summaryTable.find('[view="summFine"]').html(Import.setIdr(Import.params.fine));
            summaryTable.find('[view="summTotal"]').html(Import.setIdr(Import.params.total));
            $('#newModal').find('input[name=guaranteeNominal]').val(Import.params.total);
        },
        removeItemTemp: function(e) {
            if (e) {
                e.preventDefault();
            }
            var row = $(this).closest('tr'),
            data = row.attr('id');
            var params = { params: {
                itemID: data, keyHeader: Import.params.keyHeaderPost
            }};

            $.ajax({
                url: '/import/delete_item_temp',
                type: 'post',
                dataType: 'json',
                data: JSON.stringify(params)
            }).done(function(result) {
                Import.renderItemTemp(result.data);
                Import.saveDraft();
            }).fail(function() {
                alert('terjadi kesalahan, coba lagi nanti..');
            });
        },
        deleteData: function() {
            var row = $(this).closest('tr'),
            data = row.attr('id'),
            docNumber = row.find('[view="docNumber"]').html(),
            modalName = $('#deleteModal');
    
            modalName.find('input[name="valasID"]').val(data);
            modalName.find('span[view="deleteModalDocNumber"]').html(docNumber);
            modalName.modal('show');
        },
        deleteDataServer: function() {
            var id = $('#deleteModal').find('input[name="valasID"]').val();
            var params = { params: id };
            $.ajax({
                url: '/import/delete',
                type: 'post',
                dataType: 'json',
                data: JSON.stringify(params)
            }).done(function(result) {
                if (result) {
                    $('#deleteModal').modal('hide');
                    Import.doSearch();
                }
            }).fail(function() {
                alert('terjadi kesalahan, coba lagi nanti..');
            }).always(function() {
                Import.enabled('searchValasForm', true);
            });
        },
        showAttachments: function(){
            var modal = $('#imageViewer');
            var template = $('[template="carousel-img"]')
            var body = $('.carousel-inner').empty();

            $.each(Import.params.attachments, function(index, value) {
                var row = template.clone().removeClass('d-none').removeAttr('template');
                if (index == 0) {
                    row.addClass('active');
                }
                row.find('img').attr('src', '/assets/custom/temps/' + value.name);
                row.appendTo(body);
            });

            // $('.carousel').carousel();
            modal.modal('show');
        },
        getDetail:function() {
            var row = $(this).closest('tr');
            var data = parseInt(row.attr('id'));
            
            var msg = {
                header_id: Import.myEncrypt(data)
            } 

            $.ajax({
                url: '/import/get_detail',
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

                    // items
                    var table = $('table[name="reviewItems"]');
                    var template = table.find('[template="reviewItemsBody"]');
                    var tbody = table.find('tbody').empty();
                    var theTotal = 0;
                    $.each(result.items, function(index, value) {
                        var theDesc = value.hs + "<br />" + value.bmIdr + ' + ' + value.ppnIdr + ' + ' + value.ppnbmIdr + ' + ' + value.pphIdr
                        + ' = Rp. ' + value.total;
                        var row = template.clone().removeClass('d-none').removeAttr('template');
                        row.attr('id', value.item);
                        row.find('[view="number"]').html(index + 1);
                        row.find('[view="qty"]').html(value.qty + ' ' + value.type);
                        row.find('[view="desc"]').html(value.name + ' ' + value.desc);
                        row.find('[view="itemValue"]').html(value.cif + ' ' + value.currency + ' / Rp. ' + value.itemValue);
                        row.find('[view="total"]').html(theDesc);
                        Import.params.attachments = value.attachments;
                        row.find('[view="itemFile"]').on('click', Import.showAttachments);
                        row.appendTo(tbody);
                        theTotal += parseInt(value.total.replace(/\./g, ''));
                    });
                    // console.log(theTotal);
                    var total = '<tr><td colspan="4">Total</td><td colspan="2">Rp. '+Import.setIdr(theTotal)+'</td></tr>';
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
                } else {
                    link = '/import/print_form_return/';
                }
            } 
            
            var msg = myEncrypt(data);
            var base_url = window.location.origin + link + msg;
            var win = window.open(base_url, '_blank');
            if (win) {
                //Browser has allowed it to be opened
                win.focus();
            } else {
                //Browser has blocked it
                alert('Please allow popups for this website');
            }
        },
        updateStatus:function() {
            var row = $(this).closest('tr'),
            data = parseInt(row.attr('id'));
            // set header
            Import.params.headerID = data;
            
            docNumber = row.find('[view="docNumber"]').html(),
            modalName = $('#statusModal');
    
            modalName.find('input[name="headerID"]').val(data);
            modalName.find('span[view="title"]').html(docNumber);
            modalName.modal('show');
        },
        renderData: function(data) {
            var result = $('[name="searchResult"]');
            var template = result.find('[template="searchResultRow"]');
            var rows = result.find('tbody').empty();
            var nav = result.find('[name="searchNav"]');
            
            $.each(data.rows, function(index, value) {
                var row = template.clone().removeClass('d-none').removeAttr('template');
                row.attr('id', value.import);
                // row.find('[view="number"]').html(index + 1);
                row.find('[view="docNumber"]').html(value.docNumber);
                row.find('[view="docDate"]').html(value.docDate);
                row.find('[view="name"]').html(value.name);
                row.find('[view="passport"]').html(value.passport);
                // row.find('[view="flightNumber"]').html(value.flightNumber);
                row.find('[view="bpjStatus"]').html(value.bpjStatus);
                row.find('[view="periode"]').html(value.periode);
                
                // set color
                var bpjStatusInt = parseInt(value.bpjStatus);
                if (bpjStatusInt <= 14) {
                    row.find('[view="bpjStatus"]').addClass('bg-danger');
                } else if (bpjStatusInt >= 15 && bpjStatusInt <= 60) {
                    row.find('[view="bpjStatus"]').addClass('bg-warning');
                } else {
                    row.find('[view="bpjStatus"]').addClass('bg-success');
                }
                // set status
                var status = '';
                if (value.status == '1') {
                    status = '<button class="btn btn-sm btn-info">Created</button>';
                } else if (value.status == '2') {
                    status = '<button class="btn btn-sm btn-danger">Open</button>';
                } else {
                    row.find('[view="actionConfirm"]').addClass('d-none');
                    status = '<button class="btn btn-sm btn-success">Closed</button>';
                }
    
                row.find('[view="status"]').html(status);
                row.find('[view="status"]').attr('value-status', value.status);
                row.find('[view="actionPrint"]').on('click', Import.printPage);
                row.find('[view="actionPrintIS"]').on('click', Import.printPage);
                row.find('[view="actionPrintReturn"]').on('click', Import.printPage);
                row.find('[view="actionDetail"]').on('click', Import.getDetail);
                row.find('[view="actionDelete"]').on('click', Import.deleteData);
                row.find('[view="actionConfirm"]').on('click', Import.updateStatus);
                row.appendTo(rows);
            });
            
            if (data.nav.page == 1) nav.find('[name="prev"]').attr('disabled', 'disabled');
            else nav.find('[name="prev"]').removeAttr('disabled');
            nav.find('[name="page"]').html(data.nav.page);
            if (data.nav.last) nav.find('[name="next"]').attr('disabled', 'disabled');
            else nav.find('[name="next"]').removeAttr('disabled');
            
            result.removeClass('d-none');
        },
        doSearch: function() {
            var data = {
                page: Import.params.page,
                dateFrom: Import.params.dateFrom,
                dateUntil: Import.params.dateUntil,
                docNumber: Import.params.docNumber
            };
    
            $.ajax({
                url: '/import/search',
                type: 'post',
                dataType: 'json',
                data: JSON.stringify(data)
            }).done(function(result) {
                if (result) {
                    // Academics.search.result(result.searchResult);
                    Import.renderData(result.searchResult);
                }
            }).fail(function() {
                alert('terjadi kesalahan, coba lagi nanti..');
            }).always(function() {
                Import.enabled('searchValasForm', true);
            });
        },
        removeItems: function() {
            var row = $(this).closest('tr');
            row.remove();
        },
        clearContent: function() {
        },
        createNew: function() {
            Import.params.dataPost.personal = Import.collectPersonal();
            Import.params.dataPost.guarantee = Import.collectGuarantee();
            $('#btnSaveImport').attr('disabled', 'disabled');
            var params = {
                params: Import.params.dataPost,
                keys: {
                    header: Import.params.keyHeaderPost,
                    item: Import.params.keyItemPost,
                }
            };

            $.ajax({
                url: '/import/create_new',
                type: 'post',
                dataType: 'json',
                data: JSON.stringify(params)
            }).done(function(result) {
                if (result) {
                    alert('Data berhasil disimpan..');
                    Import.params.confirmSave = 0;
                    Import.params.keyHeaderPost = '';
                    $('#newModal').modal('hide');
                    Import.doSearch();
                    Import.resetForm();
                }
            }).fail(function() {
                alert('terjadi kesalahan, coba lagi nanti..');
            }).always(function() {
                $('#btnSaveImport').removeAttr('disabled');
            });
        },
        uploadItems: function(data) {
            var formData =  new FormData();
	        formData.append('file', data);
            formData.append('item_key', Import.params.keyItemPost);
            $.ajax({
                url: '/import/upload_items',
                dataType: 'json', 
                cache: false,
                contentType: false,
                processData: false,
                data: formData,
                type: 'post'
            }).done(function (result) {
                if (!result.status) {
                    alert(result.error_msg);
                }
            }).always(function() {
                // $('form[name="addItemForm"]').find('button').removeAttr('disabled');
            });
        },
        verifyUpload: function(fileData) {
            // console.log(fileData.size);
            if (fileData.size > 0) {
                if (fileData.size > 2000000) {
                    alert('Ukuran Max. file 2Mb');
                } else {
                    Import.uploadItems(fileData);
                }
            }
        },
        uploadImport: function(data) {
            $('#pleaseWaitDialog').modal('show');
            
            var formData =  new FormData();
	        formData.append('file', data);
            formData.append('header_id', Import.params.headerID);
            $.ajax({
                url: '/import/upload_import',
                dataType: 'json', 
                cache: false,
                contentType: false,
                processData: false,
                data: formData,
                type: 'post'
            }).done(function (result) {
                    
            }).always(function() {
                $('#pleaseWaitDialog').modal('hide');
                $('body').removeClass('modal-open');
                $(".modal-backdrop").remove();
                $('#pleaseWaitDialog').removeClass('show');
                $('#pleaseWaitDialog').removeAttr('style');
            });
        },
        verifyAttach: function(fileData) {
            // console.log(fileData.size);
            if (fileData.size > 0) {
                if (fileData.size > 2000000) {
                    alert('Ukuran Max. file 2Mb');
                } else {
                    Import.uploadImport(fileData);
                }
            }
        },
        generateKey: function() {
            return Math.floor(Math.random() * 26) + Date.now();
        },
        updateHeader:function(params){
            $.ajax({
                url: '/import/update_header',
                type: 'post',
                dataType: 'json',
                data: JSON.stringify(params)
            }).done(function(result) {
                alert('data berhasil disimpan');
                $('#statusModal').modal('hide');
                Import.doSearch();
            });
        },
        init: function() {
            /**
             * first init
             */
            Import.doSearch();

            setInterval(function() {
                if ($('#newModal').hasClass('show')) {
                    Import.saveDraft();
                }
            }, 40000);

            $('#btnNextTab').on('click', Import.goNextTab);
            $('#btnPrevTab').on('click', Import.goPrevTab);
            $('#btnSaveImport').on('click', function() {
                var tabs = [1, 2, 3, 4];
                for (var i = 0; i < tabs.length; i++) {
                    if (!Import.validateTab(tabs[i])) {
                        Import.showTab(tabs[i]);
                        return;
                    }
                }
                Import.createNew();
            });

            $('#isWizardTabs .nav-link').on('click', function(e) {
                e.preventDefault();
                var target = parseInt($(this).attr('data-tab'), 10);
                var current = parseInt(Import.params.currentTab, 10) || 1;
                if (target == current) {
                    return;
                }
                if (target < current) {
                    Import.showTab(target);
                    Import.saveDraft();
                    return;
                }
                if (target > current + 1 && target > Import.params.maxReachedTab) {
                    alert('Lengkapi tab sebelumnya terlebih dahulu');
                    return;
                }
                if (!Import.validateTab(current)) {
                    return;
                }
                Import.showTab(target);
                Import.saveDraft();
            });

            $('#newModal').find('input[name=identityType]').on('change', function() {
                var labels = { '1': 'Nomor NPWP', '2': 'Nomor KTP / NIK', '3': 'Nomor Paspor' };
                $('#identityLabel').text(labels[$(this).val()] || 'Nomor Identitas');
            });

            $('#btnValidateEmail').on('click', Import.validateEmail);
            $('#pemberitahuEmail').on('input change', function() {
                var email = $.trim($(this).val());
                if (email !== Import.params.emailValidatedValue) {
                    Import.params.emailValidated = false;
                    Import.setEmailMsg('', false);
                }
            });

            $('#newModal').find('input[name=returnGuarantee]').on('change', Import.toggleAccountSection);

            $('#addItemModal').on('shown.bs.modal', function() {
                $(this).css('z-index', 1060);
                $('.modal-backdrop').last().css('z-index', 1055);
            });
            $('#addItemModal').on('hidden.bs.modal', function() {
                if ($('#newModal').hasClass('show')) {
                    $('body').addClass('modal-open');
                }
            });

            $('form[name="addItemForm"]').on('submit', function() {
                // mapping data
                var itemName = $(this).find('[name="itemName"]').val(),
                    itemTotal = $(this).find('[name="itemTotal"]').val(), //total as qty
                    itemCategory = $(this).find('select[name="itemCom"]').val(),
                    itemCategoryText = $(this).find('select[name="itemCom"] option:selected').text(),
                    itemPackage = $(this).find('select[name="itemPackage"]').val(),
                    itemPackageText = $('select[name=itemPackage] option:selected').text(),
                    itemBruto = $(this).find('[name="itemBruto"]').val(),
                    itemCollect = $(this).find('[name="itemTotalCollect"]').val(),
                    itemCurrency = $(this).find('select[name="itemCurrency"]').val(),
                    itemCurrencyText = $('select[name=itemCurrency] option:selected').text(),
                    itemDescription = $(this).find('textarea[name=itemSpec]' ).val(),

                    fob = $(this).find('[name="itemFob"]').val(),
                    freight = $(this).find('[name="itemFreight"]').val(),
                    insurance = $(this).find('[name="itemInsurance"]').val(),

                    cif = $(this).find('[name="itemCif"]').val(),
                    ppn = $(this).find('[name="itemPpn"]').val(),
                    pph = $(this).find('[name="itemPph"]').val(),
                    ppnbm = $(this).find('[name="itemPpnbm"]').val(),
                    fine = $(this).find('[name="itemFine"]').val();
                    posCode = $(this).find('[name="itemPosCode"]').val();
                     posDesc = $(this).find('[name="itemPosDesc"]').val();

                var params = {
                    name: itemName, quantity : itemTotal, package: itemPackage, category: itemCategory, bruto: itemBruto,
                    currency: itemCurrencyText, kurs: itemCurrency, description: itemDescription,
                    fob: fob, freight: freight, insurance: insurance,
                    cif: cif, pabeanIn: 10, ppn: ppn, pph: pph, ppnbm: ppnbm, fine: fine,
                    freeIDR: 0, free_value: 0, free_currency: '',
                    keyHeader: Import.params.keyHeaderPost, keyItem: Import.params.keyItemPost,
                    posCode: posCode, posDesc: posDesc
                };
                // validate no save if no attachment choosed

                var fileData = $(this).find('#itemAttach1').prop('files')[0],
                    fileData2 = $(this).find('#itemAttach2').prop('files')[0],
                    fileData3 = $(this).find('#itemAttach3').prop('files')[0];
                
                if (!fileData && !fileData2 && !fileData3) {
                    alert('Lampiran harus diisi minimal 1 (Satu)');
                    return false;
                }

                $.ajax({
                    url: '/import/save_item_temp',
                    type: 'post',
                    dataType: 'json',
                    data: JSON.stringify(params)
                }).done(function(result) {
                    if (result) {
                        // save image
                        var attachmentNumber = 1
                        var myForm = $('form[name="addItemForm"]');
                        myForm.find('button').attr('disabled', 'disabled');
	                    $('#pleaseWaitDialog').modal('show');

                        var fileData = myForm.find('#itemAttach1').prop('files')[0],
                            fileData2 = myForm.find('#itemAttach2').prop('files')[0],
                            fileData3 = myForm.find('#itemAttach3').prop('files')[0];
                        
                        if (fileData) {
                            Import.verifyUpload(fileData);
                        }
                        if (fileData2) {
                            Import.verifyUpload(fileData2);
                        }
                        if (fileData3) {
                            Import.verifyUpload(fileData3);
                        }

                        // get data from server then render it
                        Import.renderItemTemp(result.data);
                        Import.saveDraft();

                        $('#addItemModal').modal('hide');
                    }
                }).fail(function() {
                    alert('terjadi kesalahan, coba lagi nanti..');
                }).always(function() {
                    $('#pleaseWaitDialog').modal('hide');
                    $('#pleaseWaitDialog').removeClass('show');
                    $('#pleaseWaitDialog').removeAttr('style');
                    $('form[name="addItemForm"]').find('button').removeAttr('disabled');
                    if ($('#newModal').hasClass('show')) {
                        $('body').addClass('modal-open');
                    }
                });
                return false;
            });

            $('#btnAddItem').on('click', function() {
                var generator = Import.generateKey();
                Import.params.keyItemPost = generator;
                var itemForm = $('form[name="addItemForm"]');
                itemForm.find('input[type=text], textarea, input[type=file]').val('');
                itemForm.find('#itemFob, #itemFreight, #itemInsurance, #itemCif, #itemKurs, #itemValue').val('0');
                itemForm.find('#itemPabeanIn').val('10');
                itemForm.find('#itemPabeanInIDR, #itemPpn, #itemPpnIDR, #itemPphIDR, #itemPpnbm, #itemPpnbmIDR, #itemFine, #itemFineIDR').val('0');
                itemForm.find('#itemPph').val('0');
                itemForm.find('#itemTotalCollect, #itemPosCode, #itemPosDesc').val('');
                itemForm.find('.selectpicker').selectpicker('val', '');
                $('#addItemModal').modal('show');
                Import.recalcItem();
            });

            $('.bc-date').datepicker({
                todayHighlight: true,
                autoclose: true,
                orientation: "bottom left",
                format: 'yyyy-mm-dd'
            });

            $('#add_valas').on('click', function() {
                Import.openCreateModal();
            });

            $('#newModal').on('hidden.bs.modal', function() {
                Import.saveDraft();
            });

            $('form[name="searchValasForm"]').on('submit', function() {
                Import.enabled($(this).attr('name'), false);
    
                var dateFrom = $(this).find('[name="dateFrom"]').val();
                var dateUntil = $(this).find('[name="dateUntil"]').val();
                var docNumber = $(this).find('[name="docNumber"]').val();
    
                Import.params.dateFrom = dateFrom;
                Import.params.dateUntil = dateUntil;
                Import.params.docNumber = docNumber;
    
                Import.doSearch();
    
                return false;
            });
    
            $('[name="next"]').on('click', function(){
                Import.params.page = Import.params.page + 1;
                Import.doSearch();
            });
            $('[name="prev"]').on('click', function(){
                Import.params.page = Import.params.page - 1;
                Import.doSearch();
            });
            
            $('button[name="confirmDelete"]').on('click', function() {
                Import.deleteDataServer();
            });

            // set kurs
            $('#itemCurrency').on('change', function() {
                $('#itemKurs').val($(this).val() || 0);
                Import.recalcItem();
            });

            /*$('#itemCode').bind('input propertychange', function() {
                if(this.value.length > 2){
                    $.getJSON("https://api-patops.bcsoetta.org/hs?number=50&q=" + $(this).val(),
                    function(data){
                        $.each(data.data, function(i,val){
                            console.log(val.bm_tarif);
                        });
                    });
                }
            });*/
            $('#itemCode').on('loaded.bs.select', function (e, clickedIndex, isSelected, previousValue) { 
                $(this).closest('.bootstrap-select').find('.bs-searchbox').find('input[type="search"]').on('keyup', function(){
                    $(this).closest('.bootstrap-select').find(".selectpicker option").remove();
                    $('#itemCode').selectpicker('refresh'); 
                    if(this.value.length > 2){
                        $.getJSON("https://api-patops.bcsoetta.org/hs?number=50&q=" + $(this).val(),
                        function(data){
                            // console.log(data);
                            // add first option in select
                            $('#itemCode').append('<option bm_tarif="" ppn_tarif="" ppnbm_tarif="" value=""></option>');
                            $.each(data.data, function(i,val){
                                $('#itemCode').append('<option bm_tarif="'+val.bm_tarif+'" ppn_tarif="'+val.ppn_tarif+'" ppnbm_tarif="'+val.ppnbm_tarif+'" value="'+val.id+'" raw_code="'+val.raw_code+'" uraian="'+val.uraian+'">'+val.raw_code+ ' - ' + val.uraian + ' - ' + val.jenis_tarif +'</option>');
                            });
                            $('#itemCode').selectpicker('refresh'); 
                        });        
                    }
                });
                
            });

            $('#itemCode').on('changed.bs.select', function (e, clickedIndex, isSelected, previousValue) { 
                var pos_code = $('#itemCode option:selected').attr('raw_code');
                var pos_desc = $('#itemCode option:selected').attr('uraian');
                $('#itemPosCode').val(pos_code);
                $('#itemPosDesc').val(pos_desc);

                var bm = $('#itemCode option:selected').attr('bm_tarif');
                var ppn = $('#itemCode option:selected').attr('ppn_tarif');
                var ppnbm = $('#itemCode option:selected').attr('ppnbm_tarif');

                $('#itemPabeanIn').val('10');
                $('#itemPpn').val(ppn || 0);
                $('#itemPpnbm').val(ppnbm || 0);
                Import.recalcItem();
            });

            $('#itemPpn, #itemPph, #itemFine, #itemPpnbm').on('keyup change input', function(){
                Import.recalcPungutan();
            });

            $('#itemFob, #itemFreight, #itemInsurance, #itemKurs').on('keyup change input', function() {
                Import.recalcItem();
            });

            $('#addItemModal').on('focus', '.is-zero-clear', function() {
                var val = $.trim($(this).val());
                if (val === '0' || val === '0.0' || val === '0,0') {
                    $(this).val('');
                }
            }).on('blur', '.is-zero-clear', function() {
                if ($.trim($(this).val()) === '') {
                    $(this).val('0');
                    Import.recalcItem();
                }
            });

            $('form[name="statusForm"]').on('submit', function(){
                var tab1 = $('#kt_tab_pane_1_4').hasClass('active');
                var tab2 = $('#kt_tab_pane_2_4').hasClass('active');
                var tab3 = $('#kt_tab_pane_3_4').hasClass('active');
                // tab sesuai = 1
                if (tab1) {
                    var notes = $(this).find('textarea[name="reNotes"]').val(),
                        office = ($(this).find('select[name="reOffice"]').val()) ? $(this).find('select[name="reOffice"]').val() : 143,
                        date = $(this).find('input[name="reDate"]').val(),
                        name = $(this).find('input[name="reName"]').val(),
                        docNumber = $(this).find('input[name="reDocNumber"]').val(),
                        tabValue = '1';

                    var fileData = $(this).find('#reAttach1').prop('files')[0],
                        fileData2 = $(this).find('#reAttach2').prop('files')[0],
                        fileData3 = $(this).find('#reAttach3').prop('files')[0];
                        
                    if (fileData) {
                        Import.verifyAttach(fileData);
                    }
                    if (fileData2) {
                        Import.verifyAttach(fileData2);
                    }
                    if (fileData3) {
                        Import.verifyAttach(fileData3);
                    }

                    var params = { key: tabValue, notes: notes, name: name, office: office, date: date, number: docNumber, header: Import.params.headerID };
                }

                if (tab2) {
                    var notes = $(this).find('textarea[name=reNotesNOK]').val();
                    tabValue = '0';
                    // save images
                    var fileData = $(this).find('#reAttachNOK1').prop('files')[0],
                        fileData2 = $(this).find('#reAttachNOK2').prop('files')[0],
                        fileData3 = $(this).find('#reAttachNOK3').prop('files')[0];
                        
                    if (fileData) {
                        Import.verifyAttach(fileData);
                    }
                    if (fileData2) {
                        Import.verifyAttach(fileData2);
                    }
                    if (fileData3) {
                        Import.verifyAttach(fileData3);
                    }
                    
                    var params = { key: tabValue, notes: notes, header: Import.params.headerID };
                }

                if (tab3) {
                    var notes = $(this).find('textarea[name="reNotesLJT"]').val(),
                        date = $(this).find('input[name="reDateLTJ"]').val(),
                        docNumber = $(this).find('input[name="reDocNumberLJT"]').val(),
                        tabValue = '2';

                    var fileData = $(this).find('#reAttachLJT1').prop('files')[0],
                        fileData2 = $(this).find('#reAttachLJT2').prop('files')[0],
                        fileData3 = $(this).find('#reAttachLJT3').prop('files')[0];
                        
                    if (fileData) {
                        Import.verifyAttach(fileData);
                    }
                    if (fileData2) {
                        Import.verifyAttach(fileData2);
                    }
                    if (fileData3) {
                        Import.verifyAttach(fileData3);
                    }

                    var params = { key: tabValue, notes: notes, date: date, number: docNumber, header: Import.params.headerID };
                }

                // update data header
                Import.updateHeader(params);
                // console.log(params);
                
                return false;
            });

            $('#invDateOut').on('change', function() {
                 // To set two dates to two variables
                var date1 = new Date();
                var date2 = new Date($(this).val());
                
                // To calculate the time difference of two dates
                var Difference_In_Time = date2.getTime() - date1.getTime();

                // To calculate the no. of days between two dates
                var Difference_In_Days = Difference_In_Time / (1000 * 3600 * 24);
                var days = Math.ceil(Difference_In_Days);

                if (days > 90) {
                    alert('Jangka waktu tidak boleh lebih dari 90 hari');
                } else {
                    $('#periode').val(days);
                }
            });
        } //end init
    };
    
    Import.init();
    
    })(jQuery);