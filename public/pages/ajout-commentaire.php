<?php
session_start();
if (empty($_SESSION)) {
    header("location:/");
}
require_once "../../base.php";
require_once BASE_PROJET . "/src/database/film-db.php";
require_once BASE_PROJET . "/src/database/user-db.php";
require_once(BASE_PROJET . "/src/fonction/fonction.php");
$idFilm = null;
if (isset($_GET["id_film"])) {
    $idFilm = $_GET["id_film"];
}
// Déterminer si le formulaire a été soumis
// Utilisation d'une variable superglobale $_SERVER
// $_SERVER : tableau associatif contenant des informations sur la requête HTTP
$erreurs = [];
$titre = "";
$avis = "";
$note = "";
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Le formulaire a été soumis !
    // Traiter les données du formulaire
    // Récupérer les valeurs saisies par l'utilisateur
    // Superglobale $_POST : tableau associatif
    $titre = $_POST['titre'];
    $avis = $_POST['avis'];
    $note = $_POST['note'];

    // Validation des données
    if (empty($note)) {
        $erreurs["email"] = "Veuillez saisir une adresse mail";
    }
    if (empty($pseudo)) {
        $erreurs["pseudo"] = "Veuillez saisir un pseudo";
    }
    if (empty($password)) {
        $erreurs["password"] = "Veuillez saisir un mot de passe";
    }


    // Traiter les données
    if (empty($erreurs)) {

        // Rediriger l'utisateur vers une autre page du site
        header("Location: ../index.php");
        exit();
    }
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
<div class="container justify-content-center">
    <h1 class="text-center mt-5">Donnez un avis !</h1>
</div>
<form action="" method="post" class=" mx-auto w-50 p-5">
    <div class="mb-3">
        <label for="titre" class="form-label">Titre *</label>
        <input type="text"
               class="form-control <?= (isset($erreurs["titre"])) ? "border border-2 border-danger" : "" ?>"
               name="titre"
               id="titre"
               value="<?= $titre ?>"
               placeholder="Saisir un titre">
        <?php if (isset($erreurs["titre"])): ?>
            <p class="form-text text-danger"><?= $erreurs["titre"] ?></p>
        <?php endif; ?>
    </div>
    <div class="mb-3">
        <label for="avis" class="form-label">Avis *</label>
        <textarea type="text"
                  class="form-control <?= (isset($erreurs["avis"])) ? "border border-2 border-danger" : "" ?>"
                  name="avis"
                  id="avis"
                  placeholder="Quelque chose comme ça"></textarea>
        <?php if (isset($erreurs["avis"])): ?>
            <p class="form-text text-danger"><?= $erreurs["avis"] ?></p>
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
               value="<?= $note ?>"
               placeholder="Saisir votre note entre 0 et 5">
        <?php if (isset($erreurs["note"])): ?>
            <p class="form-text text-danger"><?= $erreurs["note"] ?></p>
        <?php endif; ?>
    </div>


    <button type="submit" class="btn btn-primary">Valider</button>
</form>
<script src="../assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>