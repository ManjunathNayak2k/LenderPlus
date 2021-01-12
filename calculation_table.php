<?php 
extract($_POST);

$total = ($principal + ($principal * ($interest/100) * ($term/12))) ;
$penalty = $total/$term;

?>
<hr>
<table width="100%">
	<tr>
		<th class="text-center" width="50%">Total Payable Amount</th>
		<th class="text-center" width="50%">Penalty Amount</th>
	</tr>
	<tr>
		<td class="text-center"><small><?php echo number_format($total,2) ?></small></td>
		<td class="text-center"><small><?php echo number_format($penalty,2) ?></small></td>
	</tr>
</table>
<hr>
