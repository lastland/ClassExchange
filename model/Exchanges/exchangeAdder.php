<?php
include_once('../../config.php');
include_once('../Users/SessionJudge.php');
include_once('../exchangemanager.php');
$success = false;
if (isset($_POST['class_id']) && isset($_POST['user_id'])) {
	ExchangeManager::addExchange($_POST['class_id'], $_POST['user_id']);
	$success = true;
}
if ($success) {
	header("Location: http://" . $domain . "home.php");
} else {
	header("Location: http://" . $domain . "model/Exchanges/addExchange.php");
}
?>
