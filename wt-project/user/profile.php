<script>
    document.title = "Profile";
</script>
<?php
    require_once 'header.php';
    require_once 'scurechecking.php';
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
            $name=$phone=$address=$image="";
            $email = $_SESSION['username'];
            $sql = "SELECT * FROM registeredusers WHERE username ='$email' ";
            $result = mysqli_query($conn, $sql);
            while($row = mysqli_fetch_assoc($result)){
                $name  = $row['name'];
                $phone = $row['mobile'];
                $image = $row['image'];
            }
            $sql = "SELECT address FROM address WHERE username ='$email' ORDER BY id DESC LIMIT 1 ";
            $result = mysqli_query($conn, $sql);
            if(mysqli_num_rows($result)>0){
                while($row = mysqli_fetch_assoc($result)){
                $address = $row['address'];
                }
            }
            else{
                $address = " ";
            }
            
        ?>
        <div class="col-lg-10">
              <div class="container py-0">
                <div class="row">
                  <div class="col-lg-4">
                    <div class="card mb-4">
                      <div class="card-body text-center">
                        <img src="<?= $image ?>" alt="avatar" class="rounded-circle img-fluid" style="width: 150px;">
                        <h5 class="my-3"><?= $name ?></h5>
                        <div class="d-flex justify-content-center mb-2">
                          <button type="button" class="btn btn-primary">Profile</button>
                          <button type="button" class="btn btn-outline-primary ms-1">Edit</button>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-8">
                    <div class="card mb-4">
                      <div class="card-body">
                        <div class="row">
                          <div class="col-sm-3">
                            <p class="mb-0">Full Name</p>
                          </div>
                          <div class="col-sm-9">
                            <p class="text-muted mb-0"><?= $name ?></p>
                          </div>
                        </div>
                        <hr>
                        <div class="row">
                          <div class="col-sm-3">
                            <p class="mb-0">Email</p>
                          </div>
                          <div class="col-sm-9">
                            <p class="text-muted mb-0"><?= $email ?></p>
                          </div>
                        </div>
                        <hr>
                        <div class="row">
                          <div class="col-sm-3">
                            <p class="mb-0">Address</p>
                          </div>
                          <div class="col-sm-9">
                            <p class="text-muted mb-0"><?= $address ?></p>
                          </div>
                        </div>
                        <hr>
                        <div class="row">
                          <div class="col-sm-3">
                            <p class="mb-0">Mobile</p>
                          </div>
                          <div class="col-sm-9">
                            <p class="text-muted mb-0"><?= $phone ?></p>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-sm-12">
                        <div class="card mb-4 mb-md-0">
                          <div class="card-body">
                            <div class="card-group">
                              <div class="card">
                                <div class="card-header">Last Order</div>
                                <?php
                                    $sql = "SELECT * FROM orders WHERE user_id ='$email' ORDER BY date_of_purchase DESC" ;
                                    $result = mysqli_query($conn, $sql);
                                    if(mysqli_num_rows($result)>0){
                                        $row = mysqli_fetch_assoc($result);
                                        $orderid = $row['order_id'];
                                        $orderid = str_replace($email,"",$orderid);
                                        $dop = $row['date_of_purchase'];
                                        $amount = 0;
                                        $sql = "SELECT * FROM orders WHERE user_id ='$email' AND date_of_purchase='$dop' ";
                                        $result = mysqli_query($conn, $sql);
                                        ?>
                                    <div class="card-body text-dark">
                                        <h5 class="card-title">Order ID: <?= $orderid ?></h5>
                                        <div class="col-sm-6md-4 order-md-2 mb-4"> <br>
                                            <ul class="list-group mb-3">
                                        <?php
                                        while($row = mysqli_fetch_assoc($result)){
                                            $book_name = $row['book_name'];
                                            $quantity = $row['quantity'];
                                            $price = $row['price'];
                                            $amount += (int)$row['total_price'];
                                            ?>
                                                <li class="list-group-item d-flex justify-content-between lh-condensed">
                                                  <div>
                                                    <h6 class="my-0"><?= $book_name ?></h6>
                                                    <small class="text-muted">Quantity:&nbsp<?= $quantity ?></small>
                                                  </div>
                                                  <span class="text-muted">&#2547 <?= $price ?></span>
                                                </li>
                                            <?php
                                        }
                                        ?>
                                            </ul>
                                      </div>
                                    </div>
                                    <div class="card-footer bg-transparent border-success">
                                        <span>Total (BDT)</span>
                                        <strong style="float:right;">&#2547 <?= $amount ?></strong>
                                    </div>
                                        <?php
                                    }
                                    else{
                                        ?>
                                        <div class="alert alert-warning">
                                            <div class="text-warning">No Purchase Yet</div>
                                        </div>
                                        <?php
                                    }
                                ?>

                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
        </div>
    </div>
</div>

<?php
    require_once 'footer.php';
?>