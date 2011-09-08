<?php
session_start("autenticacao");
$_SESSION['autenticado'] = false;
$_SESSION['usuario'] = null;
$_SESSION['senha'] = null;
session_destroy();

?>
<script>
    alert("Logout efetuado com sucesso.");  
    location.href = '../../admin.php';
</script>
