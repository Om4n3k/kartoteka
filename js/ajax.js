$(document).ready(function(){
	// logout
	$('a[href=a--Logout]').click(function(){
		$.ajax({
			url: "inc/logout.php",
			type: "POST",
			success: function(msg) {
				$.notify({
					// options
					message: 'Wylogowano poprawnie' 
				},{
					// settings
					type: 'success',
					placement: {
						from: "top",
						align: "center"
					},
				});
				setTimeout(function(){window.location.reload()}, 1500);
			},
			error: function() {
				alert('error');
			}
        });
		return false;
	});

	$('a[href=a--DeleteUser').click(function(){
		let id = $(this).attr('uid');
		$.ajax({
			url: "inc/police_delete.php",
			type: "POST",
			dataType: "json",
			data: `&id=${id}`,
			success: function(msg) {
				if(msg.result) {
					$.notify({
						// options
						message: `Poprawnie usunięto policjanta o ID ${id}` 
					},{
						// settings
						type: 'success',
						placement: {
							from: "top",
							align: "center"
						},
					});
				} else {
					$.notify({
						// options
						message: msg.reason 
					},{
						// settings
						type: 'danger',
						placement: {
							from: "top",
							align: "center"
						},
					});
				}
			},
			error: function() {
				alert('error');
			}
        });
		return false;
	});

	$('a[href=a--LevelUserUp').click(function(){
		let id = $(this).attr('uid');
		$.ajax({
			url: "inc/police_levelUp.php",
			type: "POST",
			dataType: "json",
			data: `&id=${id}`,
			success: function(msg) {
				$.notify({
					// options
					message: msg.reason 
				},{
					// settings
					type: (msg.result) ? 'success' : 'danger',
					placement: {
						from: "top",
						align: "center"
					},
				});
			},
			error: function() {
				alert('error');
			}
        });
		return false;
	});

	$('a[href=a--LevelUserDown').click(function(){
		let id = $(this).attr('uid');
		$.ajax({
			url: "inc/police_levelDown.php",
			type: "POST",
			dataType: "json",
			data: `&id=${id}`,
			success: function(msg) {
				$.notify({
					// options
					message: msg.reason 
				},{
					// settings
					type: (msg.result) ? 'success' : 'danger',
					placement: {
						from: "top",
						align: "center"
					},
				});
			},
			error: function() {
				alert('error');
			}
        });
		return false;
	});

	$('a[href=a--DeleteKartoteka').click(function(){
		let id = $(this).attr('uid');
		let link = $(this);
		$.ajax({
			url: "inc/kartoteka_delete.php",
			type: "POST",
			dataType: "json",
			data: `&id=${id}`,
			success: function(msg) {
				$.notify({
					// options
					message: msg.reason 
				},{
					// settings
					type: (msg.result) ? 'success' : 'danger',
					placement: {
						from: "top",
						align: "center"
					},
				});
				link.parent().parent().fadeOut(500);
			},
			error: function() {
				alert('error');
			}
        });
		return false;
	});

	$('a[href=a--ArchivKartoteka').click(function(){
		let id = $(this).attr('uid');
		$.ajax({
			url: "inc/kartoteka_archiv.php",
			type: "POST",
			dataType: "json",
			data: `&id=${id}`,
			success: function(msg) {
				$.notify({
					// options
					message: msg.reason 
				},{
					// settings
					type: (msg.result) ? 'success' : 'danger',
					placement: {
						from: "top",
						align: "center"
					},
				});
			},
			error: function() {
				alert('error');
			}
        });
		return false;
	});

	$('#form_police_add').submit(function(e){
		let imie = $('#p_name').val();
		let nazwisko = $('#p_surname').val();
		let haslo = $('#p_password').val();
		let poziom = $('#p_level').val();
		let login = $('#p_login').val();

		$.ajax({
			url: "inc/police_add.php",
			type: "POST",
			dataType: "json",
			data: `&name=${imie}&surname=${nazwisko}&password=${haslo}&level=${poziom}&login=${login}`,
			success: function(msg) {
				if(msg.result) {
					$.notify({
						// options
						message: `Poprawnie dodano policjanta ${imie} ${nazwisko}` 
					},{
						// settings
						type: 'success',
						placement: {
							from: "top",
							align: "center"
						},
					});
				} else {
					$.notify({
						// options
						message: msg.reason 
					},{
						// settings
						type: 'danger',
						placement: {
							from: "top",
							align: "center"
						},
					});
				}
			},
			error: function() {
				alert('error');
			}
        });

		e.preventDefault();
	});

	function readURL(input,id) {

		if (input.files && input.files[0]) {
			var reader = new FileReader();
	
			reader.onload = function(e) {
			  $(id).attr('src', e.target.result);
			}
	
			reader.readAsDataURL(input.files[0]);
		}
	}
	
	$("input[name=k_driver]").change(function() {
	  readURL(this,'#driver_preview');
	});

	$("input[name=k_photo]").change(function() {
	  readURL(this,'#photo_preview');
	});

	$('#form_kartoteka_add').on('submit',(function(e){
		$.ajax({
			url: "inc/kartoteka_add.php",
			type: "POST",
			contentType: false,
			cache: false,
			processData:false,
			data: new FormData(this),
			success: function(msg) {
				let obj = jQuery.parseJSON(msg);
				if(obj.result) {
					$.notify({
						// options
						message: `Poprawnie dodano wpis do kartoteki obywatela` 
					},{
						// settings
						type: 'success',
						placement: {
							from: "top",
							align: "center"
						},
					});
					if(obj.driver_license) {
						$('#driver_preview').attr('src', e.target.result);
					}
					if(obj.photo) {
						$('#photo_preview').attr('src', e.target.result);
					}
				} else {
					$.notify({
						// options
						message: obj.reason 
					},{
						// settings
						type: 'danger',
						placement: {
							from: "top",
							align: "center"
						},
					});
				}
			},
			error: function() {
				alert('error');
			}
        });

		e.preventDefault();
	}));

	$('#form_kartoteka_edit').on('submit',(function(e){
		$.ajax({
			url: "inc/kartoteka_edit.php",
			type: "POST",
			contentType: false,
			cache: false,
			processData:false,
			data: new FormData(this),
			success: function(msg) {
				let obj = jQuery.parseJSON(msg);
				if(obj.result) {
					$.notify({
						// options
						message: `Poprawnie edytowano wpis w kartotece` 
					},{
						// settings
						type: 'success',
						placement: {
							from: "top",
							align: "center"
						},
					});
				} else {
					$.notify({
						// options
						message: obj.reason 
					},{
						// settings
						type: 'danger',
						placement: {
							from: "top",
							align: "center"
						},
					});
				}
			},
			error: function() {
				alert('error');
			}
        });

		e.preventDefault();
	}));

	$('#form_report_add').on('submit',(function(e){
		$.ajax({
			url: "inc/report_add.php",
			type: "POST",
			contentType: false,
			cache: false,
			processData:false,
			data: new FormData(this),
			success: function(msg) {
				let obj = jQuery.parseJSON(msg);
				if(obj.result) {
					$.notify({
						// options
						message: `Poprawnie dodano raport` 
					},{
						// settings
						type: 'success',
						placement: {
							from: "top",
							align: "center"
						},
					});
				} else {
					$.notify({
						// options
						message: obj.reason 
					},{
						// settings
						type: 'danger',
						placement: {
							from: "top",
							align: "center"
						},
					});
				}
			},
			error: function() {
				alert('error');
			}
    });

		e.preventDefault();
	}));

	$('a[href=a--DeleteRaport').click(function(){
		let id = $(this).attr('id');
		let link = $(this);
		$.ajax({
			url: "inc/report_delete.php",
			type: "POST",
			dataType: "json",
			data: `&id=${id}`,
			success: function(msg) {
				$.notify({
					// options
					message: msg.reason 
				},{
					// settings
					type: (msg.result) ? 'success' : 'danger',
					placement: {
						from: "top",
						align: "center"
					},
				});
				link.parent().parent().fadeOut(500);
			},
			error: function() {
				alert('error');
			}
        });
		return false;
	});

	$('#form_save_settings_main').submit(function(e){
		let login = $('#u_login').val();
		let name = $('#u_name').val();
		let surname = $('#u_surname').val();

		$.ajax({
			url: "inc/account_settings.php",
			type: "POST",
			dataType: "json",
			data: `&login=${login}&name=${name}&surname=${surname}`,
			success: function(msg) {
				if(msg.result) {
					$.notify({
						// options
						message: msg.reason
					},{
						// settings
						type: 'success',
						placement: {
							from: "top",
							align: "center"
						},
					});
				} else {
					$.notify({
						// options
						message: msg.reason 
					},{
						// settings
						type: 'danger',
						placement: {
							from: "top",
							align: "center"
						},
					});
				}
			},
			error: function() {
				alert('error');
			}
        });

		e.preventDefault();
	});

	$('#form_save_settings_password').submit(function(e){
		let old_password = $('#p_old_password').val();
		let new_password = $('#p_new_password').val();
		let new_password_r = $('#p_new_password_r').val();

		$.ajax({
			url: "inc/account_password.php",
			type: "POST",
			dataType: "json",
			data: `&old_password=${old_password}&new_password=${new_password}&new_password_r=${new_password_r}`,
			success: function(msg) {
				if(msg.result) {
					$.notify({
						// options
						message: `Poprawnie zmieniono hasło` 
					},{
						// settings
						type: 'success',
						placement: {
							from: "top",
							align: "center"
						},
					});
				} else {
					$.notify({
						// options
						message: msg.reason 
					},{
						// settings
						type: 'danger',
						placement: {
							from: "top",
							align: "center"
						},
					});
				}
			},
			error: function() {
				alert('error');
			}
        });

		e.preventDefault();
	});

	$('#m_Kartoteka li a').click(function (e) {
		e.preventDefault();
		$(this).removeClass('active');
	});
	 
	$('.btn-kartoteka').click(function(e){
		e.preventDefault();
		$(this).removeClass('active');
	});
});