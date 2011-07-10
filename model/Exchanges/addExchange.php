<html>
<?php
session_start();
include_once('../../config.php');
include_once('../exchangemanager.php');
?>
	<head>
		<title>交大课程交易中心</title>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<link rel="stylesheet" type="text/css" href="../../css/style.css" />
		<script type="text/javascript" src="../../js/jquery-1.6.2.min.js"></script>
		<script type="text/javascript">
		var begin_num = 0;
		var end_num=30;

		function prevPage() {
			if (begin_num >= 30) {
				begin_num -= 30;
			}
			getClasses($("#class-filter").val(), begin_num, end_num);
		}

		function nextPage() {
			begin_num += 30;
			getClasses($("#class-filter").val(), begin_num, end_num);
		}

		function renderPageTable() {
			pageHTML = "<tr><td>";
			if (begin_num != 0) {
				pageHTML += "<input type='button' value='上一页' onclick='prevPage()' />";
			}
			pageHTML += "</td><td><input type='button' value='下一页' onclick='nextPage()' /></td></tr>";
			$(".page").html(pageHTML);
		}

		function showAClass(class_id) {
			class_id = class_id ? class_id : 1;
			$.ajax({
				method: "GET",
				url: "../../showClass.php",
				data: "class_id=" + class_id,
				dataType: "HTML",
				success: function(response) {
					$("#class-list").html(response);
				}
			});
		}

		function showclasses(classes) {
			classesHTML = "<tr><th>课程编号</th><th>课程名称</th><th>课程类型</th><th>介绍</th></tr>";
			for (var i = 0; i < classes.length; i++) {
				classesHTML += "<tr onclick='showAClass(" + classes[i].class_id + ")'><td>" + classes[i].class_id + "</td><td>" +
					classes[i].class_name + "</td><td>" +
					classes[i].class_type + "</td><td>" +
					classes[i].class_introduction + "</td></tr>";
			}
			$(".classes-table").html(classesHTML);
			renderPageTable();
		}
	
		function getClasses(class_name, begin_num, end_num) {
			begin_num = begin_num ? begin_num : 0;
			end_num = end_num ? end_num : 30;
			$.ajax({
				method: "GET",
				url: "http://<?php echo $domain ?>model/Classes/getClass.php",
				data: "class_name=" + class_name + "&begin_num=" + begin_num + "&end_num=" + end_num,
				dataType: "json",
				success: function(classes) {
					showclasses(classes);
				}
			});
		}

		$(document).ready(function() {
			<?php
			if (isset($_GET['class_name'])) {
			?>
			getClasses("<?php echo $_GET['class_name']; ?>");
			<?php
			}
			?>

			$("#class-filter").change(function() {
				getClasses($("#class-filter").val());
			});
		});
		</script>
	</head>
	<body>
		<h2>添加一份交易</h2>
		<form action="addAExchange.php" method="post">
			<table class="classfilter-table">
				<tr>
					<td>课程：</td>
					<td><input type="text" id="class-filter"
					<?php
					if (isset($_GET['class_name'])) {
						echo " value='" . $_GET['class_name'] . "'";
					}
					?>/></td>
					<td><input type="button" value="回到首页" onclick="location.href='<?php echo "http://" . $domain . "home.php"; ?>';"/></a></td>
				</tr>
			</table>
			<div id="classes-list">
				<table class="classes-table">
				</table>
				<table class="page">
				</table>
			</div>
			<div id="class-list">
			</div>
		</form>
	</body>
</html>
