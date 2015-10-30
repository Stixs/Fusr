<div id="header">
    <a href="./" title="Terug naar homepage">
        <div id="Fusr_Logo-small"></div>
    </a>

    <div class="Menubtn">
        <img src="assets/images/menu-btn.gif" alt="Open menu" class="menu-button" />
    </div>

    <div class="HeaderSearch">
        <div class="filter2">
            <form id="opnaam" method="get" action="gids.php">
                <div class="col-sm-5 col-sm-offset-3">
                    <input class="form-control" type="text" name="q" placeholder="Lunchroom, advocaat, schoenwinkel etc." autofocus size="20" value="<?php echo html_entity_decode($trefwoord); ?>" />
                    <input type="hidden" name="branche" value="<?php echo $branche; ?>" />
                    <input type="hidden" name="subbranche" value="<?php echo $subbranche; ?>" />
                </div>

                <div class="col-sm-2 Searchbtn">
                    <button class="btn btn-default col-xs-12" type="submit" name="Zoek" value="Zoek">Zoek</button>
                </div>
            </form>
        </div>
        <!-- Mobile only -->
        <div class="MobileLocatie">
            <?php
            if(isset($_SESSION['plaats'])) {
                $plaats = trim($_SESSION['plaats']);
            } else {
                $plaats = 'geen plaats opgegeven';
            }
            ?>
            Er wordt gezocht in: <form id="zoeken" action="location.php<?php echo $url; ?>" method="post"><input type="hidden" name="plaats" class="right plaatszoeken" value="<?php echo $plaats; ?>" /></form> <a href="#" class="zoekPlaats"><?php echo $plaats; ?></a>

        </div>

    </div>

    <!-- Mobile only -->
    <div class="MobileFilter"></div>
    <?php require('views/menu.php'); ?>

</div>