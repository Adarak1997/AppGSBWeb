<!DOCTYPE html>
<?php 	
session_start();	// démarrer la session

	if(isset($_SESSION['mdp'])){	//si il y a un compte
		
	}
	else{	//si il n'y a pas de compte
		header('Location: login.php');	//redirection vers la page de login.php
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
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">

</head>

<body>

<div id="wrapper" class="toggled">

    <!-- Sidebar -->
    <div id="sidebar-wrapper">
        <ul class="sidebar-nav">
            <li class="sidebar-brand">
              <?php 
		 include 'bdd.php';
	
		$reponse = $bdd->query('SELECT role_id, id FROM `utilisateur` WHERE `pseudo` =\'' . $_SESSION['identifiant'] . '\'');
		while ($donnees = $reponse->fetch()){
			
			
			$userId = $donnees['id'];
			
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
            <li class="active">
                <a href="index.php"><img class="icones" width="21%" src="imgs/invoice.png">Déclarer un frai</a>
            </li>
            <li>
                <a href="gestionFrais.php"><img class="icones" width="21%" src="imgs/checklist.png">historique des frais</a>
            </li>
            <?php } ?>
            <?php if($donnees['role_id'] == "Administrateur"){?>
               <li>
                <a href="comptes.php"><img class="icones" width="21%" src="imgs/rotation.png">Gestion Comptes</a>
               </li>
            <?php } ?>
            <?php if($donnees['role_id'] == "Comptable"){?>
               <li>
                <a href="comptes.php"><img class="icones" width="21%" src="imgs/checklist.png">Gestion des frais</a>
               </li>
            <?php } ?>
            <!--<li>
                <a href="#"><img class="icones" width="21%" src="imgs/conversation-with-text-lines.png">Méssagerie</a>
            </li>-->
        </ul>
    </div>
    <!-- /#sidebar-wrapper -->
	<div class="headbox animated fadeInLeft delay-1s" style="background: rgba(240,240,240,1.00);height: 100%"><a href="#menu-toggle" class="btn btn-secondary" id="menu-toggle"><i id="bar" class="fa fa-times-circle" aria-hidden="true"></i></a> <a href="deco.php"><button class="deco2"><i class="fa fa-power-off" style="
"></i> Déconnexion</button></a> <p1 class="compte">(<?php echo $donnees['role_id']?>) <?php echo $_SESSION['identifiant'] ?></p1> <a href="#btnnotif" id="btnnotif" class="notif"><i id="notif" class="fa fa-envelope-open"></i></a></div>
    <!-- Page Content -->
  
    
      
          <?php } ?>
    <div id="page-content-wrapper">
        <div class="container-fluid">
            <div style="text-align: center;width: 38%;float: left;" class="animated fadeInUp delay-2s">
            	<div style="background: rgba(212,212,212,0.20);box-shadow: 0px 0px 8px 0px rgba(0,0,0,0.15);">
					<h2>Déclarer un frai forfaitisé</h2>
					<p>crée une demande de remboursement <br>envoyer au service comptable</p>
					<form method="post" style="padding: 0px 0 10px 0px;" action="index.php">
						<SELECT id="liste" style="min-width: 220px;" class="role" name="frais" size="1" onChange="fix()">
							<option class="rolesub">Liste de frais</option>
							<OPTION class="rolesub" value="Hotel">Hotel
							<OPTION class="rolesub" value="Restauration">Restauration
							<OPTION class="rolesub" value="Transport">Transport
						</SELECT><br>
						
						<div id="petrol" class="novue animated fadeIn">
						<SELECT class="role" style="min-width: 220px;margin-top: 15px;    padding: 5px 40px;" name="petrol" id="liste2" size="1" onChange="gaz()">
								<option class="rolesub" selected>Liste des choix
								<OPTION class="rolesub" value="essence">essence
								<OPTION class="rolesub" value="diesel">diesel
							</SELECT><br>
							
						</div>
						
						<div id="diesel" class="novue">
							<!-- <input placeholder="Quantité" type="number" class="role" style="min-width: 220px;margin-top: 15px;padding: 5px 10px;">-->
							 <input id="qts3" name="qtsDiesel" placeholder="kilomètreage" type="number" class="role" style="min-width: 220px;margin-top: 15px;padding: 5px 10px;"><br>
							 <center><div class="col-6"><p style="margin:0; margin-top: 20px;text-align: left;">Total remboursé</p></div></center>
							<center><div class="row col-6" style="margin-top: 0px"><div style="text-align: left;padding: 0px 4px;" class="col-12"><span id="total3">0</span><span> €</span></p></div></div></center>
							
							<button name="submitFicheFrais" type="submit" class="btnplus" style="min-width: 220px">Valider la fiche</button>
						</div>
							
							<div id="essence" class="novue"><input id="qts4" name="qtsEssence" placeholder="kilomètreage" type="number" class="role" style="min-width: 220px;margin-top: 15px;padding: 5px 10px;"><br>
							<center><div class="col-6"><p style="margin:0; margin-top: 20px;text-align: left;">Total remboursé</p></div></center>
							<center><div class="row col-6" style="margin-top: 0px"><div style="text-align: left;padding: 0px 4px;" class="col-12"><span id="total4">0</span><span> €</span></p></div><div style="text-align: left;padding: 0px 25px;" class="col-6"></div></div></center>
							<button name="submitFicheFrais" type="submit" class="btnplus" style="min-width: 220px">Valider la fiche</button>
							</div>
						
						<div id="all" class="novue animated fadeIn">
							<input id="qts" name="qtsHotel" placeholder="Quantité" type="number" class="role" style="min-width: 220px;margin-top: 15px;padding: 5px 10px;"><br>
							<center><div class="col-6"><p style="margin:0; margin-top: 20px;text-align: left;">Total remboursé</p></div></center>
							<center><div class="row col-6" style="margin-top: 0px"><div style="text-align: left;padding: 0px 4px;" class="col-12"><p><span id="total">0</span><span> €</span></p></div><div style="text-align: left;padding: 0px 15px;" class="col-6"><span> </span></div></div></center>
							
							<button name="submitFicheFrais" type="submit" class="btnplus" style="min-width: 220px">Valider la fiche</button>
						</div>
						
						<div id="all2" class="novue animated fadeIn">
							
							<input id="qts2" name="qtsRestauration" placeholder="Quantité" type="number" class="role" style="min-width: 220px;margin-top: 15px;padding: 5px 10px;"><br>
							<center><div class="col-6"><p style="margin:0; margin-top: 20px;text-align: left;">Total remboursé</p></div></center>
							<center><div class="row col-6" style="margin-top: 0px"><div style="text-align: left;padding: 0px 4px;" class="col-12">
							<span id="total2">0</span><span> €</span></p></div></div></center>
							
							<button name="submitFicheFrais" type="submit" class="btnplus" style="min-width: 220px">Valider la fiche</button>
						</div>
						
					</form> 
				</div>
			</div>
       		<div style="text-align: center;width: 38%;float: left;margin-left: 30px" class="animated fadeInUp delay-2s">
            	<div style="background: rgba(212,212,212,0.20);box-shadow: 0px 0px 8px 0px rgba(0,0,0,0.15);">
					<h2>Déclarer un frai hors forfait</h2>
					<p>crée une demande de remboursement <br>envoyer au service comptable</p>
					<form style="padding-bottom: 20px" method="post">
						<input name="lib" placeholder="Libelle" class="role" style="min-width: 220px;margin-top: 15px;padding: 5px 10px;"><br>
						<input name="qtshf" placeholder="Quantité" type="number" class="role" style="min-width: 220px;margin-top: 15px;padding: 5px 10px;"><br>
						<input name="pu" placeholder="Prix Unitaire" type="number" class="role" style="max-width: 184px;margin-top: 15px;padding: 5px 10px;border-right: solid 1px rgba(78,135,183,1.00);"><i class="fas fa-euro-sign" style="background: #4E87B7;color: white;padding: 11.25px 13px 10px;border-radius: 0px 2px 2px 0px"></i><br>
						
							
						<button name="submitFicheFraisHf" type="submit" class="btnplus" style="min-width: 220px;">Valider la fiche</button><br>
					</form> 
				</div>
			</div>  
        </div>
    </div>
    <!-- /#page-content-wrapper -->

