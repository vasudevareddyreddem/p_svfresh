
<?php 

foreach($p_list as $list){
	$plists[]=$list;
	$product_lists[] = $list['product_name'];
	
}
$imp = "'" . implode( "','", $product_lists) . "'";
echo '<pre>';print_r($imp);
exit;
foreach($plists as $lis){
	echo '<pre>';print_r($plists);
}

echo '<pre>';print_r($plists);
?>