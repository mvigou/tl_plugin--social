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

                <input type="file" id="file" name="file" accept="image/jpeg, image/jpg, image/png" hidden>
                <input type="hidden" name="MAX_FILE_SIZE" value="10485760" />

                <label for="file" class="fl mrm">
                    <img id="ma-photo" src="" alt="" width="100"/>
                    <div class="small tc mtt"><i class="fa-upload mrt bigger"></i>Modifier ma photo</div>
                </label>

                <div>
                <?
                    if(@$_SESSION['nom']) echo '<h2 class="mtn">'.$_SESSION['nom'].'</h2>'; else h2('title','mtn biggest');
                ?>
                    <textarea id="bio" name="info[bio]" class="block w80" placeholder="Écrivez quelque chose à propos de vous"></textarea>
                </div>

            </div>
            

            <?txt('texte-rgpd')?>

            <details class="tuile ptm pbm" open>

                <summary>
                    <?h2('contact-titre',array('class' => 'inbl man', 'default' => 'Informations de contact', 'globals' => true))?>
                </summary>

                <article class="mts">

                    <label for="name" class="block">Votre nom</label>
                    <input type="text" id="name" name="info[name]" placeholder="Prénom Nom" value="<?=@$_SESSION['nom']?>" required>
 
                    <label for="phone" class="block">Téléphone</label>
                    <input type="tel" id="phone" name="info[phone]" placeholder="numéro de téléphone" value="<?=@$_SESSION['info']['phone']?>">

                    <label for="email" class="block">Adresse courriel</label>
                    <input type="email" id="email" name="info[email]" placeholder="adresse mail de contact" value="<?=@$_SESSION['email']?>" required>

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
            const photo = document.querySelector("#file");

            photo.addEventListener('change', function(){

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
