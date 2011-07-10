<?php
include_once('../exchangemanager.php');
if (isset($_GET['begin_num']) && isset($_GET['end_num']) && isset($_GET['class_name'])) {
	$exchange_info = ExchangeManager::getExchangeInLimitByName($_GET['class_name'], $_GET['begin_num'], $_GET['end_num']);
	for ($i = 0; $i < sizeof($exchange_info); $i++) {
		$exchange_info[$i]['count'] = ExchangeManager::getCompetitorCount($exchange_info[$i]['exchange_id']);
		$exchange_info[$i]['compete_for'] = $exchange_info[$i]['exc_exchange_id'];
	}
	echo json_encode($exchange_info);
}
?>
