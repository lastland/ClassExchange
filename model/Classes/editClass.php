<?php
include_once('../../config.php');
include_once('../Users/SessionJudge.php');
include_once('../ClassManager.php');
include_once('../usermanager.php');
if (UserManager::confirmAuthority($_SESSION['id'], 1) && isset($_POST['begin_time']) && isset($_POST['end_time']) && isset($_POST['day']) && isset($_POST['class_id'])) {
	echo "yes!";
}
?>
