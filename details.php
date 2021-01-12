<?php 
 include('./header.php'); 
 include 'db_connect.php'

?>

<div class="container-fluid">

<?php if($_SESSION['login_type'] == 3): ?>
<div class="col-lg-8 center">
<table class="table table-bordered" id="loan-list">

<thead>
    <th class="text-center">Field</th>
    <th class="text-center">Value</th>
</thead>

<tbody>
					
    <?php
        
        							
        $user = $conn->query("SELECT * from borrower where borrower.BorrowerID = ".$_SESSION['login_id']);
        // echo($conn->error);
        
        foreach($user->fetch_assoc() as $k =>$v):
                
            
        ?>
        <tr>
        
        <td class="text-center"><?php echo $k ?></td>
        <td class="text-center">
            <p><b><?php echo $v  ?></p>
            

        </td>

        </tr>
<?php endforeach; ?>
</tbody>
</table>
</div>
<?php endif; ?>


<?php if($_SESSION['login_type'] == 2): ?>
<div class="col-lg-8 center">
<table class="table table-bordered" id="loan-list">

<thead>
    <th class="text-center">Field</th>
    <th class="text-center">Value</th>
</thead>

<tbody>
					
    <?php
        
        							
        $user = $conn->query("SELECT * from lender where lender.LenderID = ".$_SESSION['login_id']);
        // echo($conn->error);
        
        foreach($user->fetch_assoc() as $k =>$v):
                
            
        ?>
        <tr>
        
        <td class="text-center"><?php echo $k ?></td>
        <td class="text-center">
        <p><b><?php echo $v  ?></p>
           

        </td>

        </tr>
<?php endforeach; ?>
</tbody>
</table>
</div>
<?php endif; ?>

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
    .center {
  margin: auto;
  width: 60%;
  
  padding: 10px;
}
</style>	