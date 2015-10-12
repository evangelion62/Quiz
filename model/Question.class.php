<?php 
class Question extends Entity{
	//definition de la structure base de donné
	public static $_properties = array (
			//table question
			'question'=>array(
					'question'=>array(
							Entity::TYPE=>Entity::TEXT,
							Entity::LEN=>1000,
							Entity::NULL_OR_NOT=>Entity::NOT_NULL,
							Entity::COMMENT=>'la question'
					),
					'rep1'=>array(
							Entity::TYPE=>Entity::TEXT,
							Entity::LEN=>1000,
							Entity::NULL_OR_NOT=>NULL,
							Entity::COMMENT=>'reponse 1'
					),
					'rep2'=>array(
							Entity::TYPE=>Entity::TEXT,
							Entity::LEN=>1000,
							Entity::NULL_OR_NOT=>NULL,
							Entity::COMMENT=>'reponse 2'
					),
					'rep3'=>array(
							Entity::TYPE=>Entity::TEXT,
							Entity::LEN=>1000,
							Entity::NULL_OR_NOT=>NULL,
							Entity::COMMENT=>'reponse 3'
					),
					'rep4'=>array(
							Entity::TYPE=>Entity::TEXT,
							Entity::LEN=>1000,
							Entity::NULL_OR_NOT=>NULL,
							Entity::COMMENT=>'reponse 4'
					),
					'rep'=>array(
							Entity::TYPE=>Entity::TEXT,
							Entity::LEN=>1000,
							Entity::NULL_OR_NOT=>Entity::NOT_NULL,
							Entity::COMMENT=>'bonne reponse'
					),
					'themeid'=>array(
							Entity::TYPE=>Entity::INT,
							Entity::LEN=>11,
							Entity::NULL_OR_NOT=>NULL,
							Entity::COMMENT=>'theme'
					),
			),
	);
	//attributs
	protected $_question;
	protected $_rep1;
	protected $_rep2;
	protected $_rep3;
	protected $_rep4;
	protected $_rep;
	protected $_themeid;
}