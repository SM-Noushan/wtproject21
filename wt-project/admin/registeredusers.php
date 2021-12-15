<script>
	document.title = "Admin: Users Management";
</script>
<?php
	require_once 'header.php';
	require_once 'securedlogin.php';
	require_once '../config.php';

	$output = "";
	$totaluser = "";
	if(isset($_POST['userid'])){
		$data = $_POST['username'];
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		$userid = $data;
		$sql = "SELECT * FROM registeredusers where username = '$userid' ";
		$result = mysqli_query($conn, $sql);
		if(mysqli_num_rows($result)>0){
			$count = 1;
			$totaluser = "User Found";
			while($row = mysqli_fetch_assoc($result)){
				$output = 
					'<table class="table table-hover">
					<thead>
						<tr class="table-primary">
							<th>#</th>
							<th>ID</th>
							<th>Name</th>
							<th>Phone</th>
							<th>Photo</th>
						</tr>
						</thead>
						<tbody>
						<tr>
							<th scope="row">'.$count.'</th>
							<td>'.$row['username'].'</td>
							<td>'.$row['name'].'</td>
							<td>'.$row['mobile'].'</td>
							<td class="admin-userphoto"><img src='.$row['image'].'></td>
						</tr>
						</tbody>
					</table>';
					$count = $count+1;
			}
		}
		else{
			$output =
				'<div class="alert alert-danger">No Records Found</div>';
		}
	}

	if(isset($_POST['alluser'])){
		$sql = "SELECT * FROM registeredusers";
		$result = mysqli_query($conn, $sql);
		if(mysqli_num_rows($result)>0){
			$totaluser = "Total Users: ".mysqli_num_rows($result);
			$count = 1;
			$output = 
					'<table class="table table-hover">
					<thead>
						<tr class="table-primary">
							<th>#</th>
							<th>ID</th>
							<th>Name</th>
							<th>Phone</th>
							<th>Photo</th>
						</tr>
						</thead>
						<tbody>';
			while($row = mysqli_fetch_assoc($result)){
				$output .= 
						'<tr>
							<th scope="row">'.$count.'</th>
							<td>'.$row['username'].'</td>
							<td>'.$row['name'].'</td>
							<td>'.$row['mobile'].'</td>
							<td class="admin-userphoto"><img src='.$row['image'].'></td>
						</tr>';
					$count = $count+1;
			}
			$output .= 
					'</tbody>
					</table>';
		}
		else{
			$output =
				'<div class="alert alert-danger">No Registered User Found</div>';
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
      			<input class="form-control me-2" id="admin-search-user"type="search" placeholder="@username" aria-label="Search" name="username">
      			<button class="btn btn-outline-success" type="submit" name="userid">Search</button>&nbsp
      			<button class="btn btn-outline-success" type="submit" name="alluser">View All</button>
    		</form>
    		<h4 class="text-success"><?= $totaluser ?></h4>
    		<?= $output ?>
		</div>
	</div>
</div>
<?php
	require_once 'footer.php';
?>