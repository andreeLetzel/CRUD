<?php require_once "./config/validar_sesion.php";
require_once "./assets/layout/header.php";
require_once "./assets/layout/nav.php";
?>

<?php
include "./conex/conexLogin.php";

$filasmax = 7;

if (isset($_GET['pag'])) {
    $pagina = $_GET['pag'];
} else {
    $pagina = 1;
}

/*if (isset($_GET['rein'])) {
    $val = $_GET['rein'];

    if ($val == '1' || $val == 1) { 
        echo "<script>window.location = 'alumnos.php?pag=".$pagina."'</script>";
    }
}*/

if (isset($_POST['buscar-alum'])) {
    $buscar = $_POST['buscar-alum'];
    $sqlcat = mysqli_query($conex, "SELECT * FROM alumnos where alumno = '" . $buscar . "'");
} else {
    $sqlcat = mysqli_query($conex, "SELECT * FROM alumnos ORDER BY id ASC LIMIT " . (($pagina - 1) * $filasmax)  . "," . $filasmax);
}

$resultadoMaximo = mysqli_query($conex, "SELECT count(*) as num_alumnos FROM alumnos");

$maxusutabla = mysqli_fetch_assoc($resultadoMaximo)['num_alumnos'];

?>
<div class="container">
    <div class="cont_alumnos">
        <div class="cont_profile">
            <div class="table_top">
                <form class="buscar" id="alum-form" action="" method="post">
                    <button type="button" class="btn btn-primary" onClick="window.location = 'alumnos.php'">inicio</button>
                    <div class="contlbl">
                        <label for="buscar-alum">
                            <span>Alumno:</span>
                            <input type="text" placeholder=" " id="buscar-alum" name="buscar-alum">
                        </label>
                    </div>
                    <input class="btn btn-dark" type="submit" value="Buscar" name="login">
                </form>

                <?php include ("./config/Alumnos/insertar.php"); ?>

                <div class="cont-btn-modal">
                    <label for="btn-modal" class="lbl-modal">
                        <i class="btn btn-outline-light">Registrar alumno</i>
                    </label>
                </div>
                <input type="checkbox" id="btn-modal">
                <div class="container-modal">
                    <div class="btn-cerrar">
                        <label for="btn-modal" class="lbl-modal">
                            <i class="uil uil-multiply"></i>
                        </label>
                    </div>
                    <!-- ************************* Contedido de la ventana modal ************************* -->
                    <div class="content-modal">
                        <div class="formCont">
                            <div class="cont">
                                <div>
                                    <form action="" method="post">
                                    <?php
                                        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
                                    ?>
                                    <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
                                        <div class="contlbl">
                                            <label for="nomAlum">
                                                <span>Nombre del alumno:</span>
                                                <input type="text" placeholder=" " id="nomAlum" name="nomAlum">
                                            </label>
                                        </div>

                                        <div class="contlbl">
                                            <label for="anio">
                                                <span class="top">Año:</span>
                                                <select id="anio" name="anio">
                                                    <option value="1">1°</option>
                                                    <option value="2">2°</option>
                                                    <option value="3">3°</option>
                                                </select>
                                            </label>
                                        </div>

                                        <div class="contlbl">
                                            <label for="grupo">
                                                <span class="top">Grupo:</span>
                                                <select id="grupo" name="grupo">
                                                    <option value="A">A</option>
                                                    <option value="B">B</option>
                                                </select>
                                            </label>
                                        </div>

                                        <div class="contlbl">
                                            <label for="turno">
                                                <span class="top">Turno:</span>
                                                <select id="turno" name="turno">
                                                    <option value="1">Matutino</option>
                                                    <option value="2">Vespertino</option>
                                                </select>
                                            </label>
                                        </div>

                                        <div class="contlbl">
                                            <label for="espe">
                                                <span class="top">Especialidad:</span>
                                                <select id="espe" name="espe">
                                                    <option value="1">Programacion</option>
                                                    <option value="2">Soporte</option>
                                                    <option value="3">Laboratorios Clinicos</option>
                                                    <option value="4">Mecanica</option>
                                                    <option value="5">Logistica</option>
                                                </select>
                                            </label>
                                        </div>
                                            <input class="btnSubmit" type="submit" value="Registrar alumno" name="regisAlum">
                                    </form>
                                </div>
                            </div>
                        </div>
                        <label for="btn-modal" class="cerrar-modal lbl-modal"></label>
                    </div>
                </div>
            </div>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">id</th>
                        <th scope="col">Alumno</th>
                        <th scope="col">Grupo</th>
                        <th scope="col">Accion</th>
                    </tr>
                </thead>
                <tbody>
                    <?php

                    while ($fila = mysqli_fetch_assoc($sqlcat)) :
                        echo "<tr>";
                        $turno = $fila['turno'] ? "M " : "V ";

                        $grupo = $fila['semestre'] . $fila['grupo']. $turno . "de " . $fila['espe'];
                    ?>
                        <td><?php echo $fila['id'] ?></td>
                        <td><?php echo $fila['alumno'] ?></td>
                        <td><?php echo $grupo ?></td>
                        
                    <?php
                        echo "<td>
                        <a class='btn btn-outline-success' href=\"./verAlum.php?id=$fila[id]&pag=$pagina&sem=$fila[semestre]&tipo=1\"><i class='uil uil-search'></i></a> 
                        <a class='btn btn-outline-primary' href=\"./verAlum.php?id=$fila[id]&pag=$pagina&tipo=2\"><i class='uil uil-pen'></i></a> 
                        <a class='btn btn-outline-dark' href=\"./verAlum.php?id=$fila[id]&pag=$pagina&sem=$fila[semestre]&tipo=4\"><i class='uil uil-clipboard-notes'></i></a>
                        <a class='btn btn-outline-danger' href=\"./verAlum.php?id=$fila[id]&pag=$pagina&tipo=3\" onClick=\"return confirm('¿Estás seguro de eliminar al alumno $fila[alumno]?')\"><i class='uil uil-times'></i></a>
                        </td>";
                        echo "</tr>";
                    endwhile;
                    ?>
                </tbody>
            </table>
            <div class="alert-link" style='text-align:right; margin: 0 1em; '>
				<br>
				<?php echo "Total de Alumnos: " . $maxusutabla; ?>
			</div>
            <?php
                if (isset($_GET['pag'])) {
                    if ($_GET['pag'] > 1) {
		    ?>
				<a class="btn btn-outline-info" href="alumnos.php?pag=<?php echo $_GET['pag'] - 1; ?>">Anterior</a>
				<?php
				} else {
				?>
					<a class="btn btn-outline-info" href="#" style="pointer-events: none">Anterior</a>
				<?php
				}
				?>

			<?php
			    } else {
			?>
				<a class="btn btn-outline-info" href="#" style="pointer-events: none">Anterior</a>
				<?php
			}

			if (isset($_GET['pag'])) {
				if ((($pagina) * $filasmax) < $maxusutabla) {
				?>
					<a class="btn btn-outline-info" href="alumnos.php?pag=<?php echo $_GET['pag'] + 1; ?>">Siguiente</a>
				<?php
				} else {
				?>
					<a class="btn btn-outline-info" href="#" style="pointer-events: none">Siguiente</a>
				<?php
				}
				?>
			<?php
			} else {
			?>
				<a class="btn btn-outline-info" href="alumnos.php?pag=2">Siguiente</a>
			<?php
			}
			?>
        </div>
    </div>
</div>

<script>
    const inputs = document.querySelectorAll('input');

    inputs.forEach(input => {
        input.onfocus = () => {
            input.previousElementSibling.classList.add('top');
            input.previousElementSibling.classList.add('focus');
            input.parentNode.classList.add('focus');
        }

        input.onblur = () => {
            input.value = input.value.trim();
            if (input.value.trim().length == 0) {
                input.previousElementSibling.classList.remove('top');
            }
            input.previousElementSibling.classList.remove('focus');
            input.parentNode.classList.remove('focus');
        }

    });
</script>

<?php require_once "./assets/layout/footer.php"; ?>