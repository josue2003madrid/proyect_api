function iniciarMap(){
    var coord = {lat:19.0583869 ,lng: -98.1541396};
    var map = new google.maps.Map(document.getElementById('map'),{
      zoom: 10,
      center: coord
    });
    var marker = new google.maps.Marker({
      position: coord,
      map: map
    });
}