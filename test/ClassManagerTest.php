<?php
include_once('../model/ClassManager.php');
function addClassTest() {
	$class_name = "SE";
	$class_type = "SE";
	$class_introduction = "";
	ClassManager::addClass($class_name, $class_type, $class_introduction);
}

function getClassTest() {
	$result = ClassManager::getClass(20);
	print_r($result);
}

#addClassTest();
getClassTest();
?>
