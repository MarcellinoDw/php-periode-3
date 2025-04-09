// ...existing code...
$queryBrouwers = "SELECT id, naam FROM brouwers";
$resultBrouwers = mysqli_query($conn, $queryBrouwers);

$queryBier = "SELECT * FROM bier WHERE id = " . $_GET['id'];
$resultBier = mysqli_query($conn, $queryBier);
$bier = mysqli_fetch_assoc($resultBier);
// ...existing code...
?>
<form method="post" action="update_handler.php">
    <input type="hidden" name="id" value="<?= $bier['id'] ?>">
    <label for="naam">Naam:</label>
    <input type="text" name="naam" value="<?= $bier['naam'] ?>" required>
    <label for="brouwnaam">Brouwnaam:</label>
    <select name="brouwnaam" required>
        <?php while ($row = mysqli_fetch_assoc($resultBrouwers)) { ?>
            <option value="<?= $row['id'] ?>" <?= $row['id'] == $bier['brouwnaam'] ? 'selected' : '' ?>>
                <?= $row['naam'] ?>
            </option>
        <?php } ?>
    </select>
    <label for="type">Type:</label>
    <input type="text" name="type" value="<?= $bier['type'] ?>" required>
    <label for="alcoholpercentage">Alcoholpercentage:</label>
    <input type="number" step="0.1" name="alcoholpercentage" value="<?= $bier['alcoholpercentage'] ?>" required>
    <button type="submit">Wijzigen</button>
</form>
