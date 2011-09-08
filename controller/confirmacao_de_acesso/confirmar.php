<?php
session_start();

require_once '../../model/Conexao.php';

// Informar p/ banco que esta pessoa já acessou seus dados.

if($_SESSION['registroFromPOST']) {
    
    $id_pessoa = $_SESSION['registroFromPOST']['id_pessoa'];
    $data = date('d/m/Y');
    
    
    if(Conexao::getInstance()->bloquearPessoa($id_pessoa)) { ?>
        <script>
            alert('Acesso realizado em: <?php echo $data ?>');
            location.href = '../../index.php';
        </script>
        
      
   <?php } else {    ?>
        
        <script>
            alert('Erro ao confirmar acesso.');  
            location.href = voltar(1);      
        </script>";  
        
        <?php
    }
    
    // AO FINAL DO FLUXO, DESTRUA A SESSAO
    session_destroy();
    
} else { ?>
        
        <script>
            alert("Não acesse este arquivo diretamente!"); 
            location.href = '../../index.php';
        </script>
        
<?php }