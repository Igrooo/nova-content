    <aside id="custom-tools" class="debug-info">
        <h1>Debug Infos</h1>
<?php
        echo '<h2>'.php_uname().'</h2><hr>';

        echo '<h2>PHP Configuration</h2><table>';
        echo '<tr><th>Variable</th><th>Value</th><tr>'   ;
        echo '<tr><td>display_errors</td><td>'.ini_get('display_errors').'</td><tr>'   ;
        echo '<tr><td>log_errors</td><td>'.ini_get('log_errors').'</td><tr>'           ;
        echo '<tr><td>error_log</td><td>'.ini_get('error_log').'</td><tr>'             ;
        echo '<tr><td>default_charset</td><td>'.ini_get('default_charset').'</td><tr>' ;
        echo '<tr><td>upload_max_filesize</td><td>'.ini_get('upload_max_filesize').'</td><tr></table>' ;
        
        echo '<hr><h2>CosmicBox Configuration ('.PATH_INCLUDE_CONF.'/conf.php)</h2><table>';

        echo '<tr><td>PHP_5_3</td><td>'.PHP_5_3.'</td><tr>'                    ;

        echo '<tr><td>WORKING_FOLDER</td><td>'.WORKING_FOLDER.'</td><tr>'      ;

        echo '<tr><td>HOST</td><td>'.HOST.'</td><tr>'                          ;

        echo '<tr><td>HOST_REDIRECT</td><td>'.HOST_REDIRECT.'</td><tr>'        ;

        echo '<tr><td>DIR_INTERFACE</td><td>'.DIR_INTERFACE.'</td><tr>'        ;
        echo '<tr><td>DIR_FILES</td><td>'.DIR_FILES.'</td><tr>'                ;

        echo '<tr><td>PATH_INCLUDE</td><td>'.PATH_INCLUDE.'</td><tr>'          ;
        echo '<tr><td>PATH_INCLUDE_CONF</td><td> '.PATH_INCLUDE_CONF.'</td><tr>';

        echo '<tr><td>USER_CONF_FILE</td><td> '.USER_CONF_FILE.'</td><tr>'      ;
        echo '<tr><td>USER_IMG_FILE</td><td> '.USER_IMG_FILE.'</td><tr>'        ;

        echo '<tr><td>DEFAULT_TITLE</td><td> '.DEFAULT_TITLE.'</td><tr>'                        ;
        echo '<tr><td>DEFAULT_EXPLORER_ITEM</td><td> '.DEFAULT_EXPLORER_ITEM.'</td><tr>'        ;
        echo '<tr><td>DEFAULT_WELCOME_TITLE</td><td> '.DEFAULT_WELCOME_TITLE.'</td><tr>'        ;
        echo '<tr><td>DEFAULT_WELCOME_TEXT</td><td> '.DEFAULT_WELCOME_TEXT.'</td><tr></table>'  ;

        echo '<hr><h2>User Configuration ('.USER_CONF_FILE.')</h2>';
        if(file_exists(USER_CONF_FILE)){
            $userfile = fopen(USER_CONF_FILE, 'r');
            echo '<table><tr><th>Variable</th><th>Value</th><tr>';
            fgets($userfile); //on passe une ligne (identifiant)
            
            echo'<tr><td>title        '.'</td><td>'.trim(fgets($userfile)).'</td></tr>';
            echo'<tr><td>explorer_item'.'</td><td>'.trim(fgets($userfile)).'</td></tr>';
            echo'<tr><td>background   '.'</td><td>'.trim(fgets($userfile)).'</td></tr>';
            echo'<tr><td>font		  '.'</td><td>'.trim(fgets($userfile)).'</td></tr>';
            echo'<tr><td>welcome_title'.'</td><td>'.trim(fgets($userfile)).'</td></tr>';
            echo'<tr><td>welcome_text '.'</td><td>'.trim(fgets($userfile)).'</td></tr>';
            echo'<tr><td>userban	  '.'</td><td>'.trim(fgets($userfile)).'</td></tr>';
            echo'<tr><td>size		  '.'</td><td>'.trim(fgets($userfile)).'</td></tr>';
            echo'<tr><td>theme		  '.'</td><td>'.trim(fgets($userfile)).'</td></tr></table>';
            fclose ($userfile);
        }
        else{
            echo'<h3>[Empty]</h3>';
        }

        echo '<hr><h2>Errors Log ('.$log.')</h2>';
        $log = ini_get('error_log');
        if(file_exists($log)){
            echo '<h3>'.nl2br(htmlentities(file_get_contents($log))).'</h3>';
        }
        else{
            echo'<h3>[Empty]</h3>';
        }
        echo '<hr>';

        ob_start();
        phpinfo(INFO_VARIABLES);
        $pinfo = ob_get_contents();
        ob_end_clean();

        $pinfo = preg_replace( '%^.*<body>(.*)</body>.*$%ms','$1',$pinfo);
        echo $pinfo;

        echo '<hr><h2>PHP Loaded Modules</h2>';
        
        $modules = get_loaded_extensions();
        
        foreach( $modules as $value){
            echo'<h3>'.$value.'</h3>';
        }
        echo '<hr><h2>Apache Loaded Modules</h2>';
        
        $modules = apache_get_modules();
        
        foreach( $modules as $value){
            echo'<h3>'.$value.'</h3>';
        }
?>  
    <hr>
    </aside>