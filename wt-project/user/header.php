<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>#</title>
        <!-- Latest compiled and minified CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" rel="stylesheet">

        <!-- Latest compiled JavaScript -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js"></script>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        
        <!-- Font Awesome CSS JavaScript -->
        <script src="https://kit.fontawesome.com/1027beb3ad.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

        <!-- my CSS -->
        <link rel="stylesheet" href="/wt-project/user/css/header.css"></link>
        
</head>
<body>
    <div class="container">
        <div class="contact-info"> 
            <i class="far fa-address-card"></i>&nbsp Contact Us<br>
            <i class="fas fa-phone-square"></i>&nbsp+880 1XX-XXXXX<br>
            <i class="fas fa-at"></i>&nbspmyBookShop@bshop.com.bd
        </div>
        <nav class="navbar navbar-expand-lg navbar-light sticky-top">
            <a class="navbar-brand" href="/wt-project/index.php"><img id="imglogo" src="/wt-project/resourses/logo.png"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <form class="d-flex" style="padding-left: 160px;" action="/wt-project/user/searchbook.php" method="post">
                    <input class="form-control me-2" type="search" placeholder="Search" name="bookname" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit" name="searchbybookname"><i class="fas fa-search" style="font-size:1.4rem;" ></i></button>
                </form>
                <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="/wt-project/index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/wt-project/user/books.php">Books</a>
                </li>
                    <?php
                        if(session_status() != 2)
                        session_start();
                        if(isset($_SESSION['user_status'])){
                            ?>
                            <li class="nav-item">
                                <a class="nav-link" href="/wt-project/user/mycart.php">MyCart
                                    <i class="fab fa-shopify fa-1x" style="font-size:1.3rem;"></i>
                                    <span class="position-absolute   translate-middle badge rounded-pill bg-danger" style="font-size:0.5rem;" id="livecart">0</span>
                                </a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Hello, <?= $_SESSION['username'] ?>
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                    <li><a class="dropdown-item" href="/wt-project/user/profile.php"><i class="fas fa-user-circle"></i>&nbsp My Account</a></li>
                                    <li><a class="dropdown-item" href="/wt-project/user/signout.php"><i class="fas fa-sign-out-alt"></i>&nbsp Signout</a></li>
                                </ul>
                            </li>
                            <?php
                        }
                        else{
                            ?>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Hello, Guest
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                    <li><a class="dropdown-item" href="/wt-project/user/login.php"><i class="fas fa-sign-in-alt"></i>&nbsp Login</a></li>
                                    <li><a class="dropdown-item" href="/wt-project/user/signup.php"><i class="fas fa-file-signature"></i>&nbsp Register</a></li>
                                </ul>
                            </li>
                        <?php
                        }
                    ?>
                </ul>
            </div>
        </nav>
    </div>