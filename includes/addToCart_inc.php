
<?php
include "../autoryzacja.php";
include "functions_inc.php";
session_start();
$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname)
or die('Bład połączenia z serwerem: ' . mysqli_connect_error());
mysqli_query($conn, 'SET NAMES utf8');
//echo "Połączenie udane <br>";

$active_user = $_SESSION['userid'];
$artwork_id = $_POST['artwork_id'];


if (isset($_POST['artwork'])) {
        addToCart($conn, $active_user, $artwork_id);
        header("Location: ../index.php");
        exit();
}