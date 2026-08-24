(function($) {
    var Ecd = {
        params: {
            page: 1,
            dateFrom: '',
            dateUntil: '',
            flightNumber: '',
            limit: 20
        },
        setIdr: function(value) {
            var output = value.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.");
            return output;
        },
        changeZone: function(personalID){
            var params = {
                personal: personalID
            };
            $.ajax({
                url: '/rao/change_zone',
                type: 'post',
                dataType: 'json',
                data: JSON.stringify(params)
            }).done(function(result) {
                $('[view="detail-change-zone"]').removeClass('bg-danger');
                $('[view="detail-change-zone"]').addClass('bg-secondary');

                // change zone layout
                $('[view="detail-zone"]').removeClass('bg-success');
                $('[view="detail-zone"]').addClass('bg-danger');
                $('[view="detail-zone-text"]').html('MERAH RAO');
                // set header
                $('.modal-header').removeClass('bg-success');
                $('.modal-header').addClass('bg-danger');
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
                url: '/ecd/get_detail',
                type: 'post',
                dataType: 'json',
                data: JSON.stringify(params)
            }).done(function(result) {
                Ecd.renderDetail(result.data);
            }).fail(function() {
                alert('terjadi kesalahan, coba lagi nanti..');
            });
        },
        renderDetail: function(data) {
            $('#fullName').val(data.name);
            $('#birth').val(data.birth);
            $('#occupation').val(data.occupation);
            /**
             * for new nationality
             */
            var nationality = data.nationality;
            if (nationality == null) {
                nationality = data.nationality_text;
            }
            $('#nationality').val(nationality);
            $('#passport').val(data.passport);
            $('#address').val(data.address);
            $('#arrival').val(data.arrival);
            $('span[view="baggage_in"]').html(data.baggage_in);
            $('span[view="baggage_ex"]').html(data.baggage_ex);
            // $('#baggage_in').val(data.baggage_in + ' pck');
            // $('#baggage_ex').val(data.baggage_ex + ' pck');
            $('#family_num').val(data.family.length);
            $('span[view="flight"]').html(data.flight);
            $('span[view="arrival"]').html(data.arrival);
            // table of goods
            var theTable = $('table[name="detail_goods"]');
            var theBody = theTable.find('tbody').empty();
            var number = 1;
            $.each(data.goods, function(index, value) {
                var row = '<tr>\
                    <th class="text-center" scope="row">' + number + '</th>\
                    <td class="text-center">'+value.description+'</td>\
                    <td class="text-center">'+value.quantity+'</td>\
                    <td class="text-center">'+value.value+ ' ' + value.currency + '</td>\
                </tr>';
                theBody.append(row);
                number++;
            });

            // history table
            var theTable = $('table[name="historyTable"]');
            var theBody = theTable.find('tbody').empty();
            // var number = 1;
            $.each(data.history, function(index, value) {
                var row = '<tr>\
                    <th class="text-center" scope="row">' + value.no_dok_hist + '</th>\
                    <td class="text-center">'+value.jns_dok_hist+'</td>\
                    <td class="text-center">'+value.tgl_dok_hist+'</td>\
                    <td class="text-center">'+value.jumlah_barang+ ' ' + value.satuan_barang + ' ' + value.uraian_barang +'</td>\
                    <td class="text-center">'+Ecd.setIdr(value.total_pungutan)+'</td>\
                </tr>';
                theBody.append(row);
                number++;
            });

            // set zone
            if (data.zone == '1') {
                // set header
                $('.modal-header').removeClass('bg-success');
                $('.modal-header').addClass('bg-danger');

                $('[view="detail-zone"]').removeClass('bg-success');
                $('[view="detail-zone"]').addClass('bg-danger');
                $('[view="detail-zone-text"]').html('MERAH ' + data.zone_by);

                // intersect
                $('[view="detail-change-zone"]').removeClass('bg-danger');
                $('[view="detail-change-zone"]').addClass('bg-secondary');
            } else {
                // set header
                $('.modal-header').removeClass('bg-danger');
                $('.modal-header').addClass('bg-success');  

                $('[view="detail-zone"]').removeClass('bg-danger');
                $('[view="detail-zone"]').addClass('bg-success');
                $('[view="detail-zone-text"]').html('HIJAU');

                $('[view="detail-change-zone"]').addClass('bg-danger');
                $('[view="detail-change-zone"]').removeClass('bg-secondary');
                
                $('[view="detail-change-zone"]').on('click', function(){
                    Ecd.changeZone(data.personalID);
                });
            }

            $('#detailModal').modal('show');

            // family data
            var familyTable = $('table[name="familyTable"]');
            var familyBody = familyTable.find('tbody').empty();
            var number = 1;
            $.each(data.family, function(index, value) {
                var row = '<tr>\
                    <th class="text-center" scope="row">' + number + '</th>\
                    <td class="text-center">'+value.full_name+'</td>\
                    <td class="text-center">'+value.date_of_birth+'</td>\
                    <td class="text-center">'+value.passport_number+'</td>\
                </tr>';
                familyBody.append(row);
                number++;
            });

            // set declare
            var declareTable = $('table[name="tableDeclare"]').empty();
            var number = 1;
            $.each(data.declare, function(index, value) {
                var row = '<tr>\
                    <td style="vertical-align: top;">' + number + '.</td>\
                    <td>' + value.content + '</td>\
                </tr>';
                declareTable.append(row);
                number++;
            });
            /*
            $('button[name="btnPersonalDetail"]').on('click', function(){
                $('#personalDetailModal').modal('show');
            });*/
        },
        renderSearch: function(data) {
            var result = $('[name="searchResult"]');
            var template = result.find('[template="searchResultRow"]');
            var rows = result.find('tbody').empty();
            var nav = result.find('[name="searchNav"]');
            var theNumber = 1;
            if (Ecd.params.page > 1) {
                theNumber =  (Ecd.params.limit * Ecd.params.page) + 1;
            }
            $.each(data.rows, function(index, value) {
                var row = template.clone().removeClass('d-none').removeAttr('template');
                row.attr('id', value.ecd);
                row.find('[view="number"]').html(theNumber);
                row.find('[view="name"]').html(value.name);
                row.find('[view="birthDate"]').html(value.birth);
                row.find('[view="passport"]').html(value.passport);
                row.find('[view="flightNumber"]').html(value.flight);
                row.find('[view="arrival"]').html(value.arrival_date);
                // set scan status
                if (value.scan == '1') {
                    var scanStatus = 'Yes';
                } else {
                    var scanStatus = 'No';
                }
                row.find('[view="scan"]').html(scanStatus);
                row.find('[view="scan_by"]').html(value.scan_by);
                row.find('[view="scan_time"]').html(value.scan_time);

                if (value.sppb == '0') {
                    row.find('[view="sppb"]').html('Hijau');
                    row.find('[view="sppb"]').addClass('bg-success text-white text-center');
                } else if(value.sppb == '1') {
                    row.find('[view="sppb"]').html('Merah');
                    row.find('[view="sppb"]').addClass('bg-danger text-white text-center');
                } else {
                    row.find('[view="sppb"]').html(value.sppb);
                }
                
                // set status
                var status = 'Tidak';
                if (value.scan == '1') {
                    status = 'Ya';
                }
                row.find('[view="status"]').html(status);

                // set zone
                if (value.zone == '0') {
                    row.find('[view="zone"]').html('Hijau');
                    row.find('[view="zone"]').addClass('bg-success text-white text-center');
                } else {
                    row.find('[view="zone"]').html('Merah');
                    row.find('[view="zone"]').addClass('bg-danger text-white text-center');
                }
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
                url: '/ecd/search',
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

            Ecd.doSearch();
        }
    };

    Ecd.init();
})(jQuery);