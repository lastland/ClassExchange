<?php
function insertUsers($link) {
	for ($i = 0; $i < 100000; $i++) {
		$length = rand(5, 10);
		$email_sep = rand(3, $length);
		$username = "";
		$password = "";
		$mobile = "";
		$email = "";
		for ($j = 0; $j < $length; $j++) {
			$username .= chr(rand(ord("a"), ord("z")));
			$password .= chr(rand(ord("a"), ord("z")));
			$mobile .= chr(rand(ord("0"), ord("9")));
			if ($j == $email_sep) {
				$email .= "@";
			}
			$email .= chr(rand(ord("a"), ord("z")));
		}
		$query = "INSERT INTO users(user_name, user_password, user_mobile, user_email) VALUES('$username', '$password', '$mobile', '$email');";
		echo $query . "<br>";
		mysqli_query($link, $query);
	}
}

function insertClasses($link) {
	for ($i = 0; $i < 200000; $i++) {
		$length = rand(5, 10);
		$class_name = "";
		$class_type = "";
		for ($j = 0; $j < $length; $j++) {
			$class_name .= chr(rand(ord("a"), ord("z")));
			$class_type .= chr(rand(ord("a"), ord("z")));
		}
		$query = "INSERT INTO classes(class_name, class_type) VALUES('$class_name', '$class_type');";
		echo $query . "<br>";
		mysqli_query($link, $query);
	}
}

function insertExchanges($link) {
	for ($i = 0; $i < 200000; $i++) {
		$class_id = rand(1, 100000);
		$user_id = rand(1, 100000);
		$query = "INSERT INTO exchanges(class_id, user_id) VALUES($class_id, $user_id);";
		echo $query . "<br>";
		mysqli_query($link, $query);
	}
}

function insertCompete($link) {
	for ($i = 0; $i < 200000; $i++) {
		$compete = rand(0, 3);
		$j = rand(0, 200000);
		if ($compete != 0 && $i != $j) {
			$query = "UPDATE exchanges SET exc_exchange_id=$j WHERE exchange_id=$i;";
			echo $query . "<br>";
			mysqli_query($link, $query);
		}
	}
}

$link = mysqli_connect(
	'localhost',
	'root',
	'31415',
	'ClassExchange');
mysqli_set_charset($link, "utf8");
if ($link) {
	mysqli_query($link, "set autocommit=0");
	insertUsers($link);
	insertClasses($link);
	insertExchanges($link);
	insertCompete($link);
	mysqli_query($link, "commit");
	mysqli_query($link, "set autocommit=1");
}
?>
