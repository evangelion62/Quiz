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
					
					
					$question = $questions[$_SESSION['lastquestion']];
					
					ob_start();
					require_once 'view/game/question.php';
					$content = ob_get_contents();
					ob_end_clean();
					require_once 'view/layout/layout.php';
					
				}else{//fin du quizz
					header('Location: ?controler=game&action=correction&mode=all');
				}
			}else{//premiére question
				$question = $questions[0];
				$_SESSION['lastquestion']=0;
				
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
		if (isset($_POST['rep']) && isset($_POST['qid'])){
			$_SESSION['userrep'][$_POST['qid']]=$_POST['rep'];
			$_SESSION['lastquestion']+=1;
			header('Location: ?controler=game&action=nextquestion');
		}else{
			header('Location: ?controler=game&action=nextquestion');
		}
	break;
	
	case 'correction':
		if (isset($_GET['mode']) && isset($_SESSION['userrep']) && isset($_SESSION['themeid'])){
			if ($_GET['mode'] == 'all'){//correction de tous le qcm
				$questionManager = new QuestionManager($bdd);
				$questions = $questionManager->get($_SESSION['themeid'],'themeid',TRUE);
				$goodRepCmpt = 0;
				$nbUserRep = 0;
				$questfinish = false;
				$nb_questions = count($questions);
				
				foreach ($questions as $question){
					if (isset($_SESSION['userrep'][$question->id()])){
						$nbUserRep++;
						$userrep  = $_SESSION['userrep'][$question->id()];
						$goodrep  = $question->rep();
						if ($userrep == $goodrep){
							$goodRepCmpt++;
						}
					}
				}
				
				if ($nbUserRep>=$nb_questions){
					$questfinish = true;
				}
				
				ob_start();
				require_once 'view/game/questcorrect.php';
				$content = ob_get_contents();
				ob_end_clean();
				require_once 'view/layout/layout.php';
			}elseif ($_GET['mode'] == 'one'){//correction de la derniére question
				
			}
		}
	break;
	
	case 'quizzend':
		unset($_SESSION['lastquestion']);
		unset($_SESSION['nb_questions']);
		unset($_SESSION['themeid']);
		unset($_SESSION['userrep']);
		header('Location: ?controler=index');
	break;
}