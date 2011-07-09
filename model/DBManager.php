<?php
class DBManager {
	public static function getConnection() {
		$connection = mysqli_connect(
			'localhost',
			'root',
			'31415',
			'ClassExchange');
		mysqli_set_charset($connection, "utf8");
		return $connection;
	}

	public static function executeQuery($query) {
		$link = self::getConnection();
		if ($link) {
			return mysqli_query($link, $query);
		} else {
			echo "connection error!";
		}
	}

	public static function executeInsert($query) {
		$link = self::getConnection();
		if ($link) {
			mysqli_query($link, $query);
			return mysqli_insert_id($link);
		} else {
			echo "connection error!";
		}
	}

	public static function executeTransaction($queries) {
		$link = self::getConnection();
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
