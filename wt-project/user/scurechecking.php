<?php
if(session_status() != 2)
	session_start();
	if(!isset($_SESSION['user_status'])){
	?>
		<div class="container-fluid text-center">
			<div class="alert alert-danger ">
    			<strong>SUS!</strong>&nbsp RETURN TO HOMEPAGE
  			</div>
		</div>
	<?php
	require_once 'footer.php';
	exit();
	}
?>