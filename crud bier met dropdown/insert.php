<?php
$query = "SELECT id, naam FROM brouwers ORDER BY naam ASC";
$result = mysqli_query($conn, $query);
?>
<form method="post" action="insert_handler.php" onsubmit="return validateForm()">
    <label for="naam">Biernaam:</label>
    <input type="text" name="naam" id="naam" placeholder="Voer de naam van het bier in" required>
    
    <label for="brouwnaam">Brouwer:</label>
    <select name="brouwnaam" id="brouwnaam" required>
        <option value="">Selecteer een brouwer</option>
        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
            <option value="<?= $row['id'] ?>"><?= htmlspecialchars($row['naam']) ?></option>
        <?php } ?>
    </select>
    
    <label for="type">Biertype:</label>
    <input type="text" name="type" id="type" placeholder="Bijv. Lager, Ale" required>
    
    <label for="alcoholpercentage">Alcoholpercentage (%):</label>
    <input type="number" step="0.1" name="alcoholpercentage" id="alcoholpercentage" placeholder="Bijv. 5.5" required>
    
    <button type="submit">Opslaan</button>
    <button type="reset">Reset</button>
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
