<?php 
class User extends Entity{
	//definition de la structure base de donné
	public static $_properties = array (
			//table user
			'user'=>array(
					'login'=>array(
							Entity::TYPE=>Entity::VARCHAR,
							Entity::LEN=>255,
							Entity::NULL_OR_NOT=>Entity::NOT_NULL,
							Entity::COMMENT=>'identifiant utilisateur',
							Entity::KEY=>Entity::UNIQUE_KEY
					),
					'pass'=>array(
							Entity::TYPE=>Entity::VARCHAR,
							Entity::LEN=>255,
							Entity::NULL_OR_NOT=>Entity::NOT_NULL,
							Entity::COMMENT=>'mot de passe utilisateur'
					)
			),
	);
	//attributs
	protected $_login;
	protected $_pass;
}