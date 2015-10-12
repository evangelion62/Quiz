<?php 
switch ($action) {
	case 'list':
		$themeManager = new ThemeManager($bdd);
		$themes = $themeManager->getList();
		
		ob_start();
		require_once 'view/theme/listTheme.php';
		$content = ob_get_contents();
		ob_end_clean();
		require_once 'view/layout/layout.php';
	break;
	
	case'add':
		if(isset($_POST['theme'])){
		
			$themeManager = new ThemeManager($bdd);
			$theme = new Theme($_POST);
			$themeManager->add($theme);
			header('Location: ?controler=theme&action=list');
		}else{
			
			ob_start();
			require_once 'view/theme/addTheme.php';
			$content = ob_get_contents();
			ob_end_clean();
			require_once 'view/layout/layout.php';
		}
	break;
	
	case 'update':
		if(isset($_GET['id'])&&!isset($_POST['theme'])){
			$themeManager = new ThemeManager($bdd);
			$theme = $themeManager->get($_GET['id']);
			
			ob_start();
			require_once 'view/theme/updateTheme.php';
			$content = ob_get_contents();
			ob_end_clean();
			require_once 'view/layout/layout.php';
		}elseif (isset($_POST['theme'])){
			$themeManager = new ThemeManager($bdd);
			$theme = new Theme($_POST);
			$themeManager->update($theme);
			header('Location: ?controler=theme&action=list');
		}else{
			header('Location: ?controler=theme&action=list');
		}
	break;
	
	case 'delete':
		if(isset($_GET['id'])){
			$themeManager = new ThemeManager($bdd);
			$themeManager->delete($_GET['id']);
			header('Location: ?controler=theme&action=list');
		}else{
			header('Location: ?controler=theme&action=list');
		}
	break;
	default:
		echo 'action non reconnue';
	break;
}