# Projet de Gestion de Parc Automobile

Bienvenue dans l'application web de gestion de parc automobile . Cette application permet à l'entreprise de référencer ses véhicules de luxe, facilitant ainsi la gestion des informations liées à ces véhicules.

## Fonctionnalités

- **Ajout de véhicule :** Permet d'ajouter un nouveau véhicule au parc.
- **Modification de véhicule :** Permet de mettre à jour les informations d'un véhicule existant.
- **Suppression de véhicule :** Permet de retirer un véhicule du parc.
- **Liste des véhicules :** Affiche la liste complète des véhicules avec leurs détails.

## Technologies utilisées

- HTML
- CSS
- PHP
- Bootstrap
- MySQL

## Configuration

1. Assurez-vous d'avoir un serveur PHP et un serveur MySQL configurés.
2. Importez la base de données à partir du fichier SQL fourni dans le dossier "database".

## Comment utiliser

1. Clonez ce dépôt : `git clone git@github.com:kodjoSoule/Car-Parking-Management.git`
2. Placez les fichiers dans le répertoire racine de votre serveur web.
3. Configurez la base de données en utilisant le fichier SQL fourni.
4. Accédez à l'application via votre navigateur.

## Auteur

- Souleymane KODJO

## Licence
<?php
include 'header.php';
?>

<body>
    <div class="container mt-5">
        <h1>Ajouter un véhicule</h1>

        <form method="POST" action="add_vehicle_action.php" enctype="multipart/form-data">
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
            <div class="form-group">
                <label for="image">Image :</label>
                <input type="file" class="form-control-file" id="image" name="image" accept="image/*" required>
            </div>
            <button type="submit" name="add_vehicle" class="btn btn-primary">Ajouter le véhicule</button>
        </form>
    </div>
</body>

<?php include 'footer.php'; ?>


<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["add_vehicle"])) {
    $brand = $_POST["brand"];
    $model = $_POST["model"];
    $mileage = $_POST["mileage"];

    // Gestion du téléchargement d'image en tant que BLOB
    $imageData = file_get_contents($_FILES["image"]["tmp_name"]);

    $stmt = $conn->prepare("INSERT INTO Vehicles (brand, model, mileage, image_data) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssis", $brand, $model, $mileage, $imageData);
    
    if ($stmt->execute()) {
        echo "Véhicule ajouté avec succès.";
    } else {
        echo "Erreur lors de l'ajout du véhicule : " . $conn->error;
    }

    $stmt->close();
    $conn->close();
}
?>

Ce projet est sous licence [MIT License](LICENSE).
