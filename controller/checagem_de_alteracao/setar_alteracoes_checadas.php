<?php
session_start("autenticacao");

if($_SESSION['autenticado']) { 
    
    // a chave é o id_atualizacao
    // o valor é o que deve ser posto no campo checado.
    
    require_once '../../model/Conexao.php';

    //removendo elementos irrelevantes do array
    if($_POST['confirmar']) unset($_POST['confirmar']);
    if($_POST['checkAll1']) unset($_POST['checkAll1']);
    if($_POST['checkAll2']) unset($_POST['checkAll2']);
    
    //print_r($_POST);exit;
    
    array_pop($_POST);  //removendo o botao do array
    
    
    if($_POST) {
    
        if(Conexao::getInstance()->updateValidacoesDeAlteracoes($_POST)) {  ?>

            <script>
                alert("Validação efetuada com sucesso.");  
                location.href = '../../view/html/frmPesquisarPessoa.php';
            </script>
            
        <?php } else { ?>
            
            <script>
                alert("Houve um erro ao efetuar validação.");
                history.go(-1);      
            </script>
            
  <?php  }
    
    } else {    ?>
            
        <script>
            alert("Nenhuma alteração foi validada.");
            location.href = '../../view/html/frmPessoa.php';
        </script>
        
<?php }

} else {    ?>
    
        <script>
            alert("Você não tem permissão para visualizar esta página.");
            location.href = '../../index.php';
        </script>
        
<?php }
