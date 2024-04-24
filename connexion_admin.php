<?php

session_start();

// Vérifier si l'administrateur est déjà connecté, rediriger vers la page admin si c'est le cas
if (isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true) {
    header("Location: admin.php");
    exit;
}

// Vérifier si le formulaire de connexion a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Vérifier les identifiants de connexion
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Vérifier les identifiants par rapport à la base de données
    $servername = "localhost";
    $db_username = "root";
    $db_password = "";
    $dbname = "mairie";

    $conn = new mysqli($servername, $db_username, $db_password, $dbname);

    if ($conn->connect_error) {
        die("Erreur de connexion à la base de données : " . $conn->connect_error);
    }

    $sql = "SELECT * FROM admins WHERE username='$username' AND password='$password'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        // Identifiants valides, connecter l'administrateur
        $_SESSION['admin_logged_in'] = true;
        header("Location: admin.php");
        exit;
    } else {
        // Identifiants invalides, afficher un message d'erreur
        $error_message = "Nom d'utilisateur ou mot de passe incorrect.";
    }
}

// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Vérifier si les champs sont vides
    if (empty($_POST["username"]) || empty($_POST["password"])) {
        echo "Veuillez saisir votre nom d'utilisateur et votre mot de passe.";
    } else {
        // Récupérer les identifiants de connexion
        $username = $_POST["username"];
        $password = $_POST["password"];

        // Hasher le mot de passe avec bcrypt
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Vérifier les identifiants de connexion dans la base de données
        // Vous devrez remplacer ces informations par celles de votre propre base de données
        $servername = "localhost";
        $db_username = "root";
        $db_password = "";
        $dbname = "mairie";

        // Créer une connexion à la base de données
        $conn = new mysqli($servername, $db_username, $db_password, $dbname);

        // Vérifier la connexion
        if ($conn->connect_error) {
            die("Erreur de connexion à la base de données : " . $conn->connect_error);
        }
        // Requête SQL pour vérifier les identifiants de l'administrateur
        $sql = "SELECT * FROM admins WHERE username='$username'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // L'administrateur existe dans la base de données
            $row = $result->fetch_assoc();
            // Vérifier le mot de passe hashé
            if (password_verify($password, $row["password"])) {
                // Mot de passe correct, l'administrateur est connecté
                echo "Connexion réussie. Bienvenue, " . $row["username"] . "!";
            } else {
                // Mot de passe incorrect
                echo "Nom d'utilisateur ou mot de passe incorrect.";
            }
        } else {
            // L'administrateur n'existe pas dans la base de données
            echo "Nom d'utilisateur ou mot de passe incorrect.";
        }

        // Fermer la connexion à la base de données
        $conn->close();
    }
}

// Vérifiez si le formulaire de déconnexion est soumis
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["logout"])) {
    // Détruisez la session et redirigez l'utilisateur vers la page de connexion
    session_destroy();
    header("Location: connexion_admin.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion Admin</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }
        form {
            width: 300px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        input[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            border: none;
            border-radius: 4px;
            color: #fff;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <form action="admin.php" method="post">
        <h2>Connexion Admin</h2>
        <?php if (isset($error_message)) : ?>
        <p style="color: red;"><?php echo $error_message; ?></p>
    <?php endif; ?>
        <label for="username">Nom d'utilisateur :</label>
        <input type="text" id="username" name="username" required>
        <label for="password">Mot de passe :</label>
        <input type="password" id="password" name="password" required>
        <input type="submit" value="Se connecter">
    </form>
</body>
</html>


    
   
    