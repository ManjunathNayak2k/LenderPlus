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
            <label for="username">Review</label>
            <textarea name="review" id="review" cols="30" rows="10"></textarea>
		</div>

	</form>
</div>
<script>
	$('#manage-user').submit(function(e){
		e.preventDefault();
		start_load()
		$.ajax({
			url:'ajax.php?action=post_review',
			method:'POST',
			data:$(this).serialize(),
			success:function(resp){
				if(resp ==1){
					alert_toast("Review successfully saved",'success')
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