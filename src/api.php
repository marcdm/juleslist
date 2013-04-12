<?php  

require_once('include.php');
function getRFQs($get_params=null){
	global $db;


	$sql = "SELECT a.id, a.start_date, a.end_date, b.item, b.qty, c.type, d.location, f.first_name, f.last_name FROM goods_rfq a
			INNER JOIN goods_rfq_item b ON a.id = b.goods_rfq_id
			INNER JOIN delivery_type c ON a.delivery_type_id = c.id
			INNER JOIN delivery_location d ON a.delivery_location_id = d.id
			INNER JOIN buyer e on a.buyer_id = e.id
			INNER JOIN contact_info f on e.contact_info_id = f.id WHERE";

	$sql .=	 isset($get_params['items'])? "  b.item " . (is_array($get_params['items'])? "in (". implode(',', $get_params['items']) .") AND": "='".$get_params['items']."' AND"):"";

	$sql .=  isset($get_params['location'])? "  d.location  ". ( is_array($get_params['location'])? "in (". implode(',', $get_params['location']) .") AND": "='".$get_params['location']."' AND"):"";

	$sql .=  isset($get_params['type'])? "  c.type ". (is_array($get_params['type'])? "in (". implode(',', $get_params['type']) .") AND": "='".$get_params['type']."' AND"):"";

	$sql .= "  a.end_date > DATE(NOW()) AND";

	$sql .= "  a.state  IN ('Open', 'Partially Filled')";

	$output = $db->get_results($sql);
	
	return (json_encode($output));
}



//For Farmers
function submitRFQResponse($post_params){
	global $db;
	$query = "INSERT INTO rfq_response ( ";//Start Query build, 
	foreach($post_params as $k => $v)
	{
		$query .= ", `$k`";//Add Field Names to Query
	}

	$query .= ") VALUES (";//Start Adding Values to Query, 
	foreach($post_params as $k => $v)
	{
		$query .= ", '$v'";//Add Values to Query
	}

	$query .= ")";
	return $db->get_query($sql);
}

function getRFQResponse($rfq_id){
	global $db;

	$sql = "SELECT a.rfq_id, a.item, a.qty, a.unit_price, b.rada_id, c.first_name, c.last_name FROM rfq_response a 
			INNER JOIN farmer b ON a.farmer_id = b.id
			INNER JOIN contact_info c ON b.contact_info_id = c.id
			WHERE rfq_id ".(is_array($get_params['type'])? "in (". implode(',', $get_params['type']) .")": "='".$get_params['type']."'");

	$output = $db->get_results($sql);

	return json_encode($output);

}

function submitRFQ($post_params){
	global $db;
	$query = "INSERT INTO  goods_rfq ( ";//Start Query build, 
	foreach($post_params as $k => $v)
	{
		$query .= ", `$k`";//Add Field Names to Query
	}

	$query .= ") VALUES (";//Start Adding Values to Query, 
	foreach($post_params as $k => $v)
	{
		$query .= ", '$v'";//Add Values to Query
	}

	$query .= ")";
	return $db->get_query($sql);
}

function submitGoodsForSale($post_params){
	global $db;
	$query = "INSERT INTO produce ( ";//Start Query build, 
	foreach($post_params as $k => $v)
	{
		$query .= ", `$k`";//Add Field Names to Query
	}

	$query .= ") VALUES (";//Start Adding Values to Query, 
	foreach($post_params as $k => $v)
	{
		$query .= ", '$v'";//Add Values to Query
	}

	$query .= ")";
	return $db->get_query($sql);
}

function getFarmerId($phonenum){
	global $db;

	$sql = "SELECT b.id FROM contact_info a
			INNER JOIN farmer b ON b.contact_info_id = a.id
			WHERE a.phone = '".$phonenum."'";

	return $db->get_row($sql).id;
}

function getDigest($limit){
	//get rfq_id, buyer_id, buyer name, item, qty, exp_date
	//Subquery this instead
	global $db;

	$sql = "SELECT a.id, a.buyer_id, c.first_name, c.last_name, d.item, d.qty, a.end_date FROM goods_rfq a
			INNER JOIN buyer b ON b.id = a.buyer_id
			INNER JOIN contact_info c ON b.contact_info_id = c.id
			INNER JOIN goods_rfq_item d ON d.rfq_id = a.id
			WHERE a.end_date > DATE(NOW()) ORDER BY a.end_date DESC LIMIT " . $limit;

	$output = $db->get_results($sql);

	return json_encode($output);
}

?>
