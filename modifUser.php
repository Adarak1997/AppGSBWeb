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
		<form method="post">
			<input class="inputlog animated fadeInUp delay-1s" type="email" placeholder="Adresse mail" name="email"><br>
			<input placeholder="Code postal" class="inputlog animated fadeInUp delay-1s" type="text" name="cp" style="color: rgba(37,79,116,1.00)"><br>
			<button type="submit" name="modif" class="btnlog animated fadeInDown delay-1s">suivant</button>
			<?php
			if(isset($_POST['modif'])){
	
      		$email = $_POST['email'];	
			$cp = $_POST['cp'];	
				
			include ('bdd.php');
			$requete=$bdd->query("SELECT count(*) as compteur FROM `utilisateurs` WHERE email_user = '".$email."'AND cp_user = '".$cp."' ");
			
			$donnees = $requete->fetch();
				
				
			if ($donnees['compteur'] == 0)	
			{ ?>
			<div text-center style="position: relative; top: -10px">
				<p> <?php echo 'email / code postal faux ou inexistant !';?> </p>
		    </div>
			
			<?php } 
			if ($donnees['compteur'] == 1)
			{ 
				
				$requete=$bdd->query("SELECT * FROM `utilisateurs` WHERE email_user = '".$email."'AND cp_user = '".$cp."' ");
			
				$donnees = $requete->fetch();
				
				session_start();
				
				$_SESSION['identifiant'] = $donnees['identifiant_user'];
				$_SESSION['mdp'] = $donnees['mdp_user'];
				
				header("Location: modifMdp.php?id=".$donnees['id_user']);
			} 
			
		}
		?>
		</form>
	</div>
</center></body>
</html>


