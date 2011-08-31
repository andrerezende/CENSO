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

                        <form id='frmPesquisarPessoa' name='frmPesquisarPessoa' action='../../controller/pesquisar_pessoa/pesquisar_pessoa.php' method='post' onsubmit="return validar('siape', 'Voce precisa preencher o Siape');" >
                            <table width="460" border="0" align='center' class="titulo-tabela">				
                                <tr>                                
                                    <td align="left">
                                        <label>Pesquisar Pessoa</label>
                                    </td>
                                </tr>                                
                            </table>

                            <table width="460" border="0" align='center' class="conteudo-tabela">

                                <tr>
                                    <td width="150" height="27" align='right'>
                                        <label>Informe o SIAPE:</label>
                                    </td>
                                    <td colspan='2'>
                                        <input name="siape" type="text" id="siape" onkeypress="javascript:return Onlynumber(event);" size="25" maxlength="11" alt="Siape" />
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
    echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\" />
        <script>alert(\"Você não tem permissão para visualizar esta página.\");
                location.href = \"../../admin.php\";      
                </script>";
}



?>

      