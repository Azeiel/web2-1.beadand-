<?php

class Hiroldal_Controller
{
	public $baseName = 'hiroldal';  //meghatározni, hogy melyik oldalon vagyunk
	public function main(array $vars) // a router által továbbított paramétereket kapja
	{
		$hiroldalModel = new Hiroldal_Model;
		
		
		$view = new View_Loader($this->baseName."_main");
		$retData = $hiroldalModel->lekeres($vars);
		
		
		foreach($retData as $tema => $value)
		{
			$view->assign($tema, $value);
		}
		$hiroldalModel->beuszras();
		$hiroldalModel->velemeny();
		

		
	}
}

//$eredmeny = Array("id" => "", "nev" => "", "uzenet" => "", "datum" => "");
   

/*try {

$connection = Database::getConnection();
$dbh = new PDO('mysql:host=localhost;dbname=web2', 'root', '',
array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
$dbh->query('SET NAMES utf8 COLLATE utf8_hungarian_ci');
$datum=date("Y-m-d");


if(isset($_POST['nev']) && isset($_POST['uzenet']))
{
	
$_POST['nev'] = trim($_POST['nev']);
$_POST['uzenet'] = trim($_POST['uzenet']);

if($_POST['nev'] != "" && $_POST['uzenet'] != "")
{


$sql = "insert into hirek values (0, '".$_POST['nev']."', '".$_POST['uzenet']."', '".$datum."')";
$count = $dbh->exec($sql);
$newid = $dbh->lastInsertId();
}
elseif($_POST['nev'] == "" && $_POST['uzenet'] == "")
{
echo "Hiba: Nem meg semmit"; 
}
elseif($_POST['nev'] == "")
{
echo "Hiba: Nem adott meg felhasználónevet"; 
}
elseif($_POST['uzenet'] == "")
{
echo "Hiba: Nem adott meg tartalmat"; 
}
}

}
catch (PDOException $e) {
echo "Hiba: ".$e->getMessage();
}



?>*/