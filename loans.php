
<?php include 'db_connect.php' ?>

<div class="container-fluid">
	<div class="col-lg-12">
		<div class="card">
			<div class="card-header">
				<large class="card-title">
					<b>Loan Applications List</b>
					<?php if($_SESSION['login_type'] != 2): ?>
					<button class="btn btn-primary btn-sm btn-block col-md-2 float-right" type="button" id="new_application" b-id="<?php echo $_SESSION['login_type'] ?>" o-id="<?php echo $_SESSION['login_id'] ?>"><i class="fa fa-plus"></i> Create New Application</button>
					<?php endif; ?>
				</large>
				
			</div>
			<div class="card-body">
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

							<th class="text-center">Status</th>
							<th class="text-center">Action</th>
						</tr>
					</thead>
					<tbody>

						<?php

							$i=1;								
							$loanApp1 = $conn->query("SELECT * FROM loan_application,borrower WHERE loan_application.BorrowerID = borrower.BorrowerID and borrower.BorrowerID = ".$_SESSION['login_id']);
							
							while($row = $loanApp1->fetch_assoc()):
						 ?>
						 <tr>
						 	
						 <td class="text-center"><?php echo $i++ ?></td>
						 	<td>
						 		<p>Name :  <b><?php echo $row['FirstName'] ?></b>  <b><?php echo $row['LastName'] ?></b></p>
						 		<p><small>Contact # :<b><?php echo $row['PhoneNumber'] ?></small></b></p>

						 	</td>
						 	<td>
						 		<p>Principal :  <b>Rs. <?php echo $row['Principal'] ?></b></p>
								 <p>Term :  <b><?php echo $row['Term'] ?> months</b></p>
								 <p>Rate:  <b><?php echo $row['InterestRate'] ?> %</b></p>

							 </td>

							 <td class="text-center">
						 		<?php if($row['Status'] == 0): ?>
						 			<span class="badge badge-info">Applied</span>
						 		<?php elseif($row['Status'] == 1): ?>
						 			<span class="badge badge-success">Sanctioned</span>
						 		<?php endif; ?>
						 	</td>
							 <td class="text-center">
							 		<?php if($row['Status'] == 0): ?>
						 			<button class="btn btn-outline-primary btn-sm edit_loan" type="button" o-id="<?php echo $_SESSION['login_id'] ?>" data-id="<?php echo $row['ApplicationID'] ?>"><i class="fa fa-edit"></i></button>
									<?php endif; ?>
						 			<button class="btn btn-outline-danger btn-sm delete_loan" type="button" data-id="<?php echo $row['ApplicationID'] ?>"><i class="fa fa-trash"></i></button>
						 	</td>
						 </tr>
						<?php endwhile; ?>

					</tbody>
				</table>
			<?php endif; ?>
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
							<th class="text-center">Borrower</th>
							<th class="text-center">Loan Details</th>
							<th class="text-center">AI Repayment Rating</th>
							<th class="text-center">Status</th>
							<th class="text-center">Action</th>
						</tr>
					</thead>
					<tbody>

						<?php
							
							$i=1;								
							$loanApp = $conn->query("SELECT * FROM loan_application,borrower WHERE loan_application.BorrowerID = borrower.BorrowerID");
							
							while($row = $loanApp->fetch_assoc()):
						 ?>
						 <tr>
						 	
						 <td class="text-center"><?php echo $i++ ?></td>
						 	<td>
						 		<p>Name :  <b><?php echo $row['FirstName'] ?></b>  <b><?php echo $row['LastName'] ?></b></p>
						 		<p><small>Contact # :<b><?php echo $row['PhoneNumber'] ?></small></b></p>

						 	</td>
						 	<td>
						 		<p>Principal :  <b>Rs. <?php echo $row['Principal'] ?></b></p>
								 <p>Term :  <b><?php echo $row['Term'] ?> months</b></p>
								 <p>Rate:  <b><?php echo $row['InterestRate'] ?> %</b></p>

							 </td>
								
							 <td class="text-center">
							 	<h5><b><?php echo $row['Rating'] ?> %</b></h5>	

							 </td>

							 <td class="text-center">
						 		<?php if($row['Status'] == 0): ?>
						 			<span class="badge badge-info">Applied</span>
						 		<?php elseif($row['Status'] == 1): ?>
						 			<span class="badge badge-success">Sanctioned</span>
						 		<?php endif; ?>
						 	</td>
							 <td class="text-center">
						 			<button class="btn btn-outline-primary btn-sm edit_loan" type="button"  data-id="<?php echo $row['ApplicationID'] ?>"><i class="fa fa-edit"></i></button>
						 			<button class="btn btn-outline-danger btn-sm delete_loan" type="button" data-id="<?php echo $row['ApplicationID'] ?>"><i class="fa fa-trash"></i></button>
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
							<th class="text-center">AI Repayment Rating</th>

							<th class="text-center">Action</th>
						</tr>
					</thead>
					<tbody>
				
						<?php
							
							$i=1;								
							$loanApp = $conn->query("SELECT * FROM loan_application,borrower WHERE loan_application.BorrowerID = borrower.BorrowerID and loan_application.Status = 0");
							
							while($row = $loanApp->fetch_assoc()):
						 ?>
						 <tr>
						 	
						 <td class="text-center"><?php echo $i++ ?></td>
						 	<td>
						 		<p>Name :  <b><?php echo $row['FirstName'] ?></b>  <b><?php echo $row['LastName'] ?></b></p>
						 		<p><small>Contact # :<b><?php echo $row['PhoneNumber'] ?></small></b></p>

						 	</td>
						 	<td>
						 		<p>Principal :  <b>Rs. <?php echo $row['Principal'] ?></b></p>
								 <p>Term :  <b><?php echo $row['Term'] ?> months</b></p>
								 <p>Rate:  <b><?php echo $row['InterestRate'] ?> %</b></p>

							 </td>
							 <td class="text-center">
							 	<h5><b><?php echo $row['Rating'] ?> %</b></h5>	

							 </td>
							 <td class="text-center">
						 			<button class="btn btn-outline-primary btn-sm sanction_loan" type="button" data-id="<?php echo $row['ApplicationID'] ?>" b-id="<?php echo $_SESSION['login_type'] ?>"><i class="fa fa-money-bill"></i>  Sanction</button>
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
		uni_modal("New Loan Application","manage_loan.php?login_type="+$(this).attr('b-id')+"&login_id="+$(this).attr('o-id'),'mid-large')
	})
	$('.edit_loan').click(function(){
		uni_modal("Edit Loan","manage_loan.php?id="+$(this).attr('data-id')+"&login_type="+$(this).attr('b-id')+"&login_id="+$(this).attr('o-id'),'mid-large')
	})
	$('.sanction_loan').click(function(){
		uni_modal("Sanction Loan","sanction_loan.php?id="+$(this).attr('data-id')+"&login_type="+$(this).attr('b-id'),'mid-large')
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