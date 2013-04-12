function fetchData($sql){
	 $ch = curl_init(); 

    // set url 
    curl_setopt($ch, CURLOPT_URL, "http://data.caribbeanopeninstitute.org/api/action/datastore_search_sql?sql="+$sql); 

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
    	$out = json_encode(array("failed"=>1))
    }
    return $out;
}

