<?php
require "connect.php";
$movieId = $_GET = ['movieId'];
$movies = sql("select * from sofieroshni_dk_db_moviereviewtwo.movies WHERE movieId = :movieId", [":movieId" => $movieId]);
$movies=$movies[0];
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    link:css
    <title>Document</title>
</head>
<body>
<?php include "header.php"; ?>
<main>
    <table>
        <tr>
            <td>  UPLOAD LINK</td>
            <td>  TILFØJ LINK </td>
            <td>  test</td>

        </tr>
        <tr>
<?php
foreach ($movies as $movie){ ?>
    <a href="movie_upload.php?movieId=<?php echo $movie->movieId;?>"><?php echo $movie->movie_title; ?></a> <?php
}
?>
        </tr>
    </table>

</main>
</body>
</html>
