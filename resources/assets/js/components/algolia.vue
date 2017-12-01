<template>
	<div>
		 <div class="col-md-6">
            <div class="form-group">
                <div class="input-group input-group-md">
                    <div class="icon-addon addon-md">
                       <input type="text" placeholder="O que procura?" class="form-control input-pesquisar" v-model="query">
                    </div>
                    <span class="input-group-btn">
                        
                        <button class="btn btn-primary" type="button" @click="search()" v-if="!loading">Procurar</button>

                        <button class="btn btn-default" type="button" disabled="disabled" v-if="loading">Procurando...</button>
                    </span>
                </div>
            </div>

        </div>
        <div class="col-md-6">
                <div class="form-group">
                    <a onclick="localizarUsuario()"><button type="submit" class="btn btn-primary" >BUSCAR por localização</button></a>                   
                </div>
        </div>
        <div class="col-md-12" align="center">
            <br></br>
            <div id="map" align="center" class="exibicaoMap"></div> 
        </div>
         <div class="col-md-12">
            <div class="alert alert-danger" role="alert" v-if="error">
                <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                {{ error }}
            </div>
        </div>
        <div class="col-md-12">
            <div id="clinicas" class="row list-group">
                <div class="item col-xs-4 col-lg-4" v-for="clinica in clinicas">
                    <div class="thumbnail">
                        <img class="group list-group-image"/>
                            <div class="caption">
                                <h4 class="group inner list-group-item-heading">{{ clinica.razao_social }}</h4>
                                <p class="group inner list-group-item-text">{{ clinica.nome_fantasia }}</p>
                                    <div class="row">
                                        <div class="col-xs-12 col-md-6">
                                            <p class="lead">{{ clinica.endereco }}</p>
                                        </div>
                                        <div class="col-xs-12 col-md-6">
                                            <a class="btn btn-success" href="/chat">Entrar em contato</a>
                                        </div>
                                    </div>
                            </div>
                    </div>
                </div>
            </div>
        </div>
	</div>
</template>


<script>
export default {
  data() {
  	return {
		clinicas: [],
	    loading: false,
	    error: false,
	    query: ''
  	}
  },
  methods: {
    search: function() {
        this.error = '';
        this.clinicas = [];
        this.loading = true;
        axios.get('/api/search?q=' + this.query)
        	.then(response => {
            	this.clinicas = response.data;
	            console.log(response.data);
    	        this.loading = false;
	            this.query = '';
	        })
	        .catch(response => {
	        	console.log(response);
	        });
        },

        localizarUsuario: function() {
              if (window.navigator && window.navigator.geolocation) {
               var geolocation = window.navigator.geolocation;
               console.log(geolocation);
               geolocation.getCurrentPosition(this.sucesso(geolocation), this.erro());
              } else {
                 alert('Geolocalização não suportada em seu navegador.')
              }
          },

        sucesso: function(posicao){
        	console.log(posicao);
            var latitude = posicao.coords.latitude;
            var longitude = posicao.coords.longitude;
            var uluru = {lat: latitude, lng: longitude}; 
            var mapa = latitude+", "+longitude;
            initMap(mapa,'map');
            $("#map").removeClass("exibicaoMap");
            localizarUsuario2();
        },

        erro: function(error) {
        	console.log(error)
        },
      	
      	localizarUsuario2: function(){
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
                    maps(cep,'vai');
                  });
              }           
          })
          $("#map").removeClass("exibicaoMap");
          $(".footer").addClass("footerMapa");
      },      

      maps: function(cep,nome){
          $(function(){
              addMarker(cep, nome);
          });
      }
    },
  }
</script>