<?php

$host = $_ENV['DOCKER_IP'];
$dbname = 'camagru';
$dsn = "mysql:dbname={$dbname};host={$host}";
$usr = 'root';
$pwd = 'root';

try
{
  $db = new PDO($dsn, $usr, $pwd);
  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, FALSE);
}
catch(PDOException $e)
{
  die("Échec de la connection : {$e->getMessage()}");
}
