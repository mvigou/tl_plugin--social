<?php if(!$GLOBALS['domain']) exit;?>

<? 

if($connecte) {
?>

<!--@todo externaliser-->
<aside class="pam">
	<div class="mw260p">
		<?h2('a-la-une',array('class'=>'mtn', 'default' => 'À la une'))?>
	</div>

	<div class="mw260p">
		<?h2('dernier-evenements',array('class'=>'mtn', 'default' => 'Derniers évènement'))?>
	</div>
</aside>

<?
}
?>

<footer class="pas small">

	<section class="mw260p right plm prm">

		<?php span('nav-footer')?>

	</section>
	

	<section class="mw260p right mts  plm prm">

		<?php txt('webmaster')?>

	</section>


</footer>



<!-- fonctions panier -->
<script src="/theme/<?=$GLOBALS['theme']?>/social<?=$GLOBALS['min']?>.js"></script>
