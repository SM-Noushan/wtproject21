<?php
	require_once 'securedlogin.php';
	require_once '../config.php';
	if(isset($_POST['last_id'])){
		$last_id = $_POST['last_id'];
		$out = '';

		$sql = $sql = "SELECT * FROM orders ORDER BY date_of_purchase DESC LIMIT $last_id, 5";
		$result = mysqli_query($conn, $sql);
		$count = mysqli_num_rows($result);
		//$totalorder = "Total Orders: ".mysqli_num_rows($result);
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
			
			echo $output;
			
	}
?>