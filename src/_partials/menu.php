<?php
$pseudo = null;
if (isset($_SESSION["utilisateur"])) {
    $pseudo = $_SESSION["utilisateur"]["pseudo_utilisateur"];
}
?>
<nav class="navbar navbar-expand-lg bg-primary mb-3" data-bs-theme="dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="<?php BASE_PROJET ?>/">Eyce's Cinema</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor01"
                aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse me-auto justify-content-end mb-2" id="navbarColor01">
            <ul class="navbar-nav ">
                <?php if ($pseudo): ?>
                    <li class="nav-item">
                        <a class="nav-link active" href="<?php BASE_PROJET ?>/">Accueil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="<?php BASE_PROJET ?>/pages/ajoutfilm.php">Ajouter un film</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link active" href="<?php BASE_PROJET ?>/pages/vosfilms.php">Vos films</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link active" href="<?php BASE_PROJET ?>/pages/logout.php">Se
                            déconnecter</a>
                    </li>
                <?php else : ?>
                    <li class="nav-item">
                        <a class="nav-link active" href="<?php BASE_PROJET ?>/">Accueil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="<?php BASE_PROJET ?>/pages/inscription.php">Inscription</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="<?php BASE_PROJET ?>/pages/connexion.php">Connexion</a>
                    </li>
                <?php endif; ?>
        </div>
    </div>
</nav>