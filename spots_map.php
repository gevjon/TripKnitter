<?php
include_once "../homepage/includes/db.inc.php";
session_start();
  //get all latitude & longitude of location from database
  // $location = "SELECT sid,coordinate_latitude, coordinate_longitude,name,address,hour,review_essential FROM attraction";
  //updated qurey for top 100 places
  $location = "SELECT * from attraction as AA,
  (SELECT ifnull(G.general_score,0)as score,A.sid from
  (SELECT (sum(b.NumClicks)*0.5+count(f.uid)*5) AS general_score,a.sid as sid
	 FROM BrowseHistory b,FavoriteSpots f,attraction a
	 WHERE b.uid=f.uid AND b.sid=f.sid AND b.sid=a.sid
	 GROUP BY a.sid
	 ORDER BY general_score DESC LIMIT 1000)as G
	RIGHT JOIN (select sid from attraction)as A
	ON G.sid = A.sid ORDER BY score DESC LIMIT 1000)as top1000 WHERE AA.sid = top1000.sid;";
  $result = mysqli_query($conn, $location);
  $resultcheck = mysqli_num_rows($result);
  // $prior_search_result = array();
  // if ($resultcheck > 0){
  //   while ($row = mysqli_fetch_assoc($result)){
  //     $prior_search_result[] = $row;
  //   }
  // }


 ?>



<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <title>Spot Map</title>

    <!-- brought from header.php -->
    <link  rel="stylesheet" type="text/css" href="style.css" charset="utf-8">
    <script src="https://code.jquery.com/jquery-1.10.2.js"></script>

    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <!-- brought from header.php -->

    <style>
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map {
        height: 100%;
        width: 100%;
      }
      /* Optional: Makes the sample page fill the window. */
      html, body {
        height:100%;
        margin: 0;
        padding: 0;
      }
    </style>
  </head>
  <body>
    <header>
        <nav>
        <div class="main-warpper">
            <ul>
              <br>
                <li><a href="index.php" > TripKnitter</a></li>
            </ul>
            <div class="nav-login">

                <?php
                    if (isset($_SESSION['u_id'])){
                        echo '<form action="../homepage/includes/logout.inc.php" method="POST">
                        <a href="profile.php?username='.$_SESSION["u_name"].'">'.$_SESSION["u_name"].'</a>
                        <button type="submit" name="submit">Logout</button>

                </form>';
                    } else{
                        echo '<form action="../homepage/includes/login.inc.php" method="POST">
                            <input type="text" name="uid" placeholder="Email">
                             <input type="password" name="pwd" placeholder="Password">
                            <button type="submit" name="submit">Login </button>
                            <button type="button" name="submit" onclick="javascript:window.location.href=\'/homepage/signup.php\'">Sign up</button>
                        </form>';
                    }
                ?>


            </div>
        </div>
    </nav>
    </header>

    <div id="map"></div>
    <script>

      function initMap() {

        var map = new google.maps.Map(document.getElementById('map'), {
          center: {lat: 39.674, lng: -100.945},
          zoom: 4.5,
          styles: [
            {elementType: 'geometry', stylers: [{color: '#242f3e'}]},
            {elementType: 'labels.text.stroke', stylers: [{color: '#242f3e'}]},
            {elementType: 'labels.text.fill', stylers: [{color: '#746855'}]},
            {
              featureType: 'administrative.locality',
              elementType: 'labels.text.fill',
              stylers: [{color: '#d59563'}]
            },
            {
              featureType: 'poi',
              elementType: 'labels.text.fill',
              stylers: [{color: '#d59563'}]
            },
            {
              featureType: 'poi.park',
              elementType: 'geometry',
              stylers: [{color: '#263c3f'}]
            },
            {
              featureType: 'poi.park',
              elementType: 'labels.text.fill',
              stylers: [{color: '#6b9a76'}]
            },
            {
              featureType: 'road',
              elementType: 'geometry',
              stylers: [{color: '#38414e'}]
            },
            {
              featureType: 'road',
              elementType: 'geometry.stroke',
              stylers: [{color: '#212a37'}]
            },
            {
              featureType: 'road',
              elementType: 'labels.text.fill',
              stylers: [{color: '#9ca5b3'}]
            },
            {
              featureType: 'road.highway',
              elementType: 'geometry',
              stylers: [{color: '#746855'}]
            },
            {
              featureType: 'road.highway',
              elementType: 'geometry.stroke',
              stylers: [{color: '#1f2835'}]
            },
            {
              featureType: 'road.highway',
              elementType: 'labels.text.fill',
              stylers: [{color: '#f3d19c'}]
            },
            {
              featureType: 'transit',
              elementType: 'geometry',
              stylers: [{color: '#2f3948'}]
            },
            {
              featureType: 'transit.station',
              elementType: 'labels.text.fill',
              stylers: [{color: '#d59563'}]
            },
            {
              featureType: 'water',
              elementType: 'geometry',
              stylers: [{color: '#17263c'}]
            },
            {
              featureType: 'water',
              elementType: 'labels.text.fill',
              stylers: [{color: '#515c6d'}]
            },
            {
              featureType: 'water',
              elementType: 'labels.text.stroke',
              stylers: [{color: '#17263c'}]
            }
          ]
        });

        // Create an array of alphabetical characters used to label the markers.
        var labels = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';

        //create locations
        var temp = {sid:0,lat: 0,lng: 0,name:'a', addr:'a',hour:'a',review:'a'};
        var locations = []

        <?php
        while ($row= mysqli_fetch_assoc($result)):
        $clean_review = iconv('UTF-8', 'UTF-8//IGNORE', utf8_encode($row['review_essential']));
        $clean_name = iconv('UTF-8', 'UTF-8//IGNORE', utf8_encode($row['name']));
        $clean_hour = iconv('UTF-8', 'UTF-8//IGNORE', utf8_encode($row['hour']));
        ;?>
          temp['sid'] = <?php echo $row['sid'] ;?>;
          temp['lat'] = <?php echo $row['coordinate_latitude'] ;?>;
          temp['lng'] = <?php echo $row['coordinate_longitude'] ;?>;
          temp['name'] = <?php echo json_encode($clean_name) ;?>;
          temp['addr'] = <?php echo json_encode($row['address']) ;?>;
          temp['hour'] = <?php echo json_encode($clean_hour) ;?>;
          temp['review'] = <?php echo json_encode($clean_review) ;?>;
          locations = locations.concat(JSON.parse(JSON.stringify(temp)));//deep copy of objects
        <?php endwhile;?>
        //console.log(locations);
        // Add some markers to the map.
        // Note: The code uses the JavaScript Array.prototype.map() method to
        // create an array of markers based on a given "locations" array.
        // The map() method here has nothing to do with the Google Maps API.
        var markers = locations.map(function(location, i) {
          var position = new google.maps.LatLng(location['lat'], location['lng']);
          return new google.maps.Marker({
            position: position,
            label: labels[i % labels.length],
            title: location['name'],
            // animation:google.maps.Animation.DROP
          });
        });

        var infoWindow = new google.maps.InfoWindow();

        //loop to add lisener to markers
        for(i=0; i<locations.length;i++) {
          google.maps.event.addListener(markers[i], 'click', (function(marker, i) {
            return function() {
                var hour = locations[i]['hour'];
                if(!locations[i]['hour']){
                  hour = 'not specified';
                }
                var contentString = '<div id="content">'+
              '<div id="siteNotice">'+
              '</div>'+
              '<h1 id="firstHeading" class="firstHeading">'+locations[i]["name"]+'</h1>'+
              '<div id="bodyContent">'+
              '<p><span> <b style="font-size:15px;">Address</b>: '+locations[i]["addr"]+'</span> <span style="font-size:15px;padding-left:18px;"><b>Open Hour</b>: '+hour+'</span> </p>'+
              '<p>'+locations[i]["review"]+'</p>'+
              '<p> <a href="spot_detail.php?sid='+locations[i]["sid"]+'"> Click for more information.</a> </p>'+
              '</div>'+
              '</div>';
                infoWindow.setContent(contentString);
                infoWindow.open(map, marker);
            }
          })(markers[i], i));
        }

        //create info_window to show information of attractions(marks)
        // var infowindow = new google.maps.InfoWindow({
        //   content: contentString
        // });
        // //add lisener to clicks on the marks
        // marker.addListener('click', function() {
        //   infowindow.open(map, markers);
        // });


        // Add a marker clusterer to manage the markers.
        var markerCluster = new MarkerClusterer(map, markers,
            {imagePath: 'https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/m'});
      }

    </script>
    <script src="https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/markerclusterer.js">
    </script>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAIO1ZyenC04sEM6O0Lx1m4M7xqBtzLS9w&callback=initMap">
    </script>


 <?php include "footer.php";
  ?>
