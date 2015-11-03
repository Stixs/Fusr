<?php require('views/header.php'); ?>
<div class="row">
	<div class="col-xs-12 ContentPadding" style="padding-bottom:0;">
		<h3>Beheer fusr</h3>
		<br/>
	</div>
</div>

<?php
require('views/menu.php');

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
?>
<?php require('views/footer.php'); ?>
