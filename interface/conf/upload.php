<?php
function uploadfile($file, $dir){

    global $extension;
    
    $name 		= $file['name'];
    $type 		= $file['type'];
    $size		= $file['size'];
    $tmp_name	= $file['tmp_name'];
    $error		= $file['error'];
    
    if( ($type == 'image/jpeg')OR($type == 'image/jpg') ){
        $extension = 'jpg';
    }
    elseif( ($type == 'image/png')OR($type == 'image/x-png') ){
        $extension = 'png';
    }
    elseif($type == 'image/gif'){
        $extension = 'gif';
    }
    else{
        $extension = 'jpg';
    }
    $final_name = $dir.'.'.$extension;
	if ( move_uploaded_file($tmp_name, $final_name)AND(($type == 'image/jpeg')OR($type == 'image/jpg')OR($type == 'image/png')OR($type == 'image/x-png')OR($type == 'image/gif')) ) {
    }
	else {
        header("Status: 302 Moved Temporarily", false, 302);
        header(HOST_REDIRECT.'?reset=error-img&name='.$name);
        exit();
	}	
}
?>