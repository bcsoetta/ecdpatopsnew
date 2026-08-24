(function($) {
    var Rao = {
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
                $('[view="detail-change-zone"]').removeClass('bc-bg-red');
                $('[view="detail-change-zone"]').addClass('bg-secondary');

                // change zone layout
                $('[view="detail-zone"]').removeClass('bc-bg-green');
                $('[view="detail-zone"]').addClass('bc-bg-red');
                $('[view="detail-zone-text"]').html('MERAH');
                // set header
                $('.card-header').removeClass('bc-bg-green');
                $('.card-header').addClass('bc-bg-red');
            }).fail(function() {
                alert('terjadi kesalahan, coba lagi nanti..');
            });
        },
        setIdr: function(value) {
            var output = value.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.");
            return output;
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
                    <td class="text-center">'+Rao.setIdr(value.total_pungutan)+'</td>\
                </tr>';
                theBody.append(row);
                number++;
            });
            // set zone
            if (data.zone == '1') {
                // set header
                $('.card-header').removeClass('bc-bg-green');
                $('.card-header').addClass('bc-bg-red');

                $('[view="detail-zone"]').removeClass('bc-bg-green');
                $('[view="detail-zone"]').addClass('bc-bg-red');
                $('[view="detail-zone-text"]').html('MERAH');

                // intersect
                $('[view="detail-change-zone"]').removeClass('bc-bg-red');
                $('[view="detail-change-zone"]').addClass('bg-secondary');
            } else {
                // set header
                $('.card-header').removeClass('bc-bg-red');
                $('.card-header').addClass('bc-bg-green');  

                $('[view="detail-zone"]').removeClass('bc-bg-red');
                $('[view="detail-zone"]').addClass('bc-bg-green');
                $('[view="detail-zone-text"]').html('HIJAU');

                $('[view="detail-change-zone"]').addClass('bc-bg-red');
                $('[view="detail-change-zone"]').removeClass('bg-secondary');
                
                $('[view="detail-change-zone"]').on('click', function(){
                    Rao.changeZone(data.personalID);
                });
            }

            // $('#detailModal').modal('show');

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

            // set dnone
            $('div[name="bc-data"]').removeClass('d-none');
            $('div[name="bc-none"]').addClass('d-none');

            // bold all input
            $('div[name="bc-data"]').find('input, textarea').css('font-weight', 'bold');
        },
        init: function() {
            // set minimize
            $('#kt_body').addClass('aside-minimize');
            // $('#detailModal').modal('show');

            $('#qrcode').focus();
            $('#qrcode').focusout(function(){
                $('#qrcode').focus();
            });
            
            // $('#qrcode').on('change textInput input', function() {
            $('#qrcode').on('change', function() {
                // $('#detailModal').modal('hide');
                var data = $(this).val();
                if (data.length == 18) {
                    var params = {
                        qrcode: data
                    };
    
                    $.ajax({
                        url: '/rao/get_detail',
                        type: 'post',
                        dataType: 'json',
                        data: JSON.stringify(params)
                    }).done(function(result) {
                        // clear and set focus again
                        Rao.renderDetail(result.data);
                    }).fail(function() {
                        // hide the data
                        $('div[name="bc-none"]').removeClass('d-none');
                        $('div[name="bc-data"]').addClass('d-none');
                        // alert('terjadi kesalahan, coba lagi nanti..');
                    }).always(function(){
                        $('#qrcode').val('').focus();
                    });
                } else if (data.length > 18) {
                    $('div[name="bc-none"]').removeClass('d-none');
                    $('div[name="bc-data"]').addClass('d-none');
                    $('#qrcode').val('').focus();
                }
            });
        }
    };

    Rao.init();
})(jQuery);