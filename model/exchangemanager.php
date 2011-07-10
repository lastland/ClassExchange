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
		$query = "SELECT * FROM classes, exchanges, users WHERE exchanges.user_id=users.user_id AND exchanges.class_id=classes.class_id AND exchanges.exchange_id=$exchange_id;";
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
		$query = "SELECT exchanges.exchange_id, exchanges.exc_exchange_id, classes.class_id, classes.class_name, users.user_id, users.user_name FROM classes, exchanges, users WHERE exchanges.user_id = users.user_id AND exchanges.class_id = classes.class_id AND $condition ORDER BY exchange_id DESC LIMIT $start_num, $end_num;";
		#echo $query;
		$result = DBManager::executeQuery($query);
		$exchanges = array();
		for ($i = 0; $row = mysqli_fetch_assoc($result); $i++) {
			$exchanges[$i] = $row;
		}
		return $exchanges;
	}

	public static function getExchangeInLimitByName($class_name, $start_num, $end_num) {
		$query = "SELECT exchanges.exchange_id, exchanges.exc_exchange_id, classes.class_id, classes.class_name, users.user_id, users.user_name FROM users, exchanges, classes WHERE exchanges.user_id = users.user_id AND exchanges.class_id = classes.class_id AND INSTR(classes.class_name, '$class_name') > 0 AND exchanges.exchange_status=0 ORDER BY exchange_id DESC LIMIT $start_num, $end_num;";
		#echo $query . "<br>";
		$result = DBManager::executeQuery($query);
		$exchanges = array();
		for ($i = 0; $row = mysqli_fetch_assoc($result); $i++) {
			$exchanges[$i] = $row;
		}
		return $exchanges;
	}

	public static function getExchangeAvailableToCompete($user_id, $begin_num, $end_num) {
		$query = "SELECT * FROM classes NATURAL JOIN exchanges WHERE exchanges.user_id=$user_id AND exchanges.exchange_status=0 LIMIT $begin_num, $end_num";
		#echo $query . "<br>";
		$result = DBManager::executeQuery($query);
		$exchanges = array();
		for ($i = 0; $row = mysqli_fetch_assoc($result); $i++) {
			$exchanges[$i] = $row;
		}
		return $exchanges;
	}

	public static function getExchangeCompeteForSomeone($exchange_id) {
		$query = "SELECT * FROM classes NATURAL JOIN exchanges WHERE exchanges.exc_exchange_id=$exchange_id;";
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
		#echo $query . "<br>";
		DBManager::executeQuery($query);
	}

	public static function makeDeal($competitor_id, $host_id) {
		$queries = array(
			"UPDATE exchanges SET exc_exchange_id3=$host_id WHERE exchange_id=$competitor_id;",
			"UPDATE exchanges SET exc_exchange_id2=$competitor_id WHERE exchange_id=$host_id;", 
			"UPDATE exchanges SET exc_exchange_id=NULL WHERE exchange_id=$competitor_id;",
			"UPDATE exchanges SET exc_exchange_id=NULL WHERE exchange_id=$host_id;",
			"UPDATE exchanges SET exchange_status=1 WHERE exchange_id=$competitor_id;",
			"UPDATE exchanges SET exchange_status=1 WHERE exchange_id=$host_id;");
		#print_r($queries);
		DBManager::executeTransaction($queries);
	}

	public static function undoDeal($competitor_id) {
		$query = "UPDATE exchanges SET exc_exchange_id=NULL WHERE exchange_id=$competitor_id;";
		#echo $query . "<br>";
		DBManager::executeQuery($query);
	}
}
?>
