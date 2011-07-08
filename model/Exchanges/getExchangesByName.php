<?php
include_once('../exchangemanager.php');
if (isset($_GET['begin_num']) && isset($_GET['end_num']) && isset($_GET['class_name'])) {
	$exchange_info = ExchangeManager::getExchangeInLimitByName($_GET['class_name'], $_GET['begin_num'], $_GET['end_num']);
	echo json_encode($exchange_info);
}
?>
