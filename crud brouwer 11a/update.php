<?php
// functie: update brouwer
// auteur: Vul hier je naam in

require_once('functions.php');

// Test of de wijzig-knop is ingedrukt
if (isset($_POST['btn_wzg'])) {
    // Test of update is gelukt
    if (updateRecord($_POST) == true) {
        echo "<script>alert('Brouwer is gewijzigd')</script>";
    } else {
        echo '<script>alert("Brouwer is NIET gewijzigd")</script>';
    }
}

// Test of brouwcode is meegegeven in de URL
if (isset($_GET['brouwcode'])) {  
    $brouwcode = $_GET['brouwcode'];
    $record = getRecord($brouwcode);

    if ($record) {
        $naam = $record['naam'] ?? '';
        $land = $record['land'] ?? '';
    } else {
        die("Geen gegevens gevonden voor deze brouwcode.");
    }
} else {
    die("Geen brouwcode opgegeven");
}
?>

<!DOCTYPE html>
<html lang="nl">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style.css">
  <title>Wijzig Brouwer</title>
</head>
<body>
  <h2>Wijzig Brouwer</h2>
  <form method="POST" action="update.php">
    <input type="hidden" name="brouwcode" value="<?= htmlspecialchars($brouwcode) ?>">

    <label>Naam:</label>
    <input type="text" name="naam" value="<?= htmlspecialchars($naam) ?>" required>
    
    <label>Land:</label>
    <input type="text" name="land" value="<?= htmlspecialchars($land) ?>" required>
    
    <button type="submit" name="btn_wzg">Wijzig</button>
  </form>

  <br><br>
  <a href='index.php'>Home</a>
</body>
</html>
