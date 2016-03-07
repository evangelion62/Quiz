<?php
switch ($action) {
	case 'index':
		$adminLvlThisControler=1;
		require_once 'lib/checkRights.php';
		
		header('Location: ?controler=question&action=list');
	break;
	
	case 'add':
		
		$adminLvlThisControler=2;
		require_once 'lib/checkRights.php';
		
		if(isset($_POST['question'])&&isset($_POST['rep'])){

			$questionManager = new QuestionManager($bdd);
			
			$question = new Question($_POST);
			$questionManager->add($question);
			header('Location: ?controler=question&action=list');
		}else{
			$themeManager = new ThemeManager($bdd);
			$themes = $themeManager->getList();
			ob_start();
			require_once 'view/question/addQuestion.php';
			$content = ob_get_contents();
			ob_end_clean();
			require_once 'view/layout/layout.php';
		}
	break;
		
	case 'list':
		
		$adminLvlThisControler=1;
		require_once 'lib/checkRights.php';
		
		$questionManager = new QuestionManager($bdd);
		$questions=$questionManager->getList();
		$themeManager = new ThemeManager($bdd);
		$themes = $themeManager ->getList();
		ob_start();
		require_once 'view/question/listQuestion.php';
		$content = ob_get_contents();
		ob_end_clean();
		require_once 'view/layout/layout.php';
	break;
	
	case 'update':
		
		$adminLvlThisControler=3;
		require_once 'lib/checkRights.php';
		
		if(isset($_GET['id'])&&!isset($_POST['question'])&&!isset($_POST['rep'])){
			$questionManager = new QuestionManager($bdd);
			$question = $questionManager->get((int)$_GET['id']);
			$themeManager = new ThemeManager($bdd);
			$themes = $themeManager->getList();
			ob_start();
			require_once 'view/question/updateQuestion.php';
			$content = ob_get_contents();
			ob_end_clean();
			require_once 'view/layout/layout.php';
		}elseif (isset($_POST['question'])&&isset($_POST['rep'])){
			$questionManager = new QuestionManager($bdd);
			$question = new Question($_POST);
			$questionManager->update($question);
			header('Location: ?controler=question&action=list');
		}else{
			header('Location: ?controler=question&action=list');
		}
	
	break;
	
	case 'delete':
		
		$adminLvlThisControler=3;
		require_once 'lib/checkRights.php';
		
		if(isset($_GET['id'])){
			$questionManager = new QuestionManager($bdd);
			$questionManager->delete($_GET['id']);
			header('Location: ?controler=question&action=list');
		}else{
			header('Location: ?controler=question&action=list');
		}
	break;
	
	case 'csvImport':
		
		$adminLvlThisControler=4;
		require_once 'lib/checkRights.php';
		
		if (isset($_POST['file'])){
			if ($file = fopen('web/csv/'.$_POST['file'],'r')){
				$questionManager = new QuestionManager($bdd);
				$question = new Question(array());
				while ($ligne = fgetcsv($file,0,';','"')){
					$question->setQuestion($ligne[0]);
					$question->setRep1($ligne[1]);
					$question->setRep2($ligne[2]);
					$question->setRep3($ligne[3]);
					$question->setRep4($ligne[4]);
					$question->setRep($ligne[5]);
					$questionManager->add($question);
				}
				header('Location: ?controler=question&action=list');
			}
		}else{
			$directory = 'web/csv/';
			$files = array_diff(scandir($directory), array('..', '.'));
			
			ob_start();
			require_once 'view/question/csvimport.php';
			$content = ob_get_contents();
			ob_end_clean();
			require_once 'view/layout/layout.php';
		}
	break;
	default:
		header('Location: ?controler=question&action=list');
	break;
}