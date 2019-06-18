<?php
require 'database/DBClient.php';

echo 'starting<br>';
$db = new db();
$db->backup();
echo 'end';