<?php
include_once('DBManager.php');
class ExchangeManager {
	private static $exchange_id = 'exchange_id';
	private static $exchange_status = 'exchange_status';
	private static $class_for_exchange = 'class_id';
	private static $exchange_competer_for = 'exc_exchange_id';
	private static $user_of_exchange = 'user_id';
	private static $final_host = 'exc_exchange_id3';
	private static $final_competitor = 'exc_exchange_id2';

	public static function getExchange($exchange_id) {
		$query = "SELECT " . self::$exchange_id . ", " . self::$class_for_exchange . ", " . self::$user_of_exchange . " FROM exchanges WHERE exchange_id='$exchange_id';";
		#echo $query;
		$result = DBManager::executeQuery($query);
		$exchanges = array();
		for ($i = 0; $row = mysqli_fetch_assoc($result); $i++) {
			$exchanges[$i] = $row;
		}
		return $exchanges;
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

	public static function addExchange($class_id, $user_id) {
		$query = "INSERT INTO exchanges(" . self::$class_for_exchange . ", " . self::$user_of_exchange . ", " . self::$exchange_status . ") VALUES($class_id, $user_id, 0);";
		#echo $query . "<br>";
		$result = DBManager::executeQuery($query);
	}
}
?>