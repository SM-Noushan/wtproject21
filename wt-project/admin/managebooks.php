<script>
	document.title = "Admin: Manage Books";
</script>
<?php
	require_once 'header.php';
	require_once 'securedlogin.php';
	require_once '../config.php';
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
		<div class="col-lg-10">
			<div id="wtap" class="alter alert success" style="background-color: darkgreen;">
				<h5> Books Management </h5>
			</div>


			<div class="row row-cols-1 row-cols-md-3 g-4">
			  <div class="col">
			    <div class="card h-100" id="carduser">
			      <img src="../resourses/addbook.png" class="card-img-top dashboard-img" alt="...">
			      <div class="card-body">
			        <h5 class="card-title text-success"></h5>		
			      </div>
			      <a href="addbooks.php" class="btn btn-success" id="btnuser">Add Book</a>
			    </div>
			  </div>
			  <div class="col">
			    <div class="card h-100" id="carduser">
			      <img src="../resourses/viewbook.png" class="card-img-top dashboard-img" alt="...">
			      <div class="card-body">
			        <h5 class="card-title text-success"></h5>			        
			      </div>
			      <a href="viewbooks.php" class="btn btn-success" id="btnuser">View Book</a>
			    </div>
			  </div>
			  <div class="col">
			    <div class="card h-100" id="carduser">
			      <img src="../resourses/removebook.png" class="card-img-top dashboard-img" alt="...">
			      <div class="card-body">
			        <h5 class="card-title text-success"></h5>
			      </div>
			      <a href="removebook.php" class="btn btn-success" id="btnuser">Remove Book</a>
			    </div>
			  </div>
			</div>
		</div>
	</div>
</div>
<?php
	require_once 'footer.php';
?>