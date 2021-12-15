<script>
    document.title = "Order Review";
</script>
<?php
	include_once 'header.php';
	include_once 'scurechecking.php';
	include_once '../config.php';
	if(!isset($_SESSION['checkout_id'])){
		echo "<script> window.location.href = 'profile.php'; </script>";
	}

	$username  = $_SESSION['username'];
	$checkout_id = $_SESSION['checkout_id'];
	$output="";
	$sql = "SELECT * FROM address WHERE username='$username' AND checkout_id='$checkout_id' ";
	$result = mysqli_query($conn, $sql);
	if($result){
		while($row = mysqli_fetch_array($result)){
			$output .= 
					'<h5>'.$row['name'].'</h5>
					<h5>'.$row['address'].'</h5>
					<h5>Phone:'.$row['phone'].'</h5>';
		}
	}

	if(isset($_POST['pay'])){
		$sql = "SELECT * FROM cart WHERE user_id = '$username' ";
		$result = mysqli_query($conn, $sql);
		if(!$result){
			echo "Error occured";
		}
		else{
			$sql0 = "SELECT * FROM address WHERE checkout_id='$checkout_id' ";
			$result1 = mysqli_query($conn, $sql0);
			while($row = mysqli_fetch_array($result1)){
				$address_id = $row['id'];
			}
			$_SESSION['address_id'] = $address_id;
			$i = 0;
			while ($row = mysqli_fetch_array($result)) {
				$sql1 = "INSERT INTO orders (`sno`, `order_id`, `book_id`, `book_name`, `img`, `price`, `quantity`, `total_price`, `user_id`, `date_of_purchase`, `status`, `payment_method`, `paid`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?)";
				$sql2 = "INSERT INTO orderaddress(`id`, `address_id`, `order_id`) VALUES (?,?,?) ";
				$sql3 = "DELETE FROM cart WHERE user_id = ? ";

				$stmt1 = mysqli_prepare($conn, $sql1);
				$stmt2 = mysqli_prepare($conn, $sql2);
				$stmt3 = mysqli_prepare($conn, $sql3);

				mysqli_stmt_bind_param($stmt1, 'isssssissssss', $param_snp, $param_order_id, $param_book_id, $param_book_name, $param_img, $param_price, $param_quantity, $param_total_price, $param_user_id, $param_date_of_purchase, $param_status, $param_payment_method, $param_paid);
				mysqli_stmt_bind_param($stmt2, 'iis', $param_id, $param_address_id, $param_order_id);
				mysqli_stmt_bind_param($stmt3, 's', $param_user_id);

				$param_snp="";
				$param_order_id=time().$username;
				$_SESSION['orser_id'][$i] = $param_order_id;
				$param_book_id=$row['book_id'];
				$param_book_name=$row['book_name']; 
				$param_img=$row['img'];
				$param_price=$row['price'];
				$param_quantity=$row['quantity']; 
				$param_total_price=$row['total_price']; 
				$param_user_id=$row['user_id'];
				date_default_timezone_set('Asia/Dhaka');
				$param_date_of_purchase=date('Y-m-d H:i:s');
				$param_status="order placed"; 
				$param_payment_method="COD";
				$param_paid="no";
				$param_id="";
				$param_address_id=$address_id;

				$i++;
				if(mysqli_stmt_execute($stmt1) && mysqli_stmt_execute($stmt2) && mysqli_stmt_execute($stmt3)){
					$_SESSION['success_order']="ok";
					unset($_SESSION['checkout_id']);
					echo "<script>
							window.location.href = 'order_sucess.php';
						 </script>";
				}
			}
		}
	}
?>
<div class="container">
	<div class="row">
		<div class="col-sm-8" style="height: 640px; box-shadow: 5px 5px 10px; overflow: auto;">
			<h3 class="text-success">Items in Cart</h3>
			<table class="table table-hover">
                <thead>
                    <tr class="table-primary">
                        <th>#</th>
                        <th>Book</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $sql = "SELECT * FROM cart WHERE user_id = '$username' ";
                        $result = mysqli_query($conn, $sql);
                        if(mysqli_num_rows($result)>0){
                            $count = 1;
                            $amount= 0;
                            while($row = mysqli_fetch_assoc($result)){
                                ?>
                                <tr>
                                    <th scope="row"><?= $count ?></th>
                                    <td>
                                        <figure class="figure text-middle">
                                            <img src="<?= $row['img'] ?>" class="figure-img img-fluid rounded mx-auto d-block" style="width: 100px; height: 100px;">
                                            <figcaption class="figure-caption fs-6"><?= $row['book_name'] ?>
                                            </figcaption>
                                        </figure>
                                    </td>
                                    <td>&#2547 <?= $row['price'] ?></td>
                                    <td><?= $row['quantity'] ?></td>
                                    <td>&#2547 <?= $row['total_price'] ?></td>
                                </tr>
                                <?php
                                $count++;
                                $amount = (int)$amount+(int)$row['total_price'];
                            }
                            ?>
                            <tfoot>
                                <tr>
                                    <th scope="row">Total Amount</th>
                                    <td colspan="3"></td>
                                    <td>&#2547 <?= $amount ?></td>
                                </tr>
                            </tfoot>
                    </tbody>
                </table>
                            <?php
                        }
                        else{
                            $_SESSION['cart_status']="empty";
                            ?>
                            <tr class="text-info"><td colspan="5"></td></tr>
                    </tbody>
                </table>
                            <div class="card-body cart">
                                <div class="col-sm-12 empty-cart-cls text-center"> <img src="/wt-project/resourses/emptycart.png" width="130" height="130" class="img-fluid mb-4 mr-3">
                                    <h3 class="text-dark"><strong>Your Cart is Empty</strong></h3>
                                    <h4 class="text-dark">Add something to make me happy :)</h4> <a href="/wt-project/index.php" class="btn btn-primary cart-btn-transform m-3" data-abc="true">continue shopping</a>
                                 </div>
                            </div>    
                            <?php
                        }
                    ?>
		</div>
		<div class="col-sm-1"></div>
		<div class="col-sm-3">
			<div class=" p-4" style="height: 300px; box-shadow: 5px 5px 10px;">
				<h4 class="text-success">Delivery Address</h4>
				<hr><?= $output ?>
			</div>
			<div class="mt-5 p-3" style="height: 300px; box-shadow: 5px 5px 10px;">
				<h4 class="text-success">Payment Method</h4>
				<hr>
				<form class="form-group" method="post">
					<input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" checked>
						  <label class="form-check-label" for="flexRadioDefault2">
						    <h5 class="text-dark">Cash on Delivery</h5>
						  </label>
					<br><button type="submit" class="btn btn-success" name="pay">Pay</button>
				</form>
			</div>
		</div>
	</div>
</div>


<?php
	include_once 'footer.php';
?>