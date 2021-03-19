<?php
include "autoryzacja.php";
include "includes/functions_inc.php";

$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname)
or die('Bład połączenia z serwerem: ' . mysqli_connect_error());
//echo "Połączenie udane <br>";
mysqli_query($conn, 'SET NAMES utf8');
include "header.php";
?>

<div class="h-100">
    <div class="jumbotron text-center bg-white" style="margin-bottom:0">
        <h2 class="display-4">Znalezione reprodukcje</h2>
    </div>

    <div class="row bg-white text-dark" id="header">
        <div class="col"></div>
        <div class="col">
            <?php
            $input = $_POST['input'];

            if (isset($_POST['search'])) {
                //znajduje id obrazów
                $result = search($conn, $input);
                //sprawdzenie czy sa wyniki wyszukiwania
                if(mysqli_num_rows($result) > 0){
                    while ($arr = mysqli_fetch_assoc($result)) {
                        echo '<table class="table">';
                        $artwork_id = $arr['artwork_id'];
                        $result1 = artworkInfo($conn, $artwork_id);
                        while ($arr = mysqli_fetch_assoc($result1)) {
                            echo '<tr>
                 <th>Tytuł</th>
                 <th>Autor</th>
                 <th></th>
                 <th>Cena</th>  
                 <th></th>
                 <th></th>
             </tr>';
                            echo '<tr>';
                            echo '<td>' . $arr['artwork_title'] . '</td>';
                            echo '<td>' . $arr['artist_firstName'] . ' ' . $arr['artist_lastName'] . '</td>';
                            echo '<td></td>';
                            echo '<td align ="left">' . $arr['artwork_price'] . '</td>';
                            echo ' <td align="left">';
                            echo '<a class="btn btn-outline-info btn-block" href="artwork.php?artwork_id=' . $artwork_id . '">Przejdź</a>';
                            echo '</td>';
                            echo '</tr>';
                            echo '</table>';
                        }
                    }
                }else{
                    echo '<div class="row justify-content-center">
                <div class="col"></div>
                <div class="col alert alert-danger">
                <p>Brak wyników!</p>
                </div>
                <div class="col"></div>
               </div>';
                }

            }
            ?>
        </div>
        <div class="col"></div>
</div>

    </div>


<?php
include "footer.php";