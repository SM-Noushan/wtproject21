<script>
	document.title = "Admin: Remove Book";
</script>
<?php
	require_once 'header.php';
	require_once 'securedlogin.php';
	require_once '../config.php';

	$output = "";
	if(isset($_POST['removebook'])){
		$bookname = $_POST['bookname'];
		$sql = "SELECT * FROM bookdetails WHERE bookname = '$bookname'";
		$result = mysqli_query($conn, $sql);
		if(mysqli_num_rows($result)>0){
			$sqldel = "DELETE FROM bookdetails WHERE bookname = '$bookname'";
			mysqli_query($conn, $sqldel);
			$output = 
					'<div class="alert alert-success">Removed Successfully</div>';
		}
		else{
			$output =
					'<div class="alert alert-danger">Failed! No Data Found, Try again</div>';
		}
	}
?>
<div class="container">
	<div class="row">
		<div class="col-lg-2">
			<div id="" class="alter alert success">
				<h5>Categories</h5>
			</div>
			<div class="container">
				<?php
				$sql = "SELECT categories FROM categories ORDER BY categories ASC";
				$result = mysqli_query($conn, $sql);
				if(mysqli_num_rows($result)>0){
					while($row = mysqli_fetch_assoc($result)){
						?>
						<p><?= $row['categories'] ?></p>
						<?php
					}
				}
				?>
			</div>
		</div>
		<div class="col-lg-10 ">
			<form class="d-flex" id="admin-search-user" method="post">
      			<input class="form-control me-2" id="admin-search-user"type="search" name="bookname" placeholder="@bookname" aria-label="Search">
      			<button class="btn btn-outline-success" type="submit" name="removebook">Remove</button>
    		</form>
    		<br>
    		<?= $output ?>
		</div>
	</div>
</div>
<?php
	require_once 'footer.php';
?>