var markers;
var address;
var lat;
var lng;


function initMapCep(cep,num,elm)
{
    address = getAddr(cep,num);
    GMaps.geocode({
        address: address,
        callback: function(results, status) {            
            if (status == 'OK') {
                var latlng = results[0].geometry.location;
                lat = latlng.lat();
                lng = latlng.lng()
                map = new GMaps({
                    div: elm,
                    lat: lat,
                    lng: lng,
                    scrollwheel: false,
                    mapTypeId: google.maps.MapTypeId.ROADMAP,
                    streetViewControl: true,
                    zoom: 14
                })
                map.setCenter(lat, lng);
            }
        }
    });       
}
function initMap(address,elm)
{
    GMaps.geocode({
        address: address,
        callback: function(results, status) {            
            if (status == 'OK') {
                var latlng = results[0].geometry.location;
                lat = latlng.lat();
                lng = latlng.lng()
                map = new GMaps({
                    div: elm,
                    lat: lat,
                    lng: lng,
                    scrollwheel: false,
                    mapTypeId: google.maps.MapTypeId.ROADMAP,
                    streetViewControl: true,
                    zoom: 14
                })
                map.setCenter(lat, lng);
            }
        }
    });       
}

function addMarker(address,html)
{
    GMaps.geocode({
        address: address,
        callback: function(results, status) {            
            if (status == 'OK') {
                var latlng = results[0].geometry.location;
                if(html == ""){
                    html = address;
                }
                lat = latlng.lat();
                lng = latlng.lng();
                var icon = "img/m2.png";
                map.addMarker({
                    lat: lat,
                    lng: lng,
                    icon: icon,
                    //title: address,
                    infoWindow: {
                        content: html
                    }
                }); 
            }
        }
    })    
}
function addMarkerCep(cep,num,html)
{
    address = getAddr(cep,num);
    GMaps.geocode({
        address: address,
        callback: function(results, status) {            
            if (status == 'OK') {
                var latlng = results[0].geometry.location;
                if(html == ""){
                    html = address;
                }
                lat = latlng.lat();
                lng = latlng.lng();
                 var icon = "img/m1.png";
                map.addMarker({
                    lat: lat,
                    lng: lng,
                    icon: icon,
                    //title: address,
                    infoWindow: {
                        content: html
                    }
                }); 
            }
        }
    })    
}
function getAddr(cep,num) {
    //var url = 'http://xtends.com.br/webservices/cep/json/'+cep+'/';    
    var url = 'http://clareslab.com.br/ws/cep/json/'+cep+'/';    
	
    if ($.browser.msie) {
        var url = 'ie.php';    
    }    
    rs = $.parseJSON($.ajax({
        url:url,
        cep:cep,
        async: false
    }).responseText);
    return  rs.endereco + ', ' + num + ', ' + rs.bairro + ', ' + rs.cidade + ', ' + rs.uf;    
}