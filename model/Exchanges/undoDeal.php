<?php
include_once('../../config.php');
include_once('../exchangemanager.php');
include_once('../Users/SessionJudge.php');
$success = false;
if (isset($_POST['exchange_id'])) {
	$exchange = ExchangeManager::getExchange($_POST['exchange_id']);
	if ($exchange['user_id'] == $_SESSION['id']) {
		ExchangeManager::undoDeal($exchange['exchange_id']);
		$success = true;
	}
}
if ($success) {
	echo "success";
} else {
	echo "failed";
}
?>
