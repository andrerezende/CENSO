<?php
session_start("autenticacao");

    //ini_set('display_errors', 1);
    
    if($_SESSION['autenticado']) {
    
        require_once '../../model/Conexao.php';
        require_once '../Util_controller.php';
        require_once '../Solicitacoes.php';
        require_once '../classes/Impressao.php';   

        // chega os arrays com indices numericos
        $registrosAlterados = Conexao::getInstance()->getAllregistrosAlterados();
        
        //print_r($registrosAlterados);exit;
        
        if($registrosAlterados != null) {  // se tiver registro alterado
            

            foreach($registrosAlterados as $registroAlterado) {
                $ids_pessoa[] = $registroAlterado['id_pessoa'];
            }

            //print_r($ids_pessoa);exit;    

            $ids_pessoa_unique = array_unique($ids_pessoa);
            foreach($ids_pessoa_unique as $chave=>$valor) {
                $ids_uniques[] = $valor;
            }
            unset($ids_pessoa_unique);    

            //print_r($ids_uniques);exit;
            $k = 0;

            for($i=0; $i<count($ids_uniques); $i++) {
                for($x=0; $x<count($registrosAlterados); $x++) {

                    if($ids_uniques[$i] == $registrosAlterados[$x]['id_pessoa']) {

                        $pessoa = Conexao::getInstance()->getPessoaById($ids_uniques[$i]);
                        $nome_pessoa = $pessoa['nome'];
                        //$nome_pessoa = Conexao::getInstance()->getNomePessoaById($ids_uniques[$i]);

                        $arrImprimir[$nome_pessoa][$k]['campo_alterado'] = $registrosAlterados[$x]['campo_alterado'];
                        $arrImprimir[$nome_pessoa][$k]['valor_antigo'] = $registrosAlterados[$x]['valor_antigo'];
                        $arrImprimir[$nome_pessoa][$k]['novo_valor'] = $pessoa[$registrosAlterados[$x]['campo_alterado']];
                        $arrImprimir[$nome_pessoa][$k]['data_alteracao'] = $registrosAlterados[$x]['data_alteracao'];
                        $arrImprimir[$nome_pessoa][$k]['checado'] = $registrosAlterados[$x]['checado'];
                        $k++;
                    }

                }
                $k = 0;

            }


        // iniciando o buffer

                ob_start();
                ?>
                        <img alt="Logo IFBaiano" src="../../view/html/statics/img/logo_ifbaiano.jpg" width="300" />
                        <p class="titulo-formulario">Relatório de Alterações - CENSO 2011</p>
                        <p></p> 


                    <?php foreach($arrImprimir as $nome_alterado=>$arr_alterado) { ?>

                        <table border="0" width="760" border="0" align='center' class="titulo-tabela">

                            <tr>
                                <td width="80%" align='left'>
                                    Servidor: <b><?php echo $nome_alterado; ?></b>
                                </td>
                                <td width="20%">
                                    Total de alteraçoes: <b><?php echo count($arr_alterado); ?></b>
                                </td>                        
                            </tr>

                        </table>

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


                    <?php for($i=0; $i<count($arr_alterado); $i++) { ?>

                        <table border="0" width="760" border="0" align='center' class="conteudo-tabela">
                            <tr>
                                <td width="20%" align='left'>
                                    <?php echo Util_controller::nomeCampo($arr_alterado[$i]['campo_alterado']); ?>
                                </td>
                                <td width="35%" align='left'>
                                    <div id="label_original_impressao">
                                        <?php // buscando o nome do estado
                                        if($arr_alterado[$i]['campo_alterado'] == "id_estado_nasc" || $arr_alterado[$i]['campo_alterado'] == "id_estado_atual" || $arr_alterado[$i]['campo_alterado'] == "rg_id_estado" || $arr_alterado[$i]['campo_alterado'] == "registroprofissional_id_estado") {
                                            $estado = Solicitacoes::getEstadoByID($arr_alterado[$i]['valor_antigo']);
                                            if($estado) {
                                                echo $estado['sgl_estado'];
                                            }


                                            // buscando o nome da cidade
                                        } else if ($arr_alterado[$i]['campo_alterado'] == "id_cidade") {
                                            $cidade = Solicitacoes::getCidadeByID($arr_alterado[$i]['valor_antigo']); 
                                            if($cidade) {
                                                echo $cidade['nome_cidade'];
                                            }                                                                


                                        } else {
                                            echo $arr_alterado[$i]['valor_antigo']; 
                                        }
                                        ?>
                                    </div>
                                </td>

                                <td width="35%" align='left'>
                                    <div id="label_alterado_impressao">
                                        <?php // buscando o nome do estado
                                        if($arr_alterado[$i]['campo_alterado'] == "id_estado_nasc" || $arr_alterado[$i]['campo_alterado'] == "id_estado_atual"  || $arr_alterado[$i]['campo_alterado'] == "rg_id_estado" || $arr_alterado[$i]['campo_alterado'] == "registroprofissional_id_estado") {
                                            $estado = Solicitacoes::getEstadoByID($arr_alterado[$i]['novo_valor']); 
                                            if($estado) {
                                                echo $estado['sgl_estado'];
                                            }                                                                

                                            // buscando o nome da cidade
                                        } else if ($arr_alterado[$i]['campo_alterado'] == "id_cidade") {
                                            $cidade = Solicitacoes::getCidadeByID($arr_alterado[$i]['novo_valor']); 
                                            if($cidade) {
                                                echo $cidade['nome_cidade'];
                                            }                                                                

                                        } else {
                                            echo $arr_alterado[$i]['novo_valor']; 
                                        }
                                        ?>
                                    </div>
                                </td>

                                <td width="10%" align='left'>
                                    <?php 
                                    if($arr_alterado[$i]['checado'] == 1) { ?>
                                        <div id="label_sim_impressao">
                                            <?php echo 'SIM'; ?>
                                        </div>
                                    <?php } else { ?>
                                        <div id="label_nao_impressao">
                                            <?php echo 'NÃO'; ?>
                                        </div>
                                    <?php } ?>
                                </td>

                            </tr>
                        </table>

                <?php } 

                }  ?>


            <?php
                $html = ob_get_clean();
                $footerName = "CENSO 2011";
                $stylesheetAddress = '../../view/html/statics/css/estilo.css';
                $archiveName = date("ymdhis").'_relatorioAlteracaoCENSO2011';
                
                $imprimirAlteracoes = new Impressao($html, $footerName, $stylesheetAddress, $archiveName);
                $imprimirAlteracoes->gerarPDF();
                

        } else {
            echo "<script>alert(\"Nenhum registro foi atualizado na base.\");
                    history.go(-1);  
                    </script>";
        }
    
    } else {
        echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\" />
        <script>alert(\"Você não tem permissão para visualizar esta página.\");
                location.href = \"../../index.php\";      
                </script>";
    }
    
?>
