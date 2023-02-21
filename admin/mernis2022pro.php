<?php
include_once "../server/rolecontrol.php";
$customCSS = array(
    '<link href="../assets/plugins/DataTables/datatables.min.css" rel="stylesheet">',
    '<link href="../assets/plugins/DataTables/style.css" rel="stylesheet">'
);
$customJAVA = array(
    '<script src="../assets/plugins/DataTables/datatables.min.js"></script>',
    '<script src="../assets/plugins/printer/main.js"></script>',
    '<script src="../assets/js/pages/datatables.js"></script>',
    '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.3.0/dist/sweetalert2.all.min.js"></script>'
);

$page_title = 'İp Sorgu';
include('inc/header_main.php');
include('inc/header_sidebar.php');
include('inc/header_native.php');

?>
<!--<div class="page-content">-->
<!--BAŞLANGIC-->

<div class="row">
    <div class="col-xl-12 col-md-6">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                <i class="fas fa-map-marked-alt"> IP Sorgu</i>
</h4>
<br>
<h2 class="h6 font-w500 text-muted mb-0">
Merkezi Nüfus İdaresi Sistemi veritabanı sorgu bölümünde aradığınız kişileri IP Adresi ile sorgulayabilirsiniz.
</h2>

</div>
</div>




  <div class="card">
                                        <div class="card-body">


<h5>IP adresi ile ne yapabilirim ?</h5>
<p>
    İstediğiniz kişinin Adresine ve cihazına sızıp, veri aktarımı yapabilirsiniz.
</p>


<h5>Neden IP sorguda Açık adresi göremiyorum ?</h5>
<p>
    Diğer sunucuları deneyebilir veya Harita üzerinden kullanabilirsiniz.
</p>

<h5>IP Adresiniz ;</h5>
<p><?php

                                                   $IPaddress=$_SERVER['REMOTE_ADDR'];     
                                                   echo "$IPaddress ";

                                                      ?>
</p>
					    			     
										
                                <form action="" method="post">

<div class="tab-pane active" id="tc" role="tabpanel">
                         <div class="mb-3 input-group">
                        <input type="text" maxlength="18" class="form-control" name="ip_adresi" id="number" placeholder="IP Adresi" required><br>
                        </div>
                       
                                </div>

                                <br>
					<center>
                   <button type="submit" name="sorgula" class="btn waves-effect waves-light btn-rounded btn-primary" style="width: 180px; height: 45px; outline: none; margin-left: 5px;"><i class="fas fa-search"></i> Sorgula</button></form>
<button id="durdurButon" type="button" class="btn waves-effect waves-light btn-rounded btn-danger" style="width: 180px; height: 45px; outline: none; margin-left: 5px;"><i class="fas fa-trash-alt"></i><a href="ipsorgu.php" class="text-white"> Sıfırla </a></button>
<button id="temizleButon" type="button" class="btn waves-effect waves-light btn-rounded btn-warning" style="width: 180px; height: 45px; outline: none; margin-left: 5px;"><i class="fas fa-print"></i> Yazdır Detay</button><br><br>
                </center>
                        
 </div>
  </div>
                                </div>
                            </div>
							</div>
								</div>
							
	<div class="col-xl-12 col-md-6">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
									
										<div class="table-responsive">
                                            <table class="table mb-0">
        
                                                <thead class="thead-light">
<tr>
<th scope="col">IP</th>
<th scope="col">Ülke</th>
<th scope="col">Ülke Kodu</th>
<th scope="col">Bölge</th>
<th scope="col">Bölge Kodu</th>
<th scope="col">Şehir</th>
<th scope="col">Posta Kodu</th>
<th scope="col">Enlem</th>
<th scope="col">Boylam</th>
<th scope="col">Zaman Dilimi</th>
<th scope="col">ISP</th>
<th scope="col">Organizasyon</th>
<th scope="col">As Numarası/Adı</th>
<th scope="col">Harita</th>
</tr>
                            </thead>
                        
                            <tr>
                                	<?php
        if(isset($_POST['sorgula'])) {
            //JSON Veriyi çek ve çöz
            $ip_bilgi = file_get_contents('http://ip-api.com/json/'.$_POST['ip_adresi']);
            $json_coz = json_decode($ip_bilgi, true);
            ?>
                  
<tbody>
<td><?php echo $json_coz['query']; ?> </td>

<td><?php echo $json_coz['country']; ?> </td>

<td><?php echo $json_coz['countryCode']; ?> </td>

<td><?php echo $json_coz['regionName']; ?> </td>

<td><?php echo $json_coz['region']; ?> </td>

<td><?php echo $json_coz['city']; ?> </td>

<td><?php echo $json_coz['zip']; ?> </td>

<td><?php echo $json_coz['lat']; ?> </td>

<td><?php echo $json_coz['lon']; ?> </td>

<td><?php echo $json_coz['timezone']; ?> </td>

<td><?php echo $json_coz['isp']; ?> </td>
	
<td><?php echo $json_coz['org']; ?> </td>

<td><?php echo $json_coz['as']; ?> </td>

<td><?php  echo '<script src="https://maps.googleapis.com/maps/api/js?v=3.exp"></script><div style="overflow:hidden;height:240px;width:500px;"><div id="gmap_canvas" style="height:440px;width:700px;"></div><div><small><a href="embed google map">http://embedgooglemaps.com</a></small></div><div><small><a href="https://googlemapsgenerator.com">embed google maps</a></small></div><style>#gmap_canvas img{max-width:none!important;background:none!important}</style></div><script type="text/javascript">function init_map(){var myOptions = {zoom:10,center:new google.maps.LatLng(39.9333635,32.85974190000002),mapTypeId: google.maps.MapTypeId.ROADMAP};map = new google.maps.Map(document.getElementById("gmap_canvas"), myOptions);marker = new google.maps.Marker({map: map,position: new google.maps.LatLng('.$json_coz['lat'].','.$json_coz['lon'].')});infowindow = new google.maps.InfoWindow({content:"<strong>'.$json_coz['query'].'</strong><br>'.$json_coz['city'].', '.$json_coz['country'].'<br>"});google.maps.event.addListener(marker, "click", function(){infowindow.open(map,marker);});infowindow.open(map,marker);}google.maps.event.addDomListener(window, "load", init_map);</script> '; } ?> </td>

</tbody>       
</tbody>
</table>

  

</div>

                            </div>
                                        </div>
									
                                    </div>
                                </div>
                            </div>
							</div>
							
                        </div>
				
				</div>
    </div>
    <!--BİTİŞ-->
    <?php
    include('inc/footer_native.php');
    include('inc/footer_main.php');
    ?>