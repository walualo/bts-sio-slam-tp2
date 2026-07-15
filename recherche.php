<?php
require_once "connexion.php";

$recherche = trim($_GET["q"] ?? "");

$resultats = [];

if ($recherche !== "") {
    $sql = "
        SELECT
        id,
        nom,
        prenom,
        classe,
        age,
        statut_stage,
        email
    FROM etudiant
    WHERE nom ILIKE :recherche
        OR prenom ILIKE :recherche
        OR classe ILIKE :recherche
    ORDER BY nom, prenom
";

    $requete = $pdo->prepare($sql);

    $requete->execute([
        "recherche" => "%" . $recherche . "%"
    ]);

    $resultats = $requete->fetchAll(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Liste des résultats</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <h1>Liste des étudiants recherchés</h1>

    <p><a href="liste.php">Retour à la liste</a></p>

    <?php if (empty($resultats)) { ?>
        <p>Aucun étudiant trouvé.</p>
    <?php } else { ?>

        <table border="1" cellpadding="8">

        <tr>
            <th>ID</th>
            <th>Nom</th>
            <th>Prénom</th>
            <th>Age</th>
            <th>Email</th>
            <th>Classe</th>
            <th>Statut stage</th>
        </tr>

        <?php foreach ($resultats as $etudiant) { ?>
            <tr>

            <?php
                $classeStatut = match ($etudiant["statut_stage"]) {
                    "Stage trouvé" => "statut-ok",
                    "Entretien obtenu" => "statut-entretien",
                    "Candidature envoyée" => "statut-candidature",
                    default => "statut-attente"
                };
            ?>

                <td><?php echo htmlspecialchars($etudiant["id"]); ?></td>

                <td><?php echo htmlspecialchars($etudiant["nom"]); ?></td>

                <td><?php echo htmlspecialchars($etudiant["prenom"]); ?></td>

                <td><?php echo htmlspecialchars($etudiant["age"]); ?></td>

                <td><?php echo htmlspecialchars($etudiant["email"]); ?></td>

                <td><?php echo htmlspecialchars($etudiant["classe"], ENT_QUOTES, "UTF-8"); ?></td>

                <td>
                    <span class="<?php echo $classeStatut; ?>">
                        <?php echo htmlspecialchars($etudiant["statut_stage"], ENT_QUOTES, "UTF-8"); ?>
                    </span>
                </td>

            </tr>
        <?php } ?>

        </table>

    <?php } ?>

</body>
</html>