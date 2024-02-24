<?php
include 'header.php';
include 'config.php';

// Initialiser les variables
$updateMessage = '';
$updateError = '';

// Vérifier si l'ID du véhicule est passé en paramètre
if (isset($_GET['id'])) {
    $vehicle_id = $_GET['id'];

    // Récupérer les informations du véhicule depuis la base de données
    $sql = "SELECT * FROM Vehicles WHERE id = $vehicle_id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $vehicle = $result->fetch_assoc();
    } else {
        echo "Aucun véhicule trouvé avec cet ID.";
        include 'footer.php';
        exit();
    }
} else {
    echo "ID du véhicule non spécifié.";
    include 'footer.php';
    exit();
}

// Vérifier si le formulaire de modification a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["update"])) {
    // Récupérer les données du formulaire
    $brand = $_POST["brand"];
    $model = $_POST["model"];
    $mileage = $_POST["mileage"];

    // Mettre à jour les informations du véhicule dans la base de données
    $update_sql = "UPDATE Vehicles SET brand = '$brand', model = '$model', mileage = $mileage WHERE id = $vehicle_id";

    if ($conn->query($update_sql) === TRUE) {
        $updateMessage = "Véhicule mis à jour avec succès.";
    } else {
        $updateError = "Erreur lors de la mise à jour du véhicule : " . $conn->error;
    }
}

?>

<body>
    <div class="container">
        <h1>Modifier le véhicule - ID <?php echo $vehicle['id']; ?></h1>

        <?php
        // Afficher le message de succès ou d'erreur
        if ($updateMessage != '') {
            echo '<div class="alert alert-success" role="alert">' . $updateMessage . '</div>';
        } elseif ($updateError != '') {
            echo '<div class="alert alert-danger" role="alert">' . $updateError . '</div>';
        }
        ?>

        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . "?id=$vehicle_id"); ?>">
            <div class="form-group">
                <label for="brand">Marque :</label>
                <input type="text" class="form-control" id="brand" name="brand" value="<?php echo $vehicle['brand']; ?>" required>
            </div>
            <div class="form-group">
                <label for="model">Modèle :</label>
                <input type="text" class="form-control" id="model" name="model" value="<?php echo $vehicle['model']; ?>" required>
            </div>
            <div class="form-group">
                <label for="mileage">Kilométrage :</label>
                <input type="number" class="form-control" id="mileage" name="mileage" value="<?php echo $vehicle['mileage']; ?>" required>
            </div>
            <button type="submit" name="update" class="btn btn-primary">Mettre à jour</button>
        </form>

        <a href="view_vehicles.php" class="btn btn-secondary mt-3">Retour à la liste des véhicules</a>

</body>

<?php include 'footer.php'; ?>