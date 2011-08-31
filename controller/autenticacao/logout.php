<?php
session_start("autenticacao");
$_SESSION['autenticado'] = false;
$_SESSION['usuario'] = null;
$_SESSION['senha'] = null;
session_destroy();

echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\" />
             <script>alert(\"Logout efetuado com sucesso.\");  
               location.href = \"../../index.php\";      
                </script>";



?>
