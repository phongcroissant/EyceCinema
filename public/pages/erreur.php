<?php
session_start();
require_once "../../base.php";
?>
<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../assets/css/darkly-bootstrap.min.css">
    <title>Erreur</title>
</head>
<?php require_once BASE_PROJET . "/src/_partials/menu.php" ?>
<body>
<h1 class="mt-5 p-5 container bg bg-danger text-center">Le film n'existe pas !</h1>
</body>
</html>
