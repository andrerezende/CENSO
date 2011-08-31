<?php 
session_start();

// ****************************************************
// *** CLASSE NAO UTILIZADA
// *********************************************

$registroFromPOST = $_SESSION['registroFromPOST'];
$campoAlterado = $_SESSION['campoAlterado'];
$allEstados = $_SESSION['allEstados'];


//print_r($registroFromPOST);exit;

?>

<?php if($registroFromPOST) {
        
        if($campoAlterado) {
            
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
             
        <?php require_once("statics/cabecalho.php"); ?>
            
            
        <div id="conteudo">            
            <p class="titulo-formulario">CENSO 2011</p>
            <p></p>  
            
                <table width="760" border="0" align='center' class="titulo-tabela">				
                    <tr>                                
                        <td align="left">
                            <label><b>Dados Pessoais</b></label>
                        </td>
                    </tr>
                </table>

                <table width="760" border="0" align='center' class="conteudo-tabela">
                    
                    <tr>                                
                        <td width="150" height="27" align="right">                            
                            <label>Nome:</label>
                        </td>
                        <td colspan='2'>
                            <label><div id="label_apresentado"><?php echo $registroFromPOST['nome']; ?></div></label>                            
                        </td>
                    </tr>                

                    <tr>
                        <td width="150" height="27" align="right">
                            <label for=siape>Matrícula SIAPE:</label></td>
                        <td colspan='2'>
                            <label><div id="label_apresentado"><?php echo $registroFromPOST['siape']; ?></div></label>                            
                        </td>
                    </tr>	

                    <tr>
                        <td width="150" height="27" align='right'>
                            <label for=sexo>Sexo:</label>
                        </td>
                        <td>
                            <label><div id="label_apresentado"><?php echo $registroFromPOST['sexo']; ?></div></label>                            
                        </td>
                    </tr>

                    <tr>
                        <td width="150" height="27" align='right'>
                            <label>Data de Nascimento:</label>
                        </td>
                        <td>
                            <label><div id="label_apresentado"><?php echo $registroFromPOST['datanascimento']; ?></div></label>                            
                        </td>
                    </tr>
                    <tr>
                        <td width="150" height="27" align="right">
                            <label>Naturalidade:</label>
                        </td>
                        <td colspan='2'>
                            <label><div id="label_apresentado"><?php echo $registroFromPOST['naturalidade']; ?></div></label>                            
                        </td>
                    </tr>
                    <tr>
                        <td width="150" height="27" align="right">
                            <label>Nacionalidade:</label>
                        </td>
                        <td colspan='2'>
                            <label><div id="label_apresentado"><?php echo $registroFromPOST['nacionalidade']; ?></div></label>                            
                        </td>
                    </tr>
                    <tr>
                        <td width="150" height="27" align="right">
                            <label>UF:</label>
                        </td>
                        <td colspan='2'>
                            <label>
                                <div id="label_apresentado">
                                    <?php 
                                    foreach($allEstados as $estado) {
                                        if($registroFromPOST['id_estado_nasc'] == $estado['id_estado']) {
                                            echo $estado['sgl_estado'];  
                                            break;
                                        }
                                    }
                                    ?>
                                </div>
                            </label>                            
                        </td>
                    </tr>

                    <tr>
                        <td width="150" height="27" align='right'>
                            <label>Estado Civil:</label>
                        </td>
                    <td>
                        <label><div id="label_apresentado"><?php echo $registroFromPOST['estadocivil']; ?></div></label>                            
                    </td>                    
                    </tr>  
                    
                    <tr>
                        <td width="150" height="27" align="right">
                            <label for=conjuge>Conjuge:</label>
                        </td>
                        <td colspan='2'>
                            <label><div id="label_apresentado"><?php echo $registroFromPOST['conjuge']; ?></div></label>                            
                        </td>
                    </tr>
                    
                    <tr>
                        <td width="150" height="27" align="right">
                            <label>Nome do Pai:</label>
                        </td>
                        <td colspan='2'>
                            <label><div id="label_apresentado"><?php echo $registroFromPOST['nomepai']; ?></div></label>                            
                        </td>
                    </tr>
                    
                    <tr>
                        <td width="150" height="27" align="right">
                            <label>Nome da Mãe:</label>
                        </td>
                        <td colspan='2'>
                            <label><div id="label_apresentado"><?php echo $registroFromPOST['nomemae']; ?></div></label>                            
                        </td>
                    </tr>

                    <tr>
                        <td width="150" height="27" align="right">
                            <label>Endereço:</label>
                        </td>
                        <td colspan='2'>
                            <label><div id="label_apresentado"><?php echo $registroFromPOST['endresidencial']; ?></div></label>                            
                        </td>
                    </tr>

                    <tr>
                        <td width="150" height="27" align="right">
                            <label>Bairro:</label>
                        </td>
                        <td colspan='2'>
                            <label><div id="label_apresentado"><?php echo $registroFromPOST['bairro']; ?></div></label>                            
                        </td>
                    </tr>
                    <tr>
                        <td width="150" height="27" align="right">
                            <label>CEP:</label>
                        </td>
                        <td colspan='2'>
                            <label><div id="label_apresentado"><?php echo $registroFromPOST['cep']; ?></div></label>                            
                        </td>
                    </tr>                    
                    
                    <tr>
                        <td width="150" height="27" align="right">
                            <label>UF:</label>
                        </td>
                        <td colspan='2'>
                            <label>
                                <div id="label_apresentado">
                                    <?php 
                                    foreach($allEstados as $estado) {
                                        if($registroFromPOST['id_estado_atual'] == $estado['id_estado']) {
                                            echo $estado['sgl_estado'];  
                                            break;
                                        }
                                    }
                                    ?>
                                </div>
                            </label>                            
                        </td>
                    </tr>
                    <tr>
                        <td width="150" height="27" align="right">
                            <label>Cidade:</label>
                        </td>
                        <td colspan='2'>
                            <label style="text-transform:uppercase"><div id="label_apresentado"><?php echo $registroFromPOST['nome_cidade']; ?></div></label>                            
                        </td>
                    </tr> 

                    <tr>
                        <td width="150" height="27" align='right'>
                            <label>Telefone:</label>
                        </td>
                        <td>
                            <label><div id="label_apresentado"><?php echo $registroFromPOST['telefone']; ?></div></label>                            
                        </td>
                    </tr>

                    <tr>
                        <td width="150" height="27" align='right'>
                            <label>Celular:</label>
                        </td>
                        <td>
                            <label><div id="label_apresentado"><?php echo $registroFromPOST['celular']; ?></div></label>                            
                        </td>
                    </tr>

                    <tr>
                        <td width="150" height="27" align='right'>
                            <label>E-mail:</label>
                        </td>
                        <td>
                            <label><div id="label_apresentado"><?php echo $registroFromPOST['email']; ?></div></label>                            
                        </td>
                    </tr>
                
                    <tr>
                        <td height="28" align='right'></td>
                    </tr>
                
                </table>


            <table width="760" border="0" align='center' class="titulo-tabela">				
                <tr>                                
                    <td align="left">
                        <label><b>Caracteristicas Físicas</b></label>
                    </td>
                </tr>
            </table> 

            <table width="760" border="0" align='center' class="conteudo-tabela">
                <tr>
                    <td width="150" height="27" align="right">
                        <label>Grupo Sanguineo:</label>
                    </td>
                    <td colspan='2'>
                        <label><div id="label_apresentado"><?php echo $registroFromPOST['sangue']; ?></div></label>                            
                    </td>
                </tr> 

                <tr>
                    <td width="150" height="27" align="right">
                        <label>Fator RH:</label>
                    </td>
                    <td colspan='2'>
                        <label><div id="label_apresentado"><?php echo $registroFromPOST['fatorrh']; ?></div></label>                            
                    </td>                    
                </tr>
                
                <tr>
                    <td width="150" height="27" align="right">
                        <label>Cor:</label>
                    </td>
                    <td colspan='2'>
                        <label><div id="label_apresentado"><?php echo $registroFromPOST['cor']; ?></div></label>                            
                    </td>
                </tr>
                        
                <tr>
                    <td width="150" height="27" align='right'>
                        <label>Necessidade Especial:</label>
                    </td>
                    <td>
                        <label><div id="label_apresentado"><?php echo $registroFromPOST['necessidade_especial']; ?></div></label>                            
                    </td>
                </tr>

                <tr>
                    <td height="28" align='right'></td>
                </tr>
            </table>            

            <table width="760" border="0" align='center' class="titulo-tabela">				
                    <tr>                                
                        <td align="left">
                            <label><b>Documentos</b></label>
                        </td>
                    </tr>
                </table>

            <table width="760" border="0" align='center' class="conteudo-tabela">
                <tr>
                    <td width="150" height="27" align='right'>
                        <label for=cpf >CPF:</label>
                    </td>
                    <td colspan='2'>
                        <label><div id="label_apresentado"><?php echo $registroFromPOST['cpf']; ?></div></label>                            
                    </td>
                </tr>

                <tr>
                    <td width="150" height="27" align='right'>
                        <label>Pis/Pasep:</label>
                    </td>
                    <td>
                        <label><div id="label_apresentado"><?php echo $registroFromPOST['pispasep']; ?></div></label>                            
                    </td>
                </tr>
                
                <tr>
                    <td width="150" height="27" align='right'></td>
                </tr>

                  <tr>
                        <td width="150" height="27" align='right'>
                            <label>Certidão de Nascimento:</label>
                        </td>
                        <td>
                            <label><div id="label_apresentado"><?php echo $registroFromPOST['certidao_nascimentocasamento']; ?></div></label>                            
                        </td>
                    </tr>
                    
                    <tr>
                        <td width="150" height="27" align='right'>
                            <label>Folha:</label>
                        </td>
                        <td>
                            <label><div id="label_apresentado"><?php echo $registroFromPOST['certidao_nascimentocasamento_folha']; ?></div></label>                            
                        </td>
                    </tr>
                    
                    <tr>
                        <td width="150" height="27" align='right'>
                            <label>Livro:</label>
                        </td>
                        <td>
                            <label><div id="label_apresentado"><?php echo $registroFromPOST['certidao_nascimentocasamento_livro']; ?></div></label>                            
                        </td>
                    </tr>
                    
                    <tr>
                        <td width="150" height="27" align='right'></td>
                    </tr>
                    
                    <tr>
                        <td width="150" height="27" align='right'>
                            <label>RG:</label>
                        </td>
                        <td>
                            <label><div id="label_apresentado"><?php echo $registroFromPOST['rg']; ?></div></label>                            
                        </td>
                    </tr>
                    
                    <tr>
                        <td width="150" height="27" align='right'>
                            <label>Orgão Expeditor:</label>
                        </td>
                        <td>
                            <label><div id="label_apresentado"><?php echo $registroFromPOST['rg_orgaoexpeditor']; ?></div></label>                            
                        </td>
                    </tr>
                    
                    <tr>
                        <td width="150" height="27" align='right'>
                            <label>UF:</label>
                        </td>
                        <td>
                            <label>
                                <div id="label_apresentado">
                                <?php 
                                foreach($allEstados as $estado) {
                                    if($registroFromPOST['rg_id_estado'] == $estado['id_estado']) {
                                        echo $estado['sgl_estado'];  
                                        break;
                                    }
                                }
                                ?>
                                </div>
                            </label>                          
                        </td>
                    </tr>
                    
                    <tr>
                        <td width="150" height="27" align='right'>
                            <label>Data de Expedicao:</label>
                        </td>
                        <td>
                            <label><div id="label_apresentado"><?php echo $registroFromPOST['rg_dataexpedicao']; ?></div></label>                            
                        </td>
                    </tr>
                    
                    <tr>
                        <td width="150" height="27" align='right'></td>
                    </tr>
                    
                    <tr>
                        <td width="150" height="27" align='right'>
                            <label>Registro Profissional (conselho):</label>
                        </td>
                        <td>
                            <label><div id="label_apresentado"><?php echo $registroFromPOST['registroprofissional']; ?></div></label>                            
                        </td>
                    </tr>
                    
                    <tr>
                        <td width="150" height="27" align='right'>
                            <label>Orgão Expeditor:</label>
                        </td>
                        <td>
                            <label><div id="label_apresentado"><?php echo $registroFromPOST['registroprofissional_orgaoexpeditor']; ?></div></label>                            
                        </td>
                    </tr>
                    
                    <tr>
                        <td width="150" height="27" align='right'>
                            <label>UF:</label>
                        </td>
                        <td>
                            <label>
                                <div id="label_apresentado">
                                <?php 
                                foreach($allEstados as $estado) {
                                    if($registroFromPOST['registroprofissional_id_estado'] == $estado['id_estado']) {
                                        echo $estado['sgl_estado'];  
                                        break;
                                    }
                                }
                                ?>
                                </div>
                            </label>   
                        </td>
                    </tr>
                    
                    <tr>
                        <td width="150" height="27" align='right'>
                            <label>Data de Expedição:</label>
                    </td>
                        <td>
                            <label><div id="label_apresentado"><?php echo $registroFromPOST['registroprofissional_dataexpedicao']; ?></div></label>                            
                        </td>
                    </tr>
                    
                    <tr>
                        <td width="150" height="27" align='right'></td>
                    </tr>
                        
                     <tr>
                         <td width="150" height="27" align='right'>
                             <label>Título de eleitor:</label>
                         </td>
                        <td>
                            <label><div id="label_apresentado"><?php echo $registroFromPOST['tituloeleitor']; ?></div></label>                            
                        </td>
                    </tr>
                        
                    <tr>
                        <td width="150" height="27" align='right'>
                            <label>Zona:</label>
                        </td>
                        <td>
                            <label><div id="label_apresentado"><?php echo $registroFromPOST['tituloeleitor_zona']; ?></div></label>                            
                        </td>
                    </tr>
                        
                        <tr>
                            <td width="150" height="27" align='right'>
                                <label>Seção:</label>
                            </td>
                            <td>
                                <label><div id="label_apresentado"><?php echo $registroFromPOST['tituloeleitor_secao']; ?></div></label>                            
                            </td>
                        </tr>
                        
                        <tr>
                            <td width="150" height="27" align='right'>
                                <label>Local:</label>
                            </td>
                            <td>
                                <label><div id="label_apresentado"><?php echo $registroFromPOST['tituloeleitor_local']; ?></div></label>                            
                            </td>
                        </tr>
                        
                        <tr>
                            <td width="150" height="27" align='right'>
                                <label>Data de Expedição:</label>
                            </td>
                            <td>
                                <label><div id="label_apresentado"><?php echo $registroFromPOST['tituloeleitor_dataexpedicao']; ?></div></label>                            
                            </td>
                        </tr>
                        
                        <tr>
                            <td width="150" height="27" align='right'></td>
                        </tr>

                        <tr>
                            <td width="150" height="27" align='right'>
                                <label>Certificado de Reservista:</label>
                            </td>
                            <td>
                                <label><div id="label_apresentado"><?php echo $registroFromPOST['reservista']; ?></div></label>                            
                            </td>
                        </tr>
                        
                        <tr>
                            <td width="150" height="27" align='right'>
                                <label>Orgão Expeditor:</label>
                            </td>
                            <td>
                                <label><div id="label_apresentado"><?php echo $registroFromPOST['reservista_orgaoexpeditor']; ?></div></label>                            
                            </td>
                        </tr>

                        <tr>
                            <td width="150" height="27" align='right'>
                                <label>Série:</label>
                            </td>
                            <td>
                                <label><div id="label_apresentado"><?php echo $registroFromPOST['reservista_serie']; ?></div></label>                            
                            </td>
                        </tr>
                        
                        <tr>
                            <td width="150" height="27" align='right'></td>
                        </tr>
                        
                        <tr>
                            <td width="150" height="27" align='right'>
                                <label>Data do primeiro emprego:</label>
                            </td>
                            <td>
                                <label><div id="label_apresentado"><?php echo $registroFromPOST['dataprimeiroemprego']; ?></div></label>                            
                            </td>
                        </tr>
                        
                        <tr>
                            <td width="150" height="27" align='right'>
                                <label>Número do banco:</label>
                            </td>
                            <td>
                                <label><div id="label_apresentado"><?php echo $registroFromPOST['numerobanco']; ?></div></label>                            
                            </td>
                        </tr>
                            
                        <tr>
                            <td width="150" height="27" align='right'>
                                <label>Nome do Banco:</label>
                            </td>
                            <td>
                                <label><div id="label_apresentado"><?php echo $registroFromPOST['nomebanco']; ?></div></label>                            
                            </td>
                        </tr>
                            
                        <tr>
                            <td width="150" height="27" align='right'>
                                <label for=agencia>Agência:</label>
                            </td>
                            <td>
                                <label><div id="label_apresentado"><?php echo $registroFromPOST['agencia']; ?></div></label>                            
                            </td>
                        </tr>
                        
                        <tr>
                            <td width="150" height="27" align='right'>
                                <label for=conta>Conta:</label>
                            </td>
                            <td>
                                <label><div id="label_apresentado"><?php echo $registroFromPOST['conta']; ?></div></label>                            
                            </td>
                        </tr>

                        <tr>
                            <td width="150" height="27" align='right'></td>
                        </tr>
                   </table>  



            <table width="760" border="0" align='center' class="titulo-tabela">				
                <tr>                                
                    <td align="left">
                        <label><b>Dados Funcionais</b></label>
                    </td>
                </tr>
            </table>

            <table width="760" border="0" align='center' class="conteudo-tabela">

                <tr>
                    <td width="150" height="27" align='right'>
                        <label for=cargoFuncao>Cargo/Função:</label>
                    </td>
                    <td>
                        <label><div id="label_apresentado"><?php echo $registroFromPOST['cargofuncao']; ?></div></label>                            
                    </td>
                </tr>
                
                <tr>
                    <td width="150" height="27" align='right'>
                        <label for=codigoFuncao>Código:</label>
                    </td>
                    <td>
                        <label><div id="label_apresentado"><?php echo $registroFromPOST['codigofuncao']; ?></div></label>                            
                    </td>
                </tr>
                                
                <tr>
                    <td width="150" height="27" align='right'>
                        <label for=padrao>Padrão:</label>
                    </td>
                    <td>
                        <label><div id="label_apresentado"><?php echo $registroFromPOST['padrao']; ?></div></label>                            
                    </td>
                </tr>
                
                <tr>
                    <td width="150" height="27" align='right'>
                        <label>Portaria Nomeação (número):</label>
                    </td>
                    <td>
                        <label><div id="label_apresentado"><?php echo $registroFromPOST['portaria_nomeacao_numero']; ?></div></label>                            
                    </td>
                </tr>
                                
                <tr>
                    <td width="150" height="27" align='right'>
                        <label>Portaria nomeação (data):</label>
                    </td>
                    <td>
                        <label><div id="label_apresentado"><?php echo $registroFromPOST['portaria_nomeacao_data']; ?></div></label>                            
                    </td>
                </tr>
                
                    <tr>
                        <td width="150" height="27" align='right'>
                            <label>Data de publicação:</label>
                        </td>
                        <td>
                            <label><div id="label_apresentado"><?php echo $registroFromPOST['data_publicacao']; ?></div></label>                            
                        </td>
                    </tr>
                    
                    <tr>
                        <td width="150" height="27" align='right'>
                            <label>Data da posse:</label>
                        </td>
                        <td>
                            <label><div id="label_apresentado"><?php echo $registroFromPOST['data_posse']; ?></div></label>                            
                        </td>
                    </tr>
                    
                    <tr>
                        <td width="150" height="27" align='right'>
                            <label for=dataExercicio>Data de exercício:</label>
                        </td>
                        <td>
                            <label><div id="label_apresentado"><?php echo $registroFromPOST['data_exercicio']; ?></div></label>                            
                        </td>
                    </tr>

                    <tr>
                        <td width="150" height="27" align='right'></td>
                    </tr>
                    
            </table>



            <table width="760" border="0" align='center' class="titulo-tabela">				
                <tr>                                
                    <td align="left">
                        <label><b>Títulos acadêmicos</b></label>
                    </td>
                </tr>
            </table>
                
            <table width="760" border="0" align='center' class="conteudo-tabela">
                
                <!-- segundo grau -->
                
                <tr>
                    <td width="150" height="27" align='right'>
                        <label>Segundo grau:</label>
                    </td>
                    <td>
                        <label><div id="label_apresentado"><?php echo $registroFromPOST['segundograu']; ?></div></label>                            
                    </td>
                </tr>
                
                <tr>
                    <td width="150" height="27" align='right'>
                        <label>Instituição:</label>
                    </td>
                    <td>
                        <label><div id="label_apresentado"><?php echo $registroFromPOST['segundograu_instituicao']; ?></div></label>                            
                    </td>
                </tr>

                <!-- linha vazia --> 
                <tr>
                    <td height="27" align='left'></td>
                </tr>
                
                <!-- terceiro grau -->
                
                <tr>
                    <td width="150" height="27" align='right'>
                        <label>Terceiro grau:</label>
                    </td>
                    <td>
                        <label><div id="label_apresentado"><?php echo $registroFromPOST['terceirograu']; ?></div></label>                            
                    </td>
                </tr>
                
                <tr>
                    <td width="150" height="27" align='right'>
                        <label>Instituição:</label>
                    </td>
                    <td>
                        <label><div id="label_apresentado"><?php echo $registroFromPOST['terceirograu_instituicao']; ?></div></label>                            
                    </td>
                </tr>
                
                <!-- linha vazia --> 
                <tr>
                    <td height="27" align='left'></td>
                </tr>
                
                <!-- pos graduacao 1 -->
                
                <tr>
                    <td width="150" height="27" align='right'>
                        <label>Pós-graduação 1:</label>
                    </td>
                    <td>
                        <label><div id="label_apresentado"><?php echo $registroFromPOST['posgraduacao1_tipo']; ?></div></label>                            
                    </td>
                </tr>
                
                <tr>
                    <td width="150" height="27" align='right'>
                        <label>Situação:</label>
                    </td>
                    <td>
                        <label><div id="label_apresentado"><?php echo $registroFromPOST['posgraduacao1_situacao']; ?></div></label>
                    </td>
                </tr>
                
                <tr>
                    <td width="150" height="27" align='right'>
                        <label>Curso:</label>
                    </td>
                    <td>
                        <label><div id="label_apresentado"><?php echo $registroFromPOST['posgraduacao1_curso']; ?></div></label>
                    </td>
                </tr>
                
                <tr>
                    <td width="150" height="27" align='right'>
                        <label>Instituição:</label>
                    </td>
                    <td>
                        <label><div id="label_apresentado"><?php echo $registroFromPOST['posgraduacao1_instituicao']; ?></div></label>
                    </td>
                </tr>
                
                <tr>
                    <td width="150" height="27" align='right'>
                        <label>Carga horária:</label>
                    </td>
                    <td>
                        <label><div id="label_apresentado"><?php echo $registroFromPOST['posgraduacao1_cargahoraria']; ?></div></label>
                    </td>
                </tr>
                
                <tr>
                    <td width="150" height="27" align='right'>
                        <label>Data de conclusão:</label>
                    </td>
                    <td>
                        <label><div id="label_apresentado"><?php echo $registroFromPOST['posgraduacao1_dataconclusao']; ?></div></label>
                    </td>
                </tr>
                
                <!-- linha vazia --> 
                <tr>
                    <td height="27" align='left'></td>
                </tr>
                
                <!-- pos graduacao 2 -->
                
                <tr>
                    <td width="150" height="27" align='right'>
                        <label>Pós-graduação 2:</label>
                    </td>
                    <td>
                        <label><div id="label_apresentado"><?php echo $registroFromPOST['posgraduacao2_tipo']; ?></div></label>
                    </td>
                </tr>
                
                <tr>
                    <td width="150" height="27" align='right'>
                        <label>Situação:</label>
                    </td>
                    <td>
                        <label><div id="label_apresentado"><?php echo $registroFromPOST['posgraduacao2_situacao']; ?></div></label>
                    </td>
                </tr>
                
                <tr>
                    <td width="150" height="27" align='right'>
                        <label>Curso:</label>
                    </td>
                    <td>
                        <label><div id="label_apresentado"><?php echo $registroFromPOST['posgraduacao2_curso']; ?></div></label>
                    </td>
                </tr>
                
                <tr>
                    <td width="150" height="27" align='right'>
                        <label>Instituição:</label>
                    </td>
                    <td>
                        <label><div id="label_apresentado"><?php echo $registroFromPOST['posgraduacao2_instituicao']; ?></div></label>
                    </td>
                </tr>
                
                <tr>
                    <td width="150" height="27" align='right'>
                        <label>Carga horária:</label>
                    </td>
                    <td>
                        <label><div id="label_apresentado"><?php echo $registroFromPOST['posgraduacao2_cargahoraria']; ?></div></label>
                    </td>
                </tr>
                
                <tr>
                    <td width="150" height="27" align='right'>
                        <label>Data de conclusão:</label>
                    </td>
                    <td>
                        <label><div id="label_apresentado"><?php echo $registroFromPOST['posgraduacao2_dataconclusao']; ?></div></label>
                    </td>
                </tr>
                
                <!-- linha vazia --> 
                <tr>
                    <td height="27" align='left'></td>
                </tr>
                
                <!-- pos graduacao 3 -->
                
                <tr>
                    <td width="150" height="27" align='right'>
                        <label>Pós-graduação 3:</label>
                    </td>
                    <td>
                        <label><div id="label_apresentado"><?php echo $registroFromPOST['posgraduacao3_tipo']; ?></div></label>
                    </td>
                </tr>
                
                <tr>
                    <td width="150" height="27" align='right'>
                        <label>Situação:</label>
                    </td>
                    <td>
                        <label><div id="label_apresentado"><?php echo $registroFromPOST['posgraduacao3_situacao']; ?></div></label>
                    </td>
                </tr>
                
                <tr>
                    <td width="150" height="27" align='right'>
                        <label>Curso:</label>
                    </td>
                    <td>
                        <label><div id="label_apresentado"><?php echo $registroFromPOST['posgraduacao3_curso']; ?></div></label>
                    </td>
                </tr>
                
                <tr>
                    <td width="150" height="27" align='right'>
                        <label>Instituição:</label>
                    </td>
                    <td>
                        <label><div id="label_apresentado"><?php echo $registroFromPOST['posgraduacao3_instituicao']; ?></div></label>
                    </td>
                </tr>
                
                <tr>
                    <td width="150" height="27" align='right'>
                        <label>Carga horária:</label>
                    </td>
                    <td>
                        <label><div id="label_apresentado"><?php echo $registroFromPOST['posgraduacao3_cargahoraria']; ?></div></label>
                    </td>
                </tr>
                
                <tr>
                    <td width="150" height="27" align='right'>
                        <label>Data de conclusão:</label>
                    </td>
                    <td>
                        <label><div id="label_apresentado"><?php echo $registroFromPOST['posgraduacao3_dataconclusao']; ?></div></label>
                    </td>
                </tr>
                
                <!-- linha vazia --> 
                <tr>
                    <td height="27" align='left'></td>
                </tr>
                
                <!-- pos graduacao 4 -->
                
                <tr>
                    <td width="150" height="27" align='right'>
                        <label>Pós-graduação 4:</label>
                    </td>
                    <td>
                        <label><div id="label_apresentado"><?php echo $registroFromPOST['posgraduacao4_tipo']; ?></div></label>
                    </td>
                </tr>
                
                <tr>
                    <td width="150" height="27" align='right'>
                        <label>Situação:</label>
                    </td>
                    <td>
                        <label><div id="label_apresentado"><?php echo $registroFromPOST['posgraduacao4_situacao']; ?></div></label>
                    </td>
                </tr>
                
                <tr>
                    <td width="150" height="27" align='right'>
                        <label>Curso:</label>
                    </td>
                    <td>
                        <label><div id="label_apresentado"><?php echo $registroFromPOST['posgraduacao4_curso']; ?></div></label>
                    </td>
                </tr>
                
                <tr>
                    <td width="150" height="27" align='right'>
                        <label>Instituição:</label>
                    </td>
                    <td>
                        <label><div id="label_apresentado"><?php echo $registroFromPOST['posgraduacao4_instituicao']; ?></div></label>
                    </td>
                </tr>
                
                <tr>
                    <td width="150" height="27" align='right'>
                        <label>Carga horária:</label>
                    </td>
                    <td>
                        <label><div id="label_apresentado"><?php echo $registroFromPOST['posgraduacao4_cargahoraria']; ?></div></label>
                    </td>
                </tr>
                
                <tr>
                    <td width="150" height="27" align='right'>
                        <label>Data de conclusão:</label>
                    </td>
                    <td>
                        <label><div id="label_apresentado"><?php echo $registroFromPOST['posgraduacao4_dataconclusao']; ?></div></label>
                    </td>
                </tr>
                
                <!-- linha vazia --> 
                <tr>
                    <td height="27" align='left'></td>
                </tr>
                
            </table>    


        <table width="760" border="0" align='center' class="titulo-tabela">				
            <tr>                                
                <td align="left">
                    <label for=idiomas><b>Idiomas</b></label>
                </td>
            </tr>
        </table>  
            
    <table width="760" border="0" align='center' class="conteudo-tabela">
                
        <!-- IDIOMA 1 -->
        
        <tr>
            <td width='152' height='27' align='left'>
                <label>Idioma:</label>
                <label class="label_apresentado"><?php echo $registroFromPOST['idioma1']; ?></label>
            </td>

        <!-- idioma leitura--> 

            <td width='152' height='27' align='left'>
                <label>Leitura:</label>
                <label class="label_apresentado"><?php echo $registroFromPOST['idioma1_leitura']; ?></label>
            </td>

        <!-- idioma fala--> 

            <td width='152' height='27' align='left'>
                <label>Fala:</label>
                <label class="label_apresentado"><?php echo $registroFromPOST['idioma1_fala']; ?></label>
            </td>

        <!-- idioma escrita-->
        
            <td width='152' height='27' align='left'>
                <label>Escrita:</label>
                <label class="label_apresentado"><?php echo $registroFromPOST['idioma1_escrita']; ?></label>
            </td>
        </tr>
        
        
        <!-- IDIOMA 2 -->
        
        <tr>
            <!-- idioma --> 
            <td width='152' height='27' align='left' >
                <label>Idioma:</label>
                <label class="label_apresentado"><?php echo $registroFromPOST['idioma2']; ?></label>
            </td>

        <!-- idioma leitura--> 

            <td width='152' height='27' align='left'>
                <label>Leitura:</label>
                <label class="label_apresentado"><?php echo $registroFromPOST['idioma2_leitura']; ?></label>
            </td>

        <!-- idioma fala--> 

            <td width='152' height='27' align='left'>
                <label>Fala:</label>
                <label class="label_apresentado"><?php echo $registroFromPOST['idioma2_fala']; ?></label>
            </td>

        <!-- idioma escrita-->
        
            <td width='152' height='27' align='left'>
                <label>Escrita:</label>
                <label class="label_apresentado"><?php echo $registroFromPOST['idioma2_escrita']; ?></label>
            </td>
        </tr>
        
        <!-- IDIOMA 3 -->
        
        <tr>
            <!-- idioma --> 
            <td width='152' height='27' align='left'>
                <label>Idioma:</label>
                <label class="label_apresentado"><?php echo $registroFromPOST['idioma3']; ?></label>
            </td>

        <!-- idioma leitura--> 

            <td width='152' height='27' align='left'>
                <label>Leitura:</label>
                <label class="label_apresentado"><?php echo $registroFromPOST['idioma3_leitura']; ?></label>
            </td>

        <!-- idioma fala--> 

            <td width='152' height='27' align='left'>
                <label>Fala:</label>
                <label class="label_apresentado"><?php echo $registroFromPOST['idioma3_fala']; ?></label>
            </td>

        <!-- idioma escrita-->
        
            <td width='152' height='27' align='left'>
                <label>Escrita:</label>
                <label class="label_apresentado"><?php echo $registroFromPOST['idioma3_escrita']; ?></label>
            </td>
        </tr>
        
        <!-- IDIOMA 4 -->
        
        <tr>
            <!-- idioma --> 
            <td width='152' height='27' align='left'>
                <label>Idioma:</label>
                <label class="label_apresentado"><?php echo $registroFromPOST['idioma4']; ?></label>
            </td>

        <!-- idioma leitura--> 

            <td width='152' height='27' align='left'>
                <label>Leitura:</label>
                <label class="label_apresentado"><?php echo $registroFromPOST['idioma4_leitura']; ?></label>
            </td>

        <!-- idioma fala--> 

            <td width='152' height='27' align='left'>
                <label>Fala:</label>
                <label class="label_apresentado"><?php echo $registroFromPOST['idioma4_fala']; ?></label>
            </td>

        <!-- idioma escrita-->
        
            <td width='152' height='27' align='left'>
                <label>Escrita:</label>
                <label class="label_apresentado"><?php echo $registroFromPOST['idioma4_escrita']; ?></label>
            </td>
        </tr> 
    </table>


            <table width="760" border="0" align='center' class="titulo-tabela">				
                <tr>                                
                    <td align="left">
                        <label for=declaracao><b>Declara&ccedil;&atilde;o</b></label>
                    </td>
                </tr>
            </table>                   

        

            <table width="760" border="0" align='center' class="conteudo-tabela">
                <tr>
                    <td width="30" height="27" align='center'>
                        <input type="checkbox" name="declaracao" id="declaracao" value="1"/>
                    </td>
                    <td>
                        <label for=declaracao><b>Declaro, sob a minha inteira responsabilidade, serem exatas e verdadeiras as informa&ccedil;&otilde;es que prestei no presente formul&aacute;rio, comprometendo-me comunicar &agrave; Diretoria de Gest&atilde;o de Pessoas - DGP desta institui&ccedil;&atilde;o, quaisquer altera&ccedil;&otilde;es que houverem.</b></label>
                    </td>
                </tr>  

                
                <tr>
                    <td>
                        <input name="Confirmar" type="button" id="Confirmar" value="Confirmar" onclick="validar_declaracao();"/>
                    </td>
                    <td>
                        <input type="button" value="Voltar" onclick="voltar(1);" />
                    </td>
                </tr>

            </table>   
        


        
        </div>
        
        <?php require_once("statics/rodape.php"); ?>
        	
        <!-- </div> -->
    </body>
    
    
    
</html>

<?php   
        } else {    // nenhuma alteracao foi feita
            
            // desligando a flag. bloqueando novo acesso a esta pessoa
            
            echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\" />
                <script>
                   location.href = '../../controller/confirmacao_de_acesso/confirmar.php';      
                    </script>";  
        }

} else {    // veio de fora
    
    echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\" />
                 <script>alert(\"Não acesse este arquivo diretamente!\");  
                   location.href = \"../../index.php\";      
                    </script>";        
}  

?>





    