<?php
include 'database.php';

$sql = "SELECT product.id, merk.name AS merk, type.name AS type, product.naam, product.prijs 
        FROM product 
        JOIN merk ON product.soort_id = merk.id 
        JOIN type ON product.type_id = type.id";
$stmt = $pdo->query($sql);
$fietsen = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Fietsen Beheer</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        h1 {
            text-align: center;
        }
        img {
            display: block;
            margin: 0 auto;
            width: 150px;
        }
        a {
            text-decoration: none;
            color: blue;
        }
        table {
            border-collapse: collapse;
            width: 100%;
            background-color: #ccffcc;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #99cc99;
        }
        td a {
            color: blue;
        }
    </style>
</head>
<body>
    <h1>Fietsen Beheer</h1>
    <img src="fiets.png" alt="Fietsafbeelding">
    <p style="text-align: center;"><a href="toevoegen.php">Fiets toevoegen</a></p>
    <table>
        <tr>
            <th>Merk</th>
            <th>Type</th>
            <th>Naam</th>
            <th>Prijs</th>
            <th>Wijzig</th>
            <th>Verwijderen</th>
        </tr>
        <?php foreach ($fietsen as $fiets): ?>
            <tr>
                <td><?= htmlspecialchars($fiets['merk']) ?></td>
                <td><?= htmlspecialchars($fiets['type']) ?></td>
                <td><?= htmlspecialchars($fiets['naam']) ?></td>
                <td><?= htmlspecialchars($fiets['prijs']) ?></td>
                <td><a href="wijzig.php?id=<?= $fiets['id'] ?>">Wijzig</a></td>
                <td><a href="verwijder.php?id=<?= $fiets['id'] ?>" onclick="return confirm('Weet je zeker dat je deze fiets wilt verwijderen?')">Verwijder</a></td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>