<?php 
	session_start();
	require_once 'connect.php';
	if (!isset($_SESSION['user'])) {
		header('location: index.php');
	}

	if (isset($_POST['task'])) {
		$sql = "SELECT COUNT(*) AS check_task FROM `task` WHERE name = '".addslashes($_POST['task'])."'";
		$result = mysqli_query($con, $sql);
		$check = mysqli_fetch_assoc($result);
		if ($check['check_task'] == 0) {
			$sql = "INSERT INTO `task`(`name`, `status`) VALUES ('".addslashes($_POST['task'])."', 1)";
			echo $sql;
			$result = mysqli_query($con, $sql);
			if (!$result) {
				$log = 'Thêm task không thành công';
			}else {
				header('location: index.php');
			}
		}else {
			$log = 'Task đã tồn tại';
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
		<header>
			<nav class="navbar navbar-light bg-light">
				<button class="btn btn-sm btn-outline-secondary" type="button"><?php echo (isset($_SESSION['user']) ? 'Xin chào '.$_SESSION['user']['user_name'] : 'No member'); ?></button>
				<a class="btn btn-sm btn-outline-secondary" href="./logout.php">Đăng xuất</a>
			</nav>
		</header>
		<div class="col-6">
			<h2>Thêm task</h2>
			<form method="POST" action="">
				<div class="form-group">
					<label for="exampleInputEmail1">Tên task</label>
					<input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="task">
				</div>
				<?php if(isset($log)){ ?>
					<div class="form-group">
						<span style="color: red"><?php echo $log; ?></span>
					</div>
				<?php } ?>
				<button type="submit" class="btn btn-primary">Thêm</button>
			</form>
		</div>
	</div>
</body>
</html>