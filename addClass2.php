<html>
	<head>
		<title>交大课程交易中心</title>
		<meta http-equiv="Content-Type" content="html/text; charset=UTF-8" />
		<link rel="stylesheet" type="text/css" href="css/style.css" />
		<script type="text/javascript" src="js/jquery-1.6.2.min.js"></script>
		<script type="text/javascript">
			var tableHTML = new Array();
			tableHTML[0] = "<tr><th>开始课时</th><th>结束课时</th><th>日期</th></tr>";
			var selectBeginTime = new Array();
			var selectEndTime = new Array();
			var selectDay = new Array();
			var tableHTMLPointer = 0;
			var timeTable = new Array("", "一", "二", "三", "四", "五", "六", "七", "八", "九", "十", "十一", "十二", "十三", "十四");
			var dayTable = new Array("", "一", "二", "三", "四", "五", "六", "日");

			function getBeginTimeHTML(beginTimeSelected) {
				beginTimeSelected = beginTimeSelected ? beginTimeSelected : 1;
				var beginTimeHTML = "<select name='begin_time[]'>";
				var timeOptions = "";
				for (var i = 1; i <= 14; i++) {
					timeOptions += "<option value='" + i;
					if (i == beginTimeSelected) {
						timeOptions += "' selected='selected";
					}
					timeOptions += "'>第" + timeTable[i] + "节课</option>";
				}
				beginTimeHTML += timeOptions + "</select>";
				return beginTimeHTML;
			}

			function getEndTimeHTML(endTimeSelected) {
				endTimeSelected = endTimeSelected ? endTimeSelected : 1;
				var endTimeHTML = "<select name='end_time[]'>";
				var timeOptions = "";
				for (var i = 1; i <= 14; i++) {
					timeOptions += "<option value='" + i;
					if (i == endTimeSelected) {
						timeOptions += "' selected='selected";
					}
					timeOptions += "'>第" + timeTable[i] + "节课</option>";
				}
				endTimeHTML += timeOptions + "</select>";
				return endTimeHTML;
			}

                        function getDayHTML(daySelected) {
                        	daySelected = daySelected ? daySelected : 1;
				var dayHTML = "<select name='day[]'>";
				var dayOptions = "";
				for (var i = 1; i <= 7; i++) {
					dayOptions += "<option value='" + i;
					if (i == daySelected) {
						dayOptions += "' selected='selected";
					}
					dayOptions += "'>周" + dayTable[i] + "</option>";
				}
				dayHTML += dayOptions + "</select>";
				return dayHTML;
			}

			function getTime() {
				$.ajax({
					type: "GET",
					url: "model/Classes/getClassTime.php",
					data: "class_id=" + <?php echo $_GET['class_id'] ?>,
					dataType: "json",
					success: function(exchanges) {
						for (var i = 0; i < exchanges.length; i++) {
							addATime(exchanges[i]['start_time'], exchanges[i]['end_time'], exchanges[i]['day_in_week']);
						}
					}
				});
			}
			
			function changeTime() {
				var output="";
				for (var i = 0; i <= tableHTMLPointer; i++) {
					output += tableHTML[i];
				}
				$(".classtimetable").html(output);
			}
			
			function addATime(beginTimeSelected, endTimeSelected, daySelected) {
				beginTimeSelected = beginTimeSelected ? beginTimeSelected : 1;
				endTimeSelected = endTimeSelected ? endTimeSelected : 1;
				daySelected = daySelected ? daySelected : 1;
				tableHTMLPointer += 1;
				tableHTML[tableHTMLPointer] = "<tr><td>" + getBeginTimeHTML(beginTimeSelected) + "</td><td>" + getEndTimeHTML(endTimeSelected) + "</td><td>" + getDayHTML(daySelected) + "</td></tr>";
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

				getTime();
			});
		</script>
	</head>
	<body>
		<h2>编辑上课时间</h2>
		<form action="model/Classes/editClass.php" method="post">
			<table class="classtimetable-head">
				<tr>
					<td>上课时间</td>
				</tr>
			</table>
			<table class="classtimetable">
			</table>
			<input type="hidden" name="class_id" value="<?php echo $_GET['class_id']; ?>"></input>
			<table class="classtimetable-tail">
				<tr>
					<td id="addtime-button">
						<input type="button" value="添加一个时间" />
					</td>
					<td id="deltime-button">
						<input type="button" value="删除一个时间" />
					</td>
					<td>
						<input type="submit" value="提交"/>
					</td>
				</tr>
			</table>
		</form>
	</body>
</html>
