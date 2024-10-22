<?php
require("connect.php");

// Tjek om 'reviewId' er sat
if (empty($_GET['reviewId'])) {
    die("Ingen anmeldelse ID angivet.");
}

$reviewId = $_GET['reviewId'];

$review = sql("SELECT * FROM reviews WHERE reviewId = :reviewId", [':reviewId' => $reviewId]);

$reviewDetails = sql("
    SELECT * FROM reviewers 
    INNER JOIN movie_actor ON reviewerId = reviewerConId
    INNER JOIN reviews ON reviewId = reviewConId
    INNER JOIN movies ON movieId = movieConId
    INNER JOIN actors ON actorId = actorConId
    WHERE reviews.reviewId = :reviewId
    ORDER BY reviews.review_date DESC
", [':reviewId' => $reviewId]);

if (empty($review)) {
    die("Ingen anmeldelse fundet med dette ID.");
}

$review = $review[0];
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">
    <title><?php echo $review->review_title; ?></title>
    <style>
        .comment-section{
            background-color: ;
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
            text-align: start;
            padding: 32px;
            width: 50%;
        }
        .user-div{
            display: flex;
            justify-content: start;
            align-items: start;
            text-align: start;
        }
        .user-div p{
            color: #676767;
        }
        .user-img-comment{
            width: 25px;
        }
    </style>
</head>
<body>
<?php include "header.php"; ?>

<main id="main-left" class="main-left">
    <section id="review-section" class="review-section">
        <div>
            <img class="reviewer-img-review" src="img/user.png" alt="">
            <?php foreach($reviewDetails as $reviewDetail): ?>
                <a class="p-bold" href="reviewer.php?reviewerId=<?php echo $reviewDetail->reviewerId; ?>">
                <?php echo $reviewDetail->name_of_the_reviewer; ?>
                </a>
            <?php endforeach; ?>
        </div>
    </section>

    <section>
        <h1 class="h1" id="h1"><?php echo $review->review_title; ?></h1>
        <br>
        <p class="pnormal">
            <?php echo $review->underubrik; ?>
        </p>
        <p class="pregular">
            <?php echo $review->review_text; ?>
        </p>

        <div>
            <?php foreach($reviewDetails as $reviewDetail): ?>
                <a class="pnormal" href="reviewer.php?reviewerId=<?php echo $reviewDetail->reviewerId; ?>">
                    Flere anmeldelser af <?php echo $reviewDetail->name_of_the_reviewer; ?>
                </a>
            <?php endforeach; ?>
        </div>

        <div>

        </div>
    </section>
    <section class="comment-section">
<div class="comment">

   <div class="user-div">
       <img class="user-img-comment" src="img/user.png" alt="">
       <p class="pnormal">Brugernavn</p>

   </div>
    <p class="pregular">"God film Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquam consequuntur dolorem enim error ipsum iste iure
            , labore modi nemo nesciunt nobis officiis omnis quaerat quo rem repellendus repudiandae similique voluptates"</p>
    <!-- <label>
         <input type="text">
     </label>
     <button>Submit</button>-->
</div>
    </section>
</main>

</body>
</html>
