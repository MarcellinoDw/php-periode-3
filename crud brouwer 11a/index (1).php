<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="wbrouwcodeth=device-wbrouwcodeth, initial-scale=1.0">
    <title>CRUD brouwers</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<td>
    <a href="update.php?brouwcode=<?= $row['brouwcode']; ?>">Wijzigen</a>
    <a href="delete.php?brouwcode=<?= $row['brouwcode']; ?>">Verwijderen</a>
</td>
    <?php
    include 'functions.php';
    crudMain();
    ?>
</body>
</html>
