<script>
    document.title = "Checkout";
</script>
<?php
	include_once 'header.php';
	include_once '../config.php';
	include_once 'scurechecking.php';

	if(isset($_POST['checkout'])){
		$username = $_SESSION['username'];
		$name =$_POST['name'];
		$address =$_POST['address'].', '.$_POST['city'].'-'.$_POST['post'].', '.$_POST['division'];
		$phone =$_POST['phone'];

		$sql = "INSERT INTO address (username, name, address, phone, checkout_id) VALUES(?,?,?,?,?) ";
		if($stmt = mysqli_prepare($conn, $sql)){
			mysqli_stmt_bind_param($stmt, 'sssss', $param_username, $param_name, $param_address, $param_phone, $param_checkout_id);
			$param_username = $username;
			$param_name = $name;
			$param_address = $address;
			$param_phone = $phone;
			$param_checkout_id = uniqid();
			$_SESSION['checkout_id'] = $param_checkout_id;

			if(mysqli_stmt_execute($stmt)){
				echo "<script> window,location.href = 'order_review.php'; </script>";
			}
			else{

			}
		}
	}
?>
<?php
	if($_SESSION['cart_status']=="empty" || !isset($_SESSION['cart_status'])){
		include_once 'footer.php';
		echo "<script> window,location.href = '../index.php'; </script>";
	}
	else{
		$username = $_SESSION['username'];
		$sql = "SELECT * FROM cart WHERE user_id = '$username' ";
        $result = mysqli_query($conn, $sql);
        
        if(mysqli_num_rows($result)>0){
        	$amount= 0;
        	$cartcount = mysqli_num_rows($result);
        	?>
        	<div class="container">
				<div class="row">
					<div class="col-sm-3"></div>
					<div class="col-sm-8">
						<div class="py-1 mb-4 text-center bg-info">
					    	<h2>Checkout form</h2>
					  	</div>
						<div class="row">
						    <div class="col-md-4 order-md-2 mb-4"> <br>
						      	<h4 class="d-flex justify-content-between align-items-center mb-3">
						        	<i class="fab fa-shopify fa-1x" style="font-size:1.3rem;">&nbsp MyCart</i>
				                	<span class="position-absolute   translate-middle badge rounded-pill bg-danger" style="font-size:0.5rem;"><?= $cartcount ?></span>
						      	</h4>
        	<?php
			while($row = mysqli_fetch_assoc($result)){
			?>
						<ul class="list-group mb-3">
						        <li class="list-group-item d-flex justify-content-between lh-condensed">
						          <div>
						            <h6 class="my-0"><?= $row['book_name'] ?></h6>
						            <small class="text-muted">Quantity:&nbsp<?= $row['quantity'] ?></small>
						          </div>
						          <span class="text-muted">&#2547 <?= $row['price'] ?></span>
						        </li>
	        <?php
	        	$amount = (int)$amount+(int)$row['total_price'];
			}
			?>
								<li class="list-group-item d-flex justify-content-between">
								    <span>Total (BDT)</span>
								    	<strong>&#2547 <?= $amount ?></strong>
								</li>
					      </ul>
					      </div>
					      <div class="col-md-8 order-md-1">
						      	<h4 class="mb-3">Billing Address</h4>
						      	<form method="post" id="checkoutform" style="position: relative;">
						          	<div class="form-group mb-3">
						           		<label for="name"><i class="fas fa-user"></i>&nbspFull Name</label>
							           	<input type="text" class="form-control" name="name" id="name" placeholder="Enter your name" value="" required>
							            <div class="invalid-feedback">
							            	Valid first name is required.
							            </div>
							        </div>
							        <div class="form-group mb-3">
						           		<label for="address"><i class="fas fa-address-card"></i>&nbspAddress</label>
							           	<input type="text" class="form-control" name="address" id="address" placeholder="Enter your address" value="" required>
								        <div class="invalid-feedback">
								            Valid address is required.
								        </div>
							        </div>
							        <div class="form-group mb-3">
						            	<label for="division"><i class="fas fa-city"></i>&nbspDivision</label>
							           	<input type="text" class="form-control" name="division" id="division" placeholder="Enter your division" value="" required>
								        <div class="invalid-feedback">
								            Valid division is required.
								        </div>
							        </div>
							        <div class="row">
							          	<div class="form-group col-md-6 mb-3">
							            	<label for="city">City</label>
							            	<input type="text" class="form-control" name="city" id="city" placeholder="Enter your city" value="" required>
							            	<div class="invalid-feedback">
							              		Valid city is required.
							            	</div>
							          	</div>
							          	<div class="form-group col-md-6 mb-3">
							            	<label for="postal">Post Code</label>
							            	<input type="text" class="form-control" name="post" id="post" placeholder="" value="" required>
							            	<div class="invalid-feedback">
							              		Valid post code is required.
							            	</div>
							          	</div>
							        </div>
							        <div class="form-group mb-3">
						            	<label for="phone"><i class="fas fa-city"></i>&nbspPhone</label>
							           	<input type="text" class="form-control" name="phone" id="phone" placeholder="Enter your phone number" value="" pattern="(^(01){1}[3456789]{1}[0-9]{8})$" required>
								        <div class="invalid-feedback">
								            Valid phone is required.
								        </div>
							        </div>
						        	<div class="form-group d-grid gap-2 d-md-flex justify-content-md-end">
						        		<hr class="mb-4">
						        		<button class="btn btn-primary btn-lg btn-block" type="submit" name="checkout" id="checkout">Continue to checkout</button>
						        	</div>
						      </form>
						    </div>
						</div>
					</div>
					<div class="col-sm-1"></div>
				</div>
			</div>
			<?php        
        }
	}
?>

<?php
    include_once 'footer.php';
?>