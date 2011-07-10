<?php
class DBManager {
	public static function getConnection($user_id) {
		if (!isset($user_id) || $user_id > 2 || $user_id < 0) {
			$user_id = 2;
		}
		$user = array('root', 'dealer', 'checker');
		$pass = array('31415', 'dealtime', 'checkerpasser');
		$connection = mysqli_connect(
			'localhost',
			$user[$user_id],
			$pass[$user_id],
			'ClassExchange');
		mysqli_set_charset($connection, "utf8");
		return $connection;
	}

	public static function executeQuery($query, $auth) {
		$link = self::getConnection($auth);
		if ($link) {
			return mysqli_query($link, $query);
		} else {
			echo "connection error!";
		}
	}

	public static function executeInsert($query, $auth) {
		$link = self::getConnection($auth);
		if ($link) {
			mysqli_query($link, $query);
			return mysqli_insert_id($link);
		} else {
			echo "connection error!";
		}
	}

	public static function executeTransaction($queries, $auth) {
		$link = self::getConnection($auth);
		if ($link) {
			mysqli_query($link, "START TRANSACTION;");
			for ($i = 0; $i < sizeof($queries); $i++) {
				mysqli_query($link, $queries[$i]);
			}
			mysqli_query($link, "COMMIT;");
		} else {
			echo "connection error!";
		}
	}
}
?>
