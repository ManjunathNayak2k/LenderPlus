<?php 
include('db_connect.php');
if(isset($_GET['id'])){
$qry = $conn->query("SELECT * FROM loan_application where ApplicationID = ".$_GET['id']);
foreach($qry->fetch_array() as $k => $v){
	$meta[$k] = $v;
}
if(isset($meta['Status']))
$Status=$meta['Status'];
}
$total = ($meta['Principal'] + ($meta['Principal'] * ($meta['InterestRate']/100) * ($meta['Term']/12))) ;
$penalty = $total/$meta['Term'];
?>

<div class="container-fluid">
	<div class="col-lg-12">
	<form action="" id="loan-application">
		<input type="hidden" name="id" value="<?php echo isset($_GET['id']) ? $_GET['id'] : '' ?>">
		<div class="row">
			<div class="col-md-6">
				<label class="control-label">Borrower</label>
				<?php
				$borrower = $conn->query("SELECT concat(LastName,', ',FirstName) as name FROM borrower,loan_application where loan_application.BorrowerID = borrower.BorrowerID and loan_application.ApplicationID = ".$_GET['id']);
				?>
				<h3>
						<?php while($row = $borrower->fetch_assoc()): ?>
							<?php echo $row['name']?>
						<?php endwhile; ?>
                </h3>
			</div>
		</div>

        <div class="row">
			<div class="col-md-6">
				<label class="control-label">Principal</label>
				
				<h3>
                <?php echo isset($meta['Principal']) ? $meta['Principal']: '' ?>
                </h3>
			</div>
		</div>
        <div class="row">
			<div class="col-md-6">
				<label class="control-label">Interest Rate</label>
				
				<h3>
                    <?php echo isset($meta['InterestRate']) ? $meta['InterestRate']: '' ?> %
                </h3>
			</div>
		</div>		
        <div class="row">
			<div class="col-md-6">
				<label class="control-label">Term</label>
				
				<h3>
                <?php echo isset($meta['Term']) ? $meta['Term']: '' ?> months
                </h3>
			</div>
		</div>	
        <div class="row">
			<div class="col-md-6">
				<label class="control-label">Maturity</label>
				
				<h3>
                <?php echo $total ?> 
                </h3>
			</div>
		</div>		

		<div id="row-field">
			<div class="row ">
				<div class="col-md-12 text-center">
					<button class="btn btn-primary btn-sm" type="button" id="save">Payment Received</button>
					<button class="btn btn-secondary btn-sm" type="button" data-dismiss="modal">Cancel</button>
				</div>
			</div>
		</div>
		 
	</form>
	</div>
</div>
<script>

	$('#save').click(function(){
		// alert($('[name="borrower_id"]').val());
		start_load()
		if($('[name="principal"]').val() == '' && $('[name="term"]').val() == '' && $('[name="term"]').val() == ''){
			alert_toast("Select principal, term and rate first.","warning");
			return false;
		}
		$.ajax({
			url:'ajax.php?action=save_payment',
			method:"POST",
			data:{id:$('[name="id"]').val()},
			error:err=>{
				console.log(err)
			},
			success:function(resp){
				// alert("hi")
				if(resp == 1){
					$('.modal').modal('hide')
					alert_toast("Payment Data successfully saved.","success")
					setTimeout(function(){
						location.reload();
					},1500)
				}
				else{
					alert(resp);
				}
			}
		})
	})
	


</script>
<style>
	#uni_modal .modal-footer{
		display: none
	}
</style>