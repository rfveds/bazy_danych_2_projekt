<?php

include "../autoryzacja.php";
include "functions_inc.php";
session_start();

$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname)
or die('Bład połączenia z serwerem: ' . mysqli_connect_error());
mysqli_query($conn, 'SET NAMES utf8');

//echo "Połączenie udane <br>";

//wyciagniecie id aktywnego uzytkownika
$active_user = $_SESSION['userid'];
$user_id = getUser_id($conn, $active_user);

$firstName = $_POST['firstName'];
$lastName = $_POST['lastName'];
$email = $_POST['email'];
$user_uid = $_POST['user_uid'];
$pwd = $_POST['pwd'];

if (isset($_POST['editFirstName'])) {
    if(emptyInput($firstName)){
        header("Location: ../editInfoUser.php?edit=empty");
        exit();
    }
    if (wrongChar($firstName) !== false) {
        header("Location: ../editInfoUser.php?edit=wrongchar");
        exit();
    }
    editFirstName($conn, $user_id, $firstName);
    header("Location: ../editInfoUser.php?edit=success");
    exit();
}elseif(isset($_POST['editLastName'])){
    if(emptyInput($lastName)){
        header("Location: ../editInfoUser.php?edit=empty");
        exit();
    }
    if (wrongChar($lastName) !== false) {
        header("Location: ../editInfoUser.php?edit=wrongchar");
        exit();
    }
    editLastName($conn, $user_id, $lastName);
    header("Location: ../editInfoUser.php?edit=success");
    exit();
}elseif(isset($_POST['editUserUid'])){
    if(emptyInput($user_uid)){
        header("Location: ../editInfoUser.php?edit=empty");
        exit();
    }
    if(uidEditExists($conn, $user_uid)){
        header("Location: ../editInfoUser.php?edit=taken");
        exit();
    }
    editUserUid($conn, $user_id, $user_uid);
    header("Location: logOut_inc.php");
    exit();
}elseif(isset($_POST['editEmail'])){
    if(emptyInput($email)){
        header("Location: ../editInfoUser.php?edit=empty");
        exit();
    }
    if(invalidEmail($email)){
        header("Location: ../editInfoUser.php?edit=invalidemail");
        exit();
    }
    editEmail($conn, $user_id, $email);
    header("Location: ../editInfoUser.php?edit=success");
    exit();
}elseif(isset($_POST['editPwd'])){
    if(emptyInput($pwd)){
        header("Location: ../editInfoUser.php?edit=empty");
        exit();
    }
    editUserPwd($conn, $user_id, $pwd);
    header("Location: ../editInfoUser.php?edit=success");
    exit();
}elseif(isset($_POST['deleteUser'])){
    deleteUser($conn, $active_user);
    exit();
}else{
    header("Location: ../editInfoUser.php");
    exit();
}
