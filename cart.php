<?php
include "header.php";
$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname)
or die('Bład połączenia z serwerem: '.mysqli_connect_error());
include "includes/functions_inc.php";
mysqli_query($conn, 'SET NAMES utf8');

?>

<div class="h-100">
    <div class="jumbotron text-center bg-white">
        <h2 class="display-4">Koszyk</h2>
    </div>

    <div class="row bg-white text-dark">
        <div class="col"></div>
        <div class="col">
            <?php
            //aktywny uzytkownik
            $active_user = $_SESSION['userid'];
            //zebranie informacji o produktach w koszyku
            $result = userCartInfo($conn,$active_user);
            if(mysqli_num_rows($result)){
                //wypisywanie danych kolenych elementow
                while ($arr = mysqli_fetch_assoc($result)){
                    echo '<table class="table">';
                    $artwork_id = $arr['cartItem_artwork'];
                    $cartItem_id = $arr['cartItem_id'];
                    $result1 = artworkInfo($conn, $artwork_id);
                    //wypisanie danych elementu
                    while($arr=mysqli_fetch_assoc($result1)) {
                        echo '<tr>
                 <th>Tytuł</th>
                 <th></th>
                 <th>Autor</th>
                 <th>Cena</th>  
                 <th></th>

             </tr>';
                        echo '<tr>';
                        echo '<td>' . $arr['artwork_title'] . '</td>';
                        echo '<td></td>';
                        echo '<td >' . $arr['artist_firstName'] .' '. $arr['artist_lastName'] . '</td>';
                        echo '<td>' . $arr['artwork_price'] . '</td>';
                        echo ' <td >';
                                      echo '<form action="includes/editCart_inc.php" method="post">';
                                      echo '<input  type="submit" class="btn btn-outline-danger" name="delete" value="Usuń z koszyka">';
                                      //przekazanie id elementu do editCart_inc.php
                                      echo '<input type="hidden" name="cartItem_id" value='.$cartItem_id.'>';
                                      echo '</form>';
                        echo '</td>';
                        echo '</tr>';

                        echo '</table>';
                    }
                }
            }else{
                echo '<div class="row justify-content-center">
                <div class="col"></div>
                <div class="col alert alert-danger">
                <p>W koszyku nic nie ma!</p>
                </div>
                <div class="col"></div>
               </div>';
            }


            ?>
        </div>
        <div class="col"></div>
    </div>

</div>
