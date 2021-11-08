<?php
class Notebook {
  
  /**
    *  @return Oprendszerek
    */
  public function getoprendszer(){
  
	$eredmeny = array("hibakod" => 0,
					  "uzenet" => "",
					  "nev"=>"",
					  "oprendszerek" => Array());
	
	try {
	  $dbh = new PDO('mysql:host=localhost;dbname=web2','root', '',
					array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
	  $dbh->query('SET NAMES utf8 COLLATE utf8_hungarian_ci');
  
	  $sql = "select nev from oprendszer order by nev desc";
	  $sth = $dbh->prepare($sql);
	  $sth->execute(array());
	  $eredmeny['oprendszerek'] = $sth->fetchAll(PDO::FETCH_ASSOC);
	}
	catch (PDOException $e) {
	  $eredmeny["hibakod"] = 1;
	  $eredmeny["uzenet"] = $e->getMessage();
	}
	
	return $eredmeny;
  }
  /**
    *  @return Processzorok
    */
  public function getprocesszor(){
  
	$eredmeny = array("hibakod" => 0,
					  "uzenet" => "",
					  "gyarto" =>"",
					  "tipus"=>"",
					  "processzorok" => Array());
	
	try {
	  $dbh = new PDO('mysql:host=localhost;dbname=web2','root', '',
					array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
	  $dbh->query('SET NAMES utf8 COLLATE utf8_hungarian_ci');
  
	  $sql = "select gyarto, tipus from processzor order by gyarto desc";
	  $sth = $dbh->prepare($sql);
	  $sth->execute(array());
	  $eredmeny['processzorok'] = $sth->fetchAll(PDO::FETCH_ASSOC);
	}
	catch (PDOException $e) {
	  $eredmeny["hibakod"] = 1;
	  $eredmeny["uzenet"] = $e->getMessage();
	}
	
	return $eredmeny;
  }
  
  
  
  
  

  /**
    *  @param string $nev
	*  @param string $tipus
    *  @return Gepek
    */
  function getgep($nev,$tipus){
  
	$eredmeny = array("hibakod" => 0,
					  "uzenet" => "",
					  "nev" => "",
					  "tipus" => "",
					  "gepek" => Array());
	
	try {
	  $dbh = new PDO('mysql:host=localhost;dbname=web2','root', '',
					array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
	  $dbh->query('SET NAMES utf8 COLLATE utf8_hungarian_ci');
  
	  $eredmeny["nev"] = $nev;
	  $eredmeny["tipus"] = $tipus;
	  
	  $sql = "select gep.gyarto,gep.tipus,kijelzo,memoria,merevlemez,videovezerlo,ar,db from gep 
	  inner join oprendszer on oprendszer.id=gep.oprendszerid 
	  inner join processzor on processzor.id =gep.processzorid where oprendszer.nev = :nev and processzor.tipus = :tipus";
	  $sth = $dbh->prepare($sql);
	  $sth->bindValue(":nev", $nev);
	  $sth->bindValue(":tipus", $tipus);
	  $sth->execute();
	  $eredmeny['gepek'] = $sth->fetchAll(PDO::FETCH_ASSOC);
	  
  
	}
	catch (PDOException $e) {
	  $eredmeny["hibakod"] = 1;
	  $eredmeny["uzenet"] = $e->getMessage();
	}
	
	return $eredmeny;
  }
}


class Oprendszer {
  /**
   * @var string
   */
  public $nev;

 
}

class Oprendszerek {
  
 /**
   * @var integer
   */
  public $hibakod;

  /**
   * @var string
   */
  public $uzenet;  

  /**
   * @var Oprendszer[]
   */
  public $oprendszerek;  
}


class Processzor{
	/**
   * @var string
   */
	
	public $gyarto;
	
	/**
   * @var string
   */
	
	public $tipus;
	
}

class Processzorok {
	
  /**
   * @var integer
   */
  public $hibakod;

  /**
   * @var string
   */
  public $uzenet;  
  /**
   * @var Processzor[]
   */
  public $processzorok;
	
}

class Gep {
  /**
   * @var string
   */
  public $gyarto;

  /**
   * @var string
   */
  public $tipus;  
  
   /**
   * @var integer
   */
    public $kijelzo; 
   /**
   * @var integer
   */
    public $memoria; 
   /**
   * @var integer
   */
    public $merevlemez; 
  /**
   * @var string
   */
  public $videovezerlo; 
  /**
   * @var integer
   */
    public $ar; 
  /**
   * @var integer
   */
    public $db; 
  
  
  
}

class Gepek {
  /**
   * @var integer
   */
  public $hibakod;

  /**
   * @var string
   */
  public $uzenet;  

  /**
   * @var string
   */
  public $tipus;

  /**
   * @var string
   */
  public $nev;  

  /**
   * @var Gep[]
   */
  public $gepek;  
}
?>