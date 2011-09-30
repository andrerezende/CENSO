<?php
session_start("autenticacao");

//ini_set('display_errors', 1);
ini_set('max_execution_time','600');    // tempo maximo de espera 10 minutos

if($_SESSION['autenticado']) {

        require_once '../Seguranca.php';
        require_once '../Solicitacoes.php';
        require_once '../../model/Conexao.php';
        require_once 'Excel/reader.php';
        
        $arquivo1 = (isset($_FILES['arquivo1']) ? $_FILES['arquivo1'] : null);
        $arquivo2 = (isset($_FILES['arquivo2']) ? $_FILES['arquivo2'] : null);
        $arquivo3 = (isset($_FILES['arquivo3']) ? $_FILES['arquivo3'] : null);
        //var_dump($arquivo);exit;

        // se todos os arquivos tiverem sido enviados
        if($arquivo1 && $arquivo2 && $arquivo3) {
            
            // se todos forem arquivos do excel
           if(($_FILES['arquivo1']['type'] == "application/vnd.ms-excel") 
                   && ($_FILES['arquivo2']['type'] == "application/vnd.ms-excel")
                   && ($_FILES['arquivo3']['type'] == "application/vnd.ms-excel")) {       

                $data1 = new Spreadsheet_Excel_Reader();
                $data1->setOutputEncoding('UTF-8');
                $data1->read($arquivo1['tmp_name']);
                
                $data2 = new Spreadsheet_Excel_Reader();
                $data2->setOutputEncoding('UTF-8');
                $data2->read($arquivo2['tmp_name']);
                
                $data3 = new Spreadsheet_Excel_Reader();
                $data3->setOutputEncoding('UTF-8');
                $data3->read($arquivo3['tmp_name']);


                // INFORMAÇOES QUE SERÃO EXTRAÍDAS DO PRIMEIRO ARQUIVO
                $campoFromPOST1 = Array("orgao", "siape", "nome", "nomemae", "datanascimento", "cpf", "sexo", "dataprimeiroemprego", "estadocivil", "endresidencial", "bairro", "cidade", "cep", "numero", "complemento", "ddd", "telefone", "email", "sangue", "fatorrh");
                
                $x = 0;        
                for ($i = 2; $i <= $data1->sheets[0]['numRows']; $i++) {            // i, j = celula / x = contagem
                    $y = 0;
                    for ($j = 1; $j <= $data1->sheets[0]['numCols']; $j++) {

                        if(!empty($data1->sheets[0]['cells'][$i][$j])) {  // se a celula nao estiver vazia, inicia a variavel com o valor da celula
                            $reg1[$x][$campoFromPOST1[$y]] = utf8_encode($data1->sheets[0]['cells'][$i][$j]);                                                            
                        }
                        $y++;                            
                    }
                    $x++;
                }
                
                // INFORMAÇOES QUE SERÃO EXTRAÍDAS DO SEGUNDO ARQUIVO
                $campoFromPOST2 = Array("orgao_matricula", "nome", "pispasep", "carteira_trabalho", "serie_carteira_trabalho", "uf_carteira_trabalho", "naturalidade","cod_banco", "agencia", "data_exercicio", "data_publicacao", "portaria_nomeacao_numero", "rg", "rg_orgaoexpeditor", "rg_dataexpedicao", "rg_uf", "certidao_nascimento_cartorio", "certidao_nascimento_livro", "certidao_nascimento_folha", "tituloeleitor", "data_posse");
                
                $x = 0;        
                for ($i = 2; $i <= $data2->sheets[0]['numRows']; $i++) {            // i, j = celula / x = contagem
                    $y = 0;
                    for ($j = 1; $j <= $data2->sheets[0]['numCols']; $j++) {

                        if(!empty($data2->sheets[0]['cells'][$i][$j])) {  // se a celula nao estiver vazia, inicia a variavel com o valor da celula
                            $reg2[$x][$campoFromPOST2[$y]] = utf8_encode($data2->sheets[0]['cells'][$i][$j]);                                                            
                        }
                        $y++;                            
                    }
                    $x++;
                }
                
                // INFORMAÇOES QUE SERÃO EXTRAÍDAS DO TERCEIRO ARQUIVO
                $campoFromPOST3 = Array("cpf", "id_servidor", "nome", "jornada_trabalho", "escolaridade", "grupo_escolaridade", "habilitacao_profissional", "pos_graduacao", "dia_nomeacao", "ingresso_spub", "mes_ing_spub", "cargo", "cod_cargo", "nivel_cargo", "atividade_funcao", "nivel_funcao", "cod_uorg", "nome_uorg", "nomebanco", "agencia", "uf_residencial");
                
                $x = 0;        
                for ($i = 2; $i <= $data3->sheets[0]['numRows']; $i++) {            // i, j = celula / x = contagem
                    $y = 0;
                    for ($j = 1; $j <= $data3->sheets[0]['numCols']; $j++) {

                        if(!empty($data3->sheets[0]['cells'][$i][$j])) {  // se a celula nao estiver vazia, inicia a variavel com o valor da celula
                            $reg3[$x][$campoFromPOST3[$y]] = utf8_encode($data3->sheets[0]['cells'][$i][$j]);
                            
                        }
                        $y++;                            
                    }
                    $x++;
                }

                // $registro é a junção de todos os dados contigos em $reg1, $reg2 e $reg3
                $registro = null;
                
                // EXTRAINDO OS DADOS DE REG1
                for($i=0; $i<count($reg1); $i++) {   // iterando registro
                    while($key = key($reg1[$i])) {   // iterando chave

                        switch(key($reg1[$i])) {
                            case "datanascimento":
                                $ano = substr($reg1[$i]['datanascimento'], 0, 4);
                                $mes = substr($reg1[$i]['datanascimento'], 4, 2);
                                $dia = substr($reg1[$i]['datanascimento'], 6, 2);

                                if($dia && $mes && $ano) {
                                    $registro[$i]['datanascimento'] = "'".Seguranca::anti_injection ($dia."/".$mes."/".$ano)."'";                    
                                } else {
                                    $registro[$i]['datanascimento'] = "null";                    
                                }

                                break;

                            case "sexo":
                                $registro[$i]['sexo'] = ($reg1[$i]['sexo']) ? "'".Seguranca::anti_injection(($reg1[$i]['sexo'] == "M") ? "MASCULINO" : "FEMININO")."'" : "null";                       

                                break;

                            case "dataprimeiroemprego":
                                $ano = substr($reg1[$i]['dataprimeiroemprego'], 0, 4);
                                $mes = substr($reg1[$i]['dataprimeiroemprego'], 4, 2);
                                $dia = substr($reg1[$i]['dataprimeiroemprego'], 6, 2);

                                if($dia && $mes && $ano) {
                                    $registro[$i]['dataprimeiroemprego'] = "'".Seguranca::anti_injection ($dia."/".$mes."/".$ano)."'";                    
                                } else {
                                    $registro[$i]['dataprimeiroemprego'] = "null";
                                }

                                break;

                            case "estadocivil":
                                if($reg1[$i]['estadocivil'] == 1) 
                                    $registro[$i]['estadocivil'] = "'SOLTEIRO'";
                                else if($reg1[$i]['estadocivil'] == 2)
                                    $registro[$i]['estadocivil'] = "'CASADO'";
                                else if($reg1[$i]['estadocivil'] == 3)
                                    $registro[$i]['estadocivil'] = "'VIÚVO'";
                                else if($reg1[$i]['estadocivil'] == 4)
                                    $registro[$i]['estadocivil'] = "'SEPARADO'";
                                else if($reg1[$i]['estadocivil'] == 5)
                                    $registro[$i]['estadocivil'] = "'DIVORCIADO'";
                                else
                                    $registro[$i]['estadocivil'] = "null";

                                break;

                            case "endresidencial":
                                $registro[$i]['endresidencial'] = "'".strtoupper(Seguranca::anti_injection($reg1[$i]['endresidencial']));

                                if(isset($reg1[$i]['numero'])) 
                                    $registro[$i]['endresidencial'] .= " / ".strtoupper(Seguranca::anti_injection($reg1[$i]['numero']));

                                if(isset($reg1[$i]['complemento']))
                                    $registro[$i]['endresidencial'] .= " / ".strtoupper(Seguranca::anti_injection($reg1[$i]['complemento']))."'";
                                else 
                                    $registro[$i]['endresidencial'] .= "'";


                                break;

                            case "telefone":
                                if($reg1[$i]['ddd']) {
                                    $registro[$i]['telefone'] = "'(".Seguranca::anti_injection($reg1[$i]['ddd']).")".Seguranca::anti_injection($reg1[$i]['telefone'])."'";
                                } else {
                                    $registro[$i]['telefone'] = "'".Seguranca::anti_injection($reg1[$i]['telefone'])."'";
                                }

                                break;

                            case "fatorrh":
                                //$registro[$i]['fatorrh'] = ($reg1[$i]['fatorrh'] == "+") ? "'POSITIVO'" : "'NEGATIVO'";
                                $registro[$i]['fatorrh'] = ($reg1[$i]['fatorrh']) ? "'".$reg1[$i]['fatorrh']."'" : "null";

                                break;

                            case "cidade":
                                $registro[$i]['id_cidade'] = ($reg1[$i]['cidade']) ? Conexao::getInstance()->getIdCidadeByNome($reg1[$i]['cidade']) : "null";
                                $registro[$i]['id_cidade'] = ($registro[$i]['id_cidade']) ? $registro[$i]['id_cidade'] : "null";    // nao esta redundante. deixe essa linha ai
                                break;

                            // o que nao entrará no banco
                            case "orgao":
                            case "numero":
                            case "complemento":
                            case "ddd": 
                                break;

                            default:
                                $registro[$i][key($reg1[$i])] = ($reg1[$i][key($reg1[$i])]) ? "'".strtoupper(Seguranca::anti_injection($reg1[$i][key($reg1[$i])]))."'" : "null";
                                break;

                        }

                        $registro[$i]['podeatualizar'] = '1';   // adicionando a flag podeatualizar

                        next($reg1[$i]);
                    }            
                }
                
                $allEstados = Solicitacoes::getAllEstados();
                
                
                // pegando REG2 e REG3 e comparando cada um dos seus registros com os cpfs de REG1
                
                for($i=0; $i<count($registro); $i++) { 
                    
                    // ######### REG2
                    
                    foreach($reg2 as $r2) {
                    // pegando após o 26040 e transformando em valor absoluto, sem zeros na frente para fazer a comparaçao
                    // (os outros arquivos estão dessa forma)
                    $r2['orgao_matricula'] = abs(substr($r2['orgao_matricula'], 5));
                    
                        if($registro[$i]['siape'] == "'".$r2['orgao_matricula']."'") {

                            // trata-se da mesma pessoa
                            // entao mix os dados de $r2 com os de $registro[$i]

                            // PIS/PASEP
                            $registro[$i]['pispasep'] = ($r2['pispasep']) ? "'{$r2['pispasep']}'" : "null";
                            // NATURALIDADE
                            $registro[$i]['naturalidade'] = ($r2['naturalidade']) ? "'{$r2['naturalidade']}'" : "null";
                            // AGENCIA
                            $registro[$i]['agencia'] = ($r2['agencia']) ? "'{$r2['agencia']}'" : "null";
                            // DATA_EXERCICIO
                            $registro[$i]['data_exercicio'] = (isset($r2['data_exercicio'])) ? "'{$r2['data_exercicio']}'" : "null";
                            //PORTARIA_NOMEACAO_DATA
                            $registro[$i]['data_publicacao'] = (isset($r2['data_publicacao'])) ? "'{$r2['data_publicacao']}'" : "null";
                            // PORTARIA_NOMEACAO_NUMERO
                            $registro[$i]['portaria_nomeacao_numero'] = (isset($r2['portaria_nomeacao_numero'])) ? "'{$r2['portaria_nomeacao_numero']}'" : "null";
                            // RG
                            $registro[$i]['rg'] = ($r2['rg']) ? "'{$r2['rg']}'" : "null";
                            // ORGAO_EXPEDITOR
                            $registro[$i]['rg_orgaoexpeditor'] = ($r2['rg_orgaoexpeditor']) ? "'{$r2['rg_orgaoexpeditor']}'" : "null";
                            // RG_ID_ESTADO
                            foreach($allEstados as $uf) {
                                if(trim(strtoupper($r2['rg_uf'])) == $uf['sgl_estado']) {
                                    $registro[$i]['rg_id_estado'] = $uf['id_estado'];
                                    break;
                                } else {
                                    $registro[$i]['rg_id_estado'] = "null";
                                }
                            }
                            // TITULO DE ELEITOR
                            $registro[$i]['tituloeleitor'] = ($r2['tituloeleitor']) ? "'{$r2['tituloeleitor']}'" : "null";
                            // DATA DE POSSE
                            $registro[$i]['data_posse'] = (isset($r2['data_posse'])) ? "'{$r2['data_posse']}'" : "null";

                            break;
                        }

                    }
                    
                    
                    // ############ RG3
                    
                    foreach($reg3 as $r3) {
                    /// TERÁ QUE SER PELO CPF

                        if($registro[$i]['cpf'] == "'{$r3['cpf']}'") {
                            // trata-se da mesma pessoa
                            // entao mix os dados de $r3 com os de $registro[$i]

                            // CARGO / FUNÇÃO
                            if($r3['cargo']) {
                                $registro[$i]['cargofuncao'] = "'".$r3['cargo'];
                                if($r3['atividade_funcao']) {
                                    $registro[$i]['cargofuncao'] .= " / ".$r3['atividade_funcao']."'";
                                } else {
                                    $registro[$i]['cargofuncao'] .= "'";
                                }                                
                            } else {
                                $registro[$i]['cargofuncao'] = "null";
                            }
                            // CODIGO_CARGO
                            $registro[$i]['codigofuncao'] = ($r3['cod_cargo']) ? "'{$r3['cod_cargo']}'" : "null";
                            // NOME DO BANCO
                            $registro[$i]['nomebanco'] = ($r3['nomebanco']) ? "'{$r3['nomebanco']}'" : "null";
                            // ESTADO ATUAL
                            foreach($allEstados as $uf) {
                                if(trim(strtoupper($r3['uf_residencial'])) == $uf['sgl_estado']) {
                                    $registro[$i]['id_estado_atual'] = $uf['id_estado'];
                                    break;
                                } else {
                                    $registro[$i]['id_estado_atual'] = "null";
                                }
                            }


                            break;
                        }

                    }
            
            
                }
            
                
                //print_r($registro);exit;
            $status = Conexao::getInstance()->importaParaBanco($registro);


                //var_dump($status);exit;
                $qtd_registros_adicionados = $status[0];
                $qtd_registros_falhados = $status[1];
                //$erro = $status['erro'];

                if($qtd_registros_adicionados > 0) { ?>
                    
                    <script>
                        alert("<?php echo $qtd_registros_adicionados ?> registros foram importados com sucesso!");  
                    </script>
                    
                    <?php
                     
                     if($qtd_registros_falhados > 0) { ?>
                         
                         <script>
                            alert("$qtd_registros_falhados registros não foram adicionados.");  
                        </script>  
                         
                 <?php }
                     
                } else {    ?>
                        
                     <script>
                        alert("Houve uma falha na importação dos registros."); 
                    </script>
                    
            <?php } ?>
            
                <!-- em todo caso, volte -->
                <script>
                    history.go(-1);    
                </script>

       <?php } else { ?>
                
                <script>
                    alert("Arquivo inválido.");  
                    history.go(-1);    
                </script>
                
       <?php }

        } else {  ?>
            
            <script>
                alert("Não acesse este arquivo diretamente!");  
                location.href = '../../view/html/frmAutenticado.php';
            </script>
            
<?php }

} else {    ?>
        
    <script>
        alert("Você não tem permissão para visualizar esta página.");
        location.href = '../../admin.php';
    </script>
        
<?php }