<?php
	require("notebook_model.php");
	$server = new SoapServer("notebook.wsdl");
	$server->setClass('Notebook');
	$server->handle();
?>
