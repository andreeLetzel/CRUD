<?php require_once "./config/validar_sesion.php";
    require_once "./assets/layout/header.php";
    require_once "./assets/layout/nav.php";
?>

<main>
    <div class="container">
        <h1 class="bienve">Bienvenido <?php echo $_SESSION['user']?>, haz click <a href="./config/logut.php">aqui</a> para cerrar sesion</h1>
    </div>
</main>

<?php require_once "./assets/layout/footer.php" ?>