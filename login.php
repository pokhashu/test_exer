<?php 
	session_start();
	if(isset($_COOKIE['user'])){
		$_SESSION['user']=$_COOKIE['user'];
		header("Location: /");
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="css/reset.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<title>Log in</title>
</head>
<body>
	<div class="auth_form">
		<form method="POST">
			<label for="login">Ваш логин</label>
			<input type="text" name="login" minlength="6" placeholder="Логин" required>

			<label for="login">Ваш пароль</label>
			<input type="password" name="password" placeholder="Пароль" required>

			<br>
			<p class=" none error_message"></p>
			<br>

			<noscript>
				<span style="color:red"><b>Чтобы отправить форму, включите JavaScript!</b></span>
			</noscript>
			<script type="text/javascript">
				document.write("<button type='submit' id='login-submit'>Войти</button>");
			</script>
			
		</form>
		<a href="register.php">Регистрация</a>
	</div>
	<script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"></script>
	<script src="js/script.js"></script>
</body>
</html>