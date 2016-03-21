<h1>modification des droits de l'utilisateur : <?php echo $user->login()?></h1>
<form action="?controler=user&action=adminlvl" method="post">
	<input id="adminlvl" name="adminlvl" type="text" value="<?php if ($userRights){echo $userRights->adminlvl();}?>">
	<input id="userid" name="userid" type="hidden" value="<?php echo $user->id()?>">
	<input type="submit">
</form>