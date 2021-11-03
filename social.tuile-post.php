<form id="publication" class="w100 ">

    <section class="tuile ptn clear">

        <label for="texte">
            <?if(@$tag) echo '<h2>Partager une '.$tag.'</h2>'; else h2('titre-post','');?>
        </label>

        <input type="radio" name="type" id="type-publication" value="publication" hidden checked>
        <input type="radio" name="type" id="type-echange" value="echange" hidden>
        <input type="radio" name="type" id="type-evenement" value="evenement" hidden>

        <div id="type" class="mbm clearfix">

            <label for="type-publication" class="fl">Publication</label><!-- @toto restrindre au admin -->
            <label for="type-echange" class="fl">Échange</label>
            <label for="type-evenement" class="fl">Evènement</label>

        </div>

        <div id="contenu" class="mbm">

            <div class="vue-publication mbt">

                <label for="dans">Publier dans : </label>
                <select name="dans" id="dans">

                    <option value="">Selectionner une catégorie</option>
                    <option value="Actualité" <?if(@$tag=='actualite') echo 'selected';?>>Actualité</option>
                    <option value="Annonce" <?if(@$tag=='annonce') echo 'selected';?>>Annonce</option>
                    <option value="Petite annonce" <?if(@$tag=='petite-annonce') echo 'selected'?>>Petite annonce</option>
                    
                </select>

            </div>

            <div class="vue-echange mbt">

                <input type="radio" id="offre" value="offre" name="publication[type-echange]"> <label for="offre" class="mrs">Offre</label>
                <input type="radio" id="demande" value="demande" name="publication[type-echange]"> <label for="demande">Demande</label>

            </div>

            <input type="text" id="titre" name="titre" class="block w100 mtt mbt" placeholder="Titre">

            <div class="vue-evenement mbt">

                <input type="text" id="adresse" name="publication[adresse]" class="w100" placeholder="Indiquer l'emplacement de l'évènement">

                <div class="mtt mbt">
                    <label for="date-debut">du</label>
                    <input type="datetime-local" id="date-debut" name="publication[date-debut]">

                    <label for="date-debut">au</label>
                    <input type="datetime-local" id="date-fin" name="publication[date-fin]">
                </div>

            </div>
            
            <textarea id="texte" name="publication[texte]" class="w100" placeholder="Que souhaitez-vous partager ?" required></textarea>

        </div>

        <div class="clearfix">

            

            <div class="fr tr w40">
                <button class="mbs bt-primary">Publier</button>
            </div>

        </div>

    </section>

</form>