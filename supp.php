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

	$requete=$bdd->prepare('DELETE FROM utilisateurs WHERE id_user = :id');
	
	$requete->bindParam(':id', $id);
			
	header('Location: comptes.php');
			
	$requete->execute();

?>