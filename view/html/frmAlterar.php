<?php 
session_start();
//var_dump($_SESSION);

require_once '../../controller/Solicitacoes.php';

if($_SESSION['permiteAlterar'] == true) {
    
    $registro = $_SESSION['registroFromBanco'];
    $allEstados = $_SESSION['allEstados']; 
    
    //print_r($registro);exit;
    
?>

<!DOCTYPE html>
<html>
    <head>
        
        <title>Censo</title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<link href="statics/css/estilo.css" rel="stylesheet" type="text/css" />
        
        <script type="text/JavaScript" src="../js/scripts.php"></script>
        
    </head>
    <body>
             
        <?php require_once("statics/cabecalho.php"); ?>
            
            
        <div id="conteudo">            
            <p class="titulo-formulario">CENSO 2011</p>
            <p></p>  
            
            <form id='formAlterar' name='formAlterar' action='../../controller/alteracao/alterar2.php' method='post' onsubmit="return validar_frmAlterar();" >
                
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
                            <label for=nome>Nome:</label>
                        </td>
                        <td colspan='2'>
                            <input type="hidden" id="id_pessoa" name="id_pessoa" value="<?php echo $registro['id_pessoa']; ?>" />
                            <input style="text-transform:uppercase" name="nome" id="nome" onfocus="javascript:somenteLeitura('nome');"  value="<?php echo $registro['nome']; ?>" type="text" size='65' maxlength="60" alt="Nome Completo" />                            
                        </td>
                    </tr>                

                    <tr>
                        <td width="150" height="27" align="right">
                            <label for=siape>Matrícula SIAPE:</label></td>
                        <td colspan='2'>
                            <input  name="siape" id="siape" onfocus="javascript:somenteLeitura('siape');" onkeypress="javascript:return Onlynumber(event);" value="<?php echo $registro['siape']; ?>" size='20' maxlength="12" alt="Matrícula SIAPE" />
                        </td>
                    </tr>	

                    <tr>
                        <td width="150" height="27" align='right'>
                            <label for=sexo>Sexo:</label>
                        </td>
                        <td>
                            <select name="sexo" id="sexo">
                                <?php 
                                    echo("	<option value=''></option>\n");
                                    
                                    if ($registro['sexo'] == "MASCULINO") {                                            
                                            echo("	<option selected value='MASCULINO'>MASCULINO</option>\n");
                                            echo("	<option value='FEMININO'>FEMININO</option>\n");
                                    } else if ($registro['sexo'] == "FEMININO") {                                            
                                            echo("	<option value='MASCULINO'>MASCULINO</option>\n");
                                            echo("	<option selected value='FEMININO'>FEMININO</option>\n");
                                    } else {                                            
                                            echo("	<option value='MASCULINO'>MASCULINO</option>\n");
                                            echo("	<option value='FEMININO'>FEMININO</option>\n");
                                    }                             
                                ?>
                             </select>
                        </td>
                    </tr>

                    <tr>
                        <td width="150" height="27" align='right'>
                            <label>Data de Nascimento:</label>
                        </td>
                        <td>
                            <input name="datanascimento" id="datanascimento" type="text" size="13" maxlength="10" value="<?php echo $registro['datanascimento']; ?>" alt="Data de Nascimento" onkeypress="Mascara('DATA',this,event); return Onlynumber(event);" />
                        </td>
                    </tr>
                    <tr>
                        <td width="150" height="27" align="right">
                            <label for=naturalidade>Naturalidade:</label>
                        </td>
                        <td colspan='2'>
                            <input style="text-transform:uppercase" name="naturalidade" id="naturalidade" type="text" value="<?php echo $registro['naturalidade']; ?>" size='30' maxlength="60" alt="Naturalidade" />
                        </td>
                    </tr>
                    
                    <tr>
                        <td width="150" height="27" align="right">
                            <label>UF:</label>
                        </td>
                        <td colspan='2'>
                            <!-- <input type="hidden" id="sgl_estado_nasc" name="sgl_estado_nasc" value="<?php //echo $registro['sgl_estado_nasc']; ?>" /> -->
                            <select name="id_estado_nasc" id="id_estado_nasc" >
                                <?php
                                    echo('	<option value=""></option>\n'); // padrao em branco
                                    foreach($allEstados as $estado) {
                                        if ($estado['id_estado'] != $registro['id_estado_nasc']) {
                                            echo("	<option value='".$estado['id_estado']."'>".$estado['sgl_estado']."</option>\n");
                                        } else {
                                            echo("	<option selected value='".$estado['id_estado']."'>".$estado['sgl_estado']."</option>\n");
                                        }
                                    }
                                ?>
                            </select>
                        </td>
                    </tr>
                    
                    <tr>
                        <td width="150" height="27" align="right">
                            <label>Nacionalidade:</label>
                        </td>
                        <td colspan='2'>
                            <input style="text-transform:uppercase" name="nacionalidade" id="nacionalidade" type="text" value="<?php echo $registro['nacionalidade']; ?>" size='30' maxlength="60" alt="Nacionalidade" />
                        </td>
                    </tr>
                    
                    <tr>
                        <td width="150" height="27" align='right'>
                            <label>Estado Civil:</label>
                        </td>
                    <td>
                        <select name="estadocivil" id="estadocivil" >
                            <?php
                                $estadocivil = array("SOLTEIRO","CASADO","VIÚVO","SEPARADO","DIVORCIADO", "UNIÃO ESTÁVEL");

                                $total = count($estadocivil);
                                $i = 0;
                                echo("	<option value=''></option>\n"); // padrao em branco
                                while ($total > $i) {
                                    if ($estadocivil[$i] != $registro['estadocivil']) {
                                            echo("	<option value='$estadocivil[$i]'>$estadocivil[$i]</option>\n");
                                    } else {
                                            echo("	<option selected value='$estadocivil[$i]'>$estadocivil[$i]</option>\n");
                                    }
                                    $i++;
                                }
                            ?>
                         </select>
                    </td>
                    </tr> 
                    
                    <tr>
                        <td width="150" height="27" align="right">
                            <label>Conjuge:</label>
                        </td>
                        <td colspan='2'>
                            <input style="text-transform:uppercase" name="conjuge" value="<?php echo $registro['conjuge']; ?>"  id="conjuge" type="text" size='65' maxlength="60" alt="Conjuge"/>
                        </td>
                    </tr>   
                    
                    <tr>
                        <td width="150" height="27" align="right">
                            <label>Nome do Pai:</label>
                        </td>
                        <td colspan='2'>
                            <input style="text-transform:uppercase" name="nomepai" id="nomepai" value="<?php echo $registro['nomepai']; ?>" type="text" size='65' maxlength="60" alt="Nome do pai"/>
                        </td>
                    </tr>
                    <tr>
                        <td width="150" height="27" align="right">
                            <label>Nome da Mãe:</label>
                        </td>
                        <td colspan='2'>
                            <input style="text-transform:uppercase" name="nomemae" id="nomemae" value="<?php echo $registro['nomemae']; ?>" type="text" size='65' maxlength="60" alt="Nome da Mãe"/>
                        </td>
                    </tr>

                    <tr>
                        <td width="150" height="27" align="right">
                            <label>Endereço:</label>
                        </td>
                        <td colspan='2'>
                            <input style="text-transform:uppercase" name="endresidencial" id="endresidencial" value="<?php echo $registro['endresidencial']; ?>" type="text" size='75' maxlength="70" alt="Endereço"/>
                        </td>
                    </tr>

                    <tr>
                        <td width="150" height="27" align="right">
                            <label>Bairro:</label>
                        </td>
                        <td colspan='2'>
                            <input style="text-transform:uppercase" name="bairro" id="bairro" value="<?php echo $registro['bairro']; ?>" type="text" size='50' maxlength="50" alt="Bairro"/>
                            &nbsp;&nbsp;<label for=cep>CEP:</label>&nbsp;&nbsp;
                            <input name="cep" type="text" id="cep" value="<?php echo $registro['cep']; ?>" onkeypress="Mascara('CEP',this,event); return Onlynumber(event);" size="12" maxlength="8" alt="CEP" />
                        </td>
                    </tr>                    
                    
                    <tr>
                        <td width="150" height="27" align="right">
                            <label>UF:</label>
                        </td>
                        <td colspan='2'>
                            <!-- <input type="hidden" id="sgl_estado_atual" name="sgl_estado_atual" value="<?php //echo $registro['sgl_estado_atual']; ?>" /> -->
                            <select name="id_estado_atual" id="id_estado_atual" >
                                <?php
                                    echo('	<option value=""></option>\n'); // padrao em branco
                                    foreach($allEstados as $estado) {
                                        if ($estado['id_estado'] != $registro['id_estado_atual']) {
                                            echo("	<option value='".$estado['id_estado']."'>".$estado['sgl_estado']."</option>\n");
                                        } else {
                                            echo("	<option selected value='".$estado['id_estado']."'>".$estado['sgl_estado']."</option>\n");
                                        }
                                    }
                                ?>
                            </select>
                            &nbsp;&nbsp;
                            <label>Cidade</label>
                            <!-- <input type="hidden" id="nome_cidade" name="nome_cidade" value="<?php //echo $registro['nome_cidade']; ?>" /> -->
                            <select name="id_cidade" id="id_cidade">
                                <?php
                                    echo("	<option selected value='".$registro['id_cidade']."'>".$registro['nome_cidade']."</option>\n");
                                ?>
                            </select>                            
                        </td>
                    </tr> 

                    <tr>
                        <td width="150" height="27" align='right'>
                            <label>Telefone:</label>
                        </td>
                        <td>
                            <input name="telefone" id="telefone" value="<?php echo $registro['telefone']; ?>" type="text" size="20" maxlength="14" alt="Telefone"  onkeypress="Mascara('TEL',this,event); return Onlynumber(event);" />
                        </td>
                    </tr>

                    <tr>
                        <td width="150" height="27" align='right'>
                            <label>Celular:</label>
                        </td>
                        <td>
                            <input name="celular" id="celular" value="<?php echo $registro['celular']; ?>" type="text" size="20" maxlength="14" alt="Celular" onkeypress="Mascara('TEL',this,event); return Onlynumber(event);" />
                        </td>
                    </tr>

                    <tr>
                        <td width="150" height="27" align='right'>
                            <label for=email>E-mail:</label>
                        </td>
                        <td>
                            <input style="text-transform:lowercase" name="email" id="email" value="<?php echo $registro['email']; ?>" type="text" size="20" maxlength="50" alt="E-mail" onkeypress="return NotSpecialCaracteres(event);"/>
                            <select name="email_dominio" id="email_dominio">
                            <?php
                                $email_dominio = array(
                                    "@ifbaiano.edu.br",
                                    "@bonfim.ifbaiano.edu.br",
                                    "@catu.ifbaiano.edu.br",
                                    "@guanambi.ifbaiano.edu.br",
                                    "@itapetinga.ifbaiano.edu.br",
                                    "@lapa.ifbaiano.edu.br",
                                    "@mangabeira.ifbaiano.edu.br",
                                    "@si.ifbaiano.edu.br",
                                    "@teixeira.ifbaiano.edu.br",
                                    "@urucuca.ifbaiano.edu.br",
                                    "@valenca.ifbaiano.edu.br"
                                    );

                                $total = count($email_dominio);
                                for($i=0; $i<$total; $i++) {
                                    if ($email_dominio[$i] != $registro['email_dominio']) {
                                        echo("	<option value='$email_dominio[$i]'>$email_dominio[$i]</option>\n");
                                    } else {
                                        echo("	<option selected value='$email_dominio[$i]'>$email_dominio[$i]</option>\n");
                                    }
                                }
                            ?>
                        </select>
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
                        <select name="sangue" id="sangue">
                            <?php
                                $sangue = array("A","B","AB","O");

                                $total = count($sangue);
                                echo("	<option value=''></option>\n"); // padrao em branco
                                for($i=0; $i<$total; $i++) {
                                    if ($sangue[$i] != $registro['sangue']) {
                                        echo("	<option value='$sangue[$i]'>$sangue[$i]</option>\n");
                                    } else {
                                        echo("	<option selected value='$sangue[$i]'>$sangue[$i]</option>\n");
                                    }
                                }
                            ?>
                        </select>
                    </td>
                </tr> 

                <tr>
                    <td width="150" height="27" align="right">
                        <label>Fator RH:</label>
                    </td>
                        <td colspan='2'>
                            <select name="fatorrh" id="fatorrh" >
                                <?php
                                    echo("	<option value=''></option>\n");
                                    
                                    if ($registro['fatorrh'] == "+") {                                            
                                            echo("	<option selected value='+'>POSITIVO</option>\n");
                                            echo("	<option value='-'>NEGATIVO</option>\n");
                                    } else if ($registro['fatorrh'] == "-") {                                            
                                            echo("	<option value='+'>POSITIVO</option>\n");
                                            echo("	<option selected value='-'>NEGATIVO</option>\n");
                                    } else {                                            
                                            echo("	<option value='+'>POSITIVO</option>\n");
                                            echo("	<option value='-'>NEGATIVO</option>\n");
                                    }   
                            ?>
                            </select>
                    </td>
                </tr>
                    <tr>
                        <td width="150" height="27" align="right">
                            <label>Cor:</label>
                        </td>
                            <td colspan='2'>
                                <select name="cor" id="cor" >
                                    <?php
                                        $cor = array("BRANCA","NEGRA","AMARELA","PARDA","INDÍGENA");

                                        $total = count($cor);
                                        echo("	<option value=''></option>\n"); // padrao em branco
                                        for($i=0; $i<$total; $i++) {
                                            if ($cor[$i] != $registro['cor']) {
                                                echo("	<option value='$cor[$i]'>$cor[$i]</option>\n");
                                            } else {
                                                echo("	<option selected value='$cor[$i]'>$cor[$i]</option>\n");
                                            }
                                        }
                                    ?>
                                </select>
                            </td>
                        </tr>
                        
                        <tr>
                            <td width="150" height="27" align='right'>
                                <label>Necessidade Especial:</label>
                            </td>
                            <td>
                                <select name="necessidade_especial" id="necessidade_especial" onchange="javascript:necessidadeEspecial()">
                                    <?php 
                                    
                                        $necessidade_especial = array('VISUAL - CEGUEIRA', 'VISUAL - BAIXA VISÃO', 'MOTORA', 'AUDITIVA', 'MÚLTIPLAS', 'OUTRA');

                                        $total = count($necessidade_especial);
                                        
                                        $achou = false;
                                        
                                        echo("	<option value=''></option>\n"); // padrao em branco
                                        for($i=0; $i<$total; $i++) {
                                            if ($necessidade_especial[$i] != $registro['necessidade_especial']) {
                                                echo("	<option value='$necessidade_especial[$i]'>$necessidade_especial[$i]</option>\n");                                                
                                            } else {
                                                echo("	<option selected value='$necessidade_especial[$i]'>$necessidade_especial[$i]</option>\n");
                                                $achou = true;
                                            }
                                        }
                                        
                                        if($achou == false) {   // se nao achou, significa que ou é OUTRA ou é vazio
                                            if($registro['necessidade_especial']) { // se é outra, amostra no selection
                                                echo("	<option selected value='".$registro['necessidade_especial']."'>".$registro['necessidade_especial']."</option>\n");
                                            }                                            
                                        }
                                        
                                    ?>
                                </select> 

                                &nbsp;&nbsp;Qual:&nbsp;&nbsp;
                                <input style="text-transform:uppercase" name="necessidade_especial_outra" id="necessidade_especial_outra" type="text" value="" onfocus="javascript:necessidadeEspecial()" size='40' maxlength="60" alt="Tipo de deficiencia" />
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
                        <input name="cpf" type="text" id="cpf" onfocus="javascript:somenteLeitura('cpf');" value="<?php echo $registro['cpf']; ?>" onkeypress="javascript:return Onlynumber(event);" size="15" maxlength="11" alt="CPF" />
                    </td>
                </tr>

                <tr>
                    <td width="150" height="27" align='right'>
                        <label>Pis/Pasep:</label>
                    </td>
                    <td>
                        <input name="pispasep" id="pispasep" value="<?php echo $registro['pispasep']; ?>" type="text" size="20" maxlength="11" alt="Pis/Pasep"  onkeypress=" return Onlynumber(event);" />
                    </td>
                </tr>
                
                <tr>
                    <td width="150" height="27" align='right'></td>
                </tr>

                  <tr>
                        <td width="150" height="27" align='right'>
                            <label>Certidão de Nascimeto (Num. Registro):</label>
                        </td>
                        <td>
                            <input style="text-transform:uppercase" name="certidao_nascimentocasamento" id="certidao_nascimentocasamento" value="<?php echo $registro['certidao_nascimentocasamento']; ?>" type="text" size='40' maxlength="50" alt="Certidão de Nascimento" onkeypress="javascript:return Onlynumber(event);" />                            
                        </td>
                    </tr>
                    
                    <tr>
                        <td width="150" height="27" align='right'>
                            <label>UF do cartório:</label>
                        </td>
                        <td>
                            <select name="certidao_nascimentocasamento_id_estado" id="certidao_nascimentocasamento_id_estado" >
                                <?php
                                    echo('	<option value=""></option>\n'); // padrao em branco
                                    foreach($allEstados as $estado) {
                                        if ($estado['id_estado'] == $registro['certidao_nascimentocasamento_id_estado']) {
                                            echo("	<option selected value='".$estado['id_estado']."'>".$estado['sgl_estado']."</option>\n");
                                        } else {
                                            echo("	<option value='".$estado['id_estado']."'>".$estado['sgl_estado']."</option>\n");
                                        }
                                    }
                                ?>
                            </select>
                        </td>
                    </tr>
                    
                    <tr>
                        <td width="150" height="27" align='right'>
                            <label>Folha:</label>
                        </td>
                        <td>
                            <input style="text-transform:uppercase" name="certidao_nascimentocasamento_folha" id="certidao_nascimentocasamento_folha" value="<?php echo $registro['certidao_nascimentocasamento_folha']; ?>" type="text" size='10' maxlength="10" alt="Folha" />
                        </td>
                    </tr>
                    
                    <tr>
                        <td width="150" height="27" align='right'>
                            <label>Livro:</label>
                        </td>
                        <td>
                            <input style="text-transform:uppercase" name="certidao_nascimentocasamento_livro" id="certidao_nascimentocasamento_livro" value="<?php echo $registro['certidao_nascimentocasamento_livro']; ?>" type="text" size='10' maxlength="10" alt="Livro" />
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
                            <input name="rg" type="text" id="rg" value="<?php echo $registro['rg']; ?>" onkeypress="javascript:return Onlynumber(event);" size="15" maxlength="20" alt="RG" />
                        </td>
                    </tr>
                    
                    <tr>
                        <td width="150" height="27" align='right'>
                            <label>Orgão Expedidor:</label>
                        </td>
                        <td>
                            <input style="text-transform:uppercase" name="rg_orgaoexpeditor" id="rg_orgaoexpeditor" value="<?php echo $registro['rg_orgaoexpeditor']; ?>" type="text" size="3" maxlength="5" alt="Órgão Expedidor" />
                        </td>
                    </tr>
                    
                    <tr>
                        <td width="150" height="27" align='right'>
                            <label>UF:</label>
                        </td>
                        <td>
                            <select name="rg_id_estado" id="rg_id_estado" >
                                <?php
                                    echo('	<option value=""></option>\n'); // padrao em branco
                                    foreach($allEstados as $estado) {
                                        if ($estado['id_estado'] == $registro['rg_id_estado']) {
                                            echo("	<option selected value='".$estado['id_estado']."'>".$estado['sgl_estado']."</option>\n");
                                        } else {
                                            echo("	<option value='".$estado['id_estado']."'>".$estado['sgl_estado']."</option>\n");
                                        }
                                    }
                                ?>
                            </select>
                        </td>
                    </tr>
                    
                    <tr>
                        <td width="150" height="27" align='right'>
                            <label>Data de Expedicao:</label>
                        </td>
                        <td>
                            <input id="rg_dataexpedicao" name="rg_dataexpedicao" type="text" size="13" value="<?php echo $registro['rg_dataexpedicao']; ?>" maxlength="10" alt="Data de Expedição (RG)" onkeypress="Mascara('DATA',this,event); return Onlynumber(event);" />
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
                            <input name="registroprofissional" id="registroprofissional" type="text" value="<?php echo $registro['registroprofissional']; ?>" onkeypress="javascript:return Onlynumber(event);" size="15" maxlength="15" alt="Registro Profissional" />
                        </td>
                    </tr>
                    
                    <tr>
                        <td width="150" height="27" align='right'>
                            <label>Orgão Expedidor:</label>
                        </td>
                        <td>
                            <input style="text-transform:uppercase" name="registroprofissional_orgaoexpeditor" id="registroprofissional_orgaoexpeditor" value="<?php echo $registro['registroprofissional_orgaoexpeditor']; ?>"  type="text" size="3" maxlength="5" alt="Órgão Expedidor" />
                        </td>
                    </tr>
                    
                    <tr>
                        <td width="150" height="27" align='right'>
                            <label>UF:</label>
                        </td>
                        <td>
                            <select name="registroprofissional_id_estado" id="registroprofissional_id_estado" >
                            <?php
                                echo('	<option value=""></option>\n'); // padrao em branco
                                foreach($allEstados as $estado) {
                                    
                                    if ($estado['id_estado'] == $registro['registroprofissional_id_estado']) {
                                        echo("	<option selected value='".$estado['id_estado']."'>".$estado['sgl_estado']."</option>\n");
                                    } else {
                                        echo("	<option value='".$estado['id_estado']."'>".$estado['sgl_estado']."</option>\n");
                                    }
                                    
                                }
                            ?>
                        </select>
                        </td>
                    </tr>
                    
                    <tr>
                        <td width="150" height="27" align='right'>
                            <label>Data de Expedição:</label>
                    </td>
                        <td>
                            <input name="registroprofissional_dataexpedicao" id="registroprofissional_dataexpedicao" type="text" size="13" value="<?php echo $registro['registroprofissional_dataexpedicao']; ?>" maxlength="10" alt="Data de Expedição (Registro Profissional)" onkeypress="Mascara('DATA',this,event); return Onlynumber(event);" />
                    </tr>
                    
                    <tr>
                        <td width="150" height="27" align='right'></td>
                    </tr>
                        
                         <tr>
                             <td width="150" height="27" align='right'>
                                 <label>Título de eleitor:</label>
                             </td>
                            <td>
                                <input name="tituloeleitor" id="tituloeleitor" value="<?php echo $registro['tituloeleitor']; ?>" type="text" size="13" maxlength="12" alt="Título de eleitor:" />
                            </td>
                        </tr>
                        
                        <tr>
                            <td width="150" height="27" align='right'>
                                <label>Zona:</label>
                            </td>
                            <td>
                                <input name="tituloeleitor_zona" id="tituloeleitor_zona" value="<?php echo $registro['tituloeleitor_zona']; ?>" type="text" size="20" maxlength="10" alt="Zona"  />
                            </td>
                        </tr>
                        
                        <tr>
                            <td width="150" height="27" align='right'>
                                <label>Seção:</label>
                            </td>
                            <td>
                                <input name="tituloeleitor_secao" id="tituloeleitor_secao" value="<?php echo $registro['tituloeleitor_secao']; ?>" type="text" size="20" maxlength="10" alt="Seção"  />
                            </td>
                        </tr>
                        
                        <tr>
                            <td width="150" height="27" align='right'>
                                <label>Local:</label>
                            </td>
                            <td>
                                <input name="tituloeleitor_local" id="tituloeleitor_local" value="<?php echo $registro['tituloeleitor_local']; ?>" type="text" size="30" maxlength="30" alt="Local"  />
                            </td>
                        </tr>
                        
                        <tr>
                            <td width="150" height="27" align='right'>
                                <label>Data de Expedição:</label>
                            </td>
                            <td>
                                <input name="tituloeleitor_dataexpedicao" id="tituloeleitor_dataexpedicao" value="<?php echo $registro['tituloeleitor_dataexpedicao']; ?>" type="text" size="13" maxlength="10" alt="Data de Expedição" onkeypress="Mascara('DATA',this,event); return Onlynumber(event);" />
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
                                <input name="reservista" id="reservista" value="<?php echo $registro['reservista']; ?>" type="text" size="20" maxlength="20" alt="Reservista"  />
                            </td>
                        </tr>
                        
                        <tr>
                            <td width="150" height="27" align='right'>
                                <label>Orgão Expedidor:</label>
                            </td>
                            <td>
                                <input style="text-transform:uppercase" name="reservista_orgaoexpeditor" id="reservista_orgaoexpeditor" value="<?php echo $registro['reservista_orgaoexpeditor']; ?>" type="text" size="8" maxlength="20" alt="Órgão Expedidor" />
                            </td>
                        </tr>

                        <tr>
                            <td width="150" height="27" align='right'>
                                <label>Série:</label>
                            </td>
                            <td>
                                <input style="text-transform:uppercase" name="reservista_serie" id="reservista_serie" value="<?php echo $registro['reservista_serie']; ?>" type="text" size="15" maxlength="10" alt="Série" />
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
                                <input name="dataprimeiroemprego" id="dataprimeiroemprego" value="<?php echo $registro['dataprimeiroemprego']; ?>" type="text" size="13" maxlength="10" alt="Data do primeiro emprego" onkeypress="Mascara('DATA',this,event); return Onlynumber(event);" />
                            </td>
                        </tr>
                        
                        <tr>
                            <td width="150" height="27" align='right'>
                                <label>Número do banco:</label>
                            </td>
                            <td>
                                <input name="numerobanco" type="text" id="numerobanco" value="<?php echo $registro['numerobanco']; ?>" onkeypress="javascript:return Onlynumber(event);" size="30" maxlength="20" alt="Numero banco" />
                            </td>
                        </tr>
                            
                        <tr>
                            <td width="150" height="27" align='right'>
                                <label for=numeroBanco>Nome do Banco:</label>
                            </td>
                            <td>
                                <input name="nomebanco" type="text" id="nomebanco" value="<?php echo $registro['nomebanco']; ?>" size="40" maxlength="60" alt="Nome do banco" />
                            </td>
                        </tr>
                            
                        <tr>
                            <td width="150" height="27" align='right'>
                                <label for=agencia>Agência:</label>
                            </td>
                            <td>
                                <input name="agencia" type="text" id="agencia" value="<?php echo $registro['agencia']; ?>" size="20" maxlength="10" alt="Agência" />
                            </td>
                        </tr>
                        
                        <tr>
                            <td width="150" height="27" align='right'>
                                <label for=conta>Conta:</label>
                            </td>
                            <td>
                                <input name="conta" type="text" id="conta" value="<?php echo $registro['conta']; ?>" size="20" maxlength="20" alt="Conta" />
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
                        <input style="text-transform:uppercase" name="cargofuncao" type="text" id="cargofuncao" value="<?php echo $registro['cargofuncao']; ?>" size="50" maxlength="60" alt="Cargo/Função" />
                    </td>
                </tr>
                
                <tr>
                    <td width="150" height="27" align='right'>
                        <label for=codigoFuncao>Código:</label>
                    </td>
                    <td>
                        <input name="codigofuncao" type="text" id="codigofuncao" value="<?php echo $registro['codigofuncao']; ?>" size="20" maxlegth="20" alt="Código da função" />
                    </td>
                </tr>
                                
                <tr>
                    <td width="150" height="27" align='right'>
                        <label for=padrao>Padrão:</label>
                    </td>
                    <td>
                        <input name="padrao" type="text" id="padrao" value="<?php echo $registro['padrao']; ?>" size="20" maxlength="20" alt="Padrão" />
                    </td>
                </tr>
                
                <tr>
                    <td width="150" height="27" align='right'>
                        <label>Portaria Nomeação (número):</label>
                    </td>
                    <td>
                        <input name="portaria_nomeacao_numero" type="text" id="portaria_nomeacao_numero" value="<?php echo $registro['portaria_nomeacao_numero']; ?>" size="20" maxlength="20" alt="Portaria Nomeação (número)" onkeypress="return Onlynumber(event);"/>
                    </td>
                </tr>
                                
                <tr>
                    <td width="150" height="27" align='right'>
                        <label>Portaria nomeação (data):</label>
                    </td>
                    <td>
                        <input name="portaria_nomeacao_data" id="portaria_nomeacao_data" value="<?php echo $registro['portaria_nomeacao_data'] ?>" type="text" size="15" maxlength="10" alt="Portaria nomeação (data)" onkeypress="Mascara('DATA',this,event); return Onlynumber(event);" />
                    </td>
                </tr>
                
                    <tr>
                        <td width="150" height="27" align='right'>
                            <label>Data de publicação:</label>
                        </td>
                        <td>
                            <input name="data_publicacao" id="data_publicacao" value="<?php echo $registro['data_publicacao']; ?>" type="text" size="15" maxlength="10" alt="Data de publicação" onkeypress="Mascara('DATA',this,event); return Onlynumber(event);" />
                        </td>
                    </tr>
                    
                    <tr>
                        <td width="150" height="27" align='right'>
                            <label>Data da posse:</label>
                        </td>
                        <td>
                            <input name="data_posse" id="data_posse" value="<?php echo $registro['data_posse']; ?>" type="text" size="15" maxlength="10" alt="Data da posse" onkeypress="Mascara('DATA',this,event); return Onlynumber(event);" />
                        </td>
                    </tr>
                    
                    <tr>
                        <td width="150" height="27" align='right'>
                            <label for=dataExercicio>Data de exercício:</label>
                        </td>
                        <td>
                            <input name="data_exercicio" id="data_exercicio" value="<?php echo $registro['data_exercicio']; ?>" type="text" size="15" maxlength="10" alt="Data de exercício" onkeypress="Mascara('DATA',this,event); return Onlynumber(event);" />
                        </td>
                    </tr>
                    
                    <tr>
                        <td width="150" height="27" align='right'>
                            <label>Lotação:</label>
                        </td>
                        <td>
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

                                $total = count($lotacao);
                                for($i=0; $i<$total; $i++) {
                                    if ($lotacao[$i] != $registro['lotacao']) {
                                        echo("	<option value='$lotacao[$i]'>$lotacao[$i]</option>\n");
                                    } else {
                                        echo("	<option selected value='$lotacao[$i]'>$lotacao[$i]</option>\n");
                                    }
                                }
                            ?>
                        </select>
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
                        <select name="segundograu" id="segundograu" onchange="academico_somenteLeitura('segundograu');">
                            <?php
                                $situacao_curso = array("","COMPLETO","INCOMPLETO","CURSANDO");

                                $total = count($situacao_curso);
                                for($i=0; $i<$total; $i++) {
                                    if ($situacao_curso[$i] != $registro['segundograu']) {
                                        echo("	<option value='$situacao_curso[$i]'>$situacao_curso[$i]</option>\n");
                                    } else {
                                        echo("	<option selected value='$situacao_curso[$i]'>$situacao_curso[$i]</option>\n");
                                    }
                                }
                            ?>
                        </select>
                    </td>
                </tr>
                
                <tr>
                    <td width="150" height="27" align='right'>
                        <label>Curso:</label>
                    </td>
                    <td>
                        <input name="segundograu_curso" id="segundograu_curso" value="<?php echo $registro['segundograu_curso']; ?>" type="text" size="50" maxlength="60" alt="Curso (Pós-graduação 4)" onfocus="academico_somenteLeitura('segundograu');" />
                    </td>
                </tr>
                
                <tr>
                    <td width="150" height="27" align='right'>
                        <label>Instituição:</label>
                    </td>
                    <td>
                        <input name="segundograu_instituicao" id="segundograu_instituicao" value="<?php echo $registro['segundograu_instituicao']; ?>" type="text" size="50" maxlength="60" alt="Instituição (segundo grau)" onfocus="academico_somenteLeitura('segundograu');" />
                    </td>
                </tr>
                
                <tr>
                    <td width="150" height="27" align='right'>
                        <label>Data de conclusão:</label>
                    </td>
                    <td>
                        <input name="segundograu_dataconclusao" id="segundograu_dataconclusao" value="<?php echo $registro['segundograu_dataconclusao']; ?>" type="text" size="15" maxlength="10" alt="Data de conclusão (Segundo grau)" onkeypress="Mascara('DATA',this,event); return Onlynumber(event);" onfocus="academico_somenteLeitura('segundograu');" />
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
                        <select name="terceirograu" id="terceirograu" onchange="academico_somenteLeitura('terceirograu');">
                            <?php
                                $total = count($situacao_curso);
                                for($i=0; $i<$total; $i++) {
                                    if ($situacao_curso[$i] != $registro['terceirograu']) {
                                        echo("	<option value='$situacao_curso[$i]'>$situacao_curso[$i]</option>\n");
                                    } else {
                                        echo("	<option selected value='$situacao_curso[$i]'>$situacao_curso[$i]</option>\n");
                                    }
                                }
                            ?>
                        </select>
                    </td>
                </tr>
                
                <tr>
                    <td width="150" height="27" align='right'>
                        <label>Curso:</label>
                    </td>
                    <td>
                        <input name="terceirograu_curso" id="terceirograu_curso" value="<?php echo $registro['terceirograu_curso']; ?>" type="text" size="50" maxlength="60" alt="Curso (Terceiro grau)" onfocus="academico_somenteLeitura('terceirograu');" />
                    </td>
                </tr>
                
                <tr>
                    <td width="150" height="27" align='right'>
                        <label>Instituição:</label>
                    </td>
                    <td>
                        <input name="terceirograu_instituicao" id="terceirograu_instituicao" value="<?php echo $registro['terceirograu_instituicao']; ?>" type="text" size="50" maxlength="60" alt="Instituição (terceiro grau)"  onfocus="academico_somenteLeitura('terceirograu');"/>
                    </td>
                </tr>
                
                <tr>
                    <td width="150" height="27" align='right'>
                        <label>Data de conclusão:</label>
                    </td>
                    <td>
                        <input name="terceirograu_dataconclusao" id="terceirograu_dataconclusao" value="<?php echo $registro['terceirograu_dataconclusao']; ?>" type="text" size="15" maxlength="10" alt="Data de conclusão (Terceiro grau)" onkeypress="Mascara('DATA',this,event); return Onlynumber(event);" onfocus="academico_somenteLeitura('terceirograu');" />
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
                        <select name="posgraduacao1_tipo" id="posgraduacao1_tipo" onchange="academico_somenteLeitura('posgraduacao1_tipo');">
                            <?php
                                $tipo_posgraduacao = array("","ESPECIALIZAÇÃO","MESTRADO","DOUTORADO");
                                $situacao_curso = array("","COMPLETO","INCOMPLETO","CURSANDO");

                                $total = count($tipo_posgraduacao);
                                for($i=0; $i<$total; $i++) {
                                    if ($tipo_posgraduacao[$i] != $registro['posgraduacao1_tipo']) {
                                        echo("	<option value='$tipo_posgraduacao[$i]'>$tipo_posgraduacao[$i]</option>\n");
                                    } else {
                                        echo("	<option selected value='$tipo_posgraduacao[$i]'>$tipo_posgraduacao[$i]</option>\n");
                                    }
                                }
                            ?>
                        </select>
                    </td>
                </tr>
                
                <tr>
                    <td width="150" height="27" align='right'>
                        <label>Situação:</label>
                    </td>
                    <td>
                        <select name="posgraduacao1_situacao" id="posgraduacao1_situacao" onfocus="academico_somenteLeitura('posgraduacao1_tipo');">
                            <?php
                                $total = count($situacao_curso);
                                for($i=0; $i<$total; $i++) {
                                    if ($situacao_curso[$i] != $registro['posgraduacao1_situacao']) {
                                        echo("	<option value='$situacao_curso[$i]'>$situacao_curso[$i]</option>\n");
                                    } else {
                                        echo("	<option selected value='$situacao_curso[$i]'>$situacao_curso[$i]</option>\n");
                                    }
                                }
                            ?>
                        </select>
                    </td>
                </tr>
                
                <tr>
                    <td width="150" height="27" align='right'>
                        <label>Curso:</label>
                    </td>
                    <td>
                        <input name="posgraduacao1_curso" id="posgraduacao1_curso" value="<?php echo $registro['posgraduacao1_curso']; ?>" type="text" size="50" maxlength="60" alt="Curso (Pós-graduação 1)"  onfocus="academico_somenteLeitura('posgraduacao1');"/>
                    </td>
                </tr>
                
                <tr>
                    <td width="150" height="27" align='right'>
                        <label>Instituição:</label>
                    </td>
                    <td>
                        <input name="posgraduacao1_instituicao" id="posgraduacao1_instituicao" value="<?php echo $registro['posgraduacao1_instituicao']; ?>" type="text" size="50" maxlength="60" alt="Instituição (Pós-graduação 1)" onfocus="academico_somenteLeitura('posgraduacao1');" />
                    </td>
                </tr>
                
                <tr>
                    <td width="150" height="27" align='right'>
                        <label>Carga horária:</label>
                    </td>
                    <td>
                        <input name="posgraduacao1_cargahoraria" id="posgraduacao1_cargahoraria" value="<?php echo $registro['posgraduacao1_cargahoraria']; ?>" type="text" size="7" maxlength="5" alt="Carga horária (Pós-graduação 1)" onkeypress="javascript:return Onlynumber(event);" onfocus="academico_somenteLeitura('posgraduacao1');" />
                    </td>
                </tr>
                
                <tr>
                    <td width="150" height="27" align='right'>
                        <label>Data de conclusão:</label>
                    </td>
                    <td>
                        <input name="posgraduacao1_dataconclusao" id="posgraduacao1_dataconclusao" value="<?php echo $registro['posgraduacao1_dataconclusao']; ?>" type="text" size="15" maxlength="10" alt="Data de conclusão (Pós-graduação 1)" onkeypress="Mascara('DATA',this,event); return Onlynumber(event);" onfocus="academico_somenteLeitura('posgraduacao1');"/>
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
                        <select name="posgraduacao2_tipo" id="posgraduacao2_tipo" onchange="academico_somenteLeitura('posgraduacao2_tipo');" >
                            <?php
                                $tipo_posgraduacao = array("","ESPECIALIZAÇÃO","MESTRADO","DOUTORADO");

                                $total = count($tipo_posgraduacao);
                                for($i=0; $i<$total; $i++) {
                                    if ($tipo_posgraduacao[$i] != $registro['posgraduacao2_tipo']) {
                                        echo("	<option value='$tipo_posgraduacao[$i]'>$tipo_posgraduacao[$i]</option>\n");
                                    } else {
                                        echo("	<option selected value='$tipo_posgraduacao[$i]'>$tipo_posgraduacao[$i]</option>\n");
                                    }
                                }
                            ?>
                        </select>
                    </td>
                </tr>
                
                <tr>
                    <td width="150" height="27" align='right'>
                        <label>Situação:</label>
                    </td>
                    <td>
                        <select name="posgraduacao2_situacao" id="posgraduacao2_situacao" onfocus="academico_somenteLeitura('posgraduacao2_tipo');">
                            <?php
                                $total = count($situacao_curso);
                                for($i=0; $i<$total; $i++) {
                                    if ($situacao_curso[$i] != $registro['posgraduacao2_situacao']) {
                                        echo("	<option value='$situacao_curso[$i]'>$situacao_curso[$i]</option>\n");
                                    } else {
                                        echo("	<option selected value='$situacao_curso[$i]'>$situacao_curso[$i]</option>\n");
                                    }
                                }
                            ?>
                        </select>
                    </td>
                </tr>
                
                <tr>
                    <td width="150" height="27" align='right'>
                        <label>Curso:</label>
                    </td>
                    <td>
                        <input name="posgraduacao2_curso" id="posgraduacao2_curso" value="<?php echo $registro['posgraduacao2_curso']; ?>" type="text" size="50" maxlength="60" alt="Curso (Pós-graduação 2)" onfocus="academico_somenteLeitura('posgraduacao2_tipo');" />
                    </td>
                </tr>
                
                <tr>
                    <td width="150" height="27" align='right'>
                        <label>Instituição:</label>
                    </td>
                    <td>
                        <input name="posgraduacao2_instituicao" id="posgraduacao2_instituicao" value="<?php echo $registro['posgraduacao2_instituicao']; ?>" type="text" size="50" maxlength="60" alt="Instituição (Pós-graduação 2)" onfocus="academico_somenteLeitura('posgraduacao2_tipo');" />
                    </td>
                </tr>
                
                <tr>
                    <td width="150" height="27" align='right'>
                        <label>Carga horária:</label>
                    </td>
                    <td>
                        <input name="posgraduacao2_cargahoraria" id="posgraduacao2_cargahoraria" value="<?php echo $registro['posgraduacao2_cargahoraria']; ?>" type="text" size="7" maxlength="5" alt="Carga horária (Pós-graduação 2)" onkeypress="javascript:return Onlynumber(event);" onfocus="academico_somenteLeitura('posgraduacao2_tipo');" />
                    </td>
                </tr>
                
                <tr>
                    <td width="150" height="27" align='right'>
                        <label>Data de conclusão:</label>
                    </td>
                    <td>
                        <input name="posgraduacao2_dataconclusao" id="posgraduacao2_dataconclusao" value="<?php echo $registro['posgraduacao2_dataconclusao']; ?>" type="text" size="15" maxlength="10" alt="Data de conclusão (Pós-graduação 2)" onkeypress="Mascara('DATA',this,event); return Onlynumber(event);" onfocus="academico_somenteLeitura('posgraduacao2_tipo');" />
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
                        <select name="posgraduacao3_tipo" id="posgraduacao3_tipo" onchange="academico_somenteLeitura('posgraduacao3_tipo');" >
                            <?php
                                $tipo_posgraduacao = array("","ESPECIALIZAÇÃO","MESTRADO","DOUTORADO");

                                $total = count($tipo_posgraduacao);
                                for($i=0; $i<$total; $i++) {
                                    if ($tipo_posgraduacao[$i] != $registro['posgraduacao3_tipo']) {
                                        echo("	<option value='$tipo_posgraduacao[$i]'>$tipo_posgraduacao[$i]</option>\n");
                                    } else {
                                        echo("	<option selected value='$tipo_posgraduacao[$i]'>$tipo_posgraduacao[$i]</option>\n");
                                    }
                                }
                            ?>
                        </select>
                    </td>
                </tr>
                
                <tr>
                    <td width="150" height="27" align='right'>
                        <label>Situação:</label>
                    </td>
                    <td>
                        <select name="posgraduacao3_situacao" id="posgraduacao3_situacao" onfocus="academico_somenteLeitura('posgraduacao3_tipo');">
                            <?php
                                $total = count($situacao_curso);
                                for($i=0; $i<$total; $i++) {
                                    if ($situacao_curso[$i] != $registro['posgraduacao3_situacao']) {
                                        echo("	<option value='$situacao_curso[$i]'>$situacao_curso[$i]</option>\n");
                                    } else {
                                        echo("	<option selected value='$situacao_curso[$i]'>$situacao_curso[$i]</option>\n");
                                    }
                                }
                            ?>
                        </select>
                    </td>
                </tr>
                
                <tr>
                    <td width="150" height="27" align='right'>
                        <label>Curso:</label>
                    </td>
                    <td>
                        <input name="posgraduacao3_curso" id="posgraduacao3_curso" value="<?php echo $registro['posgraduacao3_curso']; ?>" type="text" size="50" maxlength="60" alt="Curso (Pós-graduação 3)" onfocus="academico_somenteLeitura('posgraduacao3_tipo');" />
                    </td>
                </tr>
                
                <tr>
                    <td width="150" height="27" align='right'>
                        <label>Instituição:</label>
                    </td>
                    <td>
                        <input name="posgraduacao3_instituicao" id="posgraduacao3_instituicao" value="<?php echo $registro['posgraduacao3_instituicao']; ?>" type="text" size="50" maxlength="60" alt="Instituição (Pós-graduação 3)" onfocus="academico_somenteLeitura('posgraduacao3_tipo');" />
                    </td>
                </tr>
                
                <tr>
                    <td width="150" height="27" align='right'>
                        <label>Carga horária:</label>
                    </td>
                    <td>
                        <input name="posgraduacao3_cargahoraria" id="posgraduacao3_cargahoraria" value="<?php echo $registro['posgraduacao3_cargahoraria']; ?>" type="text" size="7" maxlength="5" alt="Carga horária (Pós-graduação 3)" onkeypress="javascript:return Onlynumber(event);" onfocus="academico_somenteLeitura('posgraduacao3_tipo');" />
                    </td>
                </tr>
                
                <tr>
                    <td width="150" height="27" align='right'>
                        <label>Data de conclusão:</label>
                    </td>
                    <td>
                        <input name="posgraduacao3_dataconclusao" id="posgraduacao3_dataconclusao" value="<?php echo $registro['posgraduacao3_dataconclusao']; ?>" type="text" size="15" maxlength="10" alt="Data de conclusão (Pós-graduação 3)" onkeypress="Mascara('DATA',this,event); return Onlynumber(event);" onfocus="academico_somenteLeitura('posgraduacao3_tipo');" />
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
                        <select name="posgraduacao4_tipo" id="posgraduacao4_tipo" onchange="academico_somenteLeitura('posgraduacao4_tipo');" >
                            <?php
                                $tipo_posgraduacao = array("","ESPECIALIZAÇÃO","MESTRADO","DOUTORADO");

                                $total = count($tipo_posgraduacao);
                                for($i=0; $i<$total; $i++) {
                                    if ($tipo_posgraduacao[$i] != $registro['posgraduacao4_tipo']) {
                                        echo("	<option value='$tipo_posgraduacao[$i]'>$tipo_posgraduacao[$i]</option>\n");
                                    } else {
                                        echo("	<option selected value='$tipo_posgraduacao[$i]'>$tipo_posgraduacao[$i]</option>\n");
                                    }
                                }
                            ?>
                        </select>
                    </td>
                </tr>
                
                <tr>
                    <td width="150" height="27" align='right'>
                        <label>Situação:</label>
                    </td>
                    <td>
                        <select name="posgraduacao4_situacao" id="posgraduacao4_situacao" onfocus="academico_somenteLeitura('posgraduacao4_tipo');">
                            <?php
                                $total = count($situacao_curso);
                                for($i=0; $i<$total; $i++) {
                                    if ($situacao_curso[$i] != $registro['posgraduacao4_situacao']) {
                                        echo("	<option value='$situacao_curso[$i]'>$situacao_curso[$i]</option>\n");
                                    } else {
                                        echo("	<option selected value='$situacao_curso[$i]'>$situacao_curso[$i]</option>\n");
                                    }
                                }
                            ?>
                        </select>
                    </td>
                </tr>
                
                <tr>
                    <td width="150" height="27" align='right'>
                        <label>Curso:</label>
                    </td>
                    <td>
                        <input name="posgraduacao4_curso" id="posgraduacao4_curso" value="<?php echo $registro['posgraduacao4_curso']; ?>" type="text" size="50" maxlength="60" alt="Curso (Pós-graduação 4)" onfocus="academico_somenteLeitura('posgraduacao4_tipo');" />
                    </td>
                </tr>
                
                <tr>
                    <td width="150" height="27" align='right'>
                        <label>Instituição:</label>
                    </td>
                    <td>
                        <input name="posgraduacao4_instituicao" id="posgraduacao4_instituicao" value="<?php echo $registro['posgraduacao4_instituicao']; ?>" type="text" size="50" maxlength="60" alt="Instituição (Pós-graduação 4)" onfocus="academico_somenteLeitura('posgraduacao4_tipo');" />
                    </td>
                </tr>
                
                <tr>
                    <td width="150" height="27" align='right'>
                        <label>Carga horária:</label>
                    </td>
                    <td>
                        <input name="posgraduacao4_cargahoraria" id="posgraduacao4_cargahoraria" value="<?php echo $registro['posgraduacao4_cargahoraria']; ?>" type="text" size="7" maxlength="5" alt="Carga horária (Pós-graduação 4)" onkeypress="javascript:return Onlynumber(event);" onfocus="academico_somenteLeitura('posgraduacao4_tipo');" />
                    </td>
                </tr>
                
                <tr>
                    <td width="150" height="27" align='right'>
                        <label>Data de conclusão:</label>
                    </td>
                    <td>
                        <input name="posgraduacao4_dataconclusao" id="posgraduacao4_dataconclusao" value="<?php echo $registro['posgraduacao4_dataconclusao']; ?>" type="text" size="15" maxlength="10" alt="Data de conclusão (Pós-graduação 4)" onkeypress="Mascara('DATA',this,event); return Onlynumber(event);" onfocus="academico_somenteLeitura('posgraduacao4_tipo');" />
                    </td>
                </tr>
                
                
                <!-- linha vazia --> 
                <tr>
                    <td height="27" align='left'></td>
                </tr>
                
                <tr>
                    <td colspan="2" height="27" align='left'>
                        <label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Deseja cursar Pós-Graduação?</label>
                    </td>
                </tr>
                       
                
                <!-- desejo cursar especializacao -->                
                         
                <tr>
                    <td width="150" height="27" align='right'>
                        <?php
                        // verificando se o checkbox estará checked ou nao
                        if($registro['desejo_especializacao_area']) { ?>
                            <input type="checkbox" checked="checked" id="check_especializacao" name="check_especializacao" value="1" onchange="academico_somenteLeitura('check_especializacao');" />                  
                        <?php } else { ?>
                            <input type="checkbox" id="check_especializacao" name="check_especializacao" value="1" onchange="academico_somenteLeitura('check_especializacao');"/>
                        <?php } ?>
                    </td>
                    <td>
                        <label for="check_especializacao">Especialização</label>
                        &nbsp;&nbsp;
                        
                        <?php if($registro['desejo_especializacao_area']) { ?>
                            <label id="label_especializacao" style="display:inline">Qual área?</label>
                            <input name="desejo_especializacao_area" id="desejo_especializacao_area" value="<?php echo $registro['desejo_especializacao_area']; ?>" type="text" size="50" maxlength="60" alt="Qual Curso?" onfocus="academico_somenteLeitura('check_especializacao');" style="display:inline"/>                        
                        
                        <?php } else { ?>
                            <label id="label_especializacao" style="display:none">Qual área?</label>
                            <input name="desejo_especializacao_area" id="desejo_especializacao_area" value="<?php echo $registro['desejo_especializacao_area']; ?>" type="text" size="50" maxlength="60" alt="Qual Curso?" onfocus="academico_somenteLeitura('check_especializacao');" style="display:none"/>
                        <?php } ?>
                    </td>
                </tr>                
                
                <!-- desejo cursar mestrado -->                
                <tr>
                    <td width="150" height="27" align='right'>
                        <?php
                        // verificando se o checkbox estará checked ou nao
                        if($registro['desejo_mestrado_area']) { ?>
                            <input type="checkbox" checked="checked" id="check_mestrado" name="check_mestrado" value="1" onchange="academico_somenteLeitura('check_mestrado');" />                  
                        <?php } else { ?>
                            <input type="checkbox" id="check_mestrado" name="check_mestrado" value="1" onchange="academico_somenteLeitura('check_mestrado');" />
                        <?php } ?>
                    </td>
                    <td>
                        <label for="check_mestrado">Mestrado</label>
                        &nbsp;&nbsp;
                        
                        <?php if($registro['desejo_mestrado_area']) { ?>
                            <label id="label_mestrado" style="display:inline">Qual área?</label> 
                            <input name="desejo_mestrado_area" id="desejo_mestrado_area" value="<?php echo $registro['desejo_mestrado_area']; ?>" type="text" size="50" maxlength="60" alt="Qual Curso?" onfocus="academico_somenteLeitura('check_mestrado');" style="display:inline"/>
                        <?php } else { ?>
                            <label id="label_mestrado" style="display:none">Qual área?</label> 
                            <input name="desejo_mestrado_area" id="desejo_mestrado_area" value="<?php echo $registro['desejo_mestrado_area']; ?>" type="text" size="50" maxlength="60" alt="Qual Curso?" onfocus="academico_somenteLeitura('check_mestrado');" style="display:none"/>
                        <?php } ?>
                   </td>
                </tr> 
                
                <!-- desejo cursar doutorado -->                
                <tr>
                    <td width="150" height="27" align='right'>
                        <?php
                        // verificando se o checkbox estará checked ou nao
                        if($registro['desejo_doutorado_area']) { ?>
                            <input type="checkbox" checked="checked" id="check_doutorado" name="check_doutorado" value="1" onchange="academico_somenteLeitura('check_doutorado');" />                  
                        <?php } else { ?>
                            <input type="checkbox" id="check_doutorado" name="check_doutorado" value="1" onchange="academico_somenteLeitura('check_doutorado');" />
                        <?php } ?>
                    </td>
                    <td>
                        <label for="check_doutorado">Doutorado</label>
                        &nbsp;&nbsp;
                        
                        <?php if($registro['desejo_doutorado_area']) { ?>
                            <label id="label_doutorado" style="display:inline">Qual área?</label> 
                            <input name="desejo_doutorado_area" id="desejo_doutorado_area" value="<?php echo $registro['desejo_doutorado_area']; ?>" type="text" size="50" maxlength="60" alt="Qual Curso?" onfocus="academico_somenteLeitura('check_doutorado');"  style="display:inline"/>
                        <?php } else { ?>
                            <label id="label_doutorado" style="display:none">Qual área?</label> 
                            <input name="desejo_doutorado_area" id="desejo_doutorado_area" value="<?php echo $registro['desejo_doutorado_area']; ?>" type="text" size="50" maxlength="60" alt="Qual Curso?" onfocus="academico_somenteLeitura('check_doutorado');"  style="display:none"/>
                        <?php } ?>
                   </td>
                </tr> 
                
                <tr>
                    <td width="150" height="27" align='right'>
                        <label>Participa de algum grupo de pesquisa?</label>
                    </td>
                    <td>
                        <textarea rows="4" cols="60" id="grupo_pesquisa" name="grupo_pesquisa"><?php echo $registro['grupo_pesquisa']; ?></textarea>                        
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
                    <label><b>Idiomas</b></label>
                </td>
            </tr>
        </table>  
               
                       
    <table width="760" border="0" align='center' class="conteudo-tabela">
        
        <?php 
        $idioma = Array("", "INGLÊS", "ESPANHOL", "ALEMÃO", "ASSAMÊS", "AZERI", "ÁRABE", "ÁRABE EGÍPCIO"
            , "BENGALI", "BIRMANÊS", "CEBUANO", "COREANO", "CURDO", "FRANCÊS", "GUJARATI", "HAUSA"
            , "HINDI", "IGBO", "INDONÉSIO", "IORUBÁ", "ITALIANO", "JAPONÊS", "JAVANÊS", "KANNADA"
            , "LAO", "MALAIALA", "MALAIO", "MALGAXE", "MARATHI", "NEPALÊS", "ORIYA", "OROMO", "PASHTO"
            , "PERSA", "POLACO", "PORTUGUÊS", "PUNJABI", "ROMENO", "RUSSO", "SINDHI", "SOMALI", "SUNDANÊS", "TAGALOG"
            , "TAILANDÊS", "TAMIL", "TELUGU", "TURCO", "UCRANIANO", "URDU", "UZBEQUE", "VIETNAMITA");
        $total_idioma = count($idioma);
                
        $idioma_nivel = Array("", "BÁSICO", "INTERMEDIÁRIO", "AVANÇADO");
        $total_nivel = count($idioma_nivel);
        ?>
        
        <!-- IDIOMA 1 -->
        
        <tr>
            <!-- idioma --> 
            <td width='152' height='27' align='right'>
                <label>Idioma:</label>
                <select name="idioma1" id="idioma1" onchange="idioma_somenteLeitura(1);" >
                    <?php  
                        for($i=0; $i<$total_idioma; $i++) {
                            if ($idioma[$i] != $registro['idioma1']) {
                                echo("	<option value='$idioma[$i]'>$idioma[$i]</option>\n");
                            } else {
                                echo("	<option selected value='$idioma[$i]'>$idioma[$i]</option>\n");
                            }
                        }
                    ?>
                </select>
            </td>

        <!-- idioma leitura--> 

            <td width='152' height='27' align='right'>
                <label>Leitura:</label>
                <select name='idioma1_leitura' id='idioma1_leitura' onfocus="idioma_somenteLeitura(1);">
                    <?php                                
                    for($i=0; $i<$total_nivel; $i++) {
                        if ($idioma_nivel[$i] != $registro['idioma1_leitura']) {
                            echo("	<option value='".$idioma_nivel[$i]."'>".$idioma_nivel[$i]."</option>");
                        } else {
                            echo("	<option selected value='".$idioma_nivel[$i]."'>".$idioma_nivel[$i]."</option>");
                        }
                    }
                    ?>
                </select>
            </td>

        <!-- idioma fala--> 

            <td width='152' height='27' align='right'>
                <label>Fala:</label>
                <select name='idioma1_fala' id='idioma1_fala' onfocus="idioma_somenteLeitura(1);">
                    <?php                                
                    for($i=0; $i<$total_nivel; $i++) {
                        if ($idioma_nivel[$i] != $registro['idioma1_fala']) {
                            echo("	<option value='".$idioma_nivel[$i]."'>".$idioma_nivel[$i]."</option>");
                        } else {
                            echo("	<option selected value='".$idioma_nivel[$i]."'>".$idioma_nivel[$i]."</option>");
                        }
                    }
                    ?>
                </select>
            </td>

        <!-- idioma escrita-->
        
            <td width='152' height='27' align='right'>
                <label>Escrita:</label>
                <select name='idioma1_escrita' id='idioma1_escrita' onfocus="idioma_somenteLeitura(1);">
                    <?php                                
                    for($i=0; $i<$total_nivel; $i++) {
                        if ($idioma_nivel[$i] != $registro['idioma1_escrita']) {
                            echo("	<option value='".$idioma_nivel[$i]."'>".$idioma_nivel[$i]."</option>");
                        } else {
                            echo("	<option selected value='".$idioma_nivel[$i]."'>".$idioma_nivel[$i]."</option>");
                        }
                    }
                    ?>
                </select>
            </td>
        </tr>
        
        
        <!-- IDIOMA 2 -->
        
        <tr>
            <!-- idioma --> 
            <td width='152' height='27' align='right' >
                <label>Idioma:</label>
                <select name="idioma2" id="idioma2" onchange="idioma_somenteLeitura(2);">
                    <?php  
                        for($i=0; $i<$total_idioma; $i++) {
                            if ($idioma[$i] != $registro['idioma2']) {
                                echo("	<option value='$idioma[$i]'>$idioma[$i]</option>\n");
                            } else {
                                echo("	<option selected value='$idioma[$i]'>$idioma[$i]</option>\n");
                            }
                        }
                    ?>
                </select>
            </td>

        <!-- idioma leitura--> 

            <td width='152' height='27' align='right'>
                <label>Leitura:</label>
                <select name='idioma2_leitura' id='idioma2_leitura' onfocus="idioma_somenteLeitura(2);">
                    <?php                                
                    for($i=0; $i<$total_nivel; $i++) {
                        if ($idioma_nivel[$i] != $registro['idioma2_leitura']) {
                            echo("	<option value='".$idioma_nivel[$i]."'>".$idioma_nivel[$i]."</option>");
                        } else {
                            echo("	<option selected value='".$idioma_nivel[$i]."'>".$idioma_nivel[$i]."</option>");
                        }
                    }
                    ?>
                </select>
            </td>

        <!-- idioma fala--> 

            <td width='152' height='27' align='right'>
                <label>Fala:</label>
                <select name='idioma2_fala' id='idioma2_fala' onfocus="idioma_somenteLeitura(2);">
                    <?php                                
                    for($i=0; $i<$total_nivel; $i++) {
                        if ($idioma_nivel[$i] != $registro['idioma2_fala']) {
                            echo("	<option value='".$idioma_nivel[$i]."'>".$idioma_nivel[$i]."</option>");
                        } else {
                            echo("	<option selected value='".$idioma_nivel[$i]."'>".$idioma_nivel[$i]."</option>");
                        }
                    }
                    ?>
                </select>
            </td>

        <!-- idioma escrita-->
        
            <td width='152' height='27' align='right'>
                <label>Escrita:</label>
                <select name='idioma2_escrita' id='idioma2_escrita' onfocus="idioma_somenteLeitura(2);">
                    <?php                                
                    for($i=0; $i<$total_nivel; $i++) {
                        if ($idioma_nivel[$i] != $registro['idioma2_escrita']) {
                            echo("	<option value='".$idioma_nivel[$i]."'>".$idioma_nivel[$i]."</option>");
                        } else {
                            echo("	<option selected value='".$idioma_nivel[$i]."'>".$idioma_nivel[$i]."</option>");
                        }
                    }
                    ?>
                </select>
            </td>
        </tr>
        
        <!-- IDIOMA 3 -->
        
        <tr>
            <!-- idioma --> 
            <td width='152' height='27' align='right'>
                <label>Idioma:</label>
                <select name="idioma3" id="idioma3" onchange="idioma_somenteLeitura(3);">
                    <?php  
                        for($i=0; $i<$total_idioma; $i++) {
                            if ($idioma[$i] != $registro['idioma3']) {
                                echo("	<option value='$idioma[$i]'>$idioma[$i]</option>\n");
                            } else {
                                echo("	<option selected value='$idioma[$i]'>$idioma[$i]</option>\n");
                            }
                        }
                    ?>
                </select>
            </td>

        <!-- idioma leitura--> 

            <td width='152' height='27' align='right'>
                <label>Leitura:</label>
                <select name='idioma3_leitura' id='idioma3_leitura' onfocus="idioma_somenteLeitura(3);">
                    <?php                                
                    for($i=0; $i<$total_nivel; $i++) {
                        if ($idioma_nivel[$i] != $registro['idioma3_leitura']) {
                            echo("	<option value='".$idioma_nivel[$i]."'>".$idioma_nivel[$i]."</option>");
                        } else {
                            echo("	<option selected value='".$idioma_nivel[$i]."'>".$idioma_nivel[$i]."</option>");
                        }
                    }
                    ?>
                </select>
            </td>

        <!-- idioma fala--> 

            <td width='152' height='27' align='right'>
                <label>Fala:</label>
                <select name='idioma3_fala' id='idioma3_fala' onfocus="idioma_somenteLeitura(3);">
                    <?php                                
                    for($i=0; $i<$total_nivel; $i++) {
                        if ($idioma_nivel[$i] != $registro['idioma3_fala']) {
                            echo("	<option value='".$idioma_nivel[$i]."'>".$idioma_nivel[$i]."</option>");
                        } else {
                            echo("	<option selected value='".$idioma_nivel[$i]."'>".$idioma_nivel[$i]."</option>");
                        }
                    }
                    ?>
                </select>
            </td>

        <!-- idioma escrita-->
        
            <td width='152' height='27' align='right'>
                <label>Escrita:</label>
                <select name='idioma3_escrita' id='idioma3_escrita' onfocus="idioma_somenteLeitura(3);">
                    <?php                                
                    for($i=0; $i<$total_nivel; $i++) {
                        if ($idioma_nivel[$i] != $registro['idioma3_escrita']) {
                            echo("	<option value='".$idioma_nivel[$i]."'>".$idioma_nivel[$i]."</option>");
                        } else {
                            echo("	<option selected value='".$idioma_nivel[$i]."'>".$idioma_nivel[$i]."</option>");
                        }
                    }
                    ?>
                </select>
            </td>
        </tr>
        
        <!-- IDIOMA 4 -->
        
        <tr>
            <!-- idioma --> 
            <td width='152' height='27' align='right'>
                <label>Idioma:</label>
                <select name="idioma4" id="idioma4" onchange="idioma_somenteLeitura(4);">
                    <?php  
                        for($i=0; $i<$total_idioma; $i++) {
                            if ($idioma[$i] != $registro['idioma4']) {
                                echo("	<option value='$idioma[$i]'>$idioma[$i]</option>\n");
                            } else {
                                echo("	<option selected value='$idioma[$i]'>$idioma[$i]</option>\n");
                            }
                        }
                    ?>
                </select>
            </td>

        <!-- idioma leitura--> 

            <td width='152' height='27' align='right'>
                <label>Leitura:</label>
                <select name='idioma4_leitura' id='idioma4_leitura' onfocus="idioma_somenteLeitura(4);">
                    <?php                                
                    for($i=0; $i<$total_nivel; $i++) {
                        if ($idioma_nivel[$i] != $registro['idioma4_leitura']) {
                            echo("	<option value='".$idioma_nivel[$i]."'>".$idioma_nivel[$i]."</option>");
                        } else {
                            echo("	<option selected value='".$idioma_nivel[$i]."'>".$idioma_nivel[$i]."</option>");
                        }
                    }
                    ?>
                </select>
            </td>

        <!-- idioma fala--> 

            <td width='152' height='27' align='right'>
                <label>Fala:</label>
                <select name='idioma4_fala' id='idioma4_fala' onfocus="idioma_somenteLeitura(4);">
                    <?php                                
                    for($i=0; $i<$total_nivel; $i++) {
                        if ($idioma_nivel[$i] != $registro['idioma4_fala']) {
                            echo("	<option value='".$idioma_nivel[$i]."'>".$idioma_nivel[$i]."</option>");
                        } else {
                            echo("	<option selected value='".$idioma_nivel[$i]."'>".$idioma_nivel[$i]."</option>");
                        }
                    }
                    ?>
                </select>
            </td>

        <!-- idioma escrita-->
        
            <td width='152' height='27' align='right'>
                <label>Escrita:</label>
                <select name='idioma4_escrita' id='idioma4_escrita' onfocus="idioma_somenteLeitura(4);">
                    <?php                                
                    for($i=0; $i<$total_nivel; $i++) {
                        if ($idioma_nivel[$i] != $registro['idioma4_escrita']) {
                            echo("	<option value='".$idioma_nivel[$i]."'>".$idioma_nivel[$i]."</option>");
                        } else {
                            echo("	<option selected value='".$idioma_nivel[$i]."'>".$idioma_nivel[$i]."</option>");
                        }
                    }
                    ?>
                </select>
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
                        <label for="declaracao"><b>Declaro, sob a minha inteira responsabilidade, serem exatas e verdadeiras as informa&ccedil;&otilde;es que prestei no presente formul&aacute;rio, comprometendo-me comunicar &agrave; Diretoria de Gest&atilde;o de Pessoas - DGP desta institui&ccedil;&atilde;o, quaisquer altera&ccedil;&otilde;es que houverem.</b></label>
                    </td>
                </tr>  

                <tr>
                    <td>
                        <input type="submit" value="Confirmar" />
                    </td>
                    <td>
                        <input type="button" value="Cancelar" onclick="voltar(1);" />
                    </td>
                </tr>

            </table>    

        </form>
        </div>
        
        <?php require_once("statics/rodape.php"); ?>
        	
    </body>
    
    
    
</html>

<?php   

} else {
    
    echo "
        <script>
            alert(\"Não acesse este arquivo diretamente!\");  
            location.href = \"../../index.php\";      
        </script>";        
}