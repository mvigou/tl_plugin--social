<?php 
if(!$GLOBALS['domain']) exit;

//controle de la connexion
// SI DÉJÀ CONNECTÉ afficher un message
if(@$_SESSION['uid'] and !@$ajax)
{
	$connecte = true;
}
else
{
	// on force le template à connexion
	$connecte = false;
	$res['tpl'] = 'connexion';
}

?>

<header>

	<section class="pam">

		<div class="center ptm <?if($res['tpl']!='connexion') echo 'editable-hidden';?>">
			<a href="<?=$GLOBALS['home']?>"><?php media('logo', '320')?></a>
		</div>

		<?
		//@toto: gerer la navigation en connexion admin (en js)
		if($connecte) {
		
		?>

		<input type="checkbox" id="burger-visibility" hidden>
		<label for="burger-visibility" id="burger-switch" aria-label="Menu"></label>

		<div id="burger-content">
		
			<div id="mon-profil" class="inbl">

				<?php
					// affichage photo de profil;
					//$profil = json_decode(@$_SESSION['info'],true);

					if(@$_SESSION['info']['photo'])
						$url_photo = $_SESSION['info']['photo'];
					else
						$url_photo = "/theme/".$GLOBALS['theme']."/media/photo-defaut.png";

					//@todo : resize miniature;
				?>

				<img src="<?=$url_photo?>" alt="<?=@$_SESSION['nom']?>" width="50"/>

				<a href="../profil"><?=@$_SESSION['nom']?></a>

				<ul class="pan small">
					<li><a href="../profil/modifier">Modifier le profil</a></li>
					<li><a href="../profil/preferences">Préférences</a></li>
					<li><a href="javascript:void(0);" data-action="deconnexion">Se deconnecter</a></li>
				</ul>

				<!--@todo : menu du profil-->

			</div>

			<nav class="nav">

				<ul class="pan">
					<?php
					// Extraction du menu
					foreach($GLOBALS['nav'] as $cle => $val)
					{
						// Menu sélectionné si page en cours ou article (actu)
						if(get_url() == $val['href'] or (@$res['type'] == "article" and $val['href'] == "actualites"))
							$selected = " selected";
						else
							$selected = "";

						echo"<li><a href=\"".make_url($val['href'], array("domaine" => true))."\"".($val['id']?" id='".$val['id']."'":"")."".($val['target']?" target='".$val['target']."'":"")." class='icon-".make_url($val['text'])." ".$selected."'>".$val['text']."</a></li>";
					}
					?>
				</ul>

			</nav>

			<hr>

			<div>

				<ul class="nav unstyled pan">
					<?php 

						$sel_tag_list = $connect->query("SELECT distinct encode, name FROM ".$table_tag." WHERE zone='categorie' ORDER BY ordre ASC, encode ASC");

						while($res_tag_list = $sel_tag_list->fetch_assoc()) {
							echo'<li><a href="'.make_url('categorie', array($res_tag_list['encode'], 'domaine' => true)).'" class="tdn icon-'.$res_tag_list['encode'].' ">'.$res_tag_list['name'].'</a></li>';
						}
					?>
				</ul>
			</div>

		</div>

		<?
		}
		?>

	</section>

</header>
