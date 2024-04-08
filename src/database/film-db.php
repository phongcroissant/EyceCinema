<?php
require_once BASE_PROJET . '/src/config/db-config.php';

function getFilms(): array
{
    $pdo = getConnexion();
    $requete = $pdo->prepare("SELECT * 
FROM `film`
");
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

function createFilm($titre, $duree, $resume, $datesortie, $pays, $image, $idUtilisateur): void
{
    $pdo = getConnexion();
    $requete = $pdo->prepare("INSERT INTO film (titre,duree,resume,date_sortie,pays,image,id_utilisateur) VALUES (?,?,?,?,?,?,?)");
    $requete->bindParam(1, $titre);
    $requete->bindParam(2, $duree);
    $requete->bindParam(3, $resume);
    $requete->bindParam(4, $datesortie);
    $requete->bindParam(5, $pays);
    $requete->bindParam(6, $image);
    $requete->bindParam(7, $idUtilisateur);

    $requete->execute();

}

function getFilmFromId($id_utilisateur): array
{
    $pdo = getConnexion();
    $requete = $pdo->query("SELECT * FROM film WHERE id_utilisateur LIKE $id_utilisateur");
    $requete->execute();
    $film = $requete->fetchAll(PDO::FETCH_ASSOC);

    return $film;
}

