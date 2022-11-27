<!DOCTYPE html>
<html>

<head>
    <title>إقرأ</title>
    <!-- Meta tags -->
    <meta charset="utf-8">
    <meta name="title" content="bookstore">
    <meta name="description" content="an eCommerce website to sell and deliver books to the customers ">
    <meta name="keywords" content="books, bookstore, reading, writing, history books, romance books, children books, scientific books, novels">
    <meta name="robots" content="index, follow">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="language" content="English">
    <meta name="google-site-verification" content="8Dvx9oad3ajJKZBShY2SaSmWCqXirX_g9sUvLakiIh8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat|Ubuntu" rel="stylesheet">

    <!-- CSS Stylesheets -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="./styles/styles.css">

    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/fe6a0ddb27.js" crossorigin="anonymous"></script>
    <!-- Bootstrap Scripts -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
    <!-- sweetalert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.all.min.js"></script>  
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.min.css'></link>  
</head>

<body>
    <!-- Main Section -->
    <section class="colored-section" id="header">
        <div class="container-fluid">
            <!-- Nav Bar -->
            <div class="socials">
                <?php
                    if(session_status() ==  PHP_SESSION_NONE){
                        session_start();
                    }
                    // var_dump($_SESSION);
                    // var_dump($_SESSION);
                    if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == true && $_SESSION["UserType"] != "admin"){
                        echo '
                        <a class="nav-link pb-0 pt-1 pl-2 logoutbtn" href="./php/logout.php">ستجيل خروج</a>
                        <p style="padding-top:7px; color:black;" class = "pb-0 mb-0">مرحبا '.$_SESSION["name"].', </p>
                        ';
                    }
                    else{
                        echo '
                        <a class="login-signin" href="./login.php">تسجيل دخول</a>
                        <a class="login-signin mr-3" href="./signup.php">انشاء حساب</a>
                        ';
                    }
                ?>
            </div>
            <nav class="navbar navbar-expand-lg pb-4">

                <a class="navbar-brand" href="./index.php">إقرأ</a>

                <button class="navbar-toggler navbar-light" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarTogglerDemo02">

                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="#footer">تواصل</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="./categories.php">تصنيفات</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link nav-icons" href="./account.php"><img class="" src="./images/user.png"
                                    alt=""></a>
                            <a class="nav-text nav-link" href="./account.php">حسابي</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link nav-icons ml-2" href="./cart.php"><i class="fas fa-book fa-lg fa-flip" style="--fa-animation-duration: 7s;" ></i></a>
                            <a class="nav-text nav-link" href="./cart.php">كتبي</a>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
    </section>