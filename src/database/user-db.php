<?php
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

function getAccount(): array
{
    $pdo = getConnexion();
    $requete = $pdo->query("SELECT * FROM utilisateur");
    $requete->execute();
    $comptes = $requete->fetchAll(PDO::FETCH_ASSOC);

    return $comptes;
}

function getPseudoFromId($id_utilisateur): array
{
    $pdo = getConnexion();
    $requete = $pdo->query("SELECT pseudo_utilisateur FROM utilisateur WHERE id_utilisateur LIKE $id_utilisateur");
    $requete->execute();
    $comptes = $requete->fetchAll(PDO::FETCH_ASSOC);

    return $comptes;
}