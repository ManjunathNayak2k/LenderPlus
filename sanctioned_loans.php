
<?php include 'db_connect.php' ?>

<div class="container-fluid">
	<div class="col-lg-12">
		<div class="card">
			<div class="card-header">
				<large class="card-title">
					<b>Sanctioned Loans List</b>

				</large>
				
			</div>
			<div class="card-body">
			<?php if($_SESSION['login_type'] == 1): ?>
				<table class="table table-bordered" id="loan-list">
					<!-- <colgroup>
						<col width="10%">
						<col width="25%">
						<col width="25%">
						<col width="20%">
						<col width="10%">
						<col width="10%">
					</colgroup> -->
					<thead>
						<tr>
							<th class="text-center">#</th>
							<th class="text-center">Lender</th>
							<th class="text-center">Borrower</th>
							<th class="text-center">Loan Details</th>
							<th class="text-center">Status</th>
						</tr>
					</thead>
					<tbody>
					
						<?php
							
							$i=1;								
							$loan = $conn->query("SELECT *,loan.status as st, borrower.PhoneNumber as bpn, lender.PhoneNumber as lpn, borrower.FirstName as bfn, borrower.LastName as bln, lender.FirstName as lfn, lender.LastName as lln FROM loan,borrower,lender,loan_application WHERE loan.BorrowerID = borrower.BorrowerID and loan.LenderID= lender.LenderID and loan.ApplicationID = loan_application.ApplicationID");
							// echo($conn->error);
							while($row = $loan->fetch_assoc()):
						 ?>
						 <tr>
						 	
						 <td class="text-center"><?php echo $i++ ?></td>
						 	<td>
						 		<p>Name :  <b><?php echo $row['lfn'] ?></b>  <b><?php echo $row['lln'] ?></b></p>
						 		<p><small>Contact # :<b><?php echo $row['lpn'] ?></small></b></p>

						 	</td>
							 <td>
						 		<p>Name :  <b><?php echo $row['bfn'] ?></b>  <b><?php echo $row['bln'] ?></b></p>
						 		<p><small>Contact # :<b><?php echo $row['bpn'] ?></small></b></p>

						 	</td>
						 	<td>
						 		<p>Principal :  <b>Rs. <?php echo $row['Principal'] ?></b></p>
								 <p>Term :  <b><?php echo $row['Term'] ?> months</b></p>
								 <p>Rate:  <b><?php echo $row['InterestRate'] ?> %</b></p>

							 </td>

							 <td class="text-center">
						 		<?php if($row['st'] == 0): ?>
						 			<span class="badge badge-danger">Not Paid</span>
						 		<?php elseif($row['st'] == 1): ?>
						 			<span class="badge badge-success">Paid</span>
						 		<?php endif; ?>
						 	</td>

						 </tr>
						<?php endwhile; ?>
					
					
					</tbody>
				</table>
			<?php endif; ?>
			<?php if($_SESSION['login_type'] == 2): ?>
				<table class="table table-bordered" id="loan-list">
					<!-- <colgroup>
						<col width="10%">
						<col width="25%">
						<col width="25%">
						<col width="20%">
						<col width="10%">
						<col width="10%">
					</colgroup> -->
					<thead>
						<tr>
							<th class="text-center">#</th>
							<th class="text-center">Lender</th>
							<th class="text-center">Borrower</th>
							<th class="text-center">Loan Details</th>
							<th class="text-center">Status</th>
							<th class="text-center">Action</th>
						</tr>
					</thead>
					<tbody>
					
						<?php
							
							$i=1;								
							$loan = $conn->query("SELECT *,loan.status as st, borrower.PhoneNumber as bpn, lender.PhoneNumber as lpn, borrower.FirstName as bfn, borrower.LastName as bln, lender.FirstName as lfn, lender.LastName as lln FROM loan,borrower,lender,loan_application WHERE loan.BorrowerID = borrower.BorrowerID and loan.LenderID= lender.LenderID and loan.ApplicationID = loan_application.ApplicationID and loan.LenderID =".$_SESSION['login_id']);
							// echo($conn->error);
							while($row = $loan->fetch_assoc()):
						 ?>
						 <tr>
						 	
						 <td class="text-center"><?php echo $i++ ?></td>
						 	<td>
						 		<p>Name :  <b><?php echo $row['lfn'] ?></b>  <b><?php echo $row['lln'] ?></b></p>
						 		<p><small>Contact # :<b><?php echo $row['lpn'] ?></small></b></p>

						 	</td>
							 <td>
						 		<p>Name :  <b><?php echo $row['bfn'] ?></b>  <b><?php echo $row['bln'] ?></b></p>
						 		<p><small>Contact # :<b><?php echo $row['bpn'] ?></small></b></p>

						 	</td>
						 	<td>
						 		<p>Principal :  <b>Rs. <?php echo $row['Principal'] ?></b></p>
								 <p>Term :  <b><?php echo $row['Term'] ?> months</b></p>
								 <p>Rate:  <b><?php echo $row['InterestRate'] ?> %</b></p>

							 </td>

							 <td class="text-center">
						 		<?php if($row['st'] == 0): ?>
						 			<span class="badge badge-danger">Not Paid</span>
						 		<?php elseif($row['st'] == 1): ?>
						 			<span class="badge badge-success">Paid</span>
						 		<?php endif; ?>
						 	</td>
							 <td class="text-center">
							 <?php if($row['st'] == 0): ?>
						 			<button class="btn btn-outline-primary btn-sm edit_loan" type="button" data-id="<?php echo $row['ApplicationID'] ?>"><i class="fa fa-edit"></i></button>
									 <?php endif; ?>
						 	</td>
						 </tr>
						<?php endwhile; ?>
					
					
					</tbody>
				</table>
			<?php endif; ?>
			<?php if($_SESSION['login_type'] == 3): ?>
				
				<table class="table table-bordered" id="loan-list">
					<!-- <colgroup>
						<col width="10%">
						<col width="25%">
						<col width="25%">
						<col width="20%">
						<col width="10%">
						<col width="10%">
					</colgroup> -->
					<thead>
						<tr>
							<th class="text-center">#</th>
							<th class="text-center">Lender</th>
							<th class="text-center">Borrower</th>
							<th class="text-center">Loan Details</th>
							<th class="text-center">Status</th>
						</tr>
					</thead>
					<tbody>
					
						<?php
							echo ($_SESSION['login_id']);
							$i=1;								
							$loan = $conn->query("SELECT *,loan.status as st, borrower.PhoneNumber as bpn, lender.PhoneNumber as lpn, borrower.FirstName as bfn, borrower.LastName as bln, lender.FirstName as lfn, lender.LastName as lln FROM loan,borrower,lender,loan_application WHERE loan.BorrowerID = borrower.BorrowerID and loan.LenderID= lender.LenderID and loan.ApplicationID = loan_application.ApplicationID and loan.BorrowerID =".$_SESSION['login_id']);
							// echo($conn->error);
							while($row = $loan->fetch_assoc()):
						 ?>
						 <tr>
						 	
						 <td class="text-center"><?php echo $i++ ?></td>
						 	<td>
						 		<p>Name :  <b><?php echo $row['lfn'] ?></b>  <b><?php echo $row['lln'] ?></b></p>
						 		<p><small>Contact # :<b><?php echo $row['lpn'] ?></small></b></p>

						 	</td>
							 <td>
						 		<p>Name :  <b><?php echo $row['bfn'] ?></b>  <b><?php echo $row['bln'] ?></b></p>
						 		<p><small>Contact # :<b><?php echo $row['bpn'] ?></small></b></p>

						 	</td>
						 	<td>
						 		<p>Principal :  <b>Rs. <?php echo $row['Principal'] ?></b></p>
								 <p>Term :  <b><?php echo $row['Term'] ?> months</b></p>
								 <p>Rate:  <b><?php echo $row['InterestRate'] ?> %</b></p>

							 </td>

							 <td class="text-center">
						 		<?php if($row['st'] == 0): ?>
						 			<span class="badge badge-danger">Not Paid</span>
						 		<?php elseif($row['st'] == 1): ?>
						 			<span class="badge badge-success">Paid</span>
						 		<?php endif; ?>
						 	</td>

						 </tr>
						<?php endwhile; ?>
					
					
					</tbody>
				</table>
			<?php endif; ?>
			</div>
		</div>
	</div>
</div>
<style>
	td p {
		margin:unset;
	}
	td img {
	    width: 8vw;
	    height: 12vh;
	}
	td{
		vertical-align: middle !important;
	}
</style>	
<script>
	$('#loan-list').dataTable()
	$('#new_application').click(function(){
		uni_modal("New Loan Application","manage_sanctioned_loan.php",'mid-large')
	})
	$('.edit_loan').click(function(){
		uni_modal("Edit Loan","manage_sanctioned_loan.php?id="+$(this).attr('data-id'),'mid-large')
	})
	$('.sanction_loan').click(function(){
		uni_modal("Sanction Loan","sanction_loan.php?id="+$(this).attr('data-id'),'mid-large')
	})
	$('.delete_loan').click(function(){
		_conf("Are you sure to delete this data?","delete_loan",[$(this).attr('data-id')])
	})
function delete_loan($id){
		start_load()
		$.ajax({
			url:'ajax.php?action=delete_loan',
			method:'POST',
			data:{id:$id},
			success:function(resp){
				if(resp==1){
					alert_toast("Loan successfully deleted",'success')
					setTimeout(function(){
						location.reload()
					},1500)

				}
				else{
					alert(resp)
				}
			}
		})
	}
</script>