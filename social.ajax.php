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
        else {?>

            <script>reload();</script>
        <?
        }

    break; 

    // récupération mot de passe
    case 'oublie':
    break; 

    // publication
    case 'publication':

        $post = json_decode($_POST['publication'],true);

        if($post['type']=='event') $title = $post['titre']; else $title = time(); 

        // Ajoute d'une publication
		$sql = "INSERT ".$table_content." SET ";
		$sql .= "state = 'active', ";
		$sql .= "title = '".addslashes($title)."', ";
		$sql .= "tpl = '".addslashes('post')."', ";
		$sql .= "url = '".$_SESSION['uid'].$title."', ";
		$sql .= "lang = '".$lang."', ";
		$sql .= "robots = 'noindex, nofollow', ";
		$sql .= "type = '".$post['type']."', ";
        $sql .= "content = '".$_POST['publication']."', ";
		$sql .= "user_insert = '".(int)$_SESSION['uid']."', ";
		$sql .= "date_insert = NOW() ";
		
		$connect->query($sql);
		
		if($connect->error)// Si il y a une erreur
			echo htmlspecialchars($sql)."\n<script>error(\"".htmlspecialchars($connect->error)."\");</script>";
        else
            echo "<script>reload();</script>";

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