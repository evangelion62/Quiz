 <h1>Listes des themes de Quiz</h1>
 <a href="?controler=theme&action=add"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Ajouter un nouveau theme</a>
 <table class="table table-bordered" style="background-color: white;">
  <tr>
    <th>theme</th>
    <th>id</th>
    <th>Supression du theme</th>
  </tr>
  <?php
  foreach ($themes as $theme) {
  	echo '
  <tr>
    <td><a href="?controler=theme&action=update&id='.$theme->id().'"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> '.$theme->theme().'</a></td>
    <td>'.$theme->id().'</td>
    <td><a href="?controler=theme&action=delete&id='.$theme->id().'"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span> Suprimer</a></td>
  </tr>
    		';
  } 
  ?>
</table> 
