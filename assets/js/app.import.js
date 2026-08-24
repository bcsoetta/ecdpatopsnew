(function($) {
    var Import = {
        params: {
            page: 1,
            dateFrom: '',
            dateUntil: '',
            docNumber: '',
            confirmSave: 0,
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
            total: 0
        },
        setIdr: function(value) {
            var output = value.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.");
            return output;
        },
        unsetIdr: function(value) {
            newValue = value.split('.').join('');
            return newValue;
        },
        resetForm: function() {
            $(this).prop('checked', false);
            var newForm = $('form[name="newForm"]');
            newForm.find('input[type=text], textarea').val('');
            // newForm.find('[name="identityType"], [name="returnGuarantee"]').prop('checked', false);
            $('table[name="importTable"]').find('tbody').empty();
            var guaranteeForm = $('form[name="guaranteeForm"]');
            guaranteeForm.find('input[type=text], textarea').val('');
            // guaranteeForm.find('[name="guaranteeType"]').prop('checked', false);

            var summaryTable = $('table[name="importSummaryTable"]');
            summaryTable.find('[view="summBM"]').html(Import.setIdr(Import.params.bm));
            summaryTable.find('[view="summPpn"]').html(Import.setIdr(Import.params.ppn));
            summaryTable.find('[view="summPph"]').html(Import.setIdr(Import.params.pph));
            summaryTable.find('[view="summPpnbm"]').html(Import.setIdr(Import.params.ppnbm));
            summaryTable.find('[view="summFine"]').html(Import.setIdr(Import.params.fine));
            summaryTable.find('[view="summTotal"]').html(Import.setIdr(Import.params.total));
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
            $('form[name="guaranteeForm"]').find('input[name=guaranteeNominal]').val(Import.params.total);
        },
        removeItemTemp: function() {
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
            Import.enabled('guaranteeForm', false);
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
                    // action after save
                    alert('Data berhasil disimpan..');
                    Import.params.confirmSave = 0;
                    $('#guaranteeModal').modal('hide');
                    Import.params.confirmSave = 0;
                    Import.doSearch();
                    // clear all content
                    Import.clearContent();
                }
            }).fail(function() {
                alert('terjadi kesalahan, coba lagi nanti..');
            }).always(function() {
                Import.enabled('guaranteeForm', true);
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

            $('form[name="guaranteeForm"]').on('submit', function() {
                // $(this).find('input[name=guaranteeNominal]' ).val(Import.params.total);
            
                // mapping data
                var guarantee = {
                    guaranteeType: $(this).find('input[name=guaranteeType]:checked').val(),
                    guaranteeName: $(this).find('input[name=guaranteeName]').val(),
                    guaranteeAddress: $(this).find('textarea[name=guaranteeAddress]' ).val(),
                    guaranteeNominal: $(this).find('input[name=guaranteeNominal]').val(),
                    source: $(this).find('input[name=source]').val(),
                    sourceNumber: $(this).find('input[name=sourceNumber]').val(),
                    sourceDate: $(this).find('input[name=sourceDate]').val(),
                    treasurerName: $(this).find('input[name=treasurerName]').val(),
                    treasurerNip: $(this).find('input[name=treasurerNip]').val()
                };
                // console.log(guarantee); return false;
                Import.params.dataPost.guarantee = guarantee;
                // confirm first then create
                if (Import.params.confirmSave == 0) {
                    $('#confirmModal').modal('show');  
                } else {
                    Import.createNew();
                }
                return false;
            });

            $('button[name="confirmYes"]').on('click', function() {
                // reset value
                Import.params.bm = 0;
                Import.params.ppn = 0;
                Import.params.pph = 0;
                Import.params.ppnbm = 0;
                Import.params.total = 0;
                Import.params.fine = 0;

                // show previous page
                $('#confirmModal').modal('hide');
                $('#guaranteeModal').modal('hide');
                $('#newModal').modal('show');
                
                Import.params.confirmSave = 1;
            });

            $('form[name="newForm"]').on('submit', function() {
                // save data to params
                var personal = {
                    identityType: $(this).find('input[name=identityType]:checked' ).val(),
                    name : $(this).find('input[name=name]' ).val(),
                    address : $(this).find('textarea[name=address]').val(),
                    identity : $(this).find('input[name=identity]').val(),
                    sponsName : $(this).find('input[name=sponsName]').val(),
                    sponsNik : $(this).find('input[name=sponsNik]').val(),
                    sponsLocation : $(this).find('input[name=sponsLocation]' ).val(),
                    sponsReason : $(this).find('input[name=sponsReason]').val(),
                    sponsAddress : $(this).find('textarea[name=sponsAddress]').val(),
                    sponsPhone : $(this).find('input[name=sponsPhone]').val(),
                    returnGuarantee : $(this).find('input[name=returnGuarantee]:checked').val(),
                    airportIn : ($(this).find('select[name=airportIn]').val()) ? $(this).find('select[name=airportIn]').val() : 143,
                    invDate : $(this).find('input[name=invDate]').val(),
                    invNumber : $(this).find('input[name=invNumber]').val(),
                    carrierName : $(this).find('input[name=carrierName]').val(),
                    airportOut : ($(this).find('select[name=airportOut]').val()) ? $(this).find('select[name=airportOut]').val() : 143,
                    invDateOut : $(this).find('input[name=invDateOut]').val(),
                    periode : $(this).find('input[name=periode]' ).val(),
                    accountNumber : $(this).find('input[name=accountNumber]' ).val(),
                    accountName : $(this).find('input[name=accountName]' ).val(),
                    accountBank : $(this).find('input[name=accountBank]' ).val(),
                }

                Import.params.dataPost.personal = personal;

                // console.log(Import.params.dataPost);
                $('#newModal').modal('hide');
                $('#guaranteeModal').modal('show');
                return false;
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
                    pabeanIn = $(this).find('[name="itemPabeanIn"]').val(),
                    ppn = $(this).find('[name="itemPpn"]').val(),
                    pph = $(this).find('[name="itemPph"]').val(),
                    ppnbm = $(this).find('[name="itemPpnbm"]').val(),
                    fine = $(this).find('[name="itemFine"]').val(),
                    free = $(this).find('[name="itemFree"]').val(),
                    freeCurrency = $(this).find('[name="itemFreeCurrency"]').val(),
                    freeCurrencyText = $(this).find('[name="itemFreeCurrency"] option:selected').text(),
                    freeIDR = Import.unsetIdr($(this).find('[name="itemFreeIDR"]').val());
                    // console.log(itemPackage);
                    // return false;
                    /**
                     * new items that must be send to server
                     */
                     posCode = $(this).find('[name="itemPosCode"]').val();
                     posDesc = $(this).find('[name="itemPosDesc"]').val();

                var params = {
                    name: itemName, quantity : itemTotal, package: itemPackage, category: itemCategory, bruto: itemBruto,
                    currency: itemCurrencyText, kurs: itemCurrency, description: itemDescription,
                    fob: fob, freight: freight, insurance: insurance,
                    cif: cif, pabeanIn: pabeanIn, ppn: ppn, pph: pph, ppnbm: ppnbm, fine: fine,
                    freeIDR: freeIDR, free_value: free, free_currency: freeCurrencyText,
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

                        $('#addItemModal').modal('hide');
                    }
                }).fail(function() {
                    alert('terjadi kesalahan, coba lagi nanti..');
                }).always(function() {
                    $('#pleaseWaitDialog').modal('hide');
                    $('body').removeClass('modal-open');
                    $(".modal-backdrop").remove();
                    $('#pleaseWaitDialog').removeClass('show');
                    $('#pleaseWaitDialog').removeAttr('style');
                    $('form[name="addItemForm"]').find('button').removeAttr('disabled');
                });
                return false;
            });

            $('#btnAddItem').on('click', function() {
                var generator = Import.generateKey();
                Import.params.keyItemPost = generator;

                $('#addItemModal').modal('show');
            });

            $('.bc-date').datepicker({
                todayHighlight: true,
                orientation: "bottom left",
                format: 'yyyy-mm-dd'
            });

            $('#add_valas').on('click', function() {
                // reset
                var dataPost = {
                    personal: {},
                    items: [],
                    guarantee: {}
                };
                Import.params.dataPost = dataPost;
                
                // generate key
                var generator = Import.generateKey();
                Import.params.keyHeaderPost = generator;
                // console.log(Import.params.keyPost);
                Import.resetForm();
                $('#newModal').modal('show');
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
            
            $('button[name="confirmYes"]').on('click', function() {
                // show previous page
                $('#confirmModal').modal('hide');
                Import.params.confirmSave = 1;
            });
    
            // pagination
            //nav function
            $('[name="next"]').on('click', function(){
                Import.params.page = Import.params.page + 1;
                Import.doSearch();
            });
            $('[name="prev"]').on('click', function(){
                Import.params.page = Import.params.page - 1;
                Import.doSearch();
            });
            
            // back function
            $('form[name="guaranteeForm"]').find('#prepPage').on('click', function() {
                $('#guaranteeModal').modal('hide');
                $('#newModal').modal('show');
            });
            
            $('button[name="confirmDelete"]').on('click', function() {
                Import.deleteDataServer();
            });

            // set kurs
            $('#itemCurrency').on('change', function() {
                // set kurs value
                $('#itemKurs').val($(this).val());
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
                /**
                 * get code and name
                 */
                var pos_code = $('#itemCode option:selected').attr('raw_code');
                var pos_desc = $('#itemCode option:selected').attr('uraian');
                /**
                 * set code to hidden input
                 */
                 $('#itemPosCode').val(pos_code);
                 $('#itemPosDesc').val(pos_desc);
                 
                // pabean value = nilai pabean - pembebasan
                var bm = $('#itemCode option:selected').attr('bm_tarif'),
                ppn = $('#itemCode option:selected').attr('ppn_tarif'),
                ppnbm = $('#itemCode option:selected').attr('ppnbm_tarif'),
                pabean_value = parseFloat(Import.unsetIdr($('#itemValue').val()));
                // pph = parseFloat($('#itemPph').val());
                
                // set label from server
                $('#itemPabeanIn').val(bm);
                $('#itemPpn').val(ppn);
                // convert idr
                var roundUpBea = Math.ceil(((bm * parseInt(pabean_value)) / 100)/1000);
                var beaIDR = roundUpBea * 1000;
                $('#itemPabeanInIDR').val(Import.setIdr(beaIDR));
                var roundUpPpn = Math.ceil((((pabean_value + beaIDR) * ppn) / 100) / 1000);
                var ppnIDR = roundUpPpn * 1000;
                // console.log(pabean_value + beaIDR);
                $('#itemPpnIDR').val(Import.setIdr(ppnIDR));
                var roundUpPpnbm = Math.ceil((((pabean_value + beaIDR) * ppnbm) / 100) / 1000);
                var ppnbmIDR = roundUpPpnbm * 1000;
                $('#itemPpnbmIDR').val(Import.setIdr(ppnbmIDR));
                
                var totalCollect = beaIDR + ppnIDR + ppnbmIDR;
                $('#itemTotalCollect').val(Import.setIdr(totalCollect));
            });

            $('#itemPph, #itemFine, #itemPpnbm').on('keyup', function(){
                var bm = parseInt(Import.unsetIdr($('#itemPabeanInIDR').val())),
                ppn = parseInt(Import.unsetIdr($('#itemPpnIDR').val())),
                ppnbm = parseFloat($('#itemPpnbm').val()),
                pabean_value = parseFloat(Import.unsetIdr($('#itemValue').val())),
                pph = parseFloat($('#itemPph').val()),
                fine = parseFloat($('#itemFine').val());
                
                var roundUpPph = Math.ceil((((pabean_value + bm) * pph) / 100) / 1000);
                var pphIDR = roundUpPph * 1000;
                $('#itemPphIDR').val(Import.setIdr(pphIDR));

                var roundUpPpnbm = Math.ceil((((pabean_value + bm) * ppnbm) / 100) / 1000);
                var ppnbmIDR = roundUpPpnbm * 1000;
                $('#itemPpnbmIDR').val(Import.setIdr(ppnbmIDR));

                var fineValue = ((bm * fine) / 100); //+ bm;
                $('#itemFineIDR').val(Import.setIdr(fineValue));
                
                var totalCollect = bm + ppn + ppnbm + pphIDR + fineValue;
                $('#itemTotalCollect').val(Import.setIdr(totalCollect));
            });

            // set cif automaticly
            // cif = fob + freight + insurance
            $('#itemFob, #itemFreight, #itemInsurance, #itemFree').on('keyup', function() {
                var fob = parseInt($('#itemFob').val()),
                freight = parseInt($('#itemFreight').val()),
                insurance = parseInt($('#itemInsurance').val()),
                kurs = parseFloat($('#itemKurs').val()),
                free = parseInt($('#itemFree').val()),
                // currency by selector not attr anymoe
                // usd = parseFloat($('#itemFree').attr('value-kurs')),
                usd = parseFloat($('#itemFreeCurrency').val()),
                freeIDR = Math.round(free * usd);

                var cif = fob + freight + insurance;
                $('#itemCif').val(cif);
                // set nilai pabean
                // cif * kurs
                // new formula (cif * kurs) - freeidr
                // set item freeidr
                $('#itemFreeIDR').val(Import.setIdr(freeIDR));
                var pabean_value = Math.round((cif * kurs) - freeIDR);
                $('#itemValue').val(Import.setIdr(pabean_value));
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