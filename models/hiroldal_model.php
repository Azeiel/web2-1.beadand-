<?php

class Hiroldal_Model
{
	
	public function lekeres($vars)
	{
		$retData['eredmeny'] = "";
		$retData['uzenet'] =array();
		$retData['uzi'] =array();
		$retData['komm'] =array();
		$retData['hirid'] = array();
	try
	{
		$connection = Database::getConnection();
		$sql = "SELECT hirek.id, csaladi_nev, utonev, tema, uzenet, datum FROM hirek INNER JOIN felhasznalok ON hirek.felhaszn_id=felhasznalok.id";
		$stmt = $connection->query($sql);
		$stmt -> execute();
		$hirek = $stmt->fetchAll(PDO::FETCH_ASSOC);
		
		if(count($hirek)==0) {
		$retData['eredmeny'] = "ERROR";
		$retData['uzenet'] = "Még nincs egy hír sem!";
		}
		else
		{
				$retData['eredmény'] = "OK";
				foreach($hirek as $hir)
				{
					$sql2 = "SELECT komment, date FROM kommentek INNER JOIN hirek ON hirek.id =kommentek.hir_id WHERE kommentek.hir_id =".$hir['id'];
				$stmt = $connection->query($sql2);
				$stmt -> execute();
				$kommi = $stmt->fetchAll(PDO::FETCH_ASSOC);
				array_push($retData['uzenet'], "<br><br>Üzenet ID: ".$hir['id']."<br>"."Név: ".$hir['csaladi_nev'].' '.$hir['utonev']."<br>"."Téma: ".$hir['tema']."<br>"."ÜZENET: <br>".$hir['uzenet']."<br>".$hir['datum']);
				array_push($retData['uzenet'], "<br> Kommentek:");
				foreach($kommi as $kom)
				{	
					if($kom != "")
					{
					array_push($retData['uzenet'],$kom['komment']);
					}
				}
				}
				$sql = "SELECT id FROM hirek";
				$stmt = $connection->query($sql);
				$stmt -> execute();
				$hir = $stmt->fetchAll(PDO::FETCH_ASSOC);
				foreach($hir as $hi)
				{
	
				
					array_push($retData['hirid'], $hi['id']);
				
				
				}	
			Menu::setMenu();
		}
		
		}


	catch (PDOException $e) {
				
					$retData['uzenet'] = "Adatbázis hiba: ".$e->getMessage()."!";
	}
	return $retData;
}

public function beuszras()
{
	try
	{
		$connection = Database::getConnection();
		$datum=date("Y-m-d");
		if(isset($_POST['tema']) && isset($_POST['uzenet']))
    {
	    $_POST['tema'] = trim($_POST['tema']);
        $_POST['uzenet'] = trim($_POST['uzenet']);

       if($_POST['tema'] != "" && $_POST['uzenet'] != "")
     {

        $sql = "insert into hirek values (0, '".$_SESSION['userid']."', '".$_POST['tema']."', '".$_POST['uzenet']."', '".$datum."')";
       $count = $connection->query($sql);
       $newid = $connection->lastInsertId();
	   header("Refresh:0");
      }
       elseif($_POST['tema'] == "" && $_POST['uzenet'] == "")
       {
        echo "Hiba: Nem adott meg semmit"; 
       }
       elseif($_POST['tema'] == "")
       {
        echo "Hiba: Nem adott meg témát"; 
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
}

public function velemeny()
{
	try
	{
		$connection = Database::getConnection();
		$date=date("Y-m-d");
		if(isset($_POST['komment']) && isset($_POST['hirid']))
	{
	    $_POST['komment'] = trim($_POST['komment']);
		$_POST['hirid'] = trim($_POST['hirid']);
		
		if($_POST['komment'] != "")
		{
			$sql = "insert into kommentek values (0, '".$_POST['hirid']."','".$_SESSION['userid']."', '".$_POST['komment']."', '".$date."')";
			$count = $connection->query($sql);
			$newid = $connection->lastInsertId();
			header("Refresh:0");
		}
		elseif($_POST['komment'] == "")
       {
        echo "Hiba: Nem adott meg semmit"; 
       }
	}	
	}
	catch (PDOException $e) 
	{
   echo "Hiba: ".$e->getMessage();
  }
	
}

}

?>