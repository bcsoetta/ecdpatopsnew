(function($) {
var Valas = {
    params: {
        page: 1,
        dateFrom: '',
        dateUntil: '',
        docNumber: '',
        personalDetail: {},
        step2: {},
        // step3: {},
        cashNumber: 1,
        iplNumber: 1,
        confirmSave: 0,
        // itemDetailNumber: 1,
        instrumentNumber: 1,
        cashScore: 0,
        iplScore: 0,
		otherAttachmentNumber: 0,
		files: []
    },
    enabled: function(formName, value) {
        if (value) $('form[name="'+formName+'"]').find('[name^="search"], button').removeAttr('disabled');
        else $('form[name="'+formName+'"]').find('[name^="search"], button').attr('disabled', 'disabled');
    },
    myEncrypt: function(data) {
        var salt = 100*99*98*1*2*3;
	    return salt * data;
    },
	getDetail: function() {
		var row = $(this).closest('tr');
		var data = parseInt(row.attr('id'));
		
		var msg = {
			header_id: Valas.myEncrypt(data)
		}

		$.ajax({
			url: '/valas/get_detail',
			type: 'post',
			dataType: 'json',
			data: JSON.stringify(msg)
		}).done(function(result) {
			if (result) {
				var modal = $('#reviewModal');

				var dataPersonal = result.personal;

				/**
				 * =======================
				 *    No Dokumen
				 * =======================
				 */

				// Tgl dokumen
				var doc_date = new Date(dataPersonal.created_date);
				doc_date = doc_date.getDate() + '-' +
					(doc_date.getMonth()+1) + '-' +
					doc_date.getFullYear();

				modal.find('[view="no_dok"]').html(dataPersonal.doc_number);
				modal.find('[view="tgl_dok"]').html(doc_date);

				/**
				 * =======================
				 *    Data diri
				 * =======================
				 */

				// Tgl lahir
				var date_of_birth = new Date(dataPersonal.date_of_birth);
				dob_personal = date_of_birth.getDate() + '-' +
					(date_of_birth.getMonth()+1) + '-' +
					date_of_birth.getFullYear();

				modal.find('[view="name"]').html(dataPersonal.name);
				modal.find('[view="nationality"]').html(dataPersonal.nationality);
				modal.find('[view="identity"]').html(dataPersonal.identity_number);
				modal.find('[view="birth"]').html(dob_personal);
				modal.find('[view="address"]').html(dataPersonal.id_address);
				modal.find('[view="occupation"]').html(dataPersonal.occupation);
				modal.find('[view="country"]').html(dataPersonal.origin_country);

				/**
				 * =======================
				 *    Kepemilikan
				 * =======================
				 */

				switch (result.personal.reason) {
					case '1':
						var milik = 'Pribadi'
						break;

					case '2':
						var milik = 'Orang Lain'
						break;

					case '3':
						var milik = 'Perusahaan'
						break;
				
					default:
						var milik = ''
						break;
				}
				modal.find('[view="reason"]').html(milik);

				// Data pemilik lain pribadi
				var dataOther = result.others;
				if (dataOther.length === 0) {
					modal.find('[view="othername"]').html('');
					modal.find('[view="othernationality"]').html('');
					modal.find('[view="otheridentity"]').html('');
					modal.find('[view="otherbirth"]').html('');
					modal.find('[view="otheraddress"]').html('');
					modal.find('[view="otheroccupation"]').html('');
				} else {
					// Tgl lahir
					var date_of_birth = new Date(dataOther.date_of_birth);
					dob_other = date_of_birth.getDate() + '-' +
						(date_of_birth.getMonth()+1) + '-' +
						date_of_birth.getFullYear();

					modal.find('[view="othername"]').html(dataOther.name);
					modal.find('[view="othernationality"]').html(dataOther.nationality);
					modal.find('[view="otheridentity"]').html(dataOther.identity_number);
					modal.find('[view="otherbirth"]').html(dob_other);
					modal.find('[view="otheraddress"]').html(dataOther.address);
					modal.find('[view="otheroccupation"]').html(dataOther.occupation);
				}

				// Data pemilik lain perusahaan
				var dataCorp = result.corp;
				if (dataCorp.length === 0) {
					modal.find('[view="corporatename"]').html('');
					modal.find('[view="corporateaddress"]').html('');
					modal.find('[view="corporatetype"]').html('');
				} else {
					// Jenis Usaha
					switch (dataCorp.type) {
						case '1':
							var jenis_usaha = 'Bank'
							break;
	
						case '2':
							var jenis_usaha = 'Money Changer'
							break;
	
						case '3':
							var jenis_usaha = 'Lainnya'
							break;
					
						default:
							var jenis_usaha = ''
							break;
					}

					modal.find('[view="corporatename"]').html(dataCorp.name);
					modal.find('[view="corporateaddress"]').html(dataCorp.address);
					modal.find('[view="corporatetype"]').html(jenis_usaha);
				}

				/**
				 * =======================
				 *    Data perjalanan
				 * =======================
				 */

				// Tgl tiba
				var arrival_date = new Date(dataPersonal.arrival_date);
				arrival_date = arrival_date.getDate() + '-' +
					(arrival_date.getMonth()+1) + '-' +
					arrival_date.getFullYear();

				// Maksud perjalanan
				switch (dataPersonal.purpose_of_visit) {
					case '1':
						var purpose_of_visit = 'Bisnis/Dinas'
						break;

					case '2':
						var purpose_of_visit = 'Kunjungan/Liburan'
						break;

					case '3':
						var purpose_of_visit = 'Bekerja/Pelajar'
						break;

					case '4':
						var purpose_of_visit = 'Lainnya'
						break;
				
					default:
						var purpose_of_visit = ''
						break;
				}

				modal.find('[view="flightNumber"]').html(dataPersonal.flight_number);
				modal.find('[view="lastPort"]').html(dataPersonal.last_port);
				modal.find('[view="nextPort"]').html(dataPersonal.next_port);
				modal.find('[view="arrivalDate"]').html(arrival_date);
				modal.find('[view="indonesianaddress"]').html(dataPersonal.local_address);
				modal.find('[view="purpose"]').html(purpose_of_visit);

				/**
				 * =======================
				 *    Data uang
				 * =======================
				 */

				var cashTableBody = $('table#cashTableView > tbody');
				var dataCash = result.arrival_cash;
				var cashNumber = 0;

				cashTableBody.html('');
				dataCash.forEach(data => {
					cashNumber++
					var row = `
						<tr>
							<td>${cashNumber}</td>
							<td>${data['currency']}</td>
							<td>${data['amount']}</td>
						</tr>
					`;

					cashTableBody.append(row);
				});

				/**
				 * =======================================
				 *    Data instrumen pembayaran lainnya
				 * =======================================
				 */

				var instrumenTableBody = $('table#instrumentTableView > tbody');
				var dataInstrumen = result.arrival_ipl;
				var instrumenNumber = 0;

				instrumenTableBody.html('');
				dataInstrumen.forEach(data => {
					instrumenNumber++

					// Tgl tiba
					var instrument_date = new Date(data['date']);
					instrument_date = instrument_date.getDate() + '-' +
						(instrument_date.getMonth()+1) + '-' +
						instrument_date.getFullYear();

					var row = `
						<tr>
							<td>${instrumenNumber}</td>
							<td>${data['currency']}</td>
							<td>${data['amount']}</td>
							<td>${data['type']}</td>
							<td>${data['number']}</td>
							<td>${instrument_date}</td>
							<td>${data['bank']}</td>
						</tr>
					`;

					instrumenTableBody.append(row);
				});

				/**
				 * =======================
				 *    Data official
				 * =======================
				 */

				var is_count = (dataPersonal.is_count === '1') ? 'Ya' :'Tidak';
				var is_suspicious = (dataPersonal.is_suspicious === '1') ? 'Ya' :'Tidak';
				var is_permitted = (dataPersonal.is_permitted === '1') ? 'Ada' :'Tidak ada';
				var check_result = (dataPersonal.is_result === '1') ? 'Pemberitahuan Benar' :'Pemberitahuan Salah';
				var officer = dataPersonal.officer_name + ' (' + dataPersonal.officer_nip + ')'

				modal.find('[view="count"]').html(is_count);
				modal.find('[view="suspicion"]').html(is_suspicious);
				modal.find('[view="permit"]').html(is_permitted);
				modal.find('[view="result"]').html(check_result);
				modal.find('[view="officer"]').html(officer);

				/**
				 * =======================
				 *    Attachments
				 * =======================
				 */

				var attachmentTableBody = $('table#attachmentTableView > tbody');
				var dataAttachment = result.attachments;
				var attachmentsNumber = 0;

				attachmentTableBody.html('');
				dataAttachment.forEach(data => {
					attachmentsNumber++

					row = `
						<tr>
							<td>${attachmentsNumber}</td>
							<td>${data['jenis']}</td>
							<td><a href="assets/custom/valas/${data['name']}" target="blank">${data['name']}</a></td>
						</tr>
					`
					attachmentTableBody.append(row);
				});

				modal.modal('show');
			}
		});
	},
    printPage: function() {
        var row = $(this).closest('tr');
        var data = row.attr('id');
        var msg = myEncrypt(data);
        var base_url = window.location.origin + '/valas/print_doc/' + msg;
        var win = window.open(base_url, '_blank');
        if (win) {
            //Browser has allowed it to be opened
            win.focus();
        } else {
            //Browser has blocked it
            alert('Please allow popups for this website');
        }
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
            url: '/valas/delete',
            type: 'post',
            dataType: 'json',
            data: JSON.stringify(params)
        }).done(function(result) {
            if (result) {
                $('#deleteModal').modal('hide');
                Valas.doSearch();
            }
        }).fail(function() {
            alert('terjadi kesalahan, coba lagi nanti..');
        }).always(function() {
            Valas.enabled('searchValasForm', true);
        });
    },
    renderData: function(data) {
        var result = $('[name="searchResult"]');
        var template = result.find('[template="searchResultRow"]');
        var rows = result.find('tbody').empty();
        var nav = result.find('[name="searchNav"]');
        
        $.each(data.rows, function(index, value) {
            var row = template.clone().removeClass('d-none').removeAttr('template');
            row.attr('id', value.valas);
            row.find('[view="number"]').html(index + 1);
            row.find('[view="docNumber"]').html(value.docNumber);
            row.find('[view="arrivalDate"]').html(value.arrivalDate);
            row.find('[view="name"]').html(value.name);
            row.find('[view="passport"]').html(value.passport);
            // row.find('[view="location"]').html(value.location);
            row.find('[view="flightNumber"]').html(value.flightNumber);
            // row.find('[view="nominal"]').html(value.nominal);
            row.find('[view="country"]').html(value.country);

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
			row.find('[view="actionReview"]').on('click', Valas.getDetail);
			row.find('[view="actionDetail"]').on('click', Valas.printPage);
            row.find('[view="actionDelete"]').on('click', Valas.deleteData);
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
            page: Valas.params.page,
            dateFrom: Valas.params.dateFrom,
            dateUntil: Valas.params.dateUntil,
            docNumber: Valas.params.docNumber
        };

        $.ajax({
            url: '/valas/search',
            type: 'post',
            dataType: 'json',
            data: JSON.stringify(data)
        }).done(function(result) {
            if (result) {
                // Academics.search.result(result.searchResult);
                Valas.renderData(result.searchResult);
            }
        }).fail(function() {
            alert('terjadi kesalahan, coba lagi nanti..');
        }).always(function() {
            Valas.enabled('searchValasForm', true);
        });
    },
    removeItems: function() {
        var row = $(this).closest('tr');
        var params = $(this).attr('action');
        row.remove();

        // set score -1
        if (params == 'ipl') {
            Valas.params.iplScore--;
        } else {
            Valas.params.cashScore--; 
        } 
    },
    clearContent: function() {
        // find all input type and clear
        $('form[name="newValasForm"]').find('input, select').val('');
		$('form[name="newValasForm"]').find('radio').val('1');
		$('form[name="cashForm"]').find('input').val('');
		$('form[name="instrumentForm"]').find('input, select').val('');
		$('input[type="file"]').each(function() {
			if($(this)[0].files.length){
				$(this).val('');
			}
		});

        // find ajax tbody and clear it
        $('table[name="cashTable"]').find('tbody').empty();
        $('table[name="instrumentTable"]').find('tbody').empty();

		// Reset params
		Valas.params.otherAttachmentNumber = 0;
		Valas.params.files = [];
    },
    createNew: function() {
        Valas.enabled('searchValasForm', false);

        var params = {
            step1: Valas.params.personalDetail, step2: Valas.params.step2
        };

        $.ajax({
            url: '/valas/create_new',
            type: 'post',
            dataType: 'json',
            data: JSON.stringify(params)
        }).done(function(result) {
            if (result) {
				Valas.uploadFiles(result);
                // action after save
                alert('Data berhasil disimpan..');
                $('#newValasModalStep2').modal('hide');
                Valas.params.confirmSave = 0;
                Valas.doSearch();
                // clear all content
                Valas.clearContent();
            }
        }).fail(function() {
            alert('terjadi kesalahan, coba lagi nanti..');
        }).always(function() {
            Valas.enabled('searchValasForm', true);
        });
    },
	verifyFiles: function() {
		/**
		 * ==============================
		 *    Default attachments
		 * ==============================
		 */
		defaultAttachments = $('div#defaultAttachment');

		// Verify passport
		var filePassport = defaultAttachments.find('#attachPassport').prop('files')[0];
		if (filePassport) {
			let fileValidity = Valas.verifyFile(filePassport, 'PASSPORT');
			if (fileValidity == false) { return false };
		}

		// Verify KTP
		var fileKtp = defaultAttachments.find('#attachKtp').prop('files')[0];
		if (fileKtp) {
			let fileValidity = Valas.verifyFile(fileKtp, 'KTP');
			if (fileValidity == false) { return false };
		}

		// Verify CD
		var fileCd = defaultAttachments.find('#attachCd').prop('files')[0];
		if (fileCd) {
			let fileValidity = Valas.verifyFile(fileCd, 'CD');
			if (fileValidity == false) { return false };
		}

		// Verify BI permit
		var filePermit = defaultAttachments.find('#attachPermit').prop('files')[0];
		if (filePermit) {
			let fileValidity = Valas.verifyFile(filePermit, 'IZIN BI');
			if (fileValidity == false) { return false };
		}

		/**
		 * ==============================
		 *    Other attachments
		 * ==============================
		 */
		var filesValidity = true;
		$('div#otherAttachments > div.anotherAttachment').each(function () {
			var fileRemark = $(this).find('input.file-remark').val();
			var fileAttachment = $(this).find('input.file-attachment').prop('files')[0];
			if (fileAttachment) {
				let fileValidity = Valas.verifyFile(fileAttachment, fileRemark);
				if (fileValidity == false) { 
					filesValidity = false; 
				};
			}
		});
		if (filesValidity == false) {
			return false;
		}

		return true
	},
	verifyFile: function(fileData, remark) {
		if (fileData.size > 0) {
			if (fileData.size > 2000000) {
				alert('Ukuran Max. file 2Mb');
				return false
			} else {
				if (Valas.params.confirmSave == 1) {
					Valas.params.files.push({remark: remark, file: fileData});	
				}
			}
		}
	},
	uploadFiles: function (header_id) {
		Valas.params.files.forEach(upload => {
			Valas.uploadFile(upload, header_id);
		});
	},
	uploadFile: function(upload, header_id) {
		var formData =  new FormData();
		formData.append('header_id', header_id);
		formData.append('file', upload['file']);
		formData.append('remark', upload['remark']);
		$.ajax({
			url: '/valas/upload_file',
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
		});
	},
    init: function() {
		// new money functions
		$('#btnAddCash').on('click', function() {
            $('#cashModal').modal('show');
        });
		$('[name="cashForm"]').on('submit', function() {
			var cashCurrency = $(this).find('[name="cashCurrency"]').val();
			var cashAmount = $(this).find('[name="cashAmount"]').val();

			if (cashCurrency == "" || cashAmount == "") {
				alert('currency atau mata uang tidak boleh kosong');
				return false;
			}
			
			var result = $('table[name="cashTable"]');
			var template = result.find('[template="cashBody"]');
			var rows = result.find('tbody');

			var row = template.clone().removeClass('d-none').removeAttr('template');
			row.find('[view="cashNumber"]').html(Valas.params.cashNumber);
            row.find('[view="cashCurrency"]').html(cashCurrency);
            row.find('[view="cashAmount"]').html(cashAmount);

			// remove items
            row.find('[view="cashAction"]').attr('action', 'cash');
            row.find('[view="cashAction"]').on('click', Valas.removeItems);

            row.appendTo(rows);
			Valas.params.itemDetailNumber = Valas.params.cashNumber + 1;
            $('#cashModal').modal('hide');

            //set cash score
            Valas.params.cashScore++;
			return false;
		});

        // new function of ipl
        $('#btnAddInstrument').on('click', function() {
            $('#instrumentModal').modal('show');
        });
        $('[name="instrumentForm"]').on('submit', function() {
            var instrumentValas = $(this).find('[name="instrumentValas"]').val();
            var instrumentNominal = $(this).find('[name="instrumentNominal"]').val();
            var instrumentType = $(this).find('[name="instrumentType"]').val();
            var instrunetTypeText = $('select[name=instrumentType] option:selected').text();
            var instrumentNumber = $(this).find('[name="instrumentNumber"]').val();
            var instrumentDate = $(this).find('[name="instrumentDate"]').val();
            var instrumentBank = $(this).find('[name="instrumentBank"]').val();

            var result = $('table[name="instrumentTable"]');
            var template = result.find('[template="instrumentBody"]');
            var rows = result.find('tbody');

            var row = template.clone().removeClass('d-none').removeAttr('template');
            row.find('[view="instrumentNumber"]').html(Valas.params.instrumentNumber);
            row.find('[view="instrumentValas"]').html(instrumentValas);
            row.find('[view="instrumentDenom"]').html(instrumentNominal);
            row.find('[view="instrumentType"]').attr('instrument-value', instrumentType);
            row.find('[view="instrumentType"]').html(instrunetTypeText);
            row.find('[view="instrumentNumberContent"]').html(instrumentNumber);
            row.find('[view="instrumentDate"]').html(instrumentDate);
            row.find('[view="instrumentBank"]').html(instrumentBank);
            
            // remove items
            row.find('[view="instrumentAction"]').attr('action', 'ipl');
            row.find('[view="instrumentAction"]').on('click', Valas.removeItems);
            row.appendTo(rows);
            Valas.params.itemDetailNumber = Valas.params.instrumentNumber + 1;
            $('#instrumentModal').modal('hide');

            Valas.params.iplScore++;
            return false;
        });

		/**
		 * =====================================
		 *    Functions for attachments 
		 * =====================================
		 */

		// Display permit attachment form
		$(document).on("change", "input[name='is_permitted']", function () {
			if ($(this).val() == '0') {
				$('input#attachPermit').prop('required', false);
				$('div#BiPermit').hide();
			} else {
				$('input#attachPermit').prop('required', true);
				$('div#BiPermit').show();
			}
		});

		// Add new attachment
		$('#btnAddAttachment').on('click', function () {
			Valas.params.otherAttachmentNumber++
			let attachmentNumber = Valas.params.otherAttachmentNumber

			var remarkId = `anotherAttachmentRemark${attachmentNumber}`;
			var attachmentId = `anotherAttachmentFile${attachmentNumber}`;
			var attachmentElement = `
				<div class="row anotherAttachment" number="${attachmentNumber}">
					<div class="form-group col-sm-2">
						<label for="${remarkId}">Keterangan</label>
						<input type="text" id="${remarkId}" class="form-control file-remark" />
					</div>
					<div class="form-group col-sm-9">
						<label for="${attachmentId}">File</label>
						<input type="file" id="${attachmentId}" class="form-control file-attachment" accept="image/png, image/jpeg, document/pdf" />
					</div>
					<div class="col-sm-1">
						<label>&nbsp;</label>
						<button type="button" class="btn btn-sm btn-danger form-control btn-remove-attachment" value="${attachmentNumber}">
							<i class="fa fa-trash"></i>
						</button>
					</div>
				</div>
			`;
			
			var divOtherAttachments = $('div#otherAttachments');
			divOtherAttachments.append(attachmentElement)

			// Remove attachment
			$('button.btn-remove-attachment').on('click', function () {
				var attahcmentNumber = $(this).val();
				$(`div.anotherAttachment[number='${attahcmentNumber}']`).remove();
			})
		});

        // end function
        Valas.doSearch();
        
        $('#dateFrom, #dateUntil, #birth, #other_birth, #arrival_date, #instrumentDate').datepicker({
            todayHighlight: true,
            orientation: "bottom left",
            format: 'yyyy-mm-dd'
        });
        
		/**
		 * =====================================
		 *    Dynamic forms by input value 
		 * =====================================
		 */

		// Kepemilikan
        $('select[name=reason]').change(function(){
            var value = $(this).val();
			
			if (value == "2") {
				// Milik orang lain
                $('div[name="othersTemplate"]').removeClass('d-none');
				$('div[name="othersTemplate"] .form-control').prop('required', true);
				$('div[name="othersTemplate"] #other_rt').prop('required', false);
				$('div[name="othersTemplate"] #other_rw').prop('required', false);
				$('div[name="othersTemplate"] #other_postal_code').prop('required', false);
                $('div[name="companyTemplate"]').addClass('d-none');
				$('div[name="companyTemplate"] input').val('');
				$('div[name="companyTemplate"] select').val('').change();
				$('div[name="companyTemplate"] .form-control').prop('required', false);
            } else if (value == "3") {
				// Milik perusahaan
                $('div[name="othersTemplate"]').addClass('d-none');
				$('div[name="othersTemplate"] input').val('');
				$('div[name="othersTemplate"] select').val('').change();
				$('div[name="othersTemplate"] .form-control').prop('required', false);
                $('div[name="companyTemplate"]').removeClass('d-none');
				$('div[name="companyTemplate"] .form-control').prop('required', true);
				$('div[name="companyTemplate"] #corp_rt').prop('required', false);
				$('div[name="companyTemplate"] #corp_rw').prop('required', false);
				$('div[name="companyTemplate"] #corp_postal_code').prop('required', false);
            } else {
				// Default
				$('div[name="othersTemplate"]').addClass('d-none');
				$('div[name="othersTemplate"] input').val('');
				$('div[name="othersTemplate"] select').val('').change();
				$('div[name="othersTemplate"] .form-control').prop('required', false);
				$('div[name="companyTemplate"]').addClass('d-none');
				$('div[name="companyTemplate"] input').val('');
				$('div[name="companyTemplate"] select').val('').change();
				$('div[name="companyTemplate"] .form-control').prop('required', false);
			}
			$('div.bs-searchbox .form-control').prop('required', false);
        });

		// Negara
		$('#id_country, #other_country, #corp_country').change(function() {
			var id = $(this).attr('id');
			var type = id.replace('_country', '');
			var value = $(this).val();

			if (value == 76 || value == "") {
				$(`input[name="${type}_rt"]`).prop('disabled', false);
				$(`input[name="${type}_rw"]`).prop('disabled', false);
				$(`input[name="${type}_kecamatan"]`).prop('disabled', false);
				$(`input[name="${type}_kelurahan"]`).prop('disabled', false);
				$(`input[name="${type}_kecamatan"]`).prop('required', true);
				$(`input[name="${type}_kelurahan"]`).prop('required', true);
			} else {
				$(`input[name="${type}_rt"]`).prop('disabled', true);
				$(`input[name="${type}_rw"]`).prop('disabled', true);
				$(`input[name="${type}_kecamatan"]`).prop('disabled', true);
				$(`input[name="${type}_kelurahan"]`).prop('disabled', true);
				$(`input[name="${type}_kecamatan"]`).prop('required', false);
				$(`input[name="${type}_kelurahan"]`).prop('required', false);
				$(`input[name="${type}_rt"]`).val('');
				$(`input[name="${type}_rw"]`).val('');
				$(`input[name="${type}_kecamatan"]`).val('');
				$(`input[name="${type}_kelurahan"]`).val('');
			}
		})

        $('#add_valas').on('click', function() {
            // set value cash & ipl to zero
            Valas.params.iplScore = 0;
            Valas.params.cashScore = 0;
            // modal show
            // $("input[name=reason][value='1']").attr('checked', 'checked');
            // $('input[name=reason]:checked' ).val('1');
            $('div[name="othersTemplate"]').addClass('d-none');
            $('div[name="companyTemplate"]').addClass('d-none');
            $('#newValasModal').modal('show');
        });

        $('form[name="searchValasForm"]').on('submit', function() {
            Valas.enabled($(this).attr('name'), false);

            var dateFrom = $(this).find('[name="dateFrom"]').val();
            var dateUntil = $(this).find('[name="dateUntil"]').val();
            var docNumber = $(this).find('[name="docNumber"]').val();

            Valas.params.dateFrom = dateFrom;
            Valas.params.dateUntil = dateUntil;
            Valas.params.docNumber = docNumber;

            Valas.doSearch();

            return false;
        });

        /**
		 * =====================================
		 *    Submit form step 1 
		 * =====================================
		 */
        $('form[name="newValasForm"]').on('submit', function() {
			// Personal data
            var name = $(this).find('[name="name"]').val();
            var nationality = $(this).find('[name="nationality"]').val();
            var identity = $(this).find('[name="identity"]').val();
            var birth = $(this).find('[name="birth"]').val();
            var occupation = $(this).find('[name="occupation"]').val();
			var id_street = $(this).find('[name="id_street"]').val();
			var id_rt = $(this).find('[name="id_rt"]').val();
			var id_rw = $(this).find('[name="id_rw"]').val();
			var id_country = $(this).find('[name="id_country"]').val();
			var id_province = $(this).find('[name="id_province"]').val();
			var id_city = $(this).find('[name="id_city"]').val();
			var id_kecamatan = $(this).find('[name="id_kecamatan"]').val();
			var id_kelurahan = $(this).find('[name="id_kelurahan"]').val();
			var id_postal_code = $(this).find('[name="id_postal_code"]').val();
            var reason = $(this).find('select[name=reason]').val();
            
            // Travel data
            var flight_number = $(this).find('[name="flight_number"]').val();
            var last_port = $(this).find('[name="last_port"]').val();
            var next_port = $(this).find('[name="next_port"]').val();
            var arrival_date = $(this).find('[name="arrival_date"]').val();
            var local_street = $(this).find('[name="local_street"]').val();
			var local_rt = $(this).find('[name="local_rt"]').val();
			var local_rw = $(this).find('[name="local_rw"]').val();
			var local_province = $(this).find('[name="local_province"]').val();
			var local_city = $(this).find('[name="local_city"]').val();
			var local_kecamatan = $(this).find('[name="local_kecamatan"]').val();
			var local_kelurahan = $(this).find('[name="local_kelurahan"]').val();
			var local_postal_code = $(this).find('[name="local_postal_code"]').val();
            var purpose = $(this).find('[name="purpose"]').val();

            // other personal data
            var other_name = $(this).find('[name="other_name"]').val();
            var other_nationality = $(this).find('[name="other_nationality"]').val();
            var other_identity = $(this).find('[name="other_identity"]').val();
            var other_birth = $(this).find('[name="other_birth"]').val();
            var other_occupation = $(this).find('[name="other_occupation"]').val();
			var other_street = $(this).find('[name="other_street"]').val();
			var other_rt = $(this).find('[name="other_rt"]').val();
			var other_rw = $(this).find('[name="other_rw"]').val();
			var other_country = $(this).find('[name="other_country"]').val();
			var other_province = $(this).find('[name="other_province"]').val();
			var other_city = $(this).find('[name="other_city"]').val();
			var other_kecamatan = $(this).find('[name="other_kecamatan"]').val();
			var other_kelurahan = $(this).find('[name="other_kelurahan"]').val();
			var other_postal_code = $(this).find('[name="other_postal_code"]').val();
            
            // company
            var corporate_name = $(this).find('[name="corporate_name"]').val();
            var corporate_type = $(this).find('select[name="corporate_type"]').val();
			var corp_street = $(this).find('[name="corp_street"]').val();
			var corp_rt = $(this).find('[name="corp_rt"]').val();
			var corp_rw = $(this).find('[name="corp_rw"]').val();
			var corp_country = $(this).find('[name="corp_country"]').val();
			var corp_province = $(this).find('[name="corp_province"]').val();
			var corp_city = $(this).find('[name="corp_city"]').val();
			var corp_kecamatan = $(this).find('[name="corp_kecamatan"]').val();
			var corp_kelurahan = $(this).find('[name="corp_kelurahan"]').val();
			var corp_postal_code = $(this).find('[name="corp_postal_code"]').val();

            var params = {
                personal: {
                    name: name, 
					nationality: nationality, 
					identity: identity, 
					birth: birth, 
					occupation: occupation,
					id_street: id_street,
					id_rt: id_rt,
					id_rw: id_rw,
					id_country: id_country,
					id_province: id_province,
					id_city: id_city,
					id_kecamatan: id_kecamatan,
					id_kelurahan: id_kelurahan,
					id_postal_code: id_postal_code,
                    reason: reason, 
                },
                travel: {
                    flight_number: flight_number,
					last_port: last_port,
					next_port: next_port,
					arrival_date: arrival_date,
					local_street: local_street,
					local_rt: local_rt,
					local_rw: local_rw,
					local_province: local_province,
					local_city: local_city,
					local_kecamatan: local_kecamatan,
					local_kelurahan: local_kelurahan,
					local_postal_code: local_postal_code,
					purpose: purpose,
                },
                others: {
                    other_name: other_name,
					other_nationality: other_nationality,
					other_identity: other_identity,
					other_birth: other_birth,
					other_occupation: other_occupation,
					other_street: other_street,
					other_rt: other_rt,
					other_rw: other_rw,
					other_country: other_country,
					other_province: other_province,
					other_city: other_city,
					other_kecamatan: other_kecamatan,
					other_kelurahan: other_kelurahan,
					other_postal_code: other_postal_code,
                },
                corporate: {
                    corporate_name: corporate_name,
					corporate_type: corporate_type,
					corp_street: corp_street,
					corp_rt: corp_rt,
					corp_rw: corp_rw,
					corp_country: corp_country,
					corp_province: corp_province,
					corp_city: corp_city,
					corp_kecamatan: corp_kecamatan,
					corp_kelurahan: corp_kelurahan,
					corp_postal_code: corp_postal_code,
                }
            };
            // console.log(params);
            Valas.params.personalDetail = params;
            // set new modal
            $('#newValasModal').modal('hide');
            $('#newValasModalStep2').modal('show');
            return false;
        });

        /**
		 * =====================================
		 *    Submit form step 2 
		 * =====================================
		 */
        $('form[name="newValasFormStep2"]').on('submit', function() {
            var theTable = $('table[name="cashTable"]');
            var instrumentTable = $('table[name="instrumentTable"]');
            var rows = theTable.find('tr');
            var instrumentRows = instrumentTable.find('tr');

            var params = {
                cash: [],
                ipl: [],
                reason: '',
                type: '1',
                count: '',
                suspicious: '',
                result: '',
				permit: ''
            };

            var cashReason = $(this).find('[name="cashReason"]').val();
            // new input
            var suspicious = $(this).find('input[name=is_suspicious]:checked' ).val(),
                result = $(this).find('input[name=is_result]:checked' ).val(),
                count = $(this).find('input[name=is_count]:checked' ).val(),
				permit = $(this).find('input[name=is_permitted]:checked' ).val();
                
            params.reason = cashReason;
            params.suspicious = suspicious;
            params.result = result;
            params.count = count;
			params.permit = permit;

            // cash
            rows.each(function (i, el) {
                var $tds = $(this).find('td'),
                    cashCurrency = $tds.eq(1).text(),
                    cashAmount = $tds.eq(2).text();

                if (cashCurrency != '' || cashAmount != '') {
                    var pushCash = {
                        currency: cashCurrency, amount: cashAmount
                    }

                    params.cash.push(pushCash);
                }   
            });

            // instrument new
            instrumentRows.each(function (i, el) {
                var $tds = $(this).find('td'),
                    inValas = $tds.eq(1).text(),
                    inNominal = $tds.eq(2).text(),
                    inType = $tds.eq(3).attr('instrument-value'),
                    inNUmber = $tds.eq(4).text(),
                    inDate = $tds.eq(5).text(),
                    inBank = $tds.eq(6).text();

                if (inValas != '' || inNominal != '' || inType != '') {
                    var pushInstrument = {
                        valas: inValas, nominal: inNominal, type: inType, number: inNUmber, date: inDate, bank: inBank
                    }

                    params.ipl.push(pushInstrument);
                }      
            });
            
            // dont save if no ipl or cash
            if (Valas.params.iplScore == 0  && Valas.params.cashScore == 0) {
                alert('Data cash atau IPL tidak boleh kosong');
                return false;
            }

			let fileValidity = Valas.verifyFiles()
			if (!fileValidity) {
				return false
			}

            Valas.params.step2 = params;
            // confirm first then create
            if (Valas.params.confirmSave == 0) {
                $('#confirmModal').modal('show');  
            } else {
                Valas.createNew();
            }
            
            return false;
        }); 

        $('button[name="confirmYes"]').on('click', function() {
            // show previous page
            $('#confirmModal').modal('hide');
            $('#newValasModalStep2').modal('hide');
            $('#newValasModal').modal('show');
            
            Valas.params.confirmSave = 1;
        });

        /**
		 * =====================================
		 *    Pagination 
		 * =====================================
		 */

        //nav function
        $('[name="next"]').on('click', function(){
            Valas.params.page = Valas.params.page + 1;
            Valas.doSearch();
        });
        $('[name="prev"]').on('click', function(){
            Valas.params.page = Valas.params.page - 1;
            Valas.doSearch();
        });

        // back function
        $('button[name="btnBack"]').on('click', function() {
            $('#newValasModalStep2').modal('hide');
            $('#newValasModal').modal('show');
        });
        
        $('button[name="confirmDelete"]').on('click', function() {
            Valas.deleteDataServer();
        });
    }
};

Valas.init();

})(jQuery);