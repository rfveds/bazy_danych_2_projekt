<?php
if(isset($_POST['submit'])) {

    include "../autoryzacja.php";
    include "functions_inc.php";

    $conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname)
    or die('Bład połączenia z serwerem: ' . mysqli_connect_error());
    mysqli_query($conn, 'SET NAMES utf8');

    //echo "Połączenie udane <br>";


    $username = $_POST['username'];
    $pwd = $_POST['pwd'];

    if (emptyInputLogin($username, $pwd) !== false) {
        header("Location: ../logIn.php?login=empty");
        exit();
    }

    logInUser($conn, $username, $pwd);

}else{
    header("Location: ../logIn.php");
    exit();
}