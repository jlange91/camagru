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
}
catch(PDOException $e)
{
  die("Échec de la connection : {$e->getMessage()}");
}

$db->exec('CREATE TABLE IF NOT EXISTS Users (
    id        SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT,
    email     VARCHAR(255) NOT NULL,
    username  VARCHAR(40) NOT NULL,
    password  VARCHAR(255) NOT NULL,
    completed BOOLEAN NOT NULL DEFAULT 0,
    PRIMARY KEY (id)
)');

$db->exec('CREATE IF NOT EXISTS TABLE Images (
    id        SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT,
    date      DATETIME NOT NULL,
    path      VARCHAR(255) NOT NULL,
    PRIMARY KEY (id)
)');

$db->exec('CREATE IF NOT EXISTS TABLE Comments (
    id        SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT,
    date      DATETIME NOT NULL,
    comment   VARCHAR(255) NOT NULL,
    user_id   SMALLINT UNSIGNED NOT NULL,
    PRIMARY KEY (id)
)');

// $db->exec('CREATE IF NOT EXISTS TABLE Likes (
//     id        SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT,
//     image_id  SMALLINT UNSIGNED NOT NULL,
//     PRIMARY KEY (id)
// )');

?>
