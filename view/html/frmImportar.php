<?php
session_start("autenticacao");
?>

        <!DOCTYPE html>
            <html>

    <?php if($_SESSION['autenticado']) {  ?>

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
                            <label>Importar Dados</label>
                        </td>
                    </tr>
                </table>

                <form action="../../controller/importacao/importar.php" method="POST" enctype="multipart/form-data">
                    <table width="460" border="0" align='center' class="conteudo-tabela">
                        <tr>
                            <td width="100%" align="center">
                                Arquivo xls:  <input name="arquivo" type="file"/>
                            </td>
                        </tr>
                        <tr>
                            <td width="100%" align="center">
                                <input type="submit" value="Enviar"/>
                                <input type="button" value="Voltar" onclick="voltar(1);"/>
                            </td>
                        </tr>
                    </table>  
                </form>

                    </div>                               
                                            
                 <?php include_once("statics/rodape.php"); ?>
	
                <!-- </div> -->
                    
            </body>
            
        <?php } else { ?>
                <script type="text/javascript">
                    alert("Você não tem permissão para visualizar esta página.");
                    location.href = "../../admin.php";      
                </script>
        <?php } ?>
        
</html>

