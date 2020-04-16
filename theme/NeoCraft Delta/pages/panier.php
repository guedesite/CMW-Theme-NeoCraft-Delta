<?php if(isset($_Joueur_)){?>
<div class="neo-content-headline">
	<div class="neo-line-headline" style="width: 100%"><h2><em><strong><span style="font-size:40px"><i class="fa fa-shopping-basket"></i> Panier</span></strong></em></h2></div>
</div>

		<?php if(isset($_GET['success']) && $_GET['success'] == 'true') { ?>
	
			<p>
				<div class="alert alert-dismissable alert-success neo-radius neo-center-small">
					<button type="button" class="close" data-dismiss="alert">×</button>
					<center>Votre achat a été effectué !</center>
				</div>
			</p>
							
        <?php } ?>

	<div class="neo-responsive" style="margin-bottom:20px;">
		<table class="neo-table-all ">
			<thead>
				<tr class="neo-light-grey">
					<th>Item/Grade</th>
					<th>Description</th>
					<th>Quantite</th>
					<th>Prix Unitaire</th>
					<th>Sous-Total</th>
					<th>Actions</th>
				</tr>
			</thead>
			<tbody>
            	<?php $nbArticles = $_Panier_->compterArticle();
                $precedent = 0;
            	if($nbArticles == 0 )
            		echo '<tr><td colspan="6"><center>Votre panier est vide :\'( </center></td></tr>';
            	else
            	{
	            	for($i = 0; $i < $nbArticles; $i++)
	            	{
	            		?>
	            		<tr class="neo-white">
		                    <td class="neo-border neo-center"><?php $_Panier_->infosArticle(htmlspecialchars($_SESSION['panier']['id'][$i]), $nom, $infos); echo $nom; ?></td>
		                    <td class="neo-border neo-center"><?php echo $infos; ?></td>
		                    <td class="neo-border neo-center"><?php echo htmlspecialchars($_SESSION['panier']['quantite'][$i]); ?></td>
		                    <td class="w-25 neo-border text-center"><?php echo htmlspecialchars($_SESSION['panier']['prix'][$i]); ?> <i class="fas fa-gem"></i></td>
		                    <td class="w-25 neo-border text-center"><?php $precedent += htmlspecialchars($_SESSION['panier']['prix'][$i])*htmlspecialchars($_SESSION['panier']['quantite'][$i]);
		                    echo $precedent; ?> <i class="fas fa-gem"></i></td>
                            <td class="neo-border neo-center"><a href="?action=supprItemPanier&id=<?php echo htmlspecialchars($_SESSION['panier']['id'][$i]); ?>" class="btn btn-danger link" title="supprimer l'item du panier"><i class="fa fa-trash"></i></a></td>
		                </tr>
		               <?php
		            } 
                    if(!empty($_SESSION['panier']['reduction']))
                    {
                        echo '<tr><td>'.htmlspecialchars($_SESSION['panier']['code']).'</td><td>'.htmlspecialchars($_SESSION['panier']['reduction_titre']).'</td><td>1</td><td class="w-25 text-center">-'. $_SESSION['panier']['reduction']*100 .'%</td><td></td><td><a href="?action=retirerReduction" class="btn btn-danger link" title="supprimer la réduction"><i class="fa fa-trash"></i></a></td></tr>';
                    }
		        }
		        ?>
		        <tr class="neo-light-grey"> 
		        	<td class="neo-border">Total:</td>
		        	<td class="w-25 text-center neo-border" colspan="5"><?php echo number_format($_Panier_->montantGlobal(), 0, ',', ' '); ?> <i class="fas fa-gem"></i></td>
		        </tr>
            </tbody>
        </table>
		
		<form class="form-inline neo-margin-top-1 neo-float-left neo-xbackground" action="?action=ajouterCode" method="POST">
            <div class="form-group">
                <input type="text" class="neo-input" id="codepromo" name="codepromo" placeholder="Code promo" style="border:0px;">
            </div>
            <button type="submit" class="neo-button neo-gray hvr-forward" >Envoyer</button>
        </form>
        <div class="neo-float-right neo-margin-top-1">
            <a href="?action=viderPanier"><button class="neo-button neo-red hvr-float-shadow">Vider le panier !</button></a>
            <a href="?action=achat"><button class="neo-button neo-green hvr-float-shadow">Acheter !</button></a>
        </div>

		
	
	</div>
<?php }else{ header('Location: ?page=boutique'); }?>
	