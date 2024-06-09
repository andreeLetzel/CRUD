<?php

function inyecSQL($valor) {
            $valor = trim($valor);
            $valor = stripslashes($valor);
            $valor = stripcslashes($valor);
            $valor = str_ireplace("<script>","", $valor);
            $valor = str_ireplace("</script>","", $valor);
            $valor = str_ireplace("<script type=","", $valor);
            $valor = str_ireplace("DELETE FROM","", $valor);
            $valor = str_ireplace("SELECT * FROM","", $valor);
            $valor = str_ireplace("INSERT INTO","", $valor);
            $valor = str_ireplace("DROP TABLE","", $valor);
            $valor = str_ireplace("DROP DATABASE","", $valor);
            $valor = str_ireplace("TRUNCATE TABLE","", $valor);
            $valor = str_ireplace("SHOW TABLES","", $valor);
            $valor = str_ireplace("SHOW DATABASES","", $valor);
            $valor = str_ireplace("<?php","", $valor);
            $valor = str_ireplace("?>","", $valor);
            $valor = str_ireplace("--","", $valor);
            $valor = str_ireplace("<","", $valor);
            $valor = str_ireplace(">","", $valor);
            $valor = str_ireplace("^","", $valor);
            $valor = str_ireplace("[","", $valor);
            $valor = str_ireplace("]","", $valor);
            $valor = str_ireplace("==","", $valor);
            $valor = str_ireplace(";","XD", $valor);
            $valor = str_ireplace("::","", $valor);
            $valor = str_ireplace("$","", $valor);
            $valor = str_ireplace("'","", $valor);
            $valor = trim($valor);
            $valor = stripslashes($valor);
            $valor = stripcslashes($valor);

            return $valor;
        }