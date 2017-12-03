<?php


    //BTC vs. USD
    echo "</br>BTC vs. USD</br>";
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
 
    $current_prices = array();
    
        echo "</br>CCAGG</br>";
        $url = 'https://min-api.cryptocompare.com/data/price?fsym=BTC&tsyms=USD';
        $content = file_get_contents($url);
        $json = json_decode($content);
        echo $json->USD."</br>";
            $current_prices[] = (float)$json->USD;
            
    $exchanges = array("Livecoin","BTC38", "BTCC", "BTCE", "BTER", "Bit2C", "Bitfinex", "Bitstamp", "Bittrex", "CCEDK", "Cexio", "Coinbase", "Coinfloor", "Coinse", "Coinsetter", "Cryptopia", "Cryptsy", "Gatecoin", "Gemini", "HitBTC", "Huobi", "itBit", "Kraken", "LakeBTC", "LocalBitcoins", "MonetaGo", "OKCoin", "Poloniex", "Yacuna", "Yunbi", "Yobit", "Korbit", "BitBay", "BTCMarkets", "QuadrigaCX", "CoinCheck", "BitSquare", "Vaultoro", "MercadoBitcoin", "Unocoin", "Bitso", "BTCXIndia", "Paymium", "TheRockTrading", "bitFlyer", "Quoine", "Luno", "EtherDelta", "Liqui", "bitFlyerFX", "BitMarket", "LiveCoin", "Coinone", "Tidex", "Bleutrade", "EthexIndia");
    $exchanges_to_add = array("GDAX","BTC-E","xBTCe","BTCC","USD X","Exmo","alcurEX","Fargobase","Lykke","gatehub","QuadrigaCX","BTCAlpha","CoinsBank","USD X","Exmo","alcurEX","DCExchange"); //ACTIVE ON COINMARKETCAP
    
    $size = sizeof($exchanges);
   // echo $size;
    
    for ($i=0;$i<$size;$i++){
        $exchange = $exchanges[$i];
        $url = 'https://min-api.cryptocompare.com/data/price?fsym=BTC&tsyms=USD&e='.$exchange;
        $content = file_get_contents($url);
        $json = json_decode($content);
        //echo "<pre>".$json."</pre>";
        if (isset($json->USD)){
            echo "</br>".$exchange."</br>";
            echo $json->USD."</br>";
            $current_prices[] = (float)$json->USD;
        }
    }
    print_r($current_prices);
    
    $array_sum = array_sum($current_prices);
    $array_count = count($current_prices);
    echo "</br>SUM</br>".$array_sum."</br>";
    echo "COUNT</br>".$array_count."</br>";
    $avg = (float)$array_sum / $array_count;
    echo "AVG</br>".$avg."</br>";
    
    $sum_sqrt = 0;
    settype($sum_sqrt,"float");
    
    for($i=0;$i<$array_count;$i++){
        $sum_sqrt = $sum_sqrt + pow($current_prices[$i]-$avg,2);
    }
    echo $sum_sqrt;
    $sum_sqrt_devide_by_population_size_minus_one = $sum_sqrt/($array_count-1);
    $stdev = 0;
    settype($stdev,"float");
    $stdev = sqrt($sum_sqrt_devide_by_population_size_minus_one);
    echo "</br>STDEV:</br>".$stdev;
    
    $count_ = count($current_prices);    
    for ($i=0;$i<$count_;$i++){
        if (($current_prices[$i] < $avg - $stdev)||($current_prices[$i] > $avg + $stdev)){
            unset($current_prices[$i]);
        } 
    }
    echo "</br>CLEAN PRICES ARRAY:</br>";
    print_r($current_prices);
    
    echo "</br></br>*************************************************************************************************************************</br></br>";

    
    $array_sum = array_sum($current_prices);
    $array_count = count($current_prices);
    echo "</br>SUM (CLEAN)</br>".$array_sum."</br>";
    echo "COUNT (CLEAN)</br>".$array_count."</br>";
    $avg = (float)$array_sum / $array_count;
    echo "AVG (CLEAN)</br>".$avg."</br>";
    
    
   
    $sum_sqrt = 0;
    settype($sum_sqrt,"float");
    
    $current_prices_new = array();
    foreach ($current_prices as $current_price){
       // echo "</br>Current Price in 1st foreach loop: ".$current_price;
        $sum_sqrt = $sum_sqrt + pow($current_price-$avg,2);
        $current_prices_new[] = $current_price;
    }

    echo $sum_sqrt;
    $sum_sqrt_devide_by_population_size_minus_one = $sum_sqrt/($array_count-1);
    $stdev = 0;
    settype($stdev,"float");
    $stdev = sqrt($sum_sqrt_devide_by_population_size_minus_one);
    echo "</br>STDEV (CLEAN):</br>".$stdev;
    
    $ucl = $avg + $stdev;
    $lcl = $avg - $stdev;
    
    echo "</br>UCL:</br>".$ucl."</br>LCL:</br>".$lcl;    
    
    
    //2ND ITERATION
    echo "current_prices_new:</br>";
    print_r($current_prices_new);
    echo "</br></br>";
    
    $count_ = count($current_prices_new);
    echo "</br>COUNT CURRENT PRICES NEW: " .count($current_prices_new);
    for ($i=0;$i<$count_;$i++){
        if (($current_prices_new[$i] < $avg - $stdev)||($current_prices_new[$i] > $avg + $stdev)){
            echo "</br>UNSET THIS: ".$current_prices_new[$i] ."</br>";
            unset($current_prices_new[$i]);
        } 
    }
    
    echo "</br>CLEAN PRICES ARRAY (2nd):</br>";
    print_r($current_prices_new);


    echo "</br></br>*************************************************************************************************************************</br></br>";

    
  //  $array_sum = array_sum($current_prices_new);
   // $array_count = count($current_prices_new);

  //  $avg = (float)$array_sum / $array_count;

   //     $sum_sqrt = 0;
  //  settype($sum_sqrt,"float");
    

    
  //  foreach ($current_prices_new as $current_price_new){
  //      $sum_sqrt = $sum_sqrt + pow($current_price_new-$avg,2);
   // }
   // echo $sum_sqrt;
   // $sum_sqrt_devide_by_population_size_minus_one = $sum_sqrt/($array_count-1);
   // $stdev = 0;
   // settype($stdev,"float");
   // $stdev = sqrt($sum_sqrt_devide_by_population_size_minus_one);
   // echo "</br>STDEV (CLEAN 2nd):</br>".$stdev;
    
  //  echo "</br>CLEAN PRICES ARRAY (CLEAN 2nd):</br>";
  //  print_r($current_prices_new);
    
   // $ucl = $avg + $stdev;
    //$lcl = $avg - $stdev;
    
    //echo "</br>UCL:</br>".$ucl."</br>LCL:</br>".$lcl;
    
    
       
    $array_sum = array_sum($current_prices_new);
    $array_count = count($current_prices_new);
    echo "</br>SUM (CLEAN)</br>".$array_sum."</br>";
    echo "COUNT (CLEAN)</br>".$array_count."</br>";
    $avg = (float)$array_sum / $array_count;
    echo "AVG (CLEAN)</br>".$avg."</br>";
    
    
   
    $sum_sqrt = 0;
    settype($sum_sqrt,"float");
    
    $current_prices_new_new = array();
    foreach ($current_prices_new as $current_price){
       // echo "</br>Current Price in 1st foreach loop: ".$current_price;
        $sum_sqrt = $sum_sqrt + pow($current_price-$avg,2);
        $current_prices_new_new[] = $current_price;
    }

    echo $sum_sqrt;
    $sum_sqrt_devide_by_population_size_minus_one = $sum_sqrt/($array_count-1);
    $stdev = 0;
    settype($stdev,"float");
    $stdev = sqrt($sum_sqrt_devide_by_population_size_minus_one);
    echo "</br>STDEV (CLEAN):</br>".$stdev;
    
    $ucl = $avg + $stdev;
    $lcl = $avg - $stdev;
    
    echo "</br>UCL:</br>".$ucl."</br>LCL:</br>".$lcl;    
    
    
    //2ND ITERATION
    echo "current_prices_new_new:</br>";
    print_r($current_prices_new_new);
    echo "</br></br>";
    
    $count_ = count($current_prices_new_new);
    echo "</br>COUNT CURRENT PRICES NEW_NEW: " .count($current_prices_new_new);
    for ($i=0;$i<$count_;$i++){
        if (($current_prices_new_new[$i] < $avg - $stdev)||($current_prices_new_new[$i] > $avg + $stdev)){
            echo "</br>UNSET THIS: ".$current_prices_new_new[$i] ."</br>";
            unset($current_prices_new_new[$i]);
        } 
    }
    
    echo "</br>CLEAN PRICES ARRAY (3rd):</br>";
    print_r($current_prices_new_new);

    echo "</br></br>*************************************************************************************************************************</br></br>";


    $array_sum = array_sum($current_prices_new_new);
    $array_count = count($current_prices_new_new);
    echo "</br>SUM (CLEAN CLEAN)</br>".$array_sum."</br>";
    echo "COUNT (CLEAN CLEAN)</br>".$array_count."</br>";
    $avg = (float)$array_sum / $array_count;
    echo "AVG (CLEAN CLEAN)</br>".$avg."</br>";    
    
    
    $sum_sqrt = 0;
    settype($sum_sqrt,"float");
    
    $current_prices_new_new_new = array();
    foreach ($current_prices_new_new as $current_price){
       // echo "</br>Current Price in 1st foreach loop: ".$current_price;
        $sum_sqrt = $sum_sqrt + pow($current_price-$avg,2);
        $current_prices_new_new_new[] = $current_price;
    }

    //echo $sum_sqrt;
    $sum_sqrt_devide_by_population_size_minus_one = $sum_sqrt/($array_count-1);
    $stdev = 0;
    settype($stdev,"float");
    $stdev = sqrt($sum_sqrt_devide_by_population_size_minus_one);
    echo "</br>STDEV (CLEAN CLEAN):</br>".$stdev;   
    
    
    $ucl = $avg + $stdev;
    $lcl = $avg - $stdev;
    
    echo "</br>UCL:</br>".$ucl."</br>LCL:</br>".$lcl;    
    
    
    //2ND ITERATION
    echo "current_prices_new_new_new:</br>";
    print_r($current_prices_new_new_new);
    echo "</br></br>";
    
    
    
 ?>