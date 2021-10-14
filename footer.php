<?php if(!$GLOBALS['domain']) exit;?>

<? 

if($connecte) {
?>

<!--@todo externaliser-->
<aside>
	<div>
		<h2>À la une</h2>
	</div>

	<div>
		<h2>Derniers évènement</h2>
	</div>
</aside>

<footer class="pas">

	<section class="mw960p center grid">

		<?php txt('nav-footer')?>

	</section>
	

	<section class="mod w100">

		<?php txt('webmaster')?>

	</section>


</footer>

<?
}
?>


<!-- fonctions panier -->
<script src="/theme/<?=$GLOBALS['theme']?>/social<?=$GLOBALS['min']?>.js"></script>
