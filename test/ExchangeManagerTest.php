<?php
include_once('../model/exchangemanager.php');
function addExchangeTest() {
	echo "Test for addExchange begin<br>";
	ExchangeManager::addExchange(1, 1);
	echo "Test for addExchange end<br>";
}

function getExchangeTest() {
	echo "Test for getExchange begin<br>";
	$result = ExchangeManager::getExchange(1);
	print_r($result);
	echo "Test for getExchange end<br>";
}

function getExchangeInLimitTest() {
	echo "Test for getExchangeInLimit begin<br>";
	$result = ExchangeManager::getExchangeInLimit('exchange_id > 0', 0, 30);
	print_r($result);
	echo "Test for getExchangeInLimit end<br>";
}

function addCompeteTest() {
	echo "Test for addCompete begin<br>";
	ExchangeManager::addCompete(1, 7);
	echo "Test for addCompete end<br>";
}

echo "Test begin<br>";
#addExchangeTest();
#getExchangeTest();
#getExchangeInLimitTest();
#addCompeteTest();
echo "Test end<br>";
?>
