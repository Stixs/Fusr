<?php
require('./controllers/header.php');
?>

<div class="row">
<div class="col-xs-12 advert">
  
<?php

$sth = $pdo->prepare('SELECT * FROM advertenties WHERE vanaf_datum < '.time().' and tot_datum > '.time().' ORDER BY RAND() LIMIT 6');
	$sth->execute();
	$count = 0;
	
	while($row = $sth->fetch())
	{

	$count++;
	
		if(!empty($row['url'])) { ?><a href="<?php echo addhttp($row['url']); ?>" target="_blank"><?php } ?>
	
		<div class="advertcontainer">
			<div class="advertimage">
				<?php
					$link = "images/advertentie_images/" . friendly_url($row['titel']) . "/" . $row['afbeelding'];

					if(file_exists($link) && !is_dir($link)) {
						echo '<img src="' . $link . '">';
					}
					?>
			</div>
			<div class="advertnaam">
				<h4><?php echo $row['titel']; ?></h4>
			</div>
		</div>
	<?php if(!empty($row['url'])) { ?> </a> <?php } 

	}
?>
</div>

<?php
require('./controllers/footer.php');
?>
