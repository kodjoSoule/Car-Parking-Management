<?php
include 'header.php';
include 'config.php';

// Initialiser les variables
$addMessage = '';
$addError = '';

// Vérifier si le formulaire d'ajout a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["add"])) {
    // Récupérer les données du formulaire
    $brand = $_POST["brand"];
    $model = $_POST["model"];
    $mileage = $_POST["mileage"];

    // Insérer les nouvelles informations du véhicule dans la base de données
    $insert_sql = "INSERT INTO Vehicles (brand, model, mileage) VALUES ('$brand', '$model', $mileage)";

    if ($conn->query($insert_sql) === TRUE) {
        $addMessage = "Véhicule ajouté avec succès.";
    } else {
        $addError = "Erreur lors de l'ajout du véhicule : " . $conn->error;
    }
}

?>

<body>
    <div class="container">
        <h1>Ajouter un nouveau véhicule</h1>

        <?php
        // Afficher le message de succès ou d'erreur
        if ($addMessage != '') {
            echo '<div class="alert alert-success" role="alert">' . $addMessage . '</div>';
        } elseif ($addError != '') {
            echo '<div class="alert alert-danger" role="alert">' . $addError . '</div>';
        }
        ?>

        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <div class="form-group">
                <label for="brand">Marque :</label>
                <input type="text" class="form-control" id="brand" name="brand" required>
            </div>
            <div class="form-group">
                <label for="model">Modèle :</label>
                <input type="text" class="form-control" id="model" name="model" required>
            </div>
            <div class="form-group">
                <label for="mileage">Kilométrage :</label>
                <input type="number" class="form-control" id="mileage" name="mileage" required>
            </div>
            <button type="submit" name="add" class="btn btn-success">Ajouter</button>
        </form>

        <a href="view_vehicles.php" class="btn btn-secondary mt-3">Retour à la liste des véhicules</a>

</body>

<?php include 'footer.php'; ?>