</div>
<!-- /#wrapper -->

<!-- Bootstrap core JavaScript -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.bundle.min.js"></script>

<!-- Menu Toggle Script -->
<script>
	
	$('#qts2').on('input',function(e){
     $("#total2").html($(this).val()*15);
 	});
	
	$('#qts').on('input',function(e){
     $("#total").html($(this).val()*50);
 	});
	
	$('#qts3').on('input',function(e){
     $("#total3").html(Math.round($(this).val()*0.98*100)/100);
 	});
	
	$('#qts4').on('input',function(e){
     $("#total4").html(Math.round($(this).val()*1.02*100)/100);
 	});
	
	function fix(){
		
		if(document.getElementById('liste').value === 'Transport'){
			document.getElementById('petrol').className = 'vue';
			document.getElementById('all').className = 'novue';
			document.getElementById('all2').className = 'novue';
		}
		if(document.getElementById('liste').value === 'Hotel'){
			document.getElementById('petrol').className = 'novue';
			document.getElementById('all').className = 'vue';
			document.getElementById('all2').className = 'novue';
			document.getElementById('diesel').className = 'novue';
			document.getElementById('essence').className = 'novue';
		}
		if(document.getElementById('liste').value === 'Restauration'){
			document.getElementById('petrol').className = 'novue';
			document.getElementById('all2').className = 'vue';
			document.getElementById('all').className = 'novue';
			document.getElementById('diesel').className = 'novue';
			document.getElementById('essence').className = 'novue';
		}
	}
	
	function gaz(){
		
		if(document.getElementById('liste2').value === 'diesel'){
			document.getElementById('diesel').className = 'vue';
			document.getElementById('essence').className = 'novue';
		}
		if(document.getElementById('liste2').value === 'essence'){
			document.getElementById('diesel').className = 'novue';
			document.getElementById('essence').className = 'vue';
		}
	}
