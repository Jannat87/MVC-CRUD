<!--/********************************************************************/--->
<!-------------------------------start Update new data----------------------->
<!--/********************************************************************/--->
<?php
	if(isset($_GET['delid'])){
		$delid = $_GET['delid'];
		$qry_delete_electronics = "DELETE FROM tb_electronics WHERE id=$delid";
		$result = $DB->delete($qry_delete_electronics);
		if($result){
			$msg = '<span style="color:red;"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Deleted Done !</span>';
			header('Location:index.php?page=Electronics&msg='.$msg);
		}
	}
?>

<?php 
	if(isset($_POST['electronics'])){
		$company_name = $_POST['company_name']; 
		$model = $_POST['model']; 
		$details = $_POST['details']; 
		$price = $_POST['price']; 

		if(empty($company_name) OR empty($model) OR empty($details) OR empty($price)){
			$msg_save = '<span style="color:red;"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Field Must Not Empty !</span>';
			header('Location:index.php?page=Electronics&msg='.$msg_save);
		}else{

			$electronics_query = "INSERT INTO tb_electronics (company_name,model,details,price) 
			VALUES ('$company_name','$model','$details','$price')";

			$result = $DB->insert($electronics_query);
			if($result){
				$company_name=null; 
				$model=null; 
				$details='';
				$price='';

				$msg_save = '<span style="color:green;"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Successfully Saved !</span>';
				header('Location:index.php?page=Electronics&msg='.$msg_save);
			}

		}
	}
?>

<?php
	if(isset($_POST['update_electronics'])){
		$id = $_POST['update_id'];
		$company_name = $_POST['company_name'];
		$model = $_POST['model'];
		$details = $_POST['details'];
		$price = $_POST['price'];

		if(empty($company_name) or empty($model) or empty($details) or empty($price)){
			$msg = '<span style="color:red;"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Field Must Not Empty !</span>';
			header('Location:index.php?page=Electronics&msg='.$msg);
		}else{
			$electronics_query = "UPDATE tb_electronics
				SET
				company_name = '$company_name',
				model = '$model',
				details = '$details',
				price = '$price'
				WHERE id = '$id'
			";

			$result = $DB->insert($electronics_query);
			if($result){
				$company_name=null;
				$model=null;
				$details='';
				$price='';

				$msg = '<span style="color:teal;"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Successfully Updated !</span>';
				header('Location:index.php?page=Electronics&msg='.$msg);
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
		$qry_update = "SELECT * FROM tb_electronics WHERE id='$upid'";
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
<form action="index.php?page=Electronics" method="post">
	<input type="hidden" value="<?php echo $upid; ?>" name="update_id">
  <div class="form-group">
    <label for="exampleInputEmail1">Company Name</label>
    <input name="company_name" type="text" class="form-control" id="exampleInputEmail1" value="<?php if(isset($update_data)){ echo $update_data['company_name']; } ?>">
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Model</label>
    <input name="model" type="text" class="form-control" id="exampleInputEmail1" 
    value="<?php if(isset($update_data)){ echo $update_data['model']; } ?>">
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Description</label>
    <textarea name="details" class="form-control">
    	<?php if(isset($update_data)){ echo $update_data['details']; } ?>
    </textarea>
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">price</label>
    <input name="price" type="text" class="form-control" id="exampleInputEmail1" 
    value="<?php if(isset($update_data)){ echo $update_data['price']; } ?>">
  </div>
  
  <button name="update_electronics" type="submit" class="btn btn-warning">Update</button>
  &nbsp; &nbsp; <?php if(isset($_GET['msg'])){ echo $_GET['msg']; } ?>
</form>
<?php		
	}else{
?>
<form action="index.php?page=Electronics" method="post">
  <div class="form-group">
    <label for="exampleInputEmail1">Company Name</label>
    <input name="company_name" type="text" class="form-control" id="exampleInputEmail1" placeholder="Company Name">
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Model</label>
    <input name="model" type="text" class="form-control" id="exampleInputEmail1" placeholder="Model Name">
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Description</label>
    <textarea name="details" class="form-control"></textarea>
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Price</label>
    <input name="price" type="text" class="form-control" id="exampleInputEmail1" placeholder="Price">
  </div>
  <button name="electronics" type="submit" class="btn btn-primary">Save</button> 
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
		<th>Company</th>
		<th>Model</th>
		<th>Price</th>
		<th style="width:28%;">Action</th>
	</tr>
<?php 
	$electronics_load_qry = "SELECT * FROM tb_electronics";
	$result = $DB->select($electronics_load_qry); 
	if($result){
		$i = 0; 
		while($electronics = $result->fetch_array()){
			$i++; 
?>
	<tr>
		<td><?php echo $i; ?></td>
		<td><?php echo $electronics['company_name']; ?></td>
		<td><?php echo $electronics['model']; ?></td>
		<td><?php echo $electronics['price']; ?></td>
		<td>
			<a href="" class="btn btn-info btn-sm" data-toggle="modal" data-target="#electronics_view<?php echo $electronics['id']; ?>">View</a>
			<a href="?page=Electronics&upid=<?php echo $electronics['id']; ?>" class="btn btn-warning btn-sm">Update</a>
			<a href="?page=Electronics&delid=<?php echo $electronics['id']; ?>" class="btn btn-danger btn-sm">Remove</a>
		</td>
	</tr>
<!-------------------------------------------------------------->
<!-- Modal -->
<div class="modal fade" id="electronics_view<?php echo $electronics['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><?php echo $electronics['company_name'].' &nbsp; '.$electronics['model']; ?></h4>
      </div>
      <div class="modal-body">
        <?php 
        	echo '<h3>Brand Name # '.$electronics['company_name'].'</h3>';
        	echo '<h3>Model # '.$electronics['model'].'</h3>';
        	echo '<h3>Price # '.$electronics['price'].'.tk</h3>';
        	echo 'Specification # '.$electronics['details']; 
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
