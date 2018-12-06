<?php $value=4; ?>
<html>
  <body>
    <h1>Hello, <?= $value ?>!</h1>
    <?php
    $mysqli = mysqli_init();
    if (!$mysqli) {
        die('mysqli_init failed');
    }

    if (!$mysqli->options(MYSQLI_INIT_COMMAND, 'SET AUTOCOMMIT = 0')) {
        die('Setting MYSQLI_INIT_COMMAND failed');
    }

    if (!$mysqli->options(MYSQLI_OPT_CONNECT_TIMEOUT, 5)) {
        die('Setting MYSQLI_OPT_CONNECT_TIMEOUT failed');
    }

    if (!$mysqli->real_connect($_ENV['DOCKER_IP'] . ':3306', 'root', 'root')) {
        die('Connect Error (' . mysqli_connect_errno() . ') '
                . mysqli_connect_error());
    }

    echo 'lol Success... ' . $mysqli->host_info . "\n";

    $mysqli->close();
     ?>
     pupupute
  </body>
</html>
