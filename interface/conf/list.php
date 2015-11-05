<?php
////////masque les répertoires cachés
function hide_dir($dir){
    $dirstate = substr($dir, 0, 1);
    if ( ($dirstate == FALSE ) OR ($dirstate == '.') ){return FALSE;}
    else{ return TRUE;}
}


///////scan des répertoires
function scan($path_dir){
    global $list, $id;
    //on scan les repertoires et les fichiers - retourne un tableau une colonne (liste)
    $list = scandir(DIR_FILES.'/'.$path_dir);
    //on elimine les "." ".." et les repertoires cachés    
    if ($list != FALSE) {
        $list = array_filter($list, 'hide_dir');
        //On re-index
        $list = array_values($list);
    }
}


////////liste les fichiers et dossiers d'un répertoire
function listdirs($id,$path_dir,$open_dir,$disp){
    
    scan($path_dir);
    $list   = $GLOBALS['list'];
    $max    = count($list)-1;         //  nombre de ligne du tableau des repertoires et fichiers +0
    $i      = 0;                   
    
    if ($max==-1){
    echo'<h3 id="alert">&#x1F63E; Ce dossier est vide.</h3>';
    }
    
    elseif ($list == FALSE){
    echo'<h3 id="alert">&#128576; Ce dossier n\'existe pas.</h3>';
    }

    else{
        echo '<ol id="dir'.$id.'">';
        while ( $i <= $max){
            
           $dir = $list[$i];
            if ( is_null($path_dir) ){
                $url = urlencode($dir);
            }
            else{
                $url = urlencode($path_dir.'/'.$dir);
            }
            if($path_dir != NULL){// Si on est PAS à la Racine
                $complete_path_dir = DIR_FILES.'/'.$path_dir.'/'.$dir;
            }
            else{// Si on est à la Racine
                $complete_path_dir = DIR_FILES.'/'.$dir;
            }
            
            if ( (is_dir($complete_path_dir)) == TRUE ) { //Si un dossier
                
                echo '                      <li class="folder';if ($dir == @$open_dir){echo' open';} echo'"><a href="?disp='.$disp.'&dir='.$url.'">'.$dir.'</a></li>';
            }

            else { //Sinon un fichier
                $file = $dir;
                if($path_dir != NULL){// Si on est PAS à la Racine
                    $path_file = DIR_FILES.'/'.$path_dir.'/'.$file;
                }
                else{// Si on est à la Racine
                    $path_file = DIR_FILES.'/'.$file;
                }
                
                if(PHP_5_3 == TRUE){
                    $finfo = finfo_open(FILEINFO_MIME_TYPE); // Retourne le type mime du fichier (5.3+)
                    $mimetype = finfo_file($finfo, $path_file) ;
                    finfo_close($finfo);
                }
                else{
                    $mimetype = mime_content_type($path_file);
                }
                
                if($mimetype == FALSE){
                    $mimetype = 'inode/x-empty';
                }
                
                $type = strstr($mimetype, '/', $before_needle = TRUE);

                if ( strstr($mimetype, 'application/vnd') != FALSE ){
                    $type = 'doc';
                }
                if ( $mimetype == 'application/pdf'){
				    $type = 'pdf';
				}
				if ( $mimetype == 'application/octet-stream'){
				    $type = 'audio';
				}
                if ( $mimetype == 'application/ogg'){
				    $type = 'video';
				}
                if ( ($type == FALSE)OR( ($type != 'doc')AND($type != 'pdf')AND($type != 'image')AND($type != 'audio')AND($type != 'video')AND($type != 'text') ) ){
					$type = 'file';
				}
				
                $file = htmlentities($file);
				$file_extension = strrchr($file, '.');
                if($file_extension == FALSE){//Fichier sans extension
                    $file_extension = '';
                    $file_name = $file;
                }
                else{
                    $file_name = strstr($file, $file_extension, $before_needle = TRUE);
                }
                
                if (($type == 'image')AND($disp == 'grid')){
				    echo '                     <li class="'.$type.'"><a href="'.$path_file.'" class="download" type="'.$mimetype.'" title="Cliquez pour télécharger l\'image '.$file.' ou l\'ouvrir dans le navigateur."><figure><img src="'.$path_file.'" alt="'.$file.'"><figcaption>'.$file_name.'<span class="extension">'.$file_extension.'</span></figcaption></figure></a></li>';
				}

				else{
					echo '                     <li class="'.$type.'"><a href="'.$path_file.'" class="download" type="'.$mimetype.'" title="Cliquez pour télécharger le fichier '.$file.' ou l\'ouvrir dans le navigateur.">'.$file_name.'<span class="extension">'.$file_extension.'</span></a></li>';
				}

            }
            $i++;
        }
        echo '</ol>
        ';
    }
    
}


