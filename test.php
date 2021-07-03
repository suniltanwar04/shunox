<?php 

$data[] = ['type' => 'shipping', "val" => 'shipping'];
$data[] = ['type' => 'billing', "val" => 'billing'];

foreach($data as $k => $v) {
	if($v['type'] == 'billing') {
		$data[0]['val'] = $v['val'];
	} else if($v['type'] == 'shipping') {
		$data[1]['val'] = $v['val'];
	}
}

echo "<pre>";
print_r($data);

?>
