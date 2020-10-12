<?php
	session_start();
	require_once 'connect.php';
	if (isset($_SESSION['user'])) {
		header('location: index.php');
	}
	if (isset($_POST['user_name']) && $_POST['pass_word']) {
		$sql = "SELECT * FROM `user` WHERE user_name = '".addslashes($_POST['user_name'])."' AND pass_word = '".addslashes($_POST['pass_word'])."'";
		$result = mysqli_query($con, $sql);
		if ( ($row = mysqli_fetch_assoc($result)) > 0 ) {
			$_SESSION['user'] = $row;
			unset($_SESSION['user']['pass_word']);
			header('location: index.php');
		}else {
			$log = 'Tên đăng nhập hoặc mật khẩu không đúng';
		}
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
	<title>Quản lý ảnh</title>
	<link rel="stylesheet" href="./public/css/main.css">
</head>
<body>
	<div class="container">
		<div class="col-6">
			<h2>Đăng nhập</h2>
			<form method="POST" action="./login.php">
				<div class="form-group">
					<label for="exampleInputEmail1">User name</label>
					<input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="user_name">
				</div>
				<div class="form-group">
					<label for="exampleInputPassword1">Password</label>
					<input type="password" class="form-control" id="exampleInputPassword1" name="pass_word">
				</div>
				<?php if(isset($log)){ ?>
					<div class="form-group">
						<span style="color: red"><?php echo $log; ?></span>
					</div>
				<?php } ?>
				<button type="submit" class="btn btn-primary">Đăng nhập</button>
				<a href="./register.php" class="btn btn-warning">Đăng kí</a>
			</form>
		</div>
	</div>
</body>
</html>