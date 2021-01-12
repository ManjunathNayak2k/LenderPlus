
<style>
</style>
<nav id="sidebar" class='mx-lt-5 bg-dark' >
		
		<div class="sidebar-list">

				<a href="index.php?page=home" class="nav-item nav-home"><span class='icon-field'><i class="fa fa-home"></i></span> Home</a>
				<?php if($_SESSION['login_type'] == 2): ?>
				<a href="index.php?page=loans" class="nav-item nav-loans"><span class='icon-field'><i class="fa fa-user-friends"></i></span> Borrowers</a>
				<?php endif; ?>
				<?php if($_SESSION['login_type'] != 2): ?>
				<a href="index.php?page=loans" class="nav-item nav-loans"><span class='icon-field'><i class="fa fa-file-invoice-dollar"></i></span> Loan Application</a>
				<?php endif; ?>
				<a href="index.php?page=sanctioned_loans" class="nav-item nav-sanctioned_loans"><span class='icon-field'><i class="fa fa-list-alt"></i></span> Active Loans</a>	
				<a href="index.php?page=payments" class="nav-item nav-payments"><span class='icon-field'><i class="fa fa-money-bill"></i></span> Payments</a>

				
				<!-- <a href="index.php?page=plan" class="nav-item nav-plan"><span class='icon-field'><i class="fa fa-list-alt"></i></span> Loan Plans</a>	 -->
				<!-- <a href="index.php?page=loan_type" class="nav-item nav-loan_type"><span class='icon-field'><i class="fa fa-th-list"></i></span> Loan Types</a>		 -->
				<?php if($_SESSION['login_type'] == 1): ?>
				<a href="index.php?page=users" class="nav-item nav-users"><span class='icon-field'><i class="fa fa-users"></i></span> Users</a>
				<?php endif; ?>
				<!-- <?php if($_SESSION['login_type'] != 1): ?>
				<a href="index.php?page=aadhar" class="nav-item nav-aadhar"><span class='icon-field'><i class="fa fa-id-card"></i></span> Upload Aadhar</a>
				<?php endif; ?> -->
				<a href="index.php?page=review" class="nav-item nav-review"><span class='icon-field'><i class="fa fa-quote-right"></i></span> Feedback</a>
				<?php if($_SESSION['login_type'] != 1): ?>
				<a href="index.php?page=details" class="nav-item nav-details"><span class='icon-field'><i class="fa fa-align-justify"></i></span> Personal Details</a>
				<?php endif; ?>
		</div>

</nav>
<script>
	$('.nav-<?php echo isset($_GET['page']) ? $_GET['page'] : '' ?>').addClass('active')
</script>
