
<!DOCTYPE html>
<html>
    <head>
        
        <title>Censo</title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<link href="statics/css/estilo.css" rel="stylesheet" type="text/css" />
        <script type="text/JavaScript" src="../js/funcoesDeFormulario.js"></script>
                
    </head>
    <body>
        
        <?php include_once("statics/cabecalho.php"); ?>
        
    <div id="conteudo">    
        
        <p class="titulo-formulario">CENSO 2011</p>
        <p></p>                           
                                     
        <form id='formIndex' name='formIndex' action='../../controller/alteracao/alterar1.php' method='post' onsubmit="return validar_frmIndex();" >
            <table width="460" border="0" align='center' class="titulo-tabela">				
                <tr>                                
                    <td align="left">
                        <label><b>Insira a Matr&iacute;cula e o CPF<b/></label>
                    </td>
                </tr>
            </table>
                    
            <table width="460" border="0" align='center' class="conteudo-tabela">
                
                <tr>
                    <td width="150" height="27" align='right'><label for=siape >Matr&iacute;cula SIAPE:</label></td>
                    <td colspan='2'>
                        <input name="index_siape" type="text" id="index_siape" onkeypress="javascript:return Onlynumber(event);" size="25" maxlength="11" alt="Siape" />
                    </td>
                    </tr> 

                    <tr>
                        <td width="150" height="27" align='right'><label for=cpf >CPF:</label></td>
                        <td colspan='2'>
                            <input name="index_cpf" type="text" id="index_cpf" onkeypress="javascript:return Onlynumber(event);" size="25" maxlength="11" alt="CPF" />
                        </td>
                    </tr> 
                
            </table>   
            
            <table width="460" border="0" align='center' class="conteudo-tabela">
                
                <tr>
                    <td width="90%" align="center">
                        <input name="acessar" type="submit" id="acessar" value="Acessar" />
                    </td>
                </tr>
                
            </table>    
            
				
    </form>                         
                                            
         <?php include_once("statics/rodape.php"); ?>
	
    </body>
</html>