<?php
//on inclus les constantes de configurations
require ('interface/conf/conf.php');
include (PATH_INCLUDE_CONF.'/upload.php');

$newline = array("\r\n","\n\r","\n","\r");

$id_code        = $_POST['id-code'];

$title          = trim(htmlentities($_POST['title']));
$explorer_item  = trim(htmlentities($_POST['explorer-item']));
$background     = trim($_POST['background']);
$font		    = trim($_POST['font']);
$welcome_title  = trim(htmlentities($_POST['welcome-title'] ));
$welcome_text   = trim(htmlentities($_POST['welcome-text']));
$welcome_text   = str_replace($newline, '<br>', $welcome_text);

$userban	    = $_POST['userban'];
$size		    = $_POST['size'];
$theme		    = $_POST['explorer-theme'];
$ban            = $_FILES['banner'];
$ban2           = $_FILES['banner2'];
if(empty($title)){
    $title = DEFAULT_TITLE;
}
else{
    $title = substr($title, 0, 30);
}
if(empty($explorer_item)){
    $explorer_item = DEFAULT_EXPLORER_ITEM;
}
else{
    $explorer_item = substr($explorer_item, 0, 30);
}
if(empty($welcome_title)){
    $welcome_title = DEFAULT_WELCOME_TITLE;
}
else{
    $welcome_title = substr($welcome_title, 0, 100);
}
if(empty($welcome_text)){
    $welcome_text = DEFAULT_WELCOME_TEXT;
}
else{
    $welcome_text = substr($welcome_text, 0, 1000);
}


$userfile = fopen(USER_CONF_FILE, 'x');

if($userfile == FALSE){
	header("Status: 302 Moved Temporarily", false, 302);
	header(HOST_REDIRECT.'?error');
	exit();
}

else{
	fwrite($userfile,$id_code ."\r\n");
	fwrite($userfile,$title ."\r\n");
	fwrite($userfile,$explorer_item ."\r\n");
	fwrite($userfile,$background ."\r\n");
	fwrite($userfile,$font."\r\n");
	fwrite($userfile,$welcome_title."\r\n");
	fwrite($userfile,$welcome_text."\r\n");
	fwrite($userfile,$userban."\r\n");
	fwrite($userfile,$size."\r\n");
	fwrite($userfile,$theme."\r\n");
	
	if($userban == 'yes'){
        if ($ban['error'] == 0){
            uploadfile($ban, USER_IMG_FILE);
            fwrite($userfile,$GLOBALS['extension']);
        }
        elseif($ban2['error'] == 0){
            uploadfile($ban2, USER_IMG_FILE);
            fwrite($userfile,$GLOBALS['extension']);
        }
        else{
            header("Status: 302 Moved Temporarily", false, 302);
            header(HOST_REDIRECT.'?reset=error-img');
            exit();
        }
	}
    fclose($userfile);
	
	header("Status: 302 Moved Temporarily", false, 302);
	header(HOST_REDIRECT);
	exit();
}
?>