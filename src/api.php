<?php  

require_once('include.php');
function getRFQs($get_params=null){
	global $db;


	$sql = "SELECT a.id, a.start_date, a.end_date, b.item, b.qty, c.type, d.location, f.first_name, f.last_name FROM goods_rfq a
			INNER JOIN goods_rfq_item b ON a.id = b.goods_rfq_id
			INNER JOIN delivery_type c ON a.delivery_type_id = c.id
			INNER JOIN delivery_location d ON a.delivery_location_id = d.id
			INNER JOIN buyer e on a.buyer_id = e.id
			INNER JOIN contact_info f on e.contact_info_id = f.id";

	$sql .=	 isset($get_params['items'])? " WHERE b.item " . (is_array($get_params['items'])? "in (". implode(',', $get_params['items']) .")": "='".$get_params['items']."'"):"";

	$sql .=  isset($get_params['location'])? " AND d.location ". ( is_array($get_params['location'])? "in (". implode(',', $get_params['location']) .")": "='".$get_params['location']."'"):"";

	$sql .=  isset($get_params['type'])? " AND c.type ". (is_array($get_params['type'])? "in (". implode(',', $get_params['type']) .")": "='".$get_params['type']."'"):"";

	$sql .= " AND a.end_date > DATE(NOW())";

	$sql .= " AND a.state  IN ('Open', 'Partially Filled')";

	$output = $db->get_results($sql);
	
	print_r(json_encode($output));
}

	getRFQs($_GET);
?>
