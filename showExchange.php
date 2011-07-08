<?php
include_once('config.php');
include_once('model/Users/SessionJudge.php');
include_once('model/exchangemanager.php');
if (isset($_GET['exchange_id'])) {
	$exchange = ExchangeManager::getDetailExchange($_GET['exchange_id']);
?>
<tr>
	<th colspan="4"><?php echo $exchange['class_name']; ?></th>
</tr>
<tr>
	<td>交易编号：</td>
	<td colspan="3"><?php echo $exchange['exchange_id']; ?></td>
</tr>
<tr>
	<td>交易主：</td>
	<td colspan="3"><?php echo $exchange['user_name']; ?></td>
</tr>
<tr>
	<td>课程编号：</td>
	<td><?php echo $exchange['class_id']; ?></td>
	<td>课程名称：</td>
	<td><?php echo $exchange['class_name']; ?></td>
</tr>
<?php
}
?>
