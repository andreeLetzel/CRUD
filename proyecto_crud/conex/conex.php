<?php
    $server = "localhost";
    $user = "root";
    $password = "";
    $base = "";

    $conn = mysqli_connect($server, $user, $password, $base);

    if (!$conn) {
        die("Conexión fallida: ".mysqli_connect_error());
    }

    $conn->set_charset("utf8");