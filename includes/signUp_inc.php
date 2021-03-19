<?php

//sprawdzenie czy uzytkownik kliknal zarejestruj
if (isset($_POST['submit'])) {

    include "../autoryzacja.php";
    include "functions_inc.php";

    $conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname)
    or die('Bład połączenia z serwerem: ' . mysqli_connect_error());
    mysqli_query($conn, 'SET NAMES utf8');

    //zebranie danych
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $email = $_POST['email'];
    $user_uid = $_POST['user_uid'];
    $pwd = $_POST['pwd'];

    if (emptyInputSignup($firstName, $lastName, $email, $user_uid, $pwd) !== false) {
        //powrot do strony glownej z zapisanym rodzajem bledu
        header("Location: ../addusers.php?signup=empty");
        //zakonczenie skryptu
        exit();
    }
    if (wrongChar($firstName) !== false) {
        header("Location: ../addUsers.php?signup=wrongchar");
        exit();
    }if (wrongChar($lastName) !== false) {
        header("Location: ../addUsers.php?signup=wrongchar");
        exit();
    }
    if (invalidEmail($email)) {
        //powrot do strony glownej z zapisanym rodzajem bledu i dobrze wpisanymi danymi
        header("Location: ../addUsers.php?signup=invalidemail&firstName=$firstName&lastName=$lastName&user_uid=$user_uid");
        exit();
    }

    if (uidExists($conn, $user_uid, $email)) {
        header("Location: ../addusers.php?signup=userexists");
        exit();
    }
    //jesli nie bylo zadnego bledu dodaje uzytkownika do bazy
    createUser($conn, $firstName, $lastName, $email, $user_uid, $pwd);
    header("Location: ../addUsers.php?signup=success");
    exit();

} else {
    //zeby nie dalo sie wejsc do pliku wpisujac adres url
    header("Location: ../addUsers.php");
    exit();
}