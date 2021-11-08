<!DOCTYPE HTML>
<html>
  <head>
  <meta charset="utf-8">
  <title>Notebook</title>
  </head>

  <?php
     $options = array(
   
   'keep_alive' => false,
    //'trace' =>true,
    //'connection_timeout' => 5000,
    //'cache_wsdl' => WSDL_CACHE_NONE,
   );
  $client = new SoapClient('http://localhost/feladat/szerver/notebook.wsdl',$options);
  
  $oprendszer = $client->getoprendszer();
  echo "<pre>";
  print_r($oprendszer);
  echo "</pre>";
  
  $processzor = $client->getprocesszor();
  echo "<pre>";
  print_r($processzor);
  echo "</pre>";
  
  
  
  $modellek = $client->getgep('Linux','Athlon 64 X2 QL64');
  echo "<pre>";
  print_r($modellek);
  echo "</pre>";
  ?>
    
  <body>
  </body>
</html>