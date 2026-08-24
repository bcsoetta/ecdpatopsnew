"use strict";
var KTDatatablesDataSourceAjaxServer = function() {
	var base_url = window.location.origin+'/ptps/spmb/spmb_list';
	var initTable1 = function() {
		var table = $('#kt_datatable');

		// begin first table
		table.DataTable({
			responsive: true,
			searchDelay: 200,
			// processing: true,
			// serverSide: true,
			ajax: {

				url: base_url,
				type: 'POST',
				data: {
					// parameters for custom backend script demo
					columnsDef: [
						'id', 'nama', 'nomor_paspor','nomor_penerbangan','tanggal_dokumen','jumlah_barang', 'status', 'id'],
				},
			},
			columns: [
				{data: 'id'},
				{data: 'nama'},
				{data: 'nomor_paspor'},
				{data: 'nomor_penerbangan'},
				{data: 'tanggal_dokumen'},
				{data: 'status'},
				{data: 'id', responsivePriority: -1},
			],
			columnDefs: [
				{
					targets: -1	,
					title: 'Actions',
					orderable: false,
					render: function(data, type, full, meta) {
						return '\
							<div class="dropdown dropdown-inline">\
								<a href="javascript:;" class="btn btn-sm btn-clean btn-icon" data-toggle="dropdown">\
	                                <i class="la la-cog"></i>\
	                            </a>\
							  	<div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">\
									<ul class="nav nav-hoverable flex-column">\
							    		<li class="nav-item"><a class="nav-link" style="cursor: pointer;" onclick="update('+data+')"><i class="nav-icon la la-luggage-cart"></i><span class="nav-text">Luggage data</span></a></li>\
							    		<li class="nav-item"><a class="nav-link" style="cursor: pointer;" onclick="update('+data+')"><i class="nav-icon la la-users"></i><span class="nav-text">Passenger data</span></a></li>\
							    		<li class="nav-item"><a class="nav-link" style="cursor: pointer;" onclick="update('+data+')"><i class="nav-icon la la-user-minus"></i><span class="nav-text" style="color: red;">Set To Red</span></a></li>\
							    		<li class="nav-item"><a class="nav-link" style="cursor: pointer;" onclick="update('+data+')"><i class="nav-icon la la-user-tag"></i><span class="nav-text" style="color: green;">Set To Green</span></a></li>\
							    		<li class="nav-item"><a class="nav-link" style="cursor: pointer;" onclick="print('+data+')"><i class="nav-icon la la-print"></i><span class="nav-text">Print</span></a></li>\
									</ul>\
							  	</div>\
							</div>\
						';
					},
				},
				{
					width: '75px',
					targets: -2,
					render: function(data, type, full, meta) {
						var status = {
							1: {'title': 'Red', 'class': 'label-light-danger'},
							2: {'title': 'Not Finished', 'class': ' label-light-info'},
							3: {'title': 'Green', 'class': ' label-light-success'},
						};
						if (typeof status[data] === 'undefined') {
							return data;
						}
						return '<span class="label label-lg font-weight-bold' + status[data].class + ' label-inline">' + status[data].title + '</span>';
					},
				},
			],
		});
	};

	return {

		//main function to initiate the module
		init: function() {
			initTable1();
		},

	};

}();

function get_spmb_list(data) {
	var item_url = window.location.origin+'/ptps/spmb/spmb_item_list/'+data;
	var initTable2 = function() {
	var table2 = $('#kt_item_datatable');

		// begin first table
		table2.DataTable({
			responsive: true,
			searchDelay: 200,
			processing: true,
			serverSide: true,
			bPaginate: false,
			bInfo: false,
			bDestroy: true,
			ajax: {

				url: item_url,
				type: 'POST',
				data: {
					// parameters for custom backend script demo
					columnsDef: [
						'id', 'nomor_dokumen','nama_barang','jumlah_satuan','jenis_kemasan','status','id'],
				},
			},
			columns: [
				{data: 'id'},
				{data: 'nomor_dokumen'},
				{data: 'nama_barang'},
				{data: 'jumlah_satuan'},
				{data: 'jenis_kemasan'},
				{data: 'status'},
				{data: 'id', responsivePriority: -1},
			],
			columnDefs: [
				{
					targets: -1,
					title: 'Actions',
					orderable: false,
					render: function(data, type, full, meta) {
						return '\
							<a href="javascript:;" class="btn btn-sm btn-clean btn-icon" title="Verification" onclick="verification('+data+')">\
								<i class="la la-edit"></i>\
							</a>\
							<a href="javascript:;" class="btn btn-sm btn-clean btn-icon" title="Detail">\
								<i class="la la-eye"></i>\
							</a>\
						';
					},
				},
				
			],
		});
	};

	initTable2();
}

