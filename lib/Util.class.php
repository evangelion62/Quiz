<?php
class Util {
	function getAdminlvl($token,$bdd) {
		if (!empty($token)){
		$tokenManager= new TokenManager($bdd);
		$token=$tokenManager->get($token,'token');
		$userRightsManager = new UserRightsManager($bdd);
		$userRights = $userRightsManager->get($token->userid(),'userid');
		}
		return $userRights->adminlvl();
	}
}
