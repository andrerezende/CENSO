<?php
//session_start("autenticacao");

//include ("classes/Pessoa.php");

//if($_SESSION['autenticado']) {  ?>


        <!DOCTYPE html>
        <html>
            <head>
                <title>Censo</title>
                <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
                <link href="statics/css/estilo.css" rel="stylesheet" type="text/css" />
                <script language="JavaScript" type="text/JavaScript">

                function formAutenticado_redirect() {
                    window.location="formAutenticado.php"; 
                }

                </script>
            </head>
            <body>
                
            <div id="tudo">
                <div id="topo-mec">
                    <a href="http://portal.mec.gov.br/" class="img-mec"><img alt="Ministerio da Educação" src="statics/img/h1pq.gif" /></a>
                    <a href="http://www.brasil.gov.br/" class="img-selo"><img alt="Portal do Governo" src="statics/img/selo_brasil_pq.gif" /></a>
                </div>

                <div id="topo-geral">
                    <div id="topo">
                        <span class="titulo">SIGA - Sistema Integrado de Gestão Acadêmica</span>
                    </div>
                </div> 
                
                <div id="conteudo">
                <img alt="Logo IFBaiano" src="statics/img/logo_ifbaiano.jpg" width="300" />
                <p class="titulo-formulario">CENSO 2011</p>
                <p></p>                           

                
                    <table width="460" border="0" align='center' BGCOLOR=#DCDCDC>				
                        <tr>                                
                            <td align="left">
                                <label for=cpf><b>Área do Administrador<b/></label>
                            </td>
                        </tr>
                    </table>

                <form action="upload.php" method="POST" enctype="multipart/form-data">
                    <table width="460" border="0" align='center' BGCOLOR=#F5F5F5>
                        <tr>
                            <td width="100%" align="center">
                                Arquivo xls:  <input name="arquivo" type="file"/>
                            </td>
                        </tr>
                        <tr>
                            <td width="100%" align="center">
                                <input type="submit" value="Enviar"/>
                                <input type="button" value="Voltar" onclick="javascript:formAutenticado_redirect()"/>
                            </td>
                        </tr>
                    </table>  
                </form>

                </div>




                <div id="rodape">
                    <div id="conteudoRodape">
                        <p><b>Instituto Federal de Educa&ccedil;&atilde;o, Ci&ecirc;ncia e Tecnologia Baiano</b><br />
                                Reitoria &ndash; Rua do Rouxinol, 115 - Imbu&iacute;<br />
                                Salvador &ndash; Bahia &ndash; CEP: 41.720&ndash;052<br />
                        </p>
                    </div>
                </div>
                

            </div>
            </body>
        </html>
    
    
    