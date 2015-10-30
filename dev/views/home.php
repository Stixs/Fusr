<div id="Fusr_Logo"></div>

<div class="HomeSearch">
    <div class="filter2">
        <form id="opnaam" method="get" action="gids.php">
            <div class="col-sm-6 col-sm-offset-2 col-md-5 col-md-offset-3 col-lg-4 col-lg-offset-4">
                <input class="form-control" type="text" name="q" placeholder="Lunchroom, advocaat, schoenwinkel etc." autofocus size="20" value="<?php echo $trefwoord; ?>" />
                <input type="hidden" name="branche" value="<?php echo $branche; ?>" />
                <input type="hidden" name="subbranche" value="<?php echo $subbranche; ?>" />
            </div>

            <div class="col-sm-3 col-md-2 zoekknop">
                <button class="btn btn-default col-xs-12" type="submit" value="Zoek">Zoek</button>
            </div>
        </form>
    </div>
</div>