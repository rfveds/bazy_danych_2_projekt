<?php
include "header.php";
include "includes/functions_inc.php";


?>
    <div class="jumbotron text-center bg-white" style="margin-bottom:0">
        <h2 class="display-4">Edycja Danych</h2>
    </div>
<div class="row">
    <div class="col"></div>
    <div class="col">
        <form action="includes/editUser_inc.php" method="post">
            <div class="input-group mb-3">
                <input type="text" class="form-control" name="firstName" placeholder="nowe imię...">
                <div class="input-group-prepend">
                    <button type="submit" class="btn btn-outline-info" name="editFirstName">Edytuj</button>
                </div>
            </div>

            <div class="input-group mb-3">
                <input type="text" class="form-control" name="lastName" placeholder="nowe nazwisko...">
                <div class="input-group-prepend">
                    <button type="submit" class="btn btn-outline-info" name="editLastName">Edytuj</button>
                </div>

            </div>

            <div class="input-group mb-3">
                <input type="text" class="form-control" name="user_uid" placeholder="nowy login...">
                <div class="input-group-prepend">
                    <button type="submit" class="btn btn-outline-info" name="editUserUid">Edytuj</button>
                </div>

            </div>

            <div class="input-group mb-3">
                <input type="text" class="form-control" name="email" placeholder="nowy adres email...">
                <div class="input-group-prepend">
                    <button type="submit" class="btn btn-outline-info" name="editEmail">Edytuj</button>
                </div>

            </div>

            <div class="input-group mb-3">
                <input type="password"class="form-control" name="pwd" placeholder="nowe hasło...">
                <div class="input-group-prepend">
                    <button type="submit" class="btn btn-outline-danger" name="editPwd">Edytuj</button>
                </div>

            </div>

            <div>
                <button type="submit" class="btn btn-outline-danger button_bottom_space" name="deleteUser">Usuń Konto</button>
            </div>
        </form>
    </div>
    <div class="col"></div>
</div>

<?php
//jesli w GET nic nie ma
if (!isset($_GET['edit'])) {
    exit();
} else {
    //zmienna w ktrej przechowany jest rodzaj bledu
    $editCheck = $_GET['edit'];
    //sprawdzenie jaka byla wiadomosc zwrotna
    if ($editCheck == "wrongchar") {
        echo '<div class="row justify-content-center">
                <div class="col"></div>
                <div class="col alert alert-danger">
                <p>Nieprawidłowe imię lub nazwisko!</p>
                </div>
                <div class="col"></div>
               </div>';
        exit();
    }elseif ($editCheck == "invalidemail"){
        echo '<div class="row justify-content-center">
                <div class="col"></div>
                <div class="col alert alert-danger">
                <p>Nieprawodłowy adres email!</p>
                </div>
                <div class="col"></div>
               </div>';
        exit();
    }
    elseif ($editCheck == "success") {
        echo '<div class="row justify-content-center">
                <div class="col"></div>
                <div class="col alert alert-success">
                <p>Edycja danych przegbiegła pomyślnie!</p>
                </div>
                <div class="col"></div>
               </div>';
        exit();
    }
    elseif ($editCheck == "empty") {
        echo '<div class="row justify-content-center">
                <div class="col"></div>
                <div class="col alert alert-danger">
                <p>Wypełnij pole!</p>
                </div>
                <div class="col"></div>
               </div>';
        exit();
    }
    elseif ($editCheck == "taken") {
        echo '<div class="row justify-content-center">
                <div class="col"></div>
                <div class="col alert alert-danger">
                <p>Login zajęty!</p>
                </div>
                <div class="col"></div>
               </div>';
        exit();
    }
}
?>

<?php
include "footer.php";
