<?php
require_once "connexion.php";
$sql = "SELECT id, nom, prenom, age, email, classe, statut_stage, date_creation
        FROM etudiant
        ORDER BY nom, prenom DESC";
$requete = $pdo->query($sql);
$etudiants = $requete->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Liste des étudiants</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <h1>Liste des étudiants enregistrés</h1>

    <div id="message"></div>

    <p><a href="index.php">Ajouter un étudiant</a></p>

    <table border="1" cellpadding="8">

    <label for="q">Rechercher :</label>
        <input
            type="search"
            id="q"
            name="q"
            placeholder="Nom, prénom ou classe"
            >
        <button type="submit">Rechercher</button>

    <input
        type="search"
        id="rechercheAjax"
        placeholder="Recherche instantanée"
    >

    <div id="resultatsAjax"></div>

    <tr>
        <th>ID</th>
        <th>Nom</th>
        <th>Prénom</th>
        <th>Âge</th>
        <th>Email</th>
        <th>Classe</th>
        <th>Statut stage</th>
        <th>Date création</th>
    </tr>
    <?php foreach ($etudiants as $etudiant) { ?><tr id="etudiant-<?php echo (int) $etudiant["id"]; ?>">

    <?php
        $classeStatut = match ($etudiant["statut_stage"]) {
            "Stage trouvé" => "statut-ok",
            "Entretien obtenu" => "statut-entretien",
            "Candidature envoyée" => "statut-candidature",
            default => "statut-attente"
    };
    ?>

                <td><?php echo htmlspecialchars($etudiant["id"]);?></td>

                <td><?php echo htmlspecialchars($etudiant["nom"]);?></td>

                <td><?php echo htmlspecialchars($etudiant["prenom"]); ?></td>

                <td><?php echo htmlspecialchars($etudiant["age"]);?></td>

                <td><?php echo htmlspecialchars($etudiant["email"]); ?></td>

                <td><?php echo htmlspecialchars($etudiant["classe"],ENT_QUOTES,"UTF-8") ?></td>

                <td>
                <span class="<?php echo $classeStatut; ?>">
                    <?php echo htmlspecialchars($etudiant["statut_stage"], ENT_QUOTES, "UTF-8"); ?>
                </span>
                </td>

                <td><?php echo htmlspecialchars($etudiant["date_creation"]); ?></td>

                <td>
                     <button type="button"
                        class="btn-supprimer"
                        data-id="<?= (int) $etudiant["id"] ?>"> Supprimer
                    </button>
                </td>
            </tr>

        <?php } ?>

    </table>
    <form method="GET" action="recherche.php">
        
    </form>

    <script src="assets/js/liste.js"></script>
    
</body>
</html>