/*
 * Este js Atualiza o select cidade com base no select estado selecionado no form
 */

$(document).ready(function() {
    $("select[name=id_estado_atual]").change(function() {   // evento onchange
        $("select[name=id_cidade]").html('<option value="0">Carregando...</option>');
                
        $.post("../js/cidades.php",   //enviar a variavel estado em formato de $_POST['estado'] para cidades.php
            {id_estado_atual:$(this).val()}, // variavel estado recebendo o valor de select[name=id_estado_atual] (que é this)
             //id_cidade:$("select[name=id_cidade]").val()}, 
            function(valor) {   // valor é o que vier de cidades.php, ou seja, o echo
                $("select[name=id_cidade]").html(valor);   //decidindo aonde encaixar o que vier do echo de pessoa.php
            }
            )
    })
    
    
    
    
    
    
    
    
    
})
