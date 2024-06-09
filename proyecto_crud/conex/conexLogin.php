<?php
    $server = "localhost";
    $user = "id22199816_letzel";
    $password = "SushiUwu.5";
    $base = "id22199816_login";

    $conex = mysqli_connect($server, $user, $password, $base);

    if (!$conex) {
        die("Conexión fallida: ".mysqli_connect_error());
    } else {
        //echo "si conecto";
    }

    $conex->set_charset("utf8");