<?php

require_once 'lib/Util.class.php';
$util = new Util();

if (!empty($_SESSION['token'])){

	$userRights=$util->getAdminlvl($_SESSION['token'], $bdd);
	if ($userRights->adminlvl() < $adminLvlThisControler ){
		ob_start();
			
		$userError[] = 'vous n\'avez pas les droits suffisants';
			
		require_once 'view/error/accessdenied.php';
		$content = ob_get_contents();
		ob_end_clean();
		require_once 'view/layout/layout.php';
			
		exit();
	}
}else{
	$userError[] = 'cette page requiére une authentification merci de vous connecter';

	require_once 'view/error/accessdenied.php';
	$content = ob_get_contents();
	ob_end_clean();
	require_once 'view/layout/layout.php';
}

