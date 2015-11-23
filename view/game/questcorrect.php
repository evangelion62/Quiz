<div class="jumbotron">
<a href="?controler=game&action=quizzend" class="btn btn-primary btn-lg" >Terminer le Quiz !</a>
<h2>Score : <?php echo $goodRepCmpt.'/'.$nb_questions;?></h2>
<?php foreach ($questions as $question){
		if (isset($_SESSION['userrep'][$question->id()])){
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
		}else{
			
			echo '<h3><span class="glyphicon glyphicon-remove text-danger" aria-hidden="true"></span> Question : '.$question->question().'</h3>';
			echo '<p class="bg-danger">Aucune réponse enregistré</p>';
		}
		
}?>
<a href="?controler=game&action=quizzend" class="btn btn-primary btn-lg" >Terminer le Quiz !</a>
</div>