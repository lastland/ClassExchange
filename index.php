<html>
<head>
	<title>欢迎来到交大课程交易中心！</title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
	<?php
	session_start();
	include_once("config.php");
	if (isset($_SESSION['username']))
		header("Location: http://" . $domain . "home.php");
	else
		header("Location: http://" . $domain . "signin.php");
	?>
</head>
<body>
</body>
</html>
