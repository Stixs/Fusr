<div class="search-result">
    <!-- Filters -->
    <div class="col-sm-3 col-lg-2 filters">
        <h1>Filter je zoekresultaat</h1>
        <div class="filtersbg">
        <?php
        foreach($branches as $branche) {
            $query = "SELECT branches.naam as branche_naam, subbranches.naam as subbranche_naam, subbranches.omschrijving as subbranche_omschrijving FROM branches INNER JOIN subbranches ON subbranches.branche_id = branches.id WHERE branches.naam = '" . $branche . "' GROUP BY subbranches.naam";
            $sth = $pdo->prepare($query);
            $sth->execute();

            echo '<h2>' . $branche . '</h2>';
            while($row = $sth->fetch()) {
                if(isset($_GET['subbranche']) && $_GET['subbranche'] == $row['subbranche_naam'] && isset($_GET['branche']) && $_GET['branche'] = $branche) {
                    echo '<a class="active" href="?q=' . urlencode(trim($row['branche_naam']) . ' > ' . trim($row['subbranche_naam'])) . '&branche=' . urlencode(trim($row['branche_naam'])) . '&subbranche=' . urlencode(trim($row['subbranche_naam'])) . '" title="' . $row['subbranche_omschrijving'] . '">' . $row['subbranche_naam'] . '</a>';
                } else {
                    echo '<a href="?q=' . urlencode(trim($row['branche_naam']) . ' > ' . trim($row['subbranche_naam'])) . '&branche=' . urlencode(trim($row['branche_naam'])) . '&subbranche=' . urlencode(trim($row['subbranche_naam'])) . '" title="' . $row['subbranche_omschrijving'] . '">' . $row['subbranche_naam'] . '</a>';
                }
            }
        }

        if(count($specialiteiten) > 0) {
            echo '<h2>Specialiteiten</h2>';
            foreach($specialiteiten as $specialiteit) {
                $name = '';
                $speciurl = '?q=' . $_GET['q'];
                if(isset($_GET['branche']) && isset($_GET['subbranche'])) {
                    $speciurl .= '&branche=' . $_GET['branche'] . '&subbranche=' . $_GET['subbranche'];
                }

                if(isset($_GET['specialiteit'])) {
                    $name = $_GET['specialiteit'];
                    $speciurl .= '&specialiteit[]=' . $_GET['specialiteit'][0];
                }

                $speciurl .= '&specialiteit[]=' . $specialiteit;

                if(isset($_GET['specialiteit']) && in_array($specialiteit, $_GET['specialiteit'])) {
                    echo '<a class="active" href="' . $url . '">' . $specialiteit . '</a>';
                } else {
                    echo '<a href="' . $speciurl . '">' . $specialiteit . '</a>';
                }
            }
        }
        ?>
        </div>
    </div>

    <!-- Zoekresultaten -->
    <div class="col-sm-9 col-md-7 col-md-offset-1 col-lg-8 resultspage">
        <div class="resultsbg">
            <?php
            $rows = 0;

            foreach($result as $row) {
                $rows++;

                if($rows > $range) {
                    break;
                }
                ?>
                <div class="row search-container">
                    <div class="search-image">
                        <?php
                        if ($row['premium'] == 'gold' && !empty($row['logo'])) {
                            echo '<img class="col-md-4 col-lg-3" src="./assets/images/bedrijf_' . $row['id'] . '/' . $row['logo'] . '" />';
                        }
                        ?>
                    </div>
                    <div class="col-sm-7 col-md-8 col-lg-6 search-naam">
                        <?php
                        echo '<div class="bedrijfsnaam">' . $row['bedrijfsnaam'] . '</div>
                                  <div class="specialiteit"><em><a href="' . $url . '&specialiteit[]=' . $row['specialiteit'] .'">' . $row['specialiteit'] . '</a></em></div>
                                  <div class="bezoekadres">' . $row['bezoekadres'] . ', ' . ucfirst(strtolower($row['plaatsnaam'])) . '</div>
                                  <div class="telefoonnummer">' . $row['telefoonnummer'] . '</div>';
                        ?>
                    </div>

                    <div class="col-sm-5 col-md-12 col-lg-3 search-afstand">
                        <?php
                        if (isset($row['distance'])) {
                            $round = round($row['distance'], 1);
                            echo '<div class="afstand">' . number_format($round, 1, ',', '.') . ' km </div>';
                        }

                        if($row['premium'] == 'gold') {
                            echo '<a class="link" href="bedrijven.php?bedrijf=' . $row['id'] . '">Bekijk de pagina</a>';
                        }
                        ?>
                    </div>
                </div>
                <?php
            }

            if(count($result) == 0) {
                echo 'Er zijn geen resultaten gevonden voor deze zoekopdracht.';
            }
            ?>
        </div>
        <!-- Pagination -->
        <div class="col-xs-12">
            <?php
            if($number == 0) {
                if($rows > $range) {
                    echo '<a href="gids.php?q=' . $trefwoord . '&nr='.($number+1).'" class="btn btn-default gids-btn-nav">Volgende</a>';
                }
            } else {
                if($rows > $range && $number > 0 || $row['distance'] > $distance) {
                    echo '<a href="gids.php?q=' . $trefwoord . '&nr='.($number-1).'" class="btn btn-default gids-btn-nav">Terug</a>';
                    echo '<a href="gids.php?q=' . $trefwoord . '&nr='.($number+1).'" class="btn btn-default gids-btn-nav">Volgende</a>';
                } else {
                    echo '<a href="gids.php?q=' . $trefwoord . '&nr='.($number-1).'" class="btn btn-default gids-btn-nav">Terug</a>';
                }
            }
            ?>
        </div>
    </div>
</div>