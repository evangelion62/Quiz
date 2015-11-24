<?php 
class Token extends Entity{
	//definition de la structure base de donné
	public static $_properties = array (
			//table user
			'token'=>array(
					'token'=>array(
							Entity::TYPE=>Entity::VARCHAR,
							Entity::LEN=>255,
							Entity::NULL_OR_NOT=>Entity::NOT_NULL,
							Entity::COMMENT=>'tokenutilisateur',
							Entity::KEY=>Entity::UNIQUE_KEY
					),
					'userid'=>array(
							Entity::TYPE=>Entity::INT,
							Entity::LEN=>Entity::INT_MAX_LEN,
							Entity::NULL_OR_NOT=>Entity::NOT_NULL,
							Entity::COMMENT=>'id utilisateur'
					),
					'userip'=>array(
							Entity::TYPE=>Entity::VARCHAR,
							Entity::LEN=>255,
							Entity::NULL_OR_NOT=>Entity::NOT_NULL,
							Entity::COMMENT=>'ip utilisateur'
					),
					'datetime'=>array(
							Entity::TYPE=>Entity::DATETIME,
							Entity::NULL_OR_NOT=>Entity::NOT_NULL,
							Entity::COMMENT=>'date et heure du token'
					)
			),
	);
	//attributs
	protected $_token;
	protected $_userid;
	protected $_userip;
	protected $_datetime;
}