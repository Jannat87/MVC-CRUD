<!--/********************************************************************/--->
<!-------------------------------start Update new data----------------------->
<!--/********************************************************************/--->
<?php
	if(isset($_GET['delid'])){
		$delid = $_GET['delid'];
		$qry_delete_byke = "DELETE FROM tb_byke WHERE id=$delid";
		$result = $DB->delete($qry_delete_byke);
		if($result){
			$msg = '<span style="color:red;"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Deleted Done !</span>';
			header('Location:index.php?page=Byke&msg='.$msg);
		}
	}
?>

<?php 
	if(isset($_POST['byke'])){
		$product_name = $_POST['product_name']; 
		$brand = $_POST['brand']; 
		$details = $_POST['details']; 
		$price = $_POST['price']; 

		if(empty($product_name) OR empty($brand) OR empty($details) OR empty($price)){
			$msg_save = '<span style="color:red;"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Field Must Not Empty !</span>';
			header('Location:index.php?page=Byke&msg='.$msg_save);
		}else{

			$byke_query = "INSERT INTO tb_byke (product_name,brand,details,price) 
			VALUES ('$product_name','$brand','$details','$price')";

			$result = $DB->insert($byke_query);
			if($result){
				$product_name=null; 
				$brand =null; 
				$details='';
				$price='';

				$msg_save = '<span style="color:green;"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Successfully Saved !</span>';
				header('Location:index.php?page=Byke&msg='.$msg_save);
			}

		}
	}
?>

<?php
	if(isset($_POST['update_byke'])){
		$id = $_POST['update_id'];
		$product_name = $_POST['product_name'];
		$brand  = $_POST['brand'];
		$details = $_POST['details'];
		$price = $_POST['price'];

		if(empty($product_name) OR empty($brand) OR empty($details) OR empty($price)){
			$msg = '<span style="color:red;"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span> 00 Field Must Not Empty !</span>';
			header('Location:index.php?page=Byke&msg='.$msg);
		}else{
			$byke_query = "UPDATE tb_byke
				SET
				product_name = '$product_name',
				brand= '$brand',
				details = '$details',
				price = '$price'
				WHERE id = '$id'
			";

			$result = $DB->insert($byke_query);
			if($result){
				$product_name=null;
				$brand=null;
				$details='';
				$price='';

				$msg = '<span style="color:teal;"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Successfully Updated !</span>';
				header('Location:index.php?page=Byke&msg='.$msg);
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
		$qry_update = "SELECT * FROM tb_byke WHERE id='$upid'";
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
<form action="index.php?page=Byke" method="post">
	<input type="hidden" value="<?php echo $upid; ?>" name="update_id">
  <div class="form-group">
    <label for="exampleInputEmail1">Product Name</label>
    <input name="product_name" type="text" class="form-control" id="exampleInputEmail1" 
    value="<?php if(isset($update_data)){ echo $update_data['product_name']; } ?>">
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Brand</label>
    <input name="brand" type="text" class="form-control" id="exampleInputEmail1" 
    value="<?php if(isset($update_data)){ echo $update_data['brand']; } ?>">
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Details</label>
 	<textarea class="form-control" name="details" rows="4"><?php echo $update_data['details']; ?></textarea>
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">price</label>
    <input name="price" type="text" class="form-control" id="exampleInputEmail1" 
    value="<?php if(isset($update_data)){ echo $update_data['price']; } ?>">
  </div>
  
  <button name="update_byke" type="submit" class="btn btn-warning">Update</button>
  &nbsp; &nbsp; <?php if(isset($_GET['msg'])){ echo $_GET['msg']; } ?>
</form>
<?php		
	}else{
?>
<form action="index.php?page=Byke" method="post">
  <div class="form-group">
    <label for="exampleInputEmail1">Product Name</label>
    <input name="product_name" type="text" class="form-control" id="exampleInputEmail1" 
    value="<?php if(isset($update_data)){ echo $update_data['product_name']; } ?>">
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Brand</label>
    <input name="brand" type="text" class="form-control" id="exampleInputEmail1" 
    value="<?php if(isset($update_data)){ echo $update_data['brand']; } ?>">
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Details</label>
    <textarea class="form-control" name="details" rows="4"></textarea>
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Price</label>
    <input name="price" type="text" class="form-control" id="exampleInputEmail1" placeholder="Price">
  </div>
  <button name="byke" type="submit" class="btn btn-primary">Save</button> 
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
		<th>Product Name</th>
		<th>Brand</th>
		<th>Price</th>
		<th style="width:28%;">Action</th>
	</tr>
<?php 
	$byke_load_qry = "SELECT * FROM tb_byke";
	$result = $DB->select($byke_load_qry); 
	if($result){
		$i = 0; 
		while($byke = $result->fetch_array()){
			$i++; 
?>
	<tr>
		<td><?php echo $i; ?></td>
		<td><?php echo $byke['product_name']; ?></td>
		<td><?php echo $byke['brand']; ?></td>
		<td><?php echo $byke['price']; ?></td>
		<td>
			<a href="" class="btn btn-info btn-sm" data-toggle="modal" data-target="#byke_view<?php echo $byke['id']; ?>">View</a>
			<a href="?page=Byke&upid=<?php echo $byke['id']; ?>" class="btn btn-warning btn-sm">Update</a>
			<a href="?page=Byke&delid=<?php echo $byke['id']; ?>" class="btn btn-danger btn-sm">Remove</a>
		</td>
	</tr>
<!-------------------------------------------------------------->
<!-- Modal -->
<div class="modal fade" id="byke_view<?php echo $byke['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><?php echo $byke['product_name'].' &nbsp; '.$byke['brand']; ?></h4>
      </div>
      <div class="modal-body">
        <?php 
        	echo '<h3>Product Name # '.$byke['product_name'].'</h3>';
        	echo '<h3>Brand Name # '.$byke['brand'].'</h3>';
        	echo '<h3>Price # '.$byke['price'].'.tk</h3>';
        	echo 'Specification # '.$byke['details']; 
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
