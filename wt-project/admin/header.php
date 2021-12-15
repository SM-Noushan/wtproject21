<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
        <!-- Latest compiled and minified CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" rel="stylesheet">

        <!-- Latest compiled JavaScript -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js"></script>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        
        <!-- Font Awesome JavaScript -->
        <script src="https://kit.fontawesome.com/1027beb3ad.js"></script>

        <!-- my CSS -->
        <link rel="stylesheet" href="css/header.css"></link>
</head>
<body>
    <div class="container">
        <div class="contact-info"> 
            <i class="far fa-address-card">&nbsp Contact Us</i><br>
            <i class="fas fa-phone-square">&nbsp+880 1XX-XXXXX</i><br>
            <i class="fas fa-at">&nbspmyBookShop@bshop.com.bd</i>
        </div>
        <nav class="navbar navbar-expand-lg navbar-light sticky-top">
            <a class="navbar-brand" href="../index.php"><img id="imglogo" src="../resourses/logo.png"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav ms-auto">
                <?php
                if(session_status() != 2)
                    session_start();
                    if(!isset($_SESSION['admin_status'])){
                    ?>
                        <li class="nav-item">
                        <a class="nav-link" href="login.php">Login</a>
                        </li>
                    <?php
                    } 
                    else{
                    ?>
                        <li class="nav-item">
                            <a class="nav-link" href="dashboard.php">Dashboard</a>
                        </li>
                        <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Hello, Admin
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <li><a class="dropdown-item" href="changepassword.php">Password</a></li>
                            <li><a class="dropdown-item" href="signout.php">Signout</a></li>
                        </ul>
                        </li>
                    <?php
                    }
                ?>
            </ul>
            </div>
        </nav>
    </div>