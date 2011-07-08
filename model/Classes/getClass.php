<?php
include_once('../ClassManager.php');
if (isset($_GET['class_name'])) {
	echo json_encode(ClassManager::getClassByName($_GET['class_name']));
}
?>
