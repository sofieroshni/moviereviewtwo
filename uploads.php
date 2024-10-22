<?php
require("connect.php");
require("my_reviews.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['review_image'])) {
    $target_dir = "uploads/"; // Ensure this folder exists and has write permissions
    $reviewerId = intval($_POST['reviewerId']); // Ensure reviewerId is available
    $uploadOk = 1;

    // Get file details
    $imageFileType = strtolower(pathinfo($_FILES['review_image']['name'], PATHINFO_EXTENSION));
    $target_file = $target_dir . basename($_FILES['review_image']['name']);

    // Check if image file is a real image or fake image
    $check = getimagesize($_FILES['review_image']['tmp_name']);
    if ($check === false) {
        echo "File is not an image.";
        $uploadOk = 0;
    }

    // Check file size (limit to 2MB for example)
    if ($_FILES['review_image']['size'] > 2000000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    // Allow certain file formats (jpg, png, jpeg, gif)
    $allowed_formats = ['jpg', 'jpeg', 'png', 'gif'];
    if (!in_array($imageFileType, $allowed_formats)) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 due to an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    } else {
        // Attempt to move the file to the upload folder
        if (move_uploaded_file($_FILES['review_image']['tmp_name'], $target_file)) {
            echo "The file " . htmlspecialchars(basename($_FILES['review_image']['name'])) . " has been uploaded.";

            // Save the image path in the database
            $image_path = $target_file;

            // Now update the database with the image path
            $update = sql("UPDATE reviewers SET reviewer_image = :reviewer_image WHERE reviewerId = :reviewerId", [
                ':reviewer_image' => $image_path,
                ':reviewerId' => $reviewerId
            ]);

            // Redirect back after successful upload
            header("Location: my_reviews.php");
            exit();
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
} else {
    echo "No file uploaded or invalid request.";
}
?>
