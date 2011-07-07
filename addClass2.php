<html>
	<head>
		<title>交大课程交易中心</title>
		<meta http-equiv="Content-Type" content="html/text; charset=UTF-8" />
		<link rel="stylesheet" type="text/css" href="css/style.css" />
		<script type="text/javascript" src="js/jquery-1.6.2.min.js"></script>
		<script type="text/javascript">
			var tableHTML = new Array();
			tableHTML[0] = "<tr><th>开始课时</th><th>结束课时</th><th>日期</th></tr>";
			var tableHTMLPointer = 0;
			var beginTimeHTML = "<select name='begin_time[]'>";
			var endTimeHTML = "<select name='end_time[]'>";
			var dayHTML = "<select name='day[]'>";
			var timeOptions = "";
			var dayOptions = "";
			var timeTable = new Array("", "一", "二", "三", "四", "五", "六", "七", "八", "九", "十", "十一", "十二", "十三", "十四");
			var dayTable = new Array("", "一", "二", "三", "四", "五", "六", "日");
			for (var i = 1; i <= 14; i++) {
				timeOptions += "<option value='" + i + "'>第" + timeTable[i] + "节课</option>";
				if (i <= 7) {
					dayOptions += "<option value='" + i + "'>周" + dayTable[i] + "</option>";
				}
			}
			beginTimeHTML += timeOptions + "</select>";
			endTimeHTML += timeOptions + "</select>";
			dayHTML += dayOptions + "</select>";
			
			function changeTime() {
				var output="";
				for (var i = 0; i <= tableHTMLPointer; i++) {
					output += tableHTML[i];
				}
				$(".classtimetable").html(output);
			}
			
			function addATime() {
				tableHTMLPointer += 1;
				tableHTML[tableHTMLPointer] = "<tr><td>" + beginTimeHTML + "</td><td>" + endTimeHTML + "</td><td>" + dayHTML + "</td></tr>";
				changeTime();
			}
			
			function delTime() {
				tableHTMLPointer -= 1;
				changeTime();
			}

			$(document).ready(function() {
				$("#addtime-button").click(function() {
					addATime();
				});
				
				$("#deltime-button").click(function() {
					delTime();
				});

				addATime();
			});
		</script>
	</head>
	<body>
		<h2>编辑上课时间</h2>
		<form action="model/Classes/editClass.php" method="post">
			<table class="classtimetable-head">
				<tr>
					<td>上课时间</td>
					<td id="addtime-button">
						添加一个时间
					</td>
					<td id="deltime-button">
						删除一个时间
					</td>
				</tr>
			</table>
			<table class="classtimetable">
			</table>
			<input type="hidden" name="class_id" value="<?php echo $_GET['class_id']; ?>"></input>
			<input type="submit" value="提交"/>
		</form>
	</body>
</html>
