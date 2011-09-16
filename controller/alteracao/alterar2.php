<?php
session_start();
// iniciando variaveis de sessao
$_SESSION['campoAlterado'] =& $campoAlterado;
$_SESSION['registroFromPOST'] =& $_POST;

$campoAlterado = null;

require_once '../../model/Conexao.php';
require_once '../../controller/Seguranca.php';

//ini_set('display_errors', 1);

//***************************
// DESCOBRIR CAMPOS ALTERADOS
//***************************

// é necessario pegar o registro antigo para verificar quais campos foram alterados
$registroFromBanco = $_SESSION['registroFromBanco'];

// email + dominio
$_POST['email'] .= $_POST['email_dominio'];

unset($_POST['email_dominio']);
unset($_POST['declaracao']);

//print_r($_POST);exit;

$registroFromPOST = $_POST;

if($registroFromBanco && $registroFromPOST) {
    
    //print_r($_SESSION);exit;
    
    $i = 0;
    foreach($registroFromPOST as $chave=>$valor) {
        
        // SEGURANÇA ANTI-INJECTION E ADD ASPAS PARA ENVIAR P/ BANCO
            
            if($chave != "nome_cidade") {   // se for nome_cidade nao use upper
                $registroFromPOST[$chave] = strtoupper($valor);  
            }  
            
            if($chave == "necessidade_especial_outra") {
                $registroFromPOST["necessidade_especial"] = $registroFromPOST["necessidade_especial_outra"];
            }
            
            // POPULA ARRAY DE CAMPOS ALTERADOS E POE ASPAS
            
            if(array_key_exists($chave, $registroFromBanco)) { // certificando-se de que esta coluna existe no banco
                
                if($registroFromPOST[$chave] != $registroFromBanco[$chave]) {   // comparando o valor do post ja devidamente tratado com o valor do banco (ja é  tratado tbm na insercao)
                    
                    $campoAlterado[$i]['campo_alterado'] = "'$chave'";
                    $campoAlterado[$i]['valor_antigo'] = ($registroFromBanco[$chave]) ? "'$registroFromBanco[$chave]'" : "null";
                    $campoAlterado[$i]['data_alteracao'] = "'".date('d/m/Y')."'";
                    $campoAlterado[$i]['checado'] = 0;
                    $i++;
                } 
                
            } 
    }
    
    if($campoAlterado) {
        
        $i = 0;
        // SEGURANÇA ANTI-INJECTION E ADD ASPAS PARA ENVIAR P/ BANCO
        foreach($registroFromPOST as $chave=>$valor) {
            if($chave != "id_pessoa") {
                $registroFromPOST[$chave] = ($valor) ? "'".Seguranca::anti_injection(($valor))."'" : "null";  
            }
        }
        
        
        if(Conexao::getInstance()->update($registroFromPOST, $campoAlterado)) { ?>
            
            <script>
                alert("Obrigado por participar do nosso CENSO 2011, sua participação foi muito importante.");         
            </script>
            
      <?php } else { ?>
            
            <script>
                alert("Houve um erro ao alterar o registro.");        
            </script>
            
            <?php
        }        
    }
    ?>
            
            
    <script>
        location.href = '../../controller/confirmacao_de_acesso/confirmar.php';    
    </script>
    
            
<?php } else {    ?>
            
    <script>
        alert("Não é possível exibir a página solicitada!");  
        location.href = '../../index.php';  
    </script>    
    
<?php } 