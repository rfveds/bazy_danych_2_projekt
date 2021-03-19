<?php
include "header.php";
?>
    <div class="jumbotron text-center bg-white" style="margin-bottom:0">
        <h1 class="display-4">Logowanie</h1>
    </div>
    <div class="d-flex row align-items-center flex-column justify-content-center bg-white text-dark" id="header">
        <form action="includes/logIn_inc.php" method="POST">
            <div class="form-group">
                <input class="form-control form-control-lg" type="text" name="username" placeholder="Login...">
            </div>
            <div class="form-group">
                <input class="form-control form-control-lg" type="password" name="pwd" placeholder="Hasło...">
            </div>
            <div class="form-group">
                <button class="btn btn-dark btn-lg btn-block" type="submit" name="submit">Zaloguj</button>
            </div>
        </form>
        <?php
        //sprawdzenie komunikatu z GET
        if (!isset($_GET['login'])) {
            exit();
        } else {

            $logInCheck = $_GET['login'];
            //sprawdzenie jaka byla wiadomosc zwrotna
            if ($logInCheck == "empty") {
                echo '<div class="row justify-content-center">
                                <div class="col"></div>
                                <div class="col alert alert-danger">
                                <p>Uzupełnij wszystkie pola!</p>
                                </div>
                                <div class="col"></div>
                             </div>';
            } elseif ($logInCheck == "wronglogin") {
                echo '<div class="row justify-content-center">
                                <div class="col"></div>
                                <div class="col alert alert-danger">
                                <p>Zły login!</p>
                                </div>
                                <div class="col"></div>
                             </div>';
                exit();
            } elseif ($logInCheck == "wrongpwd") {
                echo '<div class="row justify-content-center">
                                <div class="col"></div>
                                <div class="col alert alert-danger">
                                <p>Złe hasło!</p>
                                </div>
                                <div class="col"></div>
                             </div>';
                exit();
            }
        }

        ?>
    </div>
