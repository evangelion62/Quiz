<?php 
switch ($action) {
	case 'login':
		if(!empty($_POST['login']) && !empty($_POST['pass'])){
			$_POST['pass'] = sha1($_POST['pass']);
			$userToLog = new User($_POST);
			$userManager = new UserManager($bdd);
			if($userToBdd = $userManager->get($userToLog->login(),'login')){
			
				if ($userToLog->pass() == $userToBdd->pass()){
					$tokenParams = array(
							'token' => sha1($userToBdd->id().$userToBdd->login().$userToBdd->pass().$_SERVER['REMOTE_ADDR'].date("Y-m-d H:i:s")),
							'userid' => $userToBdd->id(),
							'userip' => $_SERVER['REMOTE_ADDR'],
							'datetime' => date("Y-m-d H:i:s")
					);
					$token = new Token($tokenParams);
					$tokenManager = new TokenManager($bdd);
					if($lastToken=$tokenManager->get($userToBdd->id(),'userid')){
						$token->setId($lastToken->id());
						$tokenManager->update($token);
					}else{
						$tokenManager->add($token);
					}
					
					$_SESSION['token'] = $token->token();
					
					header('Location: ?controler=index');
				}else{//mot de passe incorrect
					echo 'pass error';
				}
				
			}else{//login incorrect
				echo 'login error';
			}
		}else{
			header('Location: ?controler=index');
		}
	break;
	
	case 'logout':
		$_SESSION = array();
		header('Location: ?controler=index');
	break;
	
	case 'add':
		
		$adminLvlThisControler=3;
		require_once 'lib/checkRights.php';
		
		if (isset($_POST['login'])&&isset($_POST['pass'])){
			$_POST['pass'] = sha1($_POST['pass']);
			$userManager = new UserManager($bdd);
			$user = new User($_POST);
			
			$userManager->add($user);
			header('Location: ?controler=user&action=list');
		}else{
			ob_start();
			require_once 'view/user/adduser.php';
			$content = ob_get_contents();
			ob_end_clean();
			require_once 'view/layout/layout.php';
		}
	break;
	
	case 'del':
		
		$adminLvlThisControler=3;
		require_once 'lib/checkRights.php';
		
		if(isset($_GET['id'])){
			$userManager = new UserManager($bdd);
			
			$userManager->delete($_GET['id']);
			header('Location: ?controler=user&action=list');
		}else{
			header('Location: ?controler=user&action=list');
		}
	break;
	
	case 'edit':
		
		$adminLvlThisControler=3;
		require_once 'lib/checkRights.php';
		
		if (isset($_POST['login']) && isset($_POST['pass']) && isset($_POST['id'])){
			$_POST['pass'] = sha1 ($_POST['pass']);
			$userManager = new UserManager($bdd);
			$user = new User($_POST);
			
			$userManager->update($user);
			
			header('Location: ?controler=user&action=list');
		}elseif(isset($_GET['id'])){
			$userManager = new UserManager($bdd);
			$user = $userManager->get($_GET['id']);
			
			ob_start();
			require_once 'view/user/edituser.php';
			$content = ob_get_contents();
			ob_end_clean();
			require_once 'view/layout/layout.php';
		}
	break;
	
	case 'list':
		
		$adminLvlThisControler=3;
		require_once 'lib/checkRights.php';
		
		$userManager = new UserManager($bdd);
		$users = $userManager->getList();
		$userRightsManager = new UserRightsManager($bdd);
		$usersRights = $userRightsManager->getList();
		
		ob_start();
		require_once 'view/user/listuser.php';
		$content = ob_get_contents();
		ob_end_clean();
		require_once 'view/layout/layout.php';
	break;
	
	case 'adminlvl':
		
		$adminLvlThisControler=4;
		require_once 'lib/checkRights.php';
		
		if (!empty($_POST['userid'])&&!empty($_POST['adminlvl'])){
			$userRights = new UserRights($_POST);
			$userRightsManager = new UserRightsManager($bdd);
			
			if ($userRightsManager->get($_POST['userid'],'userid')){
				$userRights = $userRightsManager->get($_POST['userid'],'userid');
				$userRights->setAdminlvl($_POST['adminlvl']);
				$userRightsManager->update($userRights);
				
				header('Location: ?controler=user&action=list');
			}else{
				
				$userRightsManager->add($userRights);
				
				header('Location: ?controler=user&action=list');
			}
		}elseif(!empty($_GET['userid'])){
			$userManager = new UserManager($bdd);
			$userRightsManager = new UserRightsManager($bdd);
			
			$user = $userManager->get($_GET['userid']);
			$userRights = $userRightsManager->get($_GET['userid'],'userid');
			
			ob_start();
			require_once 'view/user/useradminlvl.php';
			$content = ob_get_contents();
			ob_end_clean();
			require_once 'view/layout/layout.php';
		}
	break;
	
	case 'logoutForced' :
		$_SESSION = array();
		$userError[]= 'token invalide : veuillez vous reconnecter';
		ob_start();
		require_once 'view/user/logoutforced.php';
		$content = ob_get_contents();
		ob_end_clean();
		require_once 'view/layout/layout.php';
	break;
	
	case 'csvImport':
	
		$adminLvlThisControler=4;
		require_once 'lib/checkRights.php';
	
		if (isset($_POST['file'])){
			if ($file = fopen('web/csv/'.$_POST['file'],'r')){
				$userManager = new UserManager($bdd);
				$user = new User(array());
				while ($ligne = fgetcsv($file,0,';','"')){
					$username = strtolower($ligne['1']);
					$username = $username.'.'.strtolower($ligne['2']);
					$username = utf8_encode($username);
					$user->setLogin($username);
					$pass = str_replace ('/','',$ligne['3']);
					$user->setPass(sha1($pass));
					$userManager->add($user);
				}
				header('Location: ?controler=user&action=list');
			}
		}else{
			$directory = 'web/csv/';
			$files = array_diff(scandir($directory), array('..', '.'));
				
			ob_start();
			require_once 'view/user/csvimport.php';
			$content = ob_get_contents();
			ob_end_clean();
			require_once 'view/layout/layout.php';
		}
	break;
		
	default:
		;
	break;
}