////////analyse le chemin du répertoire courent
function pathdir($path_dir, $disp){
    
    global $list_path_dir;
    global $nbr;
    global $currentdir;
    global $url_parent;
    global $nav_path_dir;
    
    if ($path_dir != NULL){
        
        $list_path_dir  = explode('/', $path_dir);                              //arborescence ouverte en tableau
        $nbr            = count($list_path_dir)-1;                              //profondeur de l'arborescence ouverte (le zero est compté puisque le tableau commence par zero)
        $currentdir     = $list_path_dir[$nbr];                                 //répertoire courent (dernier dans le tableau)    
        
        if ($nbr != 0){
            $i = 0;                                                             //construction du fil d'arianne
            while ($i <= $nbr){
                $slice_nav_path_dir = array_slice($list_path_dir, 0, $i+1);
                $url_path_dir       = implode('/',$slice_nav_path_dir);
                $url_path_dir       = urlencode($url_path_dir);  
                $dir                = $list_path_dir[$i];                                                                
                $sub_nav_path_dir   = '<a href="?disp='.$disp.'&dir='.$url_path_dir.'">'.$dir.'</a>';
                
                if($nav_path_dir != NULL){
                    $nav_path_dir   = $nav_path_dir.' / '.$sub_nav_path_dir;
                }
                else{
                    $nav_path_dir   = $sub_nav_path_dir;
                }
                
                $i++;
            }            
            
            $slice_url_parent   = array_slice($list_path_dir, 0, $nbr);         //répertoire parent (avant dernier dans le tableau)
            $url_parent         = implode('/',$slice_url_parent);               //arborescence en chaine de caractères
            $url_parent         = urlencode($url_parent);                       //url répertoire parent
        }
        
        else{
            $url_path_dir = urlencode($path_dir);                               //construction du fil d'arianne                                          
            $nav_path_dir = '<a href="disp='.$disp.'&dir='.$url_path_dir.'">'.$path_dir.'</a>';                                           
            $url_parent   = NULL;                                               //répertoire parent
        }
    }

}

// affiche les enfants du répertoire courent
function showdirs($path_dir, $disp){
    
    pathdir($path_dir, $disp);

    if ($path_dir != NULL){
        
        $list_path_dir  = $GLOBALS['list_path_dir'];
        $nbr            = $GLOBALS['nbr'];
        $open_dir       = $list_path_dir[0];                                    //on retient le répertoire ouvert dans l'arborescence pour l'aficher différent dans la liste
        
        listdirs(0, NULL, $open_dir, $disp);                                              //racine

        if ($nbr != 0){
            $i = 1;
            while ($i <= $nbr){

                $open_dir               = $list_path_dir[$i] ;                  //on retient le répertoire ouvert dans l'arborescence pour l'aficher différent dans la liste
                $slice_list_path_dir    = array_slice($list_path_dir, 0, $i);
                $slice_path_dir         = implode('/',$slice_list_path_dir);    //arborescence ouverte en chaine de caractères

                listdirs($i, $slice_path_dir, $open_dir, $disp);                           //répertoires intermédiaires
                $i++;
            }
            
            listdirs($i, $path_dir, NULL, $disp);                                          //répertoire courent
        }

        else{
            listdirs(1, $path_dir, $open_dir, $disp);                                     //si un seul répertoire ouvert
        }

    }

    else{                                                                                  //si aucun répertoire ouvert
        listdirs(0, NULL,NULL, $disp);                                                    // racine
    }

}

?>



