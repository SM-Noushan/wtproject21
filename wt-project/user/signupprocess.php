<?php
	require_once '../config.php';

	if(isset($_POST['registration-user'])){
		$pname=$_POST['pname'];
		$email=$_POST['email'];
		$tel=$_POST['phone'];
		$pass=MD5($_POST['pass']);
		$pnmae=$_POST['pname'];
		//echo ($pname);
		//file
		$folder="../resourses/users/";
		$file_name = time()."-".$_FILES['imgfile']['name'];
		$tmp_name = $_FILES['imgfile']['tmp_name'];
		
		$new_file_name = strtolower($file_name);
		$final_file = str_replace(' ', '-', $new_file_name);
		$imgfile = $folder.$final_file;
		$sql = "INSERT INTO registeredusers (name, username, mobile, password, image) VALUES ('$pname','$email','$tel','$pass', '$imgfile') ";
		if(mysqli_query($conn, $sql)){
			move_uploaded_file($tmp_name,$folder.$final_file);
			echo 'Registration Successfull' ;
			header("refresh: 1, url = signup.php");
		}
		else{
			echo 'Username/Phone alredy exists' ;
			header("refresh: 1, url = signup.php");
		}
	}
?>