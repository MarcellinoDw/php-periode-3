<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "poll_database";

try {
    // Create PDO connection
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // Set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

// Process form submission
if (isset($_POST['submit'])) {
    if (isset($_POST['optie'])) {
        $optie_id = $_POST['optie'];
        
        try {
            // Update the vote count
            $sql = "UPDATE optie SET stemmen = stemmen + 1 WHERE id = :id";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':id', $optie_id, PDO::PARAM_INT);
            $stmt->execute();
            
            echo "<div style='color: green; margin-bottom: 10px;'>Bedankt voor je stem!</div>";
        } catch(PDOException $e) {
            echo "<div style='color: red; margin-bottom: 10px;'>Error: " . $e->getMessage() . "</div>";
        }
    }
}

// Get poll question
try {
    $stmt = $conn->query("SELECT * FROM poll WHERE id = 1");
    $poll = $stmt->fetch(PDO::FETCH_ASSOC);
} catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Poll</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            max-width: 800px;
            margin: 0 auto;
        }
        h2 {
            color: #333;
        }
        form {
            margin-top: 20px;
            margin-bottom: 30px;
            padding: 15px;
            background-color: #f9f9f9;
            border-radius: 5px;
        }
        .option {
            margin: 10px 0;
        }
        input[type="submit"] {
            margin-top: 15px;
            padding: 5px 15px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
        .results {
            margin-top: 30px;
            border-top: 1px solid #ccc;
            padding-top: 15px;
            background-color: #f5f5f5;
            padding: 15px;
            border-radius: 5px;
        }
        .result-bar {
            height: 25px;
            background-color: #4CAF50;
            margin: 5px 0;
            border-radius: 3px;
        }
        .result-item {
            margin-bottom: 15px;
        }
        .percentage {
            display: inline-block;
            width: 50px;
        }
        h3 {
            color: #444;
            margin-top: 0;
        }
    </style>
</head>
<body>
    <h2>Stelling van de maand: "<?php echo $poll['vraag']; ?>"</h2>
    
    <form method="post" action="">
        <?php
        try {
            // Get poll options
            $stmt = $conn->query("SELECT * FROM optie WHERE poll = 1");
            
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo '<div class="option">';
                echo '<input type="radio" name="optie" id="optie' . $row['id'] . '" value="' . $row['id'] . '">';
                echo '<label for="optie' . $row['id'] . '"> ' . $row['optie'] . '</label>';
                echo '</div>';
            }
        } catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        ?>
        <input type="submit" name="submit" value="Verzenden">
    </form>

    <div class="results">
        <h3>Resultaten</h3>
        <?php
        try {
            // Calculate total votes
            $total_query = $conn->query("SELECT SUM(stemmen) as total FROM optie WHERE poll = 1");
            $total_result = $total_query->fetch(PDO::FETCH_ASSOC);
            $total_votes = $total_result['total'];
            
            if ($total_votes > 0) {
                // Get poll options with votes
                $stmt = $conn->query("SELECT * FROM optie WHERE poll = 1 ORDER BY stemmen DESC");
                
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $percentage = ($total_votes > 0) ? round(($row['stemmen'] / $total_votes) * 100) : 0;
                    $width = $percentage;
                    
                    echo '<div class="result-item">';
                    echo '<strong>' . $row['optie'] . '</strong> (' . $row['stemmen'] . ' stemmen)<br>';
                    echo '<div class="percentage">' . $percentage . '%</div> ';
                    echo '<div class="result-bar" style="width: ' . $width . '%"></div>';
                    echo '</div>';
                }
                
                echo '<p><strong>Totaal aantal stemmen: ' . $total_votes . '</strong></p>';
            } else {
                echo '<p>Nog geen stemmen uitgebracht.</p>';
            }
        } catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        ?>
    </div>
</body>
</html>

<?php
// Close connection by setting it to null
$conn = null;
?>