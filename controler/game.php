<?php
switch ($action){
	case 'index':
		$themeManager = new ThemeManager($bdd);
		$themes = $themeManager->getList();
		
		ob_start();
		require_once 'view/game/allTheme.php';
		$content = ob_get_contents();
		ob_end_clean();
		require_once 'view/layout/layout.php';
		
	break;
	
	case 'starttheme':
		if (isset($_GET['id'])){
			$questionManager = new QuestionManager($bdd);
			$questions = $questionManager->get($_GET['id'],'themeid',TRUE);
			
			$nb_questions = count($questions);
			$_SESSION['nb_questions'] = $nb_questions;
			$_SESSION['themeid'] = $_GET['id'];
				
			
			if($nb_questions>0){
				header('Location: ?controler=game&action=nextquestion');
			}else{
				header('Location: ?controler=index');
			}
			
		}else{
			header('Location: ?controler=index');
		}
	break;
	
	case 'nextquestion':
		if (isset($_SESSION['themeid'])&&isset($_SESSION['nb_questions'])){

			$questionManager = new QuestionManager($bdd);
			$questions = $questionManager->get($_SESSION['themeid'],'themeid',TRUE);
			
			
			if(isset($_SESSION['lastquestion'])){//seconde question et les suivante
				if ($_SESSION['lastquestion']<$_SESSION['nb_questions']){

					$question = $questions[$_SESSION['lastquestion']+1];
					
					ob_start();
					require_once 'view/game/question.php';
					$content = ob_get_contents();
					ob_end_clean();
					require_once 'view/layout/layout.php';
					
				}else{//fin du quizz
					header('Location: ?controler=game&action=quizzend');
				}
			}else{//premiére question
				$question = $questions[0];
				
				ob_start();
				require_once 'view/game/question.php';
				$content = ob_get_contents();
				ob_end_clean();
				require_once 'view/layout/layout.php';
			}
				
		}else{
			header('Location: ?controler=index');
		}
	break;
	
	case 'checkrep':
	break;
	
	case 'quizzend':
		
	break;
}