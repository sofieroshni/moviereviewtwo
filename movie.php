<?php
require "connect.php";

if(empty($_GET["movieId"])) {
    header("Location: index.php");
    exit(); // Vigtig for at stoppe koden, når der omdirigeres
}

$movieId = $_GET["movieId"];

// Hent filminformationer
$movie = sql("SELECT * FROM movies WHERE movieId = :movieId", [":movieId" => $movieId]);
$movie = $movie[0]; // Antag, at der kun er én film med det givne movieId

// Hent anmeldelser og skuespillere til filmen
$movieDetailsReviews = sql("
    SELECT *
                     FROM reviews 
                     INNER JOIN movie_actor ON reviewId = movie_actor.reviewConId 
                     INNER JOIN movies ON movieId= movieConId 
                    INNER JOIN reviewers ON reviewerId= movie_actor.reviewerConId 
                     LEFT JOIN actors ON actorId = movie_actor.actorConId
                     WHERE reviews.reviewId IN (SELECT reviewConId FROM movie_actor WHERE movieConId = :movieId)
                     ORDER BY review_title", [":movieId" => $movieId]);
$movieDetailsActors = sql("
    SELECT actors.actorId, actors.actorName 
    FROM actors 
    INNER JOIN movie_actor ON actors.actorId = movie_actor.actorConId 
    WHERE movie_actor.movieConId = :movieId
    ORDER BY actors.actorName", [":movieId" => $movieId]);

?>
<!--SELECT M.movieId, M.release_year, M.genre, M.director,
A.actorName, A.actorId,
R.reviewId, R.review_title, R.underubrik, R.review_text, R.name_of_the_reviewer, R.review_rating
FROM movies as M
JOIN movie_actor as MA ON M.movieId = MA.movieConId
JOIN actors as A ON A.actorId = MA.actorConId
JOIN reviews as R ON R.reviewId = MA.reviewConId-->

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <title><?php echo $movie->movieTitle; ?> - Filmoversigt</title>
</head>
<body>
<?php include "header.php";?>
<main>
    <section class="actorDetails">
        <img class="actorimg" src="img/actorimage.png" width="" alt=""> <br>
        <h1 class="h1"><?php echo $movie->movieTitle; ?></h1>
<div>
        <?php
        for ($i = 0; $i < $movie->rating; $i++) {
            echo "<i class='bi bi-star-fill'></i>";
        }
        for ($i = $movie->rating; $i < 5; $i++) {
            echo "<i class='bi bi-star'></i>";
        }
        ?>
        </div>
        <table id="actordetails-table" class="actordetails-table">

            <tr id="actordetails-tr" class="actordetails-tr">
                <td id="actordetails-td" class="actordetails-td">
                    <p class="p-bold">Udgivet</p>
                    <p class="pnormal"><?php echo $movie->release_year; ?></p>
                </td>
                <td id="actordetails-td" class="actordetails-td">
                    <p class="p-bold">Genre</p>
                    <p class="pnormal"><?php echo $movie->genre; ?></p>
                </td>
                <td id="actordetails-td" class="actordetails-td">
                    <p class="p-bold">Instruktør</p>
                    <p class="pnormal"><?php echo $movie->director; ?></p>
                </td>
            </tr>
        </table>

        <div class="actordescr">
            <p class="pnormal"><?php echo $movie->movie_resume; ?></p>
        </div>
        <ul class="actor-list">
            <?php foreach ($movieDetailsActors as $movieDetailsActor): ?>
                    <a href="actor.php?actorId=<?php echo $movieDetailsActor->actorId; ?>">
                        <p class="pnormal"><?php echo $movieDetailsActor->actorName; ?></p>
                    </a>
            <?php endforeach; ?>
        </ul>

    </section>
    <br>

    <!-- Sektion for anmeldelser -->
    <section class="articles actorsectionone">
        <table class="actor-table" id="actor-table">
            <tr class="actortr" id="actortr">
                <td id="pbold" class="p-bold actortd">Anmeldelse</td>
                <td id="pbold" class="p-bold actortd">Anmelder</td>
                <td id="pbold" class="p-bold actortd">Rating</td>
            </tr>
            <br>

            <?php
            // Visning af anmeldelser og deres data
            $displayedReviews = [];

            foreach ($movieDetailsReviews as $movieDetailsReview):
                if (!in_array($movieDetailsReview->reviewId, $displayedReviews)):
                    $displayedReviews[] = $movieDetailsReview->reviewId;
                    ?>
                    <tr class="actortr" id="actortr">
                        <td class="actortd">
                            <p id="pnormal" class="pnormal">
                                <a href="review.php?reviewId=<?php echo $movieDetailsReview->reviewId; ?>">
                                    <?php echo $movieDetailsReview->review_title; ?>
                                </a>
                            </p>
                        </td>
                        <td class="actortd">
                            <a href="reviewer.php?reviewerId=<?php  echo $movieDetailsReview->reviewerId?>"><p id="pnormal" class="pnormal"><?php echo $movieDetailsReview->name_of_the_reviewer; ?></p></a>
                        </td>
                        <td class="actortd">
                            <div class='container mt-4'>
                                <?php
                                for ($i = 0; $i < $movieDetailsReview->review_rating; $i++) {
                                    echo "<i class='bi bi-star-fill'></i>";
                                }
                                for ($i = $movieDetailsReview->review_rating; $i < 5; $i++) {
                                    echo "<i class='bi bi-star'></i>";
                                }
                                ?>
                            </div>
                        </td>
                    </tr>
                <?php endif; endforeach; ?>
        </table>
    </section>
</main>

</body>
</html>
