<script>
	document.title = "Admin: Order History";
</script>
<?php
	require_once 'header.php';
	require_once 'securedlogin.php';
	require_once '../config.php';

	$output = "";
	$totalorder = "";
	$to = 0;
	$orderid = "";
	if(isset($_POST['orderid'])){
		$data = $_POST['order_id'];
		$orderid = $data;
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		$orderid = $data;
		$sql = "SELECT * FROM orders where order_id = '$orderid' ";
		$result = mysqli_query($conn, $sql);
		if(mysqli_num_rows($result)==1){
			$row = mysqli_fetch_assoc($result);
			$orderid = $row['order_id'];
			$orderid = str_replace($row['user_id'], "", $orderid);
			$totalorder = "ORDER FOUND";
			$output ='<table class="table table-dark">
					<thead>
						<tr class="table-primary">
							<th>ORDER ID</th>
							<th>USER ID</th>
							<th>BOOK</th>
							<th>QUANTITY</th>
							<th>PRICE</th>
							<th>DATE OF PURCHASE</th>
							<th>PAY METHOD</th>
						</tr>
						</thead>
						<tbody>
							<tr>
								<th scope="row">'.$orderid.'</th>
								<td>'.$row['user_id'].'</td>
								<td class="admin-userphoto"><img src='.$row['img'].'></td>
								<td>'.$row['quantity'].'</td>
								<td>'.$row['price'].'</td>
								<td>'.$row['date_of_purchase'].'</td>
								<td>'.$row['payment_method'].'</td>
							</tr>
							</tbody>
						</table>';
		}
		else if(mysqli_num_rows($result)>1){
			$row = mysqli_fetch_assoc($result);
			$orderid = $row['order_id'];
			$orderid = str_replace($row['user_id'], "", $orderid);
			$count = mysqli_num_rows($result);
			$totalorder = "ORDER FOUND";
			$output ='<table class="table table-dark align-middle">
					<thead>
						<tr class="table-primary">
							<th>ORDER ID</th>
							<th>USER ID</th>
							<th>BOOK</th>
							<th>QUANTITY</th>
							<th>PRICE</th>
							<th>DATE OF PURCHASE</th>
							<th>PAY METHOD</th>
						</tr>
						</thead>
						<tbody>
							<tr>
								<th scope="row" rowspan='.$count.'>'.$orderid.'</th>
								<td rowspan='.$count.'>'.$row['user_id'].'</td>
								<td class="admin-userphoto"><img src='.$row['img'].'></td>
								<td>'.$row['quantity'].'</td>
								<td>'.$row['price'].'</td>
								<td>'.$row['date_of_purchase'].'</td>
								<td>'.$row['payment_method'].'</td>
							</tr>
							';
						$serial = 1;
			while($row = mysqli_fetch_assoc($result)){
				//if($serial != 1){
					$output .= 
						'<tr>
							<td class="admin-userphoto"><img src='.$row['img'].'></td>
							<td>'.$row['quantity'].'</td>
							<td>'.$row['price'].'</td>
							<td>'.$row['date_of_purchase'].'</td>
							<td>'.$row['payment_method'].'</td>
						</tr>';
						
				//}
				//else{
					//$serial=2;
				//}
			}
					$output .=
							'</tbody>
									</table>';
		}
		else{
			$output =
				'<div class="alert alert-danger">No Records Found</div>';
		}
	}

	if(isset($_POST['allorders'])){
		$sql = "SELECT * FROM orders";
		$result = mysqli_query($conn, $sql);
		if(mysqli_num_rows($result)>0){
			$to = mysqli_num_rows($result);
			$totalorder = "Total Orders: ".mysqli_num_rows($result);
			$sql = "SELECT * FROM orders ORDER BY date_of_purchase DESC LIMIT 5";
			$result = mysqli_query($conn, $sql);
			$output = 
					'<div>
					<table class="table table-hover table-dark align-middle">
					<thead>
						<tr class="table-primary">
							<th>ORDER ID</th>
							<th>USER ID</th>
							<th>BOOK</th>
							<th>QUANTITY</th>
							<th>PRICE</th>
							<th>DATE OF PURCHASE</th>
							<th>PAY METHOD</th>
						</tr>
						</thead>
						<tbody>';
			while($row = mysqli_fetch_assoc($result)){
				$orderid = $row['order_id'];
				$orderid = str_replace($row['user_id'], "", $orderid);
				$output .= 
						'<tr>
							<th scope="row">'.$orderid.'</th>
							<td>'.$row['user_id'].'</td>
							<td class="admin-userphoto"><img src='.$row['img'].'></td>
							<td>'.$row['quantity'].'</td>
							<td>'.$row['price'].'</td>
							<td>'.$row['date_of_purchase'].'</td>
							<td>'.$row['payment_method'].'</td>
						</tr>';
			}
			$output .= 
					'</tbody>
					</table>
				</div>';
		}
		else{
			$output =
				'<div class="alert alert-danger">No Order Has Been Placed Yet</div>';
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
      			<input class="form-control me-2" id="admin-search-user"type="search" placeholder="@orderid" aria-label="Search" name="order_id">
      			<button class="btn btn-outline-success" type="submit" name="orderid">Search</button>&nbsp
      			<button class="btn btn-outline-success" type="submit" name="allorders" id="viewall">View</button>
    		</form>
    		<h4 class="text-success"><?= $totalorder ?></h4>
    		<div id="l-data">
    			<?= $output ?>
    		</div>
    		<div id="xd">
	    		<div id="loading"></div>
				<div id="order-info" class="text-info"></div>
			    <form method="post">
			   		<button type="button" name="load-more" id="load-more" class="btn btn-primary load-more">Load Data</button> 
			    	<input type="hidden" name="" id="total-orders" value="<?= $to ?>">
				</form>
    		</div>
			</div>
		</div>
	</div>
</div>
<?php
	require_once 'footer.php';
?>