<?php
include 'Pessoa.php';

$arquivo = (isset($_FILES['arquivo']) ? $_FILES['arquivo'] : null);
//var_dump($arquivo);exit;

if($arquivo) {
    //var_dump($_FILES['arquivo']['type']);exit;
   if($_FILES['arquivo']['type'] == "text/plain") {
    
        $fp= fopen($arquivo['tmp_name'], "r");        
        $registro = null;
        
        $i= 0;
        $linha = null;
        $string = null;
        while(!feof($fp)) {
            $char = fgetc($fp); // pega por caractere
            if($char == " ") {
                $char = "%"; 
            }
            $string .= $char;
            
            if($i == 226) {  // uma linha tem 226 caracteres  com um espaço em branco no final 
                $linha[] = $string;
                $string = null;
                $i = -1;
            }            
            $i++;
        }
        
        
        
        for($k=0;$k<count($linha);$k++) {   // pegando e tratando o valor de cada linha
            
            $siape = Pessoa::anti_injection(trim(str_replace("%", " ", substr($linha[$k], 0, 12))));
            $registro[$k]['siape'] = ($siape) ? "'".$siape."'" : "null";
            
            $endResidencial = Pessoa::anti_injection(trim(str_replace("%", " ", substr($linha[$k], 12, 40))));
            
            $bairro = Pessoa::anti_injection(trim(str_replace("%", " ", substr($linha[$k], 52, 25))));
            $registro[$k]['bairro'] = ($bairro) ? "'".$bairro."'" : "null";
            
            $cidade = Pessoa::anti_injection(trim(str_replace("%", " ", substr($linha[$k], 77, 30))));
            $registro[$k]['cidade'] = ($cidade) ? "'".$cidade."'" : "null";
            
            $cepInicio = Pessoa::anti_injection(trim(str_replace("%", " ", substr($linha[$k], 107, 5))));
            $cepFim = Pessoa::anti_injection(trim(str_replace("%", " ", substr($linha[$k], 112, 3))));
            $cep = $cepInicio."-".$cepFim;            
            
            $uf_atual = Pessoa::anti_injection(trim(str_replace("%", " ", substr($linha[$k], 115, 2))));
            $registro[$k]['uf_atual'] = ($uf_atual) ? "'".$uf_atual."'" : "null";
            
            $numeroEnd = Pessoa::anti_injection(trim(str_replace("%", " ", substr($linha[$k], 117, 6))));
            
            $complementoEnd = Pessoa::anti_injection(trim(str_replace("%", " ", " " .substr($linha[$k], 123, 21))));
                        
            $ddd = Pessoa::anti_injection(trim(str_replace("%", " ", substr($linha[$k], 147, 5))));
            
            $telefone = Pessoa::anti_injection(trim(str_replace("%", " ", substr($linha[$k], 152, 4)."-".substr($linha[$k], 156, 4))));
            
            //$registro[$k]['ramal'] .= trim(str_replace("%", " ", substr($linha[$k], 160, 5))); // ramal
            
            $email = Pessoa::anti_injection(trim(str_replace("%", " ", substr($linha[$k], 165, 50))));
            $registro[$k]['email'] = ($email) ? "'".$email."'" : "null";  // email
            //
            //$registro[$k]['cor'] = trim(str_replace("%", " ", substr($linha[$k], 215, 2))); // cor (?)
            
            $sangue = Pessoa::anti_injection(trim(str_replace("%", " ", substr($linha[$k], 217, 2))));
            $registro[$k]['sangue'] = ($sangue) ? "'".$sangue."'" : "null";  // sangue

            if(substr($linha[$k], 219, 1) == "+")  // fator rh
                $registro[$k]['fatorrh'] = "'POSITIVO'";
            else if(substr($linha[$k], 219, 1) == "-")
                    $registro[$k]['fatorrh'] = "'NEGATIVO'";

            //$registro[$k]['tipodeficiencia'] = trim(str_replace("%", " ", substr($linha[$k], 220, 2)));
            //$registro[$k]['deficiencia'] = trim(str_replace("%", " ", substr($linha[$k], 222, 3)));
            
            
            if($endResidencial) {
                $registro[$k]['endresidencial'] = "'".$endResidencial;
                if($numeroEnd) {
                    $registro[$k]['endresidencial'] .= " ".$numeroEnd;
                    if($complementoEnd) {
                        $registro[$k]['endresidencial'] .= " ".$complementoEnd."'";
                    } else {
                        $registro[$k]['endresidencial'] .= "'";
                    }
                } else {
                    $registro[$k]['endresidencial'] .= "'";
                }
            } else {
                $registro[$k]['endresidencial'] = "null";
            }
            
            if($telefone != "-") {
                if($ddd) {
                    $registro[$k]['telefone'] = "'(".$ddd.")".$telefone."'";  
                } else {
                    $registro[$k]['telefone'] = "'".$telefone."'";  
                }
            }
            
            if($cep != "-") {
                $registro[$k]['cep'] = "'".$cep."'";
            }
            
            
            
            
        }
        
         fclose($fp);
        
        $status = Pessoa::importaParaBanco($registro);
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
             <script>alert(\"O arquivo enviado não é um arquivo de texto válido.\");  
               history.go(-1);    
                </script>";
   }
    
} else {
    echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\" />
             <script>alert(\"Não acesse este arquivo diretamente!\");  
               location.href = \"../formAutenticado.php\";      
                </script>";
}

?>