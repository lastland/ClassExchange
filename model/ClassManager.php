<?php
include_once('DBManager.php');
class ClassManager {
	public static function getClassByName($class_name) {
		$query = "SELECT class_id, class_name, class_type, class_introduction, class_remark FROM classes WHERE INSTR(class_name, '$class_name') > 0;";
		#echo $query;
		$result = DBManager::executeQuery($query);
		$class_info = array();
		for ($i = 0; $row = mysqli_fetch_assoc($result); $i++) {
			$class_info[$i] = $row;
		}
		return $class_info;
	}

	public static function getClassInLimitByName($class_name, $begin_num, $end_num) {
		$query = "SELECT class_id, class_name, class_type, class_introduction, class_remark FROM classes WHERE INSTR(class_name, '$class_name') > 0 LIMIT $begin_num, $end_num;";
		#echo $query . "<br>";
		$result = DBManager::executeQuery($query);
		$class_info = array();
		for ($i = 0; $row = mysqli_fetch_assoc($result); $i++) {
			$class_info[$i] = $row;
		}
		return $class_info;
	}
	
	public static function getClass($class_id) {
		$query = "SELECT class_id, class_name, class_type, class_introduction, class_remark FROM classes where class_id=$class_id;";
		#echo $query . "<br>";
		$result = DBManager::executeQuery($query);
		$class_info = array();
		while ($row = mysqli_fetch_assoc($result)) {
			$class_info = $row;
		}
		return $class_info;
	}

	public static function addClass($class_name, $class_type, $class_introduction) {
		$link = DBManager::getConnection();
		$class_name = mysqli_real_escape_string($link, $class_name);
		$class_type = mysqli_real_escape_string($link, $class_type);
		$class_introduction = mysqli_real_escape_string($link, $class_introduction);
		$query = "INSERT INTO classes(class_name, class_type, class_introduction) VALUES ('$class_name', '$class_type', '$class_introduction');";
		#echo $query . "<br>";
		return DBManager::executeInsert($query);
	}

	public static function addClassTime($class_id, $start_time, $end_time, $day_of_week) {
		$query = "SELECT classtime_id FROM classtime WHERE start_time=$start_time AND end_time=$end_time AND day_in_week=$day_of_week;";
		#echo $query . "<br>";
		$result = DBManager::executeQuery($query);
		$classtime_id = mysqli_fetch_assoc($result);
		#print_r($classtime_id);
		if (empty($classtime_id)) {
			$query = "INSERT INTO classtime(start_time, end_time, day_in_week) VALUES($start_time, $end_time, $day_of_week);";
			#echo $query;
			$classtime_id = DBManager::executeInsert($query);
		} else {
			$classtime_id = $classtime_id['classtime_id'];
		}
		$query = "INSERT INTO takes(class_id, classtime_id) VALUES($class_id, $classtime_id);";
		#echo $query;
		DBManager::executeQuery($query);
	}

	public static function delClassTime($class_id) {
		$query = "DELETE FROM takes WHERE class_id=$class_id;";
		DBManager::executeQuery($query);
	}

	public static function getClassTime($class_id) {
		$query = "SELECT classtime.start_time, classtime.end_time, classtime.day_in_week FROM takes NATURAL JOIN classtime WHERE takes.class_id=$class_id;"; 
		$result = DBManager::executeQuery($query);
		$classtime_info = array();
		for ($i = 0; $row = mysqli_fetch_assoc($result); $i++) {
			$classtime_info[$i] = $row;
		}
		return $classtime_info;
	}
}
?>
