<?php
include "header.php";
?>

<div class="jumbotron text-center bg-white" style="margin-bottom:0">
    <h1 class="display-4">Rejestracja</h1>
</div>


<div class="d-flex row align-items-center flex-column justify-content-center bg-white text-dark" id="header" >
<form action="includes/signUp_inc.php" method="POST">
    <?php

    if (isset($_GET['firstName'])) {
        $firstName = $_GET['firstName'];
        echo '<input class="form-control" type="text" name="firstName" placeholder="Imię..." value="' . $firstName . '"><br>';
    } else {
        //jesli nie bylo bledu
        echo '<input class="form-control" type="text" name="firstName" placeholder="Imię..."><br>';
    }
    if (isset($_GET['lastName'])) {
        $lastName = $_GET['lastName'];
        echo '<input type="text" class="form-control" name="lastName" placeholder="Nazwisko..." value="' . $lastName . '"><br>';
    } else {
        //jesli nie bylo bledu
        echo '<input type="text" class="form-control" name="lastName" placeholder="Nazwisko..."><br>';
    }
    ?>
    <input type="text" class="form-control" name="email" placeholder="Email...">
    <br>
    <?php
    if (isset($_GET['user_uid'])) {
        $user_uid = $_GET['user_uid'];
        echo '<input type="text"class="form-control" name="user_uid" placeholder="Pseudonim..." value="' . $user_uid . '"><br>';
    } else {
        //jesli nie bylo bledu
        echo '<input type="text" class="form-control" name="user_uid" placeholder="Pseudonim..."><br>';
    }
    ?>
    <input type="password" class="form-control" name="pwd" placeholder="Hasło...">
    <br>
    <button type="submit" class="btn btn-dark btn-lg btn-block button_bottom_space" name="submit">Zarejestruj</button>
</form>
</div>

<!-- skrypt do sprawdzenia errorow -->
<?php
//jesli w GET nic nie ma
if (!isset($_GET['signup'])) {
    exit();
} else {
    //zmienna w ktorej przechowany jest rodzaj bledu
    $signupCheck = $_GET['signup'];
    //sprawdzenie jaka byla wiadomosc zwrotna
    if ($signupCheck == "empty") {
        echo '<div class="row justify-content-center">
                <div class="col"></div>
                <div class="col alert alert-danger">
                <p>Uzupełnij wszystkie pola!</p>
                </div>
                <div class="col"></div>
               </div>';
        exit();
    } elseif ($signupCheck == "wrongchar") {
        echo '<div class="row justify-content-center">
                <div class="col"></div>
                <div class="col alert alert-danger">
                <p>Nieprawidłowe imię lub nazwisko!</p>
                </div>
                <div class="col"></div>
               </div>';
        exit();
    }elseif ($signupCheck == "invalidemail"){
        echo '<div class="row justify-content-center">
                <div class="col"></div>
                <div class="col alert alert-danger">
                <p>Nieprawodłowy adres email!</p>
                </div>
                <div class="col"></div>
               </div>';
        exit();
    }elseif ($signupCheck == "userexists"){
        echo '<div class="row justify-content-center">
                <div class="col"></div>
                <div class="col alert alert-danger">
                <p>Użytkownik o takim loginie lub emailu już istnieje !</p>
                </div>
                <div class="col"></div>
               </div>';
        exit();
    } elseif ($signupCheck == "success") {
        echo '<div class="row justify-content-center">
                <div class="col"></div>
                <div class="col alert alert-success">
                <p>Rejestracja przegbiegła pomyślnie!</p>
                </div>
                <div class="col"></div>
               </div>';
        exit();
    }
}
