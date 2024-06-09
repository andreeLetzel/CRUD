<?php
    if (!empty($_POST['regisAlum']) && isset($_POST['csrf_token']) && $_POST['csrf_token'] === $_SESSION['csrf_token']) {
        include_once ("./func/inyecSQL.php");
        include ("./conex/conexLogin.php");
        
        unset($_SESSION['csrf_token']);
        
        if (empty($_POST['nomAlum'])) {
            echo "<div class='alert alert-danger' style='height: 43px;' >No debe dejar campos en blanco</div>";
        } else {
            $name = inyecSQL($_POST['nomAlum']);

            switch (inyecSQL($_POST['anio'])) {
                case 1: $sem = date("m") < 6 ? 2 : 1; break;
                case 2: $sem = date("m") < 6 ? 4 : 3; break;
                case 3: $sem = date("m") < 6 ? 6 : 5; break;
            }

            $grupo = inyecSQL($_POST['grupo']);

            $turno = inyecSQL($_POST['turno']) === 1 ? FALSE : TRUE;

            switch (inyecSQL($_POST['espe'])) {
                case 1: $espe = "Programacion"; break;
                case 2: $espe = "Soporte"; break;
                case 3: $espe = "L.Clinicos"; break;
                case 4: $espe = "Mecanica"; break;
                case 5: $espe = "Logistica"; break;
            }

            if (!$conex) {
                die("Connection failed: ". mysqli_connect_error());
            }

            // Consulta para validar el usuario
            $sql = "INSERT INTO alumnos (alumno, semestre, grupo, turno, espe) VALUES ('$name', '$sem', '$grupo', '$turno', '$espe')";
            $result = mysqli_query($conex, $sql);

            // validar si la consulta dio un resultado
            if ($result) {
                echo "<div class='alert alert-success'>Registro con exito</div>";
            } else {
                echo "<div class='alert alert-danger'>Error al registrar al alumno</div>";
            }

            // Cerrar la conexion
            mysqli_close($conex);
        }
    }
