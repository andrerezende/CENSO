<?php
session_start("autenticacao");

ini_set('memory_limit','1024M');     // memory limit 1GB
ini_set('max_execution_time','2400');    // tempo maximo de espera 40 minutos


require_once "../../model/Conexao.php";
require_once '../Seguranca.php';
require_once '../classes/Impressao.php';

$lotacao = Seguranca::anti_injection($_POST['lotacao']);  
//var_dump($_POST['lotacao']);exit;

if($_SESSION['autenticado']) {
    
    if($lotacao) {
        $pendentes = Conexao::getInstance()->getNamePendentesByLotacao($lotacao);
        
    } else {
        throw new Exception("A Lotação não foi informada");
    }
    
    if($pendentes) { // se registros existem  
        
        // iniciando o buffer            
        ob_start();     ?>

            
            <h3>
            MINISTÉRIO DA EDUCAÇÃO <br/>
            SECRETARIA DE EDUCAÇÃO PROFISSIONAL E TECNOLÓGICA <br/>
            INSTITUTO FEDERAL DE EDUCAÇÃO, CIÊNCIA E TECNOLOGIA BAIANO</h3>
            
<!--
            <h4 align="center">
                MINISTÉRIO DA EDUCAÇÃO - SECRETARIA DE EDUCAÇÃO PROFISSIONAL E TECNOLÓGICA - INSTITUTO FEDERAL BAIANO
            </h4>
-->

            <h3 align="center">RELATÓRIO DE PENDENTES DE <?php echo $lotacao; ?></h3>
            
            
            <table width="760" border="0" align='center' class="conteudo-tabela">
            <?php foreach($pendentes as $pendente) { ?>

                <tr>
                    <td width="100%" align="left">  
                        <label><?php echo $pendente['nome']; ?></label>     
                    </td>
                </tr>
                
            <?php } ?>
            </table>

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

