<?php
include_once('../model/DBManager.php');
function getConnectionTest() {
	echo "Test for DBManager::getConnection<br>";
	if (DBManager::getConnection()) {
		echo "It is right!<br>";
	} else {
		echo "Something wrong here.<br>";
	}
}

function executeQueryTest() {
	echo "Test for DBManager::executeQuery<br>";
	$result = DBManager::executeQuery('show tables');
	if ($row = mysqli_fetch_assoc($result)) {
		echo "It is right!<br>";
	} else {
		echo "Something wrong here.<br>";
	}
}

echo "Start of Test<br>";
getConnectionTest();
executeQueryTest();
echo "End of Test<br>";
?>
