<?php
const DB_HOST = "localhost:3306";
const DB_NAME = "db_cinema";
const DB_USER = "root";
const DB_PASSWORD = "";

// Utiliser PDO pour créer une connexion à la DB
function getConnexion(): PDO
{
    $pdo = new PDO(
        "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASSWORD
    );
// Activer les erreurs PDO
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $pdo;
}