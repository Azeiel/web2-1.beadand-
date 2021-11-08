
<h2> Híroldal</h2>
<h4>Ha bármilyen híre van kérem ossza megvelünk!</h4>
<div class="hiroldal">

<div class="hiroldal2">
<form method="post" name="hirek" >
<div class="sor"><input type="text" name="tema" placeholder="Téma" id="tema"></div>
<div class="sor"><textarea name="uzenet" placeholder="Üzenet"  rows="4" cols="50"></textarea></div>
<div class="sor"><input type=submit id="gomb" name="gomb" value="Küldés"></div>
</form>

 <h3>Hírek</h3>
 <?php
 foreach($viewData['uzenet'] as $uzenet){
	 
	 ?><div class="nevresz">
	 <div class="tartalom2">
	 <?php
	
 echo $uzenet."<br>";
 ?>
 </div>
 </div>
 
  </div>
 <?php

  }
 


 ?>
 <br>
 <br>
 <br>
 <br>
 <br>
 <h2> Kommentelés</h2>
 <div>
 <form name="hirid" method="post">
      <select name="hirid"  onchange="javascript:hirid.submit();">
        <option value="">Válasszon, mely hírhez szólna hozzá?</option>
        <?php
          foreach($viewData['hirid'] as $hirid)
          {

              echo '<option value="'.$hirid.'">'.$hirid.'</option>';

          }
        ?>
      </select>
</div>
<br>
<div class="tartalom"><input type="text" name="komment"><input type="submit"></div>
</form>
 

   
 