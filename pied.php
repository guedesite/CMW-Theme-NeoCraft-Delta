﻿<footer style="margin-top:-25px;margin-bottom:-25px;">
	<div class="neo-bar neo-container neo-xbackground neo-row" >
		<div class="neo-col neo-center-simple neo-margin-left-1" style="width:49%">
			<div class="neo-border-bottom neo-center-simple" style="font-size:25px;">
				<p class="neo-text">Réseaux sociaux</p>
			</div>
				<div style="margin-top:20px;">
					<?php if($_Theme_['Pied']['-facebook'] == 'true') { ?>
					 <a href="<?php echo $_Theme_['Pied']['facebook']; ?>" target="about_blank" class="fa-stack fa-2x hvr-grow">
						 <i class="fa fa-square fa-stack-2x text-facebook"></i>
						 <i class="fab fa-facebook fa-stack-1x fa-inverse"></i>
					 </a>
					 <?php } ?>
					 <?php if($_Theme_['Pied']['-youtube'] == 'true') { ?>
					 <a href="<?php echo $_Theme_['Pied']['youtube']; ?>" target="about_blank" class="fa-stack fa-2x hvr-grow">
						<i class="fa fa-square fa-stack-2x text-youtube"></i>
						<i class="fab fa-youtube fa-stack-1x fa-inverse"></i>
					 </a>
					 <?php } ?>
					 <?php if($_Theme_['Pied']['-discord'] == 'true') { ?>
					 <a href="<?php echo $_Theme_['Pied']['discord']; ?>" target="about_blank" class="fa-stack fa-2x hvr-grow">
						<i class="fa fa-square fa-stack-2x text-discord"></i>
						<i class="fab fa-discord fa-stack-1x fa-inverse"></i>
					 </a>
					 <?php } ?>
					 <?php if($_Theme_['Pied']['-twitter'] == 'true') { ?>
					 <a href="<?php echo $_Theme_['Pied']['twitter']; ?>" target="about_blank" class="fa-stack fa-2x hvr-grow">
						<i class="fa fa-square fa-stack-2x text-twitter"></i>
						<i class="fab fa-twitter fa-stack-1x fa-inverse"></i>
					 </a>
					 <?php } ?>
			 </div>
		</div>
		<div class="neo-col neo-margin-right-1" style="text-align:center;width:49%">
			<div class="neo-border-bottom neo-center-simple" style="font-size:25px;">
					<p class="neo-text">Information</p>
			</div>
			
			<!--

			Merci de laisser le lien cliquable CraftMyWebsite.fr ( cgu ) et de bien vouloir laisser aparètre "guedesite" ou de ne pas vous aproprier le thème, 
			c'est juste un respect que vous devez avoir, vous n'avez pas développé le cms, vous n'avez pas développé le thème, donc par pure respect
			soyez mature, et laisser ces mentions, merci.
			
			-->
			<div  style="display:block;margin-top:20px;" class="neo-text">Thème <a class="neo-text" href="http://www.neocraft.fr/">NeoCraft Delta 2.0.3 </a> adapté par guedesite</div>
			<div  style="display:block;margin-top:10px;margin-bottom:10px;" class="neo-text">Tous droits réservés, site créé pour le serveur <?php echo $_Serveur_['General']['name']; ?></div>
			<div  style="display:block;margin-top:10px;margin-bottom:10px;" class="neo-text"><a class="neo-text" href="http://craftmywebsite.fr">CraftMyWebsite.fr</a>#<?php echo $versioncms; ?> </div>

		</div>
	</div> 
</footer>
