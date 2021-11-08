<h2>Regisztráció</h2> 
<form action="<?= SITE_ROOT ?>regisztralt" method="post">
      <label for="csaladi_nev">Családi név:</label> <input type = "text" name="csaladi_nev" id = "csaladi_nev" value= "<?= (isset($viewData['csaladi_nev']) ? $viewData['csaladi_nev'] : "") ?>" class= <?= (isset($viewData['csaladi_nev_error']) && $viewData['csaladi_nev_error'] !=='' ? "input-error" : "") ?>><br>
      <label for="utonev">Utónév:</label> <input type = "text" name="utonev" id = "utonev" value= "<?= (isset($viewData['utonev']) ? $viewData['utonev'] : "") ?>" class= <?= (isset($viewData['utonev_error']) && $viewData['utonev_error'] !=='' ? "input-error" : "") ?>><br>
	  <label for="login_nev">Login:</label> <input type = "text" name="login_nev" id = "login_nev" value= "<?= (isset($viewData['bejelentkezes']) ? $viewData['bejelentkezes'] : "") ?>" class= <?= (isset($viewData['bejelentkezes_error']) && $viewData['bejelentkezes_error'] !=='' ? "input-error" : "") ?>><br>
      <label for="jelszo_reg">Jelszó:</label> <input type = "password" name="jelszo_reg" id = "jelszo_reg" value= "<?= (isset($viewData['jelszo']) ? $viewData['jelszo'] : "") ?>" class= <?= (isset($viewData['jelszo_error']) && $viewData['jelszo_error'] !=='' ? "input-error" : "") ?>><br> 
      <input type="submit" name="regisztracio" value="Regisztráció"><br>
</form>
<?php 
      echo "<div>";
	  
	  
	  foreach ($viewData as $key=>$value){
		  if(isset($value)){
			  if($key=='csaladi_nev_error' && $value!==""){
				echo '<h2 class="validation-error"><br>'.$value  .'<br></h2>';

			  }
			  if($key=='utonev_error' && $value!==""){
				echo '<h2 class="validation-error"><br>'.$value  .'<br></h2>';

			  }
			  if($key=='bejelentkezes_error' && $value!==""){
				echo '<h2 class="validation-error"><br>'.$value  .'<br></h2>';

			  }
			  /*if($key=='email_error' && $value!==""){
				echo '<h2 class="validation-error"><br>'.$value  .'<br></h2>';

			  }*/
			  if($key=='jelszo_error' && $value!==""){
				echo '<h2 class="validation-error"><br>'.$value  .'<br></h2>';

			  }
			  if($key=='uzenet' && $value!==""){
				echo '<h2 class="validation-error"><br>'.$value  .'<br></h2>';
			  }
		  }
		  
		  
	  }
	  echo "</div>";
	  ?>
	    
		