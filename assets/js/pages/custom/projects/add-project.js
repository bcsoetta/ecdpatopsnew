"use strict";

// Class definition
var KTProjectsAdd = function () {
	// Base elements
	var _wizardEl;
	var _formEl;
	var _wizardObj;
	var _validations = [];

	// Private functions
	var _initWizard = function () {
		// Initialize form wizard
		_wizardObj = new KTWizard(_wizardEl, {
			startStep: 1, // initial active step number
			clickableSteps: false  // allow step clicking
		});

		// Validation before going to next page
		_wizardObj.on('change', function (wizard) {
			if (wizard.getStep() > wizard.getNewStep()) {
				return; // Skip if stepped back
			}

			// Validate form before change wizard step
			var validator = _validations[wizard.getStep() - 1]; // get validator for currnt step

			if (validator) {
				validator.validate().then(function (status) {
					if (status == 'Valid') {
						wizard.goTo(wizard.getNewStep());

						KTUtil.scrollTop();
					} else {
						Swal.fire({
							text: "Sorry, looks like there are some errors detected, please try again.",
							icon: "error",
							buttonsStyling: false,
							confirmButtonText: "Ok, got it!",
							customClass: {
								confirmButton: "btn font-weight-bold btn-light"
							}
						}).then(function () {
							KTUtil.scrollTop();
						});
					}
				});
			}

			return false;  // Do not change wizard step, further action will be handled by he validator
		});

		// Change event
		_wizardObj.on('changed', function (wizard) {
			KTUtil.scrollTop();
		});

		// Submit event
		_wizardObj.on('submit', function (wizard) {
			Swal.fire({
				text: "All is good! Please confirm the form submission.",
				icon: "success",
				showCancelButton: true,
				buttonsStyling: false,
				confirmButtonText: "Yes, submit!",
				cancelButtonText: "No, cancel",
				customClass: {
					confirmButton: "btn font-weight-bold btn-primary",
					cancelButton: "btn font-weight-bold btn-default"
				}
			}).then(function (result) {
				if (result.value) {
					_formEl.submit(); // Submit form
				} else if (result.dismiss === 'cancel') {
					Swal.fire({
						text: "Your form has not been submitted!.",
						icon: "error",
						buttonsStyling: false,
						confirmButtonText: "Ok, got it!",
						customClass: {
							confirmButton: "btn font-weight-bold btn-primary",
						}
					});
				}
			});
		});
	}

	var _initValidation = function () {
		// Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/
		// Step 1
		_validations.push(FormValidation.formValidation(
			_formEl,
			{
				fields: {
					fullname: {
						validators: {
							notEmpty: {
								message: 'Fullname is required'
							}
						}
					},
					address: {
						validators: {
							notEmpty: {
								message: 'Address name is required'
							}
						}
					},
					phone: {
						validators: {
							notEmpty: {
								message: 'Phone is required'
							}
						}
					},
					email: {
						validators: {
							notEmpty: {
								message: 'Email is required'
							},
							emailAddress: {
								message: 'The value is not a valid email address'
							}
						}
					},
					purpose: {
						validators: {
							notEmpty: {
								message: 'Purposes is required'
							}
						}
					},
					ktp: {
						validators: {
							notEmpty: {
								message: 'National Identity Number is required'
							}
						}
					},
					ktp_pict: {
						validators: {
							notEmpty: {
								message: 'KTP picture is required'
							}
						}
					},
					selfie_pict: {
						validators: {
							notEmpty: {
								message: 'Selfie picture is required'
							}
						}
					},
					nopeg: {
						validators: {
							notEmpty: {
								message: 'Employee Number is required'
							}
						}
					}
				},
				plugins: {
					trigger: new FormValidation.plugins.Trigger(),
					// Bootstrap Framework Integration
					bootstrap: new FormValidation.plugins.Bootstrap({
						//eleInvalidClass: '',
						eleValidClass: '',
					})
				}
			}
		));

		// Step 2
		// _validations.push(FormValidation.formValidation(
		// 	_formEl,
		// 	{
		// 		fields: {
		// 			// Step 2
		// 			ktp: {
		// 				validators: {
		// 					notEmpty: {
		// 						message: 'National Identity Number is required'
		// 					}
		// 				}
		// 			},
		// 			ktp_pict: {
		// 				validators: {
		// 					notEmpty: {
		// 						message: 'KTP picture is required'
		// 					}
		// 				}
		// 			},
		// 			profile_avatar: {
		// 				validators: {
		// 					notEmpty: {
		// 						message: 'Selfie picture is required'
		// 					}
		// 				}
		// 			}
					
		// 		},
		// 		plugins: {
		// 			trigger: new FormValidation.plugins.Trigger(),
		// 			// Bootstrap Framework Integration
		// 			bootstrap: new FormValidation.plugins.Bootstrap({
		// 				//eleInvalidClass: '',
		// 				eleValidClass: '',
		// 			})
		// 		}
		// 	}
		// ));

		// Step 3
		// _validations.push(FormValidation.formValidation(
		// 	_formEl,
		// 	{
		// 		fields: {
		// 			nopeg: {
		// 				validators: {
		// 					notEmpty: {
		// 						message: 'Employee Number is required'
		// 					}
		// 				}
		// 			}
		// 		},
		// 		plugins: {
		// 			trigger: new FormValidation.plugins.Trigger(),
		// 			// Bootstrap Framework Integration
		// 			bootstrap: new FormValidation.plugins.Bootstrap({
		// 				//eleInvalidClass: '',
		// 				eleValidClass: '',
		// 			})
		// 		}
		// 	}
		// ));
	}

	return {
		// public functions
		init: function () {
			_wizardEl = KTUtil.getById('kt_projects_add');
			_formEl = KTUtil.getById('kt_projects_add_form');

			_initWizard();
			_initValidation();
		}
	};
}();

jQuery(document).ready(function () {
	KTProjectsAdd.init();
});
