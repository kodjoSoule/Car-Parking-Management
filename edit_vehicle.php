<?php
include 'header.php';
include 'config.php';

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
        echo "Véhicule mis à jour avec succès.";
    } else {
        echo "Erreur lors de la mise à jour du véhicule : " . $conn->error;
    }
}

?>

<body>
    <h1>Modifier le véhicule - ID <?php echo $vehicle['id']; ?></h1>

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

</body>

<?php include 'footer.php'; ?>