</script>



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

<?php
	include('bdd.php');
					
	
	if(isset($_POST['submitFicheFrais'])){
		/*if ($_POST['frais'] == 'Hotel'){
			$sql = "SELECT * FROM liste_frais WHERE libelle = '".$_POST['frais']."'";
			$result = $bdd->query($sql);
			$data = $result->fetch_assoc();*/
		
			if($_POST['frais'] === 'Hotel'){
				$idList = 1;
				$Q = $_POST['qtsHotel'];
			}
			if($_POST['frais'] === 'Restauration'){
				$idList = 2;
				$Q = $_POST['qtsRestauration'];
			}
			if($_POST['petrol'] === 'essence'){
				$idList = 3;
				$Q = $_POST['qtsEssence'];
			}
			if($_POST['petrol'] === 'diesel'){
				$idList = 4;
				$Q = $_POST['qtsDiesel'];
			}
		
			$id_list = $idList;
			$qts = $Q;
			$quantite = $qts;
				
			
			$sql = $bdd->query("SELECT mois, annee, id FROM fiche_frais WHERE utilisateur_id = '".$userId."' ORDER BY annee, mois DESC LIMIT 1");
				
			$donnees = $sql->fetch();
			
			$id_fichefrais = $donnees['id'];
		
			$Ddate = date ('d-m-Y');
			$vraiAnnee = date('Y');
			$anneeFiche = $donnees['annee'];
			$vraiMois = date('n');
			$moisFiche = $donnees['mois'];
		
				if ($vraiAnnee == $anneeFiche){
						if ($vraiMois > $moisFiche)
					{
						$sql = $bdd->query("INSERT INTO fiche_frais VALUES(NULL, '".$vraiMois."', '".$vraiAnnee."', '".$userId."', 1)");
						
					}
				}elseif ($vraiAnnee > $anneeFiche)
				{
					$sql = $bdd->query("INSERT INTO fiche_frais VALUES(NULL, '".$vraiMois."', '".$vraiAnnee."', '".$userId."', 1)");
					
				}
		
			
			$sql = $bdd->prepare("INSERT INTO `frais_fixes`(`id_frais`, `quantite_frais`, `id_fiche_frais`, `list_id`, `date`, `etat_id`) VALUES (NULL, '".$quantite."', '".$id_fichefrais."','".$id_list."', '".$Ddate."', 1)");
		
			$sql ->execute();
			
		}
	
	if(isset($_POST['submitFicheFraisHf'])){
		
			$libelle = $_POST['lib'];
			$qtshf = $_POST['qtshf'];
			$pu = $_POST['pu'];
		
			$sql = $bdd->query("SELECT mois, annee, id FROM fiche_frais WHERE utilisateur_id = '".$userId."' ORDER BY annee, mois DESC LIMIT 1");
		
			$donnees = $sql->fetch();
		
			$id_fichefrais = $donnees['id'];
		
		
			$Ddate = date ('d-m-Y');
			$vraiAnnee = date('Y');
			$anneeFiche = $donnees['annee'];
			$vraiMois = date('n');
			$moisFiche = $donnees['mois'];
		
			if ($vraiAnnee == $anneeFiche){
				if ($vraiMois > $moisFiche)
					{
						$sql = $bdd->query("INSERT INTO fiche_frais VALUES(NULL, '".$vraiMois."', '".$vraiAnnee."', '".$userId."', 1)");
						
					}
			}elseif ($vraiAnnee > $anneeFiche)
				{
					$sql = $bdd->query("INSERT INTO fiche_frais VALUES(NULL, '".$vraiMois."', '".$vraiAnnee."', '".$userId."', 1)");
					
				}
		
			
			$sql = $bdd->prepare("INSERT INTO `frais_hors_forfait`(`id_fraishf`, `nom_fraishf`, `prix_fraishf`, `id_fiche_frais`, `quantite_fraishf`, `date`, `etat_id`) VALUES (NULL, '".$libelle."','".$pu."','".$id_fichefrais."','".$qtshf."', '".$Ddate."', 1)");
		
			$sql ->execute();
	
		
	}
	
					
	function mois($date){
		if (date('n', $date) == 1){
			$result = 'janvier';
		}elseif (date('n', $date) == 2){
			$result = 'février';
		}elseif (date('n', $date) == 3){
			$result = 'mars';
		}elseif (date('n', $date) == 4){
			$result = 'avril';
		}elseif (date('n', $date) == 5){
			$result = 'mai';
		}elseif (date('n', $date) == 6){
			$result = 'juin';
		}elseif (date('n', $date) == 7){
			$result = 'juillet';
		}elseif (date('n', $date) == 8){
			$result = 'aout';
		}elseif (date('n', $date) == 9){
			$result = 'septembre';
		}elseif (date('n', $date) == 10){
			$result = 'octobre';
		}elseif (date('n', $date) == 11){
			$result = 'novembre';
		}elseif (date('n', $date) == 12){
			$result = 'décembre';
		}
		return($result);
	}
					
					
?>

</body>

</html>
