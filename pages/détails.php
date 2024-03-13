<?php
require("../fonction/fonction.php");
require("../config/db-config.php");

$idFilm = null;
if (isset($_GET["id_film"])) {
    $idFilm = $_GET["id_film"];
}

if ($idFilm) {
    $requete = $connexion->prepare("SELECT * FROM film WHERE id_film=:idFilm");
    $requete->execute(["idFilm" => $idFilm]);
    $resultats = $requete->Fetch(PDO::FETCH_ASSOC);
}


?>
<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../assets/css/darkly-bootstrap.min.css">
    <title><?= $resultats["titre"] ?></title>
</head>
<?php include_once("../menu/menu.php"); ?>
<body>
<div class="container text-center mt-5">
    <div class="row">
        <div class="col">
            <img src=<?= $resultats["image"] ?> alt=''>
            <p class="mt-5">Date de sortie : <?php $date = $resultats["date_sortie"] ?>
                <?php $timestamp = strtotime($date) ?>
                <?php $date = date("d/m/Y", $timestamp) ?>
                <?= $date ?> </p>
            <p>Pays : <?= $resultats["pays"] ?></p>
        </div>
        <div class="col">
            <h1>
                <?= $resultats["titre"] ?>
            </h1>
            <p>
                <?= $resultats["resume"] ?>
            </p>
        </div>
    </div>
</div>
</body>
</html>
