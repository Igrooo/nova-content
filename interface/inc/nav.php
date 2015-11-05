    <nav>
        <ul>
            <li><a id="explorer-item" class="item nav-item <?php if( (isset($_GET['dir']))OR($welcome == FALSE) ){echo 'active';} ?>" href="?disp=<?php echo $disp; ?>&dir"><?php if(!empty($explorer_item)){echo $explorer_item;}else{echo DEFAULT_EXPLORER_ITEM;} ?></a></li>

            <?php
            /*Servira à construire le menu à partir des pages supplémentaires
                                <li><a href="?page=" class="item nav-item">item</a></li>
                                <li><a href="?page=" class="item nav-item">item</a></li>
                                <li><a href="?page=" class="item nav-item">item</a></li>
                                <li><a href="?page=" class="item nav-item">item</a></li>
            */
            ?>
        </ul>
    </nav>