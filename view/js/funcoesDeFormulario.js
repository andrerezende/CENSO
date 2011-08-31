
// Eventos JavaScript / Jquery



$(document).ready(function() {  // quando o documento ficar pronto
    
    // contador de novo_academico
    var i_academico = 0;
    var i_idioma = 0;
    
    
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
    
    //$('#btn_adicionar_academico').click(function() {
       // 
      //  $.post("../js/teste.php",
         //   {nomeComponente:"academico",
          //   i:i_academico++}, 
          // function(valor) {
           //     $(valor).appendTo('#novos_academicos');  // adiciona no final
           // }            
       // )

    
    $('#btn_adicionar_academico').click(function() {
        
        $.post("../js/appendHtml.php",
            {nomeComponente:"academico",
             i_academico:i_academico}, 
           function(valor) {
                $(valor).appendTo('#novos_academicos');  // adiciona no final
           }
           )
                
        i_academico++;
    })
    
    
    $('#btn_adicionar_idioma').click(function() {
        
        $.post("../js/appendHtml.php",
            {nomeComponente:"idioma",
             i_idioma:i_idioma}, 
           function(valor) {
                $(valor).appendTo('#novos_idiomas');  // adiciona no final
           }
           )
                
        i_idioma++;
    })
    
    
    
    
    
    
    
})



function deletar_elemento(id, i) {
    var elemento = document.getElementById(id + i);
    $(elemento).remove();
}

function Onlynumber(e) {
		var tecla=new Number();

		if (window.event) {
			tecla = e.keyCode;
		} else if (e.which) {
			tecla = e.which;
		} else {
			return true;
		}
		if (((tecla < 48) || (tecla > 57)) && (tecla!=8)) {
			return false;
		}
	}

	
        function validar_declaracao() {
            var declaracao			= document.getElementById("declaracao");
                        
            if (!declaracao.checked) {
                alert('Voce precisa aceitar a declaracao!');
                declaracao.focus();
            } else {
                location.href = "../../controller/alteracao/alterar3.php";    
            }
                
        }
        
        function voltar(i) {
            history.go(-i);  
        }
        
        
        function validar() {
		
		var declaracao			= document.getElementById("declaracao");
                var cpf                         = document.getElementById("cpf");
                var nome                        = document.getElementById("nome");

		resultado = true;
                
                if (nome.value == "") {
			alert('Voce precisa preencher o nome!');
			nome.focus();
			resultado = false;  
		} 
                if (cpf.value == "") {
			alert('Voce precisa preencher o cpf!');
			cpf.focus();
			resultado = false;  
		} 
		if (!declaracao.checked) {
			alert('Voce precisa aceitar a declaracao!');
			declaracao.focus();
			resultado = false;  
		}
                
		return resultado;
	}

	function Mascara(tipo, campo, teclaPress) {
		if (window.event) {
			var tecla = teclaPress.keyCode;
		} else {
			tecla = teclaPress.which;
		}
		var s = new String(campo.value);

		// Remove todos os caracteres a seguir: ( ) / - . e espaço, para tratar a string denovo.
		s = s.replace(/(\.|\(|\)|\/|\-| )+/g,'');
		tam = s.length + 1;

		if ( tecla != 9 && tecla != 8 ) {
			switch (tipo) {
				case 'CPF' :
					if (tam > 3 && tam < 7)
						campo.value = s.substr(0,3) + '.' + s.substr(3, tam);
					if (tam >= 7 && tam < 10)
						campo.value = s.substr(0,3) + '.' + s.substr(3,3) + '.' + s.substr(6,tam-6);
					if (tam >= 10 && tam < 12)
						campo.value = s.substr(0,3) + '.' + s.substr(3,3) + '.' + s.substr(6,3) + '-' + s.substr(9,tam-9);
					break;
				case 'CNPJ' :
					if (tam > 2 && tam < 6)
						campo.value = s.substr(0,2) + '.' + s.substr(2, tam);
					if (tam >= 6 && tam < 9)
						campo.value = s.substr(0,2) + '.' + s.substr(2,3) + '.' + s.substr(5,tam-5);
					if (tam >= 9 && tam < 13)
						campo.value = s.substr(0,2) + '.' + s.substr(2,3) + '.' + s.substr(5,3) + '/' + s.substr(8,tam-8);
					if (tam >= 13 && tam < 15)
						campo.value = s.substr(0,2) + '.' + s.substr(2,3) + '.' + s.substr(5,3) + '/' + s.substr(8,4)+ '-' + s.substr(12,tam-12);
					break;
				case 'TEL' :
					if (tam > 2 && tam < 4)
						campo.value = '(' + s.substr(0,2) + ') ' + s.substr(2,tam);
					if (tam >= 7 && tam < 11)
						campo.value = '(' + s.substr(0,2) + ') ' + s.substr(2,4) + '-' + s.substr(6,tam-6);
					break;
				case 'DATA' :
					if (tam > 2 && tam < 4)
						campo.value = s.substr(0,2) + '/' + s.substr(2, tam);
					if (tam > 4 && tam < 11)
						campo.value = s.substr(0,2) + '/' + s.substr(2,2) + '/' + s.substr(4,tam-4);
					break;
				case 'CEP' :
					if (tam > 5 && tam < 7)
						campo.value = s.substr(0,5) + '-' + s.substr(5, tam);
					break;
			}
		}
	}

	//funcao para formatar qualquer campo.Ex.:cep,cpf,telefone,cnpj.
	function formata(src, mask) {
		var i = src.value.length;
		var saida = '#';
		var texto = mask.substring(i)
		if (texto.substring(0,1) != saida) {
			src.value += texto.substring(0,1);
		}
	}
        
        function somenteLeitura(campo) {            
            document.getElementById(campo).readOnly=true; 
        }
        

	function necessidadeEspecial() {
            var necessidadeEspecial = document.getElementById("necessidade_especial");

            if (necessidadeEspecial.value == "OUTRA") {
                    document.getElementById("necessidade_especial_outra").readOnly=false;
                    document.getElementById("necessidade_especial_outra").focus();
            } else {
                    document.getElementById("necessidade_especial_outra").value = "";
                    document.getElementById("necessidade_especial_outra").readOnly=true;
            }
	}
        
        function academico_somenteLeitura(tipo) {
            
            //document.getElementById("segundograu_instituicao").value = "lalala";
            
            
            var elementoEscolhido = document.getElementById(tipo);
            
            switch(tipo) {
                
                case "segundograu":
                    
                    if(elementoEscolhido.value == "") {
                        document.getElementById("segundograu_instituicao").value = "";
                        document.getElementById("segundograu_instituicao").readOnly = true;
                    } else {
                        document.getElementById("segundograu_instituicao").readOnly = false;
                        document.getElementById("segundograu_instituicao").focus();
                    }
                    break;
                    
                case "terceirograu":
                    
                    if(elementoEscolhido.value == "") {
                        document.getElementById("terceirograu_instituicao").value = "";
                        document.getElementById("terceirograu_instituicao").readOnly = true;
                    } else {
                        document.getElementById("terceirograu_instituicao").readOnly = false;
                        document.getElementById("terceirograu_instituicao").focus();
                    }
                    break;
                    
                case "posgraduacao1_tipo":
                    
                    if(elementoEscolhido.value == "") {
                        document.getElementById("posgraduacao1_situacao").value = "";
                        document.getElementById("posgraduacao1_curso").focus();
                        
                        document.getElementById("posgraduacao1_curso").value = "";
                        document.getElementById("posgraduacao1_curso").readOnly = true;
                        
                        document.getElementById("posgraduacao1_instituicao").value = "";
                        document.getElementById("posgraduacao1_instituicao").readOnly = true;
                        
                        document.getElementById("posgraduacao1_cargahoraria").value = "";
                        document.getElementById("posgraduacao1_cargahoraria").readOnly = true;
                        
                        document.getElementById("posgraduacao1_dataconclusao").value = "";
                        document.getElementById("posgraduacao1_dataconclusao").readOnly = true;                        
                        
                    } else {
                        //document.getElementById("posgraduacao1_curso").focus();
                        
                        document.getElementById("posgraduacao1_situacao").readOnly = false;
                        document.getElementById("posgraduacao1_curso").readOnly = false;
                        document.getElementById("posgraduacao1_instituicao").readOnly = false;
                        document.getElementById("posgraduacao1_cargahoraria").readOnly = false;
                        document.getElementById("posgraduacao1_dataconclusao").readOnly = false;
                        
                    }
                    break;
                    
                case "posgraduacao2_tipo":
                    
                    if(elementoEscolhido.value == "") {
                        document.getElementById("posgraduacao2_situacao").value = "";
                        document.getElementById("posgraduacao2_curso").focus();
                        
                        document.getElementById("posgraduacao2_curso").value = "";
                        document.getElementById("posgraduacao2_curso").readOnly = true;
                        
                        document.getElementById("posgraduacao2_instituicao").value = "";
                        document.getElementById("posgraduacao2_instituicao").readOnly = true;
                        
                        document.getElementById("posgraduacao2_cargahoraria").value = "";
                        document.getElementById("posgraduacao2_cargahoraria").readOnly = true;
                        
                        document.getElementById("posgraduacao2_dataconclusao").value = "";
                        document.getElementById("posgraduacao2_dataconclusao").readOnly = true;                        
                        
                    } else {
                        //document.getElementById("posgraduacao2_curso").focus();
                        
                        document.getElementById("posgraduacao2_situacao").readOnly = false;
                        document.getElementById("posgraduacao2_curso").readOnly = false;
                        document.getElementById("posgraduacao2_instituicao").readOnly = false;
                        document.getElementById("posgraduacao2_cargahoraria").readOnly = false;
                        document.getElementById("posgraduacao2_dataconclusao").readOnly = false;
                        
                    }
                    break;
                    
                case "posgraduacao3_tipo":
                    
                    if(elementoEscolhido.value == "") {
                        document.getElementById("posgraduacao3_situacao").value = "";
                        document.getElementById("posgraduacao3_curso").focus();
                        
                        document.getElementById("posgraduacao3_curso").value = "";
                        document.getElementById("posgraduacao3_curso").readOnly = true;
                        
                        document.getElementById("posgraduacao3_instituicao").value = "";
                        document.getElementById("posgraduacao3_instituicao").readOnly = true;
                        
                        document.getElementById("posgraduacao3_cargahoraria").value = "";
                        document.getElementById("posgraduacao3_cargahoraria").readOnly = true;
                        
                        document.getElementById("posgraduacao3_dataconclusao").value = "";
                        document.getElementById("posgraduacao3_dataconclusao").readOnly = true;                        
                        
                    } else {
                        //document.getElementById("posgraduacao3_curso").focus();
                        
                        document.getElementById("posgraduacao3_situacao").readOnly = false;
                        document.getElementById("posgraduacao3_curso").readOnly = false;
                        document.getElementById("posgraduacao3_instituicao").readOnly = false;
                        document.getElementById("posgraduacao3_cargahoraria").readOnly = false;
                        document.getElementById("posgraduacao3_dataconclusao").readOnly = false;
                        
                    }
                    break;
                    
                case "posgraduacao4_tipo":
                    
                    if(elementoEscolhido.value == "") {
                        document.getElementById("posgraduacao4_situacao").value = "";
                        document.getElementById("posgraduacao4_curso").focus();
                        
                        document.getElementById("posgraduacao4_curso").value = "";
                        document.getElementById("posgraduacao4_curso").readOnly = true;
                        
                        document.getElementById("posgraduacao4_instituicao").value = "";
                        document.getElementById("posgraduacao4_instituicao").readOnly = true;
                        
                        document.getElementById("posgraduacao4_cargahoraria").value = "";
                        document.getElementById("posgraduacao4_cargahoraria").readOnly = true;
                        
                        document.getElementById("posgraduacao4_dataconclusao").value = "";
                        document.getElementById("posgraduacao4_dataconclusao").readOnly = true;                        
                        
                    } else {
                        //document.getElementById("posgraduacao4_curso").focus();
                        
                        document.getElementById("posgraduacao4_situacao").readOnly = false;
                        document.getElementById("posgraduacao4_curso").readOnly = false;
                        document.getElementById("posgraduacao4_instituicao").readOnly = false;
                        document.getElementById("posgraduacao4_cargahoraria").readOnly = false;
                        document.getElementById("posgraduacao4_dataconclusao").readOnly = false;
                        
                    }
                    break;
            }
            
        }
        
        function idioma_somenteLeitura(n) {
            
            var elementoEscolhido = document.getElementById("idioma"+n);
            
            if(elementoEscolhido.value == "") {
                document.getElementById("idioma"+n+"_leitura").value = "";
                document.getElementById("idioma"+n+"_fala").value = "";
                document.getElementById("idioma"+n+"_escrita").value = "";
                document.getElementById("idioma"+n).focus();
            }
                  
                    
        }

	

	function redireciona() {
		window.location="index.php"; //redereciona para a página inicial.
	}

	function ValidaCPF(campo) {
		var CPF = campo.value; // Recebe o valor digitado no campo

		// Aqui começa a checagem do CPF
		var POSICAO, I, SOMA, DV, DV_INFORMADO;
		var DIGITO = new Array(10);
		DV_INFORMADO = CPF.substr(9, 2); // Retira os dois últimos dígitos do número informado

		// Desemembra o número do CPF na array DIGITO
		for (I=0; I<=8; I++) {
			DIGITO[I] = CPF.substr( I, 1);
		}

		// Calcula o valor do 10 dígito da verificação
		POSICAO = 10;
		SOMA = 0;
		for (I=0; I<=8; I++) {
			SOMA = SOMA + DIGITO[I] * POSICAO;
			POSICAO = POSICAO - 1;
		}
		DIGITO[9] = SOMA % 11;
		if (DIGITO[9] < 2) {
			DIGITO[9] = 0;
		} else {
			DIGITO[9] = 11 - DIGITO[9];
		}

		// Calcula o valor do 11 dígito da verificação
		POSICAO = 11;
		SOMA = 0;
		for (I=0; I<=9; I++) {
			SOMA = SOMA + DIGITO[I] * POSICAO;
			POSICAO = POSICAO - 1;
		}
		DIGITO[10] = SOMA % 11;
		if (DIGITO[10] < 2) {
			DIGITO[10] = 0;
		} else {
			DIGITO[10] = 11 - DIGITO[10];
		}

		// Verifica se os valores dos dígitos verificadores conferem
		DV = DIGITO[9] * 10 + DIGITO[10];
		if (DV != DV_INFORMADO) {
			alert('CPF invalido');
			campo.value = '';
			campo.focus();
			return false;
		}
		return true;
	}

	function getCurso(pCampus) {
		if (pCampus.selectedIndex != '') {
			var campusCurso2 = pCampus.value;
			//document.location=('cadastro.php?campusCurso=' + campusCurso);
			//document.getElementById('campusCurso') = campusCurso2;
			return campusCurso2;
		}
	}

	$(document).ready(function() {
		$(".notas").priceFormat({
		    prefix: '',
		    limit: 3,
		    centsLimit: 1,
		    centsSeparator: '.',
		    thousandsSeparator: ''
		});

		$("#vaga_especial").change(function() {
			if ($(this).val() == "SIM") {
				$("#vaga_rede_publica").val("NAO");
			}
		});

		$("#vaga_rede_publica").change(function() {
			if ($(this).val() == "SIM") {
				$("#vaga_especial").val("NAO");
			}
		});

		$("#especial_prova_descricao").attr("disabled", true);
			//$("#especial_descricao").attr("disabled", true);

		$("#especial_prova").change(function() {
			$("#especial_prova option:selected").each(function() {
				if (this.value == "SIM") {
					$("#especial_prova_descricao").removeAttr("disabled");
				} else {
					$("#especial_prova_descricao").val("");
					$("#especial_prova_descricao").attr("disabled", true);
				}
			});
		});

		$("select[name=campus]").change(function() {
			$("select[name=curso]").html('<option value="0">Carregando...</option>');
			$.post("cursos.php",
				{campus: $(this).val()},
				function(valor) {
					$("select[name=curso]").html(valor);
				}
			)
		})

		$("select[name=campus]").change(function(){
			$("select[name=localprova]").html('<option value="0">Carregando...</option>');
			$.post("locais.php",
				{campus:$(this).val()},
				function(valor) {
					$("select[name=localprova]").html(valor);
				}
			)
		})
	})
        
        
        function validar_frmIndex() {
		
                var siape                         = document.getElementById("index_siape");
                var cpf                         = document.getElementById("index_cpf");
                
		resultado = true;
                
                if (siape.value == "") {
			alert('Voce precisa preencher a matricula!');
			cpf.focus();
			resultado = false;  
		} 
                if (cpf.value == "") {
			alert('Voce precisa preencher o cpf!');
			cpf.focus();
			resultado = false;  
		} 
		
		return resultado;
	}
        
        function validar(campo, msg) {
            
                var elemento                         = document.getElementById(campo);
                
		resultado = true;
                
                if (elemento.value == "") {
			alert(msg);
			elemento.focus();
			resultado = false;  
		}
                
                return resultado;
	}
        

        function validar_frmAdmin() {
		
                var siape                         = document.getElementById("siape");
                var cpf                         = document.getElementById("cpf");
                
		resultado = true;
                
                if (siape.value == "") {
			alert('Voce precisa preencher a matricula!');
			cpf.focus();
			resultado = false;  
		} 
                if (cpf.value == "") {
			alert('Voce precisa preencher o cpf!');
			cpf.focus();
			resultado = false;  
		} 
		
		return resultado;
	}	
        
        // esqueça isso. deixe a porra do jeito que ta
        function redireciona(local) {
            switch(local) {
                case "frm_adm":
                    window.location="frmAdmin.php"; 
                    break;
                    
                    
                    default:
                        alert(local + "não definido.");
            }
            
        }   