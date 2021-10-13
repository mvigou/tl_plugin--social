<?php if(!$GLOBALS['domain']) exit;?>

<?php
//insertion du formulaire de rédaction d'un message
include_once('./theme/'.$GLOBALS['theme'].'/social.tuile-post.php');

?>

<section class="mw960p center">

	<?
	// Si on n'a pas les droits d'édition des articles on affiche uniquement ceux actifs
	

	// Navigation par page
	$num_pp = 5;

	if(isset($GLOBALS['filter']['page'])) $page = (int)$GLOBALS['filter']['page']; else $page = 1;

	$start = ($page * $num_pp) - $num_pp;

	// Construction de la requete
	$sql ="SELECT SQL_CALC_FOUND_ROWS ".$tc.".id, ".$tc.".* FROM ".$tc;

	$sql.=" WHERE (".$tc.".type='post') AND ".$tc.".lang='".$lang."'
	ORDER BY ".$tc.".date_insert DESC
	LIMIT ".$start.", ".$num_pp;

	$sel_fiche = $connect->query($sql);

	$num_total = $connect->query("SELECT FOUND_ROWS()")->fetch_row()[0];// Nombre total de fiche

	while($res_fiche = $sel_fiche->fetch_assoc())
	{
		$content_fiche = json_decode($res_fiche['content'],true);

		?>
			<article class="tuile">

				<div>

				</div>

				<?=$content_fiche['texte']?>

				<aside>

					<a href="<?=$res_fiche['url']?>" title="Écrire un commentaire">⌨</a>

					<a href="<?=$res_fiche['url']?>" title="Lire la suite du message publié par le">⋯</a>

				<aside>

			</article>
		<?
	}
	?>

	<aside>

		<?page($num_total, $page);?>

	</aside>


</section>