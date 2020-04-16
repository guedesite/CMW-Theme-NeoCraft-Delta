<?php 

if(isset($_Joueur_) AND ($_PGrades_['PermsForum']['moderation']['seeSignalement'] == true OR $_Joueur_['rang'] == 1))
{
	$req = $bddConnection->query('SELECT * FROM cmw_forum_report WHERE vu = 0');
	?>
	
<div class="neo-content-headline">
	<div class="neo-line-headline" style="width: 100%"><h2><em><strong><span style="font-size:40px">Signalement</span></strong></em></h2></div>
</div>
		<h2 class="header-bloc">Gestion des signalements</h2>
			<div class="corp-bloc">

				<table class="neo-table neo-striped neo-bordered neo-hoverable" style="margin-bottom:15px;">

					<thead>
						<caption>Tableau récapitulatif de vos signalement </caption>
						<tr class="neo-light-grey">
							<th>Type de report</th>
							<th>Raison</th>
							<th>Reporteur</th>
							<th>Lien</th>
						</tr>
					</thead>
				<?php 
				while($data = $req->fetch())
				{
					?><tr class="neo-white">
						<td><?php if($data['type'] == 0)
						{
							echo 'Topic';
						}
						else
						{
							echo 'Réponse';
						}
						?></td>
						<td><?php echo $data['reason']; ?></td>
						<td><?php echo $data['reporteur']; ?></td>
						<td><?php 
						if($data['type'] == 0)
						{
							?><a href="index.php?action=r_t_vu&id=<?php echo $data['id_topic_answer']; ?>">Voir le topic</a><?php
							
						}
						else
						{
							$req_topic = $bddConnection->prepare('SELECT * FROM cmw_forum_answer WHERE id = :id');
							$req_topic->execute(array(
								'id' => $data['id_topic_answer']
							));
							$id = $req_topic->fetch();
							$req_page = $bddConnection->prepare('SELECT * FROM cmw_forum_answer WHERE id_topic = :id');
							$req_page->execute(array(
								'id' => $id['id_topic']
							));
							$d_page = $req_page->fetchAll();
							foreach($d_page as $key => $value)
							{
								if($d_page[$key]['id'] == $data['id_topic_answer'])
								{
									$ligne = $key;
								}
							}
							$ligne++;
							$tour = 1;
							unset($d);
							unset($page);
							while($d != TRUE)
							{
								$nb = 20 * $tour;
								if($nb >= $ligne)
								{
									$page = $tour;
									$d = TRUE;
								}
								else
								{
									$tour++;
								}
							}
							?><a href="index.php?action=r_a_vu&id_a=<?php echo $data['id_topic_answer']; ?>&id=<?php echo $id['id_topic']; ?>&page_post=<?php echo $page; ?>">Lien vers la réponse</a><?php
						}
						?></td>
					</tr><?php
				}
				?></table>
			</div>
<?php 
} ?>

