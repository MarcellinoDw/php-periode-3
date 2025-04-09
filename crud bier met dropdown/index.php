// ...existing code...
$query = "SELECT bier.id, bier.naam, brouwers.naam AS brouwnaam, bier.type, bier.alcoholpercentage 
          FROM bier 
          JOIN brouwers ON bier.brouwnaam = brouwers.id";
$result = mysqli_query($conn, $query);
// ...existing code...
while ($row = mysqli_fetch_assoc($result)) {
    echo "<tr>";
    echo "<td>" . $row['naam'] . "</td>";
    echo "<td>" . $row['brouwnaam'] . "</td>";
    echo "<td>" . $row['type'] . "</td>";
    echo "<td>" . $row['alcoholpercentage'] . "</td>";
    echo "<td><a href='update.php?id=" . $row['id'] . "'>Wijzigen</a></td>";
    echo "<td><a href='delete.php?id=" . $row['id'] . "'>Verwijderen</a></td>";
    echo "</tr>";
}
// ...existing code...
