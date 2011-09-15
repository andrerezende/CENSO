<?php
session_start("autenticacao");
// PESQUISA PESSOA POR SIAPE

require_once "../../model/Conexao.php";
require_once '../Seguranca.php';
require_once '../Solicitacoes.php';
require_once '../Util_controller.php';

$siape = "'".Seguranca::anti_injection($_POST['siape'])."'";  

if($_SESSION['autenticado']) { 

    if($siape) { 
        
        $registro = Conexao::getInstance()->getPessoaBySiapeCpf($siape);
        $allEstados = Conexao::getInstance()->getAllEstados();
        
        if($registro) { // se registro existe 
                        
            // colocando o registro e os estados na sessao. (os estados serao usados mais adiante)
            $_SESSION['registroFromBanco'] =& $registro;  
            $_SESSION['allEstados'] = $allEstados;
            
            
            // Preparando os dados para apresentar as alteraçoes do registro referido
            
            $registrosAlterados = Conexao::getInstance()->getAllregistrosAlteradosByIdPessoa($registro['id_pessoa']);
            
            if($registrosAlterados != null) {  // se tiver registro alterado
                
                // campo alterado tratado pelo Util_controller
                for($i=0; $i<count($registrosAlterados); $i++) { 
                    $registrosAlterados[$i]['campo_alterado_nomeCampo'] = Util_controller::nomeCampo($registrosAlterados[$i]['campo_alterado']);
                    
                    
                    // id_estadoS
                    if($registrosAlterados[$i]['campo_alterado'] == "id_estado_nasc" || 
                            $registrosAlterados[$i]['campo_alterado'] == "id_estado_atual" || 
                            $registrosAlterados[$i]['campo_alterado'] == "rg_id_estado" || 
                            $registrosAlterados[$i]['campo_alterado'] == "registroprofissional_id_estado" ||
                            $registrosAlterados[$i]['campo_alterado'] == "certidao_nascimentocasamento_id_estado") {
                        
                        // percorrendo o array de estados
                        foreach($allEstados as $estado) {
                            
                            if($registrosAlterados[$i]['valor_antigo'] == $estado['id_estado']) {
                                $registrosAlterados[$i]['valor_antigo'] = $estado['sgl_estado'];
                            }
                            
                            // novo valor
                            // $registro é o FromBanco
                            if($registro[$registrosAlterados[$i]['campo_alterado']] == $estado['id_estado']) {
                                $registro[$registrosAlterados[$i]['campo_alterado']] = $estado['sgl_estado'];
                            }
                            
                        }
                        
                    }
                    
                    // fazendo solicitaçao do nome da cidade pelo id
                    if($registrosAlterados[$i]['campo_alterado'] == "id_cidade") {
                        // se tiver alguma cidade no valor antigo
                        if($registrosAlterados[$i]['valor_antigo']) {
                            $registrosAlterados[$i]['valor_antigo'] = Solicitacoes::getNomeCidadeByID($registrosAlterados[$i]['valor_antigo']);
                        }
                        
                        // se tiver alguma cidade no novo valor
                        if($registro['id_cidade']) {
                            $registro['id_cidade'] = Solicitacoes::getNomeCidadeByID($registro['id_cidade']);
                        }
                            
                    }
                    
                    
                    
                }
                
                
                
                
                
                
                                
                // coloca o array de registros alterado na sessao
                $_SESSION['registrosAlterados'] = $registrosAlterados;
                
                header("Location: ../../view/html/frmPessoa.php"); 
                
            } else {    ?>
                
                <script>
                    alert("Nenhum registro alterado referente a esta pessoa.");
                    history.go(-1);  
                </script>
                
        <?php }
            
        } else {    // registro nao existe  ?>
            
            <script>
                alert("Nenhum registro encontrado.");  
                history.go(-1);      
            </script>   
            
<?php }

        
    } else { // veio de fora ?>
        
            <script>
                alert("Não acesse este arquivo diretamente!");  
                location.href = '../../index.php';
            </script>    
            
<?php }
    
} else {    ?>
    
    <script>
        alert("Você não tem permissão para visualizar esta página.");
        location.href = '../../index.php';
    </script>
    
<?php }

