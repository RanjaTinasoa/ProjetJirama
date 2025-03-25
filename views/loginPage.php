<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="public/style/style.css">

</head>


<body>
    <div class="video-background">
        <video id="backgroundVideo" autoplay loop muted>
            <source src="public/waterbg.mp4" type="video/mp4">
            <!-- Si le navigateur ne supporte pas la vidéo -->
            Votre navigateur ne supporte pas la vidéo.
        </video>
    </div>

    <div class="form">
        <h1>Bienvenue.</h1><br>
        <form action="">
            <div class="input"> <input type="text" placeholder="User" required>
                <div class="image"><img src="../assets/profil (1).png" alt=""></div>
            </div>
            <div class="input"> <input type="password" placeholder="Password" required>
                <div class="image"><img src="../assets/verrouillage.png" alt=""></div><br>
            </div>
            <button type="submit" id="changeSpeed">login</button>
        </form>

    </div>
    <script>
        let video = document.getElementById("backgroundVideo");
        let button = document.getElementById("changeSpeed");

        button.addEventListener("mouseover", function() {
            video.playbackRate = 0.5; // Ralentir la vidéo
        });

        button.addEventListener("mouseout", function() {
            video.playbackRate = 3; // Remettre la vitesse normale
        });
    </script>

</body>

</html>