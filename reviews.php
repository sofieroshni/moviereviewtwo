<?php
require("connect.php");

$reviews = sql("
    SELECT * FROM reviews r
    left JOIN movie_actor ON r.reviewId = reviewConId
    left JOIN reviewers re ON reviewerId = reviewerConId
    left JOIN movies ON movieId = movieConId
    left JOIN actors ON actorId = actorConId
    ORDER BY r.review_date DESC; 
"); //jeg left Joiner,
// fordi at jeg gerne vil havde alle
// anmeldser vist ikke kun dem der matcher med den anden tabel. Inner join => viste kun dem hvor at
//der var et match imellem tabellen jeg joinede og min hovedtabel

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Anmeldelser</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        .button{
            font-size: 12px;
            font-family: "Athiti", sans-serif;
            padding: 10px;

        }
        .button:hover{
            opacity: 50%;
        }
        .h2{
            margin-top: 20px;
            margin-bottom: 20px;
        }
        #h2{
            margin-top: 20px;
            margin-bottom: 20px;
        }
        a:hover{
            opacity: 50%;
        }
    </style>
</head>
<body>

    <?php include "headerslideshow.php"; ?>


<main>
    <div id="articleContainer">


        <h1 class="h1">Liste over Anmeldelser</h1>
        <table>
            <tr>
                <td class="p-bold" id='pnormal'>Anmeldelse</td>
                <td class="p-bold" id='pnormal'>Film</td>
                <td class="p-bold" id='pnormal'>Anmelder</td>
                <td class="p-bold" id='pnormal'>Rating</td>
            </tr>

            <?php foreach ($reviews as $review): ?>
                <tr>
                    <td>
                        <button class="btn-go-to">

                            <a class="button" id="button" href="review.php?reviewId=<?php echo $review->reviewId; ?>">
                                <?php echo  $review->review_title; ?>
                            </a>
                        </button>
                    </td>
                    <td>
                        <a class="pnormal movie-title-table" id="pnormal" href="movie.php?movieId=<?php echo $review->movieId; ?>">
                          '<?php echo "'".$review->movieTitle; echo "'";?>
                        </a>
                    </td>
                    <td>
                        <a class="pnormal" id="pnormal"  href="reviewer.php?reviewerId=<?php echo $review->reviewerId; ?>">
                            <?php echo $review->name_of_the_reviewer; ?>
                        </a>
                    </td>
                    <td>



                        <!--Mine ratings er inde i en container. Jeg laver en varibael som er 0. Hvis review rating er over nul skal
                        den lægge en til og echo antallet af stjerner der er fyldte.-->
                        <div class='container mt-4'>
                            <?php
                            // Fyldte stjerner
                            for ($i = 0; $i < $review->review_rating; $i++) {
                                echo "<i class='bi bi-star-fill'></i>";
                            }

                            // Ufyldte stjerner (antal stjerner er typisk 5, så forskellen udregnes)
                            for ($i = $review->review_rating; $i < 5; $i++) {
                                echo "<i class='bi bi-star'></i>";
                            }
                            ?>
                        </div>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>

    </div>
    <h2  id="h2" class="h2">Se mere fra skuespillerene...</h2>
    <br>
    <div class="section">
        <?php foreach ($reviews as $review): ?>
            <p class='p-normal'>
                <a class='pnormal' href='actor.php?actorId=<?php echo $review->actorId; ?>'>
                    <?php echo $review->actorName; ?>
                </a>
            </p>
        <?php endforeach; ?>
    </div>

    <!--<section class="section">
        <div class="look-at-div">

            <h1 class="h1">Skuespillere</h1>

        </div>
        <div class="look-at-div">
            <h1 class="h1">Anmeldelser</h1>

        </div>
        <div class="look-at-div">
            <h1 class="h1">Andet</h1>


        </div>
    </section>-->
</main>
</body>
</html>
