<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<title>Inscription étudiant</title>
</head>
<body>

	<h1>Inscription étudiant</h1>
	<form method="POST" action="traitement.php">
		<label> Nom :</label>
		<input type="text" name="nom">

		<br><br>

		<label>Prénom :</label>
		<input type="text" name="prenom">

		<br><br>

		<label>Âge :</label>
		<input type="number" name="age">

		<br><br>

		<label>Email :</label>
		<input type="email" name="email">

		<br><br>

<label for="classe">Classe :</label>

	<select name="classe" id="classe" required>
		<option value="">-- Choisir une classe --</option>
		<option value="SIO1">SIO1</option>
		<option value="SIO2">SIO2</option>
	</select>

	<label for="statut_stage">Situation de stage :</label>

	<select name="statut_stage" id="statut_stage" required>
		<option value="">-- Choisir un statut --</option>
		<option value="Non commencé">Non commencé</option>
		<option value="En recherche">En recherche</option>
		<option value="Candidature envoyée">Candidature envoyée</option>
		<option value="Entretien obtenu">Entretien obtenu</option>
		<option value="Stage trouvé">Stage trouvé</option>
	</select>

		<button type="submit">Envoyer</button>
	</form>

	<p><a href="liste.php">Voir la liste des étudiants</a></p>

	

</body>
</html>
