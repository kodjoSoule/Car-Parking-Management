<?php
include 'config.php';

// Vérifier si l'ID du véhicule est passé en paramètre
if (isset($_GET['id'])) {
    $vehicle_id = $_GET['id'];

    // Supprimer le véhicule de la base de données
    $delete_sql = "DELETE FROM Vehicles WHERE id = $vehicle_id";
    if ($conn->query($delete_sql) === TRUE) {
        echo "Véhicule supprimé avec succès.";
    } else {
        echo "Erreur lors de la suppression du véhicule : " . $conn->error;
    }
} else {
    echo "ID du véhicule non spécifié.";
}

$conn->close();
