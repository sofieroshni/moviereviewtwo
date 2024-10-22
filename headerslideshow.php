<?php

// $reviews = sql("
//     SELECT * FROM reviewers
//     INNER JOIN movie_actor ON reviewerId = reviewerConId
//     INNER JOIN reviews ON reviewId = reviewConId
//     INNER JOIN movies ON movieId = movieConId
//     INNER JOIN actors ON actorId = actorConId
// ");

?>
<style>
    .slide{

    }
</style>
<header class="header-slideshow" id="header-slideshow">
    <nav class="header-nav">
        <a href="index.php">Film</a>
        <a href="reviews.php">Filmameldelser</a>
        <a href="my_reviews.php">Dine anmeldelser</a>
        <a href="addreview.php">Tilføj anmeldelse</a>
        <a href="actors.php">Skuespillere</a>
    </nav>

    <div class="glide" id="options-autoplay">
        <div class="glide__track" data-glide-el="track">
            <ul class="glide__slides">
                <?php if (isset($reviews) && is_array($reviews)): ?>
                    <?php foreach($reviews as $review): ?>
                        <li class="glide__slide slide">
                            <h1 class="h1 h1-slideshow"><?php echo $review->movieTitle; ?></h1><br>
                            <div class="ratingdiv">
                            <?php
                            // Fyldte stjerner
                            for ($i = 0; $i < $review->review_rating; $i++) {
                                echo "<i class='bi bi-star-fill'></i>";
                            }

                            // Ufyldte stjerner (antal stjerner er typisk 5, så forskellen udregnes)
                            for ($i = $review->review_rating; $i < 5; $i++) {
                                echo "<i class='bi bi-star'></i>";
                            }
                            ?></div>


                            <p class="pnormal"><?php echo $review->underubrik; ?></p>

                        </li>
                    <?php endforeach; ?>
                <?php else: ?>
                    <li class="glide__slide">

                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@glidejs/glide@3.5.2/dist/glide.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let glide = new Glide('#options-autoplay', {
                type: 'carousel',
                autoplay: 2000,
                hoverpause: true,
                perView: 1,
            });

            glide.mount();
        });
    </script>
</header>

<link rel="stylesheet" href="style.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@glidejs/glide@3.5.2/dist/css/glide.core.min.css">
