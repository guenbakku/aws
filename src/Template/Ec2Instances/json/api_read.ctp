<?php
use Cake\Utility\Hash;

$rows = [];
foreach ($instances as $item) {
    $newItem['name'] = Hash::get($item, 'Tags.Name');
    $newItem['public-ip-address'] = Hash::get($item, 'PublicIpAddress');
    $newItem['instance-type'] = Hash::get($item, 'InstanceType');
    $newItem['key-name'] = Hash::get($item, 'KeyName');
    $newItem['status'] = Hash::get($item, 'State.Name');
    $newItem['instance-id'] = Hash::get($item, 'InstanceId');
    
    $rows[] = $newItem;
}
echo json_encode([
    'rows' => $rows,
    'total' => count($rows),
]);
