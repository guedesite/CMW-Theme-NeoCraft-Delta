<header>
<div class="neo-bar neo-large neo-xbackground" style="position:fixed;z-index:99;margin-top:-20px;">
<a class="navbar-brand wow fadeIn text-uppercase neo-textS" id="navbarColor01" aria-labelledby="Listdefil1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></a>
<?php 
if(isset($_Joueur_))
	{
	?>
	<div  class="neo-float-right neo-dropdown-hover neo-margin-right-5 neo-center-simple ">
		<button class="neo-button neo-light wow fadeInDown hvr-bounce-in" data-wow-delay="1s"><img src="https://cravatar.eu/avatar/<?php echo $_Joueur_['pseudo']; ?>/20" style="margin-left: -10px"> <?php echo $_Joueur_['pseudo']; ?></button>
		  <div style="position:fixed;" class="neo-dropdown-content neo-bar-block neo-border">
									<?php 
									$req_topic = $bddConnection->prepare('SELECT cmw_forum_topic_followed.pseudo, vu, cmw_forum_post.last_answer AS last_answer_pseudo 
										FROM cmw_forum_topic_followed
										INNER JOIN cmw_forum_post WHERE id_topic = cmw_forum_post.id AND cmw_forum_topic_followed.pseudo = :pseudo');
									$req_topic->execute(array(
										'pseudo' => $_Joueur_['pseudo']
									));
									$alerte = 0;
									while($td = $req_topic->fetch())
									{
										if($td['pseudo'] != $td['last_answer_pseudo'] AND $td['last_answer_pseudo'] != NULL AND $td['vu'] == 0)
										{
											$alerte++;
										}
									}
									$req_answer = $bddConnection->prepare('SELECT vu
									FROM cmw_forum_like INNER JOIN cmw_forum_answer WHERE id_answer = cmw_forum_answer.id
									AND cmw_forum_like.pseudo != :pseudo AND cmw_forum_answer.pseudo = :pseudo');
									$req_answer->execute(array(
										'pseudo' => $_Joueur_['pseudo'],
									));
									while($answer_liked = $req_answer->fetch())
									{
										if($answer_liked['vu'] == 0)
										{
											$alerte++;
										}
									}
									if($_PGrades_['PermsPanel']['access'] == "on" OR $_Joueur_['rang'] == 1)
										echo '<a href="admin.php" class="neo-hover-gray  neo-bar-item hvr-forward neo-button "><i class="fas fa-tachometer-alt"></i> Administration</a>';
									if($_PGrades_['PermsForum']['moderation']['seeSignalement'] == true OR $_Joueur_['rang'] == 1)
									{
										$req_report = $bddConnection->query('SELECT id FROM cmw_forum_report WHERE vu = 0');
										$signalement = $req_report->rowCount();
										echo '<a href="?page=signalement" class="neo-hover-gray  neo-bar-item hvr-forward neo-button "><i class="fa fa-bell"></i> Signalement <span class="badge badge-pill badge-warning" id="signalement">' . $signalement . '</span></a>';
									}
								?>
							<a class="neo-hover-gray neo-bar-item hvr-forward   neo-button" href="?page=alert"><i class="fa fa-envelope"></i> Alertes :  <span class="badge badge-pill badge-primary" id="alerts"><?php echo $alerte; ?></span></a>
							<a class="neo-hover-gray neo-bar-item hvr-forward   neo-button" href="?page=profil&profil=<?php echo $_Joueur_['pseudo']; ?>"><i class="far fa-address-card"></i> Mon profil</a>
							<a class="neo-bar-item hvr-forward   neo-button" href="?page=messagerie"><i class="fa fa-envelope"></i> Messagerie</a>
							<a class="neo-hover-gray neo-bar-item hvr-forward   neo-button" href="?page=token"><i class="ion-cash"></i> solde : <?php if(isset($_Joueur_['tokens'])) echo $_Joueur_['tokens'] . ' '; ?><i class="fas fa-gem"></i></a>
							<a class="neo-hover-gray neo-bar-item hvr-forward   neo-button" href="?action=deco"><i class="fas fa-sign-out-alt"></i> Se déconnecter</a>

			</div>
			</div>
			
	<?php 
	}
	else
	{
	?>
		<div class="neo-float-right neo-dropdown-click neo-margin-right-5">
			<button onclick="var x = document.getElementById('connec'); if (x.className.indexOf('neo-show') == -1) { x.className += ' neo-show'; } else {  x.className = x.className.replace(' neo-show', ''); }" class=" neo-button wow fadeInDown hvr-forward " data-wow-delay="1s" ><i class="fa fa-user"></i> Compte</button>
				 <div id="connec" class="neo-hide neo-dropdown-content neo-bar-block neo-border  neo-center-simple" style="margin-left:-5%;position:fixed;">
					 <form class="form-signin neo-padding-8" role="form" method="post" action="?&action=connection">
						<h3 style="neo-text"> Se connecter </h3>
						<label class="neo-text">Pseudo</label>
						<input class="neo-input neo-border neo-margin-left-5 neo-margin-right-5" name="pseudo" id="PseudoConectionForm" type="text" style="width:90%" placeholder="Votre pseudo" required autofocus>
									
						<label style="margin-top:15px;" class="neo-text">Mot de passe <a href="#" style="color:#333;font-size:15px;"  onclick="document.getElementById('passrecover').style.display='block'"><small> oublié ?</small> </a></label>
						<input class="neo-input neo-border neo-margin-left-5 neo-margin-right-5" type="password" name="mdp"  id="MdpConnectionForm" style="width:90%" placeholder="Votre mot de passe" required >
							<div class="neo-row-padding " style="margin-top:15px;">
								<div class="neo-half">
									<input class="form-check-input" name="reconnexion" type="checkbox" autochecked> Se souvenir de moi
								</div>
								<div class="neo-half">
									<button type="submit" class="neo-button ">Connexion</button>
								</div>
							</div>
							
							
					</form>	
					<button style="width:100%" class="neo-hover-gray neo-border-top neo-button " onclick="document.getElementById('enreg').style.display='block'">S'enregistrer »</button>
				</div>
		</div>
	<?php 
	}
	?>
	

<button  data-wow-delay="1s"  class="neo-hover-gray neo-margin-left-5 neo-float-left neo-button wow fadeInDown hvr-forward "> <i class="fas fa-wifi"></i> <?php echo $playeronline; ?> en ligne</button>
</div>
<div id="particle-canvas" style="position:absolute;width:100%;height:auto;z-index:20;top:0;left:0;margin-top:20px;margin-bottom:-5px;" >
<?php if($_Theme_['accueil']['-titre'] != 'true') { ?>
<div style="position:absolute;width:100%;height:auto;z-index:-9" >
	<header class="heading" id="content-under" style="background-image: url('theme/<?php echo $_Serveur_['General']['theme']; ?>/img/fond.jpg');background-size: cover;height:auto;">
		<div class="heading-mask">
			<div class="container" style="text-align:center;">
				<h1  class=" text-uppercase wow zoomInLeft"  data-wow-delay="1s"><div style='font-size:120px;color: #595858;font-family:verdana,geneva,sans-serif'><?php echo $_Serveur_['General']['name']; ?></div></h1>
				<h2 class=" text-uppercase wow zoomInLeft" data-wow-delay="1s"><?php if($_Theme_['mod']['-mod'] != 'true') { echo $_Serveur_['General']['ipTexte']; } else { ?><a href="#" onclick="document.getElementById('mod').style.display='block'">Télécharger le launcher</a><?php } ?></h2>
			</div>
		</div>
	</header>
</div>
<?php  } else {  ?>

<img id="content-under" src="theme/<?php echo $_Serveur_['General']['theme']; ?>/img/fondSansTitre.jpg" style="height:auto;width:100%" />
<?php  } ?>
</div>


<div class="neo-bar neo-large neo-xbackground neo-center-simple" >

	
	<?php 


	for($o = 0; $o< count($_Menu_['MenuTexte']); $o++)
	{
		if(isset($_Menu_['MenuListeDeroulante'][$_Menu_['MenuTexteBB'][$o]]))
		{ ?>
			 <div  class="neo-hide-large neo-dropdown-click">
			 <button onclick="var x = document.getElementById('menu-<?php $o;?>'); if (x.className.indexOf('neo-show') == -1) { x.className += ' neo-show'; } else {  x.className = x.className.replace(' neo-show', ''); }" class="  neo-margin-left-1 neo-button wow fadeInDown hvr-bounce-in" data-wow-delay="1s"><?php echo $_Menu_['MenuTexte'][$o]; ?><i class="fas fa-sort-down" style="display:inline;margin-left:5px;vertical-align: text-top"></i></button>
			  <div id="menu-<?php $o;?>" class="neo-hide neo-dropdown-content neo-bar-block neo-border">
				<?php
				for($k = 0; $k < count($_Menu_['MenuListeDeroulante'][$_Menu_['MenuTexteBB'][$o]]); $k++)
				{
					if($_Menu_['MenuListeDeroulante'][$_Menu_['MenuTexteBB'][$o]][$k] == '-divider-')
					{
						echo'<a href="#" class="hvr-forward neo-button neo-bar-item ">---</a>';
					}
					else
					{
						echo '<a href="' .$_Menu_['MenuListeDeroulanteLien'][$_Menu_['MenuTexteBB'][$o]][$k]. '" class=" neo-hover-gray neo-bar-item hvr-forward neo-button">' .$_Menu_['MenuListeDeroulante'][$_Menu_['MenuTexteBB'][$o]][$k]. '</a>';
					}
				} 
				?>
				</div>
			</div>
				<?php
		}	
		else
		{

			echo '<a class="neo-hide-large " href="' .$_Menu_['MenuLien'][$o]. '"><button class=" neo-margin-left-1 neo-button wow fadeInDown hvr-bounce-in" data-wow-delay="1s">' .$_Menu_['MenuTexte'][$o]. '</button></a>';
		}
	} ?>

	<div  class="neo-show-large neo-dropdown-click">
		<button  onclick="var x = document.getElementById('menu-nav'); if (x.className.indexOf('neo-show') == -1) { x.className += ' neo-show'; } else {  x.className = x.className.replace(' neo-show', ''); }" class=" neo-button wow fadeInDown hvr-bounce-in" data-wow-delay="1s" >Navigation <i class="fa fa-caret-down"></i></button>
			 <div id="menu-nav" class="neo-dropdown-content neo-bar-block neo-border">
				<?php for($o = 0; $o < count($_Menu_['MenuTexte']); $o++)
					{
						if(isset($_Menu_['MenuListeDeroulante'][$_Menu_['MenuTexteBB'][$o]]))
						{ ?>
							 <div class="neo-border">
							  <a href="#" class="neo-bar-item neo-button " data-wow-delay="1s"><?php echo $_Menu_['MenuTexte'][$o]; ?> <i class="fa fa-caret-down"></i></a>
							 
								<?php
								for($k = 0; $k < count($_Menu_['MenuListeDeroulante'][$_Menu_['MenuTexteBB'][$o]]); $k++)
								{
									if($_Menu_['MenuListeDeroulante'][$_Menu_['MenuTexteBB'][$o]][$k] == '-divider-')
									{
										echo'<a href="#" class="hvr-forward neo-button neo-bar-item ">---</a>';
									}
									else
									{
										echo '<a href="' .$_Menu_['MenuListeDeroulanteLien'][$_Menu_['MenuTexteBB'][$o]][$k]. '" class="neo-hover-gray  neo-bar-item hvr-forward neo-button">' .$_Menu_['MenuListeDeroulante'][$_Menu_['MenuTexteBB'][$o]][$k]. '</a>';
									}
								} 
								?>
								</div>
								<?php
						}	
						else
						{
							echo '<a href="' .$_Menu_['MenuLien'][$o]. '"><button class=" neo-bar-item neo-button hvr-forward">' .$_Menu_['MenuTexte'][$o]. '</button></a>';
						}
					} ?>
			</div><input type="text" class="hidden neo-hide" value="<?php echo $_Serveur_['General']['ipTexte']; ?>" id="neo-copy-ip">
	</div>


</div>
</header>