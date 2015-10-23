<div class="box-shadow">
    <div class="zoeken">
        <div class="row">
            <!-- Zoek formulier -->
            <div class="col-sm-12 col-md-12 filter2">
                <form id="opnaam" method="post" action="gids.php">
                    <div class="col-xs-9 col-sm-9 col-md-6">
                        <input class="form-control" type="text" name="trefwoord" placeholder="Trefwoord" autofocus size="20" value="<?php echo $trefwoord; ?>" />
                    </div>

                    <div class="col-xs-6 col-sm-6 col-md-2 xs-pull-right">
                        <button class="btn btn-default col-xs-12" type="submit" name="Zoek" value="Zoek">Zoek</button>
                    </div>
                </form>

                <span class="menu-button glyphicon glyphicon-menu-hamburger" aria-hidden="true"></span>
            </div>
        </div>
    </div>

    <div class="row search-result">
        <!-- Filters -->
        <div class="col-xs-3">
            <?php
            foreach($branches as $branche) {
                $query = "SELECT branches.naam as branche_naam, subbranches.naam as subbranche_naam, subbranches.omschrijving as subbranche_omschrijving FROM branches INNER JOIN subbranches ON subbranches.branche_id = branches.id WHERE branches.naam = '" . $branche . "' GROUP BY subbranches.naam";
                $sth = $pdo->prepare($query);
                $sth->execute();

                echo '<h2>' . $branche . '</h2>';
                while($row = $sth->fetch()) {
                    echo '<a href="?q=' . urlencode(trim($row['branche_naam']) . ' > ' . trim($row['subbranche_naam'])) . '" title="' . $row['subbranche_omschrijving'] . '">' . $row['subbranche_naam'] . '</a><br />';
                }
            }

            if(count($specialiteiten) > 0) {
                echo '<h2>Specialiteiten</h2>';
                foreach($specialiteiten as $specialiteit) {
                    if($_GET['q']) {
                        $url = $_GET['q'] . ' "' . $specialiteit . '"';
                    } else {
                        $url = $trefwoord . ' "' . $specialiteit . '"';
                    }

                    echo '<a href="?q=' . urlencode($url) . '">' . $specialiteit . '</a><br />';
                }
            }
            ?>
        </div>

        <!-- Zoekresultaten -->
        <div class="col-xs-9">
            <?php
            $rows = 0;

            foreach($result as $row) {
                $rows++;

                if($rows > $range) {
                    break;
                }

                if ($row['premium'] == 'gold') {
                    echo '<a class="greylink" href="bedrijven.php?bedrijfs_id=' . $row['id'] . '" />';
                }
                ?>
                <div class="search-container">
                    <div class="search-image">
                        <?php
                        if ($row['premium'] == 'gold' && !empty($row['logo'])) {
                            echo '<img src="images/bedrijf_images/' . $row['id'] . '/' . $row['logo'] . ' />';
                        }
                        ?>
                    </div>
                    <div class="search-naam">
                        <?php
                        if ($row['premium'] == 'gold' || $row['premium'] == 'brons') {
                            echo $row['bedrijfsnaam'] . '<br />' . $row['telefoonnummer'] . '<br />';
                        } else {
                            echo $row['bedrijfsnaam'] . '<br />';
                        }

                        if (isset($row['distance'])) {
                            $round = round($row['distance'], 1);
                            echo number_format($round, 1, ',', '.') . ' km';
                        }
                        ?>
                    </div>
                </div>
                <?php
                if($row['premium'] == 'gold') {
                    echo '</a>';
                }
            }
            ?>
        </div>
        <!-- Pagination -->
        <div class="col-xs-12">
            <?php
            if($number == 0) {
                if($rows > 50) {
                    echo '<a href="gids.php?nr='.($number+1).'" class="btn btn-default gids-btn-nav">Volgende</a>';
                }
            } else {
                if($rows > 50 && $number > 0 || $row['distance'] > $distance) {
                    echo '<a href="gids.php?nr='.($number-1).'" class="btn btn-default gids-btn-nav">Terug</a>';
                    echo '<a href="gids.php?nr='.($number+1).'" class="btn btn-default gids-btn-nav">Volgende</a>';
                } else {
                    echo '<a href="gids.php?nr='.($number-1).'" class="btn btn-default gids-btn-nav">Terug</a>';
                }
            }
            ?>
        </div>
    </div>
</div>