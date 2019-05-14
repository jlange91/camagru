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

$db->exec('DROP TABLE IF EXISTS camagru.Users');

$db->exec('CREATE TABLE IF NOT EXISTS Users (
    guid              VARCHAR(255) NOT NULL,
    email             VARCHAR(255) NOT NULL,
    username          VARCHAR(40) NOT NULL,
    password          VARCHAR(512) NOT NULL,
    mailHash          VARCHAR(256) NOT NULL,
    sendMailDate      DATETIME NOT NULL,
    completed         BOOLEAN NOT NULL DEFAULT 0,
    PRIMARY KEY(username)
)');

$db->exec('DROP TABLE IF EXISTS camagru.Publications');

$db->exec('CREATE TABLE IF NOT EXISTS Publications (
    date      DATETIME NOT NULL,
    path      VARCHAR(255) NOT NULL,
    username  VARCHAR(40) NOT NULL,
    comment   VARCHAR(255) NOT NULL,
    uniqid    VARCHAR(255) NOT NULL,
    PRIMARY KEY(uniqid)
)');

$db->exec('DROP TABLE IF EXISTS camagru.Comments');

$db->exec('CREATE TABLE IF NOT EXISTS Comments (
    date            DATETIME NOT NULL,
    comment         VARCHAR(255) NOT NULL,
    username        VARCHAR(40) NOT NULL,
    publicationId   VARCHAR(255) NOT NULL,
    uniqid          VARCHAR(255) NOT NULL,
    PRIMARY KEY(uniqid)
)');

$db->exec('DROP TABLE IF EXISTS camagru.Likes');

$db->exec('CREATE TABLE IF NOT EXISTS Likes (
    publicationId   VARCHAR(255) NOT NULL,
    username        VARCHAR(40) NOT NULL,
    CONSTRAINT id PRIMARY KEY (publicationId,username)
)');

?>
