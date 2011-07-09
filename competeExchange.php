<html>
<?php
include_once('config.php');
include_once('model/exchangemanager.php');
include_once('model/ClassManager.php');
if (isset($_GET['host_id'])) {
	$host_info = ExchangeManager::getDetailExchange($_GET['host_id']);
	$host_classtime = ClassManager::getClassTime($_GET['host_id']);
	$timeTable = array("", "第一节课", "第二节课", "第三节课", "第四节课", "第五节课", "第六节课", "第七节课", "第八节课", "第九节课", "第十节课", "第十一节课", "第十二节课", "第十三节课", "第十四节课");
	$dayTable = array("", "周一", "周二", "周三", "周四", "周五", "周六", "周日");
?>
	<head>
		<title>交大课程交易中心</title>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<link rel="stylesheet" type="text/css" href="css/style.css" />
		<script type="text/javascript" src="js/jquery-1.6.2.min.js"></script>
	</head>
	<body>
		<h2>你想要竞标的交易</h2>
		<div id="host-div">
			<table>
				<tr>
					<td>交易编号：</td>
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
					<th colspan="3">交易主：<?php echo $host_info['user_name']; ?></th>
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
		<h2>可参与竞标的交易</h2>
		<div id="my-exchanges-div">
		</div>
	</body>
<?php
} else {
	header("Location: http://" . $domain . "index.php");
}
?>
</html>
