<?php
session_start();

require_once '../../model/Conexao.php';

// Informar p/ banco que esta pessoa já acessou seus dados.

if($_SESSION['registroFromPOST']) {
    
    $id_pessoa = $_SESSION['registroFromPOST']['id_pessoa'];
    $data = date('d/m/Y');
    
    
    if(Conexao::getInstance()->bloquearPessoa($id_pessoa)) {
        echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\" />
            <script>alert('Acesso realizado em: $data');  
                   location.href = '../../index.php';      
                    </script>";  
    } else {
        echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\" />
            <script>alert('Erro ao confirmar acesso.');  
                   location.href = voltar(1);      
                    </script>";  
    }
    
    // AO FINAL DO FLUXO, DESTRUA A SESSAO
    session_destroy();
    
} else {
    
    echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\" />
                 <script>alert(\"Não acesse este arquivo diretamente!\");  
                   location.href = \"../../index.php\";      
                    </script>";    
    
}










/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
