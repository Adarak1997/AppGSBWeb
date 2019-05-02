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
	  ?>
	<center><form method="post" class="animated fadeInDown delay-1s">
		<input class="inpcree" name="mdp" placeholder="Nouveau mot de passe" type="password"><br>
		<button class="btnadd" name="modif" type="submit">Ajouter</button>
		<?php	
		if(isset($_POST['modif'])){
			
		    $password = $_POST['mdp'];
			
	    include 'bdd.php';
			
			
		$sqp = $bdd->query("UPDATE `utilisateurs` SET `mdp_user`= '".$password."' WHERE id_user = '".$_GET['id']."' ");
		
			
			session_start();
			session_destroy();
			header('location: login.php');
			exit;
		}
		?>
	</form></center>
</body>
</html>