<?php
include 'config.php';

// Initialiser les variables
$deleteMessage = '';
$deleteError = '';

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

// Vérifier si la suppression a été confirmée
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["confirm_delete"])) {
    // Supprimer le véhicule de la base de données
    $delete_sql = "DELETE FROM Vehicles WHERE id = $vehicle_id";
    if ($conn->query($delete_sql) === TRUE) {
        $deleteMessage = "Véhicule supprimé avec succès.";
    } else {
        $deleteError = "Erreur lors de la suppression du véhicule : " . $conn->error;
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <title>Supprimer le véhicule - ID <?php echo $vehicle['id']; ?></title>
</head>

<body class="container mt-5">

    <h1 class="mb-4">Supprimer le véhicule - ID <?php echo $vehicle['id']; ?></h1>

    <?php
    // Afficher le message de succès ou d'erreur
    if ($deleteMessage != '') {
        echo '<div class="alert alert-success" role="alert">' . $deleteMessage . '</div>';
    } elseif ($deleteError != '') {
        echo '<div class="alert alert-danger" role="alert">' . $deleteError . '</div>';
    }
    ?>

    <p>Voulez-vous vraiment supprimer le véhicule <?php echo $vehicle['brand'] . ' ' . $vehicle['model']; ?> ?</p>

    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . "?id=$vehicle_id"); ?>">
        <?php
        //cacher ca une fois que la suppression est confirmée
        if ($deleteMessage == '' && $deleteError == '')
            echo '<button type="submit" name="confirm_delete" class="btn btn-danger">Confirmer la suppression</button>';


        ?>
        <a href="view_vehicles.php" class="btn btn-secondary">Retour à la liste des véhicules</a>
    </form>

</body>

</html>