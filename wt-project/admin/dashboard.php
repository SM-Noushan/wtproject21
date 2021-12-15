<script>
	document.title = "Admin: Dashboard";
</script>
<?php
	require_once 'header.php';
	require_once 'securedlogin.php';
	require_once '../config.php';
	

	$err = "";
	$msg = "";
	if(isset($_POST["remove"])){
		$selectedCategory = $_POST["flexRadioDefault"];
		$sqlrmv = "DELETE FROM categories WHERE categories ='$selectedCategory' ";
		$result = mysqli_query($conn, $sqlrmv);
	}
	if(isset($_POST["add"])){
		if(empty($_POST["add"])){
			$err = "Enter a valid categorie";
			$msg = "";
		}
		else{
			$data = $_POST['categoryname'];
			$data = trim($data);
			$data = stripslashes($data);
			$data = htmlspecialchars($data);
			$categoryName = $data;

			$sqladd = "INSERT INTO categories (categories) values ('$categoryName') ";
			if(mysqli_query($conn, $sqladd)){
				$msg = "Category Added Successfully";
				$err = "";
			}
			else{
				$err = "Error! Duplicate Category";
				$msg = "";
			}
		}
		
	}
		
?>

<div class="container">
	<div class="row">
		<div class="col-lg-2">
			<div id="" class="alter alert success">
				<h5>Categories</h5>
			</div>
			<div class="form-check">
				<form class="" action="" method="post">
					<?php
					$sql = "SELECT categories FROM categories ORDER BY categories ASC";
					$result = mysqli_query($conn, $sql);
					if(mysqli_num_rows($result)>0){
						while($row = mysqli_fetch_assoc($result)){
							?>
							<input class="form-check-input" type="radio" name="flexRadioDefault" value="<?= $row['categories'] ?>">
  							<label class="form-check-label"><?= $row["categories"]?></label> <br>
							<?php
						}
					}
					?>
  					<input id="delete-categorie" type="submit" name="remove" value="Remove" class="btn btn-dark btn-sm">
		        </form>
			</div>
			<div class="form-check">
				<form class="" action="" method="post">
			        <input id="add-category" type="text" name="categoryname" class="form-control">
			        <span class="text-danger"><?= $err ?></span>
  					<input id="add-categorie" type="submit" name="add" value="Add" class="btn btn-dark btn-sm">
  					<span class="text-info"><?= $msg ?></span>
		        </form>
			</div>
		</div>

		<div class="col-lg-10">
			<div id="wtap" class="alter alert success">
				<h5> Welcome To Admin Panel</h5>
			</div>
			<div class="row row-cols-1 row-cols-md-3 g-4">
			  <div class="col">
			    <div class="card h-100" id="carduser">
			      <img src="../resourses/registeredusers.png" class="card-img-top dashboard-img" alt="...">
			      <div class="card-body">
			        <h5 class="card-title text-primary">User Management</h5>		
			      </div>
			      <a href="registeredusers.php" class="btn btn-primary" id="btnuser">View Users</a>
			    </div>
			  </div>
			  <div class="col">
			    <div class="card h-100" id="carduser">
			      <img src="../resourses/managebooks.png" class="card-img-top dashboard-img" alt="...">
			      <div class="card-body">
			        <h5 class="card-title text-primary">Books Management</h5>			        
			      </div>
			      <a href="managebooks.php" class="btn btn-primary" id="btnuser">Manage Books</a>
			    </div>
			  </div>
			  <div class="col">
			    <div class="card h-100" id="carduser">
			      <img src="../resourses/orders.png" class="card-img-top dashboard-img" alt="...">
			      <div class="card-body">
			        <h5 class="card-title text-primary">Order History</h5>
			      </div>
			      <a href="viewhistory.php" class="btn btn-primary" id="btnuser">View History</a>
			    </div>
			  </div>
			</div>
		</div>
	</div>
</div>
<?php
	require_once 'footer.php';
?>