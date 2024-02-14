<?php
/**
 * @var PDO $connexion
 */
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
        <a class="navbar-brand" href="#">Navbar</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor01"
                aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarColor01">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link active" href="#">Home
                        <span class="visually-hidden">(current)</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Features</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Pricing</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">About</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button"
                       aria-haspopup="true" aria-expanded="false">Dropdown</a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="#">Action</a>
                        <a class="dropdown-item" href="#">Another action</a>
                        <a class="dropdown-item" href="#">Something else here</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">Separated link</a>
                    </div>
                </li>
            </ul>
            <form class="d-flex">
                <input class="form-control me-sm-2" type="search" placeholder="Search">
                <button class="btn btn-secondary my-2 my-sm-0" type="submit">Search</button>
            </form>
        </div>
    </div>
</nav>
<div class="container mx-auto justify-content-center">
    <?php foreach ($resultats as $film): ?>
        <?php ["id_film" => $idFilm, "titre" => $titre, "duree" => $duree, "resume" => $resume, "date_sortie" => $dateSortie, "pays" => $pays, "image" => $image] = $film ?>
        <div class="card mx-auto mb-3" style="width: 18rem;">
            <?= "<img src='$image' alt=''>" ?>
            <div class="card-body">
                <h5 class="card-title"><?= $titre ?></h5>
                <button class="btn btn-info "><a
                            class="text-white link-offset-2 link-underline link-underline-opacity-0"
                            href="#">Voir
                        détails</a></button>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<script src="./assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>
