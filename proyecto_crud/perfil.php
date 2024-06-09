<?php require_once "./config/validar_sesion.php";
    require_once "./assets/layout/header.php";    
    require_once "./assets/layout/nav.php";
?>

<main>
    <div class="container cont_profile" style="color: #ffffff;">
        <?php 
            include "./conex/conexLogin.php";

            $user = $_SESSION['user'];
            $sql = "SELECT id, correo, No_Telefono, Direccion, Edad, Fecha_Nacimiento, img FROM datospersonales WHERE usuario = '$user'";
            $result = mysqli_query($conex, $sql);

            while ($fila = mysqli_fetch_assoc($result)) :
        ?>
        <img src="./assets/img/<?php echo $fila['img']?>" onerror=this.src="./assets/img/user-icon.svg" width="150px" height="auto"> 
        <h1><?php echo $_SESSION['user']?></h1>
        <h3>Correo: <?php echo $fila['correo']?></h3>
        <h3>No. de telefono: <?php echo $fila['No_Telefono']?></h3>
        <h3>Direccion: <?php echo $fila['Direccion']?></h3>
        <h3>Edad: <?php echo $fila['Edad']?></h3>
        <h3>Fecha de nacimiento: <?php echo $fila['Fecha_Nacimiento']?></h3>
        <?php
            $_SESSION['id'] = $fila['id'];
            endwhile;
            mysqli_close($conex);
            include ("./config/ingresarDatosP.php");
        ?>
        <div class="cont-btn-modal">
            <label for="btn-modal" class="lbl-modal">
                <i class="uil uil-edit"></i>
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
                                <form action="" method="post" enctype="multipart/form-data">
                                <?php 
                                    include "./conex/conexLogin.php";

                                    $user = $_SESSION['user'];
                                    $sql = "SELECT correo, No_Telefono, Direccion, Edad, Fecha_Nacimiento, img FROM datospersonales WHERE usuario = '$user'";
                                    $result = mysqli_query($conex, $sql);

                                    while ($fila = mysqli_fetch_assoc($result)) :
                                ?>
                                <h2 align="center">Datos personales</h2>

                                <div class="contlbl">
                                    <label for="tel">
                                        <span>No. de telefono:</span>
                                        <input type="text" placeholder=" " id="tel" name="tel" value="<?php echo $fila['No_Telefono']?>">
                                    </label>
                                </div>
                                    
                                <div class="contlbl">
                                        <label for="Direccion">
                                            <span>Direccion:</span>
                                        <input type="text" placeholder=" " id="Direccion" name="Direccion" value="<?php echo $fila['Direccion']?>">
                                    </label>
                                </div>

                                <div class="contlbl">
                                    <label for="naci">
                                        <span></span>
                                        <input type="date" placeholder=" " id="naci" name="naci" value="<?php echo $fila['Fecha_Nacimiento']?>">
                                    </label>
                                </div>

                                <div class="contlbl">
                                    <label for="img"><input type="file" id="img" name="img" accept="image"></label>
                                </div>
                                
                                <input class="btnSubmit" type="submit" value="Enviar datos" name="regisDatos">
                                <?php 
                                    endwhile;

                                    $rutacompleta="./assets/img/";
                                    if (isset($_FILES['img']) && $_FILES['img']['size'] > 0) {
                                        $archivo 		= $_FILES['img']['tmp_name'];
                                        $nombrearchivo 	= $_FILES['img']['name'];
                                        $tipoarchivo 	= GetImageSize($archivo);
                                        // 1=>'GIF'
                                        // 2=>'JPEG'
                                        // 3=>'PNG'
                                        
                                        if (!move_uploaded_file($archivo, $rutacompleta.$nombrearchivo)) {
                                            echo "<script> alert('Error.\\nNo se ha podido cargar el archivo.');</script>"; 
                                        }
                                    }
                                    $fileimg = opendir($rutacompleta);

                                ?>
                            </form>
                        </div> 
                    </div>
                </div>
            <label for="btn-modal" class="cerrar-modal lbl-modal"></label>
        </div>
    </div>
    </div>
</main>

<script>
        const inputs = document.querySelectorAll('input');

        document.addEventListener("DOMContentLoaded", function() {
            console.log("cargado");
            inputs.forEach(input=> {
                if (input.value != "" && input.value != null) {
                    input.previousElementSibling.classList.add('top');
                    console.log("evento");
                }
            });
        });

        inputs.forEach(input=> {
            input.onfocus = ()=> {
                input.previousElementSibling.classList.add('top');
                input.previousElementSibling.classList.add('focus');
                input.parentNode.classList.add('focus');
            }

            input.onblur = ()=> {
                input.value = input.value.trim();
                if (input.value.trim().length == 0) {
                    input.previousElementSibling.classList.remove('top');
                }
                input.previousElementSibling.classList.remove('focus');
                input.parentNode.classList.remove('focus');
            }

        });
    </script>

<?php require_once "./assets/layout/footer.php";?>