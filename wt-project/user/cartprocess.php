<?php
	include_once 'scurechecking.php';
	if(session_status() != 2)
		session_start();
	require_once '../config.php';
	$var = $_POST['action'];

	switch ($var) {
		case 'add-to-cart':
			$bookid = $_POST['bookid'];
			$bookname = $_POST['bookname'];
			$image = $_POST['image'];
			$price = $_POST['price'];
			$username = $_SESSION['username'];
			$quantity = $_POST['quantity'];

			$sql = "SELECT * FROM cart WHERE user_id='$username' AND book_id='$bookid' ";
			$result = mysqli_query($conn, $sql);
			if(mysqli_num_rows($result)==1){
				//data-auto-dismiss="2000"
				$status = '<div class="alert alert-danger" role="alert" >Item already added to cart</div>';
			}
			else{
				$sql = "INSERT INTO cart(book_id, book_name, img, price, total_price, quantity, user_id) VALUES ('$bookid', '$bookname', '$image', '$price', '$price', '$quantity', '$username')";
				if(mysqli_query($conn, $sql)){
					$_SESSION['cart_status'] = "okay";
					$status = '<div class="alert alert-success" role="alert" >Item successfully added to cart</div>';
				}
				else{
					$status = '<div class="alert alert-warning" role="alert" >Something went wrong, Try again</div>';
				}
			}
			echo $status;
			break;
		default:
			// code...
			break;
	}
?>