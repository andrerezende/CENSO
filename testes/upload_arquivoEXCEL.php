<?php
include 'Pessoa.php';
require 'Excel/reader.php';

$arquivo = (isset($_FILES['arquivo']) ? $_FILES['arquivo'] : null);
//var_dump($arquivo);exit;

if($arquivo) {
    //var_dump($_FILES['arquivo']['type']);exit;
   if($_FILES['arquivo']['type'] == "application/vnd.ms-excel") {       
       
        $data = new Spreadsheet_Excel_Reader();
        $data->setOutputEncoding('UTF-8');
       
        $data->read($arquivo['tmp_name']);
        
        //var_dump($data->sheets[0]['numCols']);exit;
        
        // ele deve ir ate 15. para mudar para a folha(sheet) 1
        
        
        // FOLHA 1
        for ($i = 1; $i <= $data->sheets[0]['numRows']; $i++) {
            for ($j = 1; $j <= 15; $j++) {
                
                
            }            
        }
        
        
        
        
        
        echo "<table border=\"1\">";
	for ($i = 1; $i <= $data->sheets[0]['numRows']; $i++) {
            echo "<tr>";
                for ($j = 1; $j <= $data->sheets[0]['numCols']; $j++) {
                        $celldata = utf8_encode((!empty($data->sheets[0]['cells'][$i][$j])) ? $data->sheets[0]['cells'][$i][$j] : "&nbsp;");
                        echo "<td>$celldata</td>";
                }
            echo "</tr>";
	}
        echo "</table>";
       
       
       
       
       
   } else {
       echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\" />
             <script>alert(\"Este não é um arquivo xls válido.\");  
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