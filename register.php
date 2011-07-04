<?php
include_once('config.php');
include_once('model/usermanager.php');
#echo "get in<br>";
#echo $_POST['username'] . "<br>";
$success = false;
if (isset($_POST['username']) && isset($_POST['password_first']) && isset($_POST['password_confirm']) && isset($_POST['mobile']) && isset($_POST['email'])) {
	#echo "get in the first if<br>";
	if ($_POST['password_first'] == $_POST['password_confirm']) {
		#echo "get in the second if<br>";
		$username = $_POST['username'];
		$password = $_POST['password_first'];
		$mobile = $_POST['mobile'];
		$email = $_POST['email'];
		$description = "";
		if (isset($_POST['description']) && $_POST['description'] != "") {
			$description = $_POST['description'];
		}
		#echo "data:<br>username:$username;password:$password;email:$email;mobile:$mobile;description:$description.";
		if (UserManager::argsValid($username, $password, $email, $mobile, $description)) {
			UserManager::addUser($username, $password, $email, $mobile, $description);
			$success = true;
		}
	}
}
if ($success) {
	header("Location: http://" . $domain . "signin.php");
} else {
	header("Location: http://" . $domain . "signup.php");
}
?>
