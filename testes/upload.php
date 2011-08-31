<?php
include 'Pessoa.php';

//var_dump()

$arquivo1 = (isset($_FILES['arquivo']) ? $_FILES['arquivo'] : null);
//$arquivo2 = (isset($_FILES['arquivo2']) ? $_FILES['arquivo2'] : null);
//var_dump($arquivo1, $arquivo2);exit;

if($arquivo1) {
    //var_dump($_FILES['arquivo']['type']);exit;
   
        $fp= fopen($arquivo1['tmp_name'], "r");        
        //$fp2= fopen($arquivo2['tmp_name'], "r");  
        
        //$registros_arq1 = null;
        //$registros_arq2 = null;
        
        //$i= 0;
        //printf('daniel lalalalal lalala la la');exit;
        
        //$estado = Array('"cod_estado"', '"sgl_estado"', "nom_estado");
        //$cidade = Array('"cod_cidade"', '"cod_estado"', '"nom_cidade"');
        
        $msg = 'o rato roeu a roupa do rei';
        //$qtd = substr_count($msg, 'roeu a roupa');
        $msg2 = str_replace("rato roeu", "cachorro", $msg);
        //var_dump($msg2);exit;
        
        
        
        
        while(!feof($fp)) {
            $ln = fgets($fp); // pega por linha
            if(Substr_count($ln, 'INDEX') == 0) {   // se nao achar esta string dentro de ln faça
               
                
                $string = $ln;

                // estado

                         
                $string = str_replace("INTEGER UNSIGNED NOT NULL AUTO_INCREMENT", 'SERIAL', $string); 
                $string = str_replace('UNSIGNED', '', $string);        
                $string = str_replace('login', 'usuario', $string);

                printf($string);echo '<BR/>';
                
            }
            
        }
        
        fclose($fp);
        exit;
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        unset($string);
        
        while(!feof($fp2)) {
            $string = fgets($fp2); // pega por linha
            $registros_arq2[] = explode('%', $string);            
        }
        
        fclose($fp1);
        fclose($fp2);
        
        
        // arrumando os dados        
        
        $i = 0;
        foreach($registros_arq1 as $reg_unit) {   
            //var_dump($reg_unit[1]);
            if(($reg_unit[0])) {
                $siape = str_replace (".", "", $reg_unit[0]); 
                $siape = str_replace ("-", "", $siape); 
                $registro_arq1[$i]['siape'] = trim($siape);
            }
                
            if(($reg_unit[1]))
                $registro_arq1[$i]['cpf'] = trim($reg_unit[1]); 
            
            if(($reg_unit[2]))
                $registro_arq1[$i]['nome'] = trim($reg_unit[2]); 
            
            $i++;
        }
        
           //var_dump($registro_arq1);exit;
                
        
        
        $i = 0;
        foreach($registros_arq2 as $reg_unit) {   
            //var_dump($reg_unit[1]);
            if($reg_unit[1])
                $registro_arq2[$i]['siape'] = trim($reg_unit[1]); 
            
            if(($reg_unit[2]))
                $registro_arq2[$i]['nome'] = $reg_unit[2]; 
            
            if(($reg_unit[3]) && ($reg_unit[4]) && ($reg_unit[5]))
                $registro_arq2[$i]['datanascimento'] = $reg_unit[5]."/".$reg_unit[4]."/".$reg_unit[3]; 
                        
            if(($reg_unit[6]))
                $registro_arq2[$i]['sexo'] = ($reg_unit[6] == "M") ? "MASCULINO" : "FEMININO"; 
            
            if(($reg_unit[15]))
                $registro_arq2[$i]['endresidencial'] = $reg_unit[15]; 
            
            if(($reg_unit[16]))
                $registro_arq2[$i]['bairro'] = $reg_unit[16]; 
            
            if(($reg_unit[17]))
                $registro_arq2[$i]['cidade'] = $reg_unit[17]; 
            
            if(($reg_unit[18]))
                $registro_arq2[$i]['cep'] = $reg_unit[18];
            
            if(($reg_unit[20]))
                $registro_arq2[$i]['nacionalidade'] = $reg_unit[20];
            
            if(($reg_unit[22]) && ($reg_unit[21]))  // 22 = ddd
                $registro_arq2[$i]['telefone'] = "(".$reg_unit[21].")". $reg_unit[22];
                         
            if(($reg_unit[23]))
                $registro_arq2[$i]['email'] = $reg_unit[23]; 
                        
            if(($reg_unit[24])) 
                $registro_arq2[$i]['sangue'] = $reg_unit[24];
            
            if(($reg_unit[25])) {
                if($reg_unit[25] == "+") {
                    $registro_arq2[$i]['fatorrh'] = "POSITIVO";
                } else { 
                    $registro_arq2[$i]['fatorrh'] = "NEGATIVO";
                }
            }
            
            $i++;
        }
        
        // cruzando as informaçoes. 
        // unir os registros do arquivo 1 ao arquivo 2 usando o numero da matricula do arquivo 1
              
        // $registro_arq1 tem ID, CPF E NOME
        // $registro_arq1 tem as demais informaçoes
        
        // procurando a matricula de $i em cada $j
        for($i = 0; $i < count($registro_arq1); $i++) {
            for($j = 0; $j < count($registro_arq2); $j++) {
                //var_dump($registro_arq1[$i]);//exit;
                if(isset($registro_arq1[$i]['siape']) && isset($registro_arq2[$j]['siape'])) {
                    //var_dump($registro_arq1[$i]['siape'], $registro_arq2[$j]['siape']); echo '<BR><BR>';
                    if(Substr_count($registro_arq1[$i]['siape'], $registro_arq2[$j]['siape']) != 0) { // procurando a string do registro_arq1 em registro_arq2
                        //echo '1';
                        $registro_arq2[$j]['cpf'] = $registro_arq1[$i]['cpf'];
                        $registro_arq2[$j]['siape'] = $registro_arq1[$i]['siape'];  // o siape do arq1 é mais completo.
                        $registro_completo[] = $registro_arq2[$j];  
                        break;
                    } else {
                        //echo '0';
                    }
                } else {
                    //echo 'nao setado';
                }
            }
        }
        
        if(isset($registro_completo)) {
            
            // Tratando o valor de cada campo e colocando uma aspas simples antes de enviar pra classe conexao.
            $x = 0;
            foreach($registro_completo as $registro) {
                foreach($registro as $campoFromPOST=>$valor) {
                    $registro_completo[$x][$campoFromPOST] = "'".Pessoa::anti_injection($valor)."'";
                }
                $x++;
            }
            
            //var_dump($registro_completo);exit;
            
            $status = Pessoa::importaParaBanco($registro_completo);
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
             <script>alert(\"Não acesse este arquivo diretamente!\");  
               location.href = \"../formAutenticado.php\";      
                </script>";
}

?>