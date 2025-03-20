<?php
// Database configuratie
$host = 'localhost';  // database server
$dbname = 'studenten_login';  // database naam
$username = 'root';  // database gebruikersnaam
$password = '';  // database wachtwoord (laat leeg voor lokale server)

try {
    // Maak verbinding met de database via PDO
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    
    // Stel de foutmodus in op uitzonderingen
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // Foutmelding als de verbinding mislukt
    die("Fout bij het verbinden met de database: " . $e->getMessage());
}
?>
