<?php
	if(session_status() != 2)
		session_start();
	require_once '../config.php';
	if(isset($_SESSION['user_status'])){
		$username = $_SESSION['username'];
		$sql = "SELECT * FROM cart WHERE user_id='$username' ";
		$result = mysqli_query($conn, $sql);
		echo mysqli_num_rows($result);
	}
	else{
		echo "error";
	}
?>