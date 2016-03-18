<div class="jumbotron">

<?php foreach ($questions as $question){
		if (isset($_SESSION['userrep'][$question->id()])&&isset($_SESSION['lastquestionId'])){
			if ($question->id() == $_SESSION['lastquestionId']){
				$userrep  = $_SESSION['userrep'][$question->id()];
				$goodrep  = $question->rep();
				if ($userrep == $goodrep){
					echo '<h3><span class="glyphicon glyphicon-ok text-success" aria-hidden="true"></span> Question : '.$question->question().'</h3>';
					echo '<p class="bg-success">';
					echo 'Réponse correcte : '.$question->$userrep();
					echo '</p>';
				}else{
					echo '<h3><span class="glyphicon glyphicon-remove text-danger" aria-hidden="true"></span> Question : '.$question->question().'</h3>';
					echo '<p class="bg-danger">';
					echo 'Votre réponse : '.$question->$userrep().'<br>';
					echo '</p><p class="bg-success">';
					echo 'Bonne réponse : '.$question->$goodrep();
					echo '</p>';
				}
				echo '<br>';
			}
			
		}
		
}?>
<?php if (!$questfinish){?>
<a href="?controler=game&action=nextquestion" class="btn btn-primary btn-lg" >Question suivante !</a>
<?php }else{?>
<h1>Quiz Terminer</h1>
<?php }?>