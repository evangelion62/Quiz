<h1>Liste de tous les utilisateurs</h1>
<a href="?controler=user&action=add"> <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Ajouter un nouvel utilisateur</a>
<a href="?controler=user&action=csvImport"> <span class="glyphicon glyphicon-upload" aria-hidden="true"></span> Importer</a>
<a href="?controler=user&action=userexport"> <span class="glyphicon glyphicon-download" aria-hidden="true"></span> Exporter</a>
 <br><br>
 <table class="table table-bordered" style="background-color: white;">
  <tr>
    <th>Login</th>
    <th>Mot de passe (hash)</th>
    <th>Suprimer l'utilisateur</th>
    <th>Niveau d'administration</th>
  </tr>
  <?php
  foreach ($users as $user) {
  		$cmpt= 0;
  	?>
  <tr>
    <td><a href="?controler=user&action=edit&id=<?php echo $user->id()?>"><span class="glyphicon glyphicon-pencil" aria-hidden="true"> </span> <?php echo $user->login()?></a></td>
    <td><?php echo $user->pass()?></td>
    <td><a href="?controler=user&action=del&id=<?php echo $user->id()?>"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span> Suprimer</a></td>
	<td><?php foreach ($usersRights as $userRight){
		if ($userRight->userid() == $user->id()){
			$cmpt = 1;
			echo '<a href="?controler=user&action=adminlvl&userid='.$user->id().'"><span class="glyphicon glyphicon-pencil" aria-hidden="true"> </span> '.$userRight->adminlvl().'</a>';
		}
	}
  		if ($cmpt ==0){
			echo '<a href="?controler=user&action=adminlvl&userid='.$user->id().'"><span class="glyphicon glyphicon-pencil" aria-hidden="true"> </span>paramétrer les droits</a>';
		}?></td>
  </tr>
  <?php 
  } 
  ?>
</table>