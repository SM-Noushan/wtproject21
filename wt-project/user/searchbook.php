<script>
    document.title = "Search";
</script>
<?php
    require_once 'header.php';
    $output="";
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

        <div class="col-sm-1"> </div>
        <div class="col-sm-9">
            <div id="status" class="tag text-center sticky-top"></div>
            <div class="tag"><h2>Search Result</h2></div>
            <div class="row" style="padding-bottom: 50px;">
                <?php
                if(isset($_POST['searchbook']) || isset($_POST['searchbybookname'])){
                    if(isset($_POST['searchbook'])){
                        $category = $_POST['searchbook'];
                        $sql = "SELECT * FROM bookdetails WHERE category='$category' ORDER BY bookname ASC ";
                    }
                    if(isset($_POST['searchbybookname'])){
                        $bookname = $_POST['bookname'];
                        $sql = "SELECT * FROM bookdetails WHERE bookname='$bookname' ";
                    }
                    $result = mysqli_query($conn, $sql);
                    if(mysqli_num_rows($result)>0){
                        while($row = mysqli_fetch_assoc($result)){
                            $img = str_replace("../","/wt-project/", $row['image']);   
                            $output .=
                                '<div class="col-sm-4" style="padding:5px 15px; text-align: center;">
                                    <img src="'.$img.'" width="80%" height="250px">
                                    <h3 style="font-size: medium;">'.$row['bookname'].'</h5>
                                    <h5 style="font-size: small;">By '.$row['author'].'</h5>
                                    <h5 style="font-size: larger;">BDT '.$row['price'].'</h5>
                                    <form name="form" method="post">
                                        <input type="hidden" name="bookid" id="bookid'.$row['id'].'" value="'.$row['id'].'">
                                        <input type="hidden" name="bookname" id="bookname'.$row['id'].'" value="'.$row['bookname'].'">
                                        <input type="hidden" name="image" id="image'.$row['id'].'" value="'.$row['image'].'">
                                        <input type="hidden" name="price" id="price'.$row['id'].'" value="'.$row['price'].'">';

                                        if(!isset($_SESSION['user_status'])){
                                            $output .=
                                                '<input type="submit" name="submit" value="Add To Cart" class="btn btn-primary login" style="width: 80%">';
                                        }
                                        else{
                                            $output .=
                                                '<button type="button" id="'.$row['id'].'" class="btn btn-primary xbtn" style="width: 80%">Add To Cart</button>';
                                        }
                            $output .=
                                '</form> 
                                </div>';                          
                        }
                    }
                    else{
                        $output .=
                                '<div class="container-fluid text-center">
                                <div class="alert alert-warning ">
                                    <strong>Result!</strong>&nbsp No Book Found
                                </div>
                            </div>';
                    }
                }
                else{
                    $output .=
                            '<div class="container-fluid text-center">
                                <div class="alert alert-danger ">
                                    <strong>WARNING!</strong>&nbsp SEARCH FOR A BOOK
                                </div>
                            </div>';
                }
                echo $output;
                ?>
            </div>                
        </div>
    </div>
</div>
</div>

<!-- The Modal: Login -->
<div class="modal" id="loginModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h3 class="modal-title">Login</h3>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <span id="help" class="text-danger"></span>
        <form id="loginForm" action="#.php" method="post" onsubmit="return checking()">
            <div class="form-floating mb-3">
                <input class="form-control" name="email" id="email" type="email" placeholder="email">
                <label for="email"><i class="fa fa-envelope"></i>&nbsp Username</label>
                <!--<span class="text-danger" id="errusername"><?= $errusername ?></span>-->
            </div>
            <div class="form-floating mb-3">
                <input class="form-control" name="pass" id="pass" type="password" placeholder="pass" minlength="8">
                <label for="pass"><i class="fa fa-key"></i>&nbsp Password</label>
                <!--<span class="text-danger" id="errpass"><?= $errpass ?></span>-->
            </div>
            <div class="d-grid gap-2">
                <button class="btn btn-secondary btn-lg" name="loginUser" id="loginButton" type="button">Login</button>
            </div>
        </form>
            <p>Dont't have an account yet?<a href="/wt-project/user/signup.php">Register now</a></p>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>

<?php
    require_once 'footer.php';
?>