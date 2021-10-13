<form id="publication" class="mw960p center">

    <section >

        <label for="texte"><?h1('titre')?></label>

        <input type="radio" name="type" id="type-publication" value="post" hidden checked>
        <input type="radio" name="type" id="type-evenement" value="event" hidden>

        <div id="type" class="mbt">

            <label for="type-publication">Publication</label>
            <label for="type-evenement">Evènement</label>

        </div>

        <div id="contenu" class="mbm tuile">

            <div class="evenement">
                <label for="titre">Titre de l'évènement</label>
                <input type="text" id="titre" name="titre">
            </div>
            
            <textarea id="texte" name="texte" class="w100" placeholder="lorem ipsum" required></textarea>

        </div>

        <div>
            <details class="pls">
                <summary>Options avancées</summary>
                <ul>
                    <li></li>
                    <li></li>
                    <li></li>
                </ul>
            </details>

            <a href="javascript:void(0);" data-action="smiley"><i class="fa fa-attach"></i></a>
            <a href="javascript:void(0);" data-action="smiley">☺</a>
            <button class="mbs bt-primary">Publier</button>
        </div>

    </section>

</form>