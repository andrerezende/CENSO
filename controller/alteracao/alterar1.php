<?php
// CLASSE DE ENCAMINHAMENTO DOS DADOS PARA ALTERACAO
session_start();
$_SESSION['permiteAlterar'] = false;

require_once "../../model/Conexao.php";
require_once '../Seguranca.php';


$siape = "'".Seguranca::anti_injection($_POST['index_siape'])."'";  // vem apenas do frmEntrada
$cpf = "'".Seguranca::anti_injection($_POST['index_cpf'])."'";  // vem apenas do frmEntrada

    if($siape && $cpf) { 
        
        $registro = Conexao::getInstance()->getPessoaBySiapeCpf($siape, $cpf);
        
        // Pegando todos os estados para preencher os selections da view
        $allEstados = Conexao::getInstance()->getAllEstados();
        //var_dump($siape, $cpf);exit;
        if($registro) { // registro existe 
            
            
            if(Conexao::getInstance()->isAtualizacaoPossivel($registro['id_pessoa'])) {   // permitido atualizar
                $_SESSION['permiteAlterar'] = true;
                $_SESSION['registroFromBanco'] = $registro;  // enviando o obj do registro para alteracao
                $_SESSION['allEstados'] = $allEstados;
                
                echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\" /> 
                    <script>
                           location.href = '../../view/html/frmAlterar.php';      
                            </script>";  
                
            } else {    // NAO PERMITE ATUALIZAR
                echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\" /> 
                        <script>alert(\"Consta nos nossos registros que você já realizou a conferência dos seus dados para o CENSO 2011. Qualquer dúvida entre em contato com a DGP: 71 3186-0047.\");  
                           history.go(-1);   
                            </script>";  
            }             
            
        } else {    // registro nao existe
            echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\" />
                 <script>alert(\"Nenhum registro encontrado.\");  
                   location.href = '../../index.php';      
                    </script>";   
        }
        
        
        
    } else { // veio de fora
        echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\" />
                 <script>alert(\"Não acesse este arquivo diretamente!\");  
                 location.href = '../../index.php';      
                    </script>";    
    }




?>
