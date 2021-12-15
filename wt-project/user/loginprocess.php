<?php
    require_once '../config.php';
    
    $username=$_POST['username'];
    $password=$_POST['password'];
    $errusername=$errpass=$err="";
    if(isset($username) && isset($password)){
        $sql = "SELECT * FROM registeredusers where username='$username' ";
        $result = mysqli_query($conn, $sql);
        if(mysqli_num_rows($result)>0){
            while($row = mysqli_fetch_array($result)){
                if(MD5($password) == $row['password']){
                    session_start();
                    $_SESSION['user_status'] = true;
                    $_SESSION['username'] = $username;
                    echo 1;
                }
                else{
                    echo 0;
                }
            }
        }
        else{
            echo 0;
        }
    }
?>