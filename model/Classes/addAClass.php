<?php
include_once('../../config.php');
include_once('../Users/SessionJudge.php');
include_once('../ClassManager.php');
include_once('../usermanager.php');
if (UserManager::confirmAuthority($_SESSION['id'], 1) && isset($_POST['classname']) && isset($_POST['classtype']) && isset($_POST['classdescription']) && $_POST['classname'] != "" && $_POST['classtype'] != "" && $_POST['classdescription'] != "") {
	$class_id = ClassManager::addClass($_POST['classname'], $_POST['classtype'], $_POST['classdescription']);
	header("Location: http://" . $domain . "addClass2.php?class_id=$class_id");
} else {
	header("Location: http://" . $domain . "addClass.php");
}
?>
