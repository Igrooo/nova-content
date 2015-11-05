<?php
$path_dir = urldecode(@$_GET['dir']);

include (PATH_INCLUDE_CONF.'/list.php');

pathdir($path_dir, $disp);

$url_parent = $GLOBALS['url_parent'];
$nav_path_dir = $GLOBALS['nav_path_dir'];
$theme = $GLOBALS['theme'];
?>

<div id="explorer-header" class="<?php echo $theme; ?>-theme">
<noscript>Vous devez activer javascript pour utiliser toutes les fonctionnalités de l'explorateur de fichiers.</noscript>
    <nav>
    
    <ul>

        <li id="button-home" class="button-navigation"><a id="home" href="?disp=<?php echo $disp; ?>&dir" class="button-nav" title="Retour à la racine"></a></li>
        <li id="button-back" class="button-navigation"><a id="back" href="?disp=<?php echo $disp; ?>&dir=<?php echo $url_parent; ?>" class="button-nav" title="Retour au dossier parent"></a></li>
        
        <li class="path"><div id="path"><?php echo @$nav_path_dir; ?></div></li>
        
        <li id="button-list" class="button-display"><a id="list" href="?disp=list&dir=<?php echo @$_GET['dir']?>" title="Vue en liste"   class="button-nav disp <?php if ($disp =='list'){echo 'active';}?>"></a></li>
        <li id="button-grid" class="button-display"><a id="grid" href="?disp=grid&dir=<?php echo @$_GET['dir']?>" title="Vue en tuiles"  class="button-nav disp <?php if ($disp =='grid'){echo 'active';}?>"></a></li>
        <li id="button-col" class="button-display"><a id="col"   href="?disp=col&dir=<?php echo @$_GET['dir']?>" title="Vue en colonnes" class="button-nav disp <?php if ($disp =='col') {echo 'active';}?>"></a></li>
    </ul>

    </nav>
</div>

<div id="explorer-body" class="<?php echo $disp.' '.$theme;?>-theme">

<?php
showdirs($path_dir, $disp); 
?>
    
</div>