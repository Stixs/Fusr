<div id="header">
    <div class="col-xs-12">
        <span class="menu-button glyphicon glyphicon-menu-hamburger" aria-hidden="true"></span>
    </div>
</div>

<div class="zoeken">
    <div class="row">
        <div class="col-sm-12 col-md-12 filter2">
            <form id="opnaam" method="post" action="gids.php">
                <div class="col-xs-9 col-sm-9 col-md-6">
                    <input class="form-control" type="text" name="trefwoord" placeholder="Trefwoord" autofocus size="20" value="<?php echo $trefwoord; ?>" />
                </div>

                <div class="col-xs-6 col-sm-6 col-md-2 xs-pull-right">
                    <button class="btn btn-default col-xs-12" type="submit" name="Zoek" value="Zoek">Zoek</button>
                </div>
            </form>
        </div>
    </div>
</div>
