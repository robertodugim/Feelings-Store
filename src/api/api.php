<?php
require __DIR__ . '/../../vendor/autoload.php';

use API\Base\ManageAPI;

$api = new ManageAPI($_GET);
echo json_encode($api->GetResponse());
?>