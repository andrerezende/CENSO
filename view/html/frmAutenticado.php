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

                        <table width="460" border="0" align='center' class="titulo-tabela">				
                            <tr>                                
                                <td align="left">
                                    <label><b>Área do Administrador</b></label>
                                </td>
                            </tr>
                        </table>

                        <table width="460" border="0" align='center' class="conteudo-tabela">

                            <tr>
                                <td width="25%" align="center">
                                    <a href="frmRelatorios.php" title="Relatórios">Relatórios</a>
                                </td>
                                    
                                <td width="25%" align="center">
                                    <a href="frmImportar.php" title="Importar">Importar</a>
                                </td>
                                
                                <td width="25%" align="center">    
                                    <a href="frmPesquisarPessoa.php" title="Pesquisar Pessoa">Pesquisar Pessoa</a>
                                </td>
                                
                                <td width="25%" align="center">
                                    <a href="../../controller/autenticacao/logout.php" title="Sair">Sair</a>
                                </td>
                                    
                                    <!--
                                    <input type="button" value="Imprimir" onclick="javascript:window.location='../../controller/impressao/imprimir_alteracoes.php';"/>
                                    <input type="button" value="Importar" onclick="javascript:window.location='frmImportar.php';"/>         
                                    <input type="button" value="Pesquisar Pessoa" onclick="javascript:window.location='frmPesquisarPessoa.php';"/>       
                                    <input type="button" value="Novo Cadastro" onclick="javascript:window.location='formNovoCadastro.php';" /> 
                                    <input type="button" value="Sair" onclick="javascript:window.location='../../controller/autenticacao/logout.php';"/>
                                    -->
                            </tr>

                        </table>    

                    </div>                               
                                            
                 <?php include_once("statics/rodape.php"); ?>
	
                <!-- </div> -->
                    
            </body>
        </html>
    
    
    <?php
    
} else {
    
    echo "<script>
                alert(\"Você não tem permissão para visualizar esta página.\");
                location.href = \"../../admin.php\";      
        </script>";
}