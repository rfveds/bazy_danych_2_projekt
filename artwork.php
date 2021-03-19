<?php
//dodatkowy header, zeby nie mieszac z przechodzeniem do innych folderow
include "header.php";
$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname)
or die('Bład połączenia z serwerem: '.mysqli_connect_error());
mysqli_query($conn, 'SET NAMES utf8');

?>
<?php
include "includes/functions_inc.php";
//aktywny obraz w url
$artwork_id = $_GET['artwork_id'];
//zebranie informacji o aktywnym obrazie
$result = artworkInfo($conn,$artwork_id);
$arr=mysqli_fetch_assoc($result)
?>

<div class="jumbotron text-center bg-white" style="margin-bottom:0">
    <?php
     echo '<h2>' . $arr['artwork_title'] . '</h2>';
    ?>
</div>
<div class="row">
    <div class="col"></div>
    <div class="col-6">
        <div>
            <img src="img/<?php echo $artwork_id; ?>.jpg" alt="..." class="img-img-fluid card-img-top">
        </div>
    </div>
    <div class="col"></div>

</div>
<div class="row bg-white text-dark" id="header" style="padding-bottom: 5rem">
    <div class="col"></div>
    <div class="col">

        <?php
        //zebranie informacji o artyscie
        //wypisanie danych w tabeli
        echo '<table class="table">';
            echo '<tr>
                 <th>Autor</th>
                 <th></th>
                 <th>Cena</th>
             </tr>';
            echo '<tr>';
            echo '<td>' . $arr['artist_firstName'] .' '. $arr['artist_lastName'] . '</td>';
            echo '<td></td>';
            echo '<td>' . $arr['artwork_price'] . '</td>';
            echo '</tr>';
            echo '</table>';

            //jesli uzytkownik jest zarejestrowany moze dodac do koszyka
            if(isset($_SESSION['userid'])){
                echo '<form action="includes/addToCart_inc.php" method="post">';
                echo '<input type="submit" class="btn btn-outline-dark btn-block" name="artwork" value="Dodaj do koszyka">';
                echo '<input type="hidden" name="artwork_id" value='.$artwork_id.'>';
                echo '</form>';
            }else{
                //jesli nie jest zalogowany, przekierwoanie do strony logowania
                echo '<p class="alert-info"><a href="logIn.php">Zaloguj się</a>, aby dodać do koszyka</p>';
            }

        ?>
    </div>
    <div class="col"></div>
</div>

<?php
include "footer.php";
