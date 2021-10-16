<?php  if(!$GLOBALS['domain']) exit; ?>

<?php

//fil d'ariane
include_once('./theme/'.$GLOBALS['theme'].'/social.tuile-ariane.php');

$mode = @array_keys($GLOBALS['filter'])[0];
?>

<?
switch($mode) {

	//on affiche la liste des users
	default:
	?>
	<section class="">

		<?h2('title','tuile pbm mbn')?>

		<?php 
		// Si on n'a pas les droits d'édition des articles on affiche uniquement ceux actifs
		//if(!@$_SESSION['auth']['edit-article']) $sql_state = "AND state='active'";
		//else $sql_state = "";

		// Navigation par page
		$num_pp = 20;

		if(isset($GLOBALS['filter']['page'])) $page = (int)$GLOBALS['filter']['page']; else $page = 1;

		$start = ($page * $num_pp) - $num_pp;

		// Construction de la requete
		$sql ="SELECT SQL_CALC_FOUND_ROWS ".$tu.".id, ".$tu.".name, ".$tu.".email, ".$tu.".info FROM ".$tu;

		// Si filtre tag
		/*if(isset($tag))
		$sql.=" RIGHT JOIN ".$tt."
		ON
		(
			".$tt.".id = ".$tc.".id AND
			".$tt.".zone = 'actualites' AND
			".$tt.".encode = '".$tag."'
		)";*/

		$sql.=" ORDER BY ".$tu.".date_insert DESC
		LIMIT ".$start.", ".$num_pp;

		$sel_fiche = $connect->query($sql);

		$num_total = $connect->query("SELECT FOUND_ROWS()")->fetch_row()[0];// Nombre total de fiche

		while($res_fiche = $sel_fiche->fetch_assoc())
		{
			// Affichage du message pour dire si l'article est invisible ou pas
			$content_fiche = json_decode($res_fiche['info'], true);
			?>
			<article class="relative tuile clearfix ptm pbm">

				<?php
						// affichage photo de profil;
						//$profil = json_decode(@$_SESSION['info'],true);

						if(@$content_info['photo'])
							$url_photo = $content_info['photo'];
						else
							$url_photo = "/theme/".$GLOBALS['theme']."/media/photo-defaut.png";

							//@todo : resize miniature;
				?>

				<a href="<?=make_url($res['url'], array_merge($GLOBALS['filter'], array("membre" => $res_fiche['id'], "domaine" => true)))?>" class="tdn">
					
					<div class="fl mrs">
						<img src="<?=$url_photo?>" alt="<?=@$_SESSION['nom']?>" width="50"/>
					</div>

					<h3 class="medium bold man">
						
						<?=$res_fiche['name']?>
					</h3>

					<p>
						<?=@$content_fiche['raison-sociale'];?> 
						<?if(@$content_fiche['activite']) echo '· '.$content_fiche['activite'];?>
					</p>

				</a>

			</article>

			
		<?php 
		}

		?>

		<aside><?page($num_total, $page);?></aside>
		</section>

		<?

	break;

	// fiche d'un membre
	case 'membre':

		$uid = (int)$GLOBALS['filter']['membre'];

		// Construction de la requete
		$sql ="SELECT SQL_CALC_FOUND_ROWS ".$tu.".id, ".$tu.".name, ".$tu.".email, ".$tu.".info FROM ".$tu;

		$sql.= " WHERE ".$tu.".id=".$uid;

		$sel_fiche = $connect->query($sql);

		$res_fiche = $sel_fiche->fetch_assoc();
		
		// Affichage du message pour dire si l'article est invisible ou pas
		$content_fiche = json_decode($res_fiche['info'], true);
		?>

		<section>

			<?php
				// affichage photo de profil;
				//$profil = json_decode(@$_SESSION['info'],true);

				if(@$content_info['photo'])
					$url_photo = $content_info['photo'];
				else
					$url_photo = "/theme/".$GLOBALS['theme']."/media/photo-defaut.png";

				//@todo : resize miniature;
			?>

			<div class="tuile ptm pbm clearfix">

				<div class="fl mrs">
					<img src="<?=$url_photo?>" alt="<?=@$_SESSION['nom']?>" width="100"/>
				</div>
					
				<h2 class="mbn"><?=$res_fiche['name']?></h2>

				<p>
					<?=@$content_fiche['raison-sociale'];?> 
					<?if(@$content_fiche['activite']) echo '· '.$content_fiche['activite'];?>
				</p>

			</div>
		
			<article class="relative tuile clearfix ptm pbm">


					
					

					

					

				</a>

			</article>

		</section>

		<?php 

	break;

}
?>

</section>

