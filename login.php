<?php

// Connexion à la base de données
$conn = new mysqli("localhost", "alex", "mairie@123", "mairie");

// Vérifier la connexion
if ($conn->connect_error) {
    die("Erreur de connexion à la base de données : " . $conn->connect_error);
}

// Informations de l'utilisateur à ajouter
$username = "alex";
$password = "mairie@123";

// Hacher le mot de passe
$hashedPassword = password_hash($password, "mairie@123");

// Requête SQL pour ajouter l'utilisateur dans la table des admins
$sql = "INSERT INTO  admins (username, password) VALUES ('$username', '$hashedPassword')";

// Exécution de la requête
if ($conn->query($sql) === TRUE) {
    echo "Utilisateur ajouté avec succès.";
} else {
    echo "Erreur lors de l'ajout de l'utilisateur : " . $conn->error;
}

// Fermer la connexion
$conn->close();
// Connexion à la base de données
$servername = "ftp.cluster011.ovh.net";
$username = "lafertegrd";
$password = "D9mb7R6MQHJX";
$dbname = "mairie";

$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifier la connexion
if ($conn->connect_error) {
    die("Erreur de connexion à la base de données : " . $conn->connect_error);
}
// Nom d'utilisateur et mot de passe à insérer
$username = "alex";
$password = password_hash("mairie@123", PASSWORD_DEFAULT); // Remplacez "votre_mot_de_passe" par le mot de passe réel

// Requête SQL d'insertion
$sql = "INSERT INTO admins (username, password) VALUES ('$username', '$password')";

if ($conn->query($sql) === TRUE) {
    echo "Nouvel administrateur ajouté avec succès.";
} else {
    echo "Erreur lors de l'ajout de l'administrateur : " . $conn->error;
}

// Fermer la connexion à la base de données
$conn->close();
?>