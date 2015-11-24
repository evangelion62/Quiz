<?php
switch ($action) {
	case 'index':
		
		/*création des tables*/
		$questionManager = new QuestionManager($bdd);
		$questionManager->createTable();
		$themeManager = new ThemeManager($bdd);
		$themeManager->createTable();
		$userManager = new UserManager($bdd);
		$userManager->createTable();
		$tokenManager = new TokenManager($bdd);
		$tokenManager->createTable();
		
		/*redirection*/
		header('Location: ?controler=install&action=firstuser');
	break;
	
	case 'firstuser':
		$userManager = new UserManager($bdd);
		if ($userManager->count()>0){
			header('Location: ?controler=index');
		}else{
			header('Location: ?controler=user&action=add');
		}
	break;
	
	default:
		;
	break;
}