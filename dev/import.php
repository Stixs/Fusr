<?php

$mysql = new PDO('mysql:host=localhost;dbname=fusr',"root","");

$mysql->query( "LOAD DATA LOCAL INFILE '/path/to/file.csv' INTO TABLE table_name FIELDS TERMINATED BY ',' ENCLOSED BY '\"' LINES TERMINATED BY '\n'" );
?>