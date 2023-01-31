<?php
	if (@$_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest') {
		session_start();
		if(isset($_POST['action'])){
			require_once('../classes/Database.class.php');
			$salt = "sflpr9fhi2";
	
			$db = new Database('../database/users.json');
			
			if($_POST['action']=='login'){
	
				$login = $_POST['login'];
				$password = sha1($salt.$_POST['password']);
				$user = $db->readRow(array("login"), array("login"=>$login, "password"=>$password));
	
				if(!$user){
					$response = ["status"=>false, "message"=>"Неверный логин или пароль"];
				} else {
	
					
					setcookie("user", $login, time()+60*60*24*365*10, "/");
					$response = ["status"=>true];
				}
	
			} else if ($_POST['action'] == 'registration'){
	
				if(!preg_match("/^[^0-9\!\@\#\$\%\^\&\*\(\)\_\+\"\№\;\%\:\?\*\-\=\.\,\<\>\\\|\/\s]{6,}$/", $_POST['login'])){
	
					$response = ["status"=>false, "message"=>"Логин должен быть длинее 6 символов, содержать только буквы"];
	
				} else if($db->readRow(array("login"), array("login"=>$_POST['login']))){
	
					$response = ["status"=>false, "message"=>"Такой пользователь уже существует"];
	
				} else if(!preg_match("/^(?=.*[0-9])(?=.*[a-zA-Z])[a-zA-Z0-9]{6,}$/", $_POST['password'])){
	
					$response = ["status"=>false, "message"=>"Пароль должен быть длинее 6 символов, содержать только буквы и цифры"];
	
				} else if($_POST['password'] != $_POST['confirm_password']){
	
					$response = ["status"=>false, "message"=>"Пароли не совпадают"];
	
				} else if(!preg_match("/^[\w\-\.]+@([\w\-]+\.)+[\w\-]{2,4}$/", $_POST['email'])){
	
					$response = ["status"=>false, "message"=>"укажите правильную электронную почту"];
	
				} else if($db->readRow(array("login"), array("email"=>$_POST['email']))){
	
					$response = ["status"=>false, "message"=>"Данная почта уже зарегистрирована"];
	
				} else if(!preg_match("/^[^0-9\!\@\#\$\%\^\&\*\(\)\_\+\"\№\;\%\:\?\*\-\=\.\,\<\>\\\|\/\s]{2,20}$/", $_POST['name'])){
					$response = ["status"=>false, "message"=>"Имя должно быть длинее двух символов, содержать только буквы"];
	
				} else {
					$db->insertRow(array("login"=>$_POST['login'],"password"=>sha1($salt.$_POST['password']),"email"=>$_POST['email'],"name"=>$_POST['name']));
					setcookie("user", $_POST['login'], time()+60*60*24*365*10, "/");
					$_SESSION['user']=$_POST['login'];
					$response = ["status"=>true];
				}
	
			} else if ($_POST["action"]=="logout"){
				setCookie("user", "", 0, "/"); 	
				$_SESSION=[];
				$response = ["status"=> true];
			}
			echo json_encode($response);
		}
	}
	
	
?>