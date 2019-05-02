<!doctype html>
<?php 	
session_start();

	if(isset($_SESSION['mdp'])){
		
	}
	else{
		header('Location: login.php');
	}?>
<html>
<head>
<meta charset="utf-8">
<link href="css/cree.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.0/animate.css" rel="stylesheet">
<title>Document sans titre</title>
</head>

<body>
	<center><form method="post" class="animated fadeInDown delay-1s">
		<input class="inpcree" name="identifiant" placeholder="identifiant"><br>
		<input class="inpcree" name="nom" placeholder="nom"><br>
		<input class="inpcree" name="prenom" placeholder="prenom"><br>
		<input class="inpcree" name="email" placeholder="email" type="email"><br>
		<input class="inpcree" name="mdp" placeholder="mot de passe" type="password"><br>
		<input class="inpcree" name="adresse" placeholder="Adresse"><br>
		<input class="inpcree" name="ville" placeholder="Ville"><br>
		<input class="inpcree" name="cp" placeholder="Code postal"><br>
		<input class="inpcree" name="date" placeholder="date d'embauche(jj/mm/aaaa)"><br>
		<SELECT class="role" name="role" size="1">
			<OPTION class="rolesub" value="1">Employer
			<OPTION class="rolesub" value="3">Comptable
			<OPTION class="rolesub" value="5">Admin
		</SELECT><br>
		<button class="btnadd" type="submit">Ajouter</button>
		<?php
			
		if(isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['identifiant']) && isset($_POST['adresse']) && isset($_POST['ville']) && isset($_POST['cp']) && isset($_POST['date']) && isset($_POST['role']) && isset($_POST['email']) && isset($_POST['mdp'])){
	
			$nom = $_POST['nom'];
			$prenom = $_POST['prenom'];
			$identifiant = $_POST['identifiant'];
			$adresse = $_POST['adresse'];
			$ville = $_POST['ville'];
			$cp = $_POST['cp'];
			$date = $_POST['date'];
			$role = $_POST['role'];
			$email = $_POST['email'];	
		    $password = $_POST['mdp'];
			
			
	    include 'bdd.php';
			
		$requete=$bdd->prepare('INSERT INTO `utilisateurs` (`Identifiant_user`, `nom_user`, `mdp_user`, `email_user`, `role_id`, `adresse_user`, `prenom_user`, `ville_user`, `cp_user`, `date__user`) VALUES (:identifiant,:nom,:mdp,:email,:role,:adresse,:prenom,:ville,:cp,:date)');
	
		$requete->bindParam(':identifiant', $identifiant);
		$requete->bindParam(':nom', $nom);
		$requete->bindParam(':mdp', $password);
		$requete->bindParam(':email', $email);
		$requete->bindParam(':role', $role);
		$requete->bindParam(':adresse', $adresse);
		$requete->bindParam(':prenom', $prenom);
		$requete->bindParam(':ville', $ville);
		$requete->bindParam(':cp', $cp);
		$requete->bindParam(':date', $date);
			
		header('Location: comptes.php');
			
		$requete->execute();
	
	}
		?>
	</form></center>
</body>
</html>