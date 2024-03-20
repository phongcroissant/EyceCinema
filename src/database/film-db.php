<?php
require_once BASE_PROJET . '/src/config/db-config.php';

function getFilms(): array
{
    $pdo = getConnexion();
    $requete = $pdo->prepare("SELECT * FROM film");
    $requete->execute();

    $films = $requete->FetchAll();
    return $films;
}

function getDetails($idFilm): array
{
    $pdo = getConnexion();
    $requete = $pdo->query("SELECT * FROM film WHERE id_film=$idFilm");
    return $requete->FetchAll(PDO::FETCH_ASSOC);

}

function createFilm($titre, $duree, $resume, $datesortie, $pays, $image): void
{
    $pdo = getConnexion();
    $requete = $pdo->prepare("INSERT INTO film (titre,duree,resume,date_sortie,pays,image) VALUES (?,?,?,?,?,?)");
    $requete->bindParam(1, $titre);
    $requete->bindParam(2, $duree);
    $requete->bindParam(3, $resume);
    $requete->bindParam(4, $datesortie);
    $requete->bindParam(5, $pays);
    $requete->bindParam(6, $image);

    $requete->execute();

}

function createAccount($password, $pseudo, $email): void
{
    $pdo = getConnexion();
    $password = password_hash($password, PASSWORD_DEFAULT);
    $requete = $pdo->prepare("INSERT INTO utilisateur (pseudo_utilisateur,email_utilisateur,password) VALUES ('$pseudo','$email','$password')");

    $requete->execute();
}

function verifierSiMailExiste($email)
{
    $pdo = getConnexion();
    $stmt = $pdo->prepare('SELECT count(*)
            FROM `utilisateur`
            WHERE email_utilisateur = :email');
    $stmt->bindValue(':email', $email);
    $stmt->execute();
    $result = (int)$stmt->fetchColumn();
    return $result;
}