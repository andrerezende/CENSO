<?php

ini_set('display_errors', 1);

require_once '../../controller/Solicitacoes.php';

$id_estado = $_POST['id_estado_atual'];

$cidades = Solicitacoes::getCidadesByIDEstado($id_estado);
// estava quebrando por causa do contexto de include
// echo é o que será adicionado ao componente que chamou este arquivo


if(count($cidades) == 0) {  
    echo '<option value="">Não há cidades nesse estado</option>';
} else {
    foreach($cidades as $cidade) {
        echo '<option value="'.$cidade['id_cidade'].'">'.$cidade['nome_cidade'].'</option>';
    }
}
 
 


?>
