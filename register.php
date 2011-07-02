<?php
include_once('config.php');
include_once('model/usermanager.php');
if (isset($_POST['username']) && isset($_POST['password_first']) && isset($_POST['password_confirm']) && isset($_POST['mobile'])) {
	if ($_POST['password_first'] == $_POST['password_confirm']) {
		$username = $_POST['username'];
		$password = $_POST['password_first'];
		$mobile = $_POST['mobile'];
		$email = "";
		$description = "";
		if (isset($_POST['email']) && $_POST['email'] != "") {
			$email = $_POST['email'];
		}
		if (isset($_POST['description']) && $_POST['description'] != "") {
			$description = $_POST['description'];
		}
		UserManager::addUser($username, $password, $email, $mobile, $description);
		header("Location: http://" . $domain . "signin.php");
	}
}
header("Location: http://" . $domain . "signup.php");
?>
