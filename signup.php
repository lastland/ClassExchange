<html>
	<head>
		<title>交大课程交易中心</title>
		<meta http-equiv="Content-Type" content="html/text; charset=UTF-8"/>
	</head>
	<body>
		<form action="register.php" method="post">
			<table class="regtable">
				<tr>
					<td>用户名：</td>
					<td><input type="text" name="username"/></td>
				</tr>
				<tr>
					<td>密码：</td>
					<td><input type="password" name="password_first"/></td>
				</tr>
				<tr>
					<td>确认密码：</td>
					<td><input type="password" name="password_confirm"/></td>
				</tr>
				<tr>
					<td>邮箱：</td>
					<td><input type="text" name="email"/></td>
				</tr>
				<tr>
					<td>手机：</td>
					<td><input type="text" name="mobile"/></td>
				</tr>
				<tr>
					<td>简介：</td>
					<td>
						<textarea name="description" cols="30" rows="3"></textarea>
					</td>
				</tr>
				<tr>
					<td>
						<input type="submit" value="注册"/>
					</td>
					<td>
						已经有帐号？快<a href="signin.php">登录</a>吧！
					</td>
				</tr>
			</table>
		</form>
	</body>
</html>

