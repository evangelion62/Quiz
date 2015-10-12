<?php 
class Theme extends Entity{
	//definition de la structure base de donné
	public static $_properties = array (
			//table question
			'theme'=>array(
					'theme'=>array(
							Entity::TYPE=>Entity::TEXT,
							Entity::LEN=>1000,
							Entity::NULL_OR_NOT=>Entity::NOT_NULL,
							Entity::COMMENT=>'theme de question'
					)
			),
	);
	//attributs
	protected $_theme;
}