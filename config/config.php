<?php
//connection � la bdd
try
{
	$bdd = new PDO('mysql:host=localhost;dbname=test','root','');
}
catch (Exception $e)
{
	$_GET['controler']='install';
	$_GET['action']='bddFirstConfig';
	$userErrors['bdderror']='Mauvaise configuration de la base de données. Veuillez vérifier vos informations!';
}
//autoload
function chargerClasse($classe)
{
	require_once 'model/'.$classe. '.class.php'; // On inclut la classe correspondante au paramètre passé.
}

spl_autoload_register('chargerClasse');

//d�finition des varriable controler et action
if (!empty($_GET['controler'])) {
	$_GET['controler']=stripslashes($_GET['controler']);
	$_GET['controler']=htmlspecialchars($_GET['controler']);
	$controler='controler/'.$_GET['controler'].'.php';
}else{
	$controler='controlers/index.php';
}

if (!empty($_GET['action'])){
	$_GET['action']=stripslashes($_GET['action']);
	$_GET['action']=htmlspecialchars($_GET['action']);
	$action=$_GET['action'];
}else{
	$action='index';
}

//demarage du module de session
session_start();
