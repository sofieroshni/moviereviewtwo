<?php
const CONFIG = [
    'db' => 'mysql:dbname=sofieroshni_dk_db_moviereviewtwo;host=mysql18.unoeuro.com;port=3306',
    'db_user' => 'sofieroshni_dk',
    'db_password' => 'R4FA35tEDcgk2xe6fGbd',
];

global $pdo;

try {
    $pdo = new PDO(CONFIG['db'], CONFIG['db_user'], CONFIG['db_password']);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Forbindelsen mislykkedes: " . $e->getMessage();
    exit;
}

// Definerer sql()-funktionen
function sql($query, $params = []) {
    global $pdo;

    try {
        $stmt = $pdo->prepare($query);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    } catch (PDOException $e) {
        echo "Forespørgslen mislykkedes: " . $e->getMessage();
        return [];
    }
}

if (isset($_POST['submit'])) {
    $movieTitle = trim($_POST['movieTitle']) ?: null;
    $review_title = trim($_POST['review_title']) ?: null;
    $underubrik = trim($_POST['underubrik']) ?: null;
    $review_text = trim($_POST['review_text']) ?: null;
    $review_rating = (int)($_POST['review_rating'] ?? 0);
    $review_date = $_POST['review_date'] ?? null;
    $name_of_the_reviewer = trim($_POST['name_of_the_reviewer']) ?: null;

    if (!$movieTitle || !$review_title || !$review_text || !$review_rating || !$name_of_the_reviewer || !$review_date) {
        echo "<script>alert('Alle felter skal udfyldes');</script>";
    } else {
        $pdo->beginTransaction();

        try {
            $stmt1 = $pdo->prepare("INSERT INTO reviews(review_title, underubrik, review_text, review_rating, review_date) VALUES (?, ?, ?, ?, ?)");
            $stmt1->execute([$review_title, $underubrik, $review_text, $review_rating, $review_date]);
            $reviewId = $pdo->lastInsertId();

            $stmt2 = $pdo->prepare("INSERT INTO movies(movieTitle) VALUES (?)");
            $stmt2->execute([$movieTitle]);
            $movieId = $pdo->lastInsertId();

            $stmt3 = $pdo->prepare("INSERT INTO reviewers(name_of_the_reviewer) VALUES (?)");
            $stmt3->execute([$name_of_the_reviewer]);
            $reviewerId = $pdo->lastInsertId();

            $stmt4 = $pdo->prepare("INSERT INTO movie_actor(movieConId, reviewConId, reviewerConId) VALUES (?, ?, ?)");
            $stmt4->execute([$movieId, $reviewId, $reviewerId]);

            $pdo->commit();

            echo "<script>
                alert('Anmeldelse er postet!');
                window.location.href = 'my_reviews.php';
            </script>";
        } catch (PDOException $e) {
            // Rul tilbage ved fejl
            $pdo->rollBack();
            echo "<script>alert('Fejl: " . $e->getMessage() . "');</script>";
        }
    }
}
///1. laver en form med petoden post fordi jeg gerne vil sætte noget ind i databasen.
//2. siger hvis 'hvis sumbit-knappen er trykket bliver $_post['sumbit'] sat og koden bliver kørt
//3. Hvis feltet er tomt eller bliver ikke er sat sættet NULL ind/0 for review_rating.
// ved hjælp er ??-operatoren eller ??
//vil de nedstående variabler deklererers.
//4 tjekker for tommefelter- Hvis de nødvendige felter er
//tome vises en alertboks
//Hvis !ikke $movieTitle (som jo var det der brugeren postet) || eller !$,!$,!$
//5. en database-transaktion sikrer at alle
//forspørgelser enten gennemføres eller rulles tilbage.
//Dette sikrer at databasen forbliver konistent
//6. indsætter anmelder, film, movie osv.
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        form[method="post"] {
            width: 50vw;
            height: 500px;
            justify-content: center;
            align-items: center;
        }
        form {
            margin-top: 10vh;
        }
        input[type="date"],
        input[type="text"],
        input[type="file"],
        textarea {
            width: 400px;
            padding: 10px;
            border: none;
            border-bottom: 1px solid #ddd;
            font-size: 16px;
            transition: all 0.2s ease-in-out;
            font-family: Inter, serif;
        }
        textarea {
            height: 300px;
        }
        .star-rating .bi-star-fill {
            font-size: 2rem;
            color: #ddd;
            cursor: pointer;
        }
        .star-rating .bi-star-fill.checked {
            color: gold;
        }

        @media (min-width: 900px) {
            input[type="date"],
            input[type="text"],
            input[type="file"],
            textarea {
                width: 800px;
                padding: 10px;
                border: none;
                border-bottom: 1px solid #ddd;
                font-size: 16px;
                transition: all 0.2s ease-in-out;
                font-family: Inter, serif;
            }
            .submit{
                margin-bottom: 10vh;
              align-self: end;justify-self: flex-end;
                margin-top: 32px;
            }
            .submit:hover{
                background-color: white;
                color: black;
            }

        }
    </style>
    <title>Movie Review</title>
</head>
<?php include "header.php"; ?>
<body>
<main>
    <form method="POST">
        <label>
            <input type="text" name="movieTitle" placeholder="Filmtitel">
        </label><br>
        <label>
            <input type="text" name="name_of_the_reviewer" placeholder="Skriv dit navn">
        </label><br>
        <label>
            <input type="text" name="review_title" placeholder="Indtast anmeldelsestitel">
        </label><br>
        <label>
            <input type="text" name="underubrik" placeholder="Skriv en underrubrik">
        </label><br>
        <label>
            <textarea type="text" name="review_text" placeholder="Skriv din anmeldelse her"></textarea>
        </label><br>
        <label>
            <input type="date" name="review_date">
        </label><br>

        <!-- Bootstrap Star Rating System -->
        <label>
            <div class="star-rating">
                <i class="bi bi-star-fill" data-rating="1"></i>
                <i class="bi bi-star-fill" data-rating="2"></i>
                <i class="bi bi-star-fill" data-rating="3"></i>
                <i class="bi bi-star-fill" data-rating="4"></i>
                <i class="bi bi-star-fill" data-rating="5"></i>
            </div>
            <input type="hidden" name="review_rating" id="review_rating" required>
        </label><br>

        <button class="submit pnormal" type="submit" name="submit">Indsend</button>
    </form>
</main>

<script>
    const stars = document.querySelectorAll('.star-rating .bi-star-fill');
    const ratingInput = document.getElementById('review_rating');
//
    stars.forEach((star, index) => {
        star.addEventListener('click', () => {
            stars.forEach(star => star.classList.remove('checked'));

            for (let i = 0; i <= index; i++) {
                stars[i].classList.add('checked');
            }

            ratingInput.value = index + 1;
        });
    });
    //laver en anynonym funktion, men en eventlistener til min stjerne(click)
    //stars.forEach er et loop som kører en funktion for hvart element i min liste(boostrapstjernere)
    //parametrene star,index (star er boostrapstjerrner) index er "positionen af stjerne" (0, 1 eller 4)
    // i = 0, I<=INDEX; i kører op til index-af stjerner(antallet),
    //klikker bruger på 3.stjerne i=2.
    // let i = 0;
    //1++; i er nu 1
    // i++ i er nu 2 værdien i øget med en 1 hver gang.
    //FORM VALUE: rating sendes ind i input. og inputvaluen sendes via min betingelse if($_POST){}
    //

</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
