<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Demande d'intervention</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">

    <style>
        

        body {
             background-color: #f0fff0; /*Light Green (Mint) */


        }
       

        header {
            text-align: center;
            margin-bottom: 40px;
        }

        .logo {
            max-height: 70px;
        }

        form {
            max-width: 600px;
            width: 100%;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            
        }

        label {
            font-size: 16px;
            font-weight: bold;
        }

        select,
        input,
        textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ced4da;
            border-radius: 4px;
        }

        button {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 12px 20px;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }

        .link-container {
            text-align: center;
            margin-top: 20px;
        }
        input[type="text"],
        select,
        textarea {
            background-color: #007bff; /* Bleu */
            color: #fff; /* Couleur du texte en blanc */
            border: none;
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 4px;
        }
 


        a.btn {
            display: inline-block;
            padding: 10px 20px;
            background-color: #007bff; /* Bleu */
            color: #fff;
            text-decoration: none;
            border-radius: 4px;
            transition: background-color 0.3s ease;
        }

        a.btn:hover {
            background-color: #0056b3;
        }


    </style>
</head>

<body>
    <header>
    <img src="/mairie_projet/logo1.gif" alt="Logo" class="logo">
        <h1>Demande d'intervention</h1>
    </header>
 
    <center>         
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
  
    <div class="container">

            <fieldset>
                <legend>Veuillez remplir les informations suivantes:</legend>
                  
                        <!-- Autres options ici... */ -->
                    </select>
                </div>
                   
                <br> </br>
            
<label for="service">Service :</label>
<select name="service" required>
<option selected>Choisissez votre service</option>
<option value="Accueil">Accueil</option>
<option value="Culture">Culture</option>
<option value="Commanderie">Commanderie</option>
<option value="Technique">Technique</option>
<option value="Comptabilité">Comptabilité</option>
<option value="CCAS">CCAS</option>
<option value="Police Municipale">Police Municipale</option>
<option value="Bibliothéque">Bibliothéque</option>
<option value="Administratif">Administratif</option>
<option value="Ecole les Grenouille">Ecole les Grenouille</option>
<option value="Ecole champ de Foire">Ecole champ de Foire</option>
<option value="Ecole du grand Morin">Ecole du grand Morin</option>

</select><br>


    <br></br>

    <label for="demandeur">Demandeur :</label>
    <input type="text" name="demandeur" required>
    <br></br>

    <label for="materiel">Matériel :</label>
    <select name="Marque" required>
    <option selected>Choisissez le matériel</option>
    <option value="Acer">Imprimante</option>
    <option value="HP">Souris</option>
    <option value="Canon">Clavier</option>
    <option value="Toshiba">Fax copieur</option>
    <option value="Toshiba">Ordinateur</option>
    <option value="Toshiba">Réseau</option>
    <option value="Toshiba">Ecran</option>
    <option value="Toshiba">Internet</option>
    <option value="Fujutsu">Autre</option>
    </select>
    <br></br>

    <label for="Marque">Marque :</label>
    <select name="Marque" required>
    <option selected>Choisissez la marque</option>
    <option value="Acer">Acer</option>
    <option value="HP">HP</option>
    <option value="Canon">Canon</option>
    <option value="Toshiba">Toshiba</option>
    <option value="Fujutsu">Fujutsu</option>
    
    </select><br>
    <br></br>

    <label for="commentaire">Commentaire :</label>
    <textarea name="commentaire" required></textarea>
    <br></br>

    <label for="telephone">Numéro de téléphone :</label>
    <input type="tel" name="telephone" required>
    <br></br>

    <label for="email">Adresse e-mail :</label>
    <input type="email" name="email" required>
    <br></br>

                <button type="submit" class="btn btn-primary">Soumettre</button>
            </fieldset>
        </form>

        <div class="link-container">
            <a  href="index1.php"   class="btn btn-primary">Revenir à la page d'accueil</a>
        </div>
    </div>
    </center>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>

</html>


<?php


$servername = "lafertegrdtecinf.mysql.db";  
$username = "lafertegrdtecinf";
$password = "At220860";
$dbname = "lafertegrdtecinf";

$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifie la connexion
if ($conn->connect_error) {
    die("Erreur de connexion à la base de données : " . $conn->connect_error);
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $service = $_POST["service"];
    $demandeur = $_POST["demandeur"];
    $materiel = $_POST["materiel"];
    $commentaire = $_POST["commentaire"];
    $telephone = $_POST["telephone"];
    $email = $_POST["email"];

      // Préparer la requête SQL d'insertion
      $sql = "INSERT INTO demandes_intervention (service, demandeur, materiel, marque, commentaire, telephone, email) VALUES ('$service', '$demandeur', '$materiel', '$marque', '$commentaire', '$telephone', '$email')";

      // Exécuter la requête SQL
      if ($conn->query($sql) === TRUE) {
          echo "La demande a été enregistrée avec succès.";
      } else {
          echo "Erreur lors de l'enregistrement de la demande : " . $conn->error;
      }
  
      // Fermer la connexion à la base de données
      $conn->close();

    // Créer le contenu du PDF
    $pdfContent = "Service: $service\nDemandeur: $demandeur\nMatériel: $materiel\nCommentaire: $commentaire\nTéléphone: $telephone\nEmail: $email";

    // Générer le fichier PDF
    $pdfFilePath = "demande_intervention(01).pdf";
    file_put_contents($pdfFilePath, $pdfContent);


// Configurer les paramètres pour la fonction mail avec SMTP et TLS
    $destinataire = "informatique@la-ferte-gaucher.org , dst@la-ferte-gaucher.org";
    $sujet = "Nouvelle demande d'intervention";
    $message = "Veuillez trouver ci-joint la demande d'intervention en PDF.";
    $headers = "From: $email";
    $headers .= "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";



// Configurer les paramètres pour SMTP
ini_set("SMTP", "smtp.gmail.com");
ini_set("smtp_port", "587");
ini_set("sendmail_from", "ayanaji404@gmail.com"); 


// Configurer les options pour permettre le STARTTLS
$options = "-f ayanaji404@gmail.com"; 

// Utiliser la fonction mail avec les nouvelles configurations
if (mail($destinataire, $sujet, $message, $headers, $options)) {
    echo "L'e-mail a été envoyé avec succès !";
} else {
    echo "Erreur lors de l'envoi de l'e-mail.";
}
    /* Rediriger l'utilisateur vers une page de confirmation*/
headers("Location: confirmation.php");
    exit();
}


?>