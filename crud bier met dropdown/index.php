$search = isset($_GET['search']) ? trim($_GET['search']) : '';
$query = "SELECT bier.id, bier.naam, brouwers.naam AS brouwer, bier.type, bier.alcoholpercentage 
          FROM bier 
          INNER JOIN brouwers ON bier.brouwnaam = brouwers.id";

if ($search) {
    $query .= " WHERE bier.naam LIKE '%" . mysqli_real_escape_string($conn, $search) . "%'";
}

$result = mysqli_query($conn, $query);
?>
<form method="get" action="">
    <input type="text" name="search" placeholder="Zoek op biernaam" value="<?= htmlspecialchars($search) ?>">
    <button type="submit">Zoeken</button>
</form>

<table>
    <thead>
        <tr>
            <th>Naam</th>
            <th>Brouwer</th>
            <th>Type</th>
            <th>Alcoholpercentage</th>
            <th>Bewerken</th>
            <th>Verwijderen</th>
        </tr>
    </thead>
    <tbody>
        <?php if (mysqli_num_rows($result) > 0): ?>
            <?php while ($row = mysqli_fetch_assoc($result)): ?>
                <tr>
                    <td><?= htmlspecialchars($row['naam']) ?></td>
                    <td><?= htmlspecialchars($row['brouwer']) ?></td>
                    <td><?= htmlspecialchars($row['type']) ?></td>
                    <td><?= number_format($row['alcoholpercentage'], 2) ?>%</td>
                    <td><a href="update.php?id=<?= $row['id'] ?>">Bewerken</a></td>
                    <td><a href="delete.php?id=<?= $row['id'] ?>" onclick="return confirm('Weet je zeker dat je dit bier wilt verwijderen?')">Verwijderen</a></td>
                </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr>
                <td colspan="6">Geen resultaten gevonden.</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>
