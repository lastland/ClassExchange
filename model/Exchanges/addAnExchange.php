<html>
<?php
include_once('../../config.php');
include_once('../Users/SessionJudge.php');
include_once('../ClassManager.php');
if (isset($_GET['class_id'])) {
	$class_info = ClassManager::getClass($_GET['class_id']);
?>
	<head>
		<title>交大课程交易中心</title>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<link rel="stylesheet" type="text/css" href="../../css/style.css" />
		<script type="text/javascript" src="../../js/jquery-1.6.2.min.js"></script>
	</head>
	<body>
		<h2>添加一份交易</h2>
		<form action="exchangeAdder.php" method="post">
			<table>
				<tr>
					<th colspan="2">
						课程信息：
					</th>
				</tr>
				<tr>
					<td>课程编号：</td>
					<td><?php echo $class_info['class_id']; ?></td>
				</tr>
				<tr>
					<td>课程名称：</td>
					<td><?php echo $class_info['class_name']; ?></td>
				</tr>
				<tr>
					<th colspan="2">用户信息</th>
				</tr>
				<tr>
					<td>用户ID：</td>
					<td><?php echo $_SESSION['id']; ?></td>
				</tr>
				<tr>
					<td>用户名：</td>
					<td><?php echo $_SESSION['username']; ?></td>
				</tr>
				<tr>
					<td>
						<input type="hidden" name="class_id" value="<?php echo $class_info['class_id']; ?>" />
						<input type="hidden" name="user_id" value="<?php echo $_SESSION['id']; ?>" />
						<input type="submit" value="确认信息" />
					</td>
				</tr>
			</table>
		</form>
	</body>
<?php
} else {
	header("Location: http://" . $domain . "index.php");
}
?>
</html>