function get_spmb_list_form(data){
	var item_url_form = window.location.origin+'/ptps/spmb/spmb_item_form/';
	var str = data;
       var t = $('#goods_item_form').DataTable({    
                "columnDefs": [{ "targets": 0,
                                 "searchable": false,
                                 "orderable": false}
                               ],
                "order": [[ 1, 'desc' ]],
                "ordering": false,
                "processing": true,
                "bPaginate": false,
                    "paging": false,
                    "bFilter": false,
                "bDestroy": true,
                    "ajax": {
                    'type': 'POST',
                    'url': item_url_form,
                    'data': {
                              str : str,
                            },

                    }                         

            });

        t.on( 'order.dt search.dt', function () {
            t.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
                cell.innerHTML = i+1+'.';
            } );
        }).draw();
}

jQuery(document).ready(function() {
	KTDatatablesDataSourceAjaxServer.init();

	$('#kt_datepicker_1').datepicker({
               todayHighlight: true,
               orientation: "bottom left",
               format: 'yyyy-mm-dd'
    });

    $('#spmb_form').on('submit', function (e) {
            e.preventDefault();
            var base_url = window.location.origin+'/ptps/spmb/new_spmb';
               $.ajax({
                            url : base_url,
                            type: "POST",
                            data: $('#spmb_form').serialize(),
                            dataType: "JSON",
                            beforeSend: function(){

                            },
                            success: function(data){ 
                            	$('#staticBackdrop').modal('hide');
                                Swal.fire("Success", "Data has been saved !!!", "success");

                                $('#kt_datatable').DataTable().ajax.reload();

                                
                            },
                            error: function (jqXHR, textStatus, errorThrown){
                                // alert('Failed !');
                                // $('.btn-submit-peralihan').text('Tambahkan');
                                // $('.btn-submit-peralihan').attr('disabled',false); 
                            }
                        });
    });
    $('#spmb_goods_form').on('submit', function (e) {
        e.preventDefault();
        var base_url = window.location.origin+'/ptps/spmb/new_spmb_item';
               $.ajax({
                            url : base_url,
                            type: "POST",
                            data: $('#spmb_goods_form').serialize(),
                            dataType: "JSON",
                            beforeSend: function(){

                            },
                            success: function(data){ 
                            	get_spmb_list_form(data);
                            	$('#GoodsModal').modal('hide');
        						// $('#spmb_goods_form')[0].reset();
                            },
                            error: function (jqXHR, textStatus, errorThrown){
                                // alert('Failed !');
                                // $('.btn-submit-peralihan').text('Tambahkan');
                                // $('.btn-submit-peralihan').attr('disabled',false); 
                            }
                        });
    });

    $('#spmb_goods_verification').on('submit', function (e) {
        e.preventDefault();
        var base_url = window.location.origin+'/ptps/spmb/spmb_goods_verification';
               $.ajax({
                            url : base_url,
                            type: "POST",
                            data: $('#spmb_goods_verification').serialize(),
                            dataType: "JSON",
                            beforeSend: function(){

                            },
                            success: function(data){ 
                            	$('#VerificationModal').modal('hide');
                            	$('#kt_item_datatable').DataTable().ajax.reload();
                            	$('#kt_datatable').DataTable().ajax.reload();
                            },
                            error: function (jqXHR, textStatus, errorThrown){
                                // alert('Failed !');
                                // $('.btn-submit-peralihan').text('Tambahkan');
                                // $('.btn-submit-peralihan').attr('disabled',false); 
                            }
                        });
    });
    

    $('#add_spmb').on('click', function (e) {
       get_spmb_list_form();
       $('#staticBackdrop').modal('show');
    });
    $('#add_item').on('click', function (e) {
       $('#GoodsModal').modal('show');
    });

});



function print(data){
	alert(data);
}

function update(data){
	$('#UpdateModal').modal('show');
	get_spmb_list(data);

}

function verification(data){

	$('.spmb_item_id').val(data);
	$('#VerificationModal').modal('show');
}



