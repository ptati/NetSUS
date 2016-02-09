<?php

include "inc/config.php";
include "inc/auth.php";
include "inc/functions.php";

$title = "Restart";

include "inc/header.php";

if (isset($_POST['confirm']))
{
	echo '<meta http-equiv="refresh" content="60;url=index.php">';
	echo '<div class="alert alert-warning alert-margin-top">NOTICE: Restarting the NetBoot/SUS/LDAP Proxy Server.</div>';
}

?>

<h2>Restart</h2>

<ul class="nav nav-tabs"></ul>

<div id="form-wrapper">

	<form action="restart.php" method="POST" name="Restart" id="Restart">

		<br>

		<p>Are you sure you want to restart the NetBoot/SUS/LDAP Proxy Server?</p>
		<?php
		$afpconns = trim(suExec("afpconns"));
		$smbconns = trim(suExec("smbconns"));
		if (($afpconns > 0) || ($smbconns > 0))
		{
			echo '<div class="well">There are '.($afpconns + $smbconns).' users connected to this server. If you restart they will be disconnected.</div>';
		}
		?>

		<input type="submit" id="confirm" name="confirm" class="btn btn-sm btn-primary" value="Restart" <?php if (isset($_POST['confirm'])) { echo "disabled"; } ?>>
		<br>
		<br>

	</form> <!-- end form Restart -->

	<ul class="nav nav-tabs"></ul>
	<br>

	<input type="button" id="back-button" name="action" class="btn btn-sm btn-primary" value="Back" onclick="document.location.href='<?php echo $_SERVER['HTTP_REFERER']; ?>'" <?php if (isset($_POST['confirm'])) { echo "disabled"; } ?>>

</div><!--  end #form-wrapper -->

<?php include "inc/footer.php"; ?>

<?php
if (isset($_POST['confirm']))
{
	suExec("restart");
}
?>