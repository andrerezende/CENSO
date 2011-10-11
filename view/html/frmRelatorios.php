<?php
session_start("autenticacao");

if($_SESSION['autenticado']) {  ?>


        <!DOCTYPE html>
            <html>
                <head>

                    <title>Censo</title>
                    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
                    <link href="statics/css/estilo.css" rel="stylesheet" type="text/css" />
                    <script type="text/JavaScript" src="../js/funcoesDeFormulario.js"></script>

                </head>
                <body>
                <!-- <div id="tudo"> -->
                    <?php include_once("statics/cabecalho.php"); ?>

                    <div id="conteudo">     

                        <p class="titulo-formulario">CENSO 2011</p>
                        <p></p>        

                        <table width="560" border="0" align='center' class="titulo-tabela">				
                            <tr>                                
                                <td align="left">
                                    <label>Relatórios</label>
                                </td>
                            </tr>
                        </table>

                        <table width="560" border="0" align='center' class="conteudo-tabela">

                            <tr>
                                <td width="100%" align="center">
                                    <a href="frmRepPesquisarPessoa.php" title="Cadastro Funcional Individual">Cadastro Funcional Individual</a><br/>     
                                    <a href="../../controller/impressao/imprimir_alteracoes.php" title="Relatório de alterações realizadas">Relatório de Alterações</a><span id="informativo"> *Pode demorar alguns minutos</span><br/>
                                    <a href="../../controller/impressao/imprimir_todos.php" title="Cadastro Funcional de Todos os Servidores">Cadastro Funcional de Todos os Servidores</a><span id="informativo"> *Pode demorar alguns minutos</span><br/>                                     
                                    <a href="../../view/html/frmPesquisarPessoasPendentes.php" title="Pendentes">Pendentes</a><span id="informativo"> </span><br/> <br/>                                    
                                    <a href="frmAutenticado.php" title="Voltar">Voltar</a><br/>
                                </td>
                            </tr>

                        </table>    

                    </div>                               
                                            
                 <?php include_once("statics/rodape.php"); ?>
	
                <!-- </div> -->
                    
            </body>
        </html>
    
    
    <?php
} else {
    echo "
        <script>
            alert(\"Você não tem permissão para visualizar esta página.\");
            location.href = \"../../admin.php\";      
        </script>";
}