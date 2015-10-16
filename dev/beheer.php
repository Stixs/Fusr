<?php
require('./controllers/header.php');
?>
<div class="row">
	<div class="col-xs-12 ContentPadding" style="padding-bottom:0;">
		<h3>Beheer fusr</h3>
		<br/>
	</div>
</div>
<div class="btn-group btn-group-justified" role="group" aria-label="...">

    <a href="beheer.php?wijzig=1" class="btn btn-default" role="button">Beheer Specialisaties</a>
    <a href="beheer.php?wijzig=2" class="btn btn-default" role="button">Beheer Sub-branches</a>
	<a href="beheer.php?wijzig=3" class="btn btn-default" role="button">Beheer Branches</a>

</div>
<?php

if($_GET['wijzig'] == 1)
	{
		require('beheer3.php');
	}
elseif($_GET['wijzig'] == 2)
	{
		require('beheer2.php');
	}

require('./controllers/footer.php');
?>
