(function($) {
    var Ecd = {
        params: {
            page: 1,
            dateFrom: '',
            dateUntil: '',
            flightNumber: '',
            limit: 20
        },
        alphaNumericValidate: function(string) {
            var regex = new RegExp("^[a-zA-Z0-9]+$");
            // var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
            if (regex.test(string)) {
                return true;
            } else {
                return false;
            }
        },
        numericValidate: function(string) {
            var regex = new RegExp("^[0-9]+$");
            // var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
            if (regex.test(string)) {
                return true;
            } else {
                return false;
            }
        },
        setIdr: function(value) {
            var output = value.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.");
            return output;
        },
        saveData: function(data) {
            $.ajax({
                url: '/reference/create',
                type: 'post',
                dataType: 'json',
                data: JSON.stringify(data)
            }).done(function(result) {
                alert('Data berhasil disimpan');
                $('#addModal').modal('hide');
                Ecd.doSearch();
            }).fail(function() {
                alert('terjadi kesalahan, coba lagi nanti..');
            });
        },
        getDetail: function() {
            var row = $(this).closest('tr'),
            data = row.attr('id');

            var params = {
                headerID: data
            };

            $.ajax({
                url: '/reference/get_detail',
                type: 'post',
                dataType: 'json',
                data: JSON.stringify(params)
            }).done(function(result) {
                Ecd.renderDetail(result.searchResult);
            }).fail(function() {
                alert('terjadi kesalahan, coba lagi nanti..');
            });
        },
        renderDetail: function(data) {
            // table of goods
            var theTable = $('table[name="detail_goods"]');
            var theBody = theTable.find('tbody').empty();
            var number = 1;
            $.each(data, function(index, value) {
                var row = '<tr>\
                    <th class="text-center" scope="row">' + number + '</th>\
                    <td class="text-center">'+value.uraian_barang+'</td>\
                    <td class="text-center">'+value.jumlah_barang+'</td>\
                    <td class="text-center">'+value.satuan_barang+'</td>\
                    <td class="text-center">'+Ecd.setIdr(value.total_pungutan)+'</td>\
                </tr>';
                theBody.append(row);
                number++;
            });

            $('#detailModal').modal('show');
        },
        renderSearch: function(data) {
            var result = $('[name="searchResult"]');
            var template = result.find('[template="searchResultRow"]');
            var rows = result.find('tbody').empty();
            var nav = result.find('[name="searchNav"]');
            var theNumber = 1;
            if (Ecd.params.page == 2) {
                theNumber =  Ecd.params.limit + 1;
            } else if (Ecd.params.page > 2) {
                theNumber =  (Ecd.params.limit * Ecd.params.page) + 1;
            }
            console.log(theNumber);
            $.each(data.rows, function(index, value) {
                var row = template.clone().removeClass('d-none').removeAttr('template');
                row.attr('id', value.header);
                row.find('[view="number"]').html(theNumber);
                row.find('[view="name"]').html(value.name);
                row.find('[view="birthDate"]').html(value.birth);
                row.find('[view="passport"]').html(value.passport);
                row.find('[view="docType"]').html(value.docType);
                row.find('[view="docNumber"]').html(value.docNumber);
                row.find('[view="docDate"]').html(value.docDate);
                
                row.appendTo(rows);
                row.on('click', Ecd.getDetail);
                theNumber++;
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
                page: Ecd.params.page,
                dateFrom: Ecd.params.dateFrom,
                dateUntil: Ecd.params.dateUntil,
                flightNumber: Ecd.params.flightNumber
            };
    
            $.ajax({
                url: '/reference/search',
                type: 'post',
                dataType: 'json',
                data: JSON.stringify(data)
            }).done(function(result) {
                if (result) {
                    Ecd.renderSearch(result.searchResult);
                }
            }).fail(function() {
                alert('terjadi kesalahan, coba lagi nanti..');
            });
        },
        init: function() {
            // add function
            $('#add_atensi').on('click', function(){
                $('form[name="atensiForm"]').find('#newPaspor, #newName, #newBirth, textarea').val('');
                $('#addModal').modal();
            });
            //nav function
            $('[name="next"]').on('click', function(){
                Ecd.params.page = Ecd.params.page + 1;
                Ecd.doSearch();
            });
            $('[name="prev"]').on('click', function(){
                Ecd.params.page = Ecd.params.page - 1;
                Ecd.doSearch();
            });

            $('.bc-date').datepicker({
                todayHighlight: true,
                orientation: "bottom left",
                format: 'yyyy-mm-dd'
            });

            $('form[name="searchForm"]').on('submit', function() {
                Ecd.params.dateFrom =  $(this).find('[name="dateFrom"]').val();
                Ecd.params.dateUntil =  $(this).find('[name="dateUntil"]').val();
                Ecd.params.flightNumber =  $(this).find('[name="flightNumber"]').val();

                Ecd.doSearch();
                return false;
            });

            $('form[name="atensiForm"]').on('submit', function() {
                var name = $('#newName').val();
                var birth = $('#newBirth').val();
                var docNumber = $('#newDocNumber').val();
                var docType = $('#newDocType').val();
                var docDate = $('#newDocDate').val();
                var desc = $('#newDesc').val();
                var type = $('#newType').val();
                var passport = $('#newPaspor').val();
                var qty = $('#newQty').val();
                var total = $('#newTotal').val();
                
                if (!Ecd.alphaNumericValidate(passport)) {
                    alert('Isian hanya alpha numeric');
                    $('#newPaspor').val('').focus();
                } else if (!Ecd.numericValidate(qty)) {
                    alert('Isian hanya numeric');
                    $('#newQty').val('').focus();
                } else if (!Ecd.numericValidate(total)) {
                    alert('Isian hanya numeric');
                    $('#newTotal').val('').focus();
                }

                var params = {
                    name: name, birt: birth, number: docNumber, type: docType, date: docDate, desc: desc,
                    pckg: type, passport: passport, qty: qty, total: total
                };
                // console.log(params);
                Ecd.saveData(params);
                return false;
            });

            Ecd.doSearch();
        }
    };

    Ecd.init();
})(jQuery);