<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    // Valideer en ontsmet invoer (bijvoorbeeld via filter_var)
    
    // Hash wachtwoord
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    
    // Voeg gebruiker toe aan de database
    $stmt = $pdo->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
    $stmt->execute([$username, $hashed_password]);
}
?>
