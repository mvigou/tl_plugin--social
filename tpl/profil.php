<?php

//fil d'ariane
include_once('./theme/'.$GLOBALS['theme'].'/social.tuile-ariane.php');


$mode = @array_keys($GLOBALS['filter'])[0];

switch($mode) {

    default:
        echo 'defaut';
	break;

    case 'modifier':

        ?>

        <form id="profil-modifier">

            <?
                if(@$_SESSION['nom']) echo '<h1>'.$_SESSION['nom'].'</h1>'; else h1('title');
            ?>

            <?txt('texte-rgpd')?>

            <details open>

                <summary><h2 class="inbl man">Informations de contact</h2></summary>

                <article>

                    <label for="photo">
                        <div>Image de profil</div>
                        <img id="ma-photo" src="<?=$url_photo?>" alt="<?=@$_SESSION['nom']?>" width="100"/>
                    </label>
                    <input type="file" id="photo" name="photo" hidden>

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
           
            <details>

                <summary><h2 class="inbl man">Mon activité</h2></summary>

                <article>

                    <label for="raison-sociale" class="block">Nom commercial</label>
                    <input type="text" id="raison-sociale" name="raison-sociale" placeholder="Nom de mon activité" value="<?=@$_SESSION['info']['raison-sociale']?>">
 
                    <label for="activite" class="block">Mon activité</label>
                    <input type="text" id="activite" name="activite" placeholder="Intitulé de mon métier, de ma fonction" value="<?=@$_SESSION['info']['activite']?>">

                    <label for="competences" class="block">Compétences et expertises</label>
                    <textarea id="competences" name="competence"><?=@$_SESSION['info']['competence']?></textarea>

                    <label for="adresse" class="block">Adresse</label>
                    <textarea id="adresse" name="adresse" class="block" placeholder="votre adresse (n'indiquez que les informations que vous souhaitez communiquer)"><?=@$_SESSION['info']['adresse']?></textarea>

                    <input type="checkbox" id="stagiaires" name="stagiaires">
                    <label for="stagiaires" class="inbl">Je souhaite et je peux accueillir une personne en stage (observation, immersion, etc.)</label>

                </article>

            </details>

            <details>

                <summary><h2 class="inbl man">Mon parcours</h2></summary>

                <article>

                    <label for="conpetences" class="block">Compétences & expertises</label>
                    <textarea id="conpetences" name="conpetences" class="block" placeholder=""><?=@$_SESSION['info']['conpetences']?></textarea>

                    <label for="experiences" class="block">Expériences</label>
                    <textarea id="experiences" name="experiences" class="block" placeholder=""><?=@$_SESSION['info']['experiences']?></textarea>

                    <label for="projets" class="block">Projets</label>
                    <textarea id="projets" name="projets" class="block" placeholder=""><?=@$_SESSION['info']['projets']?></textarea>

                    <label for="interets" class="block">Centres d'intérêt</label>
                    <textarea id="interets" name="experiences" class="block" placeholder=""><?=@$_SESSION['info']['interets']?></textarea>


                </article>

            </details>

            <!--<details open>
                <summary><h2 class="inbl man">Paramètres du compte</h2></summary>
                <article>

                    <label for="email" class="block">Adresse courriel</label>
                    <input type="email" id="email" name="email" placeholder="votre adresse mail de connexion" required>

                    <label for="password" class="block">Mot de passe actuel</label>
                    <input type="password" id="password" name="password" placeholder="Votre mot de passe" required>

                    <label for="password" class="block">Nouveau mot de passe</label>
                    <input type="password" id="password" name="password" placeholder="Votre mot de passe" required>

                    <label for="password" class="block">Confirmation nouveau mot de passe</label>
                    <input type="password" id="password" name="password" placeholder="Votre mot de passe" required>

                </article>
            </details>-->

            <div class="mtm">
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
