

<div class="neo-content-headline">
	<div class="neo-line-headline" style="width: 100%"><h2><em><strong><span style="font-size:40px">Voter</span></strong></em></h2></div>
</div>
			<div class="neo-center" style="margin-top:10px;">
		
				<div class="neo-radius" style="padding:10px;">
					<p style="max-width:50%;" class="neo-text"><center><strong>
					<h4 class="neo-text"><center><?php echo $_Serveur_['General']['name']; ?> a besoin de vous !</center></h4>
					 Voter pour le serveur permet d'améliorer son référencement ! Les votes sont récompensés par des items In-Game.
					
					</strong></center></p>
				</div>
		
			</div>
	<div class="neo-center">
			<div class="tabbable">
				<?php 

		if(isset($_Joueur_) AND  isset($_GET['player']) AND $_Joueur_['pseudo'] == $_GET['player'] )
		{
			if(!empty($donneesVotesTemp))
			{
				echo '<div class="alert alert-success"><center><ul style="list-style-position: inside; padding-left: 0px;">';
				$p=0;
				$list = array();
				$listNum = array();
				foreach($donneesVotesTemp as $data)
				{
					$flag = false;
					$temp = '<li>';
						$action = explode(':', $data['action'], 2);
						if($action[0] == "give")
						{
							$temp .="Give de ";
							$action = explode(':', $action[1]);
							$temp .=$action[3]. "x ".$action[1];
							if($data['methode'] == 2)
								$temp .=' sur le serveur '.$lecture['Json'][$data['serveur']]['nom'];
							else
								$temp .=' sur tout les serveurs de jeu';
						}
						elseif($action[0] == "jeton")
						{
							$temp .="Give de ".$action[1]." jetons sur le site";
						}
						else
						{
							$temp .="Vous récupérerez une surprise :D :P";
						}

					for($a=0;$a<count($list); $a++) {
						if($list[$a] == $temp) {
							$listNum[$a]++;
							$flag=true;
						}
					}
					if(!$flag) {
						$list[$p] = $temp;
						$listNum[$p]=1;
						$p++;
					}
				}
				
				for($y=0; $y<$p;$y++) {
					if($listNum[$y] > 1) {
						echo $list[$y]." X".$listNum[$y]."</li>";
					} else {
						echo $list[$y]."</li>";
					}
				}
				
				echo "<a class='neo-button neo-green neo-hover-green hvr-bounce-in' href='?action=recupVotesTemp' title='Récupérer mes récompenses'>Récupérer mes récompenses (Connectez-vous sur le serveur)</a></center></div>";
			}

		}
				?>
				<div class=" neo-radius neo-xbackground-50" style="padding:10px;">
					<div class="neo-row-padding ">
					<?php
					if(!isset($jsonCon) OR empty($jsonCon))
						 echo '<p>Veuillez relier votre serveur à votre site avec JsonAPI depuis le panel pour avoir les liens de vote !</p>';
					for($i = 0; $i < count($jsonCon); $i++) { ?>
										
					<a href="javascript:openShop(event, 'categorie-<?php echo $i; ?>');" onclick="openShop(event, 'categorie-<?php echo $i; ?>');">
						<div class="hvr-backward neo-col <?php if($i == 0) { echo 'neo-border-gray'; } ?> tablink neo-bottombar  neo-hover-light-grey neo-padding" style="<?php if(count($jsonCon) == 1) { echo 'width:100%'; } elseif(count($jsonCon) == 2) { echo 'width:50%'; } elseif(count($jsonCon) == 3) { echo 'width:33.33%'; } elseif(count($jsonCon) == 4) { echo 'width:25%'; } elseif(count($jsonCon) == 5) { echo 'width:20%'; } elseif(count($jsonCon) == 6) { echo 'width:16.66%'; } elseif(count($jsonCon) == 7) { echo 'width:14.28%'; } elseif(count($jsonCon) == 8) { echo 'width:12.5%'; } elseif(count($jsonCon) == 9) { echo 'width:11.11%'; } elseif(count($jsonCon) == 10) { echo 'width:100%'; } ?>"><?php echo $lecture['Json'][$i]['nom']; ?></div>
					 </a>
					 
					<?php } ?>
				</div>
			</div>
		<div style="display:none;" id="vote-success1" class="alert alert-success alert-dismissable neo-radius neo-margin-top-1">Votre récompense arrive, si vous n'avez pas vu de fenêtre s'ouvrir pour voter, la fenêtre à dû s'ouvrir derrière votre navigateur, validez le vote et profitez de votre récompense In-Game !<a class="close" data-dismiss="alert" href="#" aria-hidden="true">&times;</a><script>$(".alert").alert()</script></div>
			
			<div class="tab-content">
			<?php if(isset($jsonCon) AND !empty($jsonCon) )
			{
				
				for($i = 0; $i < count($jsonCon); $i++) { ?>
				<div id="categorie-<?php echo $i; ?>" class=" neo-xbackground-50 neo-animate-opacity neo-margin-top-1 neo-margin-bottom-1 neo-tabs neo-radius neo-padding-16" style="display:none;padding:30px;">
							<p>
								<div class="alert alert-dismissable alert-success neo-radius">
									<button type="button" class="close" data-dismiss="alert">×</button>
									<center>Bienvenue dans la catégorie de vote pour le serveur : <?=$lecture['Json'][$i]['nom'];?></center>
								</div>
							</p>
							<div style="text-align:center;">
							
							<?php if(!isset($_GET['player'])) { ?>	
								<div class="panel-body" style="padding:10px;">
									 <h4 class="panel-title text-center">Veuilliez rentrer votre pseudo éxact In-Game :</h4>
										<form  id="forme-vote" role="form" method="GET" action="index.php">
										<input type="text" style="display:none;" name="page" value="voter">
											<div style="width:100%;margin-right:20%;margin-left:20%;" >
												<div class="row">
												 <input type="text" id="vote-pseudo" class="form-control col-12 col-sm-5 col-lg-5" name="player" placeholder="Pseudo" <?php if(isset($_Joueur_)) { echo 'value="'.$_Joueur_['pseudo'].'"'; }?> required>
												<button class="neo-button neo-hover-green neo-green hvr-bounce-in col-12 col-sm-3 col-lg-3" onclick="" type="submit">Suivant !</button>
											   </div>
											</div>
										</form>
								</div>
							<?php } else
							{
							
								
							
							
								$pseudo = htmlspecialchars($_GET['player']);
								
								$enligne = false;
								foreach($serveurStats[$i]['joueurs'] as $key => $value)
								{
									$serveurStats[$i]['joueurs'][$key] = strtolower($value);
									if(isset($pseudo) AND isset($serveurStats[$i]['joueurs']) AND $serveurStats[$i]['joueurs'] AND in_array(strtolower($pseudo), $serveurStats[$i]['joueurs']))
									{
										$enligne = true;
									}
								}
	
								$req_vote->execute(array('serveur' => $i));
								$count_req->execute(array('serveur' => $i));
								$data_count = $count_req->fetch();
								if($data_count['count'] > 0)
								{
									while($liensVotes = $req_vote->fetch())
									{ 
										$id = $liensVotes['id'];
										if(!ExisteJoueur($pseudo, $id, $bddConnection))
										{
											CreerJoueur($pseudo, $id, $bddConnection);
										}
										$donnees = RecupJoueur($pseudo, $id, $bddConnection);
										$lectureVotes = LectureVote($id, $bddConnection); 
										$action = explode(':', $lectureVotes['action'], 2);
										if(!Vote($pseudo, $id, $bddConnection, $donnees, $lectureVotes['temps']))
										{
											echo '<button type="button" class="neo-button neo-gray" style="margin-top:5px; margin-right:5px;" disabled>'.GetTempsRestant($donnees['date_dernier'], $lectureVotes['temps'], $donnees).'</button>';
										}
										else if($action[0] != "jeton" || isset($_Joueur_))
										{
											if($lectureVotes['enligne'] == 1 && !$enligne) 
											{
												echo '<button type="button" class="neo-button neo-red" style="margin-top:5px; margin-right:5px;" disabled>Vous devez être connecté sur le serveur pour pouvoir voter sur ce site.</button>';
										
											} else {
												echo '<a href="'.$liensVotes['lien'].'" style="margin-top:5px;" id="btn-lien-'.$id.'" target="_blank" onclick="document.getElementById(\'btn-lien-'.$id.'\').style.display=\'none\';document.getElementById(\'btn-verif-'.$id.'\').style.display=\'inline\';bouclevote('.$id.',\''.$pseudo.'\');" class="neo-button neo-green hvr-bounce-in neo-hover-green" >'.$liensVotes['titre'].'</a>
													  <button id="btn-verif-'.$id.'" style="margin-top:5px; display:none;" type="button" class="neo-button neo-red" disabled>Vérification en cours ...</button>
													  <button type="button" style="margin-top:5px; display:none;" id="btn-after-'.$id.'" class="neo-button neo-gray" disabled>'.TempsTotal($lectureVotes['temps']).'</button>
													';
											}
										} else {
											echo '<button type="button" class="neo-button neo-red" style="margin-top:5px; margin-right:5px;" disabled>Vous devez être connecté sur le site pour pouvoir voter sur ce site.</button>';
										
										}
									}
								}
								?>
								</div>
				</div>
			<?php }  }?>
			</div>
		</div>
	</div>

	<div class="neo-center neo-container neo-responsive neo-radius neo-padding-16">
		<h2 class="header-bloc">Top voteurs <i class="fas fa-trophy"></i></h2>
			<div class="corp-bloc">

				<table class="neo-table neo-striped neo-bordered neo-hoverable">

					<thead>
						<tr class="neo-light-grey"><th>#</th><th>Pseudo</th><th>Votes</th></tr>
					</thead>
				
						<?php for($i = 0; $i < count($topVoteurs) AND $i < 10; $i++) { 
						$Img = new ImgProfil($topVoteurs[$i]['pseudo'], 'pseudo');?>
						<tr class="neo-white"><td><?php echo $i +1; ?></td><td><img src="<?=$Img->getImgToSize(30, $width, $height);?>" alt="" style="height:30px; width:30px;"/> <strong><?php echo $topVoteurs[$i]['pseudo']; ?></strong></td><td id="nbr-vote-<?php echo $topVoteurs[$i]['pseudo']; ?>"><?php echo $topVoteurs[$i]['nbre_votes']; ?></td></tr>
						<?php }?>
				</table>
			</div>
	</div>
		<?php	
	
function TempsTotal($tempsRestant)
{
	$tempsH = 0;
	$tempsM = 0;
	while($tempsRestant >= 3600)
		{
			$tempsH = $tempsH + 1;
			$tempsRestant = $tempsRestant - 3600;
		}
		while($tempsRestant >= 60)
		{
			$tempsM = $tempsM + 1;
			$tempsRestant = $tempsRestant - 60;
		}
		if($tempsH == 0)
		{
			return $tempsM.' minute(s)';
		}
		else if ($tempsM <= 9)
		{
			return $tempsH. 'H0' .$tempsM;
		}
		else
		{
			return $tempsH. 'H' .$tempsM;
		}
}
function RecupJoueur($pseudo, $id, $bddConnection)
	{
		$line = $bddConnection->prepare('SELECT * FROM cmw_votes WHERE pseudo = :pseudo AND site = :site');
		$line->execute(array(
			'pseudo' => $pseudo,
			'site' => $id	));
		$donnees = $line->fetch(PDO::FETCH_ASSOC);	
		return $donnees;
	}
	
	function Vote($pseudo, $id, $bddConnection, $donnees, $temps)
	{
		if($donnees['date_dernier'] + $temps < time())
		{
			return true;
		}
		else 
			return false;
	}
	
	function ExisteJoueur($pseudo, $id, $bddConnection)
	{
		$line = $bddConnection->prepare('SELECT * FROM cmw_votes WHERE pseudo = :pseudo AND site = :site');
		$line->execute(array(
			'pseudo' => $pseudo,
			'site' => $id	));
			
		$donnees = $line->fetch(PDO::FETCH_ASSOC);
		
		if(empty($donnees['pseudo']))
			return false;
		else
			return true;
	}
	
	function CreerJoueur($pseudo, $id, $bddConnection)
	{
		$req = $bddConnection->prepare('INSERT INTO cmw_votes(pseudo, site) VALUES(:pseudo, :site)');
		$req->execute(array(
			'pseudo' => $pseudo,
			'site' => $id
			));
	}
	
	function GetTempsRestant($temps, $tempsTotal, $donnees)
	{
		$tempsEcoule = time() - $temps;
		$tempsRestant = $tempsTotal - $tempsEcoule;
		$tempsH = 0;
		$tempsM = 0;
		while($tempsRestant >= 3600)
		{
			$tempsH = $tempsH + 1;
			$tempsRestant = $tempsRestant - 3600;
		}
		while($tempsRestant >= 60)
		{
			$tempsM = $tempsM + 1;
			$tempsRestant = $tempsRestant - 60;
		}
		if($tempsM <= 9)
		{
			return $tempsH. 'H0' .$tempsM;
		}
		else
		{
			return $tempsH. 'H' .$tempsM;
		}
	}

	function LectureVote($id, $bddConnection)
	{
		$req = $bddConnection->prepare('SELECT * FROM cmw_votes_config WHERE id = :id');
		$req->execute(array('id' => $id));
		return $req->fetch(PDO::FETCH_ASSOC);
	}
	?>
	
	
