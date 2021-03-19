<?php
include "header.php";
$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname)
or die('Bład połączenia z serwerem: '.mysqli_connect_error());
mysqli_query($conn, 'SET NAMES utf8');

?>
<div class="h-100">
    <div class="jumbotron text-center bg-white" style="margin-bottom:0">
        <h2 class="display-4">Dane Użytkownika</h2>
    </div>
    <div class="row bg-white text-dark" id="header">
        <div class="col"></div>
        <div class="col">
            <?php
            include "includes/functions_inc.php";
            //aktywny uzytkownik
            $active_user = $_SESSION['userid'];
            //zebranie informacji o aktywnym uzytkowniku
            $result = userInfo($conn,$active_user);
            //wypisanie danych w tabeli
            echo '<table class="table  ">';
            while($arr=mysqli_fetch_assoc($result)) {
                echo '<tr>
                 <th>Imię</th>
                 <th>Nazwisko</th>
                 <th>Email</th>
                 <th>Login</th>
             </tr>';
                echo '<tr>';
                echo '<td>' . $arr['user_firstName'] . '</td>';
                echo '<td>' . $arr['user_lastName'] . '</td>';
                echo '<td>' . $arr['user_email'] . '</td>';
                echo '<td>' . $arr['user_uid'] . '</td>';
                echo '</tr>';
                echo '</table>';
                echo ' <td > <a class="btn btn-outline-dark btn-block" href="editInfoUser.php?user_id=' . $arr['user_id'] . '">Edytuj</a></td>';
            }
            ?>
        </div>
        <div class="col"></div>
    </div>

</div>


<?php
include "footer.php";
?>


