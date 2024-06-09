<?php
    if (!empty($_POST['login'])) {
        include_once ("./func/inyecSQL.php");
        include ("./conex/conexLogin.php");
        
        if (empty($_POST['user']) and empty($_POST['password'])) {
            echo "<div class='alert alert-danger' >Debe ingresar usuario y contraseña.</div>";
        } else {
            $user = inyecSQL($_POST['user']);
            $password = inyecSQL($_POST['password']);

            if (!$conex) {
                die("Connection failed: ". mysqli_connect_error());
            }

            // Consulta para validar el usuario
            $sql = "SELECT * FROM usuarios WHERE usuario = '$user' AND PASSWORD = '$password'";
            $result = mysqli_query($conex, $sql);

            // validar si la consulta dio un resultado
            if (mysqli_num_rows($result) > 0) {
                //session_start();
                $_SESSION['user'] = $user;
                echo "<script>window.location = 'index.php'</script>";
            } else {
                echo "<div class='alert alert-danger'>Usuario o contraseña invalida</div>";
            }

            // Cerrar la conexion
            mysqli_close($conex);
        }
    }
?>