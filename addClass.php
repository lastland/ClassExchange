<html>
	<head>
		<title>交大课程交易中心</title>
		<meta http-equiv="Content-Type" content="html/text; charset=UTF-8" />
		<link rel="stylesheet" type="text/css" href="css/style.css" />
		<script type="text/javascript" src="js/jquery-1.6.2.min.js"></script>
	</head>
	<body>
		<h2>添加一门课程</h2>
		<form action="model/Classes/addAClass.php" method="post">
			<table class="classtable">
				<tr>
					<td>课程名称：</td>
					<td><input type="text" id="classname" name="classname"/></td>
					<td id="classname-hint"></td>
				</tr>
				<tr>
					<td>课程类型：</td>
					<td><input type="text" id="classtype" name="classtype"/></td>
					<td id="classtype-hint"></td>
				</tr>
				<tr>
					<td>课程介绍：</td>
					<td colspan="2">
						<textarea id="classdescription" name="classdescription" cols="40" rows="5"></textarea>
					</td>
				</tr>
				<tr>
					<td colspan="2">
						<input type="submit" value="提交"/>
					</td>
					<td>
						<input type="button" value="回到首页" onclick="location.href='home.php'"/>
					</td>
				</tr>
			</table>
		</form>
	</body>
</html>
