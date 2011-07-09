<?php
include_once('../../config.php');
include_once('../exchangemanager.php');
include_once('../Users/SessionJudge.php');
$success = false;
if (isset($_POST['host_id']) && isset($_POST['competitor_id'])) {
	$host_info = ExchangeManager::getDetailExchange($_POST['host_id']);
	$competitor_info = ExchangeManager::getDetailExchange($_POST['competitor_id']);
	if ($host_info['user_id'] == $_SESSION['id'] && $competitor_info['exc_exchange_id'] == $host_info['exchange_id']) {
		ExchangeManager::makeDeal($competitor_info['exchange_id'], $host_info['exchange_id']);
		$success = true;
	}
}
if ($success) {
	echo "success";
} else {
	echo "failed";
}
?>
