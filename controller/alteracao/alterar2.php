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
            
            // SE FOR NOME_CIDADE NAO USE STRUPPER
            if($chave != "nome_cidade") {   
                $registroFromPOST[$chave] = strtoupper($valor);  
            }  
            
            // NECESSIDADE ESPECIAL
            if($chave == "necessidade_especial_outra") {
                if($valor) {    // se necessidade_especial_outra tiver sido preenchido
                    $registroFromPOST["necessidade_especial"] = $registroFromPOST["necessidade_especial_outra"];
                }
            }
            
            // POPULA ARRAY DE CAMPOS ALTERADOS E POE ASPAS            
            if(array_key_exists($chave, $registroFromBanco)) { // certificando-se de que esta coluna existe no banco                
                if($registroFromPOST[$chave] != $registroFromBanco[$chave]) {   // comparando o valor do post com o valor do banco, se for diferente, entra         
                    $campoAlterado[$i]['campo_alterado'] = "'$chave'";
                    $campoAlterado[$i]['valor_antigo'] = ($registroFromBanco[$chave]) ? "'$registroFromBanco[$chave]'" : "null";
                    $campoAlterado[$i]['data_alteracao'] = "'".date('d/m/Y')."'";
                   
                    // dados que precisam ser checados
                    switch($chave) {
                        case "nome":
                        case "estadocivil":
                        case "endresidencial":
                        case "rg":
                        case "dataprimeiroemprego":
                        case "numerobanco":    
                        case "nomebanco":
                        case "agencia":
                        case "conta":
                        case "segundograu":
                        case "segundograu_instituicao":
                        case "segundograu_curso":     
                        case "segundograu_dataconclusao":
                        case "terceirograu":
                        case "terceirograu_instituicao":
                        case "terceirograu_curso":
                        case "terceirograu_dataconclusao":
                        case "posgraduacao1_tipo":    
                        case "posgraduacao1_situacao":
                        case "posgraduacao1_curso":
                        case "posgraduacao1_instituicao":
                        case "posgraduacao1_cargahoraria":
                        case "posgraduacao1_dataconclusao":
                        case "posgraduacao2_tipo":     
                        case "posgraduacao2_situacao":
                        case "posgraduacao2_curso":
                        case "posgraduacao2_instituicao":
                        case "posgraduacao2_cargahoraria":
                        case "posgraduacao2_dataconclusao":
                        case "posgraduacao3_tipo":     
                        case "posgraduacao3_situacao":
                        case "posgraduacao3_curso":
                        case "posgraduacao3_instituicao":
                        case "posgraduacao3_cargahoraria":
                        case "posgraduacao3_dataconclusao":
                        case "posgraduacao4_tipo":     
                        case "posgraduacao4_situacao":
                        case "posgraduacao4_curso":
                        case "posgraduacao4_instituicao":
                        case "posgraduacao4_cargahoraria":
                        case "posgraduacao4_dataconclusao":
                        case "idioma1": 
                        case "idioma1_leitura":
                        case "idioma1_fala":
                        case "idioma1_escrita":
                        case "idioma2":     
                        case "idioma2_leitura":
                        case "idioma2_fala":
                        case "idioma2_escrita":
                        case "idioma3":
                        case "idioma3_leitura":
                        case "idioma3_fala":     
                        case "idioma3_escrita":
                        case "idioma4":
                        case "idioma4_leitura":
                        case "idioma4_fala":
                        case "idioma4_escrita":
                            $campoAlterado[$i]['checado'] = 0;
                            break;
                        
                        // para todos os outros, check automaticamente
                        default:
                            $campoAlterado[$i]['checado'] = 1;
                    }
                    $i++;
                } 
                
            } 
    }
    
    if($campoAlterado) {
        // SEGURANÇA ANTI-INJECTION E ADD ASPAS PARA ENVIAR P/ BANCO
        foreach($registroFromPOST as $chave=>$valor) {
            if($chave != "id_pessoa") {
                $registroFromPOST[$chave] = ($valor) ? "'".Seguranca::anti_injection($valor)."'" : "null";  
            }
        }
        
        
        if(Conexao::getInstance()->update($registroFromPOST, $campoAlterado)) { ?>
            
            <script>
                alert("Obrigado por participar do nosso CENSO 2011, sua participação foi muito importante.");         
                location.href = '../../controller/confirmacao_de_acesso/confirmar.php';   
            </script>
            
      <?php } else { ?>
            
            <script>
                alert("Houve um erro ao alterar o registro. Verifique se os dados foram digitados corretamente e tente novamente.");        
                history.go(-1);
            </script>
            
            <?php
        }        
    }
    
} else {    ?>
            
    <script>
        alert("Não é possível exibir a página solicitada!");  
        location.href = '../../index.php';  
    </script>    
    
<?php } 