<?php
	require_once '../config.php';
	$adminUsername = $adminPassword = "";
	$adminUsernameError = $adminPasswordError = $error = "";
	if(isset($_POST["submit"])){
		if(empty($_POST['username'])){
			$adminUsernameError = "Enter Username";
		}
		else{
			$data = $_POST['username'];
			$data = trim($data);
			$data = stripslashes($data);
			$data = htmlspecialchars($data);
			$adminUsername = $data;
		}
		if(empty($_POST["password"])){
			$adminPasswordError = "Enter password";
		}
		else{
			$data = $_POST['password'];
			$data = trim($data);
			$data = stripslashes($data);
			$data = htmlspecialchars($data);
			$adminPassword = $data;
		}

		if(empty($adminUsernameError) && empty($adminPasswordError)){
			$sql = "SELECT * FROM admin WHERE username = '$adminUsername' AND password = md5('$adminPassword') ";
			$result = mysqli_query($conn, $sql);
			if(mysqli_num_rows($result)>0){
				session_start();
				$_SESSION['admin_status'] = true;
				header('location: dashboard.php');
			}
			else{
			$error = "invalid login credentials";
			}
		}

	}
	require_once 'header.php';
?>

<?php
	if(!isset($_SESSION['admin_status'])){
	?>
	<div class="container">
		<div class="row">
			<div class="col-sm-4"></div>
			<div class="col-sm-4">
				<h3>Welcome, Admin</h3>
				<span class="text-danger"><?= $error ?></span>
				<form class="" action="" method="post">
			        <div class="form-group">
				        <label>Username</label><br>
				        <input id="username" type="text" name="username" class="form-control">
				        <span class="text-danger"><?= $adminUsernameError ?></span>
			        </div>
			        <div class="form-group">
				        <label>Password</label><br>
				        <input id="password" type="password" name="password" class="form-control">
				        <span class="text-danger"><?= $adminPasswordError ?></span>
			        </div>
			        <div class="form-group">
				        <input id="login-btn" type="submit" name="submit" value="Login" class="btn btn-success">
			        </div>
		        </form>
			</div>
		</div>
	</div>
	<div class="container" style="height: 145px">
	</div>
	<?php
	} 
	else{
	?>
	<div class="container-fluid text-center">
			<div class="alert alert-danger ">
    			<strong>SUS!</strong>&nbsp RETURN TO HOMEPAGE
  			</div>
	</div>
	<?php
	}
?>

<?php
	require_once 'footer.php';
?>