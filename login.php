<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Login | Gsb</title>
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet">
<link href="css/simple-sidebar.css" rel="stylesheet" type="text/css">
<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.0/animate.css" rel="stylesheet">
</head>

<body class="login animated bounceInDown"><center>
	<div align="center" class="formulair">
		<img width="50%" class="animated zoomIn delay-1s" src="imgs/gsb.png">
		<form method="post">
			<h3 class="animated fadeInUp delay-1s" style="font-size: 23px;margin-top: 15px;">IDENTIFIANT</h3>
			<input class="inputlog animated fadeInUp delay-1s" type="text" name="identifiant"><br>
			<h3 class="animated fadeInUp delay-1s" style="font-size: 23px;">MOT DE PASSE</h3>
			<input class="inputlog animated fadeInUp delay-1s" type="password" name="mdp" style="color: rgba(37,79,116,1.00)"><br>
			<button type="submit" class="btnlog animated fadeInDown delay-1s">connexion</button>
			<?php
			if(isset($_POST['identifiant']) && isset($_POST['mdp'])){
	
      		$identifiant = $_POST['identifiant'];	
			$mdp = $_POST['mdp'];	
				
			include ('bdd.php');
			$requete=$bdd->prepare('SELECT count(*) as compteur FROM `utilisateur` WHERE `pseudo`=:identifiant AND `mdp` =:mdp');
			
			$requete->bindParam(':identifiant', $identifiant);
			$requete->bindParam(':mdp', $mdp);
				
			$requete->execute();
				
			$donnees = $requete->fetch();
				
				
			if ($donnees['compteur'] < 1)	
			{ ?>
			<div text-center style="position: relative; top: -10px">
				<p> <?php echo 'Compte ou Mot de passe faux ou inexistant !';?> </p>
		    </div>
			
			<?php } 
			if ($donnees['compteur'] > 0)
			{ 
				$reponse=$bdd->prepare('SELECT `role_id` FROM `utilisateur` WHERE `pseudo`=:identifiant AND `mdp` =:mdp');
			
				$reponse->bindParam(':identifiant', $identifiant);
				$reponse->bindParam(':mdp', $mdp);
				
				$reponse->execute();
				
				$donnees = $reponse->fetch();
				
				session_start();
				
				$_SESSION['identifiant'] = $_POST['identifiant'];
				$_SESSION['mdp'] = $_POST['mdp'];
				
				if($donnees['role_id'] == 1){
				header('location: index.php');
				}
				
				if($donnees['role_id'] == 2){
				header('location: comptable.php');
				}
				
				if($donnees['role_id'] == 3){
				header('location: comptes.php');
				}
			} 
			
		}
		?>
		</form>
	</div>
	<div class="oublier animated fadeInDown delay-2s">
		<p style="font-size: 18px; color: rgba(162,162,162,1.00);position: relative;top:-5px"><a href="modifUser.php" style="text-decoration: none; color: rgba(162,162,162,1.00)">Mot de passe oublié ?</a></p>
	</div>
</center></body>
</html>


