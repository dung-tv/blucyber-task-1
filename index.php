<?php
	session_start();
	require_once 'connect.php';
	if (!isset($_SESSION['user'])) {
		header('location: login.php');
	}
	$sql = "SELECT * FROM `task`";
	$result = mysqli_query($con, $sql);
	$tasks = mysqli_fetch_all($result, MYSQLI_ASSOC);
	if (isset($_GET['id-success'])) {
		$sql = "UPDATE `task` SET status = 0 WHERE id = ".$_GET['id-success'];
	}
	if (isset($_GET['id-del'])) {
		$sql = "DELETE FROM `task` WHERE id = ".$_GET['id-del'];
	}

	$result = mysqli_query($con, $sql);
	if ( $result && (isset($_GET['id-success']) || isset($_GET['id-del'])) ) {
		header('location: index.php');
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
			<h2>List-task</h2>
			<a href="./add-task.php" class="btn btn-primary add-task">Thêm task</a>
			<table class="table table-bordered">
				<thead>
					<tr>
						<th scope="col">STT</th>
						<th scope="col">Name</th>
						<th scope="col">Status</th>
						<th scope="col">Action</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($tasks as $k => $task): ?>
						<tr>
							<th scope="row"><?php echo $k + 1; ?></th>
							<td><?php echo $task['name']; ?></td>
							<td><?php echo ($task['status'] == 0 ? 'Hoàn thành' : 'Chưa hoàn thành'); ?></td>
							<td>
								<a href="?id-success=<?php echo $task['id'] ?>" class="btn btn-success">Hoàn thành</a>
								<a onclick="return confirm('Bạn có muốn xoá task này?');" href="?id-del=<?php echo $task['id'] ?>" class="btn btn-danger">Xoá</a>
							</td>
						</tr>
					<?php endforeach ?>
				</tbody>
			</table>
		</div>
	</div>
</body>
</html>