<?php
require("fonction.php");
require("./config/db-config.php");

$requete = $connexion->prepare("SELECT * FROM film");
$requete->execute();

$resultats = $requete->FetchAll();

if (isset($_GET["id_film"])) {
    $idFilm = $_GET["id_film"];
}
foreach ($resultats as $film) {
    ["id_film" => $idFilm, "titre" => $titre, "duree" => $duree, "resume" => $resume, "date_sortie" => $dateSortie, "pays" => $pays, "image" => $image] = $film;
}

?>
<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="./assets/css/darkly-bootstrap.min.css">
    <title><?= $titre ?></title>
</head>
<body>
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
<div class="container text-center mt-5">
    <div class="row">
        <div class="col">
            <?= "<img src='$image' alt=''>" ?>
            <p class="mt-5">Date de sortie : <?= $dateSortie ?></p>
            <p>Pays : <?= $pays ?></p>
        </div>
        <div class="col">
            <?= $resume ?>
        </div>
    </div>
</div>
</body>
</html>
