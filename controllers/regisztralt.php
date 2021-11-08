<?php

class Regisztralt_Controller
{
	
	
	public $baseName = 'regisztralt';  
	public function main(array $vars) 
	{
		$regisztralModel = new Regisztral_Model;
		$data = [
          'csaladi_nev' => trim($vars['csaladi_nev']),
          'utonev' => trim($vars['utonev']),
		  'bejelentkezes' => trim($vars['login_nev']),
		  'jelszo' => trim($vars['jelszo_reg']),         
		  'csaladi_nev_error' => "",
		  'utonev_error' => "",
		  'bejelentkezes_error' => "",
		  'jelszo_error' => "",
		  

        ];
		$nameValidation = "/^[\w\s]+$/u";;
		 $passwordValidation = "/^(.{0,7}|[^a-z]|[^\d]*)$/i";
		 if (empty($data['csaladi_nev'])) {
          $data['csaladi_nev_error'] = 'Adja meg a csaladi nevét';
        } elseif (!preg_match($nameValidation, $data['csaladi_nev'])) {
          $data['csaladi_nev_error'] = 'A családi név csak betűket tartalmazhat.';
        }
		if (empty($data['utonev'])) {
          $data['utonev_error'] = 'Adja meg az utónevét';
        } elseif (!preg_match($nameValidation, $data['utonev'])) {
          $data['utonev_error'] = 'Az utónév csak betűket tartalmazhat.';
        }
		/*if (empty($data['email'])) {
          $data['email_error'] = 'Adja meg az email címet';
        } elseif (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
          $data['email_error'] = 'Írja be a helyes formátumot';
        }
	
		else {
          if ($regisztralModel->letezoEmail($data['email'])) {
            $data['email_error'] = 'Ez az email cím már létezik';
		}}*/
		if (empty($data['jelszo'])) {
          $data['jelszo_error'] = 'Adja meg a jelszót';
        } 
		elseif (strlen($data['jelszo'])<5){
			$data['jelszo_error'] = 'A jelszónak minimum 5 karakter hosszúnak kell lennie.';
		}
		/*elseif (!preg_match($passwordValidation, $data['jelszo'])) {
          $data['jelszo_error'] = 'A jelszónak tartalmaznia kell legalább egy számot.';
        }*/
		if (empty($data['bejelentkezes'])) {
          $data['bejelentkezes_error'] = 'Adja meg a bejelentkezési nevet';
        } 
		
         else { if ($regisztralModel->letezoBejelentkezes($data['bejelentkezes'])) {
            $data['bejelentkezes_error'] = 'Létező felhasználónév';
	}}
		
		if (
          empty($data['csaladi_nev_error']) && 
          empty($data['utonev_error']) &&
		  empty($data['bejelentkezes_error']) &&
          empty($data['jelszo_error']) 
          
        ) {
			
		
			
			$retData = $regisztralModel->regisztral($data);
			if($retData['eredmeny'] == "ERROR")
				 $this->baseName = "regisztracio";
			 
			$view = new View_Loader($this->baseName.'_main');
			 
			foreach($retData as $name => $value)
				$view->assign($name, $value);
			
		}
		else{
			$regisztralModel = new Regisztral_Model;
			$this->baseName = "regisztracio";

			$view = new View_Loader($this->baseName.'_main');
			
			foreach($data as $name => $value)
				$view->assign($name, $value);
		}
          /*hash password
          $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
		*/
		

	}
}

?>