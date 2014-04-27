<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Pencarian Jarak Terpendek Wisata Malang</title>

<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=true"></script>
<script type="text/javascript">
(function() {
	window.onload = function() {
	var map;
    var locations = [
	<?php		
	$host="localhost";
	$username="root";
	$password="";
	$database="wisata";

	$connection=mysql_connect ($host, $username, $password);
	$db_selected = mysql_select_db($database, $connection);

    $sql = "SELECT * FROM koordinat";
    $result = mysql_query($sql);
    while($data = mysql_fetch_object($result)) {
    ?>
    [<?=$data->lat;?>, <?=$data->long;?>, '<?=$data->nama_wisata;?>', '<?=$data->gambar;?>'],
    <?php }	?>		
    ];

    //Parameter Google maps
    var options = {
      zoom: 10, //level zoom maps
      center: new google.maps.LatLng(-7.97713888,112.63402611), //kordinat tengah maps
      mapTypeId: google.maps.MapTypeId.ROADMAP
    };
	
	// Buat maps pada id peta 
	var map = new google.maps.Map(document.getElementById('peta'), options);
	
	// Tambahkan Marker 
	var infowindow = new google.maps.InfoWindow();

    var marker, i;
    /* kode untuk menampilkan banyak marker */
    for (i = 0; i < locations.length; i++) {  
      marker = new google.maps.Marker({
        position: new google.maps.LatLng(locations[i][0], locations[i][1]),
        map: map,
		icon: 'icon.png'
      });
	  
    /* menambahkan event clik untuk menampikan infowindows dengan isi sesuai dgn marker yang di klik */		
      google.maps.event.addListener(marker, 'click', (function(marker, i) {
        return function() {
          infowindow.setContent('<img src="' + locations[i][3] + '" width="80" /><br/><b>' + locations[i][2] + '</b>'); //ini untuk yang gambar
		  //infowindow.setContent('<video width="320" height="240" controls><source src="' + locations[i][3] + '" type="video/mp4"><source src="movie.ogg" type="video/ogg">Your browser does not support the video tag.</video>');
          infowindow.open(map, marker);
        }
      })(marker, i));
    }
  };
})();
</script>

<!-- Style untuk Peta -->
<style>
#peta {
     border:1px solid #000;
	 width:700px;
	 height:500px;
}
</style>
</head>
<body>
<div align="center">  
	<div id="peta"></div>
</div>
</body>
</html>
