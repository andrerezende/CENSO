<?php
session_start("autenticacao");

if($_SESSION['autenticado']) {
        
    $registroFromBanco = $_SESSION['registroFromBanco'];
    $registrosAlterados = $_SESSION['registrosAlterados'];
    ?>


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

                        
                        
                    
                        <table width="760" border="0" align='center' class="titulo-tabela">				
                            <tr>                                
                                <td width="90%" align="center">
                                    <label>Servidor: <?php echo $registroFromBanco['nome']; ?></label>
                                </td>
                                <td width="10%" align="center">
                                    <label for="checkAll1">Todos</label>
                                    <input type="checkbox" id="checkAll1" name="checkAll1" value="1" onchange="checkAll(1);" />
                                </td>
                            </tr>
                        </table>
                        
                        <?php //print_r($registrosAlterados); ?>
                        
                        <table border="0" width="760" border="0" align='center' class="conteudo-tabela">
                            <tr>
                                <td width="20%" align='left'>
                                    <div class="rotulo-verde">
                                        <label>Campo:</label>
                                    </div>
                                </td>
                                <td width="35%" align='left'>
                                    <div class="rotulo-verde">
                                        <label>Valor Antigo:</label>
                                    </div>
                                </td>
                                <td width="35%" align='left'>
                                    <div class="rotulo-verde">
                                        <label>Novo valor:</label>
                                    </div>
                                </td>
                                <td width="10%" align='left'>
                                    <div class="rotulo-verde">
                                        <label>Validado:</label>
                                    </div>
                                </td>
                            </tr>
                        </table>
                        
                        
                <form id='formCheckAlteracao' name='formCheckAlteracao' action='../../controller/checagem_de_alteracao/setar_alteracoes_checadas.php' method='post' >
                        <?php 
                        for($i=0; $i<count($registrosAlterados); $i++) { ?>
                            <table border="0" width="760" border="0" align='center' class="conteudo-tabela">
                                <tr>
                                    <td width="20%" align='left'>                                        
                                        <?php echo $registrosAlterados[$i]['campo_alterado_nomeCampo']; ?>
                                    </td>
                                    
                                    <td width="35%" align='left'>
                                        <div id="label_original_impressao">
                                            <?php // buscando o nome do estado
                                            if($registrosAlterados[$i]['campo_alterado'] == "id_estado_nasc" || $registrosAlterados[$i]['campo_alterado'] == "id_estado_atual" || $registrosAlterados[$i]['campo_alterado'] == "rg_id_estado" || $registrosAlterados[$i]['campo_alterado'] == "registroprofissional_id_estado") {                                                
                                                echo $registrosAlterados[$i]['valor_antigo'];
                                                
                                                // buscando o nome da cidade
                                            } else if ($registrosAlterados[$i]['campo_alterado'] == "id_cidade") {
                                                echo $registrosAlterados[$i]['valor_antigo']; 
                                               

                                            } else {
                                                echo $registrosAlterados[$i]['valor_antigo']; 
                                            }
                                            ?>
                                        </div>
                                    </td>

                                    <td width="35%" align='left'>
                                        <div id="label_alterado_impressao">
                                            <?php // buscando o nome do estado
                                            if($registrosAlterados[$i]['campo_alterado'] == "id_estado_nasc" || $registrosAlterados[$i]['campo_alterado'] == "id_estado_atual"  || $registrosAlterados[$i]['campo_alterado'] == "rg_id_estado" || $registrosAlterados[$i]['campo_alterado'] == "registroprofissional_id_estado") {
                                                echo $registroFromBanco[$registrosAlterados[$i]['campo_alterado']]; 
                                                
                                                // buscando o nome da cidade
                                            } else if ($registrosAlterados[$i]['campo_alterado'] == "id_cidade") {
                                                echo $registroFromBanco[$registrosAlterados[$i]['campo_alterado']]; 
                                                
                                            } else {
                                                echo $registroFromBanco[$registrosAlterados[$i]['campo_alterado']]; 
                                            }
                                            ?>
                                        </div>
                                    </td>

                                    <td width="10%" align='left'>
                                        <?php 
                                        if($registrosAlterados[$i]['checado'] == 1) { ?>
                                            <!-- <input type="checkbox" checked="checked" id="<?php //echo $registrosAlterados[$i]['id_atualizacao']; ?>" name="<?php //echo $registrosAlterados[$i]['id_atualizacao']; ?>" value="1" />    -->                                    
                                            <div id="label_original_impressao">Sim</div>
                                        <?php } else { ?>
                                            <input type="checkbox" id="<?php echo $registrosAlterados[$i]['id_atualizacao']; ?>" name="<?php echo $registrosAlterados[$i]['id_atualizacao']; ?>" value="1" />
                                        <?php } ?>
                                    </td>

                                </tr>
                            </table>
                            
                    
                    
                    <?php 
                    // colocando todos os ids dos elementos checkbox em um array
                    $elementosCheckbox[] = $registrosAlterados[$i]['id_atualizacao'];                
                    
                    ?>
                    
                    <?php } ?>
                    
                    <table width="760" border="0" align='center' class="titulo-tabela">
                
                        <tr>
                            <td width="90%" align="center">
                                <input name="confirmar" type="submit" id="confirmar" value="Confirmar" />
                                <input type="button" value="Voltar" onclick="history.go(-1)" />
                            </td>
                            
                            <td width="10%" align="center">
                                <label for="checkAll2">Todos</label>
                                <input type="checkbox" id="checkAll2" name="checkAll2" value="1" onchange="checkAll(2);" />
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