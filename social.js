// cf. social.ajax.php
// @todo: GESTION DES BALISES HTML ET CARACTERE SPECIAUX

// case : 'connexion'
const connexion = document.querySelector("#connexion");

if(connexion) {

    connexion.addEventListener('submit', function(event){

        event.preventDefault();
        
        const formData = new FormData(connexion);

        // configuration de la requête
        const xhr = new XMLHttpRequest();
        xhr.open('POST', path+'theme/'+theme+'/social.ajax.php?mode=connexion');
    
        // gestion retour
        xhr.onload = function() {
            const response = document.createRange().createContextualFragment(this.response);
            document.body.append(response);
        }

        xhr.send(formData);

    }); 
}   
//----

// case : 'publication
var publication = document.querySelector("#publication");

if(publication) {

    publication.addEventListener('submit', function(event){

        event.preventDefault();

        const formData = new FormData(publication);

        // configuration de la requête
        const xhr = new XMLHttpRequest();
        xhr.open('POST', path+'theme/'+theme+'/social.ajax.php?mode=publication');
        
        // gestion retour
        xhr.onload = function() {
            const response = document.createRange().createContextualFragment(this.response);
            document.body.append(response);
        }

        // envoi de la requête
        xhr.send(formData);
        
    });

}
//----
    
// case : 'modification du profil'
const profil = document.querySelector("#profil-modifier");

if(profil) {

    profil.addEventListener('submit', function(event){

        event.preventDefault();
    
        const formData = new FormData(profil);

        const files = document.querySelector("#file").files;
        formData.append('file', files[0]);

        const xhr = new XMLHttpRequest();
        xhr.open('POST', path+'theme/'+theme+'/social.ajax.php?mode=profil-modifier');
        xhr.onload = function() {
            const response = document.createRange().createContextualFragment(this.response);
            document.body.append(response);
        }
        xhr.send(formData);

    }); 
}   
//----

// case : 'deconnexion'
var deconnexion = document.querySelector("[data-action='deconnexion']");

if(deconnexion) {

    deconnexion.addEventListener('click', function(event){
        
        event.preventDefault();
    
        // configuration de la requête
        const xhr = new XMLHttpRequest();
        xhr.open('GET', path+'theme/'+theme+'/social.ajax.php?mode=deconnexion',true);
    
        // envoi de la requête
        xhr.send();
    
        // gestion retour
        xhr.onload = function() {
    
            const response = document.createRange().createContextualFragment(this.response);
            document.body.append(response); 
    
        }
    });
}
//----


//---------------
function formatXHRPost(dataEntries) {

}






