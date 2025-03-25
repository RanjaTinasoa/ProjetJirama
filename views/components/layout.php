<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content=<?= $description ?>>
    <link rel="stylesheet" href="public/style/style.css">

    <title><?= $title ?></title>
</head>

<body class="layoutBody">
    <?php require_once("header.php") ?>
    <main class="main">
        <?php require_once("navbar.php") ?>
        <?php
        if ($view !== "views/homePage.php") {
            require_once("card.php");
        }
        ?>
        <div class="home-video-bg">
            <video id="homePageBackgroundVideo" autoplay loop muted>
                <source src="public/homepage_bg.mp4" type="video/mp4">
            </video>


        </div>

    </main>

    <?php require_once("footer.php") ?>
    <script src="public/script.js"></script>

</body>

</html>