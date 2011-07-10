<html>
<?php
session_start();
include_once('config.php');
include_once('model/usermanager.php');
if (!(isset($_SESSION['id']) && isset($_SESSION['username']) && ($_SESSION['id'] != "") && ($_SESSION['username'] != ""))) {
	header("Location: http://" . $domain . "signin.php");
} else {
	$user_info = UserManager::getUserInfoById($_SESSION['id']);
?>
	<head>
		<title>交大课程交易中心</title>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<link rel="stylesheet" type="text/css" href="css/style.css" />
		<script type="text/javascript" src="js/jquery-1.6.2.min.js"></script>
		<script type="text/javascript">
			var num = 13;
			var begin_num = 0;

			function prevPage() {
				if (begin_num >= 0) {
					begin_num -= 1;
				}
				getExchanges(begin_num * num, num);
			}

			function nextPage() {
				begin_num += 1;
				getExchanges(begin_num * num, num);
			}

			function renderPageTable() {
				pageHTML = "<tr><td>";
				if (begin_num != 0) {
					pageHTML += "<input type='button' value='上一页' onclick='prevPage()' />";
				}
				pageHTML += "</td><td><input type='button' value='下一页' onclick='nextPage()' /></td></tr>";
				$(".page").html(pageHTML);
			}

			function addExchange() {
				link = "<?php echo "http://" . $domain . "model/Exchanges/addExchange.php"; ?>";
				if ($("#class-filter").val() != "") {
					link += "?class_name=" + $("#class-filter").val();
				}
				location.href=link;
			}

			function showAnExchange(id) {
				$.ajax({
					type: "GET",
					url: "showExchange.php",
					data: "exchange_id=" + id,
					dataType: "HTML",
					success: function(response) {
						$("#exchange-detail-table").html(response);
					}
				});
			}

			function showExchanges(exchanges) {
				var theList = "<tr><th>交易号</th><th>课程</th><th>交易拥有者</th><th>竞标的交易</th><th>竞标此交易的交易数量</th></tr>";
				for (var i = 0; i < exchanges.length; i++) {
					theList += "<tr onclick='showAnExchange(" + exchanges[i].exchange_id + ")'><td>" + exchanges[i].exchange_id + "</td><td>" + exchanges[i].class_name + "</td><td>" + exchanges[i].user_name + "</td><td>";
					if (exchanges[i].compete_for) {
						theList += exchanges[i].compete_for;
					} else {
						theList += "无";
					}
					theList += "</td><td>";
					if (exchanges[i].count) {
						theList += exchanges[i].count;
					}
					theList += "</td></tr>";
				}
				$("#exchanges-list").html(theList);
				renderPageTable();
			}

			function getExchangeEntries(begin_num, end_num) {
				begin_num = begin_num ? begin_num : 0;
				end_num = end_num ? end_num : num;
				$.ajax({
					type: "GET",
					url: "model/Exchanges/getExchanges.php",
					data: "begin_num=" + begin_num + "&end_num=" + end_num,
					dataType: "json",
					success: function(exchanges) {
							showExchanges(exchanges);
						}
					});
			}

			function getExchanges(begin_num, end_num) {
				begin_num = begin_num ? begin_num : 0;
				end_num = end_num ? end_num : num;
				$.ajax({
					method: "GET",
					url: "http://<?php echo $domain ?>model/Exchanges/getExchangesByName.php",
					data: "class_name=" + $("#class-filter").val() + "&begin_num=" + begin_num + "&end_num=" + end_num,
					dataType: "json",
					success: function(exchanges) {
						showExchanges(exchanges);
					}
				});
			}

			$(document).ready(function() {
				getExchangeEntries(begin_num * 30, num);
			});
		</script>
	</head>
	<body>
		<h2>交大课程交易中心</h2>
		<div class="exchange-content">
			<div id="add-exchange">
				<table>
					<tr>
						<td colspan="2">
							欢迎你,<?php echo $user_info['user_name']; ?>!
						</td>
						<td>
							<input type="button" value="登出" onclick="location.href='logout.php';" />
					</tr>
					<tr>
						<td>
							<input type="text" id="class-filter" onchange="getExchanges()" />
						</td>
						<td>
							<input type="button" value="添加一个新交易" onclick="addExchange()"/>
						</td>
						<?php
						if (UserManager::confirmAuthority($user_info['user_id'], 1)) {
						?>
						<td>
							<input type="button" value="添加一门新课程" onclick="location.href='http://<?php echo $domain; ?>addClass.php';" />
						</td>
						<?php
						}
						?>
					</tr>
				</table>
			</div>
			<div id="exchanges">
				<table id="exchanges-list">
				</table>
				<table class="page">
				</table>
			</div>
		</div>
		<div class="exchange-detail">
			<table id="exchange-detail-table">
			</table>
		</div>
	</body>
<?php
}
?>
</html>
