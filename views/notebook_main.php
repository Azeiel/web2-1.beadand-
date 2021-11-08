<!DOCTYPE HTML>
<html>
  <head>
  <meta charset="utf-8">
  <title>Notebook</title>
  </head>

  <?php 
  $client = new SoapClient('http://localhost/web2/models/notebook.wsdl');
  
  
  $oprendszerek = $client->getoprendszer();	  
  $processzorok = $client->getprocesszor();
  
  if(isset($_POST['oprendszer']) && trim($_POST['oprendszer']) != "" && isset($_POST['processzor']) && trim($_POST['processzor']) != "")

  $gepek = $client->getgep($_POST['oprendszer'],$_POST['processzor']);

  ?>
    
  <body>
    <h1>Notebook</h1>
    <form name="oprendszerselect" method="POST">
      <select name="oprendszer" onchange="javascript:oprendszerselect.submit();">
        <option value="">Válasszon operációs rendszert</option>
        <?php
          foreach($oprendszerek->oprendszerek as $oprendszer)
          {
            echo '<option value="'.$oprendszer['nev'].'">'.$oprendszer['nev'].'</option>';
          }
        ?>
      </select>
	  
	 
      <select name="processzor" onchange="javascript:processzorselect.submit();">
        <option value="">Válasszon processzort</option>
        <?php
          foreach($processzorok->processzorok as $processzor)
          {
            echo '<option value="'.$processzor['tipus'].'">'.$processzor['tipus'].'</option>';
          }
        ?>
      </select> 
	 
	  
        <?php
          if(isset($gepek))
          {
            echo "<fieldset>";
            echo '<legend>'.$gepek->nev.'('.$gepek->tipus.') modelljei:</legend>';
			
            foreach($gepek->gepek as $gep)
            {
              echo $gep['gyarto'].' - '.$gep['tipus'].' - '.$gep['kijelzo'].' - '.$gep['memoria'].' - '.$gep['merevlemez'].' - '.$gep['videovezerlo'].' - '.$gep['ar'].' - '.$gep['db']."<br>";
            }
            echo "</fieldset>";
          }
        ?>
    </form>
  </body>                                                          
</html>