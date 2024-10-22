<?php
require("connect.php");

$actors = sql("SELECT a.actorId, a.actorName, m.movieId, m.movieTitle
               FROM actors as a
               LEFT JOIN movie_actor as ma ON actorId = ma.actorConId
               LEFT JOIN movies as m ON m.movieId = ma.movieConId
               ORDER BY a.actorName");
//her har jeg bare valgt at vælge actorId, actorName, movie
?><!-- JOIN reviews ON reviews.reviewId = movie_actor.reviewConId--->
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Anmeldelser</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<header>
    <?php include "header.php" ?>
</header>

<main>
    <div id="articleContainer">
        <h1>Liste over Skuespillere</h1>
        <table>
            <tr>
                <td class="pnormal">Skuespillere</td>
                <td class="pnormal">Film</td>
            </tr>

            <?php
            $currentActorId = null; // Jeg laver en variabel til at holde styr på aktuel skuespiller,
            // indeholder eller peger ikke på nogle værdier

            foreach ($actors as $actor) {
                // Hvus currentActor IKKE er actorId, så skal føglende ske(jeg tjekker om actorId er vist)
                if ($currentActorId !== $actor->actorId) {
                    echo "<tr>";
                    echo "<td class='pnormal'><a href='actor.php?actorId=$actor->actorId'>$actor->actorName</a></td>";

                    // Tjek om filmen har en gyldig titel
                    if (!empty($actor->movieTitle)) {
                        echo "<td class='pnormal'><a href='movie.php?movieId=$actor->movieId'>$actor->movieTitle</a></td>";
                    } else {
                        // Ingen film tilknyttet, vis tom celle
                        echo "<td class='plight'>Ingen film</td>";
                    }

                    echo "</tr>";
                    $currentActorId = $actor->actorId; // Opdater aktuel skuespiller ID
                } else {
                    // Hvis skuespilleren allerede er vist= ik vise dem igen
                    continue;
                }
            }
            ?>
        </table>
    </div>
</main>
</body>
</html>
