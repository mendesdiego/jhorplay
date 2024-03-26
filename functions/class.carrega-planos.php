<?php
class produtosValeNet
{
    public $variavel = "https://dev.valenet.com.br/api";

    function listCidadeSplash(){
        $json_file = file_get_contents($this->variavel."/locations");   
        $json_str = json_decode($json_file);
        // var_dump($json_str);
        // passa pelo Array listando as cidades
        $countCitys = 0;
        foreach ($json_str as $cidade) {
            $listCidade[$countCitys]['id'] = $cidade->id;
            $listCidade[$countCitys]['city'] = $cidade->name;

            $countCitys++;
        }
        // retorna um array com os  nomes das cidades
        return $listCidade;
    }

    // captura o ID da cidade de acesso
    function CapturaCidade($idCidade)
    {
        // var_dump($this->variavel);
        // die;
        // faz a leitura do json gerado pelo sistema
        $json_file = file_get_contents($this->variavel."/locations");   
        $json_str = json_decode($json_file);
        // passa pelo Array comparando as cidades, se a cidade for igual alguma encontrada no array armazena o ID
        foreach ($json_str as $cidade) {
            $cidadeX = trim($cidade->name);
            if ($cidadeX == $idCidade) {
                $idCidadeSistema = $cidade->id;
            }
        }
        // retorna o ID da cidade
        return $idCidadeSistema;
    } 

    // captura o ID do bairro de acordo com a cidade envolvida
    function CapturaDistrito($idCidadeCorrente, $idDistrito)
    {
        // faz a leitura do json gerado pelo sistema
        $json_file = file_get_contents($this->variavel."/districts/".$idCidadeCorrente);   
        $json_str = json_decode($json_file);
        // passa pelos arrays comparando o array com o distrito passado
        foreach ($json_str as $distrito) {
            $distritoCorrente = trim($distrito->name);
            if($idDistrito == $distritoCorrente){
                $idDistritoCorrente = $distrito->id;
            }
        }
        // retorna o ID do distrito
        return $idDistritoCorrente;
    }

    function LoopBoxMontaPlanoInternet($idDistritoCorrente, $idCidadeSistema)
    {
        // consulta API
        $json_file = file_get_contents($this->variavel."/servicos/".$idDistritoCorrente);   
        $json_str = json_decode($json_file);

        // carrega e indexa as informações da internet para uso
        $count = 0;
        foreach ($json_str->broadband  as $plaNet) {
            $dadosPLano[$count]['id'] = $plaNet->id;
            $dadosPLano[$count]['name'] = $plaNet->name;
            $dadosPLano[$count]['price_single'] = $plaNet->price_single;
            $dadosPLano[$count]['price_combo'] = $plaNet->price_combo;
            $dadosPLano[$count]['Atributos'] = $plaNet->Atributos;
            $count++;
        }
        // retorna dados do plano de internet
        return $dadosPLano;
    }

    function loopMontaPlanoTelefone($idDistritoCorrente, $idCidadeCorrente)
    {
        // consulta API
        $json_file = file_get_contents($this->variavel."/servicos/".$idDistritoCorrente);   
        $json_str = json_decode($json_file);
        // var_dump($json_str->phone);
        // carrega e indexa as informações da internet para uso
        $count = 0;
        foreach ($json_str->phone  as $plaNet) {
            $dadosTelefonia[$count]['id'] = $plaNet->id;
            $dadosTelefonia[$count]['name'] = $plaNet->name;
            $dadosTelefonia[$count]['price_single'] = $plaNet->price_single;
            $dadosTelefonia[$count]['price_combo'] = $plaNet->price_combo;
            $dadosTelefonia[$count]['Atributos'] = $plaNet->Atributos;
            $count++;
        }
        // retorna dados do plano de internet
        return $dadosTelefonia;
    }

    // loop para montagem dos boxes de televisão
    function loopMontaPlanosTV($idDistritoCorrente, $idCidadeCorrente)
    {
        // consulta API
        $json_file = file_get_contents($this->variavel."/servicos/".$idDistritoCorrente);   
        $json_str = json_decode($json_file);
        // var_dump($json_str->tv);
        // carrega e indexa as informações da internet para uso
        $count = 0;
        if(!empty($json_str->tv)){
            foreach ($json_str->tv  as $plaNet) {
                $dadosPlanTv[$count]['id'] = $plaNet->id;
                $dadosPlanTv[$count]['name'] = $plaNet->name;
                $dadosPlanTv[$count]['price_single'] = $plaNet->price_single;
                $dadosPlanTv[$count]['price_combo'] = $plaNet->price_combo;
                $dadosPlanTv[$count]['Atributos'] = $plaNet->Atributos;
                $count++;
            }
        } else {
            $dadosPlanTv = null;
        }
        
        // retorna dados do plano de internet
        return $dadosPlanTv;
    }

    // loop para montagem do box do plano completo
    function loopPlanosMontados($idDistritoCorrente, $idCidadeCorrente)
    {
        // consulta API
        $json_file = file_get_contents($this->variavel."/servicos/".$idDistritoCorrente);   
        $json_str = json_decode($json_file);

        // echo "<pre>";
        //     var_dump($json_str->suggestions);
        // echo "</pre>";

        // carrega e indexa as informações da internet para uso
        $count = 0;
        foreach ($json_str->suggestions  as $plaNet) {
            $dadosPLano[$count]['name'] = $plaNet->name;
            $dadosPLano[$count]['services'] = $plaNet->services;
            $dadosPLano[$count]['price'] = $plaNet->price;
            $dadosPLano[$count]['servicos'] = $plaNet->servicos;
            $count++;
        }
        // retorna dados do plano de internet
        return $dadosPLano;
    }

    // gera loop de canais pelo combo
    function loopCanaisCombo($idCombo){
        // consulta API
        $json_file = file_get_contents($this->variavel."/canais/".$idCombo.".html");   
        $json_str = json_decode($json_file);
        $htmlCanais =  "<div class='list-canais'>";
        foreach ($json_str as $canais) {
            // echo $canais->name;
            $htmlCanais .= "<div>";
                $htmlCanais .= "<img src='".$canais->image."' alt='".$canais->name."'>";
            $htmlCanais .= "</div>";
        }
        $htmlCanais .= "</div>";

        return $htmlCanais;
    }

}
