<?php if(!$GLOBALS['domain']) exit;?>

<div>
<?php
//fil d'ariane
include_once('./theme/'.$GLOBALS['theme'].'/social.tuile-ariane.php');

//formulaire publication
include_once('./theme/'.$GLOBALS['theme'].'/social.tuile-post.php');

?>
</div>

<section id="flux" class="w100 center">

	<?
	// Si on n'a pas les droits d'édition des articles on affiche uniquement ceux actifs
	

	// Navigation par page
	$num_pp = 15;

	if(isset($GLOBALS['filter']['page'])) $page = (int)$GLOBALS['filter']['page']; else $page = 1;

	$start = ($page * $num_pp) - $num_pp;

	// Construction de la requete
	$sql ="SELECT SQL_CALC_FOUND_ROWS ".$tc.".id, ".$tc.".*, ".$tu.".id as uid, ".$tu.".name, ".$tu.".info FROM ".$tc;

	// Si filtre tag
	if(isset($tag))
	$sql.=" RIGHT JOIN ".$tt."
	ON
	(
		".$tt.".id = ".$tc.".id AND
		".$tt.".zone = 'categorie' AND
		".$tt.".encode = '".$tag."'
	)";

	$sql.= " RIGHT JOIN ".$tu."
	ON
	(
		".$tc.".user_insert = ".$tu.".id 
	)";

	$sql.=" WHERE (".$tc.".type='post') AND ".$tc.".lang='".$lang."'
	ORDER BY ".$tc.".date_insert DESC
	LIMIT ".$start.", ".$num_pp;

	$sel_fiche = $connect->query($sql);

	$num_total = $connect->query("SELECT FOUND_ROWS()")->fetch_row()[0];// Nombre total de fiche

	while($res_fiche = $sel_fiche->fetch_assoc())
	{
		$content_fiche = json_decode($res_fiche['content'],true);
		$content_info = json_decode($res_fiche['info'],true);

		?>
			<article id="<?=@$res_fiche['id']?>" class="relative tuile publication <?=make_url(@$content_fiche['dans'])?>">

				<?php
					// affichage photo de profil;
					//$profil = json_decode(@$_SESSION['info'],true);

					if(@$content_info['photo'])
						$url_photo = $content_info['photo'];
					else
						$url_photo = "/theme/".$GLOBALS['theme']."/media/photo-defaut.png";

						//@todo : resize miniature;
				?>

				<div>
					<img src="<?=$url_photo?>" alt="<?=@$_SESSION['nom']?>" width="50"/>
				</div>
				

				<div>

					<?if(@$content_fiche['titre']) echo '<h2'.$content_fiche['titre'].'</h2>';?>
					<p>
						<div class="small ptt pbt">

							<?if(@$res_fiche['name']){?>
								<cite class="bold">
									<?=$res_fiche['name']?>
								</cite>
							<?}?>

							<?if(@$res_fiche['date_insert']){?>
								<i class="fa fa-clock mlm"></i>
								<time datetime="<?=$res_fiche['name']?>">
									<?=date('d/m/Y',strtotime($res_fiche['date_insert']))?>
								</time>
							<?}?>


							<?
							if(!empty(@$content_fiche['dans'])){?>
							<a href="categorie/<?=make_url($content_fiche['dans'])?>" class="mlm categorie" title="filtrer par <?=lcfirst($content_fiche['dans'])?>">
								<i class="fa fa-tag"></i>
								<?=$content_fiche['dans']?>
							</a>
							<?}?>
						</div>
						

						<?=$content_fiche['texte']?>
					</p>

					<aside class="mtm big">

						<a href="<?=$res_fiche['url']?>" title="Écrire un commentaire" class="grey mrt">
							<i class="fa fa-reply inbl "></i>
						</a>

						<a href="<?=$res_fiche['url']?>" title="Afficher le message en entier" class="grey mrt">
							<i class="fa-ellipsis-vert r90 inbl prs"></i>
						</a>

					<aside>

				</div>

			</article>
		<?
	}
	?>

	<aside>

		<?page($num_total, $page);?>

	</aside>


</section>

