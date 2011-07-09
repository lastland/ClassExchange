<html>
<?php
include_once('config.php');
include_once('model/Users/SessionJudge.php');
include_once('model/exchangemanager.php');
include_once('model/ClassManager.php');
if (isset($_GET['exchange_id'])) {
	$host_info = ExchangeManager::getDetailExchange($_GET['exchange_id']);
	$host_classtime = ClassManager::getClassTime($_GET['exchange_id']);
	$count = ExchangeManager::getCompetitorCount($_GET['exchange_id']);
	$competitors = ExchangeManager::getExchangeCompeteForSomeone($_GET['exchange_id']);
	$timeTable = array("", "第一节课", "第二节课", "第三节课", "第四节课", "第五节课", "第六节课", "第七节课", "第八节课", "第九节课", "第十节课", "第十一节课", "第十二节课", "第十三节课", "第十四节课");
	$dayTable = array("", "周一", "周二", "周三", "周四", "周五", "周六", "周日");
	$isOwner = ($_SESSION['id'] == $host_info['user_id']);
?>
	<head>
		<title>交大课程交易中心</title>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<link rel="stylesheet" type="text/css" href="css/style.css" />
		<script type="text/javascript" src="js/jquery-1.6.2.min.js"></script>
		<script type="text/javascript">
		function deal(host_id, competitor_id) {
			$.ajax({
				type: "post",
				url: "model/Exchanges/makeDeal.php",
				data: "host_id=" + host_id + "&competitor_id=" + competitor_id,
				dataType: "text",
				success: function(response) {
					if (response == "success") {
						alert("交易成功！");
						location.href="home.php";
					} else {
						alert("对不起，无法达成此交易，可能对方的竞标已经撤销。");
						location.href="checkCompete.php?exchange_id=<?php echo $_GET['exchange_id']; ?>";
					}
				}
			});
		}

		function undoCompete(competitor_id) {
			$.ajax({
				type: "post",
				url: "model/Exchanges/undoDeal.php",
				data: "exchange_id=" + competitor_id,
				dataType: "text",
				success: function(response) {
					if (response == "success") {
						alert("撤销成功！");
					} else {
						alert("出错啦！");
					}
					location.href="checkCompete.php?exchange_id=<?php echo $_GET['exchange_id']; ?>";
				}
			});
		}
		</script>
	</head>
	<body>
		<h2>查看竞标情况</h2>
		<center><input type="button" value="回到首页" onclick="location.href='home.php'" /></center>
		<div class="host-div">
			<table>
				<tr>
					<td>交易编号:</td>
					<td colspan="2"><?php echo $host_info['exchange_id']; ?></td>
				</tr>
				<tr>
					<td>课程：</td>
					<td colspan="2"><?php echo $host_info['class_name']; ?></td>
				</tr>
				<tr>
					<td>交易主：</td>
					<td colspan="2"><?php echo $host_info['user_name']; ?></td>
				</tr>
				<tr>
					<td>目前竞标此交易的订单数量：</td>
					<td><?php echo $count; ?></td>
				</tr>
				<tr>
					<th colspan="3">课程信息</th>
				</tr>
				<tr>
					<td>课程编号：</td>
					<td colspan="2"><?php echo $host_info['class_id']; ?></td>
				</tr>
				<tr>
					<td>课程名称：</td>
					<td colspan="2"><?php echo $host_info['class_name']; ?></td>
				</tr>
				<tr>
					<td>课程介绍：</td>
					<td colspan="2"><textarea disabled="disabled" rows="4" cols="40"><?php echo $host_info['class_introduction']; ?></textarea></td>
				</tr>
				<tr>
					<th colspan="3">上课时间</th>
				</tr>
				<tr>
					<th>开始课时</th>
					<th>结束课时</th>
					<th>日期</th>
				</tr>
				<?php
				for ($i = 0; $i < sizeof($host_classtime); $i++) {
				?>
				<tr>
					<td><?php echo $timeTable[$host_classtime[$i]['start_time']]; ?></td>
					<td><?php echo $timeTable[$host_classtime[$i]['end_time']]; ?></td>
					<td><?php echo $timeTable[$host_classtime[$i]['day_in_week']]; ?></td>
				</tr>
				<?php
				}
				?>
				<tr>
					<th colspan="3">交易主：<?php echo $host_info['user_name']; if ($isOwner) {echo " ( It's you! ) ";} ?></th>
				</tr>
				<tr>
					<td>ID：</td>
					<td colspan="2"><?php echo $host_info['user_id']; ?></td>
				</tr>
				<tr>
					<td>手机：</td>
					<td colspan="2"><?php echo $host_info['user_mobile']; ?></td>
				</tr>
				<tr>
					<td>电子邮箱：</td>
					<td colspan="2"><?php echo $host_info['user_email']; ?></td>
				</tr>
			</table>
		</div>
		<h2>参与竞标该交易的有</h2>
		<div id="competitors-div">
			<table>
				<tr>
					<th>交易编号</th>
					<th>课程编号</th>
					<th>课程名称</th>
					<th>操作</th>
				</tr>
				<?php
				for ($i = 0; $i < sizeof($competitors); $i++) {
					echo "<tr><td>" . $competitors[$i]['exchange_id'] . "</td>";
					echo "<td>" . $competitors[$i]['class_id'] . "</td>";
					echo "<td>" . $competitors[$i]['class_name'] . "</td><td>";
					if ($isOwner) {
						echo "<input type='button' value='成交！' onclick='deal(" . $host_info['exchange_id'] . ", " . $competitors[$i]['exchange_id'] . ")'/>";
					} else {
						if ($competitors[$i]['user_id'] == $_SESSION['id']) {
							echo "<input type='button' value='撤销' onclick='undoCompete(" . $competitors[$i]['exchange_id'] . ")' />";
						}
					}
					echo "</td></tr>";
				}
				?>
			</table>
		</div>
	</body>
<?php
}
?>
</html>
