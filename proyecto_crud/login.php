<?php require_once "./assets/layout/header.php";?>

    <div class="formCont">
        <div class="cont">
            <div class="login">
                <form id="loginForm" action="" method="post">
                    <h2 align="center">Login</h2>

                    <?php
                        include ("./config/check_login.php");
                    ?>

                    <div class="contlbl">
                        <label for="user">
                            <span>Usuario:</span>
                            <input type="text" placeholder=" " id="user" name="user">
                        </label>
                    </div>
                    
                    <div class="contlbl">
                        <label for="passLogin">
                            <span>Contraseña:</span>
                            <input type="password" placeholder=" " id="passLogin" name="password">
                        </label>
                        <input type="checkbox" onclick="verpassword(true)"> <span class="mosPasstxt">Mostrar contraseña</span>
                    </div>
                    
                    <input class="btnSubmit" type="submit" value="Enviar datos" name="login">
                </form>
                <button class="btn btn-light" onClick="btnLogin(true)">Sing up</button>
            </div> 

            <!----------------- Registrar --------------->

            <div class="singup">
                <button class="btn btn-light" onClick="btnLogin(false)">Log in</button>
                <form id="singupForm" action="" method="post">
                    <h2 align="center">Sing up</h2>

                    <?php
                        include ("./config/singUp.php");
                    ?>

                    <div class="contlbl">
                        <label for="user1">
                            <span>Usuario:</span>
                            <input type="text" placeholder=" " id="user1" name="user1">
                        </label>
                    </div>

                    <div class="contlbl">
                        <label for="email">
                            <span>Correo:</span>
                            <input type="email" placeholder=" " name="email" id="email" spellcheck="false">
                        </label>
                        <i class="uil uil-envelope email-icon"></i>
                    </div>
                    
                    <div class="contlbl">
                        <label for="passSingUp">
                            <span>Contraseña:</span>
                            <input type="password" placeholder=" " id="passSingUp" name="passSingUp">
                        </label>
                        <input type="checkbox" onclick="verpassword(false)"> <span class="mosPasstxt">Mostrar contraseña</span>
                    </div>
                    
                    <input class="btnSubmit" type="submit" id="enviar" value="Enviar datos" name="singup">
                </form>
            </div>
        </div>
    </div>

    <script>
        const emailInput = document.querySelector("#email"), emailIcon = document.querySelector(".email-icon"), submit = document.getElementById("enviar");

        emailInput.addEventListener("keyup", () => {
            if (emailInput.value === "") {
                emailIcon.classList.replace("uil-check-circle", "uil-envelope");
                return emailIcon.style.color = "#b4b4b4";
            }
            if (correo(emailInput.value)) {
                emailIcon.classList.replace("uil-envelope", "uil-check-circle");
                submit.name = "singup";
                return emailIcon.style.color = "#4bb543";
            }
            emailIcon.classList.replace("uil-check-circle", "uil-envelope");
            emailIcon.style.color = "#de0611";
            submit.name = "";
        })
    </script>

    <script>
        const inputs = document.querySelectorAll('input');

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

<script src="./assets/js/scripts.js" type="text/javascript"></script>

<?php #require_once "./assets/layout/footer.php";?>