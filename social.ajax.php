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

        

        var_dump($_FILES);
        

        //traitement de la photo de profil
        if(@$_FILES['file']) {

            //controle de la taille
            if($_FILES['size'] > $_POST['MAX_FILE_SIZE'])
                exit('<script>error("'.__("The file exceeds the send size limit of ") . ini_get("upload_max_filesize").'");</script>');

            
            // Récupération de l'extension
            $ext = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
        
            // Hack protection : contre les doubles extensions = Encode le nom de fichier + supprime l'extension qui ne passe pas l'encode et l'ajoute après
            $filename = encode(basename($_FILES['file']['name'], ".".$ext)).".".strtolower($ext);

            $dir = 'avatar/uid_'.$_SESSION['uid'];

            $src_file = 'media/'. ($dir?$dir.'/':'') . $filename;
		    $root_file = $_SERVER['DOCUMENT_ROOT'] . $GLOBALS['path'] . $src_file;

            // Check si le fichier est déjà sur le serveur
            /*if(file_exists($root_file))
                exit('<script>error("'.__("A file with the same name already exists").'");</script>');*/

            // Check le type mime côté serveur
            $finfo = finfo_open(FILEINFO_MIME_TYPE);
            $file_infos['mime'] = finfo_file($finfo, $_FILES['file']['tmp_name']);
            finfo_close($finfo);

            // Vérifie que le type mime est supporté (Hack protection : contre les mauvais mimes types) 
            // + Le fichier tmp ne contient pas de php ou de javascript
            if(file_check('file'))
            {
                @mkdir(dirname($root_file), 0705, true);

                // Upload du fichier
                if(move_uploaded_file($_FILES['file']['tmp_name'], $root_file))
                {
                    // Type mime
                    list($type, $ext) = explode("/", $file_infos['mime']);

                    // Si c'est une image
                    if($type == "image") {
                        img_process($root_file,$dir, 150, 150, true);

                        //$_POST['info'] = array_merge($_POST['info'], array('photo' => img_process($root_file,$dir, 150, 150, true)));	
                    }	
                }			
            }

        }

        // alimentation des champs
        var_dump($_POST);


        // préparation de la requête
        $sql = "UPDATE ".$table_user." SET name = ? , info = ? WHERE id = ". $_SESSION['uid'];
        $stmt = $connect->prepare($sql);
        $stmt->bind_param("ss", $name, $info);

        $name = strip_tags($_POST['info']['name']);
        $info = json_encode($_POST['info'], JSON_UNESCAPED_UNICODE);

        // execution de la requete
        $stmt->execute();

		if($connect->error)// Si il y a une erreur
			echo htmlspecialchars($sql)."\n<script>error(\"".htmlspecialchars($connect->error)."\");</script>";
        else {

            // mise à jour des informations du profil
            $_SESSION['nom'] = $name;
            $_SESSION['info'] = $_POST['info'];

            $stmt->close();

            //echo "<script>reload();</script>";
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