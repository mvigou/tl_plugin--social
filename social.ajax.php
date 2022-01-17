<?php

if(@$_GET['mode'] || @$_POST) {
    include_once("../../config.php");// Variables
    include_once("../../api/function.php");// Fonctions
    include_once("../../api/db.php");// Connexion à la db
}

//------------------------
// MODE APPEL XHR GET
switch(@$_GET['mode'])
{
    default:	
	break;

    // connecter un compte
    case 'connexion':

        unset($_SESSION['nonce']);// Pour éviter les interférences avec un autre nonce de session

        login('medium');

        // Si on doit recharger la page avant de lancer le mode édition
        if(isset($_REQUEST['callback']) and $_REQUEST['callback'] == "reload_edit")
		{
			// Pose un cookie pour demander l'ouverture de l'admin automatiquement au chargement
			setcookie("autoload_edit", "true", time() + 60*60, $GLOBALS['path'], $GLOBALS['domain']);

        }
        else {
            
            $sel_membre = $connect->query("SELECT * FROM ".$table_user." WHERE id=".$_SESSION['uid']);
            $res_membre = $sel_membre->fetch_assoc();

            // initialisation des infos de session
            $_SESSION['nom'] = $res_membre['name'];
            $_SESSION['info'] = json_decode($res_membre['info'],true);

            echo '<script>reload();</script>';
        }

    break; 

    // récupération mot de passe
    case 'oublie':
    break; 

    // publication
    case 'publication':

        //var_dump($_POST);
        $_POST['publication'] = array_merge(
            $_POST['publication'], 
            array(
                'titre' => $_POST['titre'],
                'dans' => $_POST['dans']
            )
        );

        // On creer le contenu dans la BDD
        $sql = "INSERT INTO ".$table_content." 
                (state, title, tpl, url, lang, robots, type, content, user_insert, date_insert)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = $connect->prepare($sql);

        // assignation des valeurs
        $stmt->bind_param(  
            "ssssssssis", 
            $statut,
            $title,
            $tpl,
            $url,
            $post_lang,
            $robots,
            $type,
            $content ,
            $user_insert,
            $date_insert
        );

        $statut = 'active';
        $title = addslashes($_POST['titre']);
        $tpl = addslashes('publication');
        $url = make_url($_SESSION['uid'].time());
        $post_lang = $lang;
        $robots = 'noindex,nofollow';
        $type = $_POST['type'];
        $content = json_encode($_POST['publication'], JSON_UNESCAPED_UNICODE);
        $user_insert = (int)$_SESSION['uid'];
        $date_insert = date("Y-m-d H:i:s");

        // execution de la requete
        $stmt->execute();
		
		if($connect->error)// Si il y a une erreur
			echo htmlspecialchars($sql)."\n<script>error(\"".htmlspecialchars($connect->error)."\");</script>";
        else {
            $lastId = $stmt->insert_id;

                // On creer le tag associé sil s'agit d'une catégorie
            if($_POST['dans'] == 'Actualité' || $_POST['dans'] == 'Annonce' || $_POST['dans'] == 'Petite annonce') {

                $sql = "INSERT INTO ".$table_tag." 
                    (id, zone, encode, name, ordre)
                    VALUES (?, ?, ?, ?, ?)";

                $stmt = $connect->prepare($sql);    

                // assignation des valeurs
                $stmt->bind_param(  
                    "isssi", 
                    $id,
                    $zone,
                    $encode,
                    $name,
                    $ordre
                );

                $id = $lastId;
                $zone = 'categorie';
                $encode = make_url($_POST['dans']);
                $name = $_POST['dans'];
                $ordre = 1;

                // execution de la requete
                $stmt->execute();

                if($connect->error)// Si il y a une erreur
                    echo htmlspecialchars($sql)."\n<script>error(\"".htmlspecialchars($connect->error)."\");</script>";
            }

            $stmt->close();
        }
            
        
    
        echo "<script>reload();</script>";
        
    break;

    // modifier profil
    case 'profil-modifier':

        //@todo: gestion des caractère html!!

        // préparation de la requête
        $sql = "UPDATE ".$table_user." SET name = ? , info = ? WHERE id = ". $_SESSION['uid'];
        $stmt = $connect->prepare($sql);
        $stmt->bind_param("ss", $name, $info);

        // alimentation des champs
        $name = strip_tags($_POST['nom']);
        $info = strip_tags($_POST['info']);

        // execution de la requete
        $stmt->execute();

		if($connect->error)// Si il y a une erreur
			echo htmlspecialchars($sql)."\n<script>error(\"".htmlspecialchars($connect->error)."\");</script>";
        else {

            // mise à jour des informations du profil
            $_SESSION['nom'] = $name;
            $_SESSION['info'] = json_decode($info,true);

            $stmt->close();

            echo "<script>reload();</script>";
        }
    break;

    case 'profil-photo' :

        print_r($_POST);
    break;

    // deconnexion
    case 'deconnexion':

        logout();

        ?>

        <script>reload();</script>

        <?php

    break;

}

?>