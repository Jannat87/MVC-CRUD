<!--/********************************************************************/--->
<!-------------------------------start Update new data----------------------->
<!--/********************************************************************/--->
<?php
	if(isset($_GET['delid'])){
		$delid = $_GET['delid'];
		$qry_delete_car = "DELETE FROM tb_car WHERE id=$delid";
		$result = $DB->delete($qry_delete_car);
		if($result){
			$msg = '<span style="color:red;"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Deleted Done !</span>';
			header('Location:index.php?page=Car&msg='.$msg);
		} 
	}
?> 
<?php 
	if(isset($_POST['car'])){
		$company_name = $_POST['company_name']; 
		$model = $_POST['model']; 
		$details = $_POST['details']; 
		$price = $_POST['price']; 

		if(empty($company_name) OR empty($model) OR empty($details) OR empty($price)){
			$msg_save = '<span style="color:red;"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Field Must Not Empty !</span>';
			header('Location:index.php?page=Car&msg='.$msg_save);
		}else{

			$car_query = "INSERT INTO tb_car (company_name,model,details,price) 
			VALUES ('$company_name','$model','$details','$price')";

			$result = $DB->insert($car_query);
			if($result){
				$company_name=null; 
				$model=null; 
				$details='';
				$price='';

				$msg_save = '<span style="color:green;"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Successfully Saved !</span>';
				
				header('Location:index.php?page=Car&msg='.$msg_save);
			}

		}
	}
?>
<?php
	if(isset($_POST['update_car'])){
		$id = $_POST['update_id'];
		$company_name = $_POST['company_name'];
		$model = $_POST['model'];
		$details = $_POST['details'];
		$price = $_POST['price'];

		if(empty($company_name) or empty($model) or empty($details) or empty($price)){
			$msg = '<span style="color:red;"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Field Must Not Empty !</span>';
			header('Location:index.php?page=Car&msg='.$msg);  
		}else{
			$car_query = "UPDATE tb_car
			SET
			company_name = '$company_name',
			model = '$model',
			details = '$details',
			price = '$price'
			WHERE id = '$id' 
			";

			$result = $DB->insert($car_query);
			if($result){
				$company_name=null;
				$model=null;
				$details='';
				$price='';

				$msg = '<span style="color:teal;"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Successfully Updated !</span>';
				header('Location:index.php?page=Car&msg='.$msg);
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
		$qry_update = "SELECT * FROM tb_car WHERE id='$upid'";
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
<form action="index.php?page=Car" method="post">
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
    <textarea name="details" class="form-control">
    	<?php if(isset($update_data)){ echo $update_data['details']; } ?>
    </textarea>
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Price</label>
    <input name="price" type="text" class="form-control" id="exampleInputEmail1" value="<?php if(isset($update_data)){ echo $update_data['price']; } ?>">
  </div>
  <button name="update_car" type="submit" class="btn btn-warning">Update</button>
  &nbsp; &nbsp; <?php if(isset($_GET['msg'])){ echo $_GET['msg']; } ?>
</form>
<?php		
	}else{
?>		
<form action="index.php?page=car" method="post">
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
  <button name="car" type="submit" class="btn btn-primary">Save</button> 
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
	$car_load_qry = "SELECT * FROM tb_car";
	$result = $DB->select($car_load_qry); 
	if($result){
		$i = 0; 
		while($car = $result->fetch_array()){
			$i++; 
?>
	<tr>
		<td><?php echo $i; ?></td>
		<td><?php echo $car['company_name']; ?></td>
		<td><?php echo $car['model']; ?></td>
		<td><?php echo $car['price']; ?></td>
		<td>
			<a href="" class="btn btn-info btn-sm" data-toggle="modal" data-target="#car_view<?php echo $car['id']; ?>">View</a>
			<a href="?page=Car&upid=<?php echo $car['id']; ?>" class="btn btn-warning btn-sm">Update</a>
			<a href="?page=Car&delid=<?php echo $car['id']; ?>" class="btn btn-danger btn-sm">Remove</a>
		</td>
	</tr>
<!-------------------------------------------------------------->
<!-- Modal -->
<div class="modal fade" id="car_view<?php echo $car['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><?php echo $car['company_name'].' &nbsp; '.$car['model']; ?></h4>
      </div>
      <div class="modal-body">
        <?php 
        	echo '<h3>Brand Name # '.$car['company_name'].'</h3>';
        	echo '<h3>Model # '.$car['model'].'</h3>';
        	echo '<h3>Price # '.$car['price'].'.tk</h3>';
        	echo 'Specification # '.$car['details']; 
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
