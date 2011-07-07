<?php
include_once('DBManager.php');
class ClassManager {
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
		$query = "SELECT classtime_id FROM classtime WHERE start_time=$start_time AND end_time=$end_time AND day_of_week=$day_of_week;";
		$result = DBManager::executeQuery($query);
		if (empty($result)) {
			$query = "INSERT classtime(start_time, end_time, day_of_week) VALUES($start_time, $end_time, $day_of_week);";
			$classtime_id = DBManager::executeInsert($query);
		} else {
			$classtime_id = mysqli_fetch_assoc($result);
			$classtime_id = $classtime_id['classtime_id'];
		}
		$query = "INSERT INTO takes(class_id, classtime_id) VALUES($class_id, $classtime_id);";
		DBManager::executeQuery($query);
	}
}
?>
