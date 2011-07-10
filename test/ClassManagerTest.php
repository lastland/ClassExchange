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

function addClassTimeTest() {
	ClassManager::addClassTime(1, 1, 2, 1);
}

function getClassInLimitByName() {
	print_r(ClassManager::getClassInLimitByName('a', 60, 90));
}

#addClassTest();
#getClassTest();
#addClassTimeTest();
getClassInLimitByName();
?>
