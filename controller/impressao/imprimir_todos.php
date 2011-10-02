<?php
session_start("autenticacao");
// PESQUISA PESSOA POR SIAPE

ini_set('memory_limit','1024M');     // memory limit 1GB
ini_set('max_execution_time','2400');    // tempo maximo de espera 40 minutos


require_once "../../model/Conexao.php";
require_once '../Seguranca.php';
require_once '../Solicitacoes.php';
require_once '../Util_controller.php';
require_once '../classes/Impressao.php';

if($_SESSION['autenticado']) { 
        
        $allRegistros = Conexao::getInstance()->getAllRegistros();
        $allEstados = Conexao::getInstance()->getAllEstados();
        
        
        if($allRegistros) { // se registro existe  
        //
            // iniciando o buffer            
            ob_start();     ?>

            <?php
            foreach($allRegistros as $registroFromBanco) {  ?>

                <!--
                <h3>
                MINISTÉRIO DA EDUCAÇÃO <br/>
                SECRETARIA DE EDUCAÇÃO PROFISSIONAL E TECNOLÓGICA <br/>
                INSTITUTO FEDERAL DE EDUCAÇÃO, CIÊNCIA E TECNOLOGIA BAIANO</h3>
                <h3 align="center">CADASTRAMENTO FUNCIONAL</h3>
                -->
                
                <h4 align="center">
                    MINISTÉRIO DA EDUCAÇÃO - SECRETARIA DE EDUCAÇÃO PROFISSIONAL E TECNOLÓGICA - INSTITUTO FEDERAL BAIANO
                </h4>
                
                <?php include_once "pessoa_individual.php"; ?>
             
             <br/>
             <br/>
             <br/>
             
             
             
             <?php } ?>


            <?php
                $html = ob_get_clean();
                
                //var_dump($html);exit;

                $footerName = "CENSO 2011";
                $stylesheetAddress = '../../view/html/statics/css/estilo.css';
                $archiveName = date("ymdhis").'_relatorioInfoCENSO2011';
                
                $imprimirPessoa = new Impressao($html, $footerName, $stylesheetAddress, $archiveName);
                $imprimirPessoa->gerarPDF();
                
                
        } else {    // registro nao existe  ?>
            
            <script>
                    alert("Nenhum registro encontrado.");  
                    history.go(-1);      
            </script>
            
    <?php }
               
} else {    ?>
    
    <script>
            alert("Você não tem permissão para visualizar esta página.");
            location.href = "../../admin.php";      
    </script>

<?php }

