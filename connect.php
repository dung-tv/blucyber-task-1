<?php
	$sever = 'localhost';
	$user = 'root';
	$pass = '';
	$db = 'bluecyber';
	$con = mysqli_connect($sever, $user, $pass, $db);
	mysqli_set_charset($con, 'utf8');
	if (!$con) {
		die('Không có kết nối');
	}
?>