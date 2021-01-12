
<?php
include("db.php");



if(isset($_POST['push'])){
    $name = $_POST['name'];
    $email = $_POST['email'];


    $data = [
        'name' => $name,
        'email' => $email
    ];

    $ref = "contact_form_data/";
    $pushData =  $database->getReference($ref)->push($data);
}
?>

<div class="container-fluid">
    <br>
    <br>
    <div class="row">
	<div class="col-lg-3">
		<div class="card">
			<div class="card-header">
				<large class="card-title">
					<b>Upload Doc</b>
					
				</large>
				
			</div>
			<div class="card-body">
			<center><button class='btn btn-success'> Click to upload </button></center>
			
			</div>
		</div>
    </div>
    <div class="col-lg-9">
		<div class="card">
			<div class="card-header">
				<large class="card-title">
					<b>Current Uploaded Doc</b>
					
				</large>
				
			</div>
			<div class="card-body">
			
			
			</div>
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
    div {
        align-content: center;
    }
</style>	
