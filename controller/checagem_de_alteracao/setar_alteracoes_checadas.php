<?php
session_start("autenticacao");

if($_SESSION['autenticado']) { 
    
    // a chave é o id_atualizacao
    // o valor é o que deve ser posto no campo checado.
    
    require_once '../../model/Conexao.php';

    array_pop($_POST);  //removendo o botao do array
    
    if($_POST) {
    
        if(Conexao::getInstance()->updateValidacoesDeAlteracoes($_POST)) {

            echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\" />
            <script>alert(\"Validação efetuada com sucesso.\");
                    location.href = \"../../view/html/frmPesquisarPessoa.php\";      
                    </script>";

        } else {
            echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\" />
            <script>alert(\"Houve um erro ao efetuar validação.\");
                    history.go(-1);      
                    </script>";
        }
    
    } else {
        echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\" />
            <script>alert(\"Nenhuma alteração foi validada.\");
                    location.href = \"../../view/html/frmPessoa.php\";      
                    </script>";
        
    }


} else {
    echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\" />
        <script>alert(\"Você não tem permissão para visualizar esta página.\");
                location.href = \"../../index.php\";      
                </script>";
}
?>
