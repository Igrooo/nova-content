<?php  
	global $theme, $title, $explorer_item, $welcome, $welcome_title, $welcome_text;

if(file_exists (USER_CONF_FILE)){
	$userfile = fopen(USER_CONF_FILE, 'r');
    
    fgets($userfile); //on passe une ligne (identifiant);

	$title         = trim(fgets($userfile));
	$explorer_item = trim(fgets($userfile));
	$background    = trim(fgets($userfile));
	$font		   = trim(fgets($userfile));
	$welcome_title = trim(fgets($userfile));
	$welcome_text  = trim(fgets($userfile));
	$userban	   = trim(fgets($userfile));
	$size		   = trim(fgets($userfile));
	$theme		   = trim(fgets($userfile));
    
    if( (empty($welcome_title))AND(empty($welcome_text)) ){
        $welcome = FALSE;
    }
    else{
        $welcome = TRUE;
    }
    
	$userstyle_header = 'header, footer{ background-color: '.$background.'; color:'.$font.'; }';
	if ($userban == 'yes'){
	    $ext = trim(fgets($userfile));
		$userstyle_banner = '#image-header{ height: 200px; background-image: url("'.USER_IMG_FILE.'.'.$ext.'"); background-size: '.$size.'; background-repeat: no-repeat; }';
	}
	fclose ($userfile);
}

else{
    $custom = TRUE;
	$theme = 'light';
    $welcome = TRUE;
}
?>
<head>
	<meta charset="<?php echo ini_get('default_charset'); ?>">
	<title><?php if(!empty($title)){echo $title;}else{echo DEFAULT_TITLE;} if(isset($_GET['dir'])){echo ' - '.$_GET['dir'];}?></title>
	<link rel="icon" href="<?php echo DIR_INTERFACE; ?>/img/favicon.ico">
    <link rel="stylesheet" type="text/css" href="<?php echo DIR_INTERFACE; ?>/css/tinytypo.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo DIR_INTERFACE; ?>/css/style.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo DIR_INTERFACE; ?>/css/themes.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo DIR_INTERFACE; ?>/css/layouts.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style type="text/css">
        <?php
        echo @$userstyle_header;
        echo @$userstyle_banner;
        ?>
    </style>
</head>
