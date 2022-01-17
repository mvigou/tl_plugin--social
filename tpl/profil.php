<?php

//fil d'ariane
include_once('./theme/'.$GLOBALS['theme'].'/social.tuile-ariane.php');

$mode = @array_keys($GLOBALS['filter'])[0];

switch($mode) {

    default:
        @include_once('publications-liste.php');
	break;

    // on met à jour les informations
    // @todo: passer comme le formulaire de contact pour encoder les caractères spéciaux ?
    case 'modifier':

        ?>

        <form id="profil-modifier">

            <h1 class="pam man">Modifier le profil</h1>

            <div class="tuile pbm clearfix mts">

                <input type="file" id="photo" name="photo" hidden>
                <label for="photo" class="fl">
                    <img id="ma-photo" src="<?=$url_photo?>" alt="<?=@$_SESSION['nom']?>" width="100"/>
                    <div class="small tc mtt"><i class="fa-upload mrt bigger"></i>Modifier ma photo</div>
                </label>

                
                <?
                    if(@$_SESSION['nom']) echo '<h2 class="">'.$_SESSION['nom'].'</h2>'; else h2('title','biggest');
                ?>

            </div>
            

            <?txt('texte-rgpd')?>

            <details class="tuile ptm pbm" open>

                <summary>
                    <?h2('contact-titre',array('class' => 'inbl man', 'default' => 'Informations de contact', 'globals' => true))?>
                </summary>

                <article class="mts">

                    <label for="name" class="block">Votre nom</label>
                    <input type="text" id="name" name="name" placeholder="Prénom Nom" value="<?=@$_SESSION['nom']?>" required>
 
                    <label for="phone" class="block">Téléphone</label>
                    <input type="tel" id="phone" name="phone" placeholder="numéro de téléphone" value="<?=@$_SESSION['info']['phone']?>">

                    <label for="email" class="block">Adresse courriel</label>
                    <input type="email" id="email" name="email" placeholder="adresse mail de contact" value="<?=@$_SESSION['email']?>" required>

                    <label for="web" class="block">Site web / page web</label>
                    <input type="url" id="web" name="web" placeholder="https://" value="<?=@$_SESSION['info']['web']?>">

                </article>

            </details>

            <div class="mtm pam tc">
                <button class="bt-primary">
                    Enregistrer les modifications
                </button>
            </div>

        </form>

        <script>
            //upload dynamique de la photo (code à dupliquer dans social.ajax.php)
            const photo = document.querySelector("#photo");

            photo.addEventListener('change', function(){
           
                console.log(this.files);
                img = document.querySelector("#ma-photo");
                img.src = URL.createObjectURL(this.files[0]);

            }); 
        </script>

        <?
	break;

    case 'preferences':
        echo 'préférence';
	break;
}

?>
