<h1>Liste de tout les utilisateur</h1>
<a href="?controler=user&action=add"> <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Ajouter un nouvel utilisateur</a>
<a href="?controler=user&action=csvImport"> <span class="glyphicon glyphicon-upload" aria-hidden="true"></span> Importé</a>
<a href="?controler=csv&action=userexport"> <span class="glyphicon glyphicon-download" aria-hidden="true"></span> Exporté</a>
 <br><br>
 <table class="table table-bordered" style="background-color: white;">
  <tr>
    <th>Login</th>
    <th>Mot de passe (hash)</th>
    <th>Suprimer l'utilisateur</th>
  </tr>
  <?php
  foreach ($users as $user) {
  	echo '
  <tr>
    <td><a href="?controler=user&action=edit&id='.$user->id().'"><span class="glyphicon glyphicon-pencil" aria-hidden="true"> </span> '.$user->login().'</a></td>
    <td>'.$user->pass().'</td>
    <td><a href="?controler=user&action=del&id='.$user->id().'"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span> Suprimer</a></td>
  </tr>
    		';
  } 
  ?>
</table> 
