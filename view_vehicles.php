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
        echo '<table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Marque</th>
                    <th>Modèle</th>
                    <th>Kilométrage</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>';

        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>{$row['id']}</td>
                    <td>{$row['brand']}</td>
                    <td>{$row['model']}</td>
                    <td>{$row['mileage']}</td>
                    <td>
                        <a href='edit_vehicle.php?id={$row['id']}' class='btn btn-primary'>Modifier</a>
                        <a href='delete_vehicle_action.php?id={$row['id']}' onclick='return confirm(\"Êtes-vous sûr de vouloir supprimer ce véhicule?\")' class='btn btn-danger'>Supprimer</a>
                    </td>
                </tr>";
        }

        echo "</tbody></table>";
    } else {
        echo "Aucun véhicule trouvé.";
    }
}

$search = '';

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    // $search = trim($_GET["search"]);
}

?>

<body>
    <h1>Liste des véhicules</h1>

    <!-- Section de recherche -->
    <form method="GET" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <div class="input-group mb-3">
            <input type="text" name="search" id="search" class="form-control" placeholder="Recherche par marque" value="<?php echo htmlspecialchars($search); ?>">
            <div class="input-group-append">
                <button type="submit" class="btn btn-outline-secondary">Rechercher</button>
            </div>
        </div>
    </form>

    <!-- Afficher la liste des véhicules -->
    <?php displayVehicles(); ?>

</body>

<?php include 'footer.php'; ?>