<?php
define("PASSWORD", "1234");
define("USER", "laurine");
define("HOST", "localhost");
define("DB_NAME", "sae202_event");

try {
    $bdd = new PDO(
        'mysql:host=' . HOST . ';dbname=' . DB_NAME . ';charset=utf8',
        USER,
        PASSWORD,
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    );
} catch (PDOException $e) {
    die('Erreur de connexion BDD : ' . $e->getMessage());
}