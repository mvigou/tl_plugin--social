// cf. social.ajax.php

// case : 'connexion'
const connexion = document.querySelector("#connexion");

if(connexion) {

    connexion.addEventListener('submit', function(event){

        event.preventDefault();
    
        // configuration de la requête
        const xhr = new XMLHttpRequest();
        xhr.open('POST', path+'theme/'+theme+'/social.ajax.php?mode=connexion',true);
    
        // préparation des données
        let data = new FormData(connexion);
        let values = Object.fromEntries(data.entries());
    
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
    
        // envoi de la requête
        xhr.send("email="+values.email+"&password="+values.password);
    
        // gestion retour
        xhr.onload = function() {
    
            const response = document.createRange().createContextualFragment(this.response);
            document.body.append(response);
    
        }
    }); 
}   
//----

// case : 'publication
var publication = document.querySelector("#publication");

if(publication) {

    publication.addEventListener('submit', function(event){

        event.preventDefault();

        // configuration de la requête
        const xhr = new XMLHttpRequest();
        xhr.open('POST', path+'theme/'+theme+'/social.ajax.php?mode=publication',true);

        // préparation des données
        let data = new FormData(publication);
        let values = Object.fromEntries(data.entries());

        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');

        // envoi de la requête
        console.log();
        xhr.send("publication="+JSON.stringify(values));

        // gestion retour
        xhr.onload = function() {

            const response = document.createRange().createContextualFragment(this.response);
            document.body.append(response);

        }
        
    });

}
//----
    
// case : 'modification du profil'
const profil = document.querySelector("#profil-modifier");

if(profil) {

    profil.addEventListener('submit', function(event){

        event.preventDefault();
    
        // configuration de la requête
        const xhr = new XMLHttpRequest();
        xhr.open('POST', path+'theme/'+theme+'/social.ajax.php?mode=profil-modifier',true);
    
        // préparation des données
        let data = new FormData(profil);
        let values = Object.fromEntries(data.entries());
    
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
    
        // envoi de la requête
        xhr.send("nom="+values.name+"&info="+JSON.stringify(values));
    
        // gestion retour
        xhr.onload = function() {
    
            const response = document.createRange().createContextualFragment(this.response);
            document.body.append(response);
    
        }
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






