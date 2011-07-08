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
		function showclasses(classes) {
			classesHTML = "<tr><th>课程编号</th><th>课程名称</th><th>课程类型</th><th>介绍</th></tr>";
			for (var i = 0; i < classes.length; i++) {
				classesHTML += "<tr><td>" + classes[i].class_id + "</td><td>" +
					classes[i].class_name + "</td><td>" +
					classes[i].class_type + "</td><td>" +
					classes[i].class_introduction + "</td></tr>";
			}
			$(".classes-table").html(classesHTML);
		}
	
		function getClasses(class_name) {
			$.ajax({
				method: "GET",
				url: "http://<?php echo $domain ?>model/Classes/getClass.php",
				data: "class_name=" + class_name,
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
					<td>回到<a href="<?php echo "http://" . $domain . "home.php"; ?>">首页</a></td>
				</tr>
			</table>
			<table class="classes-table">
			</table>
		</form>
	</body>
</html>
