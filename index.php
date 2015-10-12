<?php
	require_once ('config/config.php');

	if (is_file($controler)){
		require_once $controler;
	}else{
		require_once ('controler/index.php');
	}
