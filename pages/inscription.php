<?php
/**
 * @var PDO $connexion
 */
require("../config/db-config.php");
// Déterminer si le formulaire a été soumis
// Utilisation d'une variable superglobale $_SERVER
// $_SERVER : tableau associatif contenant des informations sur la requête HTTP
$erreurs = [];
$pseudo = "";
$email = "";
$password = "";
$confirmPassword = "";
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Le formulaire a été soumis !
    // Traiter les données du formulaire
    // Récupérer les valeurs saisies par l'utilisateur
    // Superglobale $_POST : tableau associatif
    $pseudo = $_POST['pseudo'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmpassword'];
    $email = $_POST['email'];

    // Validation des données
    if (empty($email)) {
        $erreurs["email"] = "Veuillez saisir une adresse mail";
    }
    if (empty($pseudo)) {
        $erreurs["pseudo"] = "Veuillez saisir un pseudo";
    }
    if ($password != $confirmPassword) {
        $erreurs["confirmpassword"] = "Veuillez saisir le même mot de passe";
    }
    if (empty($password)) {
        $erreurs["password"] = "Veuillez saisir un mot de passe";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $erreurs["email"] = "Veuillez saisir une adresse mail valide";
    }

    // Traiter les données
    if (empty($erreurs)) {
        $password = password_hash($password, PASSWORD_DEFAULT);
        $requete = $connexion->prepare("INSERT INTO utilisateur (pseudo_utilisateur,email_utilisateur,password) VALUES ('$pseudo','$email','$password')");

        $requete->execute();
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
<?php include_once("../menu/menu.php") ?>
<div class="container justify-content-center">
    <h1 class="text-center mt-5">Inscription</h1>
</div>
<form action="" method="post" class=" mx-auto w-50 p-5" novalidate>
    <div class="mb-3">
        <label for="pseudo" class="form-label"><p>Pseudo *</p></label>
        <input type="text"
               class="form-control <?= (isset($erreurs["pseudo"])) ? "border border-2 border-danger" : "" ?>"
               name="pseudo"
               id="pseudo"
               value="<?= $pseudo ?>"
               placeholder="Antoine">
        <?php if (isset($erreurs["pseudo"])): ?>
            <p class="form-text text-danger"><?= $erreurs["pseudo"] ?></p>
        <?php endif; ?>
    </div>
    <div class="mb-3">
        <label for="Email" class="form-label">Email *</label>
        <input type="email"
               class="form-control <?= (isset($erreurs["email"])) ? "border border-2 border-danger" : "" ?>"
               name="email"
               id="Email"
               value="<?= $email ?>"
               placeholder="AntoineLaTaupe@gmail.com"
               aria-describedby="emailHelp">
        <?php if (isset($erreurs["email"])): ?>
            <p class="form-text text-danger"><?= $erreurs["email"] ?></p>
        <?php endif; ?>
        <div id="emailHelp" class="form-text">Nous ne divulgurons jamais votre adresse email</div>
    </div>
    <div class="mb-3">
        <label for="password" class="form-label">Mot de passe *</label>
        <input type="password"
               class="form-control <?= (isset($erreurs["password"])) ? "border border-2 border-danger" : "" ?>"
               name="password"
               id="password"
               value="<?= $password ?>"
               placeholder="Mot de passe">
        <?php if (isset($erreurs["password"])): ?>
            <p class="form-text text-danger"><?= $erreurs["password"] ?></p>
        <?php endif; ?>
    </div>
    <div class="mb-3">
        <label for="confirmpassword" class="form-label">Confirmation mot de passe *</label>
        <input type="password"
               class="form-control <?= (isset($erreurs["confirmpassword"])) ? "border border-2 border-danger" : "" ?>"
               name="confirmpassword"
               id="confirmpassword"
               value="<?= $confirmPassword ?>"
               placeholder="Confirmer votre mot de passe">
        <?php if (isset($erreurs["confirmpassword"])): ?>
            <p class="form-text text-danger"><?= $erreurs["confirmpassword"] ?></p>
        <?php endif; ?>
    </div>


    <button type="submit" class="btn btn-primary">Valider</button>
</form>
<script src="../assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>