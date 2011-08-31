
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
                                     
        <form id='frmAdmin' name='frmAdmin' action='../../controller/autenticacao/autenticar.php' method='post' onsubmit="return validar_frmAdmin();" >
            
            <table width="460" border="0" align='center' class="titulo-tabela">				
                <tr>                                
                    <td align="left">
                        <label><b>Área do Administrador</b></label>
                    </td>
                </tr>
            </table>
                    
            <table width="460" border="0" align='center' class="conteudo-tabela">
                
                <tr>
                    <td width="150" height="27" align='right'>
                        <label>Usuário:</label>
                    </td>
                    <td colspan='2'>
                        <input name="usuario" type="text" id="usuario" size="25" maxlength="20" alt="Usuário" />
                    </td>
                </tr> 

                <tr>
                    <td width="150" height="27" align='right'>
                        <label for=cpf >Senha:</label>
                    </td>
                    <td colspan='2'>
                        <input name="senha" type="password" id="senha" size="25" maxlength="8" alt="Senha" />
                    </td>
                </tr> 
                
            </table>   
            
            <table width="460" border="0" align='center' class="conteudo-tabela">
                
                <tr>
                    <td width="90%" align="center">
                        <input name="ok" type="submit" id="ok" value="Ok" />
                        <input type="button" value="cancelar" onclick="voltar(1);" />
                    </td>
                </tr>
                
            </table>    
            
				
    </form>
        
    </div>                               
                                            
             <?php include_once("statics/rodape.php"); ?>
	
        <!-- </div> -->
    </body>
</html>