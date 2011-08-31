<?php
session_start("autenticacao");

if($_SESSION['autenticado']) {

        require_once '../Seguranca.php';
        require_once '../../model/Conexao.php';
        require_once 'Excel/reader.php';
        //ini_set('display_errors', 1);

        $arquivo = (isset($_FILES['arquivo']) ? $_FILES['arquivo'] : null);
        //var_dump($arquivo);exit;

        if($arquivo) {
            //var_dump($_FILES['arquivo']['type']);exit;
           if($_FILES['arquivo']['type'] == "application/vnd.ms-excel") {       

                $data = new Spreadsheet_Excel_Reader();
                $data->setOutputEncoding('UTF-8');

                $data->read($arquivo['tmp_name']);

                //var_dump($data->sheets[0]['numCols']);exit;

                $campoFromPOST = Array("orgao", "siape", "nome", "nomemae", "datanascimento", "cpf", "sexo", "dataprimeiroemprego", "estadocivil", "endresidencial", "bairro", "cidade", "cep", "numero", "complemento", "ddd", "telefone", "email", "sangue", "fatorrh");
                //var_dump($campo);exit;
                $x = 0;        
                for ($i = 2; $i <= $data->sheets[0]['numRows']; $i++) {            // i, j = celula / x = contagem
                    $y = 0;
                    for ($j = 1; $j <= $data->sheets[0]['numCols']; $j++) {

                        if(!empty($data->sheets[0]['cells'][$i][$j])) {  // se a celula nao estiver vazia, inicia a variavel com o valor da celula
                            $reg[$x][$campoFromPOST[$y]] = utf8_encode($data->sheets[0]['cells'][$i][$j]);                                                            
                        }
                        $y++;                            
                    }
                    $x++;
                }


                //print_r($reg);exit;


                for($i=0; $i<count($reg); $i++) {   // iterando registro
                    while($key = key($reg[$i])) {   // iterando chave

                        switch(key($reg[$i])) {
                            case "datanascimento":
                                $ano = substr($reg[$i]['datanascimento'], 0, 4);
                                $mes = substr($reg[$i]['datanascimento'], 4, 2);
                                $dia = substr($reg[$i]['datanascimento'], 6, 2);

                                if($dia && $mes && $ano) {
                                    $registro[$i]['datanascimento'] = "'".Seguranca::anti_injection ($dia."/".$mes."/".$ano)."'";                    
                                } else {
                                    $registro[$i]['datanascimento'] = "null";                    
                                }

                                break;

                            case "sexo":
                                $registro[$i]['sexo'] = ($reg[$i]['sexo']) ? "'".Seguranca::anti_injection(($reg[$i]['sexo'] == "M") ? "MASCULINO" : "FEMININO")."'" : "null";                       

                                break;

                            case "dataprimeiroemprego":
                                $ano = substr($reg[$i]['dataprimeiroemprego'], 0, 4);
                                $mes = substr($reg[$i]['dataprimeiroemprego'], 4, 2);
                                $dia = substr($reg[$i]['dataprimeiroemprego'], 6, 2);

                                if($dia && $mes && $ano) {
                                    $registro[$i]['dataprimeiroemprego'] = "'".Seguranca::anti_injection ($dia."/".$mes."/".$ano)."'";                    
                                } else {
                                    $registro[$i]['dataprimeiroemprego'] = "null";
                                }

                                break;

                            case "estadocivil":
                                if($reg[$i]['estadocivil'] == 1) 
                                    $registro[$i]['estadocivil'] = "'SOLTEIRO'";
                                else if($reg[$i]['estadocivil'] == 2)
                                    $registro[$i]['estadocivil'] = "'CASADO'";
                                else if($reg[$i]['estadocivil'] == 3)
                                    $registro[$i]['estadocivil'] = "'VIÚVO'";
                                else if($reg[$i]['estadocivil'] == 4)
                                    $registro[$i]['estadocivil'] = "'SEPARADO'";
                                else if($reg[$i]['estadocivil'] == 5)
                                    $registro[$i]['estadocivil'] = "'DIVORCIADO'";
                                else
                                    $registro[$i]['estadocivil'] = "null";

                                break;

                            case "endresidencial":
                                $registro[$i]['endresidencial'] = "'".strtoupper(Seguranca::anti_injection($reg[$i]['endresidencial']));

                                if(isset($reg[$i]['numero'])) 
                                    $registro[$i]['endresidencial'] .= " / ".strtoupper(Seguranca::anti_injection($reg[$i]['numero']));

                                if(isset($reg[$i]['complemento']))
                                    $registro[$i]['endresidencial'] .= " / ".strtoupper(Seguranca::anti_injection($reg[$i]['complemento']))."'";
                                else 
                                    $registro[$i]['endresidencial'] .= "'";


                                break;

                            case "telefone":
                                if($reg[$i]['ddd']) {
                                    $registro[$i]['telefone'] = "'(".Seguranca::anti_injection($reg[$i]['ddd']).")".Seguranca::anti_injection($reg[$i]['telefone'])."'";
                                } else {
                                    $registro[$i]['telefone'] = "'".Seguranca::anti_injection($reg[$i]['telefone'])."'";
                                }

                                break;

                            case "fatorrh":
                                //$registro[$i]['fatorrh'] = ($reg[$i]['fatorrh'] == "+") ? "'POSITIVO'" : "'NEGATIVO'";
                                $registro[$i]['fatorrh'] = ($reg[$i]['fatorrh']) ? "'".$reg[$i]['fatorrh']."'" : "null";

                                break;

                            case "cidade":
                                $registro[$i]['id_cidade'] = ($reg[$i]['cidade']) ? Conexao::getInstance()->getIdCidadeByNome($reg[$i]['cidade']) : "null";
                                $registro[$i]['id_cidade'] = ($registro[$i]['id_cidade']) ? $registro[$i]['id_cidade'] : "null";    // nao esta redundante. deixe essa linha ai
                                break;

                            case "orgao":
                            case "numero":
                            case "complemento":
                            case "ddd": 
                                break;

                            default:
                                $registro[$i][key($reg[$i])] = ($reg[$i][key($reg[$i])]) ? "'".strtoupper(Seguranca::anti_injection($reg[$i][key($reg[$i])]))."'" : "null";
                                break;

                        }

                        $registro[$i]['podeatualizar'] = '1';   // adicionando a flag podeatualizar

                        next($reg[$i]);
                    }            
                }

                //print_r($registro);exit;

                if(isset($registro)) {
                    $status = Conexao::getInstance()->importaParaBanco($registro);
                    //$status = Conexao::importaParaBanco($registro);

                }






                //var_dump($status);exit;
                $qtd_registros_adicionados = $status[0];
                $qtd_registros_falhados = $status[1];
                //$erro = $status['erro'];

                if($qtd_registros_adicionados > 0) {            
                     echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\" />
                     <script>alert(\"$qtd_registros_adicionados registros foram importados com sucesso!\");  
                        </script>";
                     if($qtd_registros_falhados > 0) {
                         echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\" />
                     <script>alert(\"$qtd_registros_falhados registros possuem caracteres inválidos e não foram adicionados.\");  
                       history.go(-1);    
                        </script>";                 
                     } else {
                         echo "<script>
                       history.go(-1);    
                        </script>";
                     }
                } else {
                     echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\" />
                     <script>alert(\"Houve uma falha na importação dos registros.\");  
                       history.go(-1);    
                        </script>";
                }







                //var_dump($_FILES["arquivo"]["error"]);exit;


           } else {
                echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\" />
                     <script>alert(\"Arquivo inválido.\");  
                       history.go(-1);    
                        </script>";
           }

        } else {
            echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\" />
                     <script>alert(\"Não acesse este arquivo diretamente!\");  
                       location.href = \"../../view/html/frmAutenticado.php\";      
                        </script>";
        }

} else {
        echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\" />
        <script>alert(\"Você não tem permissão para visualizar esta página.\");
                location.href = \"../../admin.php\";      
                </script>";
    }

?>