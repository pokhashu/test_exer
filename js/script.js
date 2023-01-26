//logout
$('#logout').click(function(event){
	event.preventDefault();
	
	$.ajax({
		url: 'js/ajax_handler.php',
		type: 'POST',
		cache: false,
		dataType: 'json',
		data: {
			'action': 'logout'
		},
		success: function(data) {
			if (data.status) {
				document.location.href = "/login.php";
			}
		}
	});
});


//registration
$('#reg-submit').click(function(event){
	event.preventDefault();
	
	let login = $('input[name="login"]').val(),
		password = $('input[name="password"]').val(),
		confirm_password = $('input[name="confirm_password"]').val(),
		email = $('input[name="email"]').val(),
		name = $('input[name="name"]').val();
	$.ajax({
		url: 'js/ajax_handler.php',
		type: 'POST',
		cache: false,
		dataType: 'json',
		data: {
			'login': login,
			'password': password,
			'confirm_password': confirm_password,
			'email': email,
			'name': name,
			'action': 'registration'
		},
		success: function(data) {
			if (data.status) {
				document.location.href = "/";
			} else {
				$('.error_message').removeClass('none').text(data.message);
			}
		}
	});
});


// log in
$('#login-submit').click(function(event){
	event.preventDefault();
	let login = $('input[name="login"]').val(),
		password = $('input[name="password"]').val();
	$.ajax({
		url: 'js/ajax_handler.php',
		type: 'POST',
		cache: false,
		dataType: 'json',
		data: {
			'login': login,
			'password': password,
			'action': 'login'
		},
		success: function(data) {
			if (data.status) {
				document.location.href = "/";
			} else {
				$('.error_message').removeClass('none').text(data.message);
			}
			
		}
	});

});