<style>
    body {
        display: grid;
        row-gap: 2rem;
        width: 100%;
    }

    h1 {
        margin: 0;
    }
    /* > 420 px : affichage tablette */
    @media (min-width: 420px)  { }

    /* > 768px : affichage pc */
    @media (min-width: 768px)  { 

        html {
            display: flex;
            min-height: 100vh;
            align-items: center;
        }

        body {
            grid-template-columns: repeat(2,1fr);
            grid-template-rows : 2fr auto; 
            column-gap: 4rem;
            padding: 4rem 1rem;

            min-height: auto !important;
        }

            body header {
                align-items: center;
            }
            body header > section > div {
                margin-left: auto;
                max-width: 500px;
                margin-left: auto;
            }
            body main {
                margin-right: auto;
                max-width: 500px !important;
                width: 100% !important;
                display: flex;
                align-items: flex-end;
            }

            body footer {
                border: 0;
            }
    }

    /* > 1366px : full hd */
    @media (min-width: 1366px)  { }

</style>

<form id="connexion" class="mw960p center w100">
    
    <section>

        <div class="mbm">
            <label for="email" class="small bold grey mbt">Adresse courriel</label>
            <input type="email" id="email" name="email" placeholder="Adresse mail de connexion" required>
        </div>

        <div class="mbm">
            <label for="password" class="small bold grey mbt">Mot de passe</label>
            <input type="password" id="password" name="password" placeholder="Mot de passe" required>
        </div>

        <button class="w100 mbs bt-primary">Se connecter</button>

        <input type="hidden" id="mrr" value="">

        <input type="hidden" id="nonce" value="<?=nonce("nonce");?>">

        <hr>

        <aside class="clearfix">

            <div>

                <input type="checkbox" name="rememberme" id="rememberme">

                <label for="rememberme" class="inline" style="text-transform: none;">Se souvenir de moi !</label>

            </div>
        
            <a href="javascript:void(0)" id="oublie" class="">mot de passe oublié</a>

        <aside>

    </section>

    

</form>