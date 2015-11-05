    <aside id="custom-tools" class="reset-form">
        <h2 class="welcome">Réinitialisation</h2>
        <form action="reset.php" method="post">
            <?php
                if( ($reset == 'error-img') ){
                    echo '<p>Erreur lors de l\'envoi de l\'image <strong>'.@$_GET['name'].'</strong>, vérifiez que son poids n\'éxcède pas <strong>'.MAX_FILE_SIZE.'o</strong> et qu\'elle bien du type <strong>jpeg, png ou gif</strong>.<br>
                    Pour effacer la personnalisation de votre CosmicBox, indiquez le code d\'idenfication :</p>';
                }
                elseif($reset == 'error'){
                    echo'<p class="">Une erreur est survenue, vérifiez le code d\'identification :</p>';
                }
                else{
                    echo'<p>Pour effacer la personnalisation de votre CosmicBox, indiquez le code d\'idenfication :</p>';
                }
            ?>
            <input id="id-code" name="id-code" type="text">
            <input id="reset" class="choice" type="submit" value="&#128570; Effacer la personnalisation">
        </form>
        <hr>
        <p class="mini">En cas de problème, envoyez un mail à <br><a href="mailto:support-cosmicbox@leschatcosmiques.net">support-cosmicbox@leschatcosmiques.net</a></p>
    </aside>