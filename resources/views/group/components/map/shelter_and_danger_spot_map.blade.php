@extends('template')

@section('content')
<div id="map"></div>

<button id="move_to_my_location" class="btn btn-white text-dark" style="padding:0;width:40px;height:40px;margin: 10px;position: absolute;bottom: 180px;right: 0px;"><i class="material-icons m-0" style="font-size: 1.5rem;">my_location</i></button>

<a href="{{route("group.create",2)}}" id="move_to_my_location" class="btn btn-danger btn-round text-white border border-white" style="padding:0;width:40px;height:40px;margin: 10px;position: absolute;top: 180px;right: 0px;"><i class="material-icons m-0" style="font-size: 1.5rem;position: absolute;top:8px;right:8px;">priority_high</i><i class="material-icons m-0" style="font-size: 1.0rem;position: absolute;top:5px;right:2px">add</i></a>

<script type="module">
$(document).ready(function() { 
    $("footer").addClass("d-none");
});
</script>
<script>
/*
->利用する API について
  ->料金表：https://cloud.google.com/maps-platform/pricing/?hl=ja

  ->無料枠：$200/1mth
->maps javascript api
  ->公式ドキュメント：
  ->料金：$7/1000request
->geolocation api
  ->公式ドキュメント：https://developers.google.com/maps/documentation/geolocation/overview?hl=ja
  ->料金：$5/1000request
->direction api
*/

/**
 * mapを生成するための非同期コールバック関数
 */
@php

@endphp
async function initMap() {
  @if(isset($initial_position))
  var khm=new kaigoHackMap($initial_position["latitude"],$initial_position["longitude"],13);
  @else
  var khm=new kaigoHackMap(35.4514441427883,139.36231169109772,13);
  @endif

  var icon={
        fillColor: "#008b8b",
        fillOpacity: 1,
        path: google.maps.SymbolPath.CIRCLE,
        scale: 20,
        strokeColor: "white",
        strokeWeight: 1,
      };
  var label={
        text: "directions_run",
        fontFamily: "Material Icons",
        color: "#ffffff",
        fontSize: '20px',
      };

  @for($i=0;$i<count($shelters);$i++)
  var shelter_marker{{$i}}=khm.addMarker({{$shelter_locations[$i]['latitude']}},{{$shelter_locations[$i]['longitude']}},icon,label,"{{$shelters[$i]->name}}","{{route('group.map.get_info_window_html',$shelters[$i])}}");
  @endfor
  //
  icon={
        fillColor: "#f44336",
        fillOpacity: 1,
        path: google.maps.SymbolPath.CIRCLE,
        scale: 16,
        strokeColor: "white",
        strokeWeight: 1,
      };
  label={
        text: "priority_high",
        fontFamily: "Material Icons",
        color: "#ffffff",
        fontSize: '20px',
      };
  //
  @for($i=0;$i<count($danger_spots);$i++)
  var danger_spot_marker{{$i}}=khm.addMarker({{$danger_spot_locations[$i]['latitude']}},{{$danger_spot_locations[$i]['longitude']}},icon,label,"{{$danger_spots[$i]->name}}","{{route('group.map.get_info_window_html',$danger_spots[$i])}}");
  @endfor
  //
  document.getElementById("move_to_my_location").addEventListener('click', () => {
    khm.changeCenter(khm.user_marker.getPosition().lat(),khm.user_marker.getPosition().lng());
  });
}



class kaigoHackMap{
  //
  constructor(lat,lng,zoom) {
    this.map = new google.maps.Map(document.getElementById("map"), {
      center: { lat: lat, lng: lng },
      zoom: zoom,
    });
    this.directionsService = new google.maps.DirectionsService();
    this.directionsRenderer = new google.maps.DirectionsRenderer();
    this.startWatchingUserPosition();
  }
  //
  markers=[];
  //
  changeCenter(lat,lng){
    this.map.setCenter({ lat: lat, lng: lng });
  }
  //
  addMarker(lat,lng,icon={},label={},title="",url){
    //
    var marker=new google.maps.Marker({
      position: { lat: lat, lng: lng },
      map:this.map,
      icon: icon,
      label: label,
      title: title,
    });
    //
    var infowindow=new google.maps.InfoWindow();
    //
    marker.addListener("click", () => {
      $.ajax({
        type: "GET",
        url: url,
        dataType : "html"
      })
      .done(function(data){
        infowindow.setContent(data);
      })
      .fail(function(XMLHttpRequest, textStatus, errorThrown){
        console.log(errorThrown);
      });
      this.openInfoWindow(marker,infowindow);
    });
    //
    infowindow.addListener('domready', () => {
      document.getElementById('guide_route').addEventListener('click', () => {
        this.searchRouteFromUserPosition(marker);
      });
    });
    //
    this.markers.push(marker);
    return marker;
  }
  //
  openInfoWindow(marker,infowindow){
    //
    if(this.infoWindow){
      this.infoWindow.close();
    }
    //
    this.infoWindow=infowindow;
    this.infoWindow.open({
      anchor: marker,
      map: this.map,
    });
    return this.infoWindow;
  }
  //
  setUserMarker(lat,lng){
    //
    if(this.user_marker){
      this.user_marker.setPosition({ lat: lat, lng: lng });
    }else{
      //
      this.user_marker=new google.maps.Marker({
        position: { lat: lat, lng: lng },
        map:this.map,
        label: {text: "person",
        fontFamily: "Material Icons",
        color: "#ffffff",fontSize: '16px'},
        title: '現在地',
      });
    }
    //
    return this.user_marker;
  }
  //
  startWatchingUserPosition(){
    new Promise((resolve, reject) => {
      //
      this.user_position_watchID=navigator.geolocation.watchPosition((position) => {
        this.setUserMarker(position.coords.latitude,position.coords.longitude);
        resolve();
      });
    }).then(() => {
      //
      this.changeCenter(this.user_marker.getPosition().lat(),this.user_marker.getPosition().lng());
    });
  }
  //
  clearWatchingUserPosition(){
    navigator.geolocation.clearWatch(this.user_position_watchID);
  }
  //
  searchRouteFromUserPosition(destination){
    //
    this.directionsRenderer.setOptions({
      suppressMarkers: true,
    });

    this.directionsService.route({
      origin: { lat: this.user_marker.getPosition().lat(), lng: this.user_marker.getPosition().lng() },
      destination: { lat: destination.getPosition().lat(), lng: destination.getPosition().lng() },
      travelMode: google.maps.TravelMode.WALKING
    }, function(response, status) {
        if (status === google.maps.DirectionsStatus.OK) {
          this.directionsRenderer.setMap(this.map);
          this.directionsRenderer.setDirections(response);
        }
    }.bind(this));
  }
}
</script>

<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAfcU4Wb2-U_fOZlkCssBdjAx0tF7vDcwE&region=JP&language=ja&callback=initMap"></script>
@endsection