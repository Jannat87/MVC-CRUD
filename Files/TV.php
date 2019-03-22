<!--/********************************************************************/--->
<!-------------------------------start Update new data----------------------->
<!--/********************************************************************/--->
<?php
	if(isset($_GET['delid'])){
		$delid = $_GET['delid'];
		$qry_delete_tv = "DELETE FROM tb_tv WHERE id=$delid";
		$result = $DB->delete($qry_delete_tv);
		if($result){
			$msg = '<span style="color:red;"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Deleted Done !</span>';
			header('Location:index.php?page=TV&msg='.$msg);
		}
	}
?>

<?php
	if(isset($_POST['tv'])){
		$company_name = $_POST['company_name'];
		$model = $_POST['model'];
		$details = $_POST['details'];
		$price = $_POST['price'];
		
		if(empty($company_name) or empty($model) or empty($details) or empty($price)){
			$msg = "Filed Must Not Empty !"; 
			header('Location:?page=TV&msg='.$msg);
		}else{
			$qry_cosmatics = "INSERT INTO tb_tv (company_name,model,details,price)
			VALUES ('$company_name','$model','$details','$price')";

			$result = $DB->insert($qry_cosmatics);
			if($result){
				$msg = "Save Successfully !"; 
				header('Location:?page=TV&msg='.$msg);
			}
		}
	}
?>

<?php
	if(isset($_POST['update_tv'])){
		$id = $_POST['update_id'];
		$company_name = $_POST['company_name'];
		$model = $_POST['model'];
		$details = $_POST['details'];
		$price = $_POST['price'];

		if(empty($company_name) or empty($model) or empty($details) or empty($price)){
			$msg = '<span style="color:red;"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Field Must Not Empty !</span>';
			header('Location:index.php?page=TV&msg='.$msg);
		}else{
			$tv_query = "UPDATE tb_tv
				SET
				company_name = '$company_name',
				model = '$model',
				details = '$details',
				price = '$price'
				WHERE id = '$id'
			";

			$result = $DB->insert($tv_query);
			if($result){
				$company_name=null;
				$model=null;
				$details='';
				$price='';

				$msg = '<span style="color:teal;"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Successfully Updated !</span>';
				header('Location:index.php?page=TV&msg='.$msg);
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
		$qry_update = "SELECT * FROM tb_tv WHERE id='$upid'";
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
<form action="index.php?page=TV" method="post">
	<input type="hidden" value="<?php echo $upid; ?>" name="update_id">
  <div class="form-group">
    <label for="exampleInputEmail1">Company Name</label>
    <input name="company_name" type="text" class="form-control" id="exampleInputEmail1" 
    value="<?php if(isset($update_data)){ echo $update_data['company_name']; } ?>">
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Model</label>
    <input name="model" type="text" class="form-control" id="exampleInputEmail1" 
    value="<?php if(isset($update_data)){ echo $update_data['model']; } ?>">
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
  
  <button name="update_tv" type="submit" class="btn btn-warning">Update</button>
  &nbsp; &nbsp; <?php if(isset($_GET['msg'])){ echo $_GET['msg']; } ?>
</form>
<?php		
	}else{
?>
<form action="index.php?page=TV" method="post">
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
    <textarea class="form-control" name="details" rows="4"></textarea>
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Price</label>
    <input name="price" type="text" class="form-control" id="exampleInputEmail1" placeholder="Price">
  </div>
  <button name="tv" type="submit" class="btn btn-primary">Save</button> 
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
	$tv_load_qry = "SELECT * FROM tb_tv";
	$result = $DB->select($tv_load_qry); 
	if($result){
		$i = 0; 
		while($tv = $result->fetch_array()){
			$i++; 
?>
	<tr>
		<td><?php echo $i; ?></td>
		<td><?php echo $tv['company_name']; ?></td>
		<td><?php echo $tv['model']; ?></td>
		<td><?php echo $tv['price']; ?></td>
		<td>
			<a href="" class="btn btn-info btn-sm" data-toggle="modal" data-target="#tv_view<?php echo $tv['id']; ?>">View</a>
			<a href="?page=TV&upid=<?php echo $tv['id']; ?>" class="btn btn-warning btn-sm">Update</a>
			<a href="?page=TV&delid=<?php echo $tv['id']; ?>" class="btn btn-danger btn-sm">Remove</a>
		</td>
	</tr>
<!-------------------------------------------------------------->
<!-- Modal -->
<div class="modal fade" id="tv_view<?php echo $tv['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><?php echo $tv['company_name'].' &nbsp; '.$tv['model']; ?></h4>
      </div>
      <div class="modal-body">
        <?php 
        	echo '<h3>Brand Name # '.$tv['company_name'].'</h3>';
        	echo '<h3>Model # '.$tv['model'].'</h3>';
        	echo '<h3>Price # '.$tv['price'].'.tk</h3>';
        	echo 'Specification # '.$tv['details']; 
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
