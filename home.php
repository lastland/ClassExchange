<html>
<?php
session_start();
include_once('config.php');
include_once('model/usermanager.php');
if (!(isset($_SESSION['id']) && isset($_SESSION['username']) && ($_SESSION['id'] != "") && ($_SESSION['username'] != ""))) {
	header("Location: http://" . $domain . "signin.php");
} else {
	$user_info = UserManager::getUserInfoById($_SESSION['id']);
?>
	<head>
		<title>交大课程交易中心</title>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<link rel="stylesheet" type="text/css" href="css/style.css" />
		<script type="text/javascript" src="js/jquery-1.6.2.min.js"></script>
		<script type="text/javascript">
			function getExchangeEntries(begin_num, end_num) {
				$.ajax({
					type: "GET",
					url: "model/Exchanges/getExchanges.php",
					data: "begin_num=" + begin_num + "&end_num=" + end_num,
					dataType: "json",
					success: function(exchanges) {
							var theList = "<tr><th>交易号</th><th>课程</th><th>交易拥有者</th></tr>";
							for (var i = 0; i < exchanges.length; i++) {
								theList += "<tr><td>" + exchanges[i].exchange_id + "</td><td>" + exchanges[i].class_name + "</td><td>" + exchanges[i].user_name + "</td></tr>";
							}
							$("#exchanges-list").html(theList);
						}
					});
			}

			$(document).ready(function() {
				getExchangeEntries(0, 30);
			});
		</script>
	</head>
	<body>
		<h2>交大课程交易中心</h2>
		<div class="exchange-content">
			<div id="add-exchange">
				<table>
					<tr>
						<td colspan="2">
							欢迎你,<?php echo $user_info['user_name']; ?>!
						</td>
					</tr>
					<tr>
						<td>
							<input type="text" name="class_name" />
						</td>
						<td>
							<input type="button" value="添加一个新交易"/>
						</td>
						<?php
						if (UserManager::confirmAuthority($user_info['user_id'], 1)) {
						?>
						<td>
							<a href="addClass.php">
								<input type="button" value="添加一门新课程"/>
							</a>
						</td>
						<?php
						}
						?>
					</tr>
				</table>
			</div>
			<div id="exchanges">
				<table id="exchanges-list">
				</table>
			</div>
		</div>
	</body>
<?php
}
?>
</html>
