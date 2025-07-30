<html>
<head>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
      <script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?sensor=false"></script>
    <style>
        /*
 * Always set the map height explicitly to define the size of the div element
 * that contains the map.
 */
#map {
  height: 100%;
}

/*
 * Optional: Makes the sample page fill the window.
 */
html,
body {
  height: 100%;
  margin: 0;
  padding: 0;
}
    </style>
 
</head>

<h3>My Google Maps Demo</h3>
<div id="map"></div>
<body>



<?php

//gema  'IP Pengguna -' . $_SERVER [ 'REMOTE_ADDR' ];

function  getUserIpAddr (){ 
    if(!empty( $_SERVER [ 'HTTP_CLIENT_IP' ])){ 
        //ip dari berbagi internet 
        $ip  =  $_SERVER [ 'HTTP_CLIENT_IP' ]; 
    }elseif(!empty( $_SERVER [ 'HTTP_X_FORWARDED_FOR' ])){ 
        //ip pass dari proxy 
        $ip  =  $_SERVER [ 'HTTP_X_FORWARDED_FOR' ]; 
    }else{ 
        $ip  =  $_SERVER [ 'REMOTE_ADDR' ]; 
    } 
    return  $ip ; 
} 



echo  'IP Asli Pengguna -' . getUserIpAddr ();

//get host by name
echo gethostname();
echo "<br>";
//get OS
echo php_uname();
?>
<script type="text/javascript">
(
  g=>{var h,a,k,p="The Google Maps JavaScript API",c="google",l="importLibrary",q="__ib__",m=document,b=window;b=b[c]||(b[c]={});var d=b.maps||(b.maps={}),r=new Set,e=new URLSearchParams,u=()=>h||(h=new Promise(async(f,n)=>{await (a=m.createElement("script"));e.set("libraries",[...r]+"");for(k in g)e.set(k.replace(/[A-Z]/g,t=>"_"+t[0].toLowerCase()),g[k]);e.set("callback",c+".maps."+q);a.src=`https://maps.${c}apis.com/maps/api/js?`+e;d[q]=f;a.onerror=()=>h=n(Error(p+" could not load."));a.nonce=m.querySelector("script[nonce]")?.nonce||"";m.head.append(a)}));d[l]?console.warn(p+" only loads once. Ignoring:",g):d[l]=(f,...n)=>r.add(f)&&u().then(()=>d[l](f,...n))})
        ({key: "AIzaSyB41DRUbKWJHPxaFjMAwdrzWzbVKartNGg", v: "beta"});
// Initialize and add the map
let map;

async function initMap() {
    
  navigator.geolocation.getCurrentPosition(function(position) {
                var latitude = position.coords.latitude;
                var longitude = position.coords.longitude;
                

                tampilmap(latitude,longitude)
               // console.log(position_lokasi)
              },function(error) {
                // Handle kesalahan jika gagal mendapatkan lokasi
                console.error("Error getting location: " + error.message);
            });

     
  // The location of Uluru
 // const position = { lat: -25.344, lng: 131.031 };
  // Request needed libraries.
  //@ts-ignore
  //const { Map } = await google.maps.importLibrary("maps");

  //const { AdvancedMarkerView } = await google.maps.importLibrary("marker");




  // // The marker, positioned at Uluru
  // const marker = new AdvancedMarkerView({
  //   map: map,
  //   position: position,
  //   title: "Uluru",
  // });
}

initMap();
   




function getlokasi(){
          
	       if (navigator.geolocation) {
            // Dapatkan lokasi pengguna
            navigator.geolocation.getCurrentPosition(function(position) {
                var latitude = position.coords.latitude;
                var longitude = position.coords.longitude;
                let lokasi = {
                  latitude:latitude,
                  longitude:longitude
                }
               return lokasi;
            }, function(error) {
                // Handle kesalahan jika gagal mendapatkan lokasi
                console.error("Error getting location: " + error.message);
            });
        } else {
            // Tampilkan pesan jika geolocation tidak didukung
            console.error("Geolocation is not supported by this browser.");
        }
}


 function tampilmap(latitude,longitude){
    
   const position_lokasi ={lat:latitude,log:longitude};
  //The map, centered at Uluru
  
  let map;

   map = new Map(document.getElementById("map"), {
    zoom: 4,
    center: position_lokasi,
    mapId: "DEMO_MAP_ID",
  });

 }
</script>

</body>
</html>