"use strict";
var KTDatatablesDataSourceAjaxServer = function() {
	var base_url = window.location.origin+'/spmb/spmb_list';
	var initTable1 = function() {
		var table = $('#kt_datatable');

		// begin first table
		table.DataTable({
			responsive: true,
			searchDelay: 200,
			processing: true,
			serverSide: true,
			// pageLength: 1,
			ajax: {

				url: base_url,
				type: 'POST',
				data: {
					// parameters for custom backend script demo
					columnsDef: [
						'nomor_dokumen','tanggal_dokumen', 'nama', 'nomor_paspor','nomor_penerbangan', 'status', 'id'],
				},
			},
			columns: [
				// {data: 'id'},
				{data: 'nomor_dokumen'},
				{data: 'tanggal_dokumen'},
				{data: 'nama'},
				{data: 'nomor_paspor'},
				{data: 'nomor_penerbangan'},
				{data: 'status'},
				{data: 'id', responsivePriority: -1},
			],
			columnDefs: [
				{
					targets: -1,
					title: 'Menu',
					orderable: false,
					render: function(data, type, full, meta) {
						// console.log(data.nomor_paspor);
						// <li class="nav-item"><a class="nav-link" style="cursor: pointer;" onclick="update('+data+')"><i class="nav-icon la la-leaf"></i><span class="nav-text">Update Status</span></a></li>
						return '\
							<div class="dropdown dropdown-inline">\
								<a href="javascript:;" class="btn btn-sm btn-clean btn-icon" data-toggle="dropdown">\
	                                <i class="la la-cog"></i>\
	                            </a>\
							  	<div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">\
									<ul class="nav nav-hoverable flex-column">\
										<li class="nav-item"><a class="nav-link" style="cursor: pointer;" onclick="review('+data+')"><i class="nav-icon la la-eye"></i><span class="nav-text">Review</span></a></li>\
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
							1: {'title': 'Open', 'class': 'label-light-danger'},
							// 2: {'title': 'Not Finished', 'class': ' label-light-info'},
							2: {'title': 'Close', 'class': ' label-light-success'},
							3: {'title': 'Created', 'class': ' label-light-info'},
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
	var item_url = window.location.origin+'/spmb/spmb_item_list/'+data;
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
						'id', 'nomor_dokumen','nama_barang','jumlah_satuan','jenis_kemasan','status','status_barang','id'],
				},
			},
			columns: [
				{data: 'id'},
				{data: 'nomor_dokumen'},
				{data: 'nama_barang'},
				{data: 'jumlah_satuan'},
				{data: 'jenis_kemasan'},
				{data: 'status'},
				{data: 'status_barang'},
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
	var item_url_form = window.location.origin+'/spmb/spmb_item_form/';
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

	$('#doc_date').datepicker({
		todayHighlight: true,
		orientation: "bottom left",
		format: 'yyyy-mm-dd'
});

    $('#spmb_form').on('submit', function (e) {
        e.preventDefault();
        var base_url = window.location.origin+'/spmb/new_spmb';
		$.ajax({
			url : base_url,
			type: "POST",
			data: $('#spmb_form').serialize(),
			dataType: "JSON"
		}).done(function(result){ 
			console.log(result);
			if (result.status != 'error') {
				$('#staticBackdrop').modal('hide');
				Swal.fire("Success", "Data berhasil disimpan !!!", "success");

				$('#kt_datatable').DataTable().ajax.reload();

				// reset form submit
				$('#spmb_form').find('input[type=text]', 'input[type=email]').val('');
				// clear data doc
				$('#docs_item_form').find('tbody').empty();
			} else {
				alert('Dokumen pelengkap dan item barang harus diisi');
			}
		});
    });

	$('#spmb_docs_form').on('submit', function (e) {
		// $(this).find('button').attr('disabled', 'disabled');
		// $('#pleaseWaitDialog').modal('show');

		// mapping data
		var type = $(this).find('[name="doc_type"]').val(),
			number = $(this).find('[name="doc_number"]').val(),
			date = $(this).find('[name="doc_date"]').val();

		var params = {
			type: type, number: number, date: date,
			header: $('#key_header').val(), item: $('#key_doc').val()
		};

		var base_url = window.location.origin+'/spmb/new_docs_item';

		$.ajax({
			url: base_url,
			type: 'post',
			dataType: 'json',
			data: JSON.stringify(params)
		}).done(function(result) {
			// if data saved
			if (result) {
				// save attachment
				var myForm = $('form[name="spmb_docs_form"]');
				myForm.find('button').attr('disabled', 'disabled');
				$('#pleaseWaitDialog').modal('show');

				var fileData = myForm.find('#itemAttach1').prop('files')[0],
					fileData2 = myForm.find('#itemAttach2').prop('files')[0],
					fileData3 = myForm.find('#itemAttach3').prop('files')[0];
				
				if (fileData) {
					verifyUpload(fileData, true);
				}
				if (fileData2) {
					verifyUpload(fileData2, true);
				}
				if (fileData3) {
					verifyUpload(fileData3, true);
				}

				renderDocsTemp();
				$('#docs_modal').modal('hide');
			}
		}).fail(function() {
			alert('terjadi kesalahan, coba lagi nanti..');
		}).always(function() {
			$('#pleaseWaitDialog').modal('hide');
			$('body').removeClass('modal-open');
			$(".modal-backdrop").remove();
			$('#pleaseWaitDialog').removeClass('show');
			$('#pleaseWaitDialog').removeAttr('style');
			$('form[name="spmb_docs_form"]').find('button').removeAttr('disabled');
		});

		return false;
	});

	$('#spmb_goods_form').on('submit', function (e) {
		// $(this).find('button').attr('disabled', 'disabled');
		// $('#pleaseWaitDialog').modal('show');
		
		// mapping data
		var name = $(this).find('[name="goods_name"]').val(),
			qty = $(this).find('[name="goods_quantity"]').val(),
			qtyType = $(this).find('[name="goods_jenis_satuan"]').val(),
			thePackage = $(this).find('[name="goods_jumlah_kemasan"]').val(),
			packageType = $(this).find('[name="goods_jenis_kemasan"]').val(),
			currency = $(this).find('[name="currency"]').val(),
			price = $(this).find('[name="price"]').val(),
			category = $(this).find('[name="goods_category"]').val(),
			bruto = $(this).find('[name="goods_bruto"]').val();

		var params = {
			name: name, qty: qty, qtyType: qtyType, package: thePackage, packageType: packageType, currency: currency,
			price: price, category: category, bruto: bruto,
			header: $('#key_header').val(), item: $('#key_item').val()
		};
		// create parameter to save item temp

		// insert data items temp without attachment
		var base_url = window.location.origin+'/spmb/new_spmb_item';

		$.ajax({
			url: base_url,
			type: 'post',
			dataType: 'json',
			data: JSON.stringify(params)
		}).done(function(result) {
			// if data saved
			if (result) {
				// save attachment
				var myForm = $('form[name="spmb_goods_form"]');
				myForm.find('button').attr('disabled', 'disabled');
				$('#pleaseWaitDialog').modal('show');

				var fileData = myForm.find('#itemAttach1').prop('files')[0],
					fileData2 = myForm.find('#itemAttach2').prop('files')[0],
					fileData3 = myForm.find('#itemAttach3').prop('files')[0];
				
				if (fileData) {
					verifyUpload(fileData);
				}
				if (fileData2) {
					verifyUpload(fileData2);
				}
				if (fileData3) {
					verifyUpload(fileData3);
				}

				renderItemTemp();
				$('#GoodsModal').modal('hide');
			}
		}).fail(function() {
			alert('terjadi kesalahan, coba lagi nanti..');
		}).always(function() {
			$('#pleaseWaitDialog').modal('hide');
			$('body').removeClass('modal-open');
			$(".modal-backdrop").remove();
			$('#pleaseWaitDialog').removeClass('show');
			$('#pleaseWaitDialog').removeAttr('style');
			$('form[name="spmb_goods_form"]').find('button').removeAttr('disabled');
		});

		return false;
    });

    $('#spmb_goods_verification').on('submit', function (e) {
        e.preventDefault();
        var base_url = window.location.origin+'/spmb/spmb_goods_verification';
               $.ajax({
                            url : base_url,
                            type: "POST",
                            data: $('#spmb_goods_verification').serialize(),
                            dataType: "JSON",
                            beforeSend: function(){

                            },
                            success: function(data){ 
                            	$('#VerificationModal').modal('hide');
								
                            	// $('#kt_item_datatable').DataTable().ajax.reload();
								/**
								 * reset table
								 */
								 var headerID = $('#itemListHeaderID').val();
								getItemList(headerID);

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
		// reset data spmb temp
		// reset_spmb_data();
    //    get_spmb_list_form();

	   // generate key
		var generator = generateKey();
		$('#key_header').val(generator);

       $('#staticBackdrop').modal('show');
    });
	
    $('#add_item').on('click', function (e) {
		// clear form
		$('#spmb_goods_form').find('input[name="itemID"]').val('');
		$('#spmb_goods_form').find('input[type=text]').val('');
		$('#spmb_goods_form').find('input[type=file]').val('');
		// $('#spmb_goods_form').find('select[name="goods_package"]').val('');
		$('#spmb_goods_form').find('.selectpicker').selectpicker('val', '');
		$('#kt_image_5').find('.image-input-wrapper').removeAttr('style');
		// $("div").attr("style", "display:block; color:red")
		// $('#spmb_goods_form').find('input[type=option]').val('');

		// generate key
		var generator = generateKey();
		$('#key_item').val(generator);

       $('#GoodsModal').modal('show');
    });

	$('#add_docs').on('click', function (e) {
		$('#spmb_docs_form').find('input[type=text]').val('');
		$('#spmb_docs_form').find('input[type=file]').val('');
		var generator = generateKey();
		$('#key_doc').val(generator);
		$('#docs_modal').modal('show');
	});
});

function generateKey() {
	return Math.floor(Math.random() * 26) + Date.now();
}

function verifyUpload(fileData, docs = false) {
	// console.log(fileData.size);
	if (fileData.size > 0) {
		if (fileData.size > 2000000) {
			alert('Ukuran Max. file 2Mb');
		} else {
			uploadItems(fileData, docs);
		}
	}
}

function uploadItems(data, docs) {
	var formData =  new FormData();
	formData.append('file', data);
	if (docs) {
		formData.append('item_key', $('#key_doc').val());
		var base_url = window.location.origin + '/spmb/upload_docs/';
	} else {
		formData.append('item_key', $('#key_item').val());
		var base_url = window.location.origin + '/spmb/upload_items/';
	}
	
	$.ajax({
		url: base_url,
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
}

function print(data){
	// alert('Under Construction...');
	// open new print page
	var msg = myEncrypt(data);
	var base_url = window.location.origin + '/spmb/print_doc/' + msg;
	var win = window.open(base_url, '_blank');
	if (win) {
		//Browser has allowed it to be opened
		win.focus();
	} else {
		//Browser has blocked it
		alert('Please allow popups for this website');
	}
}

function update(data){
	$('#UpdateModal').modal('show');
	get_spmb_list(data);

}

function review(data) {
	var header_id = data;
	var base_url = window.location.origin + '/spmb/get_detail/';
	var dataPost = {
		header : header_id
	};
	$.ajax({
		url: base_url,
		type: 'post',
		dataType: 'json',
		data: JSON.stringify(dataPost)
	}).done(function(result) {
		if (result) {
			// console.log(result);
			var header = result.result;
			var modal = $('#ReviewModal');
			modal.find('span[view="cust_name"]').html(header.nama);
			modal.find('span[view="cust_birth"]').html(header.tgl_lahir);
			modal.find('span[view="pas_num"]').html(header.nomor_paspor);
			modal.find('span[view="phone"]').html(header.nomor_telepon);
			modal.find('span[view="identity"]').html(header.nik_npwp_nib);
			modal.find('span[view="Nationality"]').html(header.nationality);
			modal.find('span[view="email"]').html(header.email);
			modal.find('span[view="office_dep"]').html(header.kantor_pabean_keberangkatan);
			modal.find('span[view="office_arr"]').html(header.kantor_pabean_kedatangan);
			modal.find('span[view="flight_num"]').html(header.nomor_penerbangan);
			modal.find('span[view="doc_no"]').html(header.nomor_dokumen);
			modal.find('span[view="doc_date"]').html(header.tanggal_dokumen);
			modal.find('span[view="address"]').html(header.alamat);
			modal.find('span[view="country_arr"]').html(header.country_arrival);
			modal.find('span[view="reason"]').html(header.reason);

			var data_items = header.items;
			renderItems(data_items, header.print_status);

			// parsing items
			$('#itemListHeaderID').val(header_id);
			$('#ReviewModal').modal('show');
		}
	}).always(function() {
		// Account.clearForm();
		// Account.enabled(true);
	}).fail(function() {
		// alert('terjadi kesalahan, coba lagi nanti..');
	});
}

function verification(data){
	$('.spmb_item_id').val(data);
	$('#VerificationModal').modal('show');
}
function setIDR(input) {
	// var output = (input/1000).toFixed(3);
	var output = input.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.");
	return output;
}
/**
 * Robbi Amirudin
 */
$('#price').on('change', function() {
	var qty = parseInt($('#goods_quantity').val());
	var price = parseInt($(this).val());
	var total = qty * price;
	// console.log(qty);
	$('#goods_custom').val(setIDR(total));
});

$('#goods_quantity').on('change', function() {
	var price = parseInt($('#price').val());
	var qty = parseInt($(this).val());
	var total = qty * price;
	// console.log(qty);
	$('#goods_custom').val(setIDR(total));
});


function get_spmb_list_docs(data){
	var item_url_form = window.location.origin+'/spmb/spmb_list_docs/';
	var str = data;
       var t = $('#docs_item_form').DataTable({    
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

function myEncrypt(data){
	var salt = 100*99*98*1*2*3;
	return salt * data;
}

// set item list data
$('#item_status').on('change', function() {
	var status = $(this).val();
	if (status != '2') {
		$('input[name="spmb_item_verified"]').attr('disabled', 'disabled');
		$('input[name="spmb_item_verified"]').val('');
	} else {
		$('input[name="spmb_item_verified"]').removeAttr('disabled');
	}
	
});

function reset_spmb_data(){
	var base_url = window.location.origin+'/spmb/reset_spmb_temp/';

	$.ajax({
		url : base_url,
		// success: function(data){ 
		// }
	}); 
}

function showImage(data) {
	// console.log(data);
	// $('#imageItem').attr('src', '/assets/custom/docs/' + data);
	$('#ReviewModal').modal('hide');
	$('#imageViewer').modal('show');
}
function renderDocsTemp() {
	var header = $('#key_header').val();
	var params = { key_header: header };

	var base_url = window.location.origin + '/spmb/get_docs_temp/';
	$.ajax({
		url: base_url,
		type: 'post',
		dataType: 'json',
		data: JSON.stringify(params)
	}).done(function(result) {
		if (result) {
			var itemTable = $('#show_docs');
			itemTable.find('tbody').empty();
			var dataItems = '';
			
			$.each(result.items, function(index, value) {	
				dataItems += '<tr id="' + value.id + '">\
					<td view="type">' + value.doc_type + '</td>\
					<td view="number">' + value.doc_number + '</td>\
					<td view="date">' + value.doc_date + '</td>\
					<td>\
							<a href="javascript:;" onClick="deleteDocs(this)" class="btn btn-sm btn-danger btn-icon" title="delete" >\
								<i class="la la-close"></i>\
							</a>\
					</td>';
			});
			itemTable.find('tbody').html(dataItems);
		}
	}).always(function() {
		// Account.clearForm();
		// Account.enabled(true);
	}).fail(function() {
		// alert('terjadi kesalahan, coba lagi nanti..');
	});
}
function renderItemTemp() {

	var header = $('#key_header').val();
	var params = { key_header: header };

	var base_url = window.location.origin + '/spmb/get_item_temp/';
	$.ajax({
		url: base_url,
		type: 'post',
		dataType: 'json',
		data: JSON.stringify(params)
	}).done(function(result) {
		if (result) {
			var itemTable = $('#show_item_list_new_spmb');
			itemTable.find('tbody').empty();
			var dataItems = '';
			
			$.each(result.items, function(index, value) {
				dataItems += '<tr id="' + value.itemID + '">\
					<td view="name">' + value.itemName + '</td>\
					<td view="qty">' + value.qty + '</td>\
					<td view="pck">' + value.package + '</td>\
					<td view="bruto">' + value.bruto + '</td>\
					<td view="price">' + value.price + '</td>\
					<td>\
							<a href="javascript:;" onClick="deleteForm(this)" class="btn btn-sm btn-danger btn-icon" title="delete" >\
								<i class="la la-close"></i>\
							</a>\
					</td>';
				// dataItems += myEdit;
				dataItems += '</td>';	
			});
			itemTable.find('tbody').html(dataItems);
		}
	}).always(function() {
		// Account.clearForm();
		// Account.enabled(true);
	}).fail(function() {
		// alert('terjadi kesalahan, coba lagi nanti..');
	});
}
function renderItems(items, printStatus) {
	var itemTable = $('#show_item_list');
	itemTable.find('tbody').empty();
	var dataItems = '';
	$.each(items, function(index, value) {
		/**
		 * change status edit on  item status
		 */
		var myEdit = '';
		// status 3 = selesai seluruhnya
		if (value.statusID != '3') {
			var myEdit = '<td><a href="javascript:;" class="btn btn-sm btn-clean btn-icon" title="Verification" onclick="verification('+value.item_id+')">\
			<i class="la la-edit"></i></td>';
		}
		/*
		var myEdit = '';
		if (printStatus != '1') {
			var myEdit = '<td><a href="javascript:;" class="btn btn-sm btn-clean btn-icon" title="Verification" onclick="verification('+value.item_id+')">\
			<i class="la la-edit"></i></td>';
		}
		*/
		var attachments = '';
		if (value.attachment.length > 0) {
			$.each(value.attachment, function(attIndex, att) {
				attachments += '<a class="nav-link image-link" style="cursor: pointer;" view="'+att.name+'">'+att.name+'</a>'
			});
		}

		dataItems += '<tr id="' + value.item_id + '">\
			<td>' + value.doc_number + '</td>\
			<td>' + value.item_name + '</td>\
			<td>' + value.qty + '</td>\
			<td>' + value.qty_type + '</td>\
			<td>' + value.price + '</td>\
			<td>' + value.remaining + '</td>\
			<td>' + attachments + '</td>\
			<td>' + value.status + '</td>';
		dataItems += myEdit;
		dataItems += '</td>';
		
	});
	itemTable.find('tbody').html(dataItems);
	
	$('.image-link').on('click', function() {
		$('#imageItem').attr('src', '/assets/custom/items/' + $(this).attr('view'));
		$('#ReviewModal').modal('hide');
		$('#imageViewer').modal('show');
	});
}

function getItemList(header) {
	var base_url = window.location.origin + '/spmb/get_item_only/';
	var dataPost = {
		header : header
	};

	$.ajax({
		url: base_url,
		type: 'post',
		dataType: 'json',
		data: JSON.stringify(dataPost)
	}).done(function(result) {
		if (result) {
			renderItems(result.items);
		}
	}).always(function() {
		// Account.clearForm();
		// Account.enabled(true);
	}).fail(function() {
		// alert('terjadi kesalahan, coba lagi nanti..');
	});
}

function editForm(data) {
	var row = data.closest('tr');
	var itemID = row.id;

	var base_url = window.location.origin + '/spmb/get_item_temp/';
	var dataPost = {
		itemID : itemID
	};
	
	$.ajax({
		url: base_url,
		type: 'post',
		dataType: 'json',
		data: JSON.stringify(dataPost)
	}).done(function(result) {
		if (result) {
			// render modal
			var myForm = $('#spmb_goods_form');
			myForm.find('[name="itemID"]').val(itemID);
			myForm.find('[name="goods_name"]').val(result.items[0].itemName);
			myForm.find('[name="goods_quantity"]').val(result.items[0].qty);
			myForm.find('[name="goods_jenis_satuan"]').val(result.items[0].qty_type);
			myForm.find('[name="goods_jumlah_kemasan"]').val(result.items[0].qty_pck);
			myForm.find('[name="goods_jenis_kemasan"]').val(result.items[0].package);
			myForm.find('[name="price"]').val(result.items[0].price);
			myForm.find('[name="goods_bruto"]').val(result.items[0].bruto);
			myForm.find('[name="currency"]').val(result.items[0].currency);	
			myForm.find('[name="goods_category"]').val(result.items[0].category);	
			
			$('#GoodsModal').modal('show');
		}
	}).always(function() {
		// Account.clearForm();
		// Account.enabled(true);
	}).fail(function() {
		// alert('terjadi kesalahan, coba lagi nanti..');
	});
	
}

function deleteForm(data) {
	var row = data.closest('tr');
	var itemID = row.id;

	var base_url = window.location.origin + '/spmb/delete_item/';
	var dataPost = {
		itemID : itemID
	};

	$.ajax({
		url: base_url,
		type: 'post',
		dataType: 'json',
		data: JSON.stringify(dataPost)
	}).done(function(result) {
		if (result) {
			renderItemTemp();
		}
	}).always(function() {
		// Account.clearForm();
		// Account.enabled(true);
	}).fail(function() {
		// alert('terjadi kesalahan, coba lagi nanti..');
	});
}

function deleteDocs(data) {
	var row = data.closest('tr');
	var itemID = row.id;

	var base_url = window.location.origin + '/spmb/delete_doc/';
	var dataPost = {
		itemID : itemID
	};

	$.ajax({
		url: base_url,
		type: 'post',
		dataType: 'json',
		data: JSON.stringify(dataPost)
	}).done(function(result) {
		if (result) {
			renderDocsTemp();
		}
	}).always(function() {
		// Account.clearForm();
		// Account.enabled(true);
	}).fail(function() {
		// alert('terjadi kesalahan, coba lagi nanti..');
	});
}

$('#imageViewer').on('hidden.bs.modal', function (e) {
	// do something...
	// $('#ReviewModal').modal('hide');
	$('#ReviewModal').modal('show');
});

