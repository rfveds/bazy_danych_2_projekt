<?php
include "../autoryzacja.php";
include "functions_inc.php";
session_start();

$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname)
or die('Bład połączenia z serwerem: ' . mysqli_connect_error());
mysqli_query($conn, 'SET NAMES utf8');

//echo "Połączenie udane <br>";

//zmienna hidden przekazana przez post
$cartItem_id = $_POST['cartItem_id'];

//jesli w post jest zmienna
if (isset($_POST['delete'])) {
    deleteItem($conn, $cartItem_id);
    header("Location: ../cart.php");
    exit();
}else{
    //zeby nie dalo sie wejsc do pliku przez adres url
    header("Location: ../cart.php");
    exit();
}