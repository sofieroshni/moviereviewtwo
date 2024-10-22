<?php
require("connect.php");

if (isset($_GET['delete'])) {
    $reviewId = intval($_GET['delete']);

    $delete = sql("DELETE FROM reviews WHERE reviewId = :reviewId", [
        ":reviewId" => $reviewId
    ]);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['reviewerId'])) {
    // Hent data fra formularen
    $reviewerId = $_POST['reviewerId'];  // Hent reviewerId direkte fra POST
    $name_of_the_reviewer = $_POST['data']['name_of_the_reviewer'];
    $reviewer_age = $_POST['data']['reviewer_age'];
    $reviewer_email = $_POST['data']['reviewer_email'];
    $reviewer_bio = $_POST['data']['reviewer_bio'];
    $reviewer_image = "";

    if (isset($_FILES['data']['name']['reviewer_image']) && $_FILES['data']['name']['reviewer_image'] !== '') {
        $targetDir = "uploads/"; // Directory where images will be uploaded
        $targetFile = $targetDir . basename($_FILES['data']['name']['reviewer_image']);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

        // Check if image file is a actual image or fake image
        $check = getimagesize($_FILES['data']['tmp_name']['reviewer_image']);
        if ($check === false) {
            echo "File is not an image.";
            $uploadOk = 0;
        }

        // Check file size (limit to 5MB)
        if ($_FILES['data']['size']['reviewer_image'] > 5000000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }

        // Allow certain file formats
        if (!in_array($imageFileType, ['jpg', 'png', 'jpeg', 'gif'])) {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }

        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
        } else {
            if (move_uploaded_file($_FILES['data']['tmp_name']['reviewer_image'], $targetFile)) {
                $reviewer_image = $targetFile; // Set the image path to save in DB
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
    }

    $update = sql("
        UPDATE reviewers 
        SET 
            name_of_the_reviewer = :name_of_the_reviewer, 
            reviewer_age = :reviewer_age, 
            reviewer_email = :reviewer_email, 
            reviewer_bio = :reviewer_bio" .
        ($reviewer_image ? ", reviewer_image = :reviewer_image" : "") .
        " WHERE reviewerId = :reviewerId", [
        ':name_of_the_reviewer' => $name_of_the_reviewer,
        ':reviewer_age' => $reviewer_age,
        ':reviewer_email' => $reviewer_email,
        ':reviewer_bio' => $reviewer_bio,
        ':reviewerId' => $reviewerId,
        ':reviewer_image' => $reviewer_image
    ]);

    header("Location: my_reviews.php");
    exit();
}

// Hent bio-oplysninger for anmelderen
$bios = sql("SELECT 
     sofieroshni_dk_db_moviereviewtwo.reviewers.reviewer_image, reviewerId, reviewer_age, name_of_the_reviewer, reviewer_bio, reviewer_email 
    FROM reviewers 
    WHERE name_of_the_reviewer IN ('sofie', 'Sofie', 's')");

// Hent første resultat, hvis tilgængeligt
$bio = !empty($bios) && is_array($bios) ? $bios[0] : null;

// Hent alle anmeldelser for at vise dem
$reviews = sql("SELECT 
    reviewId, review_title, review_date, reviewConId, review_rating, name_of_the_reviewer,reviewId
    FROM reviews AS r
   LEFT JOIN movie_actor AS ma
        ON r.reviewId = ma.reviewConId
   LEFT JOIN reviewers AS rv
        ON rv.reviewerId = ma.reviewerConId WHERE rv.name_of_the_reviewer='sofie'
    ORDER BY r.review_date DESC;");?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

    <link rel="stylesheet" href="style.css">
    <title>Dine Reviews</title>
    <style>
        main {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }
        table {
            width: 80%;
            display: inline-table;
            justify-content: center;
            align-items: center;
            margin: 32px 10px 10px;
        }
        tr {
            width: 100%;
            display: inline-flex;
        }
        .delete {
            width: 100px;
            background-color: blue;
            font-family: Inter, serif;
            color: white;
            border-radius: 8px;
            padding: 5px;
        }
        .edit-bio-btn {
            height: 10px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            border: none;
            padding: 10px;
            width: 100px;
            margin-bottom: 5px;
            border-radius: 5px;
            margin-top: 10px;
        }
        .submit {
            height: 10px;
            display: none; /* Hidden initially */
            align-items: center;
            justify-content: center;
            text-align: center;
            border: none;
            border-radius: 5px;
        }
        form {
            display: flex;
            width: 80vw;
            justify-content: center;
            flex-direction: column;
            align-items: center;
        }
        input[type="email"], input[type="number"] {
            height: 50px;
            padding: 10px;
            font-family: Inter, serif;
            width: 100%;
            margin: 10px;
        }
        input[type="text"], textarea {
            height: 100px;
            padding: 10px;
            font-family: Inter, serif;
            width: 100%;
            margin: 10px;
        }
        .inputs {
            display: flex;
            flex-direction: row;
            justify-content: center;
            align-items: center;
        }
        .reviewer-img-new{
height:100px;
        }
    </style>
</head>
<body>
<?php include "header.php"; ?>
<main>
    <section class="my-reviews">

        <?php if (empty(!$bio->reviewer_image)){
?>        <img  class="reviewer-img-new" src="<?php echo $bio->reviewer_image; ?>" style="width: 100px; height: 100px;" alt="Reviewer Image">

            <img style="display:none;" src="img/user.png" alt="">
            <?php
        }  ?>
        <div class="bio fade-right">
            <?php if ($bio): ?>
                <p class="pnormal"><?php echo $bio->name_of_the_reviewer; ?></p>
                <p class="pnormal"><?php echo $bio->reviewer_age; ?></p>
                <p class="pnormal"><?php echo $bio->reviewer_email; ?></p>
                <p class="pregular"><?php echo $bio->reviewer_bio; ?></p>

                <!-- Redigeringsform -->
                <button id="edit" class="edit-bio-btn">Rediger Bio</button>
                <form action="my_reviews.php" method="post" enctype="multipart/form-data">
                    <input type="file" name="data[reviewer_image]" accept="image/*">
                    <input type="hidden" name="reviewerId" value="<?php echo $bio->reviewerId; ?>">
                    <div class="inputs">
                        <label>
                            <input type="text" class="edit-bio-input" name="data[name_of_the_reviewer]" value="<?php echo $bio->name_of_the_reviewer; ?>">
                        </label>
                        <label>
                            <input type="number" class="edit-bio-input" name="data[reviewer_age]" value="<?php echo $bio->reviewer_age; ?>">
                        </label>
                        <label>
                            <input type="email" class="edit-bio-input" name="data[reviewer_email]" value="<?php echo $bio->reviewer_email; ?>">
                        </label>
                    </div>
                    <label>
                        <textarea class="edit-bio-input" name="data[reviewer_bio]"><?php echo $bio->reviewer_bio; ?></textarea>
                    </label>
                    <button type="submit" class="submit" name="submit">Gem</button>
                </form>
            <?php else: ?>
                <p>Ingen bio fundet.</p>
            <?php endif; ?>
        </div>
    </section>

    <section>
        <table>
            <tr>
                <td class="pnormal">Navn</td>
                <td class="pnormal">Slet</td>
            </tr>

            <?php foreach ($reviews as $review) { ?>
                <tr>
                    <td>
                        <a class="pnormal" href="review.php?reviewId=<?php echo $review->reviewId; ?>">
                            <?php echo $review->review_title; ?>
                        </a>
                    </td>
                    <td>
                        <a class="pnormal" href="review.php?reviewId=<?php echo $review->reviewId; ?>">
                            <?php echo $review->name_of_the_reviewer; ?>
                        </a>
                    </td>
                    <td>
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
                    <td>
                        <a class="delete" href="my_reviews.php?delete=<?php echo $review->reviewId; ?>" onclick="return confirm('Er du sikker på, at du vil slette denne anmeldelse?');">Delete</a>
                    </td>
                </tr>
            <?php } ?>

            <?php if (empty($reviews)) { ?>
                <td>
                    <button class="add">
                        <a class="pnormal" href="addreview.php">Tilføj Anmeldelse +</a>
                    </button>
                </td>
            <?php } ?>
        </table>
    </section>
</main>
</body>
</html>

<script>
    // JavaScript for redigering af bio
    const editBtn = document.querySelector('.edit-bio-btn');
    const bioInputs = document.querySelectorAll('.edit-bio-input');
    const saveBtn = document.querySelector('.submit');

    editBtn.addEventListener('click', () => {
        bioInputs.forEach(input => {
            input.style.display = input.style.display === "none" ? "block" : "none";
        });
        saveBtn.style.display = saveBtn.style.display === "none" ? "flex" : "none";
    });

    bioInputs.forEach(input => {
        input.style.display = "none";
    });
    saveBtn.style.display = "none";
</script>
<script>
    AOS.init();
</script>