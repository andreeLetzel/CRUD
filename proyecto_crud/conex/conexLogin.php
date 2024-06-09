<?php
    $server = "localhost";
    $user = "user";
    $password = "password";
    $base = "DB";

    $conex = mysqli_connect($server, $user, $password, $base);

    if (!$conex) {
        die("Conexión fallida: ".mysqli_connect_error());
    } else {
        //echo "si conecto";
    }

    $conex->set_charset("utf8");
