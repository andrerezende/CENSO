<?php
// Solicitaçoes da View para o Modelo

require_once '../../model/Conexao.php';

class Solicitacoes {

    public static function getCidadesByIDEstado($id_estado) {
        return Conexao::getInstance()->getCidadesByIDEstado($id_estado);        
    }
    
    public static function getCidadeByID($id_cidade) {
        return Conexao::getInstance()->getCidadeById($id_cidade);        
    }
    
    // o nome da cidade já vem no array de registros. Tornando esse método desnecessário. 
    // Mas, em todo caso, vou mante-lo aqui.
    public static function getNomeCidadeByID($id_cidade) {
        return Conexao::getInstance()->getNomeCidadeByID($id_cidade);        
    }
    
    public static function getEstadoByID($id_estado) {
        return Conexao::getInstance()->getEstadoById($id_estado);
    }
    
    public static function getNomeEstadoByID($id_estado) {
        return Conexao::getInstance()->getNomeEstadoById($id_estado);
    }
}
?>
