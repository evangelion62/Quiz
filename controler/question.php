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
		
		$util = new Util();
		$userid = $util->getUserId($_SESSION['token'], $bdd);
		
		if(isset($_POST['question'])&&isset($_POST['rep'])){

			$questionManager = new QuestionManager($bdd);
			
			$question = new Question($_POST);
			$question->setUserid($userid);
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
		$userManager = new UserManager($bdd);
		$users = $userManager->getList();
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
			$questionOld = $questionManager->get($question->id());
			$question->setUserid($questionOld->userid());
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
		
		if (isset($_POST['file']) && !empty($_POST['theme'])){
			if ($file = fopen('web/csv/'.$_POST['file'],'r')){
				$questionManager = new QuestionManager($bdd);
				$question = new Question(array());
				while ($ligne = fgetcsv($file,0,'|','"')){
					$question->setQuestion(stripslashes($ligne[0]));
					$question->setRep1($ligne[1]);
					$question->setRep2($ligne[2]);
					$question->setRep3($ligne[3]);
					$question->setRep4($ligne[4]);
					$question->setRep($ligne[5]);
					$question->setThemeid($_POST['theme']);
					$question->setUserid($ligne[6]);
					$questionManager->add($question);
				}
				header('Location: ?controler=question&action=list');
			}
		}else{
			$directory = 'web/csv/';
			$files = array_diff(scandir($directory), array('..', '.'));
			
			$themeManager = new ThemeManager($bdd);
			$themes = $themeManager->getList();
			
			ob_start();
			require_once 'view/question/csvimport.php';
			$content = ob_get_contents();
			ob_end_clean();
			require_once 'view/layout/layout.php';
		}
	break;
	
	case 'purge':
		$questionManager = new QuestionManager($bdd);
		$questionManager->purge();
		header('Location: ?controler=question&action=list');
	break;
	
	case 'exportbythem':
		if (!empty($_GET['id'])){
			$questionManager = new QuestionManager($bdd);
			$questions=$questionManager->getList();
			
			$chemin = 'web/csv/questexport.csv';
			$filename = 'questexport.csv';
			$delimiteur = '|';
			
			if($fichier_csv = fopen($chemin,'w+'))
			{
				fprintf($fichier_csv, chr(0xEF).chr(0xBB).chr(0xBF));
			
				foreach ($questions as $question){
					if ($question->themeid()==($_GET['id'])){
						
						$questarray[] = addslashes(str_replace("\r\n","",$question->question()));
						$questarray[] = $question->rep1();
						$questarray[] = $question->rep2();
						$questarray[] = $question->rep3();
						$questarray[] = $question->rep4();
						$questarray[] = $question->rep();
						$questarray[] = $question->userid();
				
						fputcsv($fichier_csv, $questarray , $delimiteur);
						unset($questarray);
					}
				}
			
				fclose($fichier_csv);
			
				ob_start();
				require_once 'view/csv/csvexport.php';
				$content = ob_get_contents();
				ob_end_clean();
				require_once 'view/layout/layout.php';
			}
		}
	break;
	
	default:
		header('Location: ?controler=question&action=list');
	break;
}