<?php
require_once "connexion.php";
$sql = "SELECT id, nom, prenom, age, email, date_creation
        FROM etudiant
        ORDER BY id DESC";
$requete = $pdo->query($sql);
$etudiants = $requete->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Liste des étudiants</title>
</head>

<body>
    <h1>Liste des étudiants enregistrés</h1>

    <p><a href="index.php">Ajouter un étudiant</a></p>

    <table border="1" cellpadding="8">

    <tr>
        <th>ID</th>
        <th>Nom</th>
        <th>Prénom</th>
        <th>Âge</th>
        <th>Email</th>
        <th>Date création</th>
    </tr>
    <?php foreach ($etudiants as $etudiant) { ?><tr>

                <td><?php echo htmlspecialchars($etudiant["id"]);?></td>

                <td><?php echo htmlspecialchars($etudiant["nom"]);?></td>

                <td><?php echo
htmlspecialchars($etudiant["prenom"]); ?></td>
                <td><?php echo htmlspecialchars($etudiant["age"]);?></td>

                <td><?php echo
htmlspecialchars($etudiant["email"]); ?></td>
                <td><?php echo
htmlspecialchars($etudiant["date_creation"]); ?></td>
            </tr>

        <?php } ?>

    </table>
    
</body>
</html>