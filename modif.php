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
   <?php 
		 include 'bdd.php';
	
		$reponse = $bdd->query('SELECT * FROM `utilisateur` WHERE `id` =\'' . $_GET['id'] . '\'');
		while ($donnees = $reponse->fetch()){
	  ?>
	<center><form method="post" class="animated fadeInDown delay-1s">
		<input class="inpcree" name="identifiant" type="text" value="<?php echo $donnees['pseudo'] ?>"><br>
		<input class="inpcree" name="nom" type="text" value="<?php echo $donnees['nom'] ?>"><br>
		<input class="inpcree" name="prenom" type="text" value="<?php echo $donnees['prenom'] ?>"><br>
		<input class="inpcree" name="email" type="text" value="<?php echo $donnees['email'] ?>" type="email"><br>
		<input class="inpcree" name="mdp" value="<?php echo $donnees['mdp'] ?>" type="password"><br>
		<input class="inpcree" name="adresse" type="text" value="<?php echo $donnees['adresse'] ?>"><br>
		<input class="inpcree" name="ville" type="text" value="<?php echo $donnees['ville'] ?>"><br>
		<input class="inpcree" name="cp" type="text" value="<?php echo $donnees['code_postal'] ?>"><br>
		<input class="inpcree" name="date" type="text" value="<?php echo $donnees['date_naissance'] ?>"><br>
		<SELECT class="role" name="role" size="1">
		    <option class="activesel"> <?php 
		        if($donnees['role_id'] == 1){
				$donnees['role_id'] = "Visiteur";
				}
				if($donnees['role_id'] == 2){
				$donnees['role_id'] = "Comptable";
				}
				if($donnees['role_id'] == 3){
				$donnees['role_id'] = "Administrateur";
				}
				echo $donnees['role_id'];
			
		  		if($donnees['role_id'] == "Visiteur"){
				?><OPTION class="rolesub" value="3">Comptable
				  <OPTION class="rolesub" value="5">Admin<?php
				}
				if($donnees['role_id'] == "Comptable"){
				?><OPTION class="rolesub" value="1">Employer
				  <OPTION class="rolesub" value="5">Admin<?php
				}
				if($donnees['role_id'] == "Administrateur"){
				?><OPTION class="rolesub" value="1">Employer
			      <OPTION class="rolesub" value="3">Comptable<?php
				} 
					  
			    $reponse->closeCursor();?>
		</SELECT><br>
		<?php } ?>
		<button class="btnadd" type="submit">Ajouter</button>
		<?php
			
		if(isset($_POST['nom']) || isset($_POST['email']) ){
			
			
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
			$roles = 0;
			
			if($role == "Employer"){
				$roles = 1;
			}
			if($role == "Comptable"){
				$roles = 3;
			}
			if($role == "Admin"){
				$roles = 5;
			}
			if($role == 1){
				$roles = 1;
			}
			if($role == 3){
				$roles = 3;
			}
			
	    include 'bdd.php';
			
		$requete=$bdd->prepare('UPDATE `utilisateur` SET `pseudo`=:identifiant, `nom`=:nom, `mdp`=:mdp, `email`=:email, `role_id`=:role, `adresse`=:adresse, `prenom`=:prenom, `ville`=:ville, `code_postal`=:cp, `date_naissance`=:date WHERE `id`=:id');
			
	    $requete->bindParam(':id', $_GET['id']);
		$requete->bindParam(':identifiant', $identifiant);
		$requete->bindParam(':nom', $nom);
		$requete->bindParam(':mdp', $password);
		$requete->bindParam(':email', $email);
		$requete->bindParam(':role', $roles);
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