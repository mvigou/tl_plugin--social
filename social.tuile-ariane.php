<aside id="ariane" class="pas plm prm">

    <ol class="unstyled pan">

    <?php
    $ariane = explode('/',$_SERVER['REQUEST_URI']);
    $ariane_url = '..';

    foreach($ariane as $key => $val) {
        if($key==0)

            echo'<li><a href="../" class="icon-accueil" title="retourner à la page d\'accueil">Accueil</a></li>';

        else {

            $ariane_url .= '/'. $val;

            if(@$val) {

                if($key == count($ariane) - 1) 
                    echo '<li>'.ucfirst($val).'</li>';
                else
                    echo '<li><a href="'.$ariane_url.'" title="'.$val.'">'.ucfirst($val).'</a></li>';
                
            }
        } 
    }
    ?>

    </ol>

</aside>