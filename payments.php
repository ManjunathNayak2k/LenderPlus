
<?php include 'db_connect.php' ?>

<div class="container-fluid">
	<div class="col-lg-12">
		<div class="card">
			<div class="card-header">
				<large class="card-title">
					<b>Payments List</b>

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
							<th class="text-center">Payment Amount</th>
							<th class="text-center">Payment Date</th>

						</tr>
					</thead>
					<tbody>
					
						<?php
							
							$i=1;								
							$loan = $conn->query("SELECT * , borrower.PhoneNumber as bpn, lender.PhoneNumber as lpn, borrower.FirstName as bfn, borrower.LastName as bln, lender.FirstName as lfn, lender.LastName as lln FROM borrower,lender,payments,loan,loan_application WHERE payments.BorrowerID = borrower.BorrowerID and payments.LenderID = lender.LenderID and payments.LoanID=loan.LoanID and loan_application.ApplicationID=loan.ApplicationID");
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
                             <td>
						 		<h4> <b>Rs. <?php echo $row['Amount'] ?></b></h4>
								 

							 </td>
                             <td>
						 		<p><b> <?php echo $row['PaymentDate'] ?></b></p>
								

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
							<th class="text-center">Borrower</th>
							<th class="text-center">Loan Details</th>
							<th class="text-center">Payment Amount</th>
							<th class="text-center">Payment Date</th>

						</tr>
					</thead>
					<tbody>
					
						<?php
							
							$i=1;								
							$loan = $conn->query("SELECT * , borrower.PhoneNumber as bpn, lender.PhoneNumber as lpn, borrower.FirstName as bfn, borrower.LastName as bln, lender.FirstName as lfn, lender.LastName as lln FROM borrower,lender,payments,loan,loan_application WHERE payments.BorrowerID = borrower.BorrowerID and payments.LenderID = lender.LenderID and payments.LoanID=loan.LoanID and loan_application.ApplicationID=loan.ApplicationID and payments.LenderID =".$_SESSION['login_id']);
							// echo($conn->error);
							while($row = $loan->fetch_assoc()):
						 ?>
						 <tr>
						 	
						 <td class="text-center"><?php echo $i++ ?></td>

							 <td>
						 		<p>Name :  <b><?php echo $row['bfn'] ?></b>  <b><?php echo $row['bln'] ?></b></p>
						 		<p><small>Contact # :<b><?php echo $row['bpn'] ?></small></b></p>

						 	</td>
						 	<td>
						 		<p>Principal :  <b>Rs. <?php echo $row['Principal'] ?></b></p>
								 <p>Term :  <b><?php echo $row['Term'] ?> months</b></p>
								 <p>Rate:  <b><?php echo $row['InterestRate'] ?> %</b></p>

							 </td>
                             <td>
						 		<h4> <b>Rs. <?php echo $row['Amount'] ?></b></h4>
								 

							 </td>
                             <td>
						 		<p> <b> <?php echo $row['PaymentDate'] ?></b></p>
								

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
							<th class="text-center">Borrower</th>
							<th class="text-center">Loan Details</th>
							<th class="text-center">Payment Amount</th>
							<th class="text-center">Payment Date</th>

						</tr>
					</thead>
					<tbody>
					
						<?php
							
							$i=1;								
							$loan = $conn->query("SELECT * , borrower.PhoneNumber as bpn, lender.PhoneNumber as lpn, borrower.FirstName as bfn, borrower.LastName as bln, lender.FirstName as lfn, lender.LastName as lln FROM borrower,lender,payments,loan,loan_application WHERE payments.BorrowerID = borrower.BorrowerID and payments.LenderID = lender.LenderID and payments.LoanID=loan.LoanID and loan_application.ApplicationID=loan.ApplicationID and payments.BorrowerID =".$_SESSION['login_id']);
							// echo($conn->error);
							while($row = $loan->fetch_assoc()):
						 ?>
						 <tr>
						 	
						 <td class="text-center"><?php echo $i++ ?></td>

							 <td>
						 		<p>Name :  <b><?php echo $row['bfn'] ?></b>  <b><?php echo $row['bln'] ?></b></p>
						 		<p><small>Contact # :<b><?php echo $row['bpn'] ?></small></b></p>

						 	</td>
						 	<td>
						 		<p>Principal :  <b>Rs. <?php echo $row['Principal'] ?></b></p>
								 <p>Term :  <b><?php echo $row['Term'] ?> months</b></p>
								 <p>Rate:  <b><?php echo $row['InterestRate'] ?> %</b></p>

							 </td>
                             <td>
						 		<h4><b> <?php echo $row['Amount'] ?></b></h4>
								 

							 </td>
                             <td>
						 		<p> <b> <?php echo $row['PaymentDate'] ?></b></p>
								

							 </td>
							 

						 </tr>
						<?php endwhile; ?>
					
					
					</tbody>
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