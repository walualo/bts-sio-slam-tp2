<?php


$nom = $_POST["nom"] ?? "";
$prenom = $_POST["prenom"] ?? "";
$age = $_POST["age"] ?? "";
$email = $_POST["email"] ?? "";
$classe = trim($_POST["classe"] ?? "");
$statutStage = trim($_POST["statut_stage"] ?? "");

$erreurs = [];


if (empty($nom)) {
    $erreurs[] = "Le nom est obligatoire.";
}

if (empty($prenom)) {
    $erreurs[] = "Le prénom est obligatoire.";
}

if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $erreurs[] = "L'adresse email n'est pas valide.";
}

if (!is_numeric($age)) {
    $erreurs[] = "L'âge doit être un nombre.";
} elseif ($age < 16) {
    $erreurs[] = "L'étudiant(e) doit avoir au moins 16 ans.";
}

$avertissements = [];
if (is_numeric($age) && $age > 65) {
    $avertissements[] = "Vérifiez l'âge saisi avant de poursuivre l'enregistrement.";
}

$classesAutorisees = ["SIO1", "SIO2"];
$statutsAutorises = [
    "Non commencé",
    "En recherche",
    "Candidature envoyée",
    "Entretien obtenu",
    "Stage trouvé"
];

if (!in_array($classe, $classesAutorisees, true)) {
    $erreurs[] = "La classe sélectionnée est incorrecte.";
}

if (!in_array($statutStage, $statutsAutorises, true)) {
    $erreurs[] = "Le statut de stage est incorrect.";
}


require_once "connexion.php";

$sqlVerification = "
    SELECT id
    FROM etudiant
    WHERE email = :email
";

$requeteVerification = $pdo->prepare($sqlVerification);
$requeteVerification->execute([
    "email" => $email
]);
$etudiantExistant = $requeteVerification->fetch();
if ($etudiantExistant) {
    $erreurs[] = "Un étudiant possède déjà cette adresse électronique.";
}

?>

<!DOCTYPE html>
<html lang="fr">

<head>
<meta charset="UTF-8">
<title>Traitement</title>
</head>

<body>

<?php if (!empty($erreurs)) { ?>
    <h1>Erreur dans le formulaire</h1>
    <ul>
    <?php foreach ($erreurs as $erreur) { ?>
    <li><?php echo $erreur; ?></li>
    <?php } ?>
    </ul>
    <p><a href="index.php">Retour au formulaire</a></p>

<?php } else { ?>
    <h1>Données reçues</h1>
    <p>Nom : <?php echo htmlspecialchars($nom); ?></p>
    <p>Prénom : <?php echo htmlspecialchars($prenom); ?></p>
    <p>Âge : <?php echo htmlspecialchars($age); ?></p>
    <p>Email : <?php echo htmlspecialchars($email); ?></p>
    <p>Classe : <?php echo htmlspecialchars($classe); ?></p>
    <p>Statut stage : <?php echo htmlspecialchars($statutStage); ?></p>

    <?php

    $sql = "
        INSERT INTO etudiant (
            nom, prenom, age, email, classe, statut_stage
        )
        VALUES (
            :nom, :prenom, :age, :email, :classe, :statut_stage
        )
    ";

    $requete = $pdo->prepare($sql);

    $requete->execute([
        "nom" => $nom,
        "prenom" => $prenom,
        "age" => $age,
        "email" => $email,
        "classe" => $classe,
        "statut_stage" => $statutStage
    ]);
    ?>

<?php } ?>

<p><a href="liste.php">Voir les étudiants enregistrés</a></p>

</body>
</html>