<!--/********************************************************************/--->
<!-------------------------------start Update new data----------------------->
<!--/********************************************************************/--->
<?php
	if(isset($_GET['delid'])){
		$delid = $_GET['delid']; 
		$qry_delete_book = "DELETE FROM tb_book WHERE id=$delid";
		$result = $DB->delete($qry_delete_book); 
		if($result){
			$msg = '<span style="color:red;"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Deleted Done !</span>';
			header('Location:index.php?page=Book&msg='.$msg);
		}
	}
?>

<?php 
	if(isset($_POST['book'])){
		$book_name = $_POST['book_name']; 
		$author_name = $_POST['author_name']; 
		$published_date = $_POST['published_date']; 
		$price = $_POST['price']; 

		if(empty($book_name) OR empty($author_name) OR empty($published_date) OR empty($price)){
			$msg = "Filed Must Not Empty !"; 
			header('Location:?page=Book&msg='.$msg); 
		}else{
			$qry_book = "INSERT INTO tb_book (book_name,author_name,published_date,price) VALUES ('$book_name','$author_name','$published_date','$price')";

			$result = $DB->insert($qry_book); 
			if($result){
				$msg = "Save Successfully !"; 
				header('Location:?page=Book&msg='.$msg); 
			}
		}
	}
?>

<?php
	if(isset($_POST['update_book'])){
		$id = $_POST['update_id']; 
		$book_name = $_POST['book_name']; 
		$author_name = $_POST['author_name']; 
		$published_date = $_POST['published_date']; 
		$price = $_POST['price']; 

		if(empty($book_name) or empty($author_name) or empty($published_date) 
			or empty($price)){
			$msg = '<span style="color:red;"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Field Must Not Empty !</span>';
			header('Location:index.php?page=Book&msg='.$msg);
		}else{

			$book_query = "UPDATE tb_book
				SET 
				book_name = '$book_name',
				author_name   = '$author_name',
				published_date = '$published_date',
				price   = '$price'
				WHERE id='$id'
			"; 

			$result = $DB->insert($book_query);
			if($result){
				$book_name=null; 
				$author_name=null; 
				$published_date='';
				$price='';

				$msg = '<span style="color:teal;"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Successfully Updated !</span>';
				header('Location:index.php?page=Book&msg='.$msg);
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
		$qry_update = "SELECT * FROM tb_book WHERE id='$upid'";
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
<form action="index.php?page=Book" method="post">
	<input type="hidden" value="<?php echo $upid; ?>" name="update_id">
  <div class="form-group">
    <label for="exampleInputEmail1">Book Name</label>
    <input name="book_name" type="text" class="form-control" id="exampleInputEmail1" value="<?php if(isset($update_data)){ echo $update_data['book_name']; } ?>">
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Author Name</label>
    <input name="author_name" type="text" class="form-control" id="exampleInputEmail1" value="<?php if(isset($update_data)){ echo $update_data['author_name']; } ?>">
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Published Date</label>
    <input name="published_date" type="date" class="form-control">
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Price</label>
    <input name="price" type="text" class="form-control" id="exampleInputEmail1" value="<?php if(isset($update_data)){ echo $update_data['price']; } ?>">
  </div>
  <button name="update_book" type="submit" class="btn btn-warning">Update</button> 
  &nbsp; &nbsp; <?php if(isset($_GET['msg'])){ echo $_GET['msg'];} ?>
</form>
<?php 
	}else{
?>
<form action="index.php?page=Book" method="post">
  <div class="form-group">
    <label for="exampleInputEmail1">Book Name</label>
    <input name="book_name" type="text" class="form-control" id="exampleInputEmail1" placeholder="Book Name">
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Author Name</label>
    <input name="author_name" type="text" class="form-control" id="exampleInputEmail1" placeholder="Author Name">
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Published Date</label>
    <input name="published_date" type="date" class="form-control">
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Price</label>
    <input name="price" type="text" class="form-control" id="exampleInputEmail1" placeholder="Price">
  </div>
  <button name="book" type="submit" class="btn btn-primary">Save</button>
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
		<th>Book Name</th>
		<th>Author Name</th>
		<th>Published Date</th>
		<th>Price</th>
		<th style="width:28%;">Action</th>
	</tr>
<?php 
	$book_list_qry = "SELECT * FROM tb_book";
	$result = $DB->select($book_list_qry); 
	if($result){
		$i = 0; 
		while($book_data = $result->fetch_array()){
			$i++;
?>
	<tr>
		<td><?php echo $i; ?></td>
		<td><?php echo $book_data['book_name']; ?></td>
		<td><?php echo $book_data['author_name']; ?></td>
		<td><?php echo $book_data['published_date']; ?></td>
		<td><?php echo $book_data['price']; ?></td>
		<td>
			<a href="" class="btn btn-info btn-sm" data-toggle="modal" data-target="#book_view<?php echo $book_data['id']; ?>">View</a>
			<a href="?page=Book&upid=<?php echo $book_data['id']; ?>" class="btn btn-warning btn-sm">Update</a>
			<a href="?page=Book&delid=<?php echo $book_data['id']; ?>" class="btn btn-danger btn-sm">Remove</a>
		</td>
	</tr>
<!-------------------------------------------------------------->
<!-- Modal -->
<div class="modal fade" id="book_view<?php echo $book_data['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><?php echo $book_data['book_name']?></h4>
      </div>
      <div class="modal-body">
        <?php 
        	echo '<h3>Book Name # '.$book_data['book_name'].'</h3>';
        	echo '<h3>Author Name # '.$book_data['author_name'].'</h3>';
        	echo '<h3>Price # '.$book_data['price'].'.tk</h3>';
        	echo 'Specification # '.$book_data['published_date']; 
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
