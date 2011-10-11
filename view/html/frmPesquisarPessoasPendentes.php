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

                        <form id='frmPesquisarPessoasPendentes' name='frmPesquisarPessoasPendentes' action='../../controller/impressao/imprimir_pendentes.php' method='post' >
                            <table width="460" border="0" align='center' class="titulo-tabela">				
                                <tr>                                
                                    <td align="left">
                                        <label>Pesquisar Pendentes</label>
                                    </td>
                                </tr>                                
                            </table>

                            <table width="460" border="0" align='center' class="conteudo-tabela">

                                <tr>
                                    <td width="150" height="27" align='right'>
                                        <label>Informe a lotação:</label>
                                    </td>
                                    <td colspan='2'>
                                        <select name="lotacao" id="lotacao">
                                            <?php
                                                $lotacao = array(
                                                    "IFBAIANO - REITORIA",
                                                    "IFBAIANO - GUANAMBI",
                                                    "IFBAIANO - SANTA INÊS",
                                                    "IFBAIANO - SENHOR DO BONFIM",
                                                    "IFBAIANO - CATU",
                                                    "IFBAIANO - BOM JESUS DA LAPA",
                                                    "IFBAIANO - ITAPETINGA",
                                                    "IFBAIANO - TEIXEIRA DE FREITAS",
                                                    "IFBAIANO - URUÇUCA",
                                                    "IFBAIANO - VALENÇA",
                                                    "IFBAIANO - GOVERNADOR MANGABEIRA"
                                                    );
                                                
                                                for($i=0; $i<count($lotacao); $i++) {
                                                    echo("<option value='$lotacao[$i]'>$lotacao[$i]</option>");
                                                }
                                                ?>
                                         </select>
                                    </td>
                                </tr> 
                                
                            </table>   

                            <table width="460" border="0" align='center' class="conteudo-tabela">

                                <tr>
                                    <td width="90%" align="center">
                                        <input name="pesquisar" type="submit" id="pesquisar" value="Pesquisar" />
                                        <input type="button" value="Voltar" onclick="javascript:window.location='frmAutenticado.php';" /> 
                                    </td>
                                </tr>

                            </table>    


                    </form>

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