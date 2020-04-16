<div class="neo-content-headline">
	<div class="neo-line-headline" style="width: 100%"><h2><em><strong><span style="font-size:40px"><i class="fa fa-shopping-cart"></i> Achat de Jetons</span></strong></em></h2></div>
</div>

			<div class="neo-center" style="margin-top:10px;">
		
					<div class="neo-radius text-center" style="padding:10px;">
					<?php if(isset($_Joueur_)) {  if(isset($_Joueur_['tokens'])) echo ' Vous avez ' . $_Joueur_['tokens'] . ' <i class="fas fa-gem"></i> '; } ?>
						<br/><?php if(!isset($_Joueur_)) {  ?>
						<h3 class="neo-text">Vous n'etes pas connecté</h3>
							<a onclick="document.getElementById('Connection').style.display='block'" class="neo-button neo-gray neo-border hvr-bounce-in" ><span class="glyphicon glyphicon-user"></span> connectez vous !</a>
						<?php } ?>
						</strong></center></p>
					</div>
				
			</div>

<?php if($_Serveur_['Payement']['paypal'] == true) 
{
?>
			
	
		<?php if(isset($_GET['success']) AND $_GET['success'] == 'true'){ ?>
		<div class="alert alert-dismissable alert-success neo-radius neo-center-small">
			<button type="button" class="close" data-dismiss="alert">×</button>
			<center>
				Votre code a bien été validé, vous avez été crédité de <?php echo $_GET['tokens']; ?>  Jetons ! 
			</center>
		</div>
		<?php } elseif(isset($_GET['success']) AND $_GET['success'] == 'false'){ ?>
		<div class="alert alert-dismissable alert-success neo-radius neo-center-small">
			<button type="button" class="close" data-dismiss="alert">×</button>
			<center>
					Le code entré est incorrect, vous n'avez pas été crédité...
			</center>
		</div>
		<?php }  ?>
		

			<h3 class="neo-text"> Payement par PayPal <i class="fab fa-paypal"></i></h3>
			

			<div  class="alert alert-dismissable alert-success neo-radius neo-center-small">
				<button type="button" class="close" data-dismiss="alert">×</button>
					<center>
						Deux possibilités s'offrent à vous pour les dons, vous pouvez payer par PayPal, soit avec votre compte PayPal soit avec votre Carte Bleu de manière sécurisée depuis le site PayPal (le payement ne s'effectue donc pas sur notre serveur/site). L'avantage de PayPal est que le joueur reçoit plus de Jetons qu'avec un payement téléphonique (qui sont surtaxés).
					</center>
			</div>
			
				<?php 
				require_once('controleur/tokens/paypal.php'); 
				?>
				<div class="neo-row-padding neo-center">
					<?php
					if(isset($offresTableau))
					{
						for($i = 0; $i < count($offresTableau); $i++)
						{
							echo '
							 <div style="width:33.33%;" class="neo-margin-bottom-1 neo-third neo-card neo-hover-shadow neo-center-simple">

								<header class="neo-container neo-gray">
								  <h3 class="neo-text">'. $offresTableau[$i]['nom'] .'</h3>
								</header>

								<div class="neo-container">
								  <p class="neo-text">'; 
								  if(!isset($offresTableau[$i]["description"])) { echo $offresTableau[$i]["description"]; } else { echo "Aucune information ..."; }
								  echo '</p>
								</div>

								<footer class="neo-margin neo-container neo-border-top neo-padding-8">';
									if(isset($_Joueur_)) {
										if($lienPaypal[$i] == 'viaMail') {
											require('controleur/paypal/paypalMail.php');
										} else {
											echo '<a href="'. $lienPaypal[$i] .'" class="neo-float-left neo-button hvr-forward neo-gray">Acheter !</a>';
										}
									} else { echo '<a  onclick="document.getElementById(\'Connection\').style.display=\'block\'" class="neo-float-left hvr-forward neo-button hvr-bounce-in neo-gray">Connexion..</a>'; }
										echo '<button class="neo-float-right neo-button neo-blue hvr-forward">' .$offresTableau[$i]['prix']. ' euro</button>
								</footer>

							</div>';
						}
					} else {
						echo '<div style="margin-left: 15px;margin-right: 15px;" class="alert alert-danger text-center"><strong>Aucune offre de payement par paypal n\'est disponible pour le moment...</strong></div>';
					}
						?>
					</div>

<?php 
} 

	if($_Serveur_['Payement']['dedipass'] == true)
	{
		?>
			<div class=" neo-radius neo-center">
			<h3 class="neo-text"> Paiement par Dedipass <i class="far fa-money-bill-alt"></i></h3>
			</div>
			<div  class="alert alert-dismissable alert-success neo-radius neo-center-small">
				<button type="button" class="close" data-dismiss="alert">×</button>
					<center>
						Vous pouvez payer par Dedipass, vous paierez ainsi avec votre forfait téléphonique, c'est donc un avantage important. D'un autre côté, vous serez déversé de moins de tokens qu'avec un payement paypal (qui sont beaucoup moins taxés).
					</center>
			</div>
			<div class="neo-xbackground neo-radius neo-center neo-padding-16">
				<div data-dedipass="<?=$_Serveur_['Payement']['public_key'];?>" data-dedipass-custom=""></div>	
			</div>
			

		<?php
	}
	?>



