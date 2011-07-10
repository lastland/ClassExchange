<?php
function insertClasses($link) {
	for ($i = 0; $i < 100000; $i++) {
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
	for ($i = 0; $i < 100000; $i++) {
		$class_id = rand(1, 100000);
		$user_id = rand(1, 3);
		$query = "INSERT INTO exchanges(class_id, user_id) VALUES($class_id, $user_id);";
		echo $query . "<br>";
		mysqli_query($link, $query);
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
	#insertClasses($link);
	insertExchanges($link);
	mysqli_query($link, "commit");
	mysqli_query($link, "set autocommit=1");
}
?>
