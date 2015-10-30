<a class="noline" href="javascript:javascript:history.go(-1)">
    <div class="teruglink">
        <div>Dit is een profiel pagina, <u>terug naar zoeken</u></div>
    </div>
</a>
<div class="col-xs-10 col-md-8 col-xs-offset-1 col-md-offset-2 profilepage">
    <div class="row">
        <?php if(!empty($row['logo'])) { ?>
        <div class="company-logo">
            <img src="./assets/images/bedrijf_<?php echo $row['id'] .'/'.$row['logo']; ?>" />
        </div>
        <?php } ?>

        <?php if(!empty($row['profiel_afbeelding'])) { ?>
        <div class="company-image" style="background: url('./assets/images/bedrijf_<?php echo $row['id'] .'/'.$row['profiel_afbeelding']; ?>') center center no-repeat transparent;"></div>
        <?php } ?>

        <h1><?php echo $row['bedrijfsnaam']; ?></h1>
    </div>

    <div class="row profilebg">
        <div class="col-sm-8 col-lg-7 beschrijving">
            <?php echo $row['beschrijving']; ?>
        </div>

        <div class="col-sm-4 col-lg-offset-1 adres">
            <h2>Adres gegevens</h2>
            <?php echo $row['bezoekadres'] . '<br />' .
                ucfirst(strtolower($row['plaats'])) . ', ' . ucfirst(strtolower($row['provincie'])); ?>
        </div>

        <?php if($row['facebook'] || $row['twitter'] || $row['linkedin'] || $row['pinterest'] || $row['googleplus'] || $row['youtube']) { ?>
            <div class="col-sm-4 col-lg-offset-1 social">
                <h2>Social media</h2>
                <?php
                foreach($socials as $social) {
                    if($row[$social]) {
                        echo '<a href="' . $row[$social] . '"><img width="25" height="25" src="./assets/images/icons/' . $social . '.png" /></a>';
                    }
                }
                ?>
            </div>
        <?php } ?>

        <div class="col-sm-4 col-lg-offset-1 specialisaties">
            <h2>Onze specialisaties</h2>
            <?php
            foreach ($sth->fetchAll(PDO::FETCH_ASSOC) as $row) {
                echo $row['specialiteiten_naam'] . '<br />';
            }
            ?>
        </div>

        <div class="col-sm-4 col-lg-offset-1 openingstijden">
            <h2>Openingstijden</h2>

            <span class="item">Ma: <?php echo $row['maandag']; ?></span>
            <span class="item">Di: <?php echo $row['dinsdag']; ?></span>
            <span class="item">Wo: <?php echo $row['woensdag']; ?></span>
            <span class="item">Do: <?php echo $row['donderdag']; ?></span>
            <span class="item">Vr: <?php echo $row['vrijdag']; ?></span>
            <span class="item">Za: <?php echo $row['zaterdag']; ?></span>
            <span class="item">Zo: <?php echo $row['zondag']; ?></span>
        </div>
    </div>
</div>