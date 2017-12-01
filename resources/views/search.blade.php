@extends('layouts.app')
@section('content')
<style>
      #map {
        width: 550px;
        height: 400px;
        background-color: grey;
      }
      .exibicaoMap{
        display: none;
      }
    </style>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script type="text/javascript" src="https://maps.google.com/maps/api/js?key=AIzaSyCJI4r6BswBZ3b5enW70gWDpsW9khKfkug"></script>
    <br>
        <div class="col-md-12">
            <div class="content">
                <div class="title m-b-md">
                    PetTop
                </div>

                <div class="m-b-md">
                    <h3>BUSCAR CLÍNICAS</h3>                
                    <br>
                </div>
            </div>
        </div>
        <br>
        <div id="app">
            <algolia></algolia>
        </div>


<script type="text/javascript">
    function localizarUsuario(){
        //verifica se o seu navegador possui condições para acessar sua localização
        if (window.navigator && window.navigator.geolocation) {
         var geolocation = window.navigator.geolocation;
         geolocation.getCurrentPosition(sucesso, erro);
        } else {
           alert('Geolocalização não suportada em seu navegador.')
        }
        //caso consiga,traz as coordenadas
        function sucesso(posicao){
          console.log(posicao);
          var latitude = posicao.coords.latitude;
          var longitude = posicao.coords.longitude;
          var uluru = {lat: latitude, lng: longitude}; 
          //transformo em uma variável
          var mapa = latitude+", "+longitude;
          //mando para a função que conecta com API do Google  centraliza o mapa nas coordenadas recebidas
          initMap(mapa,'map');
          //removo a classe que bloqueia a exibição do mapa
          $("#map").removeClass("exibicaoMap");
          //chamo a função que adiciona no mapa as clínicas
          localizarUsuario2();
        }
        
        function erro(error){
          console.log(error)
        }
    }
    function localizarUsuario2(){
            $.ajaxSetup({
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url : '/mapa',//url para acessar o arquivo
                data: {acao: '1'},//parametros para a funcao
                type : 'POST',//PROTOCOLO DE ENVIO PODE SER GET/POST
                success : function(data){//DATA É O VALOR RETORNADO
                    var dadosMapa = data.map(function(cep) {         
                    cep;
                    maps(cep,'Clínica');
                    });
                }           
            })
            $("#map").removeClass("exibicaoMap");
        }      
        function maps(cep,nome){
            $(function(){                
                 //mando para a função que conecta com API do Google, gera as coordenadas apartir do cep e marca no mapa
                addMarker(cep, nome);
                
            });
        }
    </script>
  <!-- Scripts da biblioteca de busca e do chat-->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/vue/1.0.26/vue.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/vue-resource/1.0.1/vue-resource.min.js"></script>


@endsection


