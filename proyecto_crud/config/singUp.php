<?php 
    if (!empty($_POST['singup'])) {
        include_once ("./func/inyecSQL.php");
        include ("./conex/conexLogin.php");
        
        if (empty($_POST['user1']) or empty($_POST['passSingUp']) or empty($_POST['email'])) {
            echo "<div class='alert alert-danger'>No debe dejar campos en blanco</div>";
        } else {
            $user = inyecSQL($_POST['user1']);
            $correo = inyecSQL($_POST['email']);
            $password = inyecSQL($_POST['passSingUp']);

            // Consulta para validar el usuario
            $sql1 = "SELECT * FROM usuarios WHERE usuario = '$user'";
            $sql2 = "SELECT * FROM usuarios WHERE correo = '$correo'";
            $result = mysqli_query($conex, $sql1);
            $resul = mysqli_query($conex, $sql2);

            if (mysqli_num_rows($result) > 0) {
                echo "<div class='alert alert-danger'>El nombre de usuario ya esta en uso</div>";
            } elseif (mysqli_num_rows($resul) > 0) {
                echo "<div class='alert alert-danger'>El correo ya esta en uso</div>";
            } else {
                $sql1 = "INSERT INTO usuarios (usuario, correo, PASSWORD ) VALUES ('$user', '$correo', '$password')";
                $sql2 = "INSERT INTO datosPersonales (usuario, correo) VALUES ('$user', '$correo')";
                $result = mysqli_query($conex, $sql1);
                $resul = mysqli_query($conex, $sql2);
    
                // validar si la consulta dio un resultado
                if ($result && $resul) {
                    echo "<div class='alert alert-success'>Registro con exito</div>";
                    mysqli_close($conex);
                } else {
                    echo "<div class='alert alert-danger'>Error al crear el usuario</div>";
                    mysqli_close($conex);
                }
            }
        }
    }