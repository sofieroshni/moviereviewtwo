<?php
require("connect.php");

if(empty($_GET["actorId"])) { //Hvis url'en GET anmodning ikke har actorId'et.
    header("Location: index.php"); //så "omdirigeres/føre" brugen hen til forsiden
    exit(); // Stopper scriptet efter omdirigering så den ikke kører viderer
}

$actorId = $_GET["actorId"]; //lægger id'en ind i en variabel
$actor = sql("SELECT * FROM actors WHERE actorId = :actorId", [":actorId" => $actorId]);
//henter fra min actors tabel WHERE (betingelsen) er at actorId er lig med actorId
///(begrænser resultaterne til kun at inkludere skuespilleren mesd den angivne actorId, forbinder
/// laver parameterbinding når forespørgslen køres, vil :actorId blive erstattet med den værdi, der er gemt i $actorId.);
///

$actor = $actor[0];

$actorDetails = sql("SELECT m.movieId, m.movieTitle, m.movie_img, r.reviewId, r.review_rating
                     FROM movies as m
                     INNER JOIN movie_actor as ma ON m.movieId = ma.movieConId 
                     INNER JOIN actors as a ON a.actorId = ma.actorConId 
                     LEFT JOIN reviews as r ON r.reviewId = ma.reviewConId
                     WHERE a.actorId = :actorId
                     ORDER BY m.movieTitle", [":actorId" => $actorId]);

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <title><?php echo $actor->actorName; ?> - Filmoversigt</title>
    <style>
        .actortd{
            padding: 40px;
            height: 200px;


        }
        .actortd > a{
            margin: 0;
            padding: 0;
        }
    </style>
</head>
<body>
<?php include "header.php"; ?>
<main>
    <section class="actorDetails">
        <img class="actorimg" src="img/actorimage.png" width="" alt=""> <br>
        <h1 class=" h1"><?php echo $actor->actorName; ?></h1>

        <table id="actordetails-table" class="actordetails-table">
            <tr id="actordetails-tr" class="actordetails-tr">
                <td id="actordetails-td" class="actordetails-td">
                    <p class="p-bold">Født</p> <p class="pnormal"><?php echo $actor->birth_year; ?></p>
                </td>
                <td id="actordetails-td" class="actordetails-td">
                    <p class="p-bold">Nationalitet</p> <p class="pnormal"><?php echo $actor->actor_nationality; ?></p>
                </td>
            </tr>
        </table>

        <div class="actordescr">
            <p class="pnormal"><?php echo $actor->actor_describ; ?></p>
        </div>
    </section>
    <br>
    <section class="articles actorsectionone">
        <table class="actor-table" id="actor-table">
            <tr class="actortr" id="actortr">
                <td id="pbold" class="p-bold actortd-special"> </td>
                <td id="pbold" class="p-bold actortd">Film</td>
                <td id="pbold" class="p-bold actortd">Skuespillere</td>
                <td id="pbold" class="p-bold actortd">Rating</td>
            </tr>
            <br>
            <?php
            //henter detaljer om film og tilhørende skuespillere + undgår at vise de samme film flere gange
            //det gør jeg ved hjælp af et array som holder styr på de allerede viste film
            $displayedMovies = []; //jeg laver et tomt array displayMovies[]
            //jeg gennemgår alle elementer et af gangen med min foreach()


            foreach ($actorDetails as $actorDetail):
                if (!in_array($actorDetail->movieId, $displayedMovies)):
                    $displayedMovies[] = $actorDetail->movieId;
                    ?>
                <!--in_arrY() funktionen bruges her til at tjekke om akutelle film via movieId allerede findes i $displayedMovies,
                hvis !IKKE at id'et er i mit array så tilføjes det til det $displayMovies[] = $actorDetail->movieId-->
                    <tr class="actortr" id="actortr">
                        <td class="actortd">
                            <img src="img/actorimage.png" width="50px" alt="">
                            <p id="pnormal" class="pnormal">
                                <a href="movie.php?movieId=<?php echo $actorDetail->movieId; ?>">
                                    <?php echo $actorDetail->movieTitle; ?>
                                </a>
                            </p>
                        </td>
                        <td id="actortd" class="actortd">
                            <?php
                            // Vis alle skuespillere i filmen
                            $movieActors = sql("SELECT a.actorId, a.actorName 
                                                FROM actors as a
                                                INNER JOIN movie_actor ma ON a.actorId = ma.actorConId 
                                                WHERE ma.movieConId = :movieId",
                                [":movieId" => $actorDetail->movieId]);
                            //resultatet af min sql forespørgsel gemmer jeg i min variabel $actorDetail
                            foreach ($movieActors as $movieActor):
                                ?>
                                <p id="pnormal" class="pnormal">
                                    <a href="actor.php?actorId=<?php echo $movieActor->actorId; ?>">
                                        <?php echo $movieActor->actorName; ?>
                                    </a>
                                </p>
                            <?php endforeach; ?>
                        </td>
                        <td class="actortd">
                            <p id="pnormal" class="pnormal">
                                <a href="review.php?reviewId=<?php echo $actorDetail->reviewId; ?>">
                                    <div class='container mt-4'>
                                        <?php

                                        if(empty($actorDetail->review_rating)){
                                            echo "ingen reviews endnu";

                                        }else{for ($i = 0; $i < $actorDetail->review_rating; $i++) {
                                            echo "<i class='bi bi-star-fill'></i>";
                                        }
                                            for ($i = $actorDetail->review_rating; $i < 5; $i++) {
                                                echo "<i class='bi bi-star'></i>";
                                            }

                                        }
                                        //den første del tilføjer med 1++ fyldte stjerner (i = o, og så længe ratingen er over
                                        // 0 tilføjes der en fyldt stjerne)
                                        //den anden del tager så fra den nuværende rating med at sige i= reviewraiting
                                        //og så længe i er mindre end 5 vil der komme to tomme stjerner op


                                        ?>
                                    </div>
                                </a>
                            </p>
                        </td>
                    </tr>
                <?php endif; ?>
            <?php endforeach; ?>
        </table>
    </section>
</main>

</body>
</html>
