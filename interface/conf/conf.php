<?php
//config//
$oldphp = version_compare(PHP_VERSION, '5.0.0','<');

if($oldphp == TRUE){
    echo '
    PHP 5.0 required<br>
    PHP 5.3 recommanded
    ';
    exit();
};

ini_set('display_errors', '0');
ini_set('log_errors', '1');
ini_set('default_charset'   , 'UTF-8');

define('MAX_FILE_SIZE'      , ini_get('upload_max_filesize'));

define('PHP_5_3'            , version_compare(PHP_VERSION, '5.3.0', '>='));

define('WORKING_FOLDER'     , '');

define('HOST'               , 'http://'.$_SERVER['HTTP_HOST'].WORKING_FOLDER);

define('HOST_REDIRECT'      , 'Location: '.HOST);

define('DIR_INTERFACE'      , 'interface');
define('DIR_FILES'          , 'files');

define('PATH_INCLUDE'       , DIR_INTERFACE.'/inc');
define('PATH_INCLUDE_CONF'  , DIR_INTERFACE.'/conf');

define('USER_CONF_FILE'		, DIR_FILES.'/.user.txt');
define('USER_IMG_FILE'		, DIR_FILES.'/.user');

define('DEFAULT_TITLE'		    , 'CosmicBox');
define('DEFAULT_EXPLORER_ITEM'  , 'Explorateur de fichiers');
define('DEFAULT_WELCOME_TITLE'  , '');
define('DEFAULT_WELCOME_TEXT'	, '');

ini_set('error_log'         , DIR_FILES.'/.errors-log.txt');
$log = ini_get('error_log');


if ( (isset($_GET['clearlog']))AND(file_exists($log)) ){
    unlink($log);
}

if(file_exists (USER_CONF_FILE)){
	$userfile = fopen(USER_CONF_FILE, 'r');
    $disable = fgets($userfile);
	fclose ($userfile);
    if($disable == 'disable'){
        if(isset($_GET['enable'])){
            unlink(USER_CONF_FILE);
        }
        else{
            $host_redirect = 'Location: '.HOST.DIR_FILES;
            session_cache_limiter('nocache'); 
            header("Status: 302 Moved Temporarily", false, 302);
            header($host_redirect);
            exit();
        }
    }
}

/////////

?>