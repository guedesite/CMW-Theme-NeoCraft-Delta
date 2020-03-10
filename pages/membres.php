<?php 
include('theme/' .$_Serveur_['General']['theme']. '/app/membres.class.php');
$Membres = new MembresPage($bddConnection);
if(isset($_GET['page_membre']))
{
	$page = htmlentities($_GET['page_membre']);
	$membres = $Membres->getMembres($page);
}
else
{
	$page = 1;
	$membres = $Membres->getMembres();
}
?>
<div class="neo-content-headline">
	<div class="neo-line-headline" style="width: 100%"><h2><em><strong><span style="font-size:40px">Membres</span></strong></em></h2></div>
</div>
			<div class="neo-center" style="margin-top:10px;">
				<div class="neo-radius" style="padding:10px;">
					<p style="max-width:50%;" class="neo-text"><center><strong>
						Ici, vous pourrez consulter la liste des membres du site, voir leur profil ...
						<input type="text" id="neo-s-input" class="neo-input neo-margin-right-5 neo-margin-left-5" style="width:90%;" onkeyup="neosearch()" placeholder="Chercher un joueur">
					</strong></center></p>
				</div>
			</div>


			 <table id="neo-s-index" class="neo-table neo-hoverable neo-striped neo-bordered" style="margin-bottom:20px;">
				<thead>
					<tr>
						<th scope="col">#</th>
						<th scope="col">Pseudo</th>
						<th scope="col">Grade Site</th>
						<th scope="col">Jetons</th>
					</tr>
				</thead>
				<tbody id="tableMembre">
					<?php
						foreach($membres as $value)
						{
							$Img = new ImgProfil($value['id']);
							?><tr>
								<td><a href="?page=profil&profil=<?=$value['pseudo'];?>" style="color: inherit;"><?=$value['id'];?></a></td>
								<td><a href="?page=profil&profil=<?=$value['pseudo'];?>" style="color: inherit;"><img src='<?=$Img->getImgToSize(32, $width, $height);?>' style='width: <?=$width;?>px; height: <?=$height;?>px;' alt='Profil' /> <?=$value["pseudo"];?></a></td>
								<td><a href="?page=profil&profil=<?=$value['pseudo'];?>" style="color: inherit;"><?=$Membres->gradeJoueur($value["pseudo"]);?></td>
								<td><a href="?page=profil&profil=<?=$value['pseudo'];?>" style="color: inherit;"><?=$value['tokens'];?></a></td>
							</tr>
							<?php
						}
					?>
				</tbody>
			</table>

<script>
function neosearch() {
  var input, filter, table, tr, td, i;
  input = document.getElementById("neo-s-input");
  filter = input.value.toUpperCase();
  table = document.getElementById("neo-s-index");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[0];
    if (td) {
      if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }       
  }
}
</script>
