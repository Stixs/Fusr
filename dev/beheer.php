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
if(!isset($_GET['wijzig']))
{
	unset($_SESSION['subbranche']);
	unset($_SESSION['branche']);
}
else
{
	if($_GET['wijzig'] == 1)
		{
			require('beheer_specialiteiten.php');
			unset($_SESSION['branche']);
		}
	elseif($_GET['wijzig'] == 2)
		{
			require('beheer_subbranches.php');
			unset($_SESSION['subbranche']);
			
		}
	elseif($_GET['wijzig'] == 3)
		{
			require('beheer_branches.php');
		}
}
require('./controllers/footer.php');
?>
