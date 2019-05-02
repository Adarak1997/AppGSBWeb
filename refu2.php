<head>

<meta http-equiv="refresh" content="1.2 ; url=comptable.php">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.0/animate.min.css">		
	
</head>

<body style="background: rgba(64,115,158,1.00)" class="animated zoomOut delay-1s">
	
	<center><i class="fas fa-check animated zoomIn" style="font-size: 100px;color: white;margin-top: 300px"></i></center>
	
</body>


<?php 	
session_start();

	if(isset($_SESSION['mdp'])){
		
	}
	else{
		header('Location: login.php');
	}?>
	<?php 

	$id=$_GET['id'];
	
	include 'bdd.php';

	$sql = $bdd->prepare("UPDATE `frais_hors_forfait` SET `etat_id`= 3 WHERE id_fraishf = '".$id."' ");
		
	$sql ->execute();
			

?>