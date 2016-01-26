<h1>modification des droits l'utilisateur : <?php echo $user->login()?></h1>
<form action="?controler=user&action=adminlvl" method="post">
	<input id="adminlvl" name="adminlvl" type="text" value="<?php echo $userRights->adminlvl()?>">
	<input id="userid" name="userid" type="hidden" value="<?php echo $userRights->userid()?>">
	<input type="submit">
</form>