<?php
include_once('../exchangemanager.php');
include_once('../usermanager.php');
include_once('../ClassManager.php');
if (isset($_GET['begin_num']) && isset($_GET['end_num'])) {
	$exchange_info = ExchangeManager::getExchangeInLimit('exchange_status=0', $_GET['begin_num'], $_GET['end_num']);
	$final_info = array();
	for ($i = 0; $i < sizeof($exchange_info); $i++) {
		$user_info = UserManager::getUserInfoById($exchange_info[$i]['user_id']);
		$class_info = ClassManager::getClass($exchange_info[$i]['class_id']);
		$final_info[$i] = array();
		$final_info[$i]['exchange_id'] = $exchange_info[$i]['exchange_id'];
		$final_info[$i]['class_name'] = $class_info['class_name'];
		$final_info[$i]['user_name'] = $user_info['user_name'];
	}
	echo json_encode($final_info);
}
?>
