<?php
require "connect.php";
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Athiti:wght@200;300;400;500;600;700&display=swap');
    </style>
    <link rel="stylesheet" href="style.css">
    <title>sogemaskine</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }
main{
    display: flex;
    flex-direction: column;
}
        body {
            font-family: Arial, sans-serif;
            background-color: white;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
        }

        form {
            width: 400px; /* Adjust form width */
        }

        label {
            display: block;
            margin-bottom: 15px;
        }

        input[type="text"],
        input[type="number"],
        input[type="file"],
        textarea {
            width: 100%;
            height: 50px;
            font-family: "Athiti", sans-serif;
            padding: 10px;


        }

        input[type="text"]:focus,
        input[type="number"]:focus,
        textarea:focus {
        }

        textarea {
            height: 150px; /* Adjust height for the textarea */
            resize: vertical; /* Allow vertical resizing */
        }

        button[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.2s ease-in-out;
        }

        button[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

<header>
   <?php
   include "header.php";?>

</header>
    <main>

        <form class="searchForm" id="searchForm">
            <label for="search"></label><input class="search form-control w-100 m-5" type="text" id="search" placeholder="Søg efter film...">
        </form>
        <div class="moviecontainer" id="moviecontainer">
           <!---
            $movies = sql('SELECT * FROM movies ORDER BY release_year DESC');
            foreach ($movies as $movie) {
                echo "<p>" . $movie->movieTitle . "</p>";
                echo "<p>" . $movie->movie_img . "</p>";
                echo "<p>Released in: " . $movie->release_year . "</p>"; // Display the release_year column
            }
            ?>**/-->
        </div>


    </main>
<script src="search.js"></script>
</body>
</html>
