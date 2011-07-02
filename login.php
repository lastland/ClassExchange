<?php
session_start();
include_once('config.php');
include_once('model/usermanager.php');
if (isset($_POST['username']) && isset($_POST['password'])) {
	$user_info = UserManager::getUserInfo($_POST['username']);
	if ($user_info['id'] == $_POST['username'] && $user_info['password'] == $_POST['password']) {
		$_SESSION['id'] = $user_info['id'];
		$_SESSION['username'] = $user_info['username'];
		header("Location: http://" . $domain . "home.php");
	}
}
header("Location: http://" . $domain . "signin.php");
?>
