<?php 
include('db_connect.php');
include 'db.php';
use Kreait\Firebase\Factory;

    $types = ['null','Admin','Lender','Borrower']
    
?>

<div class="container-fluid">
	
	<div class="row">
	<div class="col-lg-12">
    <?php if($_SESSION['login_type'] != 1): ?>
        <br>
        <br>
        <br>
        <center>            <button class="btn btn-primary" id="new_user"><i class="fa fa-plus"></i> New review</button>
</center>
            <?php endif; ?>
	</div>
	</div>
    <br>
    <?php if($_SESSION['login_type'] == 1): ?>
	<div class="row">
		<div class="card col-lg-12">
			<div class="card-body">
				<table class="table table-bordered" id="users">
			<thead>
			<colgroup>
			<col width="5%">
						<col width="20%">
						<col width="10%">

						<col width="65%">
		</colgroup>
				<tr>
					<th class="text-center">#</th>
					<th class="text-center">Username</th>
					<th class="text-center">Date</th>
                    <th class="text-center">Review</th>
				</tr>
			</thead>
			<tbody>
            <?php
            require_once './vendor/autoload.php';
    
            
            $factory = (new Factory())
                ->withDatabaseUri('https://php-lend-default-rtdb.firebaseio.com');
            
            
            $database = $factory->createDatabase();
							$i=1;								
							// echo($conn->error);
							$ref = "feedback";
                            $data =  $database->getReference($ref)->getValue();
                            
                            foreach($data as $key => $data1){
                            $user = $conn->query("SELECT username FROM users WHERE id=".$data1['id'])->fetch_array();
                            $check = $user[0];
                            

						 ?>
						 <tr>
						 	
						 <td class="text-center"><?php echo $i++ ?></td>
						 	
							 <td class="text-center">
						 		
						 		<p><b><?php echo $check ?></b></p>
							 </td>
							 <td class="text-center">
                             <p><b><?php echo $data1['date'] ?></b></p>
						 		

							 </td>
						 	<td class="text-center">
                             <p><b><?php echo $data1['feedback'] ?></b></p>
						 		

							 </td>

							
						 </tr>
                        <?php 
                        }
                         ?>
			</tbody>
		</table>
			</div>
		</div>
	</div>
    <?php endif; ?>

</div>
<script>
$('#users').dataTable()

$('#new_user').click(function(){
	uni_modal('New Review','new_review.php')
})

</script>