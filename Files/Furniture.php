<!--/********************************************************************/--->
<!-------------------------------start Update new data----------------------->
<!--/********************************************************************/--->
<?php
	if(isset($_GET['delid'])){
		$delid = $_GET['delid'];
		$qry_delete_furniture = "DELETE FROM tb_furniture WHERE id=$delid";
		$result = $DB->delete($qry_delete_furniture);
		if($result){
			$msg = '<span style="color:red;"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Deleted Done !</span>';
			header('Location:?page=Furniture&msg='.$msg);
		} 
	}
?> 
<?php 
	if(isset($_POST['furniture'])){
		$company_name = $_POST['company_name']; 
		$model = $_POST['model']; 
		$details = $_POST['details']; 
		$price = $_POST['price']; 

		if(empty($company_name) OR empty($model) OR empty($details) OR empty($price)){
			$msg_save = '<span style="color:red;"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Field Must Not Empty !</span>';
			header('Location:index.php?page=Furniture&msg='.$msg_save);
		}else{

			$furniture_query = "INSERT INTO tb_furniture (company_name,model,details,price) 
			VALUES ('$company_name','$model','$details','$price')";

			$result = $DB->insert($furniture_query);
			if($result){
				$company_name=null; 
				$model=null; 
				$details='';
				$price='';

				$msg_save = '<span style="color:green;"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Successfully Saved !</span>';
				
				header('Location:index.php?page=furniture&msg='.$msg_save);
			}

		}
	}
?>
<?php
	if(isset($_POST['update_furniture'])){
		$id = $_POST['update_id'];
		$company_name = $_POST['company_name'];
		$model = $_POST['model'];
		$details = $_POST['details'];
		$price = $_POST['price'];

		if(empty($company_name) or empty($model) or empty($details) or empty($price)){
			$msg = '<span style="color:red;"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Field Must Not Empty !</span>';
			header('Location:index.php?page=Furniture&msg='.$msg);  
		}else{
			$furniture_query = "UPDATE tb_furniture
			SET
			company_name = '$company_name',
			model = '$model',
			details = '$details',
			price = '$price'
			WHERE id = '$id' 
			";

			$result = $DB->insert($furniture_query);
			if($result){
				$company_name=null;
				$model=null;
				$details='';
				$price='';

				$msg = '<span style="color:teal;"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Successfully Updated !</span>';
				header('Location:index.php?page=Furniture&msg='.$msg);
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
		$qry_update = "SELECT * FROM tb_furniture WHERE id='$upid'";
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
<form action="index.php?page=Furniture" method="post">
	<input type="hidden" value="<?php echo $upid; ?>" name="update_id">
  <div class="form-group">
    <label for="exampleInputEmail1">Company Name</label>
    <input name="company_name" type="text" class="form-control" id="exampleInputEmail1" value="<?php if(isset($update_data)){ echo $update_data['company_name']; } ?>">
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Model</label>
    <input name="model" type="text" class="form-control" id="exampleInputEmail1" value="<?php if(isset($update_data)){ echo $update_data['model']; } ?>">
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Details</label>
    <input name="details" type="text" class="form-control" id="exampleInputEmail1" 
    value="<?php if(isset($update_data)){ echo $update_data['details']; } ?>">
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Price</label>
    <input name="price" type="text" class="form-control" id="exampleInputEmail1" value="<?php if(isset($update_data)){ echo $update_data['price']; } ?>">
  </div>
  <button name="update_furniture" type="submit" class="btn btn-warning">Update</button>
  &nbsp; &nbsp; <?php if(isset($_GET['msg'])){ echo $_GET['msg']; } ?>
</form>
<?php		
	}else{
?>		
<form action="index.php?page=furniture" method="post">
  <div class="form-group">
    <label for="exampleInputEmail1">Company Name</label>
    <input name="company_name" type="text" class="form-control" id="exampleInputEmail1" placeholder="Company Name">
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Model</label>
    <input name="model" type="text" class="form-control" id="exampleInputEmail1" placeholder="Model Name">
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Details</label>
    <input name="details" type="text" class="form-control" id="exampleInputEmail1" placeholder="Details">
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Price</label>
    <input name="price" type="text" class="form-control" id="exampleInputEmail1" placeholder="Price">
  </div>
  <button name="furniture" type="submit" class="btn btn-primary">Save</button> 
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
		<th>Company Name</th>
		<th>Model</th>
		<th>Price</th>
		<th style="width:28%;">Action</th>
	</tr>
<?php 
	$furniture_load_qry = "SELECT * FROM tb_furniture";
	$result = $DB->select($furniture_load_qry); 
	if($result){
		$i = 0; 
		while($furniture = $result->fetch_array()){
			$i++; 
?>
	<tr>
		<td><?php echo $i; ?></td>
		<td><?php echo $furniture['company_name']; ?></td>
		<td><?php echo $furniture['model']; ?></td>
		<td><?php echo $furniture['price']; ?></td>
		<td>
			<a href="" class="btn btn-info btn-sm" data-toggle="modal" data-target="#furniture_view<?php echo $furniture['id']; ?>">View</a>
			<a href="?page=Furniture&upid=<?php echo $furniture['id']; ?>" class="btn btn-warning btn-sm">Update</a>
			<a href="?page=Furniture&delid=<?php echo $furniture['id']; ?>" class="btn btn-danger btn-sm">Remove</a>
		</td>
	</tr>
<!-------------------------------------------------------------->
<!-- Modal -->
<div class="modal fade" id="furniture_view<?php echo $furniture['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><?php echo $furniture['company_name'].' &nbsp; '.$furniture['model']; ?></h4>
      </div>
      <div class="modal-body">
        <?php 
        	echo '<h3>Brand Name # '.$furniture['company_name'].'</h3>';
        	echo '<h3>Model # '.$furniture['model'].'</h3>';
        	echo '<h3>Price # '.$furniture['price'].'.tk</h3>';
        	echo 'Specification # '.$furniture['details']; 
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
