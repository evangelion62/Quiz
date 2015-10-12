<?php
switch ($action) {
	case 'index':
	$questionManager = new QuestionManager($bdd);
	$questionManager->createTable();
	$themeManager = new ThemeManager($bdd);
	$themeManager->createTable();
	header('Location: ?controler=index');
	break;
	
	default:
		;
	break;
}