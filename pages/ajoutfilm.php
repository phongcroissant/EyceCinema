<?php
/**
 * @var PDO $pdo
 */
require("../config/db-config.php");
// Déterminer si le formulaire a été soumis
// Utilisation d'une variable superglobale $_SERVER
// $_SERVER : tableau associatif contenant des informations sur la requête HTTP
$erreurs = [];
$titre = "";
$duree = "";
$resume = "";
$datesortie = "";
$pays = "";
$image = "";
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Le formulaire a été soumis !
    // Traiter les données du formulaire
    // Récupérer les valeurs saisies par l'utilisateur
    // Superglobale $_POST : tableau associatif
    $titre = $_POST['titre'];
    $duree = $_POST['duree'];
    $resume = $_POST['resume'];
    $datesortie = $_POST['date_sortie'];
    $pays = $_POST['pays'];
    $image = $_POST['image'];

    // Validation des données
    if (empty($titre)) {
        $erreurs["titre"] = "Veuillez entrer un titre";
    }
    if (empty($duree)) {
        $erreurs["duree"] = "Veuillez entrer une durée en minute";
    }
    if (empty($resume)) {
        $erreurs["resume"] = "Veuillez entrer un résumé";
    }
    if ($duree <= 0) {
        $erreurs["duree"] = "Veuillez entrer une durée positive";
    }
    if (!filter_var($image, FILTER_VALIDATE_URL)) {
        $erreurs["image"] = "Veuillez entrer une URL valide";
    }
    if (empty($datesortie)) {
        $erreurs["date_sortie"] = "Veuillez entrer une date de sortie";
    }
    if (empty($pays)) {
        $erreurs["pays"] = "Veuillez entrer un pays";
    }
    if (empty($image)) {
        $erreurs["image"] = "Veuillez entrer une image";
    }

    // Traiter les données
    if (empty($erreurs)) {
        $requete = $connexion->prepare("INSERT INTO film (titre,duree,resume,date_sortie,pays,image) VALUES ('$titre','$duree','$resume','$datesortie','$pays','$image')");
        $requete->execute();
        // Rediriger l'utisateur vers une autre page du site
        header("Location: ../index.php");
        exit();
    }
}

?>
<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pâtisserie | Eyce's Croissant</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../assets/css/darkly-bootstrap.min.css">
</head>
<body>
<?php include_once("../menu/menu.php") ?>
<section>
    <div class="container">
        <div class="container justify-content-center">
            <h1 class="text-center mt-5">Ajouter un film</h1>
        </div>
        <form action="" method="post" class=" mx-auto w-50 p-5" novalidate>
            <div class="mb-3">
                <label for="titre" class="form-label">Titre *</label>
                <input type="text"
                       class="form-control <?= (isset($erreurs["titre"])) ? "border border-2 border-danger" : "" ?>"
                       name="titre"
                       id="titre"
                       value="<?= $titre ?>"
                       placeholder="Top Gun">
                <?php if (isset($erreurs["titre"])): ?>
                    <p class="form-text text-danger"><?= $erreurs["titre"] ?></p>
                <?php endif; ?>
            </div>
            <div class="mb-3">
                <label for="duree" class="form-label">Durée *</label>
                <input type="number"
                       class="form-control <?= (isset($erreurs["duree"])) ? "border border-2 border-danger" : "" ?>"
                       name="duree"
                       id="duree"
                       value="<?= $duree ?>"
                       placeholder="120">
                <?php if (isset($erreurs["duree"])): ?>
                    <p class="form-text text-danger"><?= $erreurs["duree"] ?></p>
                <?php endif; ?>
            </div>
            <div class="mb-3">
                <label for="resume" class="form-label">Résumé *</label>
                <input type="text"
                       class="form-control <?= (isset($erreurs["resume"])) ? "border border-2 border-danger" : "" ?>"
                       name="resume"
                       id="resume"
                       value="<?= $resume ?>"
                       placeholder="Quelque chose comme ça">
                <?php if (isset($erreurs["resume"])): ?>
                    <p class="form-text text-danger"><?= $erreurs["resume"] ?></p>
                <?php endif; ?>
            </div>
            <div class="mb-3">
                <label for="date_sortie" class="form-label">Date de sortie *</label>
                <input type="date"
                       class="form-control <?= (isset($erreurs["date_sortie"])) ? "border border-2 border-danger" : "" ?>"
                       name="date_sortie"
                       id="date_sortie"
                       value="<?= $datesortie ?>"
                       placeholder="AAAA-MM-DD">
                <?php if (isset($erreurs["date_sortie"])): ?>
                    <p class="form-text text-danger"><?= $erreurs["date_sortie"] ?></p>
                <?php endif; ?>
            </div>
            <div class="mb-3">
                <label for="pays" class="form-label">Pays *</label>
                <input type="text"
                       class="form-control <?= (isset($erreurs["pays"])) ? "border border-2 border-danger" : "" ?>"
                       name="pays"
                       id="pays"
                       value="<?= $pays ?>"
                       placeholder="France">
                <?php if (isset($erreurs["pays"])): ?>
                    <p class="form-text text-danger"><?= $erreurs["pays"] ?></p>
                <?php endif; ?>
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Lien *</label>
                <input type="text"
                       class="form-control <?= (isset($erreurs["image"])) ? "border border-2 border-danger" : "" ?>"
                       name="image"
                       id="image"
                       value="<?= $pays ?>"
                       placeholder="https://placehold.co/600x400">
                <?php if (isset($erreurs["image"])): ?>
                    <p class="form-text text-danger"><?= $erreurs["image"] ?></p>
                <?php endif; ?>
            </div>

            <button type="submit" class="btn btn-primary">Valider</button>
        </form>
    </div>
</section>
<script src="../assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>


