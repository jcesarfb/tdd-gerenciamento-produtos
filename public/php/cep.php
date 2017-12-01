<?php 
    function coordenadas(){
        $cep = $_POST['cep'];
        $address = $cep.","."Brasil";
        $request_url = "http://maps.googleapis.com/maps/api/geocode/xml?address=".$address."&sensor=true"; // A URL que vc manda pro google para pegar o XML
        $xml = simplexml_load_file($request_url) or die("url not loading");// request do XML
        $status = $xml->status;// pega o status do request, já qe a API da google pode retornar vários tipos de respostas
        if ($status=="OK") {
            //request returned completed time to get lat / lang for storage
            $lat = $xml->result->geometry->location->lat;
            $long = $xml->result->geometry->location->lng;
            return "$lat,$long"; 
          
          
        }
        if ($status=="ZERO_RESULTS") {
    //indica que o geocode funcionou mas nao retornou resutados. 
          echo "Não Foi possível encontrar o local";
            
        }
        if ($status=="OVER_QUERY_LIMIT") {
            //indica que sua cota diária de requests excedeu
          echo "A cota do GoogleMaps excedeu o limite diário";
        }
        if ($status=="REQUEST_DENIED") {
            //indica que seu request foi negado, geralmente por falta de um 'parametro de sensor?' 
          echo "Acesso Negado";
        }
        if ($status=="INVALID_REQUEST") {
            // geralmente indica que a query (address or latlng) está faltando.
          echo "Endereço não está preenchido corretamente";
        }
    }
    $acao = $_POST['acao'];
    switch ($acao) {
        case '1':
            coordenadas();
            break;
    }
?>