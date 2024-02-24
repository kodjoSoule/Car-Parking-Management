<?php
include 'header.php';
include 'config.php';

// Fonction pour afficher la liste des véhicules
function displayVehicles()
{
    global $conn;

    $sql = "SELECT * FROM Vehicles";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<table border='1'>
            <tr>
                <th>ID</th>
                <th>Marque</th>
                <th>Modèle</th>
                <th>Kilométrage</th>
                <th>Action</th>
            </tr>";

        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>" . $row["id"] . "</td>
                    <td>" . $row["brand"] . "</td>
                    <td>" . $row["model"] . "</td>
                    <td>" . $row["mileage"] . "</td>
                    <td>
                        <a href='edit_vehicle.php?id=" . $row["id"] . "'>Modifier</a>
                        <a href='delete_vehicle_action.php?id=" . $row["id"] . "' onclick='return confirm(\"Êtes-vous sûr de vouloir supprimer ce véhicule?\")'>Supprimer</a>
                    </td>
                </tr>";
        }

        echo "</table>";
    } else {
        echo "Aucun véhicule trouvé.";
    }
}

?>

<body>
    <h1>Liste des véhicules</h1>

    <!-- Section de recherche -->
    <!-- action current page -->
    <form method="GET" action="
    <?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>
    ">
        <label for="search">Recherche par marque :</label>
        <input type="text" name="search" id="search">
        <button type="submit">Rechercher</button>
    </form>

    <!-- Afficher la liste des véhicules -->
    <?php displayVehicles(); ?>

</body>

<?php include 'footer.php'; ?>