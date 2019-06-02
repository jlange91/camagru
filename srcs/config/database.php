<?php

$host = $_ENV['DOCKER_IP'];
$DB_NAME = 'camagru';
$DB_DSN = "mysql:dbname={$DB_NAME};host={$host}";
$DB_USER = $_ENV['DB_USER'];
$DB_PASSWORD = $_ENV['DB_PASSWORD'];

try
{
  $db = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, FALSE);
}
catch(PDOException $e)
{
  die("Échec de la connection : {$e->getMessage()}");
}

?>
