<?php
include "autoryzacja.php";
session_start();
?>
<!DOCTYPE html>
<html lang="pl-PL" class="h-100">
<head>
    <title>Karol Kijowski</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.8.2/css/lightbox.min.css">
    <link rel="stylesheet" href="style.css">
</head>


<body class="h-100">
<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
    <a class="navbar-brand"  href="index.php">Start</a>
    <div class="collapse navbar-collapse" id="collapsibleNavbar">
        <ul class="navbar-nav">
            <?php
            //jesli uzytkownik jest zalogowany pojawiaja sie inne opcje w menu
            if(isset($_SESSION['userid'])){
                echo "<li class='nav-item'>
                        <a class='nav-link' href='profile.php'>Profil</a>
                       </li>";
                echo "<li class='nav-item'>
                       <a class='nav-link' href='cart.php'>Koszyk</a>
                      </li>";
                echo "<li class='nav-item'>
                       <a class='nav-link' href='includes/logOut_inc.php'>Wyloguj</a>
                      </li>";
            }else{
                echo " <li class='nav-item'>
                        <a class='nav-link' href='logIn.php''>Logowanie</a>
                       </li>";
                echo "<li class='nav-item'>
                       <a class='nav-link' href='addUsers.php'>Rejestracja</a>
                      </li>";
            }
            ?>

        </ul>
    </div>
</nav>