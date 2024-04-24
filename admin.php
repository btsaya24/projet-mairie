<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page Admin</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        form {
            margin-bottom: 20px;
        }

        input[type="text"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        input[type="submit"] {
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table th,
        table td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: left;
        }

        table th {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Page Admin - Historique des Demandes</h1>
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <input type="text" name="search_term" placeholder="Rechercher par demandeur ou par service">
            <input type="submit" value="Rechercher">
        </form>

        <?php
        // Connexion à la base de données
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "mairie";

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Erreur de connexion à la base de données : " . $conn->connect_error);
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["search_term"])) {
            $search_term = $_POST["search_term"];

            $sql = "SELECT * FROM demandes WHERE demandeur LIKE '%$search_term%' OR service LIKE '%$search_term%'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                echo "<table>";
                echo "<tr><th>Service</th><th>Demandeur</th><th>Matériel</th><th>Marque</th><th>Commentaire</th><th>Téléphone</th><th>Email</th></tr>";
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["service"] . "</td>";
                    echo "<td>" . $row["demandeur"] . "</td>";
                    echo "<td>" . $row["materiel"] . "</td>";
                    echo "<td>" . $row["marque"] . "</td>";
                    echo "<td>" . $row["commentaire"] . "</td>";
                    echo "<td>" . $row["telephone"] . "</td>";
                    echo "<td>" . $row["email"] . "</td>";
                    echo "</tr>";
                }
                echo "</table>";
            } else {
                echo "Aucun résultat trouvé.";
            }
        }
        
        ?>
    </div>
    <div class="link-container">
            <a  href="connexion_admin.php"   class="btn btn-primary">Déconnexion</a>
        </div>
</body>
</html>