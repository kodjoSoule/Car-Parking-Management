-- schema.sql
-- Creation de base de donnes
CREATE DATABASE IF NOT EXISTS `db_car_park_auto` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
-- Création de la table "Vehicles"
CREATE TABLE Vehicles (
    id INT AUTO_INCREMENT PRIMARY KEY,
    brand VARCHAR(255) NOT NULL,
    model VARCHAR(255) NOT NULL,
    mileage INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);
