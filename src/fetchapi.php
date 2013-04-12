<?php



define ("FARM_DATA_PARISH", "ST.ANN");
define ("FARM_DATA_FARM_SIZE", "SMALL");
define ("FARM_DATA_FARMER_ID", "1877361");
define ("FARM_DATA_FARMER_FIRST_NAME", "EUNIS");
define ("FARM_DATA_FARMER_LAST_NAME", "DUNCAN");
define ("FARM_DATA_LATTITUDE", "-77.32685521");
define ("FARM_DATA_LONGITUDE", "18.402293170");




function fetchData($sql){

     $ch = curl_init(); 

    // set url 

    curl_setopt($ch, CURLOPT_URL, "http://data.caribbeanopeninstitute.org/api/action/datastore_search?sql=".$sql); 


    //return the transfer as a string 
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 

    $json = curl_exec($ch); 

    // close curl resource to free up system resources 
    curl_close($ch);      

    $output = json_decode($json, $true);

    if($output["success"] == true){
        $out = json_encode($output["records"]);
    }
    else {
    	$out = json_encode(array("failed"=>1));
    }
    echo $out;
}

function getFarms($parish = null, $size = null){
  
    $sql = "SELECT '". FARM_DATA_FARMER_ID ."','". FARM_DATA_FARMER_FIRST_NAME."','".FARM_DATA_FARMER_LAST_NAME."','".FARM_DATA_LATTITUDE."','".FARM_DATA_LONGITUDE."'  FROM \"57aba0a9-d958-4a2e-85c2-47a2e2c9e6be WHERE\"";

    $sql .= $parish != null? "\"".FARM_DATA_PARISH ."\""  .(is_array($parish)? "IN (".implode(',',$parish).")":"='".$parish."'"):"";

    $sql .= $size != null? "\"".FARM_DATA_FARM_SIZE ."\"" .(is_array($size)? "IN (".implode(',',$size).")":"='".$size."'"):"";

    return fetchData($sql);

}


function getAvgPrice($parish=null, $croptype=null){
    $sql = "SELECT 'Parish', 'CropType', 'FreqPrice', 'SupplyStatus', 'Quality', 'PriceMonth', 'Xcoord', 'YCoord' FROM '17c3539a-42c4-4e77-b7e5-7718764a049e' WHERE ";

    $sql .= $parish != null? "'Parish'" .(is_array($parish)? "IN (".implode(',',$parish).")":"='".$parish."'"):"";

    $sql .= $croptype != null? "'CropType'" .(is_array($croptype)? "IN (".implode(',',$croptype).")":"='".$croptype."'"):"";

    return fetchData($sql);

}


?>

