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
		header('Location: ?controler=index');
	break;
	
	default:
		;
	break;
}