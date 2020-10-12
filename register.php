<?php
	session_start();
	require_once 'connect.php';
	if (isset($_SESSION['user'])) {
		header('location: index.php');
	}

	if (isset($_POST['user_name']) && isset($_POST['pass_word']) && isset($_POST['re-password'])) {
		if ($_POST['pass_word'] == $_POST['re-password']) {
			$sql = "SELECT COUNT(*) AS check_user FROM `user` WHERE user_name = '".addslashes($_POST['user_name'])."'";
			$result = mysqli_query($con, $sql);
			$user = mysqli_fetch_assoc($result);
			if ($user['check_user'] == 0) {
				$sql = "INSERT INTO `user`(user_name, pass_word) VALUES('".addslashes($_POST['user_name'])."', '".addslashes($_POST['pass_word'])."')";
				$result = mysqli_query($con, $sql);
				if (!$result) {
					$log = 'Đăng kí không thành công';
				}else {
					$_SESSION['user']['id'] = mysqli_insert_id($con);
					$_SESSION['user']['user_name'] = $_POST['user_name'];
					header('location: index.php');
				}
			}
			else {
				$log = 'Tài khoản đã tồn tại';
			}
		}else {
			$log = 'Mật khẩu không trùng nhau';
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
			<h2>Đăng kí</h2>
			<form method="POST" action="">
				<div class="form-group">
					<label for="exampleInputEmail1">User name</label>
					<input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="user_name">
				</div>
				<div class="form-group">
					<label for="exampleInputPassword1">Password</label>
					<input type="password" class="form-control" id="exampleInputPassword1" name="pass_word">
				</div>
				<div class="form-group">
					<label for="exampleInputPassword2">Re-password</label>
					<input type="password" class="form-control" id="exampleInputPassword2" name="re-password">
				</div>
				<?php if(isset($log)){ ?>
					<div class="form-group">
						<span style="color: red"><?php echo $log; ?></span>
					</div>
				<?php } ?>
				<button type="submit" class="btn btn-primary">Đăng kí</button>
				<a href="./index.php" class="btn btn-warning">Đăng nhập</a>
			</form>
		</div>
	</div>
</body>
</html>