<div>
    <div class="col-sm-8 col-lg-6 col-sm-offset-2 col-lg-offset-3">
        <div class="col-sm-12" id="Fusr_Logo"></div>
    </div>

    <div class="col-sm-8 col-lg-6 col-sm-offset-2 col-lg-offset-3 HomeSearch">
        <div class="row filter2">
            <form id="opnaam" method="get" action="gids.php">
                <div class="col-sm-12">
                    <input class="form-control" type="text" name="q" placeholder="Lunchroom, advocaat, schoenwinkel etc." autofocus size="20" value="<?php echo $trefwoord; ?>" />
                    <input type="hidden" name="branche" value="<?php echo $branche; ?>" />
                    <input type="hidden" name="subbranche" value="<?php echo $subbranche; ?>" />
                </div>

                <div class="col-sm-3 col-sm-offset-9 zoekknop">
                    <button class="btn btn-default col-xs-12" type="submit" value="Zoek">Zoek</button>
                </div>
            </form>
        </div>
    </div>
</div>