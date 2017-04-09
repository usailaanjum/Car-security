<?php

session_start();

require 'database.php';

if( isset($_SESSION['user_id']) ){

	$records = $conn->prepare('SELECT id,email,password FROM users WHERE id = :id');
	$records->bindParam(':id', $_SESSION['user_id']);
	$records->execute();
	$results = $records->fetch(PDO::FETCH_ASSOC);

	$user = NULL;

	if( count($results) > 0){
		$user = $results;
	}

}

?>


<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>secondpage.EDP</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
  <!--  <link href="//fonts.googleapis.com/css?family=Roboto:400,300,200,100&subset=latin,cyrillic" rel="stylesheet"> -->
    <!-- linking to personal CSS -->
   <link rel="stylesheet" href="css/response.css">

    <!-- Latest compiled and minified CSS BOOTSTRAP framework -->
    <link rel="stylesheet"
          href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
          integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u"
          crossorigin="anonymous">

    <!-- Optional BOOTSTRAP theme -->
  <link rel="stylesheet"
          href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css"
          integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp"
          crossorigin="anonymous">
  </head>
  <body>
    <!-- Main header to be in all pages -->
   <div id="topHeader" class = "nav-header">
    <div class="container">
          <header>
            <nav class="navbar" style="padding-top: 18px;
            display: table-row-group;">
              <ul>
              <!-- Relative Paths -->
                <li role="presentation"><a href="index.php">Home</a></li>
                <li role="presentation"><a href="about.html">About the Device</a></li>
                <li role="presentation"><a href="index.php#section3">Contact</a></li>
              <!--  <li role="presentation"><a href="references.html">Reference</a></li> -->
                <li role="presentation"><a href="logout.php">Logout?</a></li>
              </ul>
            </nav>
          </header>
        </div>
      </div>
<!-- [END main header] -->

<div class="welcomeuser">
<?php if( !empty($user) ): ?>
  <br />Welcome <?= $user['email']; ?>
  .You are successfully logged in!
  <br /><br />
  <a href="logout.php">Logout?</a>

  	<?php endif; ?>
<br /><br>
</div>


<div class="jumbotron text-center">
  <div class="container" >
    <h1>Speed</h1>
  </div>
</div>

<div class="display_speed">
	  <span id="car_speed">Waiting for the car speed...</span><br>
	  <script type="text/javascript">
		var deviceID = "530028001951353338363036";
	var accessToken = "2c74fceaf932202ea057ca4477df1a7e3ff27b20";
		window.setInterval(function() {
        var varName3 = "carrspeed"; /* <--------- WHAT IS THE NAMEE?? */

        requestURL = "https://api.particle.io/v1/devices/" + deviceID + "/" + varName3 + "/?access_token=" + accessToken;
        $.getJSON(requestURL, function(json) {
                 document.getElementById("car_speed").innerHTML = json.result+'m/s';
                 document.getElementById("car_speed").style.fontSize = "28px";

                 });
		}, 10000);

	  </script>
</div>


<div class="jumbotron text-center">
  <div clas="container" >
    <h1>Location</h1>
  </div>
</div>
    <!-- ADD GOOGLE MAP API -->
 <div id= "googleMap" class="container"> </div>

<div class="container">
    <script
    src="http://maps.googleapis.com/maps/api/js?key=AIzaSyCe3IJlceCne9sVoH-xXDuciBVoFlooHSE&callback=initMap">
    </script>
    <script type="text/javascript"   src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

    <script>
       var myCenter = new google.maps.LatLng(43.661713, -79.373749); //insert the particle API

        function initialize() {
        var mapProp = {
        center:myCenter,
        zoom:15,
        scrollwheel:false,
        draggable:false,
        mapTypeId:google.maps.MapTypeId.ROADMAP
        };

        var map = new google.maps.Map(document.getElementById("googleMap"),mapProp);

        var marker = new google.maps.Marker({position:myCenter,});

        marker.setMap(map);
        }

        google.maps.event.addDomListener(window, 'load', initialize);


				function start(){
					var deviceID="530028001951353338363036";
					var accessToken= "2c74fceaf932202ea057ca4477df1a7e3ff27b20";
					var varName1 = "lat";
					var varName2 = "lng";
					reqURL = ("https://api.particle.io/v1/devices/" + deviceID + "/"+ varName1+ "/"+ varName2 + "/?access_token=" + accessToken);

								eventSource.addEventListener('gpsloc', function(e) {
									var parsedData = JSON.parse(e.data);
									var location = parsedData.data.split(",");

									console.log( parsedData.data);
									console.log(data[0]);
									console.log(data[1]);

									loc = new google.maps.LatLng(data[0], data[1]);

									marker.setMap(null);

									marker = new google.maps.Marker({position: loc, map: map});

									marker.setMap(null);
									map.panTo(loc);
									marker.setMap(map);

								}, false);
							}
							window.onload=start;




      </script>
