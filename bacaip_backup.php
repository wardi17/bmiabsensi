<html>
<head>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
 
</head>
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

$(document).ready(function(){
getlokasi();	
	
});

    




function getlokasi(){
	       if (navigator.geolocation) {
            // Dapatkan lokasi pengguna
            navigator.geolocation.getCurrentPosition(function(position) {
                var latitude = position.coords.latitude;
                var longitude = position.coords.longitude;
					tampilmap(latitude,longitude)
              
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
	   // Tampilkan lokasi dalam console atau lakukan apa pun yang Anda inginkan dengan data lokasi
                /*console.log("Latitude: " + latitude);
                console.log("Longitude: " + longitude);*/
				const koordinat =latitude+','+longitude;
				  console.log("Koordinat : "+koordinat);
				  let url = "https://www.google.com/maps/embed/v1/place?key=AIzaSyAR74ruQ8bB8wtJyxmO_qkrDPF2pLHSK90&q="+koordinat;
				  console.log("URL : "+url);
 }
</script>

</body>
</html>