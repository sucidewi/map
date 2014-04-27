<?
    //Koneksi
    $koneksi = mysql_connect("localhost","root","");
    $selectdb = mysql_select_db("wisata" , $koneksi);
 
    $SQLquery = "SELECT * FROM koordinat";
    $result = mysql_query($SQLquery);
    $counter = 0;
 
    //Send layer properties
    echo '{ "name":"Markers", "type":"marker", "data" : [ ';
    //Loop markers, sending to client
    while($row = mysql_fetch_array($result)){
        if ($counter != 0) { echo "," ; }   //Dealing with commas
        echo '{"lat":"' . $row['lat'] . '","lng":"' . $row['long']. '","title":"' . $row['nama_wisata']. '"}';
        $counter++;
    }
    echo " ] }";   //finishing up, and sending to client
?>