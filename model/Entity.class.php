<?php
abstract class Entity{
	/*constante de la class Entity*/
	const TYPE = 'TYPE';
	const LEN = 'LEN';
	const VARCHAR = 'varchar';
	const VARCHAR_MAX_LEN = 255;
	const INT = 'int';
	const INT_MAX_LEN = 10;
	const TEXT = 'text';
	const DATETIME = 'datetime';
	const NOT_NULL = 'NOT NULL';
	const DEFAULT_NULL ='DEFAULT NULL';
	const NULL_OR_NOT = 'NULL_OR_NOT';
	const COMMENT = 'COMMENT';
	const KEY = 'KEY';
	const PRIMARY_KEY = 'PRIMARY KEY';
	const UNIQUE_KEY = 'UNIQUE KEY';
	
	/*attributs*/
	protected $_id;
	
	/*constructeur*/
	public function __construct(array $donnees){
		$this->hydrate($donnees);
	}
	
	/*fonction d'hydratation - initialise l'objet en appelant les seters*/
	final public function hydrate(array $donnees)
	{
		foreach ($donnees as $key => $value)
		{
			// On récupère le nom du setter correspondant à l'attribut.
			$method = 'set'.ucfirst($key);
			$property = '_'.$key;
	
			// Si le setter correspondant existe.
			if (property_exists(get_class($this), $property))
			{
				// On appelle le setter.
				$this->$method($value);
			}
		}
	}
	
	/*geters et seters automatique*/
	function __call($m,$p) {
		//geters
		if (property_exists(get_class($this), '_'.$m)){
			$m = '_'.$m;
			return $this->$m;
		}
		//seters
		if (!strncasecmp($m,'set',3)){
			$v = '_'.strtolower(substr($m, 3));
			if(property_exists(get_class($this), $v)){
				$this->$v = $p[0];
			}
		}
	}
	
	/*seters*/
	public function setId($id){
		$id = (int) $id;
		if ($id > 0){
			$this->_id = $id;
		}
 	}

}