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
	<title>Registration</title>
</head>
<body>
	<div class="auth_form">
		<form method="POST">
			<label for="login">Придумайте логин</label>
			<input type="text" name="login" minlength="6" placeholder="login123" required>

			<label for="password">Придумайте пароль</label>
			<input type="password" name="password" placeholder="Password123" required>

			<label for="">Повторите пароль</label>
			<input type="password" name="confirm_password" placeholder="Password123" required>

			<label for="">Электронная почта</label>
			<input type="email" name="email" placeholder="example@mail.com" required>

			<label for="">Ваше имя</label>
			<input type="text" name="name" minlength="2" maxlength="20" placeholder="Имя" required>
			<br>
			<p class="none error_message"></p>
			<br>
			<noscript>
				<span style="color:red"><b>Чтобы отправить форму, включите JavaScript!</b></span>
			</noscript>
			<script type="text/javascript">
				document.write("<button type='submit' id='reg-submit'>Зарегистрироваться</button>");
			</script>
		</form>
		<a href="login.php">Войти</a>
	</div>
	<script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"></script>
	<script src="js/script.js"></script>
</body>
</html>