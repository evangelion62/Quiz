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
		unset($_SESSION['token']);
		header('Location: ?controler=index');
	break;
	
	case 'add':
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
		if(isset($_GET['id'])){
			$userManager = new UserManager($bdd);
			
			$userManager->delete($_GET['id']);
			header('Location: ?controler=user&action=list');
		}else{
			header('Location: ?controler=user&action=list');
		}
	break;
	
	case 'edit':
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
		$userManager = new UserManager($bdd);
		$users = $userManager->getList();
		
		ob_start();
		require_once 'view/user/listuser.php';
		$content = ob_get_contents();
		ob_end_clean();
		require_once 'view/layout/layout.php';
	break;
	
	default:
		;
	break;
}