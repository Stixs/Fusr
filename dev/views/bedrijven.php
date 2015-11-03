<a class="noline" href="javascript:javascript:history.go(-1)">
    <div class="teruglink">
        <div>Dit is een profiel pagina, <u>terug naar zoeken</u></div>
    </div>
</a>
<div class="col-xs-10 col-md-8 col-xs-offset-1 col-md-offset-2 profilepage">
    <div class="row">
        <?php if(!empty($row['logo'])) { ?>
        <div class="company-logo">
            <img src="./assets/images/bedrijf_images/<?php echo $row['bedrijfs_id'] .'/'.$row['logo']; ?>" />
        </div>
        <?php } ?>

        <?php if(!empty($row['profiel_afbeelding'])) { ?>
        <div class="company-image" style="background: url('./assets/images/bedrijf_images/<?php echo $row['bedrijfs_id'] .'/'.$row['profiel_afbeelding']; ?>') center center no-repeat transparent;"></div>
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
                ucfirst(strtolower($row['plaats'])) . ', ' . ucfirst(strtolower($row['provincie']));

                if(!empty($row['telefoonnummer'])) {
                    echo '<br />' . $row['telefoonnummer'];
                }

                if(!empty($row['mobielnummer'])) {
                    echo '<br />' . $row['mobielnummer'];
                }
            ?>
        </div>

        <?php if($row['facebook'] || $row['twitter'] || $row['linkedin'] || $row['pinterest'] || $row['googleplus'] || $row['youtube']) { ?>
            <div class="col-sm-4 col-lg-offset-1 social">
                <h2>Social media</h2>
                <?php
                foreach($socials as $social) {
                    if($row[$social]) {
                        echo '<a href="' . $row[$social] . '" class="btn btn-social-icon btn-' . $social . ' social-edge">
								<i class="fa fa-' . $social . '"></i>
							</a>';
                    }
                }
                ?>
            </div>
        <?php } ?>

        <div class="col-sm-4 col-lg-offset-1 specialisaties">
            <h2>Onze specialisaties</h2>
            <?php
            echo $row['specialiteiten_naam'] . '<br />';
            foreach ($sth->fetchAll(PDO::FETCH_ASSOC) as $row) {
                echo $row['specialiteiten_naam'] . '<br />';
            }
            ?>
        </div>
    </div>
    <div class="col-xs-12">
        <?php include('./controllers/sm_buttons.php'); ?>
    </div>
</div>