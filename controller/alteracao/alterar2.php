<?php
session_start();
$_SESSION['campoAlterado'] =& $campoAlterado;
$_SESSION['registroFromPOST'] =& $registroFromPOST;

$campoAlterado = null;

require_once '../../model/Conexao.php';
require_once '../../controller/Seguranca.php';


//ini_set('display_errors', 1);

//***************************
// DESCOBRIR CAMPOS ALTERADOS
//***************************

// é necessario pegar o registro antigo para verificar quais campos foram alterados
$registroFromBanco = $_SESSION['registroFromBanco'];

array_pop($_POST);   // removendo a declaracao
$registroFromPOST = $_POST;

if($registroFromBanco && $registroFromPOST) {
    
    
    $i = 0;
    foreach($registroFromPOST as $chave=>$valor) {
        //if(isset($registroFromBanco[$chave])) {
        
        // SEGURANÇA ANTI-INJECTION E ADD ASPAS PARA ENVIAR P/ BANCO
            
            if($chave != "nome_cidade") {   // se for nome_cidade nao use upper
                $registroFromPOST[$chave] = strtoupper($valor);  
            }                        
            
            // POPULA ARRAY DE CAMPOS ALTERADOS
            if($registroFromPOST[$chave] != $registroFromBanco[$chave]) {   // comparando o valor do post ja devidamente tratado com o valor do banco (ja é  tratado tbm na insercao)
                $campoAlterado[$i]['campo_alterado'] = $chave;
                $campoAlterado[$i]['valor_antigo'] = $registroFromBanco[$chave];
                $campoAlterado[$i]['data_alteracao'] = date('d/m/Y');
                $campoAlterado[$i]['checado'] = 0;
                $i++;
            } 
            //$registroFromPOST[$chave] = "'".$registroFromPOST[$chave]."'";  // colocando aspa para enviar p/ banco
        //}
    }
    
    
    
    
    
    
    
    
    if($campoAlterado) {
        
        $i = 0;
        // SEGURANÇA ANTI-INJECTION E ADD ASPAS PARA ENVIAR P/ BANCO
        foreach($registroFromPOST as $chave=>$valor) {
            $registroFromPOST[$chave] = ($valor) ? "'".Seguranca::anti_injection(($valor))."'" : "null";  
        }
        
        // ASPAS EM CAMPOALTERADO
        for($i=0; $i<count($campoAlterado); $i++) {
            $campoAlterado[$i]['campo_alterado'] = "'".$campoAlterado[$i]['campo_alterado']."'";
            $campoAlterado[$i]['valor_antigo'] = ($campoAlterado[$i]['valor_antigo']) ? "'".$campoAlterado[$i]['valor_antigo']."'" : "null";
            $campoAlterado[$i]['data_alteracao'] = "'".date('d/m/Y')."'";
            $campoAlterado[$i]['checado'] = 0;
        }
        
        
        if(Conexao::getInstance()->update($registroFromPOST, $campoAlterado)) {
            echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\" />
                 <script>alert(\"Obrigado por participar do nosso CENSO 2011, sua participação foi muito importante.\");         
                    </script>"; 
            
        } else {
            echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\" />
                 <script>alert(\"Houve um erro ao alterar o registro.\");        
                    </script>"; 
        }        
    }
    
    // CONFIRMANDO O ACESSO
    echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\" />
                 <script>
                   location.href = '../../controller/confirmacao_de_acesso/confirmar.php';         
                    </script>"; 
    
    

} else {
    
    echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\" />
                 <script>alert(\"Não é possível exibir a página solicitada!\");  
                   location.href = \"../../index.php\";      
                    </script>"; 
}
    
    
    
    
    ?>
    