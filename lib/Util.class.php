<?php
class Util {
	function getAdminlvl($token,$bdd) {
			if (!empty($token)){
			$tokenManager = new TokenManager($bdd);
			
			if($tokenbdd = $tokenManager->get($token,'token')){
				
				if ($tokenbdd->userip() == $_SERVER['REMOTE_ADDR'] ){
					$userId = $tokenbdd->userid();
					$userRightsManager = new UserRightsManager($bdd);
					$userRights = $userRightsManager->get($userId,'userid');
					return ($userRights);
				}else{
					header('Location: ?controler=user&action=logoutForced');
					exit();
				}
			}
		}
		
	}
}
