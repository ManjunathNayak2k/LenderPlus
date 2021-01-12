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
?>
<style>
	input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
  -webkit-appearance: none;
  margin: 0;
}

/* Firefox */
input[type=number] {
  -moz-appearance: textfield;
}
</style>
<div class="container-fluid">
	<div class="col-lg-12">
	<form action="" id="loan-application">
		<input type="hidden" name="id" value="<?php echo isset($_GET['id']) ? $_GET['id'] : '' ?>">
		<div class="row">
			<div class="col-md-6">
				<?php if($_GET['login_type'] == 3): ?>
					<input type="hidden" name="borrower_id" id="borrower_id" class="form-control" value="<?php echo $_GET['login_id'] ?>" required>
				<?php endif; ?>

				<?php if($_GET['login_type'] == 2): ?>
					<label class="control-label">Borrower</label>
					
					<input type="text" disabled name="borrower_id" id="borrower_id" class="form-control" value="<?php echo isset($meta['BorrowerID']) ? $meta['BorrowerID']: '' ?>" required>
				<?php endif; ?>

				<?php if($_GET['login_type'] == 1): ?>						
					<?php
					$borrower = $conn->query("SELECT *,concat(LastName,', ',FirstName) as name FROM borrower order by concat(LastName,', ',FirstName) asc ");
					?>
					<select name="borrower_id" id="borrower_id" class="custom-select browser-default select2">
						<option value=""></option>
							<?php while($row = $borrower->fetch_assoc()): ?>
								<option value="<?php echo $row['BorrowerID'] ?>" <?php echo isset($borrower_id) && $borrower_id == $row['BorrowerID'] ? "selected" : '' ?>><?php echo $row['name'] ?></option>
							<?php endwhile; ?>
					</select>
				<?php endif; ?>
			</div>
		</div>
						
		<br>
		<div class="row">
			<div class="col-md-6">
				<label class="control-label">Principal</label>
				<small>Between Rs. 10000 and Rs. 500000</small>

				<input type="number" min="10000" max="500000" name="principal" id="principal" class="form-control" value="<?php echo isset($meta['Principal']) ? $meta['Principal']: '' ?>" required>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6">
				<label class="control-label">Interest %</label>
				<small>Between 1% and 30%</small>
				<input type="number" min="1" max="30" name="interest" id="interest" class="form-control" min="0" step="0.01" value="<?php echo isset($meta['InterestRate']) ? $meta['InterestRate']: '' ?>" required>
			</div>
			<div class="col-md-6">
				<label class="control-label">Term (months)</label>
				<small>Between 6 and 60 months</small>

				<input type="number" min="6" max="60" name="term" id="term" class="form-control" value="<?php echo isset($meta['Term']) ? $meta['Term']: '' ?>" required>
			</div>
		</div>
		
		
		<div class="form-group col-md-2 offset-5 .justify-content-center">
			<label class="control-label">&nbsp;</label>
			<button class="btn btn-primary btn-sm btn-block align-self-end" type="button" id="calculate">Calculate</button>
		</div>
		</div>
		<div id="calculation_table">
			
		</div>
		<?php if($_GET['login_type'] == 1): ?>
		<div class="row">
			<div class="form-group col-md-6">
				<label class="control-label">&nbsp;</label>
				<select class="custom-select browser-default" name="Status">
					<option value="0" <?php echo $Status == 0 ? "selected" : '' ?>>Applied</option>
					<option value="1" <?php echo $Status == 1 ? "selected" : '' ?>>Sanctioned</option>
				</select>
			</div>
		</div>
		<hr>
		<?php endif ?>
		<div id="row-field">
			<div class="row ">
				<div class="col-md-12 text-center">
					<button class="btn btn-primary btn-sm" type="button" id="save">Save</button>
					<button class="btn btn-secondary btn-sm" type="button" data-dismiss="modal">Cancel</button>
				</div>
			</div>
		</div>
		
	</form>
	</div>
</div>
<script>
	$('.select2').select2({
		placeholder:"Please select here",
		width:"100%"
	})
	$('#calculate').click(function(){
		calculate()
	})
	$('#save').click(function(){
		// alert($('[name="borrower_id"]').val());
		start_load()
		if($('[name="principal"]').val() == '' && $('[name="term"]').val() == '' && $('[name="term"]').val() == ''){
			alert_toast("Select principal, term and rate first.","warning");
			setTimeout(function(){
						location.reload();
					},1500)
		}
		$.ajax({
			url:'ajax.php?action=save_loan',
			method:"POST",
			data:{principal:$('[name="principal"]').val(),term:$('[name="term"]').val(),interest:$('[name="interest"]').val(),id:$('[name="id"]').val(),status:$('[name="Status"]').val(),Borrower_id:$('[name="borrower_id"]').val()},
			error:err=>{
				console.log(err)
			},
			success:function(resp){
				// alert("hi")
				if(resp == 1){
					$('.modal').modal('hide')
					alert_toast("Loan Data successfully saved.","success")
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
	

	function calculate(){
		start_load()
		if($('[name="principal"]').val() == '' && $('[name="term"]').val() == '' && $('[name="term"]').val() == ''){
			alert_toast("Select principal, term and rate first.","warning");
			return false;
		}
		$.ajax({
			url:"calculation_table.php",
			method:"POST",
			data:{principal:$('[name="principal"]').val(),term:$('[name="term"]').val(),interest:$('[name="interest"]').val()},
			success:function(resp){
				if(resp){
					
					$('#calculation_table').html(resp)
					end_load()
				}
				
			}

		})
	}
	$('#loan-application').submit(function(e){
		// e.preventDefault()
		// alert("inside")
		start_load()
		$.ajax({
			url:'ajax.php?action=save_loan',
			method:"GET",
			data:$(this).serialize(),
			error:err=>{
				console.log(err)
			},
			success:function(resp){
				// alert("hi")
				if(resp == 1){
					$('.modal').modal('hide')
					alert_toast("Loan Data successfully saved.","success")
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