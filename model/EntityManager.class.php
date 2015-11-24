<?php
abstract class EntityManager {
	protected $_db;
	protected $_entityName;
	
	/*constructeur*/
	public function __construct($db)
	{
		$this->setDb($db);
		$this->_entityName = str_replace('Manager', '', get_class($this));
	}
	
	public function setDb(PDO $db)
	{
		$this->_db = $db;
	}
	
	/*création des tables de l'entité*/
	public function createTable() {
		$entityName = $this->_entityName;
		$entityProperties = $entityName::$_properties;
		foreach ($entityProperties as $table => $properties) {
			
			$propertiesStr = '';
			foreach ($properties as $keyName => $dbParams) {
				if (!empty($dbParams['LEN'])){
					$propertiesStr = $propertiesStr.'`'.$keyName.'` '.$dbParams['TYPE'].'('.$dbParams['LEN'].') '.$dbParams['NULL_OR_NOT'].' COMMENT \''.$dbParams['COMMENT'].'\',';
				}else{
					$propertiesStr = $propertiesStr.'`'.$keyName.'` '.$dbParams['TYPE'].' '.$dbParams['NULL_OR_NOT'].' COMMENT \''.$dbParams['COMMENT'].'\',';
				}
			}
			
			$key = '';
			foreach ($properties as $keyName => $dbParams){
				if (!empty($dbParams['KEY'])){
					$key = $key.$dbParams['KEY'].' `'.$keyName.'` (`'.$keyName.'`),';
				}
			}
			
			$chaine = "CREATE TABLE IF NOT EXISTS `".$table."` (
				id int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'idex primaire',
				".$propertiesStr.$key."
				PRIMARY KEY (id)
				) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1";
			
			$q = $this->_db->prepare($chaine);
			$result = $q->execute();
			$q->closeCursor();
			return $chaine;
		}
	}
	
	/*CRUD*/
	
	/*CREAT A NEW ENTRY*/
	public function add($entity) {
		if ($this->_entityName == get_class($entity)){
			$entityName = $this->_entityName;
			$entityProperties = $entityName::$_properties;
			foreach ($entityProperties as $table => $properties) {
					
				$propertiesStr = '';
				foreach ($properties as $keyName => $dbParams) {
					$propertiesStr = $propertiesStr.' '.$keyName.' = :'.$keyName.',';
				}
				$propertiesStr = substr($propertiesStr,0,strlen($propertiesStr)-1);
				
				$q = $this->_db->prepare("INSERT INTO `".$table."` SET".$propertiesStr);
				
				foreach ($properties as $keyName => $dbParams) {
					$q->bindValue(':'.$keyName, $entity->$keyName());
				}
				
				$result = $q->execute();
				$q->closeCursor();
				return $result;
			}
		}
		else {
			throw new Exception('l\'entity et l\'entityManager sont incompatible.');
		}
	}
	
	/*renvoi l'entité demandé*/
	public function get($value,$selectKeyName = 'id',$several=FALSE) {
		$entityName = $this->_entityName;
		$entityProperties = $entityName::$_properties;
		$donnees = array();
		$entitys = array();
		foreach ($entityProperties as $table => $properties) {
			if (is_string($value)){
				$q = $this->_db->query("SELECT * FROM `".$table."` WHERE `".$selectKeyName."` = '".$value."'");
			}else {
				$q = $this->_db->query("SELECT * FROM `".$table."` WHERE `".$selectKeyName."` = ".$value);
			}
			
			if($several){
				while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
				{
					$entitys[] = new $entityName($donnees);
				}
				return $entitys;
			}else{
				if ($donnees = $q->fetch(PDO::FETCH_ASSOC)){
					return new $entityName($donnees);
				}else{
					return false;
				}
			}
			
		}
	}
	
	/*revoi la liste de toutes les entité demandé*/
	public function getList($orderBy='id',$nb=9999,$desc=TRUE)
	{
		if ($desc){
			$desc = ' DESC';
		}else{
			$desc = '';
		}
		$cmpt = 0;
		$entityName = $this->_entityName;
		$entityProperties = $entityName::$_properties;
		$entitys = array();
		
		foreach ($entityProperties as $table => $properties) {
			$q = $this->_db->query("SELECT * FROM `".$table."` ORDER BY ".$orderBy.$desc);
			while (($donnees = $q->fetch(PDO::FETCH_ASSOC)) && ($cmpt<$nb))
			{
				$entitys[] = new $entityName($donnees);
				$cmpt++;
			}
			return $entitys;
		}
	}
	
	/*renvoi une liste d'entitée par page*/
	public function getPage ($pageNb=1,$nbParPage=5,$orderBy='id',$nb=9999,$desc=TRUE){
		if ($desc){
			$desc = ' DESC';
		}else{
			$desc = '';
		}
		$cmpt = 0;
		$entityName = $this->_entityName;
		$entityProperties = $entityName::$_properties;
		$entitys = array();
		$page = array();
		
		foreach ($entityProperties as $table => $properties) {
			$q = $this->_db->query("SELECT * FROM `".$table."` ORDER BY ".$orderBy.$desc);
			while (($donnees = $q->fetch(PDO::FETCH_ASSOC)) && ($cmpt<$nb) && ($cmpt < ($pageNb * $nbParPage)))
			{
				if ($cmpt >= (($pageNb * $nbParPage) - $nbParPage)){
					$entitys[] = new $entityName($donnees);
				}
				$cmpt++;
			}
			
			return $entitys;
		}
	}
	
	public function count(){
		$entityName = $this->_entityName;
		$entityProperties = $entityName::$_properties;
		foreach ($entityProperties as $table => $properties) {
			$q = $this->_db->query("SELECT COUNT(*) FROM ".$table);
			while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
			{
				return $nbPage = $donnees['COUNT(*)'];
			}
		}
	}
	
	public function update($entity) {
		
		if ($this->_entityName == get_class($entity)){
			$entityName = $this->_entityName;
			$entityProperties = $entityName::$_properties;
			foreach ($entityProperties as $table => $properties) {
					
				$propertiesStr = '';
				foreach ($properties as $keyName => $dbParams) {
					$propertiesStr = $propertiesStr.' '.$keyName.' = :'.$keyName.',';
				}
				$propertiesStr = substr($propertiesStr,0,strlen($propertiesStr)-1);
		
				$q = $this->_db->prepare("UPDATE `".$table."` SET".$propertiesStr." WHERE id = ".$entity->id());
		
				foreach ($properties as $keyName => $dbParams) {
					$q->bindValue(':'.$keyName, $entity->$keyName());
				}
				$result = $q->execute();
				$q->closeCursor();
				return $result;
			}
		}
		else {
			throw new Exception('l\'entity et l\'entityManager sont incompatible.');
		}
		
	}
	
	public function delete($value,$selectKeyName = 'id') {
		$entityName = $this->_entityName;
		$entityProperties = $entityName::$_properties;
		foreach ($entityProperties as $table => $properties) {
			if (is_string($value)){
				$this->_db->exec('DELETE FROM `'.$table.'` WHERE '.$selectKeyName.' =\''.$value.'\'');
			}else {
				$this->_db->exec('DELETE FROM `'.$table.'` WHERE '.$selectKeyName.' ='.$value);
			}
			
		}
	}
}