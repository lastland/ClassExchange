<?php
include_once('config.php');
include_once('model/Users/SessionJudge.php');
include_once('model/ClassManager.php');
if (isset($_GET['class_id'])) {
	$class_info = ClassManager::getClass($_GET['class_id']);
	$class_times = ClassManager::getClassTime($_GET['class_id']);
	$timeTable = array("", "第一节课", "第二节课", "第三节课", "第四节课", "第五节课", "第六节课", "第七节课", "第八节课", "第九节课", "第十节课", "第十一节课", "第十二节课", "第十三节课", "第十四节课");
	$dayTable = array("", "周一", "周二", "周三", "周四", "周五", "周六", "周日");
?>
		<div class="class-show">
		<table class="classshower">
			<tr>
				<th colspan="2"><?php echo $class_info['class_name']; ?></th>
			</tr>
			<tr>
				<td>课程编号：</td>
				<td><?php echo $class_info['class_id']; ?></td>
			</tr>
			<tr>
				<td>课程类型：</td>
				<td><?php echo $class_info['class_type']; ?></td>
			</tr>
			<tr>
				<td>课程介绍：</td>
				<td>
					<textarea disabled="disabled"><?php echo $class_info['class_introduction']; ?></textarea>
				</td>
			</tr>
		</table>
		<table class="classtimeshower">
			<tr><th>开始课时</th><th>结束课时</th><th>日期</th></tr>
			<?php
			for ($i = 0; $i < sizeof($class_times); $i++) {
				echo "<tr><td>" . $timeTable[$class_times[$i]['start_time']] . "</td><td>" . 
					$timeTable[$class_times[$i]['end_time']] . "</td><td>" . 
					$dayTable[$class_times[$i]['day_in_week']] . "</td></tr>";
			}
			?>
		</table>
		<table class="classchooser">
			<tr>
				<td>
					<input type="button" value="添加该课程的交易" onclick="location.href='http://<?php echo $domain; ?>model/Exchanges/addAnExchange.php?class_id=<?php echo $class_info['class_id']; ?>'" />
				</td>
			</tr>
		</table>
		</div>
<?php
} else {
	header("Location: http://" . $domain . "model/Exchanges/addExchange.php");
}
?>
