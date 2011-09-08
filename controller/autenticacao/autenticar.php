<?php
session_start("autenticacao");
$_SESSION['autenticado'] = false;
$_SESSION['usuario'] = null;
$_SESSION['senha'] = null;

require_once '../Seguranca.php';
require_once '../../model/Conexao.php';

$usuario = Seguranca::anti_injection($_POST['usuario']);
$senha = Seguranca::anti_injection($_POST['senha']);

if($usuario && $senha) {
    
    if(Conexao::getInstance()->autentica($usuario, $senha)) {
        
        $_SESSION['autenticado'] = true;
        $_SESSION['usuario'] = $usuario;
        $_SESSION['senha'] = $senha;
        
        header("Location: ../../view/html/frmAutenticado.php"); 
        
    } else {    ?>
         <script>
                alert("Dados incorretos. Verifique o seu login e senha e tente novamente.");
                location.href = '../../view/html/frmAdmin.php';
        </script>
                 
<?php }

} else {    // ou ele mandou o user e o pass em branco ou ele tentou acessar esta classe diretamente pelo browser. ?>
    <script>
        alert("Dados inválidos.");    
        location.href = "../../view/html/frmAdmin.php";
    </script>

<?php   }