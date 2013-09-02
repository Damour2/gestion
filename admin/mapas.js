// JavaScript Document
$(document).ready(function() {	inicializarMapa(); });
											  
function inicializarMapa() {
	marker = null;
	geocoder = new google.maps.Geocoder();
	var haymarker = false;
	if (lat == 0 && long == 0) {
		var latlng = new google.maps.LatLng(-38.41, -63.61);
		var myOptions = {
		  zoom: 3,
		  center: latlng,
		  mapTypeId: google.maps.MapTypeId.ROADMAP
		};
	}
	else {
		haymarker = true;
		var latlng = new google.maps.LatLng(lat, long);
		var myOptions = {
		  zoom: 15,
		  center: latlng,
		  mapTypeId: google.maps.MapTypeId.ROADMAP
		};
	}
    map = new google.maps.Map(document.getElementById("mapa_canvas"), myOptions);	
	
	if (haymarker)
		marker = new google.maps.Marker({
              map: map, 
              position: latlng,
			  draggable: esparadrag
          });
}


function codeAddress() {
    var address = $("#direccion").val()+", "+$("#provincia").val()+", Argentina";
    if (geocoder) {
      geocoder.geocode( { 'address': address}, function(results, status) {
        if (status == google.maps.GeocoderStatus.OK) {
          map.setCenter(results[0].geometry.location);
		  map.setZoom(15);
          if (marker == null)
		  marker = new google.maps.Marker({
              map: map, 
              position: results[0].geometry.location,
			  draggable: true
          });
		  else marker.setPosition(results[0].geometry.location);
		  
		  
		  
        } else {
          alert("La localización en el mapa falló porque: " + status);
        }
      });
    }
  }
  
  
 function eliminarMarcador() {
	if (marker != null) {
	 	marker.setMap(null);
		marker = null;
	}
 }