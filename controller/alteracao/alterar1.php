<?php
//ini_set('display_errors', 1);

// CLASSE DE ENCAMINHAMENTO DOS DADOS PARA ALTERACAO
session_start();
$_SESSION['permiteAlterar'] = false;
$_SESSION['registroFromBanco'] = null;

require_once "../../model/Conexao.php";
require_once '../Seguranca.php';

// sem aspas porque será tratado como inteiro ao enviar p/ o banco
$siape = Seguranca::anti_injection($_POST['index_siape']);  // vem apenas do frmEntrada
$cpf = Seguranca::anti_injection($_POST['index_cpf']);  // vem apenas do frmEntrada

    if($siape && $cpf) { 
        
        $registro = Conexao::getInstance()->getPessoaBySiapeCpf($siape, $cpf);
        
        //print_r($registro);exit;
        
        // Pegando todos os estados para preencher os selections da view
        $allEstados = Conexao::getInstance()->getAllEstados();
        //var_dump($siape, $cpf);exit;
        if($registro) { // registro existe 
            
            $email_dominio = explode("@", $registro['email']);
            $registro['email'] = $email_dominio[0];
            $registro['email_dominio'] = strtolower("@$email_dominio[1]");
                        
            if(Conexao::getInstance()->isAtualizacaoPossivel($registro['id_pessoa'])) {   // permitido atualizar
                $_SESSION['permiteAlterar'] = true;
                $_SESSION['registroFromBanco'] = $registro;  // enviando o obj do registro para alteracao
                $_SESSION['allEstados'] = $allEstados;
                header("Location: ../../view/html/frmAlterar.php");
                
                
            } else { // NAO PERMITE ATUALIZAR ?>  
                <script>
                    alert("Consta nos nossos registros que você já realizou a conferência dos seus dados para o CENSO 2011. Qualquer dúvida entre em contato com a DGP: 71 3186-0047.");  
                    history.go(-1);   
                </script>";  
                
        <?php } ?>          
            
     <?php   } else {    // registro nao existe  ?>
            <script>
                alert("Nenhum registro encontrado.");  
                   location.href = '../../index.php';      
            </script>";   
   <?php }  ?>
   
        
   <?php } else { // veio de fora ?>
        <script>
            alert("Não acesse este arquivo diretamente!");  
             location.href = '../../index.php';      
        </script>    
        
   <?php }