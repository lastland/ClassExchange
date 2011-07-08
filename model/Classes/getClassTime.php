<?php
include_once('../../config.php');
include_once('../Users/SessionJudge.php');
include_once('../ClassManager.php');
include_once('../usermanager.php');
if (isset($_GET['class_id'])) {
	echo json_encode(ClassManager::getClassTime($_GET['class_id']));
}
?>
