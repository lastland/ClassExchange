<?php
include_once('DBManager.php');
class ExchangeManager {
	private static $exchange_id = 'exchange_id';
	private static $exchange_status = 'exchange_status';
	private static $class_for_exchange = 'class_id';
	private static $exchange_compete_for = 'exc_exchange_id';
	private static $user_of_exchange = 'user_id';
	private static $final_host = 'exc_exchange_id3';
	private static $final_competitor = 'exc_exchange_id2';

	public static function getExchange($exchange_id) {
		$query = "SELECT " . self::$exchange_id . ", " . self::$class_for_exchange . ", " . self::$user_of_exchange . " FROM exchanges WHERE exchange_id='$exchange_id';";
		#echo $query;
		$result = DBManager::executeQuery($query);
		while ($row = mysqli_fetch_assoc($result)) {
			$exchange = $row;
		}
		return $exchange;
	}

	public static function getDetailExchange($exchange_id) {
		$query = "SELECT * FROM classes NATURAL JOIN (SELECT * FROM exchanges NATURAL JOIN users) A WHERE exchange_id=$exchange_id;";
		#echo $query;
		$result = DBManager::executeQuery($query);
		while ($row = mysqli_fetch_assoc($result)) {
			$exchange = $row;
		}
		return $exchange;
	}

	public static function getCompetitorCount($exchange_id) {
		$query = "SELECT COUNT(*) FROM exchanges WHERE " . self::$exchange_compete_for . " = $exchange_id;";
		#echo query . "<br>";
		$result = DBManager::executeQuery($query);
		while ($row = mysqli_fetch_assoc($result)) {
			$num = $row;
		}
		return $num['COUNT(*)'];
	}

	public static function getExchangeInLimit($condition, $start_num, $end_num) {
		$query = "SELECT " . self::$exchange_id . ", " . self::$class_for_exchange . ", " . self::$user_of_exchange . " FROM exchanges WHERE " . $condition . " LIMIT $start_num, $end_num;";
		#echo $query;
		$result = DBManager::executeQuery($query);
		$exchanges = array();
		for ($i = 0; $row = mysqli_fetch_assoc($result); $i++) {
			$exchanges[$i] = $row;
		}
		return $exchanges;
	}

	public static function getExchangeInLimitByName($class_name, $start_num, $end_num) {
		$query = "SELECT exchange_id, class_id, class_name, user_id, user_name FROM classes NATURAL JOIN (SELECT * FROM exchanges NATURAL JOIN users) A WHERE INSTR(class_name, '$class_name') > 0 LIMIT $start_num, $end_num;";
		#echo $query . "<br>";
		$result = DBManager::executeQuery($query);
		$exchanges = array();
		for ($i = 0; $row = mysqli_fetch_assoc($result); $i++) {
			$exchanges[$i] = $row;
		}
		return $exchanges;
	}

	public static function addExchange($class_id, $user_id) {
		$query = "INSERT INTO exchanges(" . self::$class_for_exchange . ", " . self::$user_of_exchange . ", " . self::$exchange_status . ") VALUES($class_id, $user_id, 0);";
		#echo $query . "<br>";
		$result = DBManager::executeQuery($query);
	}

	public static function addCompete($competitor_id, $host_id) {
		$query = "UPDATE exchanges SET " . self::$exchange_compete_for . " = $host_id WHERE exchange_id = $competitor_id;";
		echo $query . "<br>";
		DBManager::executeQuery($query);
	}
}
?>
