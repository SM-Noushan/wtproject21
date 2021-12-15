<script>
    document.title = "MyCart";
</script>
<?php
    require_once 'header.php';
    require_once 'scurechecking.php';
    require_once '../config.php';
    $username = $_SESSION['username'];
    $status="";

    if(isset($_POST['remove'])){
        $book_id = $_POST['book_id'];
        $sql = "SELECT * FROM cart WHERE user_id = '$username' AND book_id='$book_id' ";
        $result = mysqli_query($conn, $sql);
        if($result){
            $sql = "DELETE FROM cart WHERE user_id = '$username' AND book_id='$book_id' ";
            $result = mysqli_query($conn, $sql);
            $status =
                    '<div class="alert alert-success" id="cartmsg">Item removed successfully</div>';
                    
        }
        else{
            $status =
                    '<div class="alert alert-danger" id="cartmsg">Failed to remove. Try again</div>';
        }
    }

    if(isset($_POST['update'])){
        $book_id = $_POST['book_id'];
        $quantity = $_POST['quantity'];
        $total_price = (int)$_POST['price']*(int)$quantity;
        $sql = "UPDATE cart SET quantity='$quantity', total_price='$total_price' WHERE user_id = '$username' AND book_id='$book_id' ";
        $result = mysqli_query($conn, $sql);
        if($result){
            $status =
                    '<div class="alert alert-success" id="cartmsg">Item updated successfully</div>';
                    
        }
        else{
            $status =
                    '<div class="alert alert-danger" id="cartmsg">Failed to update. Try again</div>';
        }
    }
?>

<div class="container">
    <div class="row">
        <div class="col-sm-3"></div>
        <div class="col-sm-8">
            <span><?= $status ?></span>
            <h2 class="text-dark">My Shopping Cart</h2>
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
                            $_SESSION['cart_status'] = "okay";
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
                                                <br>
                                                <form method="post">
                                                    <input type="hidden" name="book_id" value="<?= $row['book_id'] ?>" >
                                                    <button type="submit" class="btn btn-danger btn-sm" name="remove">Remove</button>
                                                </form>
                                            </figcaption>
                                        </figure>
                                    </td>
                                    <td>&#2547 <?= $row['price'] ?></td>
                                    <td>
                                        <form method="post">
                                            <div class="form-floating">
                                                <span class="badge bg-dark"><?= $row['quantity'] ?></span>                                              
                                                <select class="form-select-sm" name="quantity">
                                                    <option value="1">1</option>
                                                    <option value="2">2</option>
                                                    <option value="3">3</option>
                                                    <option value="4">4</option>
                                                    <option value="5">5</option>
                                                </select>
                                                <br>
                                                    <input type="hidden" name="book_id" value="<?= $row['book_id'] ?>" >
                                                    <input type="hidden" name="price" value="<?= $row['price'] ?>" >
                                                    <button type="submit" class="btn btn-sm btn-primary" name="update">Update</button>
                                            </div>
                                        </form>
                                    </td>
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
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <a href="checkout.php"><button type="submit" class="btn btn-success me-md-2"><i class="fa fa-shopping-cart" aria-hidden="true"></i>&nbsp Checkout</button></a>
                    </div>
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
    </div>
</div>


<?php
    require_once 'footer.php';
?>