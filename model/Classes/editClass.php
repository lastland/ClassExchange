<?php
include_once('../../config.php');
include_once('../Users/SessionJudge.php');
include_once('../ClassManager.php');
include_once('../usermanager.php');

function timesAreValid($begin_times, $end_times, $days) {
	#echo sizeof($begin_times) . "<br>";
	for ($i = 0; $i < sizeof($begin_times); $i++) {
		if ($begin_times[$i] < 1 || $begin_times[$i] > 14) {
			#echo "begin_time invalid<br>";
			return false;
		}
		if ($end_times[$i] < 1 || $end_times[$i] > 14) {
			#echo "end_time invalid<br>";
			return false;
		}
		if ($days[$i] < 1 || $days[$i] > 7) {
			#echo "day invalid<br>";
			return false;
		}
		if ($begin_times[$i] > $end_times[$i]) {
			#echo "begin_time > end_time<br>";
			return false;
		}
		for ($j = 0; $j < sizeof($begin_times); $j++) {
			if ($i != $j) {
				if ($days[$i] == $days[$j]) {
					if ($begin_times[$i] > $begin_times[$j] &&
						$begin_times[$i] < $end_times[$j]) {
						#echo "$i and $j conflict<br>";
						return false;
					} else if ($begin_times[$i] == $begin_times[$j]) {
						#echo "$i and $j same start<br>";
						return false;
					} else if ($end_times[$i] == $end_times[$j]) {
						#echo "$i and $j same end<br>";
						return false;
					}
				}
			}
		}
	}
	return true;
}

$success = false;
if (UserManager::confirmAuthority($_SESSION['id'], 1) && isset($_POST['begin_time']) && isset($_POST['end_time']) && isset($_POST['day']) && isset($_POST['class_id']) && !empty($_POST['begin_time']) && !empty($_POST['end_time']) && !empty($_POST['day'])) {
	if (timesAreValid($_POST['begin_time'], $_POST['end_time'], $_POST['day'])) {
		ClassManager::delClassTime($_POST['class_id']);
		for ($i = 0; $i < sizeof($_POST['begin_time']); $i++) {
			ClassManager::addClassTime($_POST['class_id'], $_POST['begin_time'][$i], $_POST['end_time'][$i], $_POST['day'][$i]);
		}
		$success = true;
	}
}
if ($success) {
	header("Location: http://" . $domain . "home.php");
} else {
	header("Location: http://" . $domain . "addClass2.php?class_id=" . $_POST['class_id']);
}
?>
