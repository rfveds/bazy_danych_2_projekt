<?php
//funkcja sprawdzajaca czy pola nie sa puste
function emptyInputSignup($firstName, $lastName, $email, $user_id, $pwd)
{
    if (empty($firstName) || empty($lastName) || empty($email) || empty($user_id) || empty($pwd)) {
        //jesli ktoras zmienna jest pusta
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}

//funkcja sprawdzajaca poprawnosc znakow
function wrongChar($names){
    if (!preg_match("/^[a-żA-ż]*$/", $names) ) {
        //jesli nie pasuje do wzorca
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}

//funkcja sprawdzajaca email
function invalidEmail($email){
    //wbudowana funkcja do sprawdzania poprawnosci emaila
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}
//funkcja sprawdzajaca czy dany uzytkownik jest juz w bazie danych
function uidExists($conn, $user_uid, $email){
    $sql = "SELECT * FROM users WHERE user_uid ='$user_uid' OR user_email='$email'";
    $result = mysqli_query($conn, $sql);
    if(mysqli_num_rows($result)>0){
        return true;
    }else {
        return false;
    }
}
function uidEditExists($conn, $user_uid){
    $sql = "SELECT * FROM users WHERE user_uid ='$user_uid' ";
    $result = mysqli_query($conn, $sql);
    if(mysqli_num_rows($result)>0){
        return true;
    }else {
        return false;
    }
}
//funkcja dodajaca uzytkownika
function createUser($conn, $firstName, $lastName, $email, $user_uid, $pwd){
    $sql = "INSERT INTO users (user_firstName, user_lastName, user_email,user_uid, user_pwd)
		VALUES ('$firstName', '$lastName', '$email', '$user_uid', '$pwd');";
    mysqli_query($conn, $sql);
    //stworzenie koszyka przypisanego do nowo dodanego uzytkownika
    //wydobycie id nowgo uzytkownika
    $sql1 = "SELECT user_id FROM users WHERE users.user_uid = '$user_uid'";
    $result = mysqli_query($conn, $sql1);
    $row=mysqli_fetch_assoc($result);
    $user_id = $row['user_id'];
    //przypisanie koszyka
    $sql2 = "INSERT INTO cart(user_cart)
             VALUES ('$user_id')";
    mysqli_query($conn,$sql2);
}

function emptyInputLogin($user_id, $pwd){
    if (empty($user_id) || empty($pwd)) {
        //jesli zmienna jest pusta
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}
function logInUser($conn, $username, $pwd){
    //zwraca true jesli istnieje
    $uidExists = uidExists($conn, $username, $username);
    if($uidExists === false){
        header("Location: ../logIn.php?login=wronglogin");
        exit();
    }
    //sprawdzenie hasla
    $sql = "SELECT user_pwd FROM users WHERE user_uid ='$username' OR user_email='$username'";
    $result = mysqli_query($conn, $sql);
    $arr=mysqli_fetch_array($result);
    $user_pwd = $arr['user_pwd'];
    //zle haslo
    if($pwd !== $user_pwd){
        header("Location: ../logIn.php?login=wrongpwd");
        exit();
    }else {
        //uzytkownik jest zalogowany
        session_start();
        $_SESSION['userid'] = $username;
        header("Location: ../index.php");
        exit();
    }
}
//zbiera dane o uzytkowniku z bazy
function userInfo($conn, $active_user){
    $sql = "SELECT user_id, user_firstName, user_lastName, user_email, user_uid, user_pwd 
        FROM users 
        WHERE user_uid='$active_user';";
    $result = mysqli_query($conn, $sql);
    return $result;
}

function getUser_id($conn, $active_user){
    $sql = "SELECT user_id
        FROM users 
        WHERE user_uid = '".$active_user."'";
    $result = mysqli_query($conn, $sql);
    $arr=mysqli_fetch_array($result);
    $active_user_id = $arr['user_id'];
    return $active_user_id;
}

function emptyInput($input){
    if(empty($input)){
        return true;
    }else{
        return false;
    }
}


function editUserPwd($conn, $user_id, $pwd){
    $sql = "UPDATE users SET
        user_pwd = '".$pwd."'
        WHERE user_id = '".$user_id."'";
    mysqli_query($conn, $sql);
}
function editUserUid($conn, $user_id, $user_uid){
    $sql = "UPDATE users SET
        user_uid = '".$user_uid."'
        WHERE user_id = '".$user_id."'";
    mysqli_query($conn, $sql);
}
function editEmail($conn, $user_id, $email){
    $sql = "UPDATE users SET
        user_email = '".$email."'
        WHERE user_id = '".$user_id."'";
    mysqli_query($conn, $sql);
}
function editFirstName($conn, $user_id, $firstName){
    $sql = "UPDATE users SET
        user_firstName = '".$firstName."'
        WHERE user_id = '".$user_id."'";
    mysqli_query($conn, $sql);
}

function editLastName($conn, $user_id, $lastName){
    $sql = "UPDATE users SET
        user_lastName = '".$lastName."'
        WHERE user_id = '".$user_id."'";
    mysqli_query($conn, $sql);
}
function deleteUser($conn, $active_user){
    //trzeba robic po kolei zeby nie wyskakiwały bledy z obcymi kluczami
    //id uzytkownika
    $user_id = getUser_id($conn, $active_user);
    //usuwanie elementow koszyka koszyka uzytkownika
    //id elementow koszyka uzytkownika
    $cartId = getCartId($conn, $active_user);
    $sql3 = "DELETE FROM cartItem WHERE cartItem_cart = $cartId";
    mysqli_query($conn, $sql3);
    //usuwanie koszyka uzytkownika
    $sql1 = "DELETE FROM cart WHERE cart_id = $cartId";
    mysqli_query($conn, $sql1);
     //usuwanie uzytkownika
    $sql2 = "DELETE FROM users WHERE user_id = $user_id";
    mysqli_query($conn, $sql2);
    //session_start();
    session_unset();
    session_destroy();
    header("Location: ../index.php");
    exit();
}

function artworkInfo($conn,$artwork_id){
    $sql = "SELECT 
            artwork.artwork_title,
            artwork.artwork_price,
            artist.artist_firstName,
            artist.artist_lastName
            FROM artwork
            JOIN artist ON artwork.artwork_artist_id = artist.artist_id
            WHERE artwork.artwork_id = '$artwork_id'";
    $result = mysqli_query($conn, $sql);
    return $result;
}

function addToCart($conn, $active_user, $artwork_id){
    $user_id = getUser_id($conn,$active_user);
    //koszyk aktywnego uzytkownika
    //id koszyka aktualnego uzytkownika
    $sql = "SELECT cart_id FROM cart
    WHERE user_cart = $user_id";
    $result = mysqli_query($conn, $sql);
    $arr = mysqli_fetch_array($result);
    $cart_id = $arr['cart_id'];
    //dodanie elementu koszyka do koszyka
    $sql1 = "INSERT INTO cartItem(cartItem_cart, cartItem_artwork)
    VALUES ($cart_id, 
            $artwork_id)";
    mysqli_query($conn, $sql1);
}
function getCartId($conn, $active_user){
    $user_id = getUser_id($conn,$active_user);
    $sql = " SELECT cart_id FROM cart
         WHERE user_cart =  $user_id";
    $result = mysqli_query($conn, $sql);
    $arr = mysqli_fetch_assoc($result);
    $cart = $arr['cart_id'];
    return $cart;
}
function userCartInfo($conn, $active_user){
    //wyswietlenie id obrazow jakie znajdujea sie w elemntach koszyka
        //id koszyka danego uzytkownika
    $cart = getCartId($conn, $active_user);
    //id obrazów z elementow koszyka
        $sql1 = "SELECT 
                cartItem.cartItem_artwork,
                cartItem.cartItem_id
                FROM cartItem
                WHERE cartItem.CartItem_cart = $cart";
        $result1 = mysqli_query($conn, $sql1);
    return $result1;
}

function deleteItem($conn, $cartItem_id){
    //usuniecie elementu po id elementu
    $sql = "DELETE FROM  cartItem
    WHERE cartItem.cartItem_id = $cartItem_id";
    mysqli_query($conn, $sql);
}

function search($conn, $input){
    //szukanie po tytule, imieniu, lub nazwisku
    $sql = "SELECT artwork_id
    FROM artwork 
    JOIN artist ON 
    artwork.artwork_artist_id = artist.artist_id
    WHERE  artwork.artwork_title='$input'
       OR artist.artist_firstName = '$input'
       OR artist.artist_lastName = '$input'";
    $result = mysqli_query($conn, $sql);
    //zwraca tablice z id znalezionych obrazow
    return $result;
}



