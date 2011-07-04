<?php
include_once('../model/DBManager.php');
include_once('../model/usermanager.php');
function addUserTest() {
	$username='lastland';
	$password='lastland';
	$email='hnkfliyao@gmail.com';
	$mobile='15001890389';
	$description='';
	UserManager::addUser($username, $password, $email, $mobile, $description);
}

echo "Test for UserManager<br>";
addUserTest();
echo "Test end<br>";
?>
