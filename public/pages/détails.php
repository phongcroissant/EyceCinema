<?php
session_start();
require_once '../../base.php';
require_once BASE_PROJET . '/src/database/film-db.php';
require_once BASE_PROJET . '/src/database/user-db.php';
require_once BASE_PROJET . '/src/database/commentaire-db.php';
require_once BASE_PROJET . '/src/fonction/fonction.php';
$idFilm = null;
if (isset($_GET["id_film"])) {
    $idFilm = $_GET["id_film"];
}
$pseudo = null;
$idUtilisateur = null;
if (isset($_SESSION["utilisateur"])) {
    $pseudo = $_SESSION["utilisateur"]["pseudo_utilisateur"];
    $idUtilisateur = $_SESSION["utilisateur"]["id_utilisateur"];
}
$resultats = getDetails($idFilm);
foreach ($resultats as $resultat) {
    $getPseudoFromId = getPseudoFromId($resultat["id_utilisateur"]);
}
$commentaires = getCommentairesFromIdFilm($idFilm);
$moyenne = getAverage($idFilm);
print_r($moyenne)
?>
<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../assets/css/darkly-bootstrap.min.css">
    <title><?= $resultat["titre"] ?></title>
</head>
<?php require_once BASE_PROJET . "/src/_partials/menu.php" ?>
<body>
<p>
    <?php if ($pseudo): ?>
<p class="text-end me-1">Vous êtes connectés en tant que <?= $pseudo ?></p>
<?php endif; ?>
</p>
<?php if ($idFilm) : ?>

    <?php if ($resultats != null) : ?>
        <div class="container text-center mt-5 border border-light p-3 rounded-2">
            <div class="row">
                <div class="col-md-6 my-auto">
                    <h1 class="mb-4">
                        <?= $resultat["titre"] ?>
                    </h1>
                    <p>
                        <?= $resultat["resume"] ?>
                    </p>

                </div>
                <div class="col-md-6 my-auto">
                    <img class="w-100 d-md-block d-none" src=<?= $resultat["image"] ?>>
                    <p>Moyenne : <?= $moyenne ?></p>
                    <p class="mt-5">Date de sortie : <?php $date = $resultat["date_sortie"] ?>
                        <?php $timestamp = strtotime($date) ?>
                        <?php $date = date("d/m/Y", $timestamp) ?>
                        <?= $date ?>
                    </p>
                    <p>Pays : <?= $resultat["pays"] ?></p>
                    <p>Durée : <?= convertirMinutesEnHeures($resultat["duree"]) ?></p>
                    <p>Ajouté par : <?= $getPseudoFromId[0]["pseudo_utilisateur"]; ?></p>
                </div>
            </div>
        </div>
        <div class="container border-3 my-5">
            <div class="border-bottom row">
                <h1 class="col">Avis</h1>
                <div class="col-7">

                </div>
                <a
                        class="col btn-sm btn btn-info my-auto text-white"
                        href="ajout-commentaire.php?id_film=<?= $resultat["id_film"] ?>">
                    Ajouter un commentaire
                </a>
            </div>
            <?php if (empty($commentaires)) : ?>
                <a href="ajout-commentaire.php?id_film=<?= $resultat["id_film"] ?>"
                   class="fs-5 text-center mb-2 nav-link p-0 mt-3">Il n'y a aucun avis, soyez le
                    premier à en mettre un !</a>
            <?php else : ?>
                <?php foreach ($commentaires as $commentaire): ?>
                    <ul class="container list-group my-5">
                        <h2>
                            <?= $commentaire["titre_commentaire"] ?>
                        </h2>
                        <div class="fs-4">
                            <?= $commentaire["note_commentaire"] ?>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                 class="bi bi-star-fill" viewBox="0 0 16 16">
                                <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                            </svg>
                        </div>
                        <p>
                            <?= $commentaire["avis_commentaire"] ?>
                        </p>
                        <p>
                            Posté par <?= $getPseudoFromId[0]["pseudo_utilisateur"] ?>
                            le <?= $commentaire["date_commentaire"] ?>
                        </p>
                    </ul>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    <?php else : ?>
        <h1 class="mt-5 p-5 container bg bg-danger text-center">Le film n'existe pas !</h1>
    <?php endif; ?>
<?php else : ?>
    <h1 class="mt-5 p-5 container bg bg-danger text-center">Le film n'existe pas !</h1>
<?php endif; ?>
</body>
</html>
