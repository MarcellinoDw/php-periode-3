// ...existing code...
$query = "SELECT id, naam FROM brouwers";
$result = mysqli_query($conn, $query);
// ...existing code...
?>
<form method="post" action="insert_handler.php">
    <label for="naam">Naam:</label>
    <input type="text" name="naam" required>
    <label for="brouwnaam">Brouwnaam:</label>
    <select name="brouwnaam" required>
        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
            <option value="<?= $row['id'] ?>"><?= $row['naam'] ?></option>
        <?php } ?>
    </select>
    <label for="type">Type:</label>
    <input type="text" name="type" required>
    <label for="alcoholpercentage">Alcoholpercentage:</label>
    <input type="number" step="0.1" name="alcoholpercentage" required>
    <button type="submit">Toevoegen</button>
</form>
