<!-- HTML único de pessoa para ser usado nas impressões -->

<table width="760" border="0" align='center' class="titulo-tabela">				
    <tr>                                
        <td align="left">
            <label><b>Dados Pessoais</b></label>
        </td>
    </tr>
</table>

            <table width="760" border="0" align='center' class="conteudo-tabela">

                <tr height="27">
                    <td width="35%" height="27" align="left">                            
                        <label><b>Nome:</b></label>
                        <label><?php echo $registroFromBanco['nome']; ?></label>     
                    </td>                            

                    <td width="20%" height="27" align="left">
                        <label><b>Matrícula SIAPE:</b></label>
                        <label><?php echo $registroFromBanco['siape']; ?></label> 
                    </td>

                    <td width="15%" height="27" align='right'>
                        <label><b>Sexo:</b></label>
                        <label><?php echo $registroFromBanco['sexo']; ?></label>                            
                    </td>

                    <td width="30%" height="27" align='right'>
                        <label><b>Data de Nascimento:</b></label>
                        <label><?php echo $registroFromBanco['datanascimento']; ?></label>                            
                    </td>
                </tr>

            </table>

            <table width="760" border="0" align='center' class="conteudo-tabela">

                <tr>
                    <td width="30%" height="27" align="left">                            
                        <label><b>Naturalidade:</b></label>
                        <label><?php echo $registroFromBanco['naturalidade']; ?></label>     
                    </td>                            

                    <td width="30%" height="27" align="left">
                        <label><b>Nacionalidade:</b></label>
                        <label><?php echo $registroFromBanco['nacionalidade']; ?></label> 
                    </td>

                    <td width="10%" height="27" align='center'>
                        <label><b>UF:</b></label>
                        <label>
                        <?php 
                        foreach($allEstados as $estado) {
                            if($registroFromBanco['id_estado_nasc'] == $estado['id_estado']) {
                                echo $estado['sgl_estado'];  
                                break;
                            }
                        }
                        ?>
                        </label>                            
                    </td>

                    <td width="30%" height="27" align='left'>
                        <label><b>Estado Civil:</b></label>
                        <label><?php echo $registroFromBanco['estadocivil']; ?></label>                            
                    </td>
                </tr>

            </table>

            <table width="760" border="0" align='center' class="conteudo-tabela">

                <tr>
                    <td width="33%" height="27" align="left">                            
                        <label><b>Conjuge:</b></label>
                        <label><?php echo $registroFromBanco['conjuge']; ?></label>     
                    </td>                            

                    <td width="33%" height="27" align="left">
                        <label><b>Nome do Pai:</b></label>
                        <label><?php echo $registroFromBanco['nomepai']; ?></label> 
                    </td>

                    <td width="34%" height="27" align='left'>
                        <label><b>Nome da Mãe:</b></label>
                        <label><?php echo $registroFromBanco['nomemae']; ?></label>                            
                    </td>

                </tr>

            </table>                           

            <table width="760" border="0" align='center' class="conteudo-tabela">

                <tr>
                    <td width="50%" height="27" align="left">                            
                        <label><b>Endereço:</b></label>
                        <label><?php echo $registroFromBanco['endresidencial']; ?></label>     
                    </td>                            

                    <td width="20%" height="27" align="left">
                        <label><b>Bairro:</b></label>
                        <label><?php echo $registroFromBanco['bairro']; ?></label> 
                    </td>

                    <td width="15%" height="27" align='right'>
                        <label><b>Cep:</b></label>
                        <label><?php echo $registroFromBanco['cep']; ?></label>                            
                    </td>

                    <td width="15%" height="27" align='center'>
                        <label><b>UF:</b></label>
                        <label>
                            <?php 
                            foreach($allEstados as $estado) {
                                if($registroFromBanco['id_estado_atual'] == $estado['id_estado']) {
                                    echo $estado['sgl_estado'];  
                                    break;
                                }
                            }
                            ?>
                        </label>                            
                    </td>

                </tr>

            </table>

            <table width="760" border="0" align='center' class="conteudo-tabela">

                <tr>

                    <td width="20%" height="27" align="left">
                        <label><b>Cidade:</b></label>
                        <label>
                            <?php echo $registroFromBanco['nome_cidade']; ?>
                        </label>                            
                    </td>

                    <td width="20%" height="27" align='right'>
                        <label><b>Telefone:</b></label>
                        <label>
                            <?php echo $registroFromBanco['telefone']; ?>
                        </label>                            
                    </td>

                    <td width="20%" height="27" align='right'>
                        <label><b>Celular:</b></label>
                        <label>
                            <?php echo $registroFromBanco['celular']; ?>
                        </label>                            
                    </td>

                    <td width="20%" height="27" align='right'>
                        <label><b>E-mail:</b></label>
                        <label>
                            <?php echo $registroFromBanco['email']; ?>
                        </label>                            
                    </td>

                </tr>

            </table>

            <!-- Caracteristicas físicas -->

        <table width="760" border="0" align='center' class="titulo-tabela">				
            <tr>                                
                <td align="left">
                    <label><b>Caracteristicas Físicas</b></label>
                </td>
            </tr>
        </table> 

        <table width="760" border="0" align='center' class="conteudo-tabela">

            <tr>

                <td width="20%" height="27" align="left">
                    <label><b>Grupo Sanguineo:</b></label>
                    <label>
                        <?php echo $registroFromBanco['sangue']; ?>
                    </label>                            
                </td>

                <td width="20%" height="27" align='center'>
                    <label><b>Fator RH:</b></label>
                    <label>
                        <?php echo $registroFromBanco['fatorrh']; ?>
                    </label>                            
                </td>

                <td width="20%" height="27" align='center'>
                    <label><b>Cor:</b></label>
                    <label>
                        <?php echo $registroFromBanco['cor']; ?>
                    </label>                            
                </td>

                <td width="20%" height="27" align='center'>
                    <label><b>Necessidade Especial:</b></label>
                    <label>
                        <?php echo $registroFromBanco['necessidade_especial']; ?>
                    </label>                            
                </td>

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

                <td width="15%" height="27" align="left">
                    <label><b>CPF:</b></label>
                    <label>
                        <?php echo $registroFromBanco['cpf']; ?>
                    </label>                            
                </td>

                <td width="15%" height="27" align='center'>
                    <label><b>Pis/Pasep:</b></label>
                    <label>
                        <?php echo $registroFromBanco['pispasep']; ?>
                    </label>                            
                </td>

                <td width="30%" height="27" align='center'>
                    <label><b>Certidão de Nascimento:</b></label>
                    <?php 
                    foreach($allEstados as $estado) {
                        if($registroFromBanco['certidao_nascimentocasamento_id_estado'] == $estado['id_estado']) {
                            $registroFromBanco['certidao_nascimentocasamento_id_estado'] = $estado['sgl_estado'];  
                            break;
                        }
                    }
                    ?>
                    <label>
                        <?php echo $registroFromBanco['certidao_nascimentocasamento_id_estado'].$registroFromBanco['certidao_nascimentocasamento']; ?>
                    </label>                            
                </td>

                <td width="20%" height="27" align='center'>
                    <label><b>Folha:</b></label>
                    <label>
                        <?php echo $registroFromBanco['certidao_nascimentocasamento_folha']; ?>
                    </label>                            
                </td>

                <td width="20%" height="27" align='center'>
                    <label><b>Livro:</b></label>
                    <label><?php echo $registroFromBanco['certidao_nascimentocasamento_livro']; ?></label>                          
                </td>

            </tr>

        </table>


        <table width="760" border="0" align='center' class="conteudo-tabela">

            <tr>

                <td width="25%" height="27" align="left">
                    <label><b>RG:</b></label>
                    <label>
                        <?php echo $registroFromBanco['rg']; ?>
                    </label>                            
                </td>

                <td width="25%" height="27" align='center'>
                    <label><b>Orgão Expeditor:</b></label>
                    <label>
                        <?php echo $registroFromBanco['rg_orgaoexpeditor']; ?>
                    </label>                            
                </td>

                <td width="25%" height="27" align='center'>
                    <label><b>UF:</b></label>
                    <label>
                        <?php 
                            foreach($allEstados as $estado) {
                                if($registroFromBanco['rg_id_estado'] == $estado['id_estado']) {
                                    echo $estado['sgl_estado'];  
                                    break;
                                }
                            }
                            ?>
                    </label>                            
                </td>

                <td width="25%" height="27" align='center'>
                    <label><b>Data de Expedicao:</b></label>
                    <label>
                        <?php echo $registroFromBanco['rg_dataexpedicao']; ?>
                    </label>                            
                </td>

            </tr>

        </table>


        <table width="760" border="0" align='center' class="conteudo-tabela">

            <tr>

                <td width="40%" height="27" align='left'>
                    <label><b>Registro Profissional (conselho):</b></label>
                    <label><?php echo $registroFromBanco['registroprofissional']; ?></label>                          
                </td>

                <td width="25%" height="27" align="left">
                    <label><b>Orgão Expeditor:</b></label>
                    <label><?php echo $registroFromBanco['registroprofissional_orgaoexpeditor']; ?></label>                            
                </td>

                <td width="10%" height="27" align='center'>
                    <label><b>UF:</b></label>
                        <label>
                            <?php 
                            foreach($allEstados as $estado) {
                                if($registroFromBanco['registroprofissional_id_estado'] == $estado['id_estado']) {
                                    echo $estado['sgl_estado'];  
                                    break;
                                }
                            }
                            ?>
                        </label>                            
                </td>

                <td width="25%" height="27" align='center'>
                    <label><b>Data de Expedição:</b></label>
                    <label><?php echo $registroFromBanco['registroprofissional_dataexpedicao']; ?></label>    
                </td>

            </tr>

    </table>


    <table width="760" border="0" align='center' class="conteudo-tabela">

            <tr>

                <td width="30%" height="27" align='left'>
                    <label><b>Título de eleitor:</b></label>
                    <label><?php echo $registroFromBanco['tituloeleitor']; ?></label>                              
                </td>

                <td width="10%" height="27" align="left">
                    <label><b>Zona:</b></label>
                    <label><?php echo $registroFromBanco['tituloeleitor_zona']; ?></label>                            
                </td>

                <td width="10%" height="27" align='center'>
                    <label><b>Seção:</b></label>
                    <label><?php echo $registroFromBanco['tituloeleitor_secao']; ?></label>                                                    
                </td>

                <td width="25%" height="27" align='center'>
                    <label><b>Local:</b></label>
                    <label><?php echo $registroFromBanco['tituloeleitor_local']; ?></label>                            
                </td>

                <td width="25%" height="27" align='center'>
                    <label><b>Data de Expedição:</b></label>
                    <label><?php echo $registroFromBanco['tituloeleitor_dataexpedicao']; ?></label>                            
                </td>

            </tr>

    </table>


    <table width="760" border="0" align='center' class="conteudo-tabela">

        <tr>

            <td width="30%" height="27" align='left'>
                <label><b>Certificado de Reservista:</b></label>
                <label><?php echo $registroFromBanco['reservista']; ?></label>                            
            </td>

            <td width="20%" height="27" align="left">
                <label><b>Orgão Expeditor:</b></label>
                <label><?php echo $registroFromBanco['reservista_orgaoexpeditor']; ?></label>                            
            </td>

            <td width="15%" height="27" align='center'>
                <label><b>Série:</b></label>
                <label><?php echo $registroFromBanco['reservista_serie']; ?></label>                            
            </td>

            <td width="35%" height="27" align='center'>
                <label><b>Data do Primeiro Emprego:</b></label>
                <label><?php echo $registroFromBanco['dataprimeiroemprego']; ?></label>                            
            </td>

        </tr>

    </table>


    <table width="760" border="0" align='center' class="conteudo-tabela">

        <tr>

            <td width="30%" height="27" align='left'>
                <label><b>Número do banco:</b></label>
                <label><?php echo $registroFromBanco['numerobanco']; ?></label>                            
            </td>

            <td width="30%" height="27" align='left'>
                <label><b>Nome do Banco:</b></label>
                <label><?php echo $registroFromBanco['nomebanco']; ?></label>                             
            </td>

            <td width="20%" height="27" align='center'>
                <label><b>Agência:</b></label>
                <label><?php echo $registroFromBanco['agencia']; ?></label>                            
            </td>

            <td width="20%" height="27" align='center'>
                <label><b>Conta:</b></label>
                <label><?php echo $registroFromBanco['conta']; ?></label>                             
            </td>

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
                <td width="30%" height="27" align='left'>
                    <label><b>Cargo/Função:</b></label>
                    <label><?php echo $registroFromBanco['cargofuncao']; ?></label>                            
                </td>

                <td width="20%" height="27" align='center'>
                    <label><b>Código:</b></label>
                    <label><?php echo $registroFromBanco['codigofuncao']; ?></label>                            
                </td>

                <td width="20%" height="27" align='center'>
                    <label><b>Padrão:</b></label>
                    <label><?php echo $registroFromBanco['padrao']; ?></label>                            
                </td>

                <td width="30%" height="27" align='center'>
                    <label><b>Portaria Nomeação (número):</b></label>
                    <label><?php echo $registroFromBanco['portaria_nomeacao_numero']; ?></label>                            
                </td>
            </tr>

        </table>

        <table width="760" border="0" align='center' class="conteudo-tabela">

            <tr>
                <td width="20%" height="27" align='left'>
                    <label><b>Portaria nomeação (data):</b></label>
                    <label><?php echo $registroFromBanco['portaria_nomeacao_data']; ?></label>                             
                </td>

                <td width="20%" height="27" align='center'>
                    <label><b>Data de publicação:</b></label>
                    <label><?php echo $registroFromBanco['data_publicacao']; ?></label>                          
                </td>

                <td width="20%" height="27" align='center'>
                    <label><b>Data da posse:</b></label>
                    <label><?php echo $registroFromBanco['data_posse']; ?></label>                        
                </td>

                <td width="20%" height="27" align='center'>
                    <label><b>Data de exercício:</b></label>
                    <label><?php echo $registroFromBanco['data_exercicio']; ?></label>                           
                </td>
                
                <td width="20%" height="27" align='center'>
                    <label><b>Lotação:</b></label>
                    <label><?php echo $registroFromBanco['lotacao']; ?></label>                           
                </td>
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
                <td width="20%" height="27" align='left'>
                    <label><b>Segundo grau:</b></label>
                    <label><?php echo $registroFromBanco['segundograu']; ?></label>                            
                </td>

                <td width="30%" height="27" align='center'>
                    <label><b>Instituição:</b></label>
                    <label><?php echo $registroFromBanco['segundograu_instituicao']; ?></label>                            
                </td>
                
                <td width="30%" height="27" align='left'>
                    <label><b>Curso:</b></label>
                    <label><?php echo $registroFromBanco['segundograu_curso']; ?></label>                            
                </td>

                <td width="20%" height="27" align='center'>
                    <label><b>Data de conclusão:</b></label>
                    <label><?php echo $registroFromBanco['segundograu_dataconclusao']; ?></label>                            
                </td>
            </tr>

            <!-- terceiro grau -->
            <tr>
                <td width="20%" height="27" align='center'>
                    <label><b>Terceiro grau:</b></label>
                    <label><?php echo $registroFromBanco['terceirograu']; ?></label>                            
                </td>

                <td width="30%" height="27" align='center'>
                    <label><b>Instituição:</b></label>
                    <label><?php echo $registroFromBanco['terceirograu_instituicao']; ?></label>                            
                </td>
                
                <td width="30%" height="27" align='center'>
                    <label><b>Curso:</b></label>
                    <label><?php echo $registroFromBanco['terceirograu_curso']; ?></label>                            
                </td>

                <td width="20%" height="27" align='center'>
                    <label><b>Data de conclusão:</b></label>
                    <label><?php echo $registroFromBanco['terceirograu_dataconclusao']; ?></label>                            
                </td>
            </tr>

        </table>


        <!-- pos graduacao 1 -->
        <table width="760" border="0" align='center' class="conteudo-tabela">

            <tr>
                <td width="30%" height="27" align='left'>
                    <label><b>Pós-graduação 1:</b></label>
                    <label><?php echo $registroFromBanco['posgraduacao1_tipo']; ?></label>                            
                </td>

                <td width="20%" height="27" align='center'>
                    <label><b>Situação:</b></label>
                    <label><?php echo $registroFromBanco['posgraduacao1_situacao']; ?></label>
                </td>

                <td width="50%" height="27" align='center'>
                    <label><b>Curso:</b></label>
                    <label><?php echo $registroFromBanco['posgraduacao1_curso']; ?></label>
                </td>
            </tr>

        </table>

        <table width="760" border="0" align='center' class="conteudo-tabela">

            <tr>
                <td width="40%" height="27" align='left'>
                    <label><b>Instituição:</b></label>
                    <label><?php echo $registroFromBanco['posgraduacao1_instituicao']; ?></label>
                </td>

                <td width="20%" height="27" align='center'>
                    <label><b>Carga horária:</b></label>
                    <label><?php echo $registroFromBanco['posgraduacao1_cargahoraria']; ?></label>
                </td>

                <td width="40%" height="27" align='center'>
                    <label><b>Data de conclusão:</b></label>
                    <label><?php echo $registroFromBanco['posgraduacao1_dataconclusao']; ?></label>
                </td>
            </tr>

        </table>


        <!-- pos graduacao 2 -->
        <table width="760" border="0" align='center' class="conteudo-tabela">

            <tr>
                <td width="30%" height="27" align='left'>
                    <label><b>Pós-graduação 2:</b></label>
                    <label><?php echo $registroFromBanco['posgraduacao2_tipo']; ?></label>                            
                </td>

                <td width="20%" height="27" align='center'>
                    <label><b>Situação:</b></label>
                    <label><?php echo $registroFromBanco['posgraduacao2_situacao']; ?></label>
                </td>

                <td width="50%" height="27" align='center'>
                    <label><b>Curso:</b></label>
                    <label><?php echo $registroFromBanco['posgraduacao2_curso']; ?></label>
                </td>
            </tr>

        </table>

        <table width="760" border="0" align='center' class="conteudo-tabela">

            <tr>
                <td width="40%" height="27" align='left'>
                    <label><b>Instituição:</b></label>
                    <label><?php echo $registroFromBanco['posgraduacao2_instituicao']; ?></label>
                </td>

                <td width="20%" height="27" align='center'>
                    <label><b>Carga horária:</b></label>
                    <label><?php echo $registroFromBanco['posgraduacao2_cargahoraria']; ?></label>
                </td>

                <td width="40%" height="27" align='center'>
                    <label><b>Data de conclusão:</b></label>
                    <label><?php echo $registroFromBanco['posgraduacao2_dataconclusao']; ?></label>
                </td>
            </tr>

        </table>


         <!-- pos graduacao 3 -->
        <table width="760" border="0" align='center' class="conteudo-tabela">

            <tr>
                <td width="30%" height="27" align='left'>
                    <label><b>Pós-graduação 3:</b></label>
                    <label><?php echo $registroFromBanco['posgraduacao3_tipo']; ?></label>                            
                </td>

                <td width="20%" height="27" align='center'>
                    <label><b>Situação:</b></label>
                    <label><?php echo $registroFromBanco['posgraduacao3_situacao']; ?></label>
                </td>

                <td width="50%" height="27" align='center'>
                    <label><b>Curso:</b></label>
                    <label><?php echo $registroFromBanco['posgraduacao3_curso']; ?></label>
                </td>
            </tr>

        </table>

        <table width="760" border="0" align='center' class="conteudo-tabela">

            <tr>
                <td width="40%" height="27" align='left'>
                    <label><b>Instituição:</b></label>
                    <label><?php echo $registroFromBanco['posgraduacao3_instituicao']; ?></label>
                </td>

                <td width="20%" height="27" align='center'>
                    <label><b>Carga horária:</b></label>
                    <label><?php echo $registroFromBanco['posgraduacao3_cargahoraria']; ?></label>
                </td>

                <td width="40%" height="27" align='center'>
                    <label><b>Data de conclusão:</b></label>
                    <label><?php echo $registroFromBanco['posgraduacao3_dataconclusao']; ?></label>
                </td>
            </tr>

        </table>


         <!-- pos graduacao 4 -->
        <table width="760" border="0" align='center' class="conteudo-tabela">

            <tr>
                <td width="30%" height="27" align='left'>
                    <label><b>Pós-graduação 4:</b></label>
                    <label><?php echo $registroFromBanco['posgraduacao4_tipo']; ?></label>                            
                </td>

                <td width="20%" height="27" align='center'>
                    <label><b>Situação:</b></label>
                    <label><?php echo $registroFromBanco['posgraduacao4_situacao']; ?></label>
                </td>

                <td width="50%" height="27" align='center'>
                    <label><b>Curso:</b></label>
                    <label><?php echo $registroFromBanco['posgraduacao4_curso']; ?></label>
                </td>
            </tr>

        </table>

        <table width="760" border="0" align='center' class="conteudo-tabela">

            <tr>
                <td width="40%" height="27" align='left'>
                    <label><b>Instituição:</b></label>
                    <label><?php echo $registroFromBanco['posgraduacao4_instituicao']; ?></label>
                </td>

                <td width="20%" height="27" align='center'>
                    <label><b>Carga horária:</b></label>
                    <label><?php echo $registroFromBanco['posgraduacao4_cargahoraria']; ?></label>
                </td>

                <td width="40%" height="27" align='center'>
                    <label><b>Data de conclusão:</b></label>
                    <label><?php echo $registroFromBanco['posgraduacao4_dataconclusao']; ?></label>
                </td>
            </tr>

        </table>
         
         <table width="760" border="0" align='center' class="conteudo-tabela">

            <tr>
                <td width="35%" height="27" align='left'>
                    <label><b>Desejo fazer Especialização em:</b></label>
                    <label><?php echo $registroFromBanco['desejo_especializacao_area']; ?></label>
                </td>

                <td width="35%" height="27" align='center'>
                    <label><b>Desejo fazer Mestrado em:</b></label>
                    <label><?php echo $registroFromBanco['desejo_mestrado_area']; ?></label>
                </td>

                <td width="30%" height="27" align='center'>
                    <label><b>Desejo fazer Doutorado em:</b></label>
                    <label><?php echo $registroFromBanco['desejo_doutorado_area']; ?></label>
                </td>
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

    <!-- IDIOMA 1 -->

    <tr>
        <td width='152' height='27' align='left'>
            <label><b>Idioma:</b></label>
            <label class="label_apresentado"><?php echo $registroFromBanco['idioma1']; ?></label>
        </td>

    <!-- idioma leitura--> 

        <td width='152' height='27' align='left'>
            <label><b>Leitura:</b></label>
            <label class="label_apresentado"><?php echo $registroFromBanco['idioma1_leitura']; ?></label>
        </td>

    <!-- idioma fala--> 

        <td width='152' height='27' align='left'>
            <label><b>Fala:</b></label>
            <label class="label_apresentado"><?php echo $registroFromBanco['idioma1_fala']; ?></label>
        </td>

    <!-- idioma escrita-->

        <td width='152' height='27' align='left'>
            <label><b>Escrita:</b></label>
            <label class="label_apresentado"><?php echo $registroFromBanco['idioma1_escrita']; ?></label>
        </td>
    </tr>


    <!-- IDIOMA 2 -->

    <tr>
        <!-- idioma --> 
        <td width='152' height='27' align='left' >
            <label><b>Idioma:</b></label>
            <label class="label_apresentado"><?php echo $registroFromBanco['idioma2']; ?></label>
        </td>

    <!-- idioma leitura--> 

        <td width='152' height='27' align='left'>
            <label><b>Leitura:</b></label>
            <label class="label_apresentado"><?php echo $registroFromBanco['idioma2_leitura']; ?></label>
        </td>

    <!-- idioma fala--> 

        <td width='152' height='27' align='left'>
            <label><b>Fala:</b></label>
            <label class="label_apresentado"><?php echo $registroFromBanco['idioma2_fala']; ?></label>
        </td>

    <!-- idioma escrita-->

        <td width='152' height='27' align='left'>
            <label><b>Escrita:</b></label>
            <label class="label_apresentado"><?php echo $registroFromBanco['idioma2_escrita']; ?></label>
        </td>
    </tr>

    <!-- IDIOMA 3 -->

    <tr>
        <!-- idioma --> 
        <td width='152' height='27' align='left'>
            <label><b>Idioma:</b></label>
            <label class="label_apresentado"><?php echo $registroFromBanco['idioma3']; ?></label>
        </td>

    <!-- idioma leitura--> 

        <td width='152' height='27' align='left'>
            <label><b>Leitura:</b></label>
            <label class="label_apresentado"><?php echo $registroFromBanco['idioma3_leitura']; ?></label>
        </td>

    <!-- idioma fala--> 

        <td width='152' height='27' align='left'>
            <label><b>Fala:</b></label>
            <label class="label_apresentado"><?php echo $registroFromBanco['idioma3_fala']; ?></label>
        </td>

    <!-- idioma escrita-->

        <td width='152' height='27' align='left'>
            <label><b>Escrita:</b></label>
            <label class="label_apresentado"><?php echo $registroFromBanco['idioma3_escrita']; ?></label>
        </td>
    </tr>

    <!-- IDIOMA 4 -->

    <tr>
        <!-- idioma --> 
        <td width='152' height='27' align='left'>
            <label><b>Idioma:</b></label>
            <label class="label_apresentado"><?php echo $registroFromBanco['idioma4']; ?></label>
        </td>

    <!-- idioma leitura--> 

        <td width='152' height='27' align='left'>
            <label><b>Leitura:</b></label>
            <label class="label_apresentado"><?php echo $registroFromBanco['idioma4_leitura']; ?></label>
        </td>

    <!-- idioma fala--> 

        <td width='152' height='27' align='left'>
            <label><b>Fala:</b></label>
            <label class="label_apresentado"><?php echo $registroFromBanco['idioma4_fala']; ?></label>
        </td>

    <!-- idioma escrita-->

        <td width='152' height='27' align='left'>
            <label><b>Escrita:</b></label>
            <label class="label_apresentado"><?php echo $registroFromBanco['idioma4_escrita']; ?></label>
        </td>
    </tr> 
</table>