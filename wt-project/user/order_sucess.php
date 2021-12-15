<script>
    document.title = "Order Status";
</script>

<?php
    require_once 'header.php';
    require_once 'scurechecking.php';
    require_once '../config.php';
?>
<div class="container">
    <div class="row">
        <div class="col-sm-2">
            <table class="table table-borderless table-hover" style="text-align: center;">
                <thead>
                    <tr style="background-color: crimson;">
                        <th scope="row" style="color: white;">Categories</th>
                        </tr>
                </thead>
                <tbody>
                    <?php
                    $conn = mysqli_connect('localhost', 'root','','mybookshop');
                    $sql = "SELECT categories FROM categories";
                    $result = mysqli_query($conn, $sql);
                    if(mysqli_num_rows($result)>0){
                        ?>
                        <?php
                        while($row = mysqli_fetch_assoc($result)){
                            ?>
                            <tr style="background-color: dimgray;">
                                <td>
                                    <div class="d-grid gap-2" style="height: 35px;">
                                        <form action="searchbook.php" method="post">
                                        <button class="btn" name="searchbook" type="submit" value="<?= $row['categories'] ?>" style="color: white;"><?= $row['categories'] ?>
                                        </button>
                                    </form>
                                    </div>
                                </td>
                            </tr>
                            <?php
                        }
                    }
                    ?>
                </tbody>
            </table>    
        </div>

        <?php
            if(!isset($_SESSION['orser_id'])){
                 echo "<script> window.location.href = 'profile.php'; </script>";
            }
                $username = $_SESSION['username'];
                $id = $_SESSION['address_id'];
                $name=$address=$phone=$output=$order_id=$dop=$status=$mop="" ;
                $total_amount=0;
                $sql = "SELECT * FROM address WHERE username = '$username' AND id = '$id' "; 
                $result = mysqli_query($conn, $sql);
                while ($row = mysqli_fetch_array($result)) {
                    $name = $row['name'];
                    $address = $row['address'];
                    $phone = $row['phone'];
                }
                $value = $_SESSION['orser_id'][0];
                //foreach ($_SESSION['orser_id'] as $key => $value) {
                    $sql = "SELECT * FROM orders WHERE user_id='$username' AND order_id='$value'";
                    $result = mysqli_query($conn, $sql);
                    while($row = mysqli_fetch_array($result)){
                        $order_id = $row['order_id'];
                        $output .=
                                '<tr>
                                    <td>'.$row['book_name'].'</td>
                                    <td>&#2547 '.$row['price'].'</td>
                                    <td>'.$row['quantity'].'</td>
                                    <td>&#2547 '.$row['total_price'].'</td>
                                </tr>';
                                $total_amount += (int)$row['total_price'];
                                $dop = $row['date_of_purchase'];
                                $status = $row['status'];
                                $mop = $row['payment_method']; 
                    }
                $order_id = str_replace($username,"",$order_id);
                unset($_SESSION['orser_id']);

                ?>
        <div class="col-sm-1"></div>
        <div class="col-sm-8">
            <div class="row">
                <h6 class="text-success"><strong>Thank you <strong><?= $name ?></strong> for shopping with us</strong></h6>
                <h6 class="text-success">Your order has been successfully placed. Your order details are as follows:</h6>
                <table class="table table-striped table-borderless text-dark">
                  <tbody class="">
                    <tr>
                      <td>DELIVERY ADDRESS</td>
                      <td><?= $address ?></td>
                    </tr>
                    <tr>
                      <td>CONTACT NO</td>
                      <td><?= $phone ?></td>
                    </tr>
                    <tr>
                      <td>DATE OF PURCHASE</td>
                      <td><?= $dop ?></td>
                    </tr>
                    <tr>
                      <td>STATUS</td>
                      <td><?= $status ?></td>
                    </tr>
                    <tr>
                      <td>PAYMENT METHOD</td>
                      <td><?= $mop ?></td>
                    </tr>
                  </tbody>
                </table>
                <div class="col-sm-8"></div>
                <br>
                <h6 class="text-dark bg-light m-0 py-3">ORDER ID: <?= $order_id ?></strong></strong></h6>
                <table class="table table-striped table-borderless table-dark">
                  <tbody class="">
                    <tr>
                      <td>BOOK NAME</td>
                      <td>PRICE</td>
                      <td>QUANTITY</td>
                      <td>TOTAL</td>
                    </tr>
                    <?= $output ?>
                  </tbody>
                  <tfoot>
                      <tr class="table-secondary">
                          <td colspan="3">Total Amount</td>
                          <td>&#2547 <?= $total_amount ?></td>
                      </tr>
                  </tfoot>
                <span class="badge bg-secondary">KEEP THIS ORDER ID SAVED FOR FUTURE REFERENCES</span>
                </table>
            </div>    
        </div>
        <div class="col-sm-1"></div>
    </div>
</div>
<?php
    require_once 'footer.php';
?>