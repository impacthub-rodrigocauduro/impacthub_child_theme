<!DOCTYPE html>
<html>
  <head>
    <script
    src="https://code.jquery.com/jquery-3.2.1.min.js"
    integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
    crossorigin="anonymous"></script>
    <style>
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map {
        height: 100%;
      }
      /* Optional: Makes the sample page fill the window. */
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
    </style>
  </head>
  <body>
    <div id="map"></div>
    <script>
      var aStyle = [
    {
        "featureType": "administrative",
        "elementType": "labels.text.fill",
        "stylers": [
            {
                "color": "#444444"
            }
        ]
    },
    {
        "featureType": "landscape",
        "elementType": "all",
        "stylers": [
            {
                "color": "#f2f2f2"
            }
        ]
    },
    {
        "featureType": "poi",
        "elementType": "all",
        "stylers": [
            {
                "visibility": "off"
            }
        ]
    },
    {
        "featureType": "road",
        "elementType": "all",
        "stylers": [
            {
                "saturation": -100
            },
            {
                "lightness": 45
            }
        ]
    },
    {
        "featureType": "road.highway",
        "elementType": "all",
        "stylers": [
            {
                "visibility": "simplified"
            }
        ]
    },
    {
        "featureType": "road.arterial",
        "elementType": "labels.icon",
        "stylers": [
            {
                "visibility": "off"
            }
        ]
    },
    {
        "featureType": "transit",
        "elementType": "all",
        "stylers": [
            {
                "visibility": "off"
            }
        ]
    },
    {
        "featureType": "water",
        "elementType": "all",
        "stylers": [
            {
                "color": "#c446ec"
            },
            {
                "visibility": "on"
            }
        ]
    },
    {
        "featureType": "water",
        "elementType": "geometry.fill",
        "stylers": [
            {
                "color": "#792f2a"
            }
        ]
    },
    {
        "featureType": "water",
        "elementType": "labels.text.fill",
        "stylers": [
            {
                "color": "#ffffff"
            }
        ]
    }
];
      var aLocations = [];

      var map;
      function initMap() {
        map = new google.maps.Map(document.getElementById('map'), {
          zoom: 2,
          center: new google.maps.LatLng(2.8,-187.3),
          mapTypeId: 'terrain',
          styles : aStyle
        });

        jQuery.ajax( {
            url: 'https://spreadsheets.google.com/feeds/list/1H9SyvK8ITEz6qH8R4QxWdgXhzg1LnqlfUk2JBihnNyo/od6/public/values?alt=json',
            method: 'GET',
          }).done( function ( response ) {

                for (var i = 0; i < response.feed.entry.length; i++) {

                  var infoWindow = new google.maps.InfoWindow;

                  var coords = response.feed.entry[i];
                  var lat  = coords.gsx$latitude.$t;
                  var long = coords.gsx$longitude.$t;
                  var title = coords.gsx$ihname.$t;

                  aLocations[title] = coords;
                  // console.log('coords',coords);
                  // console.log(lat , long );
                  var latLng = new google.maps.LatLng( lat , long );
                  var marker = new google.maps.Marker({
                    position : latLng,
                    map      : map,
                    title    : title
                  });

                  marker.addListener('click', function() {
                    console.log(this.title,aLocations, aLocations[this.title] );
                    infoWindow.setContent( aLocations[this.title].gsx$ihname.$t );

                    var lat  = aLocations[this.title].gsx$latitude.$t;
                    var long = aLocations[this.title].gsx$longitude.$t;
                    var title = aLocations[this.title].gsx$ihname.$t;
                    var latLng = new google.maps.LatLng( lat , long );

                    var marker = new google.maps.Marker({
                      position : latLng,
                      map      : map,
                      title    : title
                    });

                    infoWindow.open(map, marker);
                  });

                }
                marker.setMap(map);
        });
      }

    </script>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB_Yb78OYsEZgzn2bfCxUNhdv9BzIbCI3E&callback=initMap">
    </script>
  </body>
</html>
