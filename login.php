<?php
session_start();
include_once('config.php');
include_once('model/usermanager.php');
$success = false;
if (isset($_POST['username']) && isset($_POST['password'])) {
	#echo "get in first if<br>";
	$user_info = UserManager::getUserInfo($_POST['username']);
	#print_r($user_info);
	#echo "<br>";
	#print_r($_POST);
	if ($user_info['user_name'] == $_POST['username'] && $user_info['user_password'] == $_POST['password']) {
		$_SESSION['id'] = $user_info['user_id'];
		$_SESSION['username'] = $user_info['user_name'];
		$success = true;
	}
}
if ($success) {
	#echo "success";
	header("Location: http://" . $domain . "home.php");
} else {
	#echo "failed";
	header("Location: http://" . $domain . "signin.php");
}
?>
