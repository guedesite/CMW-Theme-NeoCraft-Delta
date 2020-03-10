    <?php if($pages['titre'] == "" && $pageContenu[$j][0] == ""){ ?>
    <style>
    .error-template {padding: 40px 15px;text-align: center;}
    .error-actions {margin-top:15px;margin-bottom:15px;}
    .error-actions .btn { margin-right:10px; }
    </style>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="error-template">
                    <h1>
                        Oups!</h1>
                    <h2>
                        Erreur 404</h2>
                    <div class="error-details">
                        Désolé mais la page demandé est introuvable ! :(
                    </div>
                    <div class="error-actions">
                        <a href="index.php" class="neo-button neo-gray">
                            Retourner sur l'accueil</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php } else { ?>

			<div class="neo-content-headline">
				<div class="neo-line-headline" style="width: 100%"><h2><em><strong><span style="font-size:40px"><?php echo $pages['titre']; ?></span></strong></em></h2></div>
			</div>
					<div class="container" style="padding:10px;">
					<?php for($j = 0; $j < count($pages['tableauPages']); $j++) { ?>
						<h3 class="neo-center"><?php echo $pageContenu[$j][0]; ?></h3>
						<div><?php echo $pageContenu[$j][1]; ?></div>		
					<?php } ?>
					</div>
	<?php } ?>