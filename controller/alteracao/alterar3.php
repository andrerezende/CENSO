<?php
session_start();

// ****************************************************
// *** CLASSE NAO UTILIZADA
// *********************************************


$registroFromPOST = $_SESSION['registroFromPOST'];
$campoAlterado = $_SESSION['campoAlterado'];

require_once '../../model/Conexao.php';
require_once '../../controller/Seguranca.php';

//array_pop($registroFromPOST);   // removendo a declaraçao do array

//print_r($registroFromPOST);exit;

if($campoAlterado) {   
    
    //if($campoAlterado) {   
        
        $i = 0;
        // SEGURANÇA ANTI-INJECTION E ADD ASPAS PARA ENVIAR P/ BANCO
        foreach($registroFromPOST as $chave=>$valor) {
            $registroFromPOST[$chave] = ($valor) ? "'".Seguranca::anti_injection(($valor))."'" : "null";  
        }
        
        for($i=0; $i<count($campoAlterado); $i++) {
            $campoAlterado[$i]['campo_alterado'] = "'".$campoAlterado[$i]['campo_alterado']."'";
            $campoAlterado[$i]['valor_antigo'] = ($campoAlterado[$i]['valor_antigo']) ? "'".$campoAlterado[$i]['valor_antigo']."'" : "null";
        }
    //}
    
    
          // mandando pro banco
      if(Conexao::getInstance()->update($registroFromPOST, $campoAlterado)) {
          echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\" />
                 <script>alert(\"Registro alterado com sucesso!\");  
                   location.href = \"../../index.php\";      
                    </script>"; 
      } else {
          echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\" />
                 <script>alert(\"Houve um erro ao alterar o registro.\");  
                   location.href = \"../../index.php\";      
                    </script>"; 
      }
         
} else {
    echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\" />
                 <script>alert(\"Não acesse este arquivo diretamente!\");  
                   location.href = \"../../index.php\";      
                    </script>"; 
}

?>
