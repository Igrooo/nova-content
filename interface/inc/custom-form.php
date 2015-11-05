    <aside id="custom-tools" class="custom-form">
        <h2 class="welcome">Bienvenue, <br>vous allez procédez à la personnalisation de votre CosmicBox.</h2>
        <noscript>Vous devez activer javascript pour effectuer les modifications.</noscript>
        <p class="welcome mini">Pour plus de confort, il est conseillé d'utiliser un ordinateur pour réaliser cette configuration.</p>
        <img id="biglogo" src="<?php echo DIR_INTERFACE; ?>/img/logo.png" alt="logo">
        <hr class="welcome">
        <p class="welcome">Pour commencer, choisissez :</p>
        <form id="custom-form" action="custom.php" method="post" enctype="multipart/form-data" autocomplete="on">
            <a id="discover" class="choice button disabled" href="#step1"><span>&#128568; Découverte</span><br>
            Configuration guidée étape par étape<br>
            </a>
            <p class="welcome mini">(prochainement disponible)</p>
            <a id="advance" class="choice button" href="#custom-tools"><span>&#128572; Rapide</span><br>
            Afficher toutes les options maintenant</a>
            <fieldset id="step1">
                <legend>Menu principal</legend>
                <div>
                    <label class="largelabel" for="title-input">Titre</label>
                    <input class="largeinput" id="title-input" name="title" type="text" maxlenght="30" placeholder="30 caractères maximum" value="<?php echo DEFAULT_TITLE;?>" autofocus>
                </div>
                <div>
                    <label class="largelabel" for="explorer-item-input">Nom du bouton pour l'explorateur de fichiers</label>
                    <input class="largeinput" id="explorer-item-input" name="explorer-item" type="text" maxlenght="30" placeholder="30 caractères maximum" value="<?php echo DEFAULT_EXPLORER_ITEM;?>">
                </div>
                <div>
                    <label for="background">Couleur du fond</label><input id="background" name="background" type="color" value="#000000"><input id="hexa-background" type="text" value="#000000">
                </div>
                <div>
                    <label for="font">Couleur du texte</label><input id="font" name="font" type="color" value="#ffffff"><input id="hexa-font" type="text"  value="#ffffff">
                </div>
                <a class="next button" href="#step2">Suivant &#8658;</a>
            </fieldset>
            <fieldset id="step2">
                <legend>Texte en page d'accueil</legend>
                <div>
                    <p>Si vous laissez ces champs vides, l'explorateur de fichier sera la page d'accueil.</p>
                    <label class="largelabel" for="welcome-title-input">Titre pour la page d'accueil</label>
                    <input class="largeinput" id="welcome-title-input" name="welcome-title" type="text" maxlength="100" placeholder="100 caractères maximum" value="<?php echo DEFAULT_WELCOME_TITLE;?>">
                </div>
                <div>
                    <label class="largelabel" for="welcome-text-input">Texte pour la page d'accueil</label>
                    <textarea maxlength="1000" class="largeinput" id="welcome-text-input" name="welcome-text" placeholder="1000 caractères maximum"><?php echo DEFAULT_WELCOME_TEXT;?></textarea>
                    <p id="textinfo"></p>
                </div>
                <a class="next button" href="#step3">Suivant &#8658;</a>
            </fieldset>
            <fieldset id="step3">
                <legend>Bannière</legend>
                <!--<p>Chargez une image ici ou glissez-la dans la zone cadriée.</p>-->
                <div id="inputimg">
                    <label class="largelabel" for="ban">Image</label><input type="hidden" id="userban" name="userban" value="no"><input id="ban" name="banner" type="file" accept="image/jpeg,image/x-png,image/gif">
                    <p id="baninfo">Au format jpg, png ou gif d'une taille maximum de <?php echo MAX_FILE_SIZE; ?>o (dimensions idéales : 1300px x 200px).</p>
                    <p id="banok">L'image <span id="banname"></span> est chargée.
                    <input id="banreset" type="button" value="Annuler">
                    </p>
                </div>
                <div><label for="size">Disposition</label><input type="text" id="size" name="size" value="cover"><input type="button" id="cover" class="select" value="Rognée" disabled><input type="button" id="contain" value="Cadrée" disabled></div>
                <a class="next button" href="#step4">Suivant &#8658;</a>
            </fieldset>
            <fieldset id="step4">
                <legend>Explorateur de fichiers</legend>
                <div>
                <label for="explorer-theme">Thème</label><input type="text" id="explorer-theme" name="explorer-theme" value="light" ><input type="button" id="dark" value="Sombre"><input type="button" id="light" class="select" value="Clair">                    
                </div>
                <a id="finish" class="next button" href="#submit">Suivant &#8658;</a>
            </fieldset>
            <div id="submit">
                <p id="valid-info" class=" mini">
                    Pour annuler les modifications après validation,<br>
                    supprimez le fichier <i>.user.txt<?php /*echo USER_CONF_FILE;*/ ?></i> se trouvant dans la clé USB<br>
                    OU<br>
                    Rendez-vous à la page <a href="?reset"><?php echo HOST ; ?>?reset</a> <br>
                    et indiquez l'identifiant ci-dessous :
                    <?php
                    // On génère l'identifiant unique
                    $string1 = substr(str_shuffle('abcefghijklmnopqrstuvwxyz'), 0, 3);
                    $string2 = rand(111,999);
                    $id_code = $string1.$string2;
                    $id_code = str_shuffle($id_code);
                    ?>
                    <input id="id-code" class="readonly" name="id-code" type="text" readonly value="<?php echo $id_code; ?>">
                </p>
                <input id="valid" type="submit" value="&#128570; Valider la personnalisation">
            </div>
        </form>
        <hr class="welcome">
        <form id="disable-form" action="disable.php" method="post" enctype="text/plain" class="welcome">
            <input type="hidden" name="disable" value="disable">
            <input id="disable" class="choice" type="submit" value="&#128570; Désactiver l'interface graphique">
            <p class="mini">
            Pour restaurer l'interface graphique,<br>
            supprimez le fichier <i>.user.txt<?php /*echo USER_CONF_FILE;*/ ?></i> se trouvant dans la clé USB<br>
            OU<br>
            Rendez-vous à la page <a href="?enable"><?php echo HOST ; ?>?enable</a> <br>
            </p>
        </form>
        <hr>
        <p class="mini">En cas de problème, envoyez un mail à <br><a href="mailto:support-cosmicbox@leschatcosmiques.net">support-cosmicbox@leschatcosmiques.net</a></p>
    </aside>