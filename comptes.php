<!DOCTYPE html>
<?php 	
session_start();

	if(isset($_SESSION['mdp'])){
		
	}
	else{
		header('Location: login.php');
	}?>
<html lang="fr">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Luca Blanc">

    <title> Accueil | AppliFrais</title>

    <!-- Bootstrap core CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/simple-sidebar.css" rel="stylesheet">
	<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.0/animate.css" rel="stylesheet">

</head>

<body>

<div id="wrapper" class="toggled">

    <!-- Sidebar -->
    <div id="sidebar-wrapper">
        <ul class="sidebar-nav">
            <li class="sidebar-brand">
              <?php 
		 include 'bdd.php';
	
		$reponse = $bdd->query('SELECT role_id FROM `utilisateur` WHERE `pseudo` =\'' . $_SESSION['identifiant'] . '\'');
		while ($donnees = $reponse->fetch()){
			 if($donnees['role_id'] == 1){
				$donnees['role_id'] = "Visiteur";
				}
				if($donnees['role_id'] == 2){
				$donnees['role_id'] = "Comptable";
				}
				if($donnees['role_id'] == 3){
				$donnees['role_id'] = "Administrateur";
				}
	  ?>
               
            </li>
            <?php if($donnees['role_id'] == "Visiteur"){?>
            <li>
                <a id="active"  href="#"><img class="icones" width="21%" src="imgs/homepage.png">Tableau de bord</a>
            </li>
            <li>
                <a href="#"><img class="icones" width="21%" src="imgs/invoice.png">Déclarer un frai</a>
            </li>
            <li>
                <a href="#"><img class="icones" width="21%" src="imgs/checklist.png">historique des frais</a>
            </li>
            <?php } ?>
            <?php if($donnees['role_id'] == "Administrateur"){?>
               <li class="active">
                <a href="comptes.php"><img class="icones" width="21%" src="imgs/rotation.png">Gestion Comptes</a>
               </li>
            <?php } ?>
            <?php if($donnees['role_id'] == "Comptable"){?>
               <li>
                <a href="comptable.php"><img class="icones" width="21%" src="imgs/checklist.png">Gestion des frais</a>
               </li>
            <?php } ?>
            <!--<li>
                <a href="#"><img class="icones" width="21%" src="imgs/conversation-with-text-lines.png">Méssagerie</a>
            </li>-->
        </ul>
    </div>
    <!-- /#sidebar-wrapper -->
	<div class="headbox animated fadeInLeft delay-1s" style="background: rgba(240,240,240,1.00);height: 100%;z-index: 10;position: relative;border-bottom: solid 2px rgb(69, 123, 169);"><a href="#menu-toggle" class="btn btn-secondary" id="menu-toggle"><i id="bar" class="fa fa-times-circle" aria-hidden="true"></i></a> <a href="deco.php"><button class="deco2"><i class="fa fa-power-off" style="
"></i> Déconnexion</button></a> <p1 class="compte">(<?php echo $donnees['role_id']?>) <?php echo $_SESSION['identifiant'] ?></p1> <a href="#btnnotif" id="btnnotif" class="notif"><i id="notif" class="fa fa-envelope-open"></i></a></div>
    <!-- Page Content -->
    <?php } ?>
    <div style="padding: 0 !important;position: relative;
    top: -1px;" id="page-content-wrapper">
  <table class="table animated fadeInLeft delay-2s">
  <thead>
    <tr class="headertab">
      <!--<th scope="col">#</th>-->
      <th scope="col">Identifiant</th>
      <th scope="col">Nom</th>
      <th scope="col">Prenom</th>
      <th scope="col">Email</th>
      <th scope="col">Role</th>
      <th scope="col">Actions</th>
      <th scope="col"><a  href="cree.php" class="boutonplus">Crée un utilisateur</a></th>
    </tr>
  </thead>
  <tbody class="animated fadeInLeft delay-2s">
   <?php 
	  include 'bdd.php';
	
		$reponse = $bdd->query('SELECT * FROM `utilisateur`');
		while ($donnees = $reponse->fetch()){
	  ?>
    <tr>
      <!--<th scope="row"><?php// echo $donnees['id_user'];?></th>-->
      <td><?php echo $donnees['pseudo'];?></td>
      <td><?php echo $donnees['nom'];?></td>
      <td><?php echo $donnees['prenom'];?></td>
      <td><?php echo $donnees['email'];?></td>
      <td><?php 
			if($donnees['role_id'] == 1){
				$donnees['role_id'] = "Visiteur";
			}
			if($donnees['role_id'] == 2){
				$donnees['role_id'] = "Comptable";
			}
			if($donnees['role_id'] == 3){
				$donnees['role_id'] = "Administrateur";
			}
			echo $donnees['role_id'];?></td>
      <td><a  href="modif.php?id=<?php echo $donnees['id']; ?>" class="boutonsupp">Modifier</a> <a  href="supp.php?id=<?php echo $donnees['id']; ?>" class="boutonsupp2">supprimer</a></td>
    </tr>
    <?php } ?>
  </tbody>
</table>
    </div>
    <!-- /#page-content-wrapper -->

</div>
<!-- /#wrapper -->

<!-- Bootstrap core JavaScript -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.bundle.min.js"></script>

<!-- Menu Toggle Script -->
<script>
	
	let test2 = 'oui';
	
    $("#menu-toggle").click(function(e) {
		
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
		
		if(test2 === 'oui'){
			document.getElementById("bar").className = "fa fa-bars";
			test2 = 'non';
		}
		else{
			document.getElementById("bar").className = "fa fa-times-circle";
			test2 = 'oui';
		}
		
    });

	let test = 'oui';
	
	$("#btnnotif").click(function(e) {
		
		e.preventDefault();
		
		if(test === 'oui'){
			document.getElementById("notif").className = "fa fa-envelope";
			test = 'non';
		}
		else{
			document.getElementById("notif").className = "fa fa-envelope-open";
			test = 'oui';
		}
					  
	});
	
	
</script>



</body>

</html>
