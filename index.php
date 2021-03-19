<?php
include "header.php";
include "includes/functions_inc.php";
?>
<!--pole wyszukiwania-->
<form action="search.php" method="post">
<div class="input-group mb-3">
    <input type="text" class="form-control" name="input" placeholder="tytuł/imię autora/nazwisko autora...">
    <div class="input-group-prepend">
        <button type="submit" class="btn btn-outline-info" name="search">Wyszukaj</button>
    </div>
</div>
</form>
<!--naglowek-->
<div class="jumbotron text-center bg-white" style="margin-bottom:0">
    <h2 class="display-4">Reprodukcje do kupienia!</h2>
</div>
    <div class="container-fluid">
        <div class="row text-center text-lg-lef">
            <!--zdjecie-->
            <div class="col-xl-3 col-lg-4 col-md-6 mb-4">
                <div class="bg-white rounded shadow-sm"></div>
                <img src="img/1.jpg" alt="..." class="img-thumbnail">
                <div class="p-4">
                        <div>
                            <a class="btn btn-outline-dark btn-block" href="artwork.php?artwork_id=1">Szczegóły</a>
                        </div>
                </div>
            </div>
            <!--zdjecie-->
            <div class="col-xl-3 col-lg-4 col-md-6 mb-4">
                <div class="bg-white rounded shadow-sm"></div>
                <img src="img/2.jpg" alt="..." class="img-thumbnail">
                <div class="p-4">
                        <div>
                            <a class="btn btn-outline-dark btn-block" href="artwork.php?artwork_id=2">Szczegóły</a>
                        </div>
                </div>
            </div>
            <!--zdjecie-->
            <div class="col-xl-3 col-lg-4 col-md-6 mb-4">
                <div class="bg-white rounded shadow-sm"></div>
                <img src="img/3.jpg" alt="..." class="img-fluid img-thumbnail">
                <div class="p-4">
                        <div>
                            <a class="btn btn-outline-dark btn-block" href="artwork.php?artwork_id=3">Szczegóły</a>
                        </div>
                </div>
            </div>
            <!--zdjecie-->
            <div class="col-xl-3 col-lg-4 col-md-6 mb-4">
                <div class="bg-white rounded shadow-sm"></div>
                <img src="img/4.jpg" alt="..." class="img-fluid img-thumbnail">
                <div class="p-4">
                        <div>
                            <a class="btn btn-outline-dark btn-block" href="artwork.php?artwork_id=4">Szczegóły</a>
                        </div>
                </div>
            </div>
            <!--zdjecie-->
            <div class="col-xl-3 col-lg-4 col-md-6 mb-4">
                <div class="bg-white rounded shadow-sm"></div>
                <img src="img/5.jpg" alt="..." class="img-fluid img-thumbnail">
                <div class="p-4">
                        <div>
                            <a class="btn btn-outline-dark btn-block" href="artwork.php?artwork_id=5">Szczegóły</a>
                        </div>
                </div>
            </div>
            <!--zdjecie-->
            <div class="col-xl-3 col-lg-4 col-md-6 mb-4">
                <div class="bg-white rounded shadow-sm"></div>
                <img src="img/6.jpg" alt="..." class="img-fluid img-thumbnail">
                <div class="p-4">
                        <div>
                            <a class="btn btn-outline-dark btn-block" href="artwork.php?artwork_id=6">Szczegóły</a>
                        </div>
                </div>
            </div>
            <!--zdjecie-->
            <div class="col-xl-3 col-lg-4 col-md-6 mb-4">
                <div class="bg-white rounded shadow-sm"></div>
                <img src="img/7.jpg" alt="..." class="img-fluid img-thumbnail">
                <div class="p-4">
                        <div>
                            <a class="btn btn-outline-dark btn-block" href="artwork.php?artwork_id=7">Szczegóły</a>
                        </div>
                </div>
            </div>
            <!--zdjecie-->
            <div class="col-xl-3 col-lg-4 col-md-6 mb-4">
                <div class="bg-white rounded shadow-sm"></div>
                <img src="img/8.jpg" alt="..." class="img-fluid img-thumbnail">
                <div class="p-4">
                        <div>
                            <a class="btn btn-outline-dark btn-block" href="artwork.php?artwork_id=8">Szczegóły</a>
                        </div>
                </div>
            </div>
        </div>
    </div>


<?php
include "footer.php";
?>



