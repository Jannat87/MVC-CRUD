<!--/********************************************************************/--->
<!-------------------------------start Update new data----------------------->
<!--/********************************************************************/--->
<?php
	if(isset($_GET['delid'])){
		$delid = $_GET['delid'];
		$qry_delete_dress = "DELETE FROM tb_dress WHERE id=$delid";
		$result = $DB->delete($qry_delete_dress);
		if($result){
			$msg = '<span style="color:red;"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Deleted Done !</span>';
			header('Location:index.php?page=Dress&msg='.$msg);
		}
	}
?>

<?php 
	if(isset($_POST['dress'])){
		$model = $_POST['model'];
		$type = $_POST['type'];  
		$details = $_POST['details']; 
		$price = $_POST['price']; 

		if(empty($model) OR empty($type) OR empty($details) OR empty($price)){
			$msg_save = '<span style="color:red;"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Field Must Not Empty !</span>';
			header('Location:index.php?page=Dress&msg='.$msg_save);
		}else{

			$dress_query = "INSERT INTO tb_dress (model,type,details,price) 
			VALUES ('$model','$type','$details','$price')";

			$result = $DB->insert($dress_query);
			if($result){
				$model=null; 
				$type=null; 
				$details='';
				$price='';

				$msg_save = '<span style="color:green;"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Successfully Saved !</span>';
				header('Location:index.php?page=Dress&msg='.$msg_save);
			}

		}
	}
?>

<?php
	if(isset($_POST['update_dress'])){
		$id = $_POST['update_id'];
		$model = $_POST['model'];
		$type = $_POST['type'];
		$details = $_POST['details'];
		$price = $_POST['price'];

		if(empty($model) or empty($type) or empty($details) or empty($price)){
			$msg = '<span style="color:red;"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Field Must Not Empty !</span>';
			header('Location:index.php?page=Dress&msg='.$msg);
		}else{
			$dress_query = "UPDATE tb_dress
				SET
				model = '$model',
				type = '$type',
				details = '$details',
				price = '$price'
				WHERE id = '$id'
			";

			$result = $DB->insert($dress_query);
			if($result){
				$model=null;
				$type=null;
				$details='';
				$price='';

				$msg = '<span style="color:teal;"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Successfully Updated !</span>';
				header('Location:index.php?page=Dress&msg='.$msg);
			}
		}
	}
?> 
<!--/********************************************************************/--->
<!-------------------------------end of data Updating------------------------>
<!--/********************************************************************/--->

<!--/********************************************************************/--->
<!---------------------------------start delete data------------------------->
<!--/********************************************************************/--->
<?php
	if(isset($_GET['upid'])){
		$upid = $_GET['upid'];
		$qry_update = "SELECT * FROM tb_dress WHERE id='$upid'";
		$update_result = $DB->insert($qry_update);
		if($update_result){
			$update_data = $update_result->fetch_assoc();
		}
	}
?>
<!--/********************************************************************/--->
<!-------------------------------end of data delating------------------------>
<!--/********************************************************************/--->

<!--/********************************************************************/--->
<!-------------------------------start of data insert------------------------>
<!--/********************************************************************/--->


<!---/********************************************************************/--->
<!-------------------------------end of data inserting------------------------>
<!---/********************************************************************/--->

<!----------------------------------------------->	
<div class="" style="min-height:400px;">	
	<div class="col-md-4">
<!------------------------------------>
<?php
	if(isset($update_data)){
?>
<form action="index.php?page=Dress" method="post">
	<input type="hidden" value="<?php echo $upid; ?>" name="update_id">
  <div class="form-group">
    <label for="exampleInputEmail1">Model</label>
    <input name="model" type="text" class="form-control" id="exampleInputEmail1" 
    value="<?php if(isset($update_data)){ echo $update_data['model']; } ?>">
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Type</label>
    <input name="type" type="text" class="form-control" id="exampleInputEmail1" 
    value="<?php if(isset($update_data)){ echo $update_data['type']; } ?>">
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Details</label>
    <input name="details" type="text" class="form-control" id="exampleInputEmail1" 
    value="<?php if(isset($update_data)){ echo $update_data['details']; } ?>">
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">price</label>
    <input name="price" type="text" class="form-control" id="exampleInputEmail1" 
    value="<?php if(isset($update_data)){ echo $update_data['price']; } ?>">
  </div>
  
  <button name="update_dress" type="submit" class="btn btn-warning">Update</button>
  &nbsp; &nbsp; <?php if(isset($_GET['msg'])){ echo $_GET['msg']; } ?>
</form>
<?php		
	}else{
?>
<form action="index.php?page=Dress" method="post">
  <div class="form-group">
    <label for="exampleInputEmail1">Model</label>
    <input name="model" type="text" class="form-control" id="exampleInputEmail1" placeholder="Model">
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Type</label>
    <input name="type" type="text" class="form-control" id="exampleInputEmail1" placeholder="Type">
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Details</label>
    <input name="details" type="text" class="form-control" id="exampleInputEmail1" placeholder="Details">
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Price</label>
    <input name="price" type="text" class="form-control" id="exampleInputEmail1" placeholder="Price">
  </div>
  <button name="dress" type="submit" class="btn btn-primary">Save</button> 
  &nbsp; &nbsp; <?php if(isset($_GET['msg'])){ echo $_GET['msg'];} ?>
</form>
<?php		
	}
?>

<!------------------------------------>
	</div>	
	<div class="col-md-8">
<!-------------------------------->
<table class="table table-bordered table-striped">
	<tr>
		<th>SL</th>
		<th>Model</th>
		<th>Type</th>
		<th>Price</th>
		<th style="width:28%;">Action</th>
	</tr>
<?php 
	$dress_load_qry = "SELECT * FROM tb_dress";
	$result = $DB->select($dress_load_qry); 
	if($result){
		$i = 0; 
		while($dress = $result->fetch_array()){
			$i++; 
?>
	<tr>
		<td><?php echo $i; ?></td>
		<td><?php echo $dress['model']; ?></td>
		<td><?php echo $dress['type']; ?></td>
		<td><?php echo $dress['price']; ?></td>
		<td>
			<a href="" class="btn btn-info btn-sm" data-toggle="modal" data-target="#dress_view<?php echo $dress['id']; ?>">View</a>
			<a href="?page=Dress&upid=<?php echo $dress['id']; ?>" class="btn btn-warning btn-sm">Update</a>
			<a href="?page=Dress&delid=<?php echo $dress['id']; ?>" class="btn btn-danger btn-sm">Remove</a>
		</td>
	</tr>
<!-------------------------------------------------------------->
<!-- Modal -->
<div class="modal fade" id="dress_view<?php echo $dress['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><?php echo $dress['model'].' &nbsp; '.$dress['type']; ?></h4>
      </div>
      <div class="modal-body">
        <?php 
        	echo '<h3>Model # '.$dress['model'].'</h3>';
        	echo '<h3>Type # '.$dress['type'].'</h3>';
        	echo '<h3>Price # '.$dress['price'].'.tk</h3>';
        	echo 'Specification # '.$dress['details']; 
        ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<!-------------------------------------------------------------------------->

<?php 
		}
	}
?>


	
	
</table>
<!-------------------------------->
	</div>
	
</div>
<!----------------------------------------------->
