<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Google Maps</title>
    
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>

<br><br>
<div class="container">

<div class="row">

   <div class="col-md-6">
      <h3>Find Location</h3>
      <p class="Para_cont">Please enter your town, city or postcode.</p>
      <div class="meetup-form">
        <div class="meetup-search-wrapper">
          <div class="search-field">
            <input type="text" name="new_Location" id="search_text_location" class="new_Location form-control" 
            value="<?=!empty($_REQUEST['location'])?$_REQUEST['location']:''?>"
            >
          </div>
          <br>
          <div class="btn-srch-wrapper">
            <button class="btn btn-srch btn-default" id="search">Search</button>
          </div>

            <br><br>
            <label>Latitude</label>
            <input id="cityLat" name="cityLat" class="cityLat form-control" name="locationLatitude" value="<?=!empty($_REQUEST['lat'])?$_REQUEST['lat']:''?>">
            <br>
            <label>Longitude</label>
            <input id="cityLng" name="cityLng" class="cityLng form-control" name="locationLongitude"  value="<?=!empty($_REQUEST['lng'])?$_REQUEST['lng']:''?>">
            <br>
            <label>Place</label>
            <input id="placeName" name="placeName" class="form-control" name="placeName" value="<?=!empty($_REQUEST['location'])?$_REQUEST['location']:''?>"> 

        </div>
      </div>
    </div>

     <div class="col-md-6">
        <br><br>
        <div id="map" style="height:100%; min-height:300px;"></div>
    </div>

</div>


</div>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

  <script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyBeTiA0pbz2lpAT8afVP1uiO7etc2gKcYw&libraries=places" type="text/javascript"></script>

  <script type="text/javascript">
      function initialize() {
          var input = document.getElementById('search_text_location');
          var autocomplete = new google.maps.places.Autocomplete(input);
          google.maps.event.addListener(autocomplete, 'place_changed', function () {
              var place = autocomplete.getPlace();
              document.getElementById('placeName').value = place.name;
              document.getElementById('cityLat').value = place.geometry.location.lat();
              document.getElementById('cityLng').value = place.geometry.location.lng();
              document.getElementById('search_text_location').value = place.name;

              var varlat = place.geometry.location.lat();
              var varlng = place.geometry.location.lng();

             var map;
            map = new google.maps.Map(document.getElementById('map'), {
             center: {lat: varlat, lng: varlng},
              // zoom: 5 continent / 10 city / 15 streets / 20 buildings
              zoom: 10
            });
          });

      }


      jQuery(document).ready(function(){

          setTimeout(function(){  

            google.maps.event.addDomListener(window, 'load', initialize);
            var lat1 = jQuery(".cityLat").val();
            var lng1 = jQuery(".cityLng").val();
            var loc2 = jQuery(".new_Location").val();
            
            if(lat1 != "")
            {
            var map;
                map = new google.maps.Map(document.getElementById('map'), {
                center: {lat: parseFloat(lat1), lng: parseFloat(lng1)},
                zoom: 10
                });

            }else{
               var map;
               map = new google.maps.Map(document.getElementById('map'), {
               center: {lat: 51.5073509, lng: -0.12775829999998223},  
               // zoom: 5 continent / 10 city / 15 streets / 20 buildings
               zoom: 5
               });
            }
          }, 100);

      });

  </script>


<script type="text/javascript">
  jQuery(document).ready(function(){
    jQuery("#search").click(function(){
      var loc = jQuery(".new_Location").val();
      var lat = jQuery(".cityLat").val();
      var lng = jQuery(".cityLng").val();
      window.open(document.location.protocol +"//"+ document.location.hostname + document.location.pathname + "?location=" + loc + "&lat=" + lat + "&lng=" + lng,"_self")
    });
  });
</script>


  </body>
</html>

