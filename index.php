<?php
	require_once('classes/Database.class.php');
	$db = new Database('database/users.json');
	session_start();
	if(!isset($_SESSION['user'])){
		header("Location: login.php");
	}

?>

Hello, <?php echo $db->readRow(array("name"), array("login"=>$_SESSION['user']))[0]['name']; ?>
<br>
<button type="button" id="logout">Выйти</button>
<script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"></script>
<script src="js/script.js"></script>


