<?php

class Util_controller {
    
    public static function nomeCampo($nome_campo) {
        switch($nome_campo) {
            case "siape":
                return "Siape";
                break;
            
            case "cpf":
                return "CPF";
                break;
            
            case "nome":
                return "Nome";
                break;
            
            case "sexo":
                return "Sexo";
                break;
            
            case "datanascimento":
                return "Data de Nascimento";
                break;
            
            case "naturalidade":
                return "Naturalidade";
                break;
            
            case "nacionalidade":
                return "Nacionalidade";
                break;
            
            case "estadocivil":
                return "Estado Civil";
                break;
            
            case "conjuge":
                return "Conjuge";
                break;
            
            case "nomepai":
                return "Nome do Pai";
                break;
            
            case "nomemae":
                return "Nome da Mãe";
                break;
            
            case "sangue":
                return "Sangue";
                break;
            
            case "fatorrh":
                return "Fator RH";
                break;
            
            case "cor":
                return "Cor";
                break;
            
            case "necessidade_especial":
                return "Necessidade Especial";
                break;
            
            case "endresidencial":
                return "Endereço Residêncial";
                break;
            
            case "bairro":
                return "Bairro";
                break;
            
            case "cep":
                return "CEP";
                break;
            
            case "telefone":
                return "Telefone";
                break;
            
            case "celular":
                return "Celular";
                break;
            
            case "email":
                return "Email";
                break;
            
            case "pispasep":
                return "Pis/Pasep";
                break;
            
            case "certidao_nascimentocasamento":
                return "Certidão de Nascimento / Casamento";
                break;
            
            case "certidao_nascimentocasamento_id_estado":
                return "Estado (Certidão de Nascimento / Casamento)";
                break;
            
            case "certidao_nascimentocasamento_folha":
                return "Folha (Certidão de Nascimento / Casamento)";
                break;
            
            case "certidao_nascimentocasamento_livro":
                return "Livro (Certidão de Nascimento / Casamento)";
                break;
            
            case "rg":
                return "RG:";
                break;
            
            case "rg_orgaoexpeditor":
                return "Orgão Expedidor (RG)";
                break;
                        
            case "rg_dataexpedicao":
                return "Data de Expedição (RG)";
                break;
            
            case "registroprofissional":
                return "Registro Profissional";
                break;
            
            case "registroprofissional_orgaoexpeditor":
                return "Orgão Expedidor (Registro Profissional)";
                break;
                      
            case "registroprofissional_dataexpedicao":
                return "Data de Expedição (Registro Profissional)";
                break;
            
            case "tituloeleitor":
                return "Título de Eleitor";
                break;
            
            case "tituloeleitor_zona":
                return "Zona (Título de Eleitor)";
                break;
            
            case "tituloeleitor_secao":
                return "Seção (Título de Eleitor)";
                break;
            
            case "tituloeleitor_local":
                return "Local (Título de Eleitor)";
                break;
            
            case "tituloeleitor_dataexpedicao":
                return "Data de Expedição (Título de Eleitor)";
                break;
            
            case "reservista":
                return "Reservista";
                break;
            
            case "reservista_orgaoexpeditor":
                return "Orgão Expedidor (Reservista)";
                break;
            
            case "reservista_serie":
                return "Série (Reservista)";
                break;
            
            case "dataprimeiroemprego":
                return "Data do Primeiro Emprego";
                break;
            
            case "numerobanco":
                return "Número do Banco";
                break;
            
            case "nomebanco":
                return "Nome do Banco";
                break;
            
            case "agencia":
                return "Agência";
                break;
            
            case "conta":
                return "Conta";
                break;
            
            case "cargofuncao":
                return "Cargo / Função";
                break;
            
            case "codigofuncao":
                return "Código (Função)";
                break;
            
            case "padrao":
                return "Padrão";
                break;
            
            case "portaria_nomeacao_numero":
                return "Portaria Nomeação (Número)";
                break;
            
            case "portaria_nomeacao_data":
                return "Portaria Nomeação (Data)";
                break;
            
            case "data_publicacao":
                return "Data de Publicação";
                break;
            
            case "data_posse":
                return "Data de Posse";
                break;
            
            case "data_exercicio":
                return "Data de Exercício";
                break;
            
            case "segundograu":
                return "Segundo Grau";
                break;
            
            case "segundograu_instituicao":
                return "Instituição (Segundo Grau)";
                break;
            
            case "terceirograu":
                return "Terceiro Grau";
                break;
            
            case "terceirograu_instituicao":
                return "Instituição (Terceiro Grau)";
                break;
            
            case "posgraduacao1_tipo":
                return "Título de Pós-Graduação 1";
                break;
            
            case "posgraduacao1_situacao":
                return "Situação (Pós-Graduação 1)";
                break;
            
            case "posgraduacao1_curso":
                return "Curso (Pós-Graduação 1)";
                break;
            
            case "posgraduacao1_instituicao":
                return "Instituição (Pós-Graduação 1)";
                break;
            
            case "posgraduacao1_cargahoraria":
                return "Carga Horária (Pós-Graduação 1)";
                break;
            
            case "posgraduacao2_tipo":
                return "Título de Pós-Graduação 2";
                break;
            
            case "posgraduacao2_situacao":
                return "Situação (Pós-Graduação 2)";
                break;
            
            case "posgraduacao2_curso":
                return "Curso (Pós-Graduação 2)";
                break;
            
            case "posgraduacao2_instituicao":
                return "Instituição (Pós-Graduação 2)";
                break;
            
            case "posgraduacao2_cargahoraria":
                return "Carga Horária (Pós-Graduação 2)";
                break;
            
            case "posgraduacao3_tipo":
                return "Título de Pós-Graduação 3";
                break;
            
            case "posgraduacao3_situacao":
                return "Situação (Pós-Graduação 3)";
                break;
            
            case "posgraduacao3_curso":
                return "Curso (Pós-Graduação 3)";
                break;
            
            case "posgraduacao3_instituicao":
                return "Instituição (Pós-Graduação 3)";
                break;
            
            case "posgraduacao3_cargahoraria":
                return "Carga Horária (Pós-Graduação 3)";
                break;
            
            case "posgraduacao4_tipo":
                return "Título de Pós-Graduação 4";
                break;
            
            case "posgraduacao4_situacao":
                return "Situação (Pós-Graduação 4)";
                break;
            
            case "posgraduacao4_curso":
                return "Curso (Pós-Graduação 4)";
                break;
            
            case "posgraduacao4_instituicao":
                return "Instituição (Pós-Graduação 4)";
                break;
            
            case "posgraduacao4_cargahoraria":
                return "Carga Horária (Pós-Graduação 4)";
                break;
            
            case "idioma1":
                return "Idioma 1";
                break;
            
            case "idioma1_leitura":
                return "Idioma 1 (Leitura)";
                break;
            
            case "idioma1_fala":
                return "Idioma 1 (Fala)";
                break;
            
            case "idioma1_escrita":
                return "Idioma 1 (Escrita)";
                break;
            
            case "idioma2":
                return "Idioma 2";
                break;
            
            case "idioma2_leitura":
                return "Idioma 2 (Leitura)";
                break;
            
            case "idioma2_fala":
                return "Idioma 2 (Fala)";
                break;
            
            case "idioma2_escrita":
                return "Idioma 2 (Escrita)";
                break;
            
            case "idioma3":
                return "Idioma 3";
                break;
            
            case "idioma3_leitura":
                return "Idioma 3 (Leitura)";
                break;
            
            case "idioma3_fala":
                return "Idioma 3 (Fala)";
                break;
            
            case "idioma3_escrita":
                return "Idioma 3 (Escrita)";
                break;
            
            case "idioma4":
                return "Idioma 4";
                break;
            
            case "idioma4_leitura":
                return "Idioma 4 (Leitura)";
                break;
            
            case "idioma4_fala":
                return "Idioma 4 (Fala)";
                break;
            
            case "idioma4_escrita":
                return "Idioma 4 (Escrita)";
                break;
            
            case "id_estado_nasc":
                return "Estado (Nascimento)";
                break;
            
            case "id_estado_atual":
                return "Estado (Atual)";
                break;
            
            case "registroprofissional_id_estado":
                return "Estado (Registro Profissional)";
                break;
            
            case "rg_id_estado":
                return "Estado (RG)";
                break;
            
            case "id_cidade":
                return "Cidade";
                break;
            
        }
    }
    
}