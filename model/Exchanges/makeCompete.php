<?php
include_once('../../config.php');
include_once('../Users/SessionJudge.php');
include_once('../exchangemanager.php');
if (isset($_POST['guest_id']) && isset($_POST['host_id'])) {
	ExchangeManager::addCompete($_POST['guest_id'], $_POST['host_id']);
	echo "success";
} else {
	echo "failed";
}
?>
