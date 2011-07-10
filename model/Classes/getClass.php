<?php
include_once('../ClassManager.php');
if (isset($_GET['class_name']) && isset($_GET['begin_num']) && isset($_GET['end_num'])) {
	echo json_encode(ClassManager::getClassInLimitByName($_GET['class_name'], $_GET['begin_num'], $_GET['end_num']));
}
?>
