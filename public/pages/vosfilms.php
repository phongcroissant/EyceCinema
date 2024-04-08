<?php
session_start();
require_once '../../base.php';
require_once BASE_PROJET . '/src/config/db-config.php';
require_once BASE_PROJET . "/src/database/film-db.php";
require_once BASE_PROJET . "/src/database/user-db.php";
require_once BASE_PROJET . "/src/fonction/fonction.php";
if (empty($_SESSION)) {
    header("location:/");
}
$pseudo = null;
if (isset($_SESSION["pseudo_utilisateur"])) {
    $pseudo = $_SESSION["pseudo_utilisateur"];
}
if (isset($_SESSION["id_utilisateur"])) {
    $id_utilisateur = $_SESSION["id_utilisateur"];
}
$films = getFilmFromId($id_utilisateur);
?>
<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../assets/css/darkly-bootstrap.min.css">
    <title>Document</title>
</head>
<body>
<!--Barre de navigation-->
<?php require_once BASE_PROJET . "/src/_partials/menu.php" ?>
<p>
    <?php if (empty($films)): ?>
    <h1 class="mt-5 p-5 container bg bg-danger text-center">Vous n'avez aucun film !</h1>
<?php else: ?>
<?php if ($pseudo): ?>
    <p class="text-end me-1">Vous êtes connectés en tant que <?= $pseudo ?></p>
<?php endif; ?>
</p>
<div class="mt-5">
    <div class="container mb-5">
        <h1 class="border-bottom border-3 mb-4">Vos films</h1>
        <div class="row">
            <?php foreach ($films as $film): ?>
                <div class="card mx-auto col-lg-3 mb-3 pt-3" style="width: 18rem;">
                    <img src='<?= $film["image"] ?>' alt=''>
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title"><?= $film["titre"] ?></h5>
                        <h5 class="card-title"><?= convertirMinutesEnHeures($film["duree"]) ?></h5>
                        <button class="btn btn-info mt-auto mx-auto"><a
                                    class="text-white link-offset-2 link-underline link-underline-opacity-0"
                                    href="pages/détails.php?id_film=<?= $film["id_film"] ?>">Voir détails</a></button>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <?php require_once BASE_PROJET . "/src/_partials/footer.php" ?>
    <?php endif; ?>
</div>
<script src="./assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>
