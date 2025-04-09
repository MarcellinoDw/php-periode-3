// ...existing code...
$queryBrouwers = "SELECT id, naam FROM brouwers ORDER BY naam ASC";
$resultBrouwers = mysqli_query($conn, $queryBrouwers);

$queryBier = "SELECT * FROM bier WHERE id = " . intval($_GET['id']);
$resultBier = mysqli_query($conn, $queryBier);
$bier = mysqli_fetch_assoc($resultBier);
// ...existing code...
?>
<form method="post" action="update_handler.php" onsubmit="return validateForm()">
    <input type="hidden" name="id" value="<?= $bier['id'] ?>">
    
    <label for="naam">Biernaam:</label>
    <input type="text" name="naam" id="naam" value="<?= htmlspecialchars($bier['naam']) ?>" placeholder="Voer de naam van het bier in" required>
    
    <label for="brouwnaam">Brouwer:</label>
    <select name="brouwnaam" id="brouwnaam" required>
        <option value="">Selecteer een brouwer</option>
        <?php while ($row = mysqli_fetch_assoc($resultBrouwers)) { ?>
            <option value="<?= $row['id'] ?>" <?= $row['id'] == $bier['brouwnaam'] ? 'selected' : '' ?>>
                <?= htmlspecialchars($row['naam']) ?>
            </option>
        <?php } ?>
    </select>
    
    <label for="type">Biertype:</label>
    <input type="text" name="type" id="type" value="<?= htmlspecialchars($bier['type']) ?>" placeholder="Bijv. Lager, Ale" required>
    
    <label for="alcoholpercentage">Alcoholpercentage (%):</label>
    <input type="number" step="0.1" name="alcoholpercentage" id="alcoholpercentage" value="<?= number_format($bier['alcoholpercentage'], 1) ?>" placeholder="Bijv. 5.5" required>
    
    <button type="submit">Bijwerken</button>
    <a href="index.php"><button type="button">Annuleren</button></a>
</form>

<script>
function validateForm() {
    const naam = document.getElementById('naam').value.trim();
    const brouwnaam = document.getElementById('brouwnaam').value;
    const type = document.getElementById('type').value.trim();
    const alcoholpercentage = document.getElementById('alcoholpercentage').value;

    if (!naam || !brouwnaam || !type || !alcoholpercentage) {
        alert('Alle velden zijn verplicht.');
        return false;
    }

    if (alcoholpercentage <= 0) {
        alert('Alcoholpercentage moet groter zijn dan 0.');
        return false;
    }

    return true;
}
</script>
