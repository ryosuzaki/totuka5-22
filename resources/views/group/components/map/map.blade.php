@extends('template')

@section('content')
<div id="map"></div>

<button id="move_to_my_location" class="btn btn-white text-dark" style="padding:0;width:40px;height:40px;margin: 10px;position: absolute;bottom: 180px;right: 0px;"><i class="material-icons m-0" style="font-size: 1.5rem;">my_location</i></button>



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
async function initMap() {
  //$initial_position,$initial_group,$groups
  var khm=new kaigoHackMap();
  
  function icon(type=""){
    if(type=="shelter"){
      return {
        fillColor: "#008b8b",
        fillOpacity: 1,
        path: google.maps.SymbolPath.CIRCLE,
        scale: 18,
        strokeColor: "white",
        strokeWeight: 1,
      };
    }else if(type="danger_spot"){
      return {
        fillColor: "#ff9800",
        fillOpacity: 1,
        path: google.maps.SymbolPath.CIRCLE,
        scale: 12,
        strokeColor: "white",
        strokeWeight: 1,
      };
    }
    return {};
  }

  function label(type=""){
    if(type=="shelter"){
      return {
        text: "directions_run",
        fontFamily: "Material Icons",
        color: "#ffffff",
        fontSize: '28px',
      };
    }else if(type="danger_spot"){
      return {
        text: "priority_high",
        fontFamily: "Material Icons",
        color: "#ffffff",
        fontSize: '25px',
      };
    }
    return {};
  }

  @foreach($groups as $group)
  @php
  $location=$group->getLocation()->location;
  @endphp
  //
  var marker{{$group->id}}=khm.addMarker({{$location['latitude']}},{{$location['longitude']}},icon("{{$group->getTypeName()}}"),label("{{$group->getTypeName()}}"),"{{$group->name}}","{{route('group.map.get_info_window_html',$group)}}");
  //
  @if(isset($initial_group))
  @if($initial_group==$group)
  khm.openInfoWindow(marker{{$group->id}},"{{route('group.map.get_info_window_html',$group)}}");
  @endif
  @endif
  @endforeach
  //
  document.getElementById("move_to_my_location").addEventListener('click', () => {
    if(khm.user_marker==null){
      new Promise(async (resolve, reject) => {
        await khm.startWatchingUserPosition();
        resolve();
      }).then(function(value) {
        khm.changeCenter(khm.user_marker.getPosition().lat(),khm.user_marker.getPosition().lng());
      });
    }else{
      khm.changeCenter(khm.user_marker.getPosition().lat(),khm.user_marker.getPosition().lng());
    }
  });
  //
  new Promise(async (resolve, reject) => {
    await khm.startWatchingUserPosition();
    resolve();
  }).then(function(value) {
    @if(isset($initial_position))
    khm.changeCenter({{$initial_position["latitude"]}},{{$initial_position["longitude"]}});
    @elseif(isset($initial_group))
    @php
    $initial_location=$initial_group->getLocation()->location;
    @endphp
    khm.changeCenter({{$initial_location["latitude"]}},{{$initial_location["longitude"]}});
    @else
    khm.changeCenter(khm.user_marker.getPosition().lat(),khm.user_marker.getPosition().lng());
    @endif
  });
}



class kaigoHackMap{
  //
  constructor() {
    this.map = new google.maps.Map(document.getElementById("map"), {
      center: { lat: 35.46592523208098, lng: 139.61996893057855 },
      zoom: 13,
    });
    //
    this.directionsService = new google.maps.DirectionsService();
    this.directionsRenderer = new google.maps.DirectionsRenderer();
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
    marker.addListener("click", () => {
      this.openInfoWindow(marker,url);
    });
    //
    this.markers.push(marker);
    return marker;
  }
  //
  openInfoWindow(marker,url){
    //
    if(this.infoWindow){
      this.infoWindow.close();
    }
    var infowindow=new google.maps.InfoWindow();
    //
    $.ajax({
      type: "GET",
      url: url,
      dataType : "html"
    })
    .done(function(data){
      infowindow.setContent(data);
      if(document.getElementById('guide_route')){
        document.getElementById('guide_route').addEventListener('click', () => {
          this.searchRouteFromUserPosition(marker);
        });
      }
    }.bind(this))
    .fail(function(XMLHttpRequest, textStatus, errorThrown){
      console.log(errorThrown);
    });
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
        color: "#ffffff",fontSize: '20px'},
        title: '現在地',
      });
    }
    //
    return this.user_marker;
  }
  //
  startWatchingUserPosition(){
    return new Promise((resolve, reject) => {
      this.user_position_watchID=navigator.geolocation.watchPosition((position) => {
        this.setUserMarker(position.coords.latitude,position.coords.longitude);
        resolve();
      },(error)=>{
        if(error.code==1){
          alert("位置情報をオンにして、ページを再読み込みしてください。");
        }else{
          console.log(error);
        }
      });
    })
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
    //
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