<?php
include_once('DBManager.php');
class UserManager {
	public static function getUserInfo($userid) {
		$query = "SELECT pass_word FROM users WHERE user_id=" . $username;
		$result = DBManager::executeQuery($query);
		$user_info = array();
		while ($row = mysqli_fetch_assoc($result)) {
			$user_info['id'] = $row['user_id'];
			$user_info['username'] = $row['user_name'];
			$user_info['password'] = $row['user_password'];
		}
		return $user_info;
	}

	private static function usernameValid($username) {
		return $username != "" && preg_match('/^\w{5,12}$/', $username);
	}

	private static function passwordValid($password) {
		return $password != "" && preg_match('/^\w{6,18}$/', $password);
	}

	private static function emailValid($email) {
		return $email != "" && preg_match('/^\w{3,}@(\w+\.)+\w+$/', $email);
	}

	private static function mobileValid($mobile) {
		return $mobile != "" && preg_match('/^\d{11}$/', $mobile);
	}

	public static function argsValid($username, $password, $email, $mobile, $description) {
		$link = DBManager::getConnection();
		$flag = true;
		if (!self::usernameValid(mysqli_real_escape_string($link, $username))) {
			$flag = false;
		} else if (!self::passwordValid(mysqli_real_escape_string($link, $password))) {
			$flag = false;
		} else if (!self::emailValid(mysqli_real_escape_string($link, $email))) {
			$flag = false;
		} else if (!self::mobileValid(mysqli_real_escape_string($link, $mobile))) {
			$flag = false;
		}
		return $flag;
	}

	public static function addUser($username, $password, $email, $mobile, $description) {
		$link = DBManager::getConnection();
		$username = mysqli_real_escape_string($link, $username);
		$password = mysqli_real_escape_string($link, $password);
		$email = mysqli_real_escape_string($link, $email);
		$mobile = mysqli_real_escape_string($link, $mobile);
		$description = mysqli_real_escape_string($link, $description);
		if (self::argsValid($username, $password, $email, $mobile)) {
			$query = "INSERT INTO users(user_name, user_password, user_mobile, user_email) VALUES ('$username', '$password', '$mobile', '$email');";
			#echo $query . "<br>";
			DBManager::executeQuery($query);
			if ($description != "") {
				$query = "UPDATE users SET user_description='$description' WHERE user_email='$email';";
				#echo $query;
				DBManager::executeQuery($query);
			}
		}
	}
}
?>
