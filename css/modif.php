<!doctype html>
<html>
<head>
<meta charset="utf-8">
<link href="css/cree.css" rel="stylesheet">
<title>Document sans titre</title>
</head>

<body>
   <?php 
		 include 'bdd.php';
	
		$reponse = $bdd->query('SELECT * FROM `utilisateurs` WHERE `id_user` =\'' . $_GET['id'] . '\'');
		while ($donnees = $reponse->fetch()){
	  ?>
	<center><form method="post">
		<input class="inpcree" name="identifiant" placeholder="<?php echo $donnees['Identifiant_user'] ?>"><br>
		<input class="inpcree" name="nom" placeholder="<?php echo $donnees['nom_user'] ?>"><br>
		<input class="inpcree" name="prenom" placeholder="<?php echo $donnees['prenom_user'] ?>"><br>
		<input class="inpcree" name="email" placeholder="<?php echo $donnees['email_user'] ?>" type="email"><br>
		<input class="inpcree" name="mdp" placeholder="<?php echo $donnees['mdp_user'] ?>" type="password"><br>
		<input class="inpcree" name="adresse" placeholder="<?php echo $donnees['adresse_user'] ?>"><br>
		<input class="inpcree" name="ville" placeholder="<?php echo $donnees['ville_user'] ?>"><br>
		<input class="inpcree" name="cp" placeholder="<?php echo $donnees['cp_user'] ?>"><br>
		<input class="inpcree" name="date" placeholder="<?php echo $donnees['date__user'] ?>"><br>
		<SELECT class="role" name="role" size="1">
		    <option class="activesel"> <?php if($donnees['role_id'] == 1){
				$donnees['role_id'] = "Employer";
				}
				if($donnees['role_id'] == 3){
				$donnees['role_id'] = "Comptable";
				}
				if($donnees['role_id'] == 5){
				$donnees['role_id'] = "Admin";
				}
			
		  		echo $donnees['role_id'];
			
		  		if($donnees['role_id'] == "Employer"){
				?><OPTION class="rolesub" value="3">Comptable
				  <OPTION class="rolesub" value="5">Admin<?php
				}
				if($donnees['role_id'] == "Comptable"){
				?><OPTION class="rolesub" value="1">Employer
				  <OPTION class="rolesub" value="5">Admin<?php
				}
				if($donnees['role_id'] == "Admin"){
				?><OPTION class="rolesub" value="1">Employer
			      <OPTION class="rolesub" value="3">Comptable<?php
				} 
					  
			    $reponse->closeCursor();?>
		</SELECT><br>
		<?php } ?>
		<button class="btnadd" type="submit">Ajouter</button>
		<?php
			
		if(isset($_POST['nom']) && isset($_POST['email'])){
			
			
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
			if($role == "Employer"){
				$roles = 5;
			}
			
			echo $roles;
			
	    include 'bdd.php';
			
		$requete=$bdd->prepare('UPDATE `utilisateurs` SET `Identifiant_user`=:identifiant, `nom_user`=:nom, `mdp_user`=:mdp, `email_user`=:email, `role_id`=:role, `adresse_user`=:adresse, `prenom_user`=:prenom, `ville_user`=:ville, `cp_user`=:cp, `date__user`=:date WHERE `id_user`=:id');
			
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
			
		
			
		$requete->execute();
	
	}
		?>
	</form></center>
</body>
</html>