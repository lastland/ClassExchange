<html>
	<head>
		<title>交大课程交易中心</title>
		<meta http-equiv="Content-Type" content="html/text; charset=UTF-8" />
		<link rel="stylesheet" type="text/css" href="css/style.css" />
		<script type="text/javascript" src="js/jquery-1.6.2.min.js"></script>
		<script type="text/javascript">
			var valid = 32;

			$(document).ready(function() {
				$("#username").change(function() {
					reg = /^\w{5,12}$/;
					if (!reg.test($("#username").val())) {
						$("#username-hint").html("用户名必须在5到12位");
						valid &= 62;
					} else {
						$("#username-hint").html("");
						valid |= 1;
					}
				});

				$("#password-first").change(function() {
					reg = /^\w{6,18}$/;
					if (!reg.test($("#password-first").val())) {
						$("#password-first-hint").html("密码至少为6位，最多18位");
						valid &= 61;
					} else {
						if ($("#password-first").val().length <= 10) {
							$("#password-first-hint").html("密码强度：弱");
						} else {
							regd = /^\d{11,18}$/;
							if (regd.test($("#password-first").val())) {
								$("#password-first-hint").html("密码强度：中");
							} else {
								$("#password-first-hint").html("密码强度：强");
							}
						}
						valid |= 2;
					}
				});

				$("#password-confirm").change(function() {
					if ($("#password-confirm").val() != $("#password-first").val()) {
						$("#password-confirm-hint").html("两次输入的密码必须一致！");
						valid &= 59;
					} else {
						$("#password-confirm-hint").html("");
						valid |= 4;
					}
				});

				$("#email").change(function() {
					reg = /^\w{3,}@(\w+\.)+\w+$/;
					if (!reg.test($("#email").val())) {
						$("#email-hint").html("请输入正确的邮箱");
						valid &= 55;
					} else {
						$("#email-hint").html("");
						valid |= 8;
					}
				});

				$("#mobile").change(function() {
					reg = /^\d{11}$/;
					if (!reg.test($("#mobile").val())) {
						$("#mobile-hint").html("请输入正确的手机号码");
						valid &= 47;
					} else {
						$("#mobile-hint").html("");
						valid |= 16;
					}
				});
			});

			function allValid() {
				if (valid != 63) {
					alert("请正确填写信息！");
					return false;
				} else {
					return true;
				}
			}
		</script>
	</head>
	<body>
		<h2>注册新用户</h2>
		<form action="register.php" method="post" onsubmit="return allValid()">
			<table class="regtable">
				<tr>
				<tr>
					<td>用户名：</td>
					<td><input type="text" id="username" name="username"/></td>
					<td id="username-hint"></td>
				</tr>
				<tr>
					<td>密码：</td>
					<td><input type="password" id="password-first" name="password_first"/></td>
					<td id="password-first-hint"></td>
				</tr>
				<tr>
					<td>确认密码：</td>
					<td><input type="password" id="password-confirm" name="password_confirm"/></td>
					<td id="password-confirm-hint"></td>
				</tr>
				<tr>
					<td>邮箱：</td>
					<td><input type="text" id="email" name="email"/></td>
					<td id="email-hint"></td>
				</tr>
				<tr>
					<td>手机：</td>
					<td><input type="text" id="mobile" name="mobile"/></td>
					<td id="mobile-hint"></td>
				</tr>
				<tr>
					<td>简介：</td>
					<td colspan="2">
						<textarea id="description" name="description" cols="40" rows="5"></textarea>
					</td>
				</tr>
				<tr>
					<td>
						<input type="submit" value="注册"/>
					</td>
					<td colspan="2">
						已经有帐号？快<a href="signin.php">登录</a>吧！
					</td>
				</tr>
			</table>
		</form>
	</body>
</html>

