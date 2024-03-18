<?php
/**
 * @var PDO $connexion
 */
require("./fonction/fonction.php");
require("config/db-config.php");
$requete = $connexion->prepare("SELECT * FROM film");
$requete->execute();

$resultats = $requete->FetchAll();
?>
<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="./assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="./assets/css/darkly-bootstrap.min.css">
    <title>Document</title>
</head>
<body>
<!--Barre de navigation-->
<nav class="navbar navbar-expand-lg bg-primary mb-3" data-bs-theme="dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Eyce's Cinema</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor01"
                aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse me-auto justify-content-end mb-2" id="navbarColor01">
            <ul class="navbar-nav ">
                <li class="nav-item">
                    <a class="nav-link active" href="./pages/ajoutfilm.php">Ajouter un film</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="./pages/inscription.php">Inscription</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="./pages/connexion.php">Connexion</a>
                </li>

        </div>
    </div>
</nav>
<div class="container mt-5">
    <div class="row">
        <?php foreach ($resultats as $film): ?>
            <?php ["id_film" => $idFilm, "titre" => $titre, "duree" => $duree, "resume" => $resume, "date_sortie" =>
                $dateSortie, "pays" => $pays, "image" => $image] = $film ?>
            <div class="card mx-auto col-lg-3 mb-3 p-0" style="width: 18rem;">
                <?= "<img src='$image' alt=''>" ?>
                <div class="card-body">
                    <h5 class="card-title"><?= $titre ?></h5>
                    <h5 class="card-title"><?= convertirMinutesEnHeures($duree) ?></h5>
                    <button class="btn btn-info "><a
                                class="text-white link-offset-2 link-underline link-underline-opacity-0"
                                href="./pages/détails.php?id_film=<?= $film["id_film"] ?>">Voir
                            détails</a></button>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

</div>

<script src="./assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>
