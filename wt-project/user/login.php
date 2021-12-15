<script>
    document.title = "Login";
</script>
<?php
    require_once 'header.php'; 
    //require_once 'securechecking.php';
    require_once '../config.php';
    
    $username=$password="";
    $errusername=$errpass=$err="";
    if(isset($_POST['login-user'])){
        if(empty($_POST['email'])){
            $errusername = "Enter Name";
        }
        else{
            $username = mySqli_real_escape_string($conn, $_POST['email']); //escapes special character
        }
        if(empty($_POST['pass'])){
            $errpass = "Enter Password";
        }
        else{
            $password = mySqli_real_escape_string($conn, $_POST['pass']); ////escapes special character
            $password = MD5($password);
        }
        if(empty($errusername) && empty($errpass)){
            $sql = "SELECT * FROM registeredusers where username='$username' ";
            $result = mysqli_query($conn, $sql);
            if(mysqli_num_rows($result)>0){
                while($row = mysqli_fetch_array($result)){
                    if($password == $row['password']){
                        $_SESSION['user_status'] = true;
                        $_SESSION['username'] = $username;
                        header('location: ../index.php');
                    }
                    else{
                        $errpass = "Invalid username or password";
                    }
                }
            }
            else{
                $errusername = "Invalid username or password";
            }
        }
    }
?>

    <div class="container">
        <div class="row">
            <div class="col-sm-4">  </div>
            <div class="col-sm-4"> 
                <h2>Login</h2>
                <br>
                <form id="loginForm" action="#.php" method="post" onsubmit="return checking()">
                <div class="form-floating mb-3">
                    <input class="form-control" name="email" id="email" type="email" placeholder="email">
                    <label for="email"><i class="fa fa-envelope"></i>&nbsp Username</label>
                    <span class="text-danger" id="errusername"><?= $errusername ?></span>
                </div>
                <div class="form-floating mb-3">
                    <input class="form-control" name="pass" id="pass" type="password" placeholder="pass" minlength="8">
                    <label for="pass"><i class="fa fa-key"></i>&nbsp Password</label>
                    <span class="text-danger" id="errpass"><?= $errpass ?></span>
                </div>
                <div class="d-grid gap-2">
                    <button class="btn btn-dark btn-lg" name="login-user" id="submitButton" type="submit">Login</button>
                </div>
                </form>
            </div>
            <div class="col-sm-4">  </div>
        </div>
        <div class="row"> </div>
    </div>
<br><br><br><br><br><br><br><br><br><br><br>

<?php
    require_once 'footer.php';
?>