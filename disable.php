<?php
//on inclus les constantes de configurations
require ('interface/conf/conf.php');

$userfile = fopen(USER_CONF_FILE, 'x');

if($userfile == FALSE){
	header("Status: 302 Moved Temporarily", false, 302);
	header(HOST_REDIRECT.'?error');
	exit();
}

else{
	fwrite($userfile,'disable');
	fclose($userfile);
    
    $host_redirect = 'Location: '.HOST.DIR_FILES;
    
	header("Status: 302 Moved Temporarily", false, 302);
	header($host_redirect);
	exit();
}
?>