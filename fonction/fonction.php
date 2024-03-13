<?php
function convertirMinutesEnHeures($duree)
{
    if ($duree < 60) {
        return $duree . "m";
    } else {
        $heures = floor($duree / 60);
        $minutes = $duree % 60;
        if ($minutes < 10) {
            return ($heures . "h0" . $minutes);
        } else {
            return ($heures . "h" . $minutes);
        }

    }

}

function verifierSiMailExiste($connexion, $email)
{
    $stmt = $connexion->prepare('SELECT count(*)
            FROM `utilisateur`
            WHERE email_utilisateur = :email');
    $stmt->bindValue(':email', $email);
    $stmt->execute();
    $result = (int)$stmt->fetchColumn();
    return $result;
}

function estSolide($password)
{
    return preg_match('/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9]).{8,14}$/', $password);
}