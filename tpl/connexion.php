<style>
    body {
        display: grid;
        row-gap: 2rem;
    }
    /* > 420 px : affichage tablette */
    @media (min-width: 420px)  { }

    /* > 768px : affichage pc */
    @media (min-width: 768px)  { 

        body {
            grid-template-columns: repeat(2,1fr);
            column-gap: 4rem;
            padding: 4rem 1rem;
        }

            body header {margin-left: auto;}
            body main {margin-right: auto}
    }

    /* > 1366px : full hd */
    @media (min-width: 1366px)  { }

</style>

<form id="connexion" class="mw960p center">
    
    <section class="center">

        <div class="mbm">
            <label for="email" class="small up">Identifiant</label>
            <input type="email" id="email" name="email" placeholder="votre adresse mail de connexion" required>
        </div>

        <div class="mbm">
            <label for="password" class="small up">Mot de passe</label>
            <input type="password" id="password" name="password" placeholder="Votre mot de passe" required>
        </div>

        <button class="w100 mbs bt-primary">Se connecter</button>

        <input type="hidden" id="mrr" value="">

        <input type="hidden" id="nonce" value="<?=nonce("nonce");?>">

    </section>

    <aside class="center">

        <input type="checkbox" name="rememberme" id="rememberme">
        <label for="rememberme" class="inline" style="text-transform: none;">Se souvenir de moi !</label>

        <a href="javascript:void(0)" id="oublie" class="">mot de passe oublié</a>

    <aside>

</form>