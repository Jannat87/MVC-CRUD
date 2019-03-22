 <!--/********************************************************************/--->
<!-------------------------------start Update new data----------------------->
<!--/********************************************************************/--->

<?php
	if(isset($_GET['delid'])){
		$delid = $_GET['delid'];
		$qry_delete_cosmatics = "DELETE FROM tb_cosmatics WHERE id=$delid";
		$result = $DB->delete($qry_delete_cosmatics);
		if($result){
			$msg = '<span style="color:red;"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Deleted Done !</span>';
			header('Location:index.php?page=Cosmatics&msg='.$msg);
		}
	}
?>

<?php
	if(isset($_POST['cosmatics'])){
		$product_name = $_POST['product_name'];
		$types = $_POST['types'];
		$details = $_POST['details'];
		$price = $_POST['price'];
		
		if(empty($product_name) or empty($types) or empty($details) or empty($price)){
			$msg = "Filed Must Not Empty !"; 
			header('Location:?page=Cosmatics&msg='.$msg);
		}else{
			$qry_cosmatics = "INSERT INTO tb_cosmatics (product_name,types,details,price)
			VALUES ('$product_name','$types','$details','$price')";

			$result = $DB->insert($qry_cosmatics);
			if($result){
				$msg = "Save Successfully !"; 
				header('Location:?page=Cosmatics&msg='.$msg);
			}
		}
	}
?>

<?php
	if(isset($_POST['update_cosmatics'])){
		$id = $_POST['update_id'];
		$product_name = $_POST['product_name'];
		$types = $_POST['types'];
		$details = $_POST['details'];
		$price = $_POST['price'];

		if(empty($product_name) or empty($types) or empty($details) or empty($price)){
			$msg = '<span style="color:red;"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Field Must Not Empty !</span>';
			header('Location:index.php?page=Mobile&msg='.$msg);
		}else{
			$cosmatics_query = "UPDATE tb_cosmatics
				SET
				product_name = '$product_name',
				types = '$types',
				details = '$details',
				price = '$price'
				WHERE id = '$id'
			";

			$result = $DB->insert($cosmatics_query);
			if($result){
				$product_name=null;
				$types=null;
				$details='';
				$price='';

				$msg = '<span style="color:teal;"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Successfully Updated !</span>';
				header('Location:index.php?page=Cosmatics&msg='.$msg);
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
		$qry_update = "SELECT * FROM tb_cosmatics WHERE id='$upid'";
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
<form action="index.php?page=Cosmatics" method="post">
	<input type="hidden" value="<?php echo $upid; ?>" name="update_id">
  <div class="form-group">
    <label for="exampleInputEmail1">Product Name</label>
    <input name="product_name" type="text" class="form-control" id="exampleInputEmail1" 
    value="<?php if(isset($update_data)){ echo $update_data['product_name']; } ?>">
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Types</label>
    <input name="types" type="text" class="form-control" id="exampleInputEmail1" 
    value="<?php if(isset($update_data)){ echo $update_data['types']; } ?>">
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
  
  <button name="update_cosmatics" type="submit" class="btn btn-warning">Update</button>
  &nbsp; &nbsp; <?php if(isset($_GET['msg'])){ echo $_GET['msg']; } ?>
</form>
<?php		
	}else{
?>
<form action="index.php?page=Cosmatics" method="post">
  <div class="form-group">
    <label for="exampleInputEmail1">Product Name</label>
    <input name="product_name" type="text" class="form-control" id="exampleInputEmail1" placeholder="Product Name">
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Types</label>
    <input name="types" type="text" class="form-control" id="exampleInputEmail1" placeholder="Types">
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Details</label>
    <textarea name="details" class="form-control" rows="4"></textarea>
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Price</label>
    <input name="price" type="text" class="form-control" id="exampleInputEmail1" placeholder="Price">
  </div>
  
  <button name="cosmatics" type="submit" class="btn btn-primary">Save</button>
  &nbsp; &nbsp;<?php if(isset($_GET['msg'])){ echo $_GET['msg']; } ?>
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
		<th>Product Name</th>
		<th>Types</th>
		<th>Details</th>
		<th>Price</th>
		<th style="width:28%;">Action</th>
	</tr>
<?php
	$cosmatics_list_qry = "SELECT * FROM tb_cosmatics";
	$result = $DB->select($cosmatics_list_qry);
	if($result){
		$i = 0; 
		while($cosmatics_data = $result->fetch_array()){
			$i++;
?>
	<tr>
		<td><?php echo $i; ?></td>
		<td><?php echo $cosmatics_data['product_name']; ?></td>
		<td><?php echo $cosmatics_data['types']; ?></td>
		<td><?php echo $cosmatics_data['details']; ?></td>
		<td><?php echo $cosmatics_data['price']; ?></td>
		<td>
			<a href="" class="btn btn-info btn-sm" data-toggle="modal" data-target="#cosmatics_view<?php echo $cosmatics_data['id']; ?>">View</a>
			<a href="?page=Cosmatics&upid=<?php echo $cosmatics_data['id']; ?>" class="btn btn-warning btn-sm">Update</a>
			<a href="?page=Cosmatics&delid=<?php echo $cosmatics_data['id']; ?>" class="btn btn-danger btn-sm">Remove</a>
		</td>
	</tr>
<!-------------------------------------------------------------->
<!-- Modal -->
<div class="modal fade" id="cosmatics_view<?php echo $cosmatics_data['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><?php echo $cosmatics_data['product_name'].' &nbsp; '.$cosmatics_data['types']; ?></h4>
      </div>
      <div class="modal-body">
        <?php 
        	echo '<h3>Product Name # '.$cosmatics_data['product_name'].'</h3>';
        	echo '<h3>Types # '.$cosmatics_data['types'].'</h3>';
        	echo '<h3>Price # '.$cosmatics_data['price'].'.tk</h3>';
        	echo 'Specification # '.$cosmatics_data['details']; 
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