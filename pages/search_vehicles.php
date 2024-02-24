<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $search = $_GET["search"];

    // Échapper les caractères spéciaux pour éviter les attaques SQL
    $search = mysqli_real_escape_string($conn, $search);

    $sql = "SELECT * FROM Vehicles WHERE brand LIKE '%$search%'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<h2>Résultats de la recherche :</h2>";
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
        echo "Aucun résultat trouvé.";
    }
}
