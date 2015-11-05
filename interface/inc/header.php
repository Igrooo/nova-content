<?php

if (isset($_GET['disp'])){
	$disp = $_GET['disp'];
}
else{
    $disp = 'list';
}

if (isset($custom)){
    echo'
    <header class="custom">
    ';
}
else{
    echo'
    <header>
    ';
}
?>
        <div id="nav-header">
            <a href="<?php echo HOST ?>" class="logo item">
                <img src="<?php echo DIR_INTERFACE; ?>/img/lbx-logo-small.png" width="36" alt="lbx-logo-small">
                <h1 id="title"><?php if(!empty($title)){echo $title;}else{echo DEFAULT_TITLE;}?></h1>
            </a>
            <?php include(PATH_INCLUDE.'/nav.php');?>
        </div>

    </header>
<?php
if (isset($custom)){
    echo'
        <div id="image-header" class="custom">
            <div id="dropzone" class="empty">
                <label for="dropzone-input" id="dropzoneinfo"><span id="loader"></span><span>Faites glisser une image ou cliquez ici.</span></label>
                <input form="custom-form" id="dropzone-input" name="banner2" type="file" accept="image/jpeg,image/x-png,image/gif">
            </div>
        </div>
    ';
}
else{
    echo'
        <div id="image-header">
        </div>
    ';
}
