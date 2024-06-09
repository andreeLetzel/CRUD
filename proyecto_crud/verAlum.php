<?php
include("./conex/conexLogin.php");
include("./alumnos.php");
$pagina = $_GET['pag'];
$id 	= $_GET['id'];
$tipo = $_GET['tipo'];

if (isset($_GET['sem'])){
switch($_GET['sem']) {
	case 1:	$sem = "primer"; break;
	case 2:	$sem = "sec"; break;
	case 3:	$sem = "ter"; break;
	case 4:	$sem = "cuar"; break;
	case 5:	$sem = "quin"; break;
	case 6:	$sem = "sext"; break;
}}
echo "<script>console.log($tipo)</script>";
?>
<?php

if ($tipo == 1) {

	$echo = "";

	if (isset($_GET['valor'])) {
		//$par = $_POST['par'];
		if ($_GET['valor'] == "a") {
			$par = "1";
		} elseif ($_GET['valor'] == "b") {
			$par = "2";
		} elseif ($_GET['valor'] == "c") {
			$par = "3";
		}

		echo "XD";
		$sql = "SELECT calif FROM calif WHERE id_alumn = '$id'";
		$result = mysqli_query($conex, $sql);

		if (mysqli_num_rows($result) > 0) {

			$asig = mysqli_query($conex, "SELECT $sem FROM asignaturas");

			while ($fila1 = mysqli_fetch_array($asig)) {
				$jsonData = json_decode($fila1["cuar"], true);
		
				$m1 = $jsonData['1'];
				$m2 = $jsonData['2'];
				$m3 = $jsonData['3'];
				$m4 = $jsonData['4'];
				$m5 = $jsonData['5'];
				$m6 = $jsonData['6'];
				$m7 = $jsonData['7'];
			}

			while ($fila = mysqli_fetch_assoc($result)) $jsonData = json_decode($fila["calif"], true);

				$echo = "<tr>
					<td>Parcial:</td>
					<td>".$par."</td>
				</tr>
				<tr>
					<td>".$m1.":</td>
					<td>".$jsonData[$par]['1']."</td>
				</tr>
				<tr>
					<td>".$m2.":</td>
					<td>".$jsonData[$par]['2']."</td>
				</tr>
				<tr>
					<td>".$m3.":</td>
					<td>".$jsonData[$par]['3']."</td>
				</tr>
				<tr>
					<td>".$m4.":</td>
					<td>".$jsonData[$par]['4']."</td>
				</tr>
				<tr>
					<td>".$m5.":</td>
					<td>".$jsonData[$par]['5']."</td>
				</tr>
				<tr>
					<td>".$m6.":</td>
					<td>".$jsonData[$par]['6']."</td>
				</tr>
				<tr>
					<td>".$m7.":</td>
					<td>".$jsonData[$par]['7']."</td>
				</tr>";
		}	
	}
	$querybuscar = mysqli_query($conex, "SELECT * FROM alumnos WHERE id = '$id'");

	while ($mostrar = mysqli_fetch_array($querybuscar)) {
		$alumnid	= $mostrar['id'];
		$alumnnom = $mostrar['alumno'];
		$sem = $mostrar['semestre'];
		$grupo = $mostrar['grupo'];
		$turno = $mostrar['turno'] ? "Matutino" : "Vespertino";
		$espe = $mostrar['espe'];
	}
	echo '<html>

	<body>
		<div class="caja_popup2">
			<form class="contenedor_popup" method="POST">
				<table>
					<tr>
						<th colspan="2">Ver Alumno</th>
					</tr>
					<tr>
						<td><b>Id:</b></td>
						<td> '.$alumnid.' </td>
					</tr>

					<tr>
						<td><b>Nombre: </b></td>
						<td> '.$alumnnom.' </td>
					</tr>

					<tr>
						<td><b>Semestre: </b></td>
						<td> '.$sem.' </td>
					</tr>

					<tr>
						<td><b>Grupo: </b></td>
						<td> '.$grupo.' </td>
					</tr>

					<tr>
						<td><b>Turno: </b></td>
						<td> '.$turno.' </td>
					</tr>

					<tr>
						<td><b>Especialidad: </b></td>
						<td> '.$espe.' </td>
					</tr>

					<hr><br><h2>Calificaciones</h2>

					<tr>
						<td colspan="2">
							<select onchange="parcial(this.options[this.selectedIndex].value)">
								<option value="">Selecciona un parcial</option>
								<option value="a">1</option>
								<option value="b">2</option>
								<option value="c">3</option>
							</select>
						</td>
					</tr>';

					if (isset($_GET['valor'])) {
						echo $echo;
					}

					echo '<td colspan="2">
							<a class="btn btn-outline-primary" href="./alumnos.php?pag='.$pagina.'">Regresar</a>
						</td>
					</tr>
				</table>
			</form>
		</div>

		<script>
			function parcial(valor){
				let url = "./verAlum.php?id='.$id.'&pag='.$pagina.'&sem='.$sem.'&tipo=1&valor="+valor;
				window.location.href = url;
			}
		</script>
	</body>

	</html>';
} elseif ($tipo == 2) {
	$querybuscar = mysqli_query($conex, "SELECT * FROM alumnos WHERE id = '$id'");

	while ($mostrar = mysqli_fetch_array($querybuscar)) {
		$alumnid    = $mostrar['id'];
		$alumnnom = $mostrar['alumno'];
	}

	echo '<html>

	<body>
		<div class="caja_popup2">
			<form class="contenedor_popup" method="POST">
				<table>
					<tr>
						<th colspan="2">Modificar alumno</th>
					</tr>
					<tr>
						<td>Nombre</td>
						<td><input class="CajaTexto" type="text" name="txtnombre" value=" '. $alumnnom .' " required></td>
					<tr>

					<tr>
						<td>Año</td>
						<td>
							<select id="anho" name="anho">
								<option value="1">1°</option>
								<option value="2">2°</option>
								<option value="3">3°</option>
							</select>
						</td>
					</tr>

					<tr>
						<td>Grupo</td>
						<td>
							<select id="group" name="group">
								<option value="A">A</option>
								<option value="B">B</option>
							</select>
						</td>
					</tr>

					<tr>
						<td>Turno</td>
						<td>
							<select id="turn" name="turn">
								<option value="1">Matutino</option>
								<option value="0">Vespertino</option>
							</select>
						</td>
					</tr>

					<tr>
						<td>Especialidad</td>
						<td>
							<select id="esp" name="esp">
								<option value="1">Programacion</option>
								<option value="2">Soporte</option>
								<option value="3">Laboratorios Clinicos</option>
								<option value="4">Mecanica</option>
								<option value="5">Logistica</option>
							</select>
						</td>
					</tr>

						<td colspan="2">
							<a class="btn btn-outline-primary" href="./alumnos.php?pag='.$pagina.'">Cancelar</a> &nbsp;
							<input class="btn btn-outline-primary" type="submit" name="btnmodificar" value="Modificar" onClick="javascript: return confirm("¿Deseas modificar a este alumno?");">
						</td>
					</tr>
				</table>
			</form>
		</div>
	</body>

	</html>';



	if (isset($_POST['btnmodificar'])) {
		$nombre     = $_POST['txtnombre'];

		switch ($_POST['anho']) {
			case 1: $sem = date("m") < 6 ? 2 : 1; break;
			case 2: $sem = date("m") < 6 ? 4 : 3; break;
			case 3: $sem = date("m") < 6 ? 6 : 5; break;
		}

		$grupo = $_POST['group'];

		$turno = $_POST['turn'];

		switch ($_POST['esp']) {
			case 1: $espe = "Programacion"; break;
			case 2: $espe = "Soporte"; break;
			case 3: $espe = "L.Clinicos"; break;
			case 4: $espe = "Mecanica"; break;
			case 5: $espe = "Logistica"; break;
		}

		$querymodificar = mysqli_query($conex, "UPDATE alumnos SET alumno='$nombre', semestre = '$sem', grupo = '$grupo', turno = '$turno', espe = '$espe' WHERE id = '$id'");
		if (!$querymodificar) {
			die ("error");
		}
		echo "<script>window.location= 'alumnos.php?pag=".$pagina."' </script>";
	}
}elseif ($tipo == 3) {
	$user = $_SESSION['user'];

	$id_reset = "ALTER TABLE alumnos DROP id";
	$id_res   = "ALTER TABLE alumnos ADD id INT PRIMARY KEY AUTO_INCREMENT FIRST;";

	mysqli_query($conex, "DELETE FROM alumnos WHERE id='$id'");

	if (!mysqli_query($conex, $id_reset)) {
		die('Error: ');
	}
		if (!mysqli_query($conex, $id_res)) {
		die ("Error");
	}
	echo "<script>window.location= 'alumnos.php?rein=1&pag=".$pagina."' </script>";
	//header("Location: alumnos.php?pag=".$pagina);

} else {

	$calif = mysqli_query($conex, "SELECT * FROM calif WHERE id_alumn = '$id'");
	$asig = mysqli_query($conex, "SELECT $sem FROM asignaturas");

	/*while ($fila = mysqli_fetch_array(mysqli_query($conex, "SELECT alumno FROM alumnos WHERE id = '$id'")))
		$nombre = $fila['alumno'];*/
	
	while ($fila = mysqli_fetch_array($asig)) {
		$jsonData = json_decode($fila[$sem], true);

		$m1 = $jsonData['1'];
		$m2 = $jsonData['2'];
		$m3 = $jsonData['3'];
		$m4 = $jsonData['4'];
		$m5 = $jsonData['5'];
		$m6 = $jsonData['6'];
		$m7 = $jsonData['7'];
	}

	echo '<html>

	<body>
		<div class="caja_popup2">
		<form class="contenedor_popup" method="POST">
		<table>
			<tr>
				<th colspan="2">calificaciones del alumno</th>
			</tr>
			<tr>
				<td>Parcial</td>
				<td>
					<select id="parcial" name="parcial">
						<option value="1">1</option>
						<option value="2">2</option>
						<option value="3">3</option>
					</select>
				</td>
			</tr>

			<tr>
				<td>'.$m1.'</td>
				<td><input class="CajaTexto" type="number" name="m1" value="" min="0" max="10" required></td>
			</tr>

			<tr>
				<td>'.$m2.'</td>
				<td><input class="CajaTexto" type="number" name="m2" value="" min="0" max="10" required></td>
			</tr>

			<tr>
				<td>'.$m3.'</td>
				<td><input class="CajaTexto" type="number" name="m3" value="" min="0" max="10" required></td>
			</tr>

			<tr>
				<td>'.$m4.'</td>
				<td><input class="CajaTexto" type="number" name="m4" value="" min="0" max="10" required></td>
			</tr>

			<tr>
				<td>'.$m5.'</td>
				<td><input class="CajaTexto" type="number" name="m5" value="" min="0" max="10" required></td>
			</tr>

			<tr>
				<td>'.$m6.'</td>
				<td><input class="CajaTexto" type="number" name="m6" value="" min="0" max="10" required></td>
			</tr>

			<tr>
				<td>'.$m7.'</td>
				<td><input class="CajaTexto" type="number" name="m7" value="" min="0" max="10" required></td>
			</tr>

				<td colspan="2">
					<a class="btn btn-outline-primary" href="./alumnos.php?pag='.$pagina.'">Cancelar</a> &nbsp;
					<input class="btn btn-outline-primary" type="submit" name="btncalif" value="Enviar Calificaciones">
				</td>
			</tr>
		</table>
	</form>
		</div>
	</body>

	</html>';

	if (isset($_POST['btncalif'])) {

		$par = $_POST['parcial'];
		$m1 = $_POST['m1'];
		$m2 = $_POST['m2'];
		$m3 = $_POST['m3'];
		$m4 = $_POST['m4'];
		$m5 = $_POST['m5'];
		$m6 = $_POST['m6'];
		$m7 = $_POST['m7'];

		if (mysqli_num_rows($calif) <= 0) {
			$data = array(
				"1" => null,
				"2" => null,
				"3" => null
			);
	
			$data[$par] = array (
				"1" => $m1,
				"2" => $m2,
				"3" => $m3,
				"4" => $m4,
				"5" => $m5,
				"6" => $m6,
				"7" => $m7
			);
	
			$json = json_encode($data);
			$sql = "INSERT INTO calif (id_alumn, calif, promedio) VALUES ('$id', '$json', '".($m1 + $m2 + $m3 + $m4 + $m5 + $m6 + $m7)/7 ."')";

			if (!mysqli_query($conex, $sql)) {
				die('Error: ');
			}
		} elseif (mysqli_num_rows($calif) > 0) {
			while ($fila = mysqli_fetch_array($calif)) 
				$jsonData = json_decode($fila["calif"], true);

				$nulls = 0;

				foreach ($jsonData as $valor) {
					if (is_null($valor)) {
						$nulls++;
					}
				}

				$data = array(
					"1" => "XD"
				);

			if ($nulls == 0) {
				echo '<script>alert("ya estan registrados los 3 parciales"); window.location = "alumnos.php?pag='.$pagina.'"</script>';
				exit();
			} elseif ($nulls == 1) {
				if (!empty($jsonData['1'])) {
					if (empty($jsonData['2'])) {
						if ($par == 2) {
							$data = array(
								"1" => $jsonData['1'],
								"2" => array(
									"1" => $m1,
									"2" => $m2,
									"3" => $m3,
									"4" => $m4,
									"5" => $m5,
									"6" => $m6,
									"7" => $m7
								),
								"3" => $jsonData['3']
							);
								echo '<script>console.log("caso 1");</script>';
							} else {
								echo '<script>alert("ya se ha registrado ese parcial"); window.location = "alumnos.php?pag='.$pagina.'"</script>';
								exit();
							}
					} elseif (empty($jsonData['3'])) {
						if ($par == 3) {
							$data = array(
								"1" => $jsonData['1'],
								"2" => $jsonData['2'],
								"3" => array(
									"1" => $m1,
									"2" => $m2,
									"3" => $m3,
									"4" => $m4,
									"5" => $m5,
									"6" => $m6,
									"7" => $m7
								)
							);
							echo '<script>console.log("caso 2");</script>';
						} else {
							echo '<script>alert("ya se ha registrado ese parcial"); window.location = "alumnos.php?pag='.$pagina.'"</script>';
							exit();
						}
					}
				} elseif (!empty($jsonData['2'])) {
					if (empty($jsonData['1'])) {
						if ($par == 1) {
							$data = array(
								"1" => array(
									"1" => $m1,
									"2" => $m2,
									"3" => $m3,
									"4" => $m4,
									"5" => $m5,
									"6" => $m6,
									"7" => $m7
								),
								"2" => $jsonData['2'],
								"3" => $jsonData['3']
							);
								echo '<script>console.log("caso 3");</script>';
							} else {
								echo '<script>alert("ya se ha registrado ese parcial"); window.location = "alumnos.php?pag='.$pagina.'"</script>';
								exit();
							}
					} elseif (empty($jsonData['3'])) {
						if ($par == 3) {
							$data = array(
								"1" => $jsonData['1'],
								"2" => $jsonData['2'],
								"3" => array(
									"1" => $m1,
									"2" => $m2,
									"3" => $m3,
									"4" => $m4,
									"5" => $m5,
									"6" => $m6,
									"7" => $m7
								)
							);
							echo '<script>console.log("caso 4");</script>';
						} else {
							echo '<script>alert("ya se ha registrado ese parcial"); window.location = "alumnos.php?pag='.$pagina.'"</script>';
							exit();
						}
					}
				} elseif (!empty($jsonData['3'])) {
					if (empty($jsonData['1'])) {
						if ($par == 1) {
							$data = array(
								"1" => array(
									"1" => $m1,
									"2" => $m2,
									"3" => $m3,
									"4" => $m4,
									"5" => $m5,
									"6" => $m6,
									"7" => $m7
								),
								"2" => $jsonData['2'],
								"3" => $jsonData['3']
							);
								echo '<script>console.log("caso 5");</script>';
							} else {
								echo '<script>alert("ya se ha registrado ese parcial"); window.location = "alumnos.php?pag='.$pagina.'"</script>';
								exit();
							}
					} elseif (empty($jsonData['2'])) {
						if ($par == 2) {
							$data = array(
								"1" => $jsonData['1'],
								"2" => array(
									"1" => $m1,
									"2" => $m2,
									"3" => $m3,
									"4" => $m4,
									"5" => $m5,
									"6" => $m6,
									"7" => $m7
								),
								"3" => $jsonData['3']
							);
							echo '<script>console.log("caso 6");</script>';
						} else {
							echo '<script>alert("ya se ha registrado ese parcial"); window.location = "alumnos.php?pag='.$pagina.'"</script>';
							exit();
						}
					}
				}
			} elseif ($nulls == 2) {
				if (!empty($jsonData['1'])) {
					if ($par == 2) {
						$data = array(
							"1" => $jsonData['1'],
							"2" => array(
								"1" => $m1,
								"2" => $m2,
								"3" => $m3,
								"4" => $m4,
								"5" => $m5,
								"6" => $m6,
								"7" => $m7
							),
							"3" => $jsonData['3']
						);
						echo '<script>console.log("caso 7");</script>';
					} elseif ($par == 3) {
						$data = array(
							"1" => $jsonData['1'],
							"2" => $jsonData['2'],
							"3" => array(
								"1" => $m1,
								"2" => $m2,
								"3" => $m3,
								"4" => $m4,
								"5" => $m5,
								"6" => $m6,
								"7" => $m7
							)
						);
						echo '<script>console.log("caso 8");</script>';
					} else {
						echo '<script>alert("ya se ha registrado ese parcial"); window.location = "alumnos.php?pag='.$pagina.'"</script>';
						exit();
					}
				} elseif (!empty($jsonData['2'])) {
					if ($par == 1) {
						$data = array(
							"1" => array(
								"1" => $m1,
								"2" => $m2,
								"3" => $m3,
								"4" => $m4,
								"5" => $m5,
								"6" => $m6,
								"7" => $m7
							),
							"2" => $jsonData['2'],
							"3" => $jsonData['3']
						);
						echo '<script>console.log("caso 9");</script>';
					} elseif ($par == 3) {
						$data = array(
							"1" => $jsonData['1'],
							"2" => $jsonData['2'],
							"3" => array(
								"1" => $m1,
								"2" => $m2,
								"3" => $m3,
								"4" => $m4,
								"5" => $m5,
								"6" => $m6,
								"7" => $m7
							)
						);
						echo '<script>console.log("caso 10");</script>';
					} else {
						echo '<script>alert("ya se ha registrado ese parcial"); window.location = "alumnos.php?pag='.$pagina.'"</script>';
						exit();
					}
				} else {
					if ($par == 1) {
						$data = array(
							"1" => array(
								"1" => $m1,
								"2" => $m2,
								"3" => $m3,
								"4" => $m4,
								"5" => $m5,
								"6" => $m6,
								"7" => $m7
							),
							"2" => $jsonData['2'],
							"3" => $jsonData['3']
						);
						echo '<script>console.log("caso 11");</script>';
					} elseif ($par == 2) {
						$data = array(
							"1" => $jsonData['1'],
							"2" => array(
								"1" => $m1,
								"2" => $m2,
								"3" => $m3,
								"4" => $m4,
								"5" => $m5,
								"6" => $m6,
								"7" => $m7
							),
							"3" => $jsonData['3']
						);
						echo '<script>console.log("caso 12");</script>';
					} else {
						echo '<script>alert("ya se ha registrado ese parcial"); window.location = "alumnos.php?pag='.$pagina.'"</script>';
						exit();
					}
				}
			}


			echo json_encode($data);

			$json = json_encode($data);

			$sql = "UPDATE calif SET calif = '$json' WHERE id_alumn = '$id'";
			$sql1 = "SELECT id_calif FROM calif WHERE id_alumn = '$id'";

			$resul = mysqli_query($conex, $sql1);

			while ($fila = mysqli_fetch_assoc($resul))
				$id_calif = $fila['id_calif'];

			$sql1 = "UPDATE alumnos SET id_calif = '$id_calif' WHERE id = '$id'";

			if (!mysqli_query($conex, $sql)) {
				die('Error: ');
			}
			if (!mysqli_query($conex, $sql1)) {
				die('Error en la actual');
			}

		}
		echo "<script>window.location= 'alumnos.php?pag=".$pagina."' </script>";
	} 
}
?>