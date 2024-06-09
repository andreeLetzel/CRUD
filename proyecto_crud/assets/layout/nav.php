<nav>
        <div class="nav_container">
            <ul>
                <li class="list"><a class="nav-link" href="index.php">Inicio</a></li>
                <li class="list"><a class="nav-link" href="alumnos.php">Alumnos</a></li>
            </ul>
        </div>
        <div class="nav_cont">
            <?php 
                include "./conex/conexLogin.php";

                $user = $_SESSION['user'];
                $sql = "SELECT img FROM datospersonales WHERE usuario = '$user'";
                $result = mysqli_query($conex, $sql);
    
                while ($fila = mysqli_fetch_assoc($result)) :
            ?>
            <a href="./perfil.php"><img src="./assets/img/<?php echo $fila['img']?>" onerror=this.src="./assets/img/user-icon.svg" width="50px" height="auto"></a>
            <?php
                endwhile;
                mysqli_close($conex);
            ?>
        </div>
    </nav>