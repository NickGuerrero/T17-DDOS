<?php
// PHP Test Code from https://phoenixnap.com/kb/check-php-version
echo 'PHP version: ' . phpversion();
foreach (get_loaded_extensions() as $i => $ext)
{
   echo $ext .' => '. phpversion($ext). '<br/>';
}

$pdo = new PDO('mysql:dbname=' . $_ENV["DEV_DATABASE"] . ';host=mysql', $_ENV["DEV_USER"], $_ENV["DEV_PASSWORD"], [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
$query = $pdo->query('SHOW VARIABLES like "version"');
$row = $query->fetch();
echo 'MySQL version:' . $row['Value'];


?>
<p>This means the test server is working</p>