<?php
$nemvolt_datum = false;

?>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="<?php echo SITE_ROOT?>css/mnb.css">
</head>
<body class="mnb_bkg"></body>

<h2><br><?= (isset($viewData['uzenet']) ? $viewData['uzenet'] : "") ?><br></h2>


<form action="" method="post">
    <label class="select" for="deviza">Válassza ki az átváltandó devizát:</label><br><br>
    <input type="date" class="mnb" name="date" id="date" value="<?php echo date("Y-m-d"); ?>" required>
    <!--<input type="date" class="mnb" name="date" id="date" value="<?php echo "2021-10-29"; ?>" required>-->
        <input type="number" class="mnb" name="mennyi" id="mennyi" placeholder="Összeg" value="1" required>
    <select class="mnb" name="deviza" id="deviza" value="Válasszon...">
        <option value="USD">USD - Amerikai dollár</option>
        <option value="EUR">EUR - Euro</option>
        <option value="HUF">HUF - Magyar forint</option>
        <option value="GBP">GBP - Angol font</option>
        <option value="AUD">AUD - Ausztrál dollár</option>
        <option value="BGN">BGN - Bolgár leva</option>
        <option value="CAD">CAD - Kanadai dollár</option>
        <option value="CHF">CHF - Svájci frank</option>
        <option value="CNY">CNY - Kínai juan</option>
        <option value="CZK">CZK - Cseh korona</option>
        <option value="DKK">DKK - Dán korona</option>
        <option value="HRK">HRK - Horvát kuna</option>
        <option value="JPY">JPY - Japán yen</option>
    </select>

    <select class="mnb" name="deviza2" id="deviza2" value="Válasszon...">
        <option value="HUF">HUF - Magyar forint</option>
        <option value="CAD">CAD - Kanadai dollár</option>
        <option value="HUF">HUF - Magyar forint</option>
        <option value="EUR">EUR - Euro</option>
        <option value="USD">USD - Amerikai dollár</option>
        <option value="GBP">GBP - Angol font</option>
        <option value="AUD">AUD - Ausztrál dollár</option>
        <option value="BGN">BGN - Bolgár leva</option>
        <option value="CHF">CHF - Svájci frank</option>
        <option value="CNY">CNY - Kínai juan</option>
        <option value="CZK">CZK - Cseh korona</option>
        <option value="DKK">DKK - Dán korona</option>
        <option value="HRK">HRK - Horvát kuna</option>
        <option value="JPY">JPY - Japán yen</option>
    </select>



    <input class=mnb_btn type="submit" value="Váltás"><br><br>
</form>






<?php






if (isset($_POST["deviza"]) && ($_POST["deviza2"]) && ($_POST["date"]) && ($_POST["mennyi"])) {
    //echo "deviza, deviza2 átjött"."<br>";
    $deviza = $_POST["deviza"];
    $deviza2 = $_POST["deviza2"];
    $date = $_POST["date"];
    $mennyi = $_POST["mennyi"];
    $nenezd = "HUF";

    unset($currates);


    $client = new SoapClient("http://www.mnb.hu/arfolyamok.asmx?WSDL", array('trace' => true));
    $currrates = $client->GetExchangeRates(array('startDate' => $date, 'endDate' => $date, 'currencyNames' => "$deviza"))->GetExchangeRatesResult;



    $dom_root = new DOMDocument();
    $dom_root->loadXML($currrates);

    $searchNode = $dom_root->getElementsByTagName("Day");

    foreach ($searchNode as $searchNode) {

        $rates = $searchNode->getElementsByTagName("Rate");

        foreach ($rates as $rate) {
            $unit_1 = "\t" . $rate->getAttribute('unit') . " ";
            $deviza_ = $rate->getAttribute('curr');
            $dev_rate = $rate->nodeValue;
            $deviza_rate = str_replace("," , "." , $dev_rate);
            /*
            print $unit_1 . " unit_1 ";
            print $deviza_ . " deviza_ ";
            print "  =  ";
            print $deviza_rate . " deviza_rate ";
            print " HUF\n";
            print "<br>";
             */


        }
    }

    $currrates2 = $client->GetExchangeRates(array('startDate' => $date, 'endDate' => $date, 'currencyNames' => "$deviza2"))->GetExchangeRatesResult;

    $dom_root = new DOMDocument();
    $dom_root->loadXML($currrates2);

    $searchNode = $dom_root->getElementsByTagName("Day");

    foreach ($searchNode as $searchNode) {

        $rates = $searchNode->getElementsByTagName("Rate");

        foreach ($rates as $rate) {
            $unit_2 = "\t" . $rate->getAttribute('unit') . " ";
            $deviza_2 = $rate->getAttribute('curr');
            $dev_rate2 = $rate->nodeValue;
            $deviza_rate2 = str_replace("," , "." , $dev_rate2);
            /*
            print $unit_2 . " unit_2 ";
            print $deviza_2 . " deviza_2 ";
            print "  =  ";
            print $deviza_rate2 . " deviza_rate2 ";
            print " HUF\n";
            print "<br>";
            */

        }
    }



         //   echo '<script>alert("Válasszon Másik iőpontot.")</script>';

        if (isset($deviza_rate)) {
            if ($deviza == $nenezd and $deviza2 !== $nenezd) {   //HUH - Deviza
                $eredmeny = ($mennyi / $deviza_rate2) * $unit_2;
            }

            if ($deviza2 == $nenezd and $deviza !== $nenezd) {  //Deviza - HUF

                $eredmeny = ($deviza_rate * $mennyi) / $unit_1;
				
				
            }

            if ($deviza !== $nenezd and $deviza2 !== $nenezd) {   //Deviza - Deviza
                $eredmeny = ($deviza_rate2 * $unit_2) / ($deviza_rate * $unit_1) * $mennyi;
            }

            if ($deviza == $nenezd and $deviza2 == $nenezd) {   //HUF - HUF
                $eredmeny = $mennyi;
            }
        }else{
            $nemvolt_datum = true;

        }

}
if (isset($eredmeny)) {
    ?>
    <input class="mnb" value="<?php echo htmlspecialchars($mennyi); ?>" readonly>
    <input class="mnb" value="<?php echo htmlspecialchars($deviza); ?>" readonly>
    <input class="mnb" value="<?php echo htmlspecialchars(round($eredmeny, 2)); ?>" readonly>
    <input class="mnb" value="<?php echo htmlspecialchars($deviza2); ?>" readonly>
    <?php
}else{
    ?>
    <input class="mnb" value="" readonly>
    <input class="mnb" value="" readonly>
    <input class="mnb" value="" readonly>
    <input class="mnb" value="" readonly>
    <br><br>
    <?php

    if ($nemvolt_datum == true) {
        ?>
            <p class="select">Ezen a napon nem volt árfolyamváltozás!</p>
        <?php
    }else{
        ?>
            <p class="select"></p>
        <?php
    }
}



?>
