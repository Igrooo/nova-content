<?php
//on inclus les constantes de configurations
require ('interface/conf/conf.php');

$submit_id_code    = trim(@$_POST['id-code']);

$userfile = fopen(USER_CONF_FILE, 'r');

if($userfile == FALSE){
	header("Status: 302 Moved Temporarily", false, 302);
	header(HOST_REDIRECT.'?error');
	exit();
}

else{
	$id_code = trim(fgets($userfile));
	fclose ($userfile);
	
    if ($id_code == $submit_id_code){
        unlink(USER_CONF_FILE);
        header("Status: 302 Moved Temporarily", false, 302);
        header(HOST_REDIRECT);
        exit();
    }
    else{
        header("Status: 302 Moved Temporarily", false, 302);
        header(HOST_REDIRECT.'?reset=error');
        exit();
    }
}
?>