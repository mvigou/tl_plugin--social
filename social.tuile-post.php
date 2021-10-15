<form id="publication" class="w100 ">

    <section class="tuile ptn clear">

        <label for="texte"><?h2('titre-post','')?></label>

        <input type="radio" name="type" id="type-publication" value="post" hidden checked>
        <input type="radio" name="type" id="type-evenement" value="event" hidden>

        <div id="type" class="mbm clearfix">

            <label for="type-publication" class="fl">Publication</label>
            <label for="type-evenement" class="fl">Evènement</label>

        </div>

        <div id="contenu" class="mbm">

            <div class="vue-publication mbt">

                <label for="dans">Publier dans : </label>
                <select name="dans" id="dans">

                    <option value="">Flux dactualité</option>

                    <optgroup label="Categorie">
                        <option value="Actualité" <?if(@$tag=='actualite') echo 'selected';?>>Actualité</option>
                        <option value="Annonce" <?if(@$tag=='annonce') echo 'selected';?>>Annonce</option>
                        <option value="Petite annonce" <?if(@$tag=='petite-annonce') echo 'selected'?>>Petite annonce</option>
                    </optgroup>

                    <optgroup label="Mes groupes">
                    </optgroup>
                    
                </select>

            </div>

            <div class="vue-evenement">

                <label for="titre" class="block">Nom de l'évènement</label>
                <input type="text" id="titre" name="titre" class="w100">

                <label for="adresse" class="block">Lieux de l'évènement</label>
                <textarea id="adresse" name="adresse" class="w100" placeholder="Indiquer l'emplacement de l'évènement"></textarea>

                <div class="mtt mbt">
                    <label for="date-debut">du</label>
                    <input type="datetime-local" id="date-debut" name="date-debut">

                    <label for="date-debut">au</label>
                    <input type="datetime-local" id="date-fin" name="date-fin">
                </div>

            </div>
            
            <textarea id="texte" name="texte" class="w100" placeholder="Que souhaitez-vous partager ?" required></textarea>

        </div>

        <div class="clearfix">

            

            <div class="fr tr w40">
                <a href="javascript:void(0);" data-action="smiley"><i class="fa fa-attach"></i></a>
                <a href="javascript:void(0);" data-action="smiley">☺</a>
                <button class="mbs bt-primary">Publier</button>
            </div>

        </div>

    </section>

</form>