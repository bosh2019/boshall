<!DOCTYPE html>
<html>
  <head>
    <style>
      /* Set the size of the div element that contains the map */
      #map {
        height: 500px;  /* The height is 400 pixels */
        width: 42%;
        position: fixed !important;
       }
    </style>
    <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
<scriptnsrc="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
  </head>
  <body>
    <!--The div element for the map -->
    
    <div class="container">
          <div class="row" style="margin-top:40px">
               <div class="col-md-6">
                     <div id="map" ></div>
               </div>
               <div class="col-md-6">
                    <div class="row">
                     <?php
                        for($i=0;$i<=10;$i++):
                     ?>
                      <div class="col-md-4" id="goto_<?=$i;?>">
                        <div class="thumbnail">
                          <img src="https://via.placeholder.com/150" alt="...">
                          <div class="caption">
                            <h3>Thumbnail label</h3>
                           
                          </div>
                        </div>
                      </div>
                      <?php
                       endfor;
                      ?>
                    </div>
               </div>
          </div>
    </div>

   
     
   
   
   <script src="js/modernizr.js"></script>
    <script>
                var map,
                desktopScreen = Modernizr.mq( "only screen and (max-width:1024px)" ),
                zoom = desktopScreen ? 10 : 10,
                scrollable = draggable = !Modernizr.hiddenscroll || desktopScreen,
                isIE11 = !!(navigator.userAgent.match(/Trident/) && navigator.userAgent.match(/rv[ :]11/));
                function initMap() 
                {
          
    
                            var myLatLng = {lat: 28.580018, lng: 77.321511};
                            map = new google.maps.Map(document.getElementById('map'), {
                                zoom: zoom,
                                center: myLatLng,
                                mapTypeId: google.maps.MapTypeId.TERRAIN,
                                scrollwheel: scrollable,
                                draggable: draggable,
                            
                                styles: [{"stylers": [{ "saturation": 10 }]}]
                            });
                            
                            
                            /*marker array*/
                          var locations = [
                                    {
                                        title: 'boshall',
                                        position: {lat: 28.580018, lng: 77.321511},
                                        icon: {url: isIE11 ? "images/markers/png/location2.png" : "images/markers/svg/location2.png",scaledSize: new google.maps.Size(60, 60),
                                        
                                        },
                                        url:"#goto_0",
                                        contentString:'<h4 id="firstHeading" class="firstHeading">Test</h4>'
                
                                    },
                                    
                                    <?php
                                    $lat=["28.5767605","28.509393","28.510204","28.496164276611854","28.624603256696673","28.4568942","28.6004374","28.4298623"];
                                    $lng=["77.4322595","77.381558","77.424323","77.4023583203766","77.41607150317986","77.51564510000003","77.44437259999995","77.50789910000003"];
                                       for($i=0;$i<=7;$i++):
                                    ?>
                                     {
                                        title: 'boshall<?php echo $i; ?>',
                                        position: {lat: <?php echo $lat[$i] ?> , lng: <?php echo $lng[$i] ?>},
                                        icon: {url: isIE11 ? "https://acresninches.com/images/markers/png/Home_4.png" : "https://acresninches.com/images/markers/png/Home_4.png",scaledSize: new google.maps.Size(50, 50),
                                        
                                        },
                                        url:"#goto_<?=$i;?>",
                                        contentString:'<h4 id="firstHeading_<?= $i;?>" class="firstHeading">test<?= $i; ?></h4>'
                
                                    },
                                 <?php endfor;?>
                            ];
                            
                            /*end marker array*/
                            
                            /*start loop location marker*/
                            
                    locations.forEach( function( element, index ){  
                    var marker = new google.maps.Marker({
                        position: element.position,
                        map: map,
                        title: element.title,
                        icon: element.icon,
                        url:  element.url,
                        
                    });
                    var infowindow = new google.maps.InfoWindow({
                      content: element.contentString
                    });
                    
                    if (screen.width > 800){
                        marker.addListener('mouseover', function() {
                          infowindow.open(map, marker);
                          var target = $(marker.url);

                                    $('html, body').animate({
                                        scrollTop: target.offset().top
                                    }, 1500);
                        });
                        marker.addListener('mouseout', function() {
                          infowindow.close(map, marker);
                        });
                    }
                    
                    if (screen.width < 800){

                    marker.addListener('click', function() {
                          infowindow.open(map, marker);
                                    
                             var target = $(marker.url);

                                    $('html, body').animate({
                                        scrollTop: target.offset().top
                                    }, 1500);
                                    
                        });
                         
                        
                        }
                    
                }); 
                }/*end initmap*/
    </script>
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD1V5snT00sU2-Ix88PcJosqxvkXjSTq9w&callback=initMap&libraries=places" async="" defer=""></script>
  </body>
</html>		
