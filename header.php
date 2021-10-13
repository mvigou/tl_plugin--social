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

	<section class="mw960p mod center tc">

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
		
			<div id="profil">
				<ul>
					<li><a href="">Modifier le profil</a></li>
					<li><a href="">Préférences</a></li>
					<li><a href="javascript:void(0);" data-action="deconnexion">Se deconnecter</a></li>
				</ul>

			</div>

			<nav class="mtm mbm">

				<ul class="grid up">
					<?php
					// Extraction du menu
					foreach($GLOBALS['nav'] as $cle => $val)
					{
						// Menu sélectionné si page en cours ou article (actu)
						if(get_url() == $val['href'] or (@$res['type'] == "article" and $val['href'] == "actualites"))
							$selected = " selected";
						else
							$selected = "";

						echo"<li><a href=\"".make_url($val['href'], array("domaine" => true))."\"".($val['id']?" id='".$val['id']."'":"")."".($val['target']?" target='".$val['target']."'":"")." class='".$selected."'>".$val['text']."</a></li>";
					}
					?>
				</ul>

			</nav>

		</div>

		<?
		}
		?>

	</section>

</header>
