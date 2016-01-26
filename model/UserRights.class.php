<?php 
class UserRights extends Entity{
	//definition de la structure base de donné
	public static $_properties = array (
			//table userrights
			'userrights'=>array(
					'userid'=>array(
							Entity::TYPE=>Entity::INT,
							Entity::LEN=>Entity::INT_MAX_LEN,
							Entity::NULL_OR_NOT=>Entity::NOT_NULL,
							Entity::COMMENT=>'id utilisateur',
							Entity::KEY=>Entity::UNIQUE_KEY
					),
					'adminlvl'=>array(
							Entity::TYPE=>Entity::INT,
							Entity::LEN=>Entity::INT_MAX_LEN,
							Entity::NULL_OR_NOT=>Entity::NOT_NULL,
							Entity::COMMENT=>'niveau d administration du site'
					)
			),
	);
	//attributs
	protected $_userid;
	protected $_adminlvl;
}