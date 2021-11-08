<?php
	//error_reporting(0);
	require 'notebook_model.php';
	require 'WSDLDocument/WSDLDocument.php';
	$wsdl = new WSDLDocument('Notebook', "http://localhost/web2/models/szerver.php", "http://localhost/web2/models/");
	$wsdl->formatOutput = true;
	$wsdlfile = $wsdl->saveXML();
	echo $wsdlfile;
	file_put_contents ("notebook.wsdl" , $wsdlfile);
?>
