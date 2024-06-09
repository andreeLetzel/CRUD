<?php
    if (!empty($_POST['regisDatos'])) {
        include_once ("./func/inyecSQL.php");
        include ("./conex/conexLogin.php");
        
        $tel = empty($_POST['tel']) ? "" : inyecSQL($_POST['tel']);
        $Direccion = empty($_POST['Direccion']) ? "" : inyecSQL($_POST['Direccion']);
        $id = $_SESSION['id'];

        if (!empty($_POST['naci'])) {
            $naci = $_POST['naci'];
            $partes_fecha = explode('-', $naci);
            $img 	= $_FILES['img']['name'];

            $dia = $partes_fecha[2];
            $mes = $partes_fecha[1];
            $anio = $partes_fecha[0];

            $dia_act = date('d');
            $mes_act = date('m');
            $anio_act = date('Y');

            $edad = $anio_act - $anio;

            if($mes_act < $mes) {
                $edad--;
            } elseif ($mes_act == $mes) {
                if ($dia < $dia_act) {
                    $edad--;
                }
            }
        }
        
        //echo $naci . "/" . $dia . $mes . $anio . "/". $dia_act . $mes_act . $anio_act;

        if (!$conex) {
            die("Connection failed: ". mysqli_connect_error());
        }

        // Consulta para actualizar la tabla
        $sql = "UPDATE datospersonales SET No_Telefono = '$tel', Direccion = '$Direccion', Edad = '$edad', Fecha_Nacimiento = '$naci', img = '$img' WHERE id = '$id'";
        $result = mysqli_query($conex, $sql);

        // validar si la consulta dio un resultado
        if ($result) {
            echo "<div class='alert alert-success'>Registro con exito</div>";
        } else {
            echo "<div class='alert alert-danger'>Usuario o contraseña invalida</div>";
        }

        // Cerrar la conexion
        mysqli_close($conex);
    }
