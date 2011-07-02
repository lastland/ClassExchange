<?php
class DBManager {
	public static function getConnection() {
		$connection = mysqli_connect(
			'localhost',
			'root',
			'31415',
			'ClassExchange');
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
}
?>
