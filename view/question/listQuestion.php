<h1>Liste de toutes les questions</h1>
<a href="?controler=question&action=add"> <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Ajouter une nouvelle question</a>
<a href="?controler=question&action=csvImport"> <span class="glyphicon glyphicon-upload" aria-hidden="true"></span> Importer</a>
<a href="?controler=csv&action=questexport"> <span class="glyphicon glyphicon-download" aria-hidden="true"></span> Exporter</a>
 <br><br>
 <table class="table table-bordered" style="background-color: white;">
  <tr>
    <th>Question</th>
    <th>Bonne Réponse</th>
    <th>Thème du Quizz</th>
    <th>Suprimer la question</th>
    <th>Rédacteur</th>
  </tr>
  <?php
  foreach ($questions as $question) {
  	echo '
  <tr>
    <td><a href="?controler=question&action=update&id='.$question->id().'"><span class="glyphicon glyphicon-pencil" aria-hidden="true"> </span> '.$question->question().'</a></td>
    <td>'.$question->rep().'</td>
    <td>';
    foreach ($themes as $theme) {
    	if($theme->id() == $question->themeid()){
			echo $theme->theme();
		}
    }
    echo'</td>
    <td><a href="?controler=question&action=delete&id='.$question->id().'"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span> Suprimer</a></td>
 	<td>';
    foreach ($users as $user) {
    	if($user->id() == $question->userid()){
			echo $user->login();
		}
    }
    echo'</td>
  </tr>
    		';
  } 
  ?>
</table> 
