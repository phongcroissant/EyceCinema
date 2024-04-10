<?php
require_once BASE_PROJET . '/src/config/db-config.php';
function addCommentaire($titreCommentaire, $avisCommentaire, $noteCommentaire, $dateCommentaire, $heureCommentaire, $idUtilisateur, $idFilm): void
{
    $pdo = getConnexion();
    $requete = $pdo->prepare("INSERT INTO commentaires (titre_commentaire, avis_commentaire, note_commentaire, date_commentaire,heure_commentaire,id_utilisateur,id_film) VALUES (?,?,?,?,?,?,?)");
    $requete->bindParam(1, $titreCommentaire);
    $requete->bindParam(2, $avisCommentaire);
    $requete->bindParam(3, $noteCommentaire);
    $requete->bindParam(4, $dateCommentaire);
    $requete->bindParam(5, $heureCommentaire);
    $requete->bindParam(6, $idUtilisateur);
    $requete->bindParam(7, $idFilm);

    $requete->execute();

}

function getCommentairesFromIdFilm(int $idFilm): array
{
    $pdo = getConnexion();
    $requete = $pdo->query("SELECT * FROM commentaires WHERE id_film='$idFilm'ORDER BY date_commentaire DESC,heure_commentaire DESC");
    return $requete->FetchAll(PDO::FETCH_ASSOC);
}

function getAverage(int $idFilm): array
{
    $pdo = getConnexion();
    $requete = $pdo->query("SELECT AVG(note_commentaire) as moyenne FROM commentaires WHERE id_film='$idFilm'");
    return $requete->Fetch(PDO::FETCH_ASSOC);
}