<?php
//ini_set('display_errors', 1);

require_once 'DB.php';
require_once 'dataDBTools/Util.php';

Class Conexao
{
    private static $instance = null;
        
    private $db = null;
    private $sock = null;
    
    public function __construct() {
        $this->db = new DB("localhost", "postgres", "postgres", "censo2011DN");
    }
    
    private function Conexao() { }
    
    public static function getInstance() {
        if (Conexao::$instance == null) {
                Conexao::$instance = new Conexao();
                //var_dump("aaa");
        }
        return Conexao::$instance;
    }

    public function conectarDB() {
        $host = $this->db->getHost();
        $user = $this->db->getUser();
        $password = $this->db->getPassword();
        $dbname = $this->db->getDbName();
        
        $this->sock = pg_connect("host=$host user=$user password=$password dbname=$dbname") or die(mysql_error());                
    }
    
    public function close() {
        pg_close($this->sock);
        $this->sock = null;
    }
    
    public function getPessoaBySiapeCpf($siape, $cpf = null) {
        $this->conectarDB();
      
        /* TABELA PESSOA */
        
        
        $sql = "
            SELECT 
                    p.id_pessoa as id_pessoa,
                    p.siape as siape,
                    p.cpf as cpf,
                    p.nome as nome,
                    p.sexo as sexo,
                    p.datanascimento as datanascimento,
                    p.naturalidade as naturalidade,
                    p.nacionalidade as nacionalidade,
                    p.estadocivil as estadocivil,
                    p.conjuge as conjuge,
                    p.nomepai as nomepai,
                    p.nomemae as nomemae,
                    p.sangue as sangue,
                    p.fatorrh as fatorrh,
                    p.cor as cor,
                    p.necessidade_especial as necessidade_especial,
                    p.endresidencial as endresidencial,
                    p.bairro as bairro,
                    p.id_estado_nasc as id_estado_nasc,
                    e1.sgl_estado as sgl_estado_nasc,	
                    p.id_estado_atual as id_estado_atual,
                    e2.sgl_estado as sgl_estado_atual,
                    p.id_cidade as id_cidade,
                    c.nome_cidade as nome_cidade,
                    p.cep as cep,
                    p.telefone as telefone,
                    p.celular as celular,
                    p.email as email,
                    p.pispasep as pispasep,
                    p.certidao_nascimentocasamento as certidao_nascimentocasamento,
                    p.certidao_nascimentocasamento_folha as certidao_nascimentocasamento_folha,
                    p.certidao_nascimentocasamento_livro as certidao_nascimentocasamento_livro,
                    p.rg as rg,
                    p.rg_orgaoexpeditor as rg_orgaoexpeditor,
                    p.rg_id_estado as rg_id_estado,
                    --e3.rg_sgl_estado as rg_sgl_estado,
                    p.rg_dataexpedicao as rg_dataexpedicao,
                    p.registroprofissional as registroprofissional,
                    p.registroprofissional_orgaoexpeditor as registroprofissional_orgaoexpeditor,
                    p.registroprofissional_id_estado as registroprofissional_id_estado,
                    --e4.registroprofissional_sgl_estado as registroprofissional_sgl_estado,
                    p.registroprofissional_dataexpedicao as registroprofissional_dataexpedicao,
                    p.tituloeleitor as tituloeleitor,
                    p.tituloeleitor_zona as tituloeleitor_zona,
                    p.tituloeleitor_secao as tituloeleitor_secao,
                    p.tituloeleitor_local as tituloeleitor_local,
                    p.tituloeleitor_dataexpedicao as tituloeleitor_dataexpedicao,
                    p.reservista as reservista,
                    p.reservista_orgaoexpeditor as reservista_orgaoexpeditor,
                    p.reservista_serie as reservista_serie,
                    
                    p.dataprimeiroemprego as dataprimeiroemprego,
                    p.numerobanco as numerobanco,
                    p.nomebanco as nomebanco,
                    p.agencia as agencia,
                    p.conta as conta,
                    p.cargofuncao as cargofuncao,
                    p.codigofuncao as codigofuncao,
                    p.padrao as padrao,
                    p.portaria_nomeacao_numero as portaria_nomeacao_numero,
                    p.portaria_nomeacao_data as portaria_nomeacao_data,
                    p.data_publicacao as data_publicacao,
                    p.data_posse as data_posse,
                    p.data_exercicio as data_exercicio,
        
                    p.segundograu as segundograu,
                    p.segundograu_instituicao as segundograu_instituicao,
                    p.terceirograu as terceirograu,
                    p.terceirograu_instituicao as terceirograu_instituicao,
                    p.posgraduacao1_tipo as posgraduacao1_tipo,
                    p.posgraduacao1_situacao as posgraduacao1_situacao,
                    p.posgraduacao1_curso as posgraduacao1_curso,
                    p.posgraduacao1_instituicao as posgraduacao1_instituicao,
                    p.posgraduacao1_cargahoraria as posgraduacao1_cargahoraria,
                    p.posgraduacao1_dataconclusao as posgraduacao1_dataconclusao,
                    p.posgraduacao2_tipo as posgraduacao2_tipo,
                    p.posgraduacao2_situacao as posgraduacao2_situacao,
                    p.posgraduacao2_curso as posgraduacao2_curso,
                    p.posgraduacao2_instituicao as posgraduacao2_instituicao,
                    p.posgraduacao2_cargahoraria as posgraduacao2_cargahoraria,
                    p.posgraduacao2_dataconclusao as posgraduacao2_dataconclusao,
                    p.posgraduacao3_tipo as posgraduacao3_tipo,
                    p.posgraduacao3_situacao as posgraduacao3_situacao,
                    p.posgraduacao3_curso as posgraduacao3_curso,
                    p.posgraduacao3_instituicao as posgraduacao3_instituicao,
                    p.posgraduacao3_cargahoraria as posgraduacao3_cargahoraria,
                    p.posgraduacao3_dataconclusao as posgraduacao3_dataconclusao,
                    p.posgraduacao4_tipo as posgraduacao4_tipo,
                    p.posgraduacao4_situacao as posgraduacao4_situacao,
                    p.posgraduacao4_curso as posgraduacao4_curso,
                    p.posgraduacao4_instituicao as posgraduacao4_instituicao,
                    p.posgraduacao4_cargahoraria as posgraduacao4_cargahoraria,
                    p.posgraduacao4_dataconclusao as posgraduacao4_dataconclusao,
        
                    p.idioma1 as idioma1,
                    p.idioma1_leitura as idioma1_leitura,
                    p.idioma1_fala as idioma1_fala,
                    p.idioma1_escrita as idioma1_escrita,
                    p.idioma2 as idioma2,
                    p.idioma2_leitura as idioma2_leitura,
                    p.idioma2_fala as idioma2_fala,
                    p.idioma2_escrita as idioma2_escrita,
                    p.idioma3 as idioma3,
                    p.idioma3_leitura as idioma3_leitura,
                    p.idioma3_fala as idioma3_fala,
                    p.idioma3_escrita as idioma3_escrita,
                    p.idioma4 as idioma4,
                    p.idioma4_leitura as idioma4_leitura,
                    p.idioma4_fala as idioma4_fala,
                    p.idioma4_escrita as idioma4_escrita,
        
                    p.podeatualizar as podeatualizar

            FROM pessoa p
            LEFT JOIN estado e1 ON (p.id_estado_nasc = e1.id_estado)
            LEFT JOIN estado e2 ON (p.id_estado_atual = e2.id_estado)
            LEFT JOIN cidade c ON (p.id_cidade = c.id_cidade)";
        
        if($cpf)       // se o cpf tiver sido enviado faça
            $sql .= " WHERE siape = $siape AND cpf = $cpf;";    // busque por siape e cpf
        else 
            $sql .= " WHERE siape = $siape;";    // busque apenas pelo siape
        
        
        $query = pg_query($this->sock, $sql);
        $registro = pg_fetch_assoc($query);
        
        // TRATANDO DATA        
        if ($registro['datanascimento']) $registro['datanascimento'] = Util::dataFromBanco($registro['datanascimento']);
        if ($registro['dataprimeiroemprego']) $registro['dataprimeiroemprego'] = Util::dataFromBanco($registro['dataprimeiroemprego']);
        if ($registro['portaria_nomeacao_data']) $registro['portaria_nomeacao_data'] = Util::dataFromBanco($registro['portaria_nomeacao_data']);
        if ($registro['data_publicacao']) $registro['data_publicacao'] = Util::dataFromBanco($registro['data_publicacao']);
        if ($registro['data_posse']) $registro['data_posse'] = Util::dataFromBanco($registro['data_posse']);
        if ($registro['data_exercicio']) $registro['data_exercicio'] = Util::dataFromBanco($registro['data_exercicio']);
        if ($registro['rg_dataexpedicao']) $registro['rg_dataexpedicao'] = Util::dataFromBanco($registro['rg_dataexpedicao']);
        if ($registro['registroprofissional_dataexpedicao']) $registro['registroprofissional_dataexpedicao'] = Util::dataFromBanco($registro['registroprofissional_dataexpedicao']);
        if ($registro['registroprofissional_dataexpedicao']) $registro['tituloeleitor_dataexpedicao'] = Util::dataFromBanco($registro['tituloeleitor_dataexpedicao']);
        if ($registro['posgraduacao1_dataconclusao']) $registro['posgraduacao1_dataconclusao'] = Util::dataFromBanco($registro['posgraduacao1_dataconclusao']);
        if ($registro['posgraduacao2_dataconclusao']) $registro['posgraduacao2_dataconclusao'] = Util::dataFromBanco($registro['posgraduacao2_dataconclusao']);
        if ($registro['posgraduacao3_dataconclusao']) $registro['posgraduacao3_dataconclusao'] = Util::dataFromBanco($registro['posgraduacao3_dataconclusao']);
        if ($registro['posgraduacao4_dataconclusao']) $registro['posgraduacao4_dataconclusao'] = Util::dataFromBanco($registro['posgraduacao4_dataconclusao']);
            
        //print_r($registro);exit;
    
    
    // fechando o banco
    $this->close(); 
        
    return $registro;
    
    }
    
    public function getCidadesByIDEstado($id_estado) {
        
        $this->conectarDB();
        
        $sql = "SELECT * FROM cidade WHERE id_estado = $id_estado ORDER BY nome_cidade";
        $result = pg_query($this->sock, $sql);
        
        $rows = null;
        
        while ($row = pg_fetch_assoc($result)) {
            $rows[] = $row;
        }
                
        $this->close();
        //var_dump($rows);exit;
        return $rows;
    }
    
    public function getCidadeByID($id_cidade) {
        
        if($id_cidade) {
        
            $this->conectarDB();

            $sql = "SELECT * FROM cidade WHERE id_cidade = $id_cidade";
            $query = pg_query($this->sock, $sql);

            $row = pg_fetch_assoc($query);        

            $this->close();

            return $row;
            
        } else {
            return false;
        }
    }
    
    public function getNomeCidadeByID($id_cidade) {
        $cidade = $this->getCidadeByID($id_cidade);
        
        if($cidade) 
            return $cidade['nome_cidade'];
        else
            return false;
    }
        
    public function getEstadoByID($id_estado) {
        
        if($id_estado) {
        
            $this->conectarDB();

            $sql = "SELECT * FROM estado WHERE id_estado = $id_estado";
            $query = pg_query($this->sock, $sql);

            $row = pg_fetch_assoc($query);        

            $this->close();

            return $row;
        
        } else {
            return false;
        }
    }
    
    public function getNomeEstadoByID($id_estado) {
        $estado = getEstadoByID($id_estado);
        
        if($estado) 
            return $estado['sgl_estado'];
        else
            return false;
    }
    
    
    function isAtualizacaoPossivel($id_pessoa) {
        // pergunta para a flag do campo 'podeatualizar'
        $this->conectarDB();
        
        $sql = "SELECT podeatualizar FROM pessoa WHERE id_pessoa = '".$id_pessoa."';";        
        $query = pg_query($this->sock, $sql);
        $obj = pg_fetch_assoc($query);
        
        $this->close();
        
        if($obj['podeatualizar'] == 1) 
            return true;
        else
            return false;
        
    }
    
    function getAllEstados() {
        $this->conectarDB();
        
        $sql = "SELECT * FROM estado ORDER BY sgl_estado";
        $result = pg_query($this->sock, $sql);
        
        while ($row = pg_fetch_assoc($result)) {
            $rows[] = $row;
        }
                
        $this->close();
        //var_dump($rows);exit;
        return $rows;
    }
    
    
    public function update($registro, $campoAlterado) { 
        $this->conectarDB();
        
        // atualizando o registro        
        $sql_pessoa = "UPDATE pessoa SET ";        
                
        foreach($campoAlterado as $campoAlterado_unit) {
            // adicionando alteracoes
            $sql_alteracao[] = "INSERT INTO alteracao(id_pessoa, campo_alterado, valor_antigo, data_alteracao, checado) VALUES (".$registro['id_pessoa'].", ".$campoAlterado_unit['campo_alterado']." ,".$campoAlterado_unit['valor_antigo'].", ".$campoAlterado_unit['data_alteracao'].", ".$campoAlterado_unit['checado'].");";                         
            $sql_pessoa .= str_replace("'", "", $campoAlterado_unit['campo_alterado'])." = ".$registro[str_replace("'", "", $campoAlterado_unit['campo_alterado'])].", ";            
        }
        
        $sql_pessoa .= " podeatualizar = 0";        
        $sql_pessoa .= " WHERE id_pessoa = ".$registro['id_pessoa'].";";
        
               
        $return = pg_query($this->sock, $sql_pessoa); 
        
        for($i=0; $i<count($sql_alteracao); $i++) {
            pg_query($this->sock, $sql_alteracao[$i]);                    
        }

        $this->close();
        
        return $return;

    }    
    
    function autentica($usuario, $senha) {
        $this->conectarDB();
        
        $sql = "SELECT * FROM usuario WHERE usuario = '$usuario' AND senha = '$senha'";
        $result = pg_query($this->sock, $sql);
        $arr = pg_fetch_assoc($result);
        
        $this->close();
        
        if($arr)
            return true;
        else
            return false;
    }
    
    
    function getAllRegistros() {
        $this->conectarDB();
        
        $sql = "SELECT * FROM pessoa ORDER BY nome;";
        $result = pg_query($this->sock, $sql);
        
        while($reg = pg_fetch_assoc($result)) {
            $arr[] = $reg;
        }
        
        $this->close();
        
        return $arr;
    }
    
    
    function getAllregistrosAlterados() {
        $this->conectarDB();
        
        $sql = "SELECT id_pessoa, campo_alterado, valor_antigo, data_alteracao, checado FROM alteracao";
        $result = pg_query($this->sock, $sql);
        
        while($reg = pg_fetch_assoc($result)) {
            $arr[] = $reg;
        }
        
        $this->close();
        
        return $arr;
    }
    
    function getAllregistrosAlteradosByIdPessoa($id_pessoa) {
        $this->conectarDB();
        
        $sql = "SELECT id_atualizacao, id_pessoa, campo_alterado, valor_antigo, data_alteracao, checado FROM alteracao WHERE id_pessoa = $id_pessoa;";
        $result = pg_query($this->sock, $sql);
        
        while($reg = pg_fetch_assoc($result)) {
            $arr[] = $reg;
        }
        
        $this->close();
        
        return $arr;
    }
    
    function getNomePessoaById($id_pessoa) {
        $this->conectarDB();
        
        $sql = "SELECT nome FROM pessoa WHERE id_pessoa = $id_pessoa";
        $result = pg_query($this->sock, $sql);
        
        $arr = pg_fetch_assoc($result);
        
        $this->close();
        
        return $arr['nome'];
    }
    
    function getPessoaById($id_pessoa) {
        
        $this->conectarDB();
      
        /* TABELA PESSOA */
        
        
        $sql = "
            SELECT 
                    p.id_pessoa as id_pessoa,
                    p.siape as siape,
                    p.cpf as cpf,
                    p.nome as nome,
                    p.sexo as sexo,
                    p.datanascimento as datanascimento,
                    p.naturalidade as naturalidade,
                    p.nacionalidade as nacionalidade,
                    p.estadocivil as estadocivil,
                    p.conjuge as conjuge,
                    p.nomepai as nomepai,
                    p.nomemae as nomemae,
                    p.sangue as sangue,
                    p.fatorrh as fatorrh,
                    p.cor as cor,
                    p.necessidade_especial as necessidade_especial,
                    p.endresidencial as endresidencial,
                    p.bairro as bairro,
                    p.id_estado_nasc as id_estado_nasc,
                    e1.sgl_estado as sgl_estado_nasc,	
                    p.id_estado_atual as id_estado_atual,
                    e2.sgl_estado as sgl_estado_atual,
                    p.id_cidade as id_cidade,
                    c.nome_cidade as nome_cidade,
                    p.cep as cep,
                    p.telefone as telefone,
                    p.celular as celular,
                    p.email as email,
                    p.pispasep as pispasep,
                    p.certidao_nascimentocasamento as certidao_nascimentocasamento,
                    p.certidao_nascimentocasamento_folha as certidao_nascimentocasamento_folha,
                    p.certidao_nascimentocasamento_livro as certidao_nascimentocasamento_livro,
                    p.rg as rg,
                    p.rg_orgaoexpeditor as rg_orgaoexpeditor,
                    p.rg_id_estado as rg_id_estado,
                    --e3.rg_sgl_estado as rg_sgl_estado,
                    p.rg_dataexpedicao as rg_dataexpedicao,
                    p.registroprofissional as registroprofissional,
                    p.registroprofissional_orgaoexpeditor as registroprofissional_orgaoexpeditor,
                    p.registroprofissional_id_estado as registroprofissional_id_estado,
                    --e4.registroprofissional_sgl_estado as registroprofissional_sgl_estado,
                    p.registroprofissional_dataexpedicao as registroprofissional_dataexpedicao,
                    p.tituloeleitor as tituloeleitor,
                    p.tituloeleitor_zona as tituloeleitor_zona,
                    p.tituloeleitor_secao as tituloeleitor_secao,
                    p.tituloeleitor_local as tituloeleitor_local,
                    p.tituloeleitor_dataexpedicao as tituloeleitor_dataexpedicao,
                    p.reservista as reservista,
                    p.reservista_orgaoexpeditor as reservista_orgaoexpeditor,
                    p.reservista_serie as reservista_serie,
                    
                    p.dataprimeiroemprego as dataprimeiroemprego,
                    p.numerobanco as numerobanco,
                    p.nomebanco as nomebanco,
                    p.agencia as agencia,
                    p.conta as conta,
                    p.cargofuncao as cargofuncao,
                    p.codigofuncao as codigofuncao,
                    p.padrao as padrao,
                    p.portaria_nomeacao_numero as portaria_nomeacao_numero,
                    p.portaria_nomeacao_data as portaria_nomeacao_data,
                    p.data_publicacao as data_publicacao,
                    p.data_posse as data_posse,
                    p.data_exercicio as data_exercicio,
        
                    p.segundograu as segundograu,
                    p.segundograu_instituicao as segundograu_instituicao,
                    p.terceirograu as terceirograu,
                    p.terceirograu_instituicao as terceirograu_instituicao,
                    p.posgraduacao1_tipo as posgraduacao1_tipo,
                    p.posgraduacao1_situacao as posgraduacao1_situacao,
                    p.posgraduacao1_curso as posgraduacao1_curso,
                    p.posgraduacao1_instituicao as posgraduacao1_instituicao,
                    p.posgraduacao1_cargahoraria as posgraduacao1_cargahoraria,
                    p.posgraduacao1_dataconclusao as posgraduacao1_dataconclusao,
                    p.posgraduacao2_tipo as posgraduacao2_tipo,
                    p.posgraduacao2_situacao as posgraduacao2_situacao,
                    p.posgraduacao2_curso as posgraduacao2_curso,
                    p.posgraduacao2_instituicao as posgraduacao2_instituicao,
                    p.posgraduacao2_cargahoraria as posgraduacao2_cargahoraria,
                    p.posgraduacao2_dataconclusao as posgraduacao2_dataconclusao,
                    p.posgraduacao3_tipo as posgraduacao3_tipo,
                    p.posgraduacao3_situacao as posgraduacao3_situacao,
                    p.posgraduacao3_curso as posgraduacao3_curso,
                    p.posgraduacao3_instituicao as posgraduacao3_instituicao,
                    p.posgraduacao3_cargahoraria as posgraduacao3_cargahoraria,
                    p.posgraduacao3_dataconclusao as posgraduacao3_dataconclusao,
                    p.posgraduacao4_tipo as posgraduacao4_tipo,
                    p.posgraduacao4_situacao as posgraduacao4_situacao,
                    p.posgraduacao4_curso as posgraduacao4_curso,
                    p.posgraduacao4_instituicao as posgraduacao4_instituicao,
                    p.posgraduacao4_cargahoraria as posgraduacao4_cargahoraria,
                    p.posgraduacao4_dataconclusao as posgraduacao4_dataconclusao,
        
                    p.idioma1 as idioma1,
                    p.idioma1_leitura as idioma1_leitura,
                    p.idioma1_fala as idioma1_fala,
                    p.idioma1_escrita as idioma1_escrita,
                    p.idioma2 as idioma2,
                    p.idioma2_leitura as idioma2_leitura,
                    p.idioma2_fala as idioma2_fala,
                    p.idioma2_escrita as idioma2_escrita,
                    p.idioma3 as idioma3,
                    p.idioma3_leitura as idioma3_leitura,
                    p.idioma3_fala as idioma3_fala,
                    p.idioma3_escrita as idioma3_escrita,
                    p.idioma4 as idioma4,
                    p.idioma4_leitura as idioma4_leitura,
                    p.idioma4_fala as idioma4_fala,
                    p.idioma4_escrita as idioma4_escrita,
        
                    p.podeatualizar as podeatualizar

            FROM pessoa p
            LEFT JOIN estado e1 ON (p.id_estado_nasc = e1.id_estado)
            LEFT JOIN estado e2 ON (p.id_estado_atual = e2.id_estado)
            LEFT JOIN cidade c ON (p.id_cidade = c.id_cidade)
            
            WHERE id_pessoa = $id_pessoa
            ;
        ";
        
        $query = pg_query($this->sock, $sql);
        $registro = pg_fetch_assoc($query);
        
        // TRATANDO DATA        
        if ($registro['datanascimento']) $registro['datanascimento'] = Util::dataFromBanco($registro['datanascimento']);
        if ($registro['dataprimeiroemprego']) $registro['dataprimeiroemprego'] = Util::dataFromBanco($registro['dataprimeiroemprego']);
        if ($registro['portaria_nomeacao_data']) $registro['portaria_nomeacao_data'] = Util::dataFromBanco($registro['portaria_nomeacao_data']);
        if ($registro['data_publicacao']) $registro['data_publicacao'] = Util::dataFromBanco($registro['data_publicacao']);
        if ($registro['data_posse']) $registro['data_posse'] = Util::dataFromBanco($registro['data_posse']);
        if ($registro['data_exercicio']) $registro['data_exercicio'] = Util::dataFromBanco($registro['data_exercicio']);
        if ($registro['rg_dataexpedicao']) $registro['rg_dataexpedicao'] = Util::dataFromBanco($registro['rg_dataexpedicao']);
        if ($registro['registroprofissional_dataexpedicao']) $registro['registroprofissional_dataexpedicao'] = Util::dataFromBanco($registro['registroprofissional_dataexpedicao']);
        if ($registro['registroprofissional_dataexpedicao']) $registro['tituloeleitor_dataexpedicao'] = Util::dataFromBanco($registro['tituloeleitor_dataexpedicao']);
        if ($registro['posgraduacao1_dataconclusao']) $registro['posgraduacao1_dataconclusao'] = Util::dataFromBanco($registro['posgraduacao1_dataconclusao']);
        if ($registro['posgraduacao2_dataconclusao']) $registro['posgraduacao2_dataconclusao'] = Util::dataFromBanco($registro['posgraduacao2_dataconclusao']);
        if ($registro['posgraduacao3_dataconclusao']) $registro['posgraduacao3_dataconclusao'] = Util::dataFromBanco($registro['posgraduacao3_dataconclusao']);
        if ($registro['posgraduacao4_dataconclusao']) $registro['posgraduacao4_dataconclusao'] = Util::dataFromBanco($registro['posgraduacao4_dataconclusao']);
            
        //print_r($registro);exit;
    
    
    // fechando o banco
    $this->close(); 
        
    return $registro;
        
    }
    
    function getIdCidadeByNome($nome_cidade) {
        $this->conectarDB();
        
        $sql = "SELECT c.id_cidade FROM cidade c
                WHERE UPPER(c.nome_cidade) = UPPER('$nome_cidade');";
        
        $result = pg_query($this->sock, $sql);
        
        $arr = pg_fetch_assoc($result);
        
        $this->close();
        
        return $arr['id_cidade'];
    }
    
    
    function importaParaBanco($registros) {
        $this->conectarDB();
        
        for($x=0;$x<count($registros);$x++) {   // qtd de registros
            $sql[$x] = "INSERT INTO pessoa (";
            $m = 0;
            foreach($registros[$x] as $campo=>$valor) {                
                $sql[$x] .= $campo;     
                if($m != count($registros[$x])-1) { 
                    $sql[$x] .= ", ";
                    $m++;
                }
            }
            
            $sql[$x] .= ") VALUES (";
            
            $m = 0;
            foreach($registros[$x] as $campo=>$valor) {                
                $sql[$x] .= $valor;  
                if($m != count($registros[$x])-1) { 
                    $sql[$x] .= ", ";
                    $m++;
                }
            }
            $sql[$x] .= ");";
        }
        
        $qtd_registros_adicionados = 0;
        $qtd_registros_nao_adicionados = 0;
        foreach($sql as $sql_unit) {
            $result = pg_query($this->sock, $sql_unit);
            //var_dump($sql_unit);echo '<BR><BR>';
            
            if($result) { 
                $qtd_registros_adicionados++;
            } else {
                $qtd_registros_nao_adicionados++;
            }
        }
        
        $status[0] = $qtd_registros_adicionados;
        $status[1] = $qtd_registros_nao_adicionados;
        //$status['erro'] = pg_last_error();
        
        
        $this->close();
        //exit;
        return $status;
    }    
    
    
    function bloquearPessoa($id_pessoa) {
        $this->conectarDB();
        
        $sql = "UPDATE pessoa SET podeatualizar = 0 WHERE id_pessoa = $id_pessoa;";
        $result = pg_query($this->sock, $sql);
        
        $this->close();
        
        return $result;
    }
    
    
    function updateValidacoesDeAlteracoes($arr) {
        $this->conectarDB();
        // O array que chegar, a chave é o id_atualizacao que deve ser setado para 1. o seu valor é 1,
        // utilize o valor vindo do arr
        
        
        foreach($arr as $chave=>$valor) {
            $sql = "UPDATE alteracao SET checado = $valor WHERE id_atualizacao = $chave;";
            $result = pg_query($this->sock, $sql);
        }
        
        //print_r($sql);
        
        // usar um try catch aqui depois.. (quando eu aprender isso)
        
        
        if($result)
            return true;
        else
            return false;
        
        $this->close();        
    }
    
    
    
    
    
    
    
    
    
    
    // **************************************************************
    
    public function insert($registros) { 
        
        
        
        
    }
    
    
    
    
    
    
    
    
    
}
           






?>


