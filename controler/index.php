<?php
switch ($action) {
	case 'index':
		$themeManager = new ThemeManager($bdd);
		$themes = $themeManager->getList();
		
		$pageTitle="page d'acceuil";
		ob_start();
		require_once 'view/home/index.php';
		$content = ob_get_contents();
		ob_end_clean();
		require_once 'view/layout/layout.php';
	break;
	
	default:
		;
	break;
}