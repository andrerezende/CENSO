<?php
session_start("autenticacao");
// PESQUISA PESSOA POR SIAPE

require_once "../../model/Conexao.php";
require_once '../Seguranca.php';
require_once '../Solicitacoes.php';
require_once '../Util_controller.php';
require_once '../classes/Impressao.php';

$siape = "'".Seguranca::anti_injection($_POST['siape'])."'";  

if($_SESSION['autenticado']) { 

    if($siape) { 
        
        $registroFromBanco = Conexao::getInstance()->getPessoaBySiapeCpf($siape);
        $allEstados = Conexao::getInstance()->getAllEstados();
        //$cidade = Solicitacoes::getNomeCidadeByID($registroFromBanco['id_cidade']);
        
        if($registroFromBanco) { // se registro existe  
        //
            // iniciando o buffer            
            ob_start();     ?>
                <!--
                <img alt="Logo IFBaiano" src="../../view/html/statics/img/logo_ifbaiano.jpg" width="300" />
                <p class="titulo-formulario">Relatório de Informações Pessoais - CENSO 2011</p>
                <p></p> 
                
                <h3>
                MINISTÉRIO DA EDUCAÇÃO <br/>
                SECRETARIA DE EDUCAÇÃO PROFISSIONAL E TECNOLÓGICA <br/>
                INSTITUTO FEDERAL DE EDUCAÇÃO, CIÊNCIA E TECNOLOGIA BAIANO</h3>-->
                
                <h4 align="center">
                    MINISTÉRIO DA EDUCAÇÃO - SECRETARIA DE EDUCAÇÃO PROFISSIONAL E TECNOLÓGICA - INSTITUTO FEDERAL BAIANO
                </h4>
                
                <h3 align="center">CADASTRAMENTO FUNCIONAL</h3>
                
                <?php include_once "pessoa_individual.php"; ?>


            <?php
                $html = ob_get_clean();

                $footerName = "CENSO 2011";
                $stylesheetAddress = '../../view/html/statics/css/estilo.css';
                $archiveName = date("ymdhis").'_relatorioInfo'.$registro['siape'].'CENSO2011';
                
                $imprimirPessoa = new Impressao($html, $footerName, $stylesheetAddress, $archiveName);
                $imprimirPessoa->gerarPDF();
                
                
        } else {    ?>
            
             <script>
                    alert("Nenhum registro encontrado.");  
                    history.go(-1);      
            </script>
            
<?php } 
        
    } else { // veio de fora    ?>
        
            <script>
                 alert("Não acesse este arquivo diretamente!");  
                 location.href = '../../index.php';      
            </script>
 <?php   }
    
} else {    ?>
    
        <script>
            alert("Você não tem permissão para visualizar esta página.");
            location.href = "../../admin.php";      
        </script>

<?php }