</div>
<br>
<br>

<!-- [ACIVITY LOG TABLE START] -->
  <div class="jumbotron text-center">
    <div clas="container" >
      <h1>System Activity Log</h1>
    </div>
  </div>

  <!-- for location does it give a major intersection in the log or exact location address?
  GOOGLE MAP SHOWS A REAL TIME TRACKING AS WELL. -->
  <div class="activity_table">
  <table class="table">
  <!-- Table rows tr -->
  <tr>
    <!-- Table headers -->
    <th>Date</th>
    <th>Time</th>
    <th>Location</th>
    <th>Vehicle Status</th>
  </tr>
  <tr>
    <!-- Data in a row -->
    <td>02/03/2017</td>
    <td>11.50 am</td>
    <td>250 Yonge St.</td>
    <td>Secured</td>
  </tr>
  <tr>
    <td>06/03/2017</td>
    <td>9.10am</td>
    <td>340 Dixon Rd.</td>
    <td>Secured</td>
  </tr>
  <tr>
    <td>07/03/2017</td>
    <td>12.00 pm</td>
    <td>340 Church St.</td>
    <td>Secured</td>
  </tr><tr>
    <td>07/03/2017</td>
    <td>3.00 pm</td>
    <td>250 Victoria St.</td>
    <td>Security breach!!</td>
  </tr>
  </table>
</div>
<!-- [END ACTIVITY TABLE] -->



  <!-- // [START footer] -->
  <!-- got to ADD Twitter and linkedin link -->
        <footer>
          <div class="container">

            <br>
              <nav class="social">
                <ul>
                <!-- Relative Paths -->
                  <li class="social-git"><a href="https://github.com/usailaanjum/edp.git">
                    <img height = "40px" width="40px" src = "http://www.freeiconspng.com/uploads/github-logo-icon-30.png" alt="github octopus icon"/>
                  </a></li>
                  <li class="social-tweet"><a href="#"><img hight = "30px" width="30px" src="https://image.flaticon.com/icons/png/512/8/8800.png" alt="Twitter bird icon"/></a></li>
                  <li class="social-linkedin"><a href="#"><img hight = "30px" width="30px" src= "https://cdn3.iconfinder.com/data/icons/picons-social/57/11-linkedin-128.png" alt="linked in icon"/></a></li>
                </ul>
              </nav>
        </div>
        </footer>
      <!-- // [END footer] -->



            <!-- [RESPONSIVE Listener START]-->
            <script type="text/javascript">
                function init() {
                  window.matchMedia("(max-width: 600px)").addListener(hitMQ);
                }

              function hitMQ(evt) {
                sampleCompleted("GettingStarted-ContentWithStyles");
              }

                init();
            </script>
            <!-- [RESPONSIVE Listener END]-->

            <!-- Latest compiled and minified JavaScript for bootstrap -->
              <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
                integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
                crossorigin="anonymous">
              </script>


            <!-- jQuery -->
            <script src="js/jquery-3.2.0.js"></script>
            <script src="js/jquery.min.js"></script>
            <!-- Owl Carousel -->
            <script src="js/owl.carousel.min.js"></script>
            <!-- Customized Slider -->
            <script src="js/custom.js"></script>

</body>
</html>
