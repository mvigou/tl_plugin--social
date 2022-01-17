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

	<section class="pas ptm pbm">

		<div class="<?if(@$res['tpl']!='connexion' && !@$_SESSION['auth']['edit-page']) echo 'editable-hidden';?>">
			<?if($res['tpl']!='connexion' && @$_SESSION['auth']['edit-page']) {?>

				<details id="configuration-connexion" class="mw260p right mbs">

					<summary>
						<i class="fa-cog big vam"></i>
						<span class="small vam">Configuration écran connexion</span>
					</summary>

					<div>
				
			<?}?>

					<?php media('logo', array('size' => '200', 'class' => 'w100'))?>
					<?h1('titre','biggest black')?>
					<?txt('presentation')?>
		
			<?
			if($res['tpl']!='connexion' && @$_SESSION['auth']['edit-page']) {?>
					</div>
				</details>
			<?}?>
		</div>

		<?
		if($connecte) {
		
		?>

			<input type="checkbox" id="burger-visibility" hidden>
			<label for="burger-visibility" id="burger-switch" aria-label="Menu"></label>

			<div id="burger-content" class="mw260p right plm prm">
			
				<div id="mon-profil" class="inbl clear">

					<?php
						// affichage photo de profil;
						//$profil = json_decode(@$_SESSION['info'],true);

						if(@$_SESSION['info']['photo'])
							$url_photo = $_SESSION['info']['photo'];
						else
							$url_photo = "/theme/".$GLOBALS['theme']."/media/photo-defaut.png";

						//@todo : resize miniature;
					?>

					<img src="<?=$url_photo?>" alt="<?=@$_SESSION['nom']?>" width="50" class="fl"/>

					<a href="../profil" title="acceder à mes publications" class="color-green bold"><?=@$_SESSION['nom']?></a>

					<ul id="acces-rapide" class="unstyled pan smaller">
						<li><a href="../profil/modifier">Modifier le profil</a></li>
						<li><a href="../profil/preferences">Préférences</a></li>
						<li><a href="javascript:void(0);" data-action="deconnexion">Se deconnecter</a></li>
					</ul>

					<!--@todo : menu du profil-->

				</div>

				<!-- navigation  -->
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

							echo"<li><a href=\"".make_url($val['href'], array("domaine" => true))."\"".($val['id']?" id='".$val['id']."'":"")."".($val['target']?" target='".$val['target']."'":"")." class='fa-".make_url($val['text'])." ".$selected."'>".$val['text']."</a></li>";
						}
						?>
					</ul>

				</nav>

				<hr>

				<!-- catégorie -->
				<div>

					<ul class="nav unstyled pan">
						<?php 

							$sel_tag_list = $connect->query("SELECT distinct encode, name FROM ".$table_tag." WHERE zone='categorie' ORDER BY ordre ASC, encode ASC");

							while($res_tag_list = $sel_tag_list->fetch_assoc()) {

								if($res_tag_list['encode'] == @array_keys($GLOBALS['filter'])[0])
									$selected = " selected";
								else
									$selected = "";

								echo'<li><a href="'.make_url('categorie', array($res_tag_list['encode'], 'domaine' => true)).'" class="tdn fa-'.$res_tag_list['encode'].' '.$selected.' ">'.$res_tag_list['name'].'</a></li>';
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
