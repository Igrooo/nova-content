<?php

/*
WARNING !
This web interface for the CosmicBox is a work in progress.
It's programmed by a PHP noobie in procedural style.

ATTENTION
Cet interface web pour la CosmicBox est un travail en cours.
Il est codé par un noobie du PHP en style procédural.

Require PHP 5.0+
PHP 5.

*/

//on inclus les constantes de configurations
require ('interface/conf/conf.php');
?>
<!DOCTYPE html>
<html>
    
<?php
include (PATH_INCLUDE.'/head.php');
?>

<body>
    
<?php

if ( (isset($_GET['debug']))OR(isset($_GET['clearlog'])) ){
    include(PATH_INCLUDE.'/debug-info.php');
}

elseif (isset($custom)){
    include(PATH_INCLUDE.'/custom-form.php');
}

elseif (isset($_GET['reset'])){
    $custom = TRUE;
    $reset = $_GET['reset'];
    include(PATH_INCLUDE.'/reset-form.php');
}

include (PATH_INCLUDE.'/header.php');
if (isset($_GET['error'])){
    echo '<h2>Une erreur est survenue.</h2>';
}
    include (PATH_INCLUDE.'/content.php');
    include (PATH_INCLUDE.'/footer.php');

?>


    <script type="application/javascript" src="<?php echo DIR_INTERFACE; ?>/js/jquery.min.js"></script>
<?php
if ((isset($custom))OR(isset($reset))){
    echo'
    <!--<script type="application/javascript" src="'.DIR_INTERFACE.'/js/jquery-ui.min.js"></script>-->
    <script type="application/javascript" src="'.DIR_INTERFACE.'/js/custom-form.min.js"></script>
    ';
}
if ( (isset($_GET['dir']))OR($welcome == FALSE) ){
    echo'
    <script type="application/javascript" src="'.DIR_INTERFACE.'/js/onscroll.min.js"></script>
	<script type="application/javascript" src="'.DIR_INTERFACE.'/js/explorer.min.js"></script>
    ';
}
?>

</body>
    
</html>