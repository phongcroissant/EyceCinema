<?php
session_start();
if (empty($_SESSION)) {
    header("location:/");
}
require_once "../../base.php";
require_once BASE_PROJET . "/src/database/film-db.php";
require_once BASE_PROJET . "/src/database/user-db.php";
require_once BASE_PROJET . "/src/database/commentaire-db.php";
require_once(BASE_PROJET . "/src/fonction/fonction.php");
$idFilm = null;
if (isset($_GET["id_film"])) {
    $idFilm = $_GET["id_film"];
}
if (empty($idFilm)) {
    header("Location: erreur.php");
    exit();
}

$pseudo = null;
$idUtilisateur = null;
if (isset($_SESSION["utilisateur"])) {
    $pseudo = $_SESSION["utilisateur"]["pseudo_utilisateur"];
    $idUtilisateur = $_SESSION["utilisateur"]["id_utilisateur"];
}
$resultats = getDetails($idFilm);

// Déterminer si le formulaire a été soumis
// Utilisation d'une variable superglobale $_SERVER
// $_SERVER : tableau associatif contenant des informations sur la requête HTTP
$erreurs = [];
$titreCommentaire = "";
$avisCommentaire = "";
$noteCommentaire = "";
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Le formulaire a été soumis !
    // Traiter les données du formulaire
    // Récupérer les valeurs saisies par l'utilisateur
    // Superglobale $_POST : tableau associatif
    $titreCommentaire = $_POST['titreCommentaire'];
    $avisCommentaire = $_POST['avisCommentaire'];
    $noteCommentaire = $_POST['note'];

    // Validation des données
    if (empty($titreCommentaire)) {
        $erreurs["titreCommentaire"] = "Veuillez saisir un titre";
    }
    if (empty($avisCommentaire)) {
        $erreurs["avisCommentaire"] = "Veuillez émettre un avis";
    }
    if (empty($noteCommentaire)) {
        $erreurs["note"] = "Veuillez saisir une note";
    }
    if ($noteCommentaire < 0 || $noteCommentaire > 5) {
        $erreurs["note"] = "Veuillez saisir une note entre 0 et 5 !";
    }


    // Traiter les données
    if (empty($erreurs)) {
        addCommentaire($titreCommentaire, $avisCommentaire, $noteCommentaire, date("Y-m-d"), date("H:i:s"), $idUtilisateur, $idFilm);
        // Rediriger l'utisateur vers une autre page du site
        header("Location: ../index.php");
        exit();
    }
}
foreach ($resultats as $resultat) {
    $titreFilm = $resultat["titre"];
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="../assets/css/darkly-bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <title>Inscription</title>
</head>
<body>
<?php require_once BASE_PROJET . "/src/_partials/menu.php" ?>
<?php if ($resultats != null) : ?>
    <div class="container justify-content-center">
        <h1 class="text-center mt-5">Donnez un avis !</h1>
        <h3 class="text-center mt-5"><?= $titreFilm ?></h3>
    </div>
    <form action="" method="post" class=" mx-auto w-50 p-5" novalidate>
        <div class="mb-3">
            <label for="titreCommentaire" class="form-label">Titre *</label>
            <input type="text"
                   class="form-control <?= (isset($erreurs["titreCommentaire"])) ? "border border-2 border-danger" : "" ?>"
                   name="titreCommentaire"
                   id="titreCommentaire"
                   value="<?= $titreCommentaire ?>"
                   placeholder="Génial !">
            <?php if (isset($erreurs["titreCommentaire"])): ?>
                <p class="form-text text-danger"><?= $erreurs["titreCommentaire"] ?></p>
            <?php endif; ?>
        </div>
        <div class="mb-3">
            <label for="avisCommentaire" class="form-label">Avis *</label>
            <textarea type="text"
                      class="form-control <?= (isset($erreurs["avisCommentaire"])) ? "border border-2 border-danger" : "" ?>"
                      name="avisCommentaire"
                      id="avisCommentaire"
                      placeholder="Quelque chose comme ça"></textarea>
            <?php if (isset($erreurs["avisCommentaire"])): ?>
                <p class="form-text text-danger"><?= $erreurs["avisCommentaire"] ?></p>
            <?php endif; ?>
        </div>
        <div class="mb-3">
            <label for="note" class="form-label">Note *</label>
            <input type="number"
                   class="form-control <?= (isset($erreurs["note"])) ? "border border-2 border-danger" : "" ?>"
                   name="note"
                   min="0"
                   max="5"
                   id="note"
                   value="0"
                   placeholder="Saisir votre note entre 0 et 5">
            <?php if (isset($erreurs["note"])): ?>
                <p class="form-text text-danger"><?= $erreurs["note"] ?></p>
            <?php endif; ?>
        </div>


        <button type="submit" class="btn btn-primary">Valider</button>
    </form>
<?php else: ?>
    <h1 class="mt-5 p-5 container bg bg-danger text-center">Le film n'existe pas !</h1>
<?php endif; ?>
<script src="../assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>