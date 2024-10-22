<?php
require("connect.php");

if(empty($_GET["reviewerId"])) {
    header("Location: index.php");
    exit(); // Stopper scriptet efter omdirigering
}

$reviewerId = $_GET["reviewerId"];

$reviewer = sql("SELECT * FROM reviewers WHERE reviewerId = :reviewerId", [":reviewerId" => $reviewerId]);
$reviewer = $reviewer[0]; 

$reviewerReviews = sql("
    SELECT reviews.reviewId, reviews.review_title, reviews.review_rating, movies.movieId, movies.movieTitle, movies.release_year, movies.genre, movies.director
    FROM reviews
    INNER JOIN movie_actor ON reviews.reviewId = movie_actor.reviewConId 
    INNER JOIN movies ON movie_actor.movieConId = movies.movieId
    WHERE movie_actor.reviewerConId = :reviewerId
    ORDER BY movies.movieTitle", [":reviewerId" => $reviewerId]);
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <title><?php echo $reviewer->name_of_the_reviewer; ?> </title>
</head>
<body>
<?php include "header.php"; ?>
<main>
    <section class="reviewerDetails-reviewerphp">
        <img src="img/user.png" alt="">
        <h1 class="h1"><?php echo $reviewer->name_of_the_reviewer; ?></h1>
        <p class="pnormal"> <?php echo $reviewer->reviewer_bio; ?></p>
    </section>
    <br>

    <section class="articles reviewsSection">
        <h1 class="h1-actor">Anmeldelser skrevet af <?php echo $reviewer->name_of_the_reviewer; ?>  </h1>
        <table class="reviews-table" id="reviews-table">
            <tr class="reviewstr" id="reviewstr">
                <td id="pbold" class="p-bold reviewtd">Film</td>
                <td id="pbold" class="p-bold reviewtd">Anmeldelse</td>
                <td id="pbold" class="p-bold reviewtd">Rating</td>
            </tr>

            <?php foreach ($reviewerReviews as $review): ?>
                <tr class="reviewstr" id="reviewstr">
                    <td class="reviewtd">
                        <p id="pnormal" class="pnormal">
                            <a href="movie.php?movieId=<?php echo $review->movieId; ?>">
                                <?php echo $review->movieTitle; ?>
                            </a>
                        </p>
                    </td>
                    <td class="reviewtd">
                        <p id="pnormal" class="pnormal">
                            <a href="review.php?reviewId=<?php echo $review->reviewId; ?>">
                                <?php echo $review->review_title; ?>
                            </a>
                        </p>
                    </td>
                    <td class="reviewtd">
                        <div class='container mt-4'>
                            <?php
                            for ($i = 0; $i < $review->review_rating; $i++) {
                                echo "<i class='bi bi-star-fill'></i>";
                            }
                            for ($i = $review->review_rating; $i < 5; $i++) {
                                echo "<i class='bi bi-star'></i>";
                            }
                            ?>
                        </div>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>

    </section>
    <section>


    </section>
</main>
</body>
</html>
