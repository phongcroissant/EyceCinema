<?php
require_once '../../base.php';
require_once BASE_PROJET . '/src/database/film-db.php';
require_once BASE_PROJET . '/src/fonction/fonction.php';
$idFilm = null;
if (isset($_GET["id_film"])) {
    $idFilm = $_GET["id_film"];
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
<?php require_once BASE_PROJET . "/src/_partials/menu.php" ?>
<body>
<?php if ($idFilm) : ?>
    <?php $resultats = getDetails($idFilm) ?>
    <?php foreach ($resultats as $resultat) : ?>
    <?php endforeach ?>
    <?php if ($resultats != null) : ?>
        <div class="container text-center mt-5 border border-light p-3 rounded-2">
            <div class="row">
                <div class="col">
                    <img src=<?= $resultat["image"] ?> alt=''>
                    <p class="mt-5">Date de sortie : <?php $date = $resultat["date_sortie"] ?>
                        <?php $timestamp = strtotime($date) ?>
                        <?php $date = date("d/m/Y", $timestamp) ?>
                        <?= $date ?>
                    </p>
                    <p>Pays : <?= $resultats["pays"] ?></p>
                    <p>Durée : <?= convertirMinutesEnHeures($resultat["duree"]) ?></p>
                </div>
                <div class="col my-auto">
                    <h1 class="mb-4">
                        <?= $resultat["titre"] ?>
                    </h1>
                    <p>
                        <?= $resultat["resume"] ?>
                    </p>
                </div>
            </div>
        </div>
        <div class="container mt-5">
            <h1 class="border-bottom border-3 mb-4">Avis</h1>
        </div>
    <?php else : ?>
        <h1 class="mt-5 p-5 container bg bg-danger text-center">Le film n'existe pas !</h1>
    <?php endif; ?>

<?php else : ?>
    <h1 class="mt-5 p-5 container bg bg-danger text-center">Le film n'existe pas !</h1>
<?php endif; ?>
</body>
</html>
