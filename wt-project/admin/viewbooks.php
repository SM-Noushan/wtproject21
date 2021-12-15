<script>
	document.title = "Admin: View Books";
</script>
<?php
	require_once 'header.php';
	require_once 'securedlogin.php';
	require_once '../config.php';

	$output = "";
	$totaluser = "";
	if(isset($_POST['searchbookname'])){
		$data = $_POST['bookname'];
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		$userid = $data;
		$sql = "SELECT * FROM bookdetails WHERE bookname = '$userid' ";
		$result = mysqli_query($conn, $sql);
		if(mysqli_num_rows($result)>0){
			$count = 1;
			$totaluser = "Book Found";
			while($row = mysqli_fetch_assoc($result)){
				$output = 
					'<table class="table table-hover">
					<thead>
						<tr class="table-primary">
							<th>#</th>
							<th>Bookname</th>
							<th>Author</th>
							<th>Price</th>
							<th>Category</th>
							<th>Description</th>
							<th>ISBN</th>
							<th>Cover</th>
						</tr>
						</thead>
						<tbody>
						<tr>
							<th scope="row">'.$count.'</th>
							<td>'.$row['bookname'].'</td>
							<td>'.$row['author'].'</td>
							<td>'.$row['price'].'</td>
							<td>'.$row['category'].'</td>
							<td>'.$row['description'].'</td>
							<td>'.$row['isbn'].'</td>
							<td class="admin-viewbookscover"><img src='.$row['image'].'></td>
						</tr>
						</tbody>
					</table>';
					$count = $count+1;
			}
		}
		else{
			$output =
				'<div class="alert alert-danger">No Book Found</div>';
		}
	}

	if(isset($_POST['allbook'])){
		$sql = "SELECT * FROM bookdetails ORDER BY bookname ASC ";
		$result = mysqli_query($conn, $sql);
		if(mysqli_num_rows($result)>0){
			$totaluser = "Total Books: ".mysqli_num_rows($result);
			$count = 1;
			$output = 
					'<table class="table table-hover">
					<thead>
						<tr class="table-primary">
							<th>#</th>
							<th>Bookname</th>
							<th>Author</th>
							<th>Price</th>
							<th>Category</th>
							<th>Description</th>
							<th>ISBN</th>
							<th>Cover</th>
						</tr>
						</thead>
						<tbody>';
			while($row = mysqli_fetch_assoc($result)){
				$output .= 
						'<tr>
							<th scope="row">'.$count.'</th>
							<td>'.$row['bookname'].'</td>
							<td>'.$row['author'].'</td>
							<td>'.$row['price'].'</td>
							<td>'.$row['category'].'</td>
							<td>'.$row['description'].'</td>
							<td>'.$row['isbn'].'</td>
							<td class="admin-viewbookscover"><img src='.$row['image'].'></td>
						</tr>';
					$count = $count+1;
			}
			$output .= 
					'</tbody>
					</table>';
		}
		else{
			$output =
				'<div class="alert alert-danger">No Registered Books Found</div>';
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
      			<input class="form-control me-2" id="admin-search-user"type="search" placeholder="@bookname" aria-label="Search" name="bookname">
      			<button class="btn btn-outline-success" type="submit" name="searchbookname">Search</button>&nbsp
      			<button class="btn btn-outline-success" type="submit" name="allbook">View All</button>
    		</form>
    		<h4 class="text-success"><?= $totaluser ?></h4>
    		<?= $output ?>
		</div>
	</div>
</div>
<?php
	require_once 'footer.php';
?>