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
        renderData: function(data) {
            var result = $('[name="searchResult"]');
            var template = result.find('[template="searchResultRow"]');
            var rows = result.find('tbody').empty();
            var nav = result.find('[name="searchNav"]');
            
            $.each(data.rows, function(index, value) {
                var row = template.clone().removeClass('d-none').removeAttr('template');
                row.attr('id', value.import);
                row.find('[view="number"]').html(index + 1);
                row.find('[view="docNumber"]').html(value.docNumber);
                row.find('[view="docDate"]').html(value.docDate);
                row.find('[view="name"]').html(value.name);
                row.find('[view="passport"]').html(value.passport);
                row.find('[view="flightNumber"]').html(value.flightNumber);
                row.find('[view="bpjStatus"]').html(value.bpjStatus);
                row.find('[view="periode"]').html(value.periode);
                
                // set color
                var bpjStatusInt = parseInt(value.bpjStatus);
                if (bpjStatusInt <= 14) {
                    row.addClass('bg-danger');
                } else if (bpjStatusInt >= 15 && bpjStatusInt <= 60) {
                    row.addClass('bg-warning');
                } else {
                    row.addClass('bg-success');
                }
                // set status
                var status = '';
                if (value.status == '1') {
                    status = '<button class="btn btn-sm btn-info">Created</button>';
                } else if (value.status == '2') {
                    status = '<button class="btn btn-sm btn-danger">Open</button>';
                } else {
                    status = '<button class="btn btn-sm btn-success">Closed</button>';
                }
    
                row.find('[view="status"]').html(status);
                // row.find('[view="actionDeparture"]').on('click', Import.printPageDeparture);
                // row.find('[view="actionArrival"]').on('click', Import.printPageArrival);
                row.find('[view="actionDelete"]').on('click', Import.deleteData);
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
                params: Import.params.dataPost
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

            $.ajax({
                url: '/import/upload_items',
                dataType: 'json', 
                cache: false,
                contentType: false,
                processData: false,
                data: formData,
                type: 'post'
            }).done(function (result) {
                    
            }).always(function() {
                $('form[name="addItemForm"]').find('button').removeAttr('disabled');
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
        init: function() {
            /**
             * first init
             */
            Import.doSearch();

            $('form[name="guaranteeForm"]').on('submit', function() {
                // mapping data
                var guarantee = {
                    guaranteeType: $(this).find('input[name=guaranteeType]:checked' ).val(),
                    guaranteeName: $(this).find('input[name=guaranteeName]' ).val(),
                    guaranteeAddress: $(this).find('textarea[name=guaranteeAddress]' ).val(),
                    guaranteeNominal: $(this).find('input[name=guaranteeNominal]' ).val()
                };

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
                    address : $(this).find('textarea[name=address]' ).val(),
                    identity : $(this).find('input[name=identity]' ).val(),
                    sponsName : $(this).find('input[name=sponsName]' ).val(),
                    sponsNik : $(this).find('input[name=sponsNik]' ).val(),
                    sponsLocation : $(this).find('input[name=sponsLocation]' ).val(),
                    sponsReason : $(this).find('input[name=sponsReason]' ).val(),
                    sponsAddress : $(this).find('textarea[name=sponsAddress]' ).val(),
                    sponsPhone : $(this).find('input[name=sponsPhone]' ).val(),
                    returnGuarantee : $(this).find('input[name=returnGuarantee]:checked' ).val(),
                    airportIn : $(this).find('select[name=airportIn]' ).val(),
                    invDate : $(this).find('input[name=invDate]' ).val(),
                    invNumber : $(this).find('input[name=invNumber]' ).val(),
                    carrierName : $(this).find('input[name=carrierName]' ).val(),
                    airportOut : $(this).find('select[name=airportOut]' ).val(),
                    invDateOut : $(this).find('input[name=invDateOut]' ).val(),
                    periode : $(this).find('input[name=periode]' ).val(),
                    accountNumber : $(this).find('input[name=accountNumber]' ).val(),
                    accountName : $(this).find('input[name=accountName]' ).val(),
                    accountBank : $(this).find('input[name=accountBank]' ).val(),
                }

                Import.params.dataPost.personal = personal;

                // mapping data items
                var theTable = $('table[name="importTable"]');
                var rows = theTable.find('tr');

                rows.each(function (i, el) {
                    var $tds = $(this).find('td'),
                        name = $tds.eq(0).text(),
                        qty = $tds.eq(1).text(),
                        pck = $tds.eq(2).attr('im-value'),
                        bruto = $tds.eq(3).text();

                    if (name != '' || qty != '') {
                        var dataItem = {
                            name: name, qty: qty, pck: pck, bruto: bruto
                        }

                        Import.params.dataPost.items.push(dataItem);
                    }   
                });
                // console.log(Import.params.dataPost);
                $('#newModal').modal('hide');
                $('#guaranteeModal').modal('show');
                return false;
            });

            $('form[name="addItemForm"]').on('submit', function() {
                $(this).find('button').attr('disabled', 'disabled');
	            $('#pleaseWaitDialog').modal('show');
                // mapping data
                var itemName = $(this).find('[name="itemName"]').val(),
                    itemTotal = $(this).find('[name="itemTotal"]').val(), //total as qty
                    itemPackage = $(this).find('[name="itemPackage"]').val(),
                    itemPackageText = $('select[name=itemPackage] option:selected').text(),
                    itemBruto = $(this).find('[name="itemBruto"]').val(),
                    itemCollect = $(this).find('[name="itemTotalCollect"]').val();
                    // itemSpec = $(this).find('[name="itemSpec"]').val();
                    // itemCom = $(this).find('[name="itemCom"]').val(),
                    // itemFob = $(this).find('[name="itemFob"]').val(),
                    // itemFreight = $(this).find('[name="itemFreight"]').val(),
                    // itemInsurance = $(this).find('[name="itemInsurance"]').val();

                var result = $('table[name="importTable"]'),
                    template = result.find('[template="importTableBody"]'),
                    rows = result.find('tbody');
                
                var row = template.clone().removeClass('d-none').removeAttr('template');
                row.find('[view="imName"]').html(itemName);
                row.find('[view="imTotal"]').html(itemTotal);
                row.find('[view="imPackage"]').html(itemPackageText);
                row.find('[view="imPackage"]').attr('im-value', itemPackage);
                row.find('[view="imBruto"]').html(itemBruto);
                row.find('[view="imCat"]').html('');
                row.find('[view="imCollect"]').html(itemCollect);
                
                
                // remove items
                // row.find('[view="instrumentAction"]').on('click', Valas.removeItems);
                row.appendTo(rows);
                // save attachments
                var fileData = $(this).find('#itemAttach1').prop('files')[0],
                    fileData2 = $(this).find('#itemAttach2').prop('files')[0],
                    fileData3 = $(this).find('#itemAttach3').prop('files')[0];

                if (fileData) Import.verifyUpload(fileData);
                if (fileData2) Import.verifyUpload(fileData2);
                if (fileData3) Import.verifyUpload(fileData3);

	            $('#pleaseWaitDialog').modal('hide');
                $('body').removeClass('modal-open');
                $(".modal-backdrop").remove();
                $('#pleaseWaitDialog').removeClass('show');
                $('#pleaseWaitDialog').removeAttr('style');
                $(this).find('button').removeAttr('disabled');
                $('#addItemModal').modal('hide');
                return false;
            });

            $('#btnAddItem').on('click', function() {
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
            $('button[name="btnBack"]').on('click', function() {
                $('#newValasModalStep2').modal('hide');
                $('#newValasModal').modal('show');
            });
            
            $('button[name="confirmDelete"]').on('click', function() {
                Import.deleteDataServer();
            });
        }
    };
    
    Import.init();
    
    })(jQuery);