<?php
/**
* Created by mcmraak (mcmraak@gmail.com)
*/

$l = $params->get('l_input');
$w = $params->get('w_input');
$z = $params->get('zoom');
$ww = $params->get('ww');
$hh = $params->get('hh');
$hint = $params->get('hint');
$desc = $params->get('desc');
$cj = $params->get('colorjson');
$icon = $params->get('icon');

?>
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&signed_in=true"></script>
<script type="text/javascript">

var myArea = new google.maps.LatLng(<?php echo $w; ?>, <?php echo $l; ?>);

function initialize() {

  var ColorTuning = <?php echo $cj; ?>;
    

  var mapOptions = {
    //scrollwheel: false,
    zoom: <?php echo $z; ?>,
    center: myArea,
    mapTypeControlOptions: {
      mapTypeIds: [google.maps.MapTypeId.ROADMAP, 'usroadatlas']
    }
  };

  var map = new google.maps.Map(document.getElementById('map-canvas'),mapOptions);
  
  var marker = new google.maps.Marker({
      position: myArea,
      map: map,
      <?php
        if(!empty($icon)){
            echo "icon: '$icon',";
        }
      ?>
      title: '<?php echo $hint; ?>',
      clickable: true
  });
  
  marker.info = new google.maps.InfoWindow({
                       content: "<?php echo $desc; ?>"
                      });
  google.maps.event.addListener(marker, 'click', function() {   
                            this.info.open(map,this);//(map, this);  
                        });
                        
  marker.info.open(map,marker);

  var usRoadMapType = new google.maps.StyledMapType(ColorTuning);
  map.mapTypes.set('usroadatlas', usRoadMapType);
  map.setMapTypeId('usroadatlas');
  
}

google.maps.event.addDomListener(window, 'load', initialize);

</script>
<div id="map-canvas" style="width: <?php echo $ww; ?>; height: <?php echo $hh; ?>;"></div>