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
	
		$reponse = $bdd->query('SELECT role_id, id_user FROM `utilisateurs` WHERE `Identifiant_user` =\'' . $_SESSION['identifiant'] . '\'');
		while ($donnees = $reponse->fetch()){
			
			
			$userId = $donnees['id_user'];
			
			 if($donnees['role_id'] == 1){
				$donnees['role_id'] = "Employer";
				}
				if($donnees['role_id'] == 3){
				$donnees['role_id'] = "Comptable";
				}
				if($donnees['role_id'] == 5){
				$donnees['role_id'] = "Admin";
				}
	  ?>
               
            </li>
            <?php if($donnees['role_id'] == "Employer"){?>
            <li>
                <a href="index.php"><img class="icones" width="21%" src="imgs/invoice.png">Déclarer un frai</a>
            </li>
            <li class="active">
                <a href="#"><img class="icones" width="21%" src="imgs/checklist.png">historique des frais</a>
            </li>
            <?php } ?>
            <?php if($donnees['role_id'] == "Admin"){?>
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
           			<?php
						
						$sql = $bdd->query("SELECT mois, annee, id FROM fiche_frais WHERE utilisateur_id = '".$userId."' ORDER BY annee, mois DESC LIMIT 1");
				
						$donnees = $sql->fetch();
			
						$id_fichefrais = $donnees['id'];
						
						
						$sql2 = $bdd->query("SELECT * FROM `frais_fixes` WHERE id_fiche_frais = '".$id_fichefrais."'");
						
						$total = 0;			
			
						while($tt = $sql2 ->fetch()){
							
							if($tt['list_id'] == 1){
								$total = $total+($tt['quantite_frais']*50);
							}
							if($tt['list_id'] == 2){
								$total = $total+($tt['quantite_frais']*15);
							}
							if($tt['list_id'] == 3){
								$total = $total+($tt['quantite_frais']*1.02);
							}
							if($tt['list_id'] == 4){
								$total = $total+($tt['quantite_frais']*0.98);
							}
						}
			
						$sql3 = $bdd->query("SELECT * FROM `frais_hors_forfait` WHERE id_fiche_frais = '".$id_fichefrais."'");
						
						$total2 = 0;
			
						while($tt2 = $sql3 ->fetch()){
							
						
							$total2 = $total2+($tt2['prix_fraishf']*$tt2['quantite_fraishf']);
						
						}
			
						$Tf = $total+$total2;
			
			?>
							
			<div class="boxtotal animated fadeInDown delay-1s" style="width: 23%;float: left">    
            	<div style="box-shadow: 0px 0px 8px 0px rgba(0,0,0,0.3);width: 95%;">
            		<h2 class="h2box">Total Estimé</h2>
            		<div class="totalbox">
            			<h3 style="text-align: left;margin-left: 5px;">+<?php echo $Tf ?> €</h3>
            			<p style="text-align: right;margin: 0; margin-top: -5px;">le mois en cour</p>
            		</div>
            	</div>
            </div>
            <div style="text-align: center;width: 23%;float: left;" class="animated fadeInUp delay-2s">
            	<div>
            		<div class="totalbox" style="width: 95%;box-shadow: 0px 0px 6px 0px rgba(0,0,0,0.3);margin-bottom: 10px;padding: 7px 0px 1px 0px !important;background: #5086b5;color: white;">
            			<h3 style="text-align: center;font-size: 20px">Frais forfaitisés (+<?php echo $total ?> €)</h3>
					</div>
							
						<?php
						
			
						$sql = $bdd->query("SELECT * FROM `frais_fixes` WHERE id_fiche_frais = '".$id_fichefrais."' ORDER BY id_frais DESC");
					
						while($fix = $sql->fetch()){
					
						if($fix['list_id'] == 1){
							$libfix = "Nuit d'hotel";
							$P = 50;
						}
						if($fix['list_id'] == 2){
							$libfix = "Restauration";
							$P = 15;
						}
						if($fix['list_id'] == 3){
							$libfix = "Transport (essence)";
							$P = 1.02;
						}
						if($fix['list_id'] == 4){
							$libfix = "Transport (diesel)";
							$P = 0.98;
						}
								
					?>
           		
            		<div class="totalbox" style="width: 95%;box-shadow: 0px 0px 8px 0px rgba(0,0,0,0.3);margin-top: 5px;">
            			<h3 style="text-align: left;margin-left: 5px;font-size: 20px"><?php
						echo $libfix;	
						?></h3>
            			<p style="text-align: right;margin: 0; margin-top: -30px;padding-right: 5px">+<?php
						echo $P*$fix['quantite_frais'];
						?> €</p>
           				<div style="background: rgba(64,115,158,1.00)">
            			<h3 style="text-align: left;margin-left: 5px;font-size: 15px;margin-top: 5px;
            			padding: 1px 5px 2px 5px;color:white;">Quantité:X<?php
						echo $fix['quantite_frais'];
						?></h3>
						</div>
						<p style="text-align: right;margin: 0; margin-top: -32px;color: white;margin-right: 8px;"><?php
						echo $fix['date']; ?></p>
						
						<?php
						if($fix['etat_id'] == 1){
						?>
						<div style="width: 100%;height: 22px;background: #aaaaaa;margin-top: 1px">
							<label style="float: left;margin-top: -2px;margin-left: 10px;">état du frais:</label>
    						<label style="float: right;margin-top: -2px;margin-right: 10px;">En attente</label>
						</div>
						<?php }?>
						
						<?php
						if($fix['etat_id'] == 2){
						?>
						<div style="width: 100%;height: 22px;background: #11F83A;margin-top: 1px">
							<label style="float: left;margin-top: -2px;margin-left: 10px;">état du frais:</label>
    						<label style="float: right;margin-top: -2px;margin-right: 10px;">Validé</label>
						</div>
						<?php }?>
						
						<?php
						if($fix['etat_id'] == 3){
						?>
						<div style="width: 100%;height: 22px;background: #E10C0F;margin-top: 1px">
							<label style="float: left;margin-top: -2px;margin-left: 10px;">état du frais:</label>
    						<label style="float: right;margin-top: -2px;margin-right: 10px;">Refusé</label>
						</div>
						<?php }?>
					</div>
					<?php } ?>
					</center>
				</div>
            	
			</div>
						
					</form> 
				</div>
			</div>
       		<div style="text-align: center;width: 23%;float: left;position: relative;top: -19.5px;" class="animated fadeInUp delay-2s">
            	<div>
            		<div class="totalbox" style="width: 95%;box-shadow: 0px 0px 6px 0px rgba(0,0,0,0.3);margin-bottom: 10px;padding: 7px 0px 1px 0px !important;background: #5086b5;color: white;">
            			<h3 style="text-align: center;font-size: 20px">Frais hors forfait (+<?php echo $total2 ?> €)</h3>
					</div>
           			<?php
						
						$sql = $bdd->query("SELECT mois, annee, id FROM fiche_frais WHERE utilisateur_id = '".$userId."' ORDER BY annee, mois DESC LIMIT 1");
				
						$donnees = $sql->fetch();
			
						$id_fichefrais = $donnees['id'];
						
						$sql = $bdd->query("SELECT * FROM `frais_hors_forfait` WHERE id_fiche_frais = '".$id_fichefrais."' ORDER BY id_fraishf DESC");
					
						while($hf = $sql->fetch()){
					
						$libhf = $hf['nom_fraishf'];
						$qtshf2 = $hf['quantite_fraishf'];
						$pht = $hf['prix_fraishf'];
						
						
						
					?>
            		<div class="totalbox" style="width: 95%;box-shadow: 0px 0px 8px 0px rgba(0,0,0,0.3);margin-top: 5px;">
            			<h3 style="text-align: left;margin-left: 5px;font-size: 20px"><?php
						echo $libhf;	
						?></h3>
            			<p style="text-align: right;margin: 0; margin-top: -30px;padding-right: 5px">+<?php
						echo $pht*$qtshf2;
						?> €</p>
           				<div style="background: rgba(64,115,158,1.00)">
            			<h3 style="text-align: left;margin-left: 5px;font-size: 15px;margin-top: 5px;background: rgba(64,115,158,1.00);width: 37%;
            			padding: 1px 5px 2px 5px;color:white;">Quantité:X<?php
						echo $qtshf2;
						?></h3>
						</div>
						<p style="text-align: right;margin: 0; margin-top: -31px;color: white;margin-right: 8px;"><?php
						echo $hf['date']; ?></p>
						<?php
						if($hf['etat_id'] == 1){
						?>
						<div style="width: 100%;height: 22px;background: #aaaaaa;">
							<label style="float: left;margin-top: -2px;margin-left: 10px;">état du frais:</label>
    						<label style="float: right;margin-top: -2px;margin-right: 10px;">En attente</label>
						</div>
						<?php }?>
						
						<?php
						if($hf['etat_id'] == 2){
						?>
						<div style="width: 100%;height: 22px;background: #11F83A;">
							<label style="float: left;margin-top: -2px;margin-left: 10px;">état du frais:</label>
    						<label style="float: right;margin-top: -2px;margin-right: 10px;">Validé</label>
						</div>
						<?php }?>
						
						<?php
						if($hf['etat_id'] == 3){
						?>
						<div style="width: 100%;height: 22px;background: #E10C0F;">
							<label style="float: left;margin-top: -2px;margin-left: 10px;">état du frais:</label>
    						<label style="float: right;margin-top: -2px;margin-right: 10px;">Refusé</label>
						</div>
						<?php }?>
					</div>
					<?php } ?>
					</center>
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
		
			
			$sql = $bdd->prepare("INSERT INTO `frais_hors_forfait`(`id_fraishf`, `nom_fraishf`, `prix_fraishf`, `id_fiche_frais`, `quantite_fraishf`, `date`) VALUES (NULL, '".$libelle."','".$pu."','".$id_fichefrais."','".$qtshf."', '".$Ddate."')");
		
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
