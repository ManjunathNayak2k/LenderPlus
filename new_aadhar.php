<?php 
include('db_connect.php');
include 'db.php';
if(isset($_GET['id'])){
$user = $conn->query("SELECT * FROM users where id =".$_GET['id']);
foreach($user->fetch_array() as $k =>$v){
	$meta[$k] = $v;
}
}
?>
<div class="container-fluid">
	
	<form action="" id="manage-user">
		<input type="hidden" name="id" value="<?php echo isset($meta['id']) ? $meta['id']: '' ?>">
		
		<div class="form-group">
		<input type="file" name="aadhar" class="custom-file-input" id="inputGroupFile01">
    <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
		</div>

	</form>
</div>
<script>
	$('#manage-user').submit(function(e){
		e.preventDefault();
		start_load()
		$.ajax({
			url:'ajax.php?action=post_aadhar',
			method:'POST',
			data:$(this).serialize(),
			success:function(resp){
				if(resp ==1){
					alert_toast("Aadhar successfully saved",'success')
					setTimeout(function(){
						location.reload()
					},1500)
				}
                else{
                    alert(resp);
                }
			}
		})
	})
</script>