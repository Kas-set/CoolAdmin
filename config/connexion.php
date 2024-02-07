<?php

// Connexion à la base de données
$servername = "localhost";
$username = "godwin";
$password = "";
$dbname = "web tp";

// Créer une connexion
$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifier la connexion
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
?>