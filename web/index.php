<html>
<style>
  .example
  {
    width: auto;
    color: #000000;
    background-color: #e5eecc;
    margin: 10px 0px 10px 0px;
    padding: 5px;
    border: 1px solid #d4d4d4;
    background-image: linear-gradient( #ffffff , #e5eecc 100px);
  }
  .roundedCorner
  {
    border:2px solid #30000a;
    padding:10px 40px;
    background:#dddddd;
    width:300px;
    border-radius:25px;
    box-shadow: 20px 10px 5px #888888;
  }
  .gradient
  {
    margin-top: 20px;
    height: 50px;
    background: #1e5799; /* Old browsers */
    background: -moz-linear-gradient(top,  #1e5799 0%, #2989d8 50%, #207cca 100%, #7db9e8 100%); /* FF3.6+ */
    background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#1e5799), color-stop(50%,#2989d8), color-stop(100%,#207cca), color-stop(100%,#7db9e8)); /* Chrome,Safari4+ */
    background: -webkit-linear-gradient(top,  #1e5799 0%,#2989d8 50%,#207cca 100%,#7db9e8 100%); /* Chrome10+,Safari5.1+ */
    background: -o-linear-gradient(top,  #1e5799 0%,#2989d8 50%,#207cca 100%,#7db9e8 100%); /* Opera 11.10+ */
    background: -ms-linear-gradient(top,  #1e5799 0%,#2989d8 50%,#207cca 100%,#7db9e8 100%); /* IE10+ */
    background: linear-gradient(to bottom,  #1e5799 0%,#2989d8 50%,#207cca 100%,#7db9e8 100%); /* W3C */
    filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#1e5799', endColorstr='#7db9e8',GradientType=0 ); /* IE6-9 */

  }
  .textEffect
  {
    text-shadow: 5px 5px 5px #FF0000;
  }

  .transition
  {
    width:100px;
    height:50px;
    background:red;
    transition:width 1s;
    -webkit-transition:width 1s; /* Safari */
    margin-bottom: 5px;
  }

  .transition:hover
  {
    width:300px;
  }

  .animation
  {
    width:100px;
    height:100px;
    background:red;
    position:relative;
    animation:myfirst 5s;
    -webkit-animation:myfirst 5s; /* Safari and Chrome */
    margin: 10px;
  }

  @keyframes myfirst
  {
    0%   {background:red; left:0px; top:0px;}
    25%  {background:yellow; left:200px; top:0px;}
    50%  {background:blue; left:200px; top:200px;}
    75%  {background:green; left:0px; top:200px;}
    100% {background:red; left:0px; top:0px;}
  }

  @-webkit-keyframes myfirst /* Safari and Chrome */
  {
    0%   {background:red; left:0px; top:0px;}
    25%  {background:yellow; left:200px; top:0px;}
    50%  {background:blue; left:200px; top:200px;}
    75%  {background:green; left:0px; top:200px;}
    100% {background:red; left:0px; top:0px;}
  }
</style>
</head>
<body>

<?php

require_once __DIR__.'/../vendor/autoload.php'; 

$app = new Silex\Application();

$app['debug'] = true;
$app->register(new Silex\Provider\ServiceControllerServiceProvider());

$app->get('/', function() use($app) {
  return 'Hello';
});


/** Example GET Routes */
$friends = array(
  '123' => array(
    'name'      => 'Jules',
    'location'      => 'Munich'
  ),
  '323' => array(
    'name'      => 'Don',
    'location'      => 'Munich'
  ),
  '1443' => array(
    'name'      => 'Mike',
    'location'      => 'London'
  ),
  '1234456' => array(
    'name'      => 'Dude',
    'location'      => 'Paris'
  ),
);

$app->get('/names', function () use ($friends) {
  $output = '';
  foreach ($friends as $friend) {
    $output .= $friend['name'];
    $output .= '<br />';
  }

  return $output;
});

$app->get('/locations', function () use ($friends) {
  $output = '';
  foreach ($friends as $friend) {
    $output .= $friend['location'];
    $output .= '<br />';
  }

  return $output;
});

/** Dynamic Routing Example
 *
 * This route definition has a variable {id} part which is passed to the closure.
 * The current Application is automatically injected by Silex to the Closure thanks to the type hinting.
 */
$app->get('/id/{id}', function (Silex\Application $app, $id) use ($friends) {
  if (!isset($friends[$id])) {
    $app->abort(404, "Friend $id does not exist.");
  }

  $friend = $friends[$id];

  return  "<h1>{$friend['name']}</h1>".
    "<p>{$friend['location']}</p>";
});

/** CSS3 Examples */
$app->get('css3', function() {
  return <<< EOT
  <style>
    body
  {
    background: url("../image/lisa_simpson.png"), url("../image/mountain.jpg");
    background-size:50px 50px, 100% 100%;
    background-position: 410px 110px, 0px 0px;
    background-repeat:no-repeat;
  }
  </style>
<div class="roundedCorner">A few rounded corners... to get Lisa and this mountain we added multiple background urls</div>

<div class="gradient roundedCorner">Use this cool gradient builder: <a href="http://www.colorzilla.com/gradient-editor/">gradient editor</a></div>

<h1 class="textEffect">Crazy Text Effect</h1>

<div class="transition">CSS 3 Transition</div>
<div class="transition">Do another CSS 3 transition</div>
<div class="animation">Here is an animation using keyframes<img src="../image/lisa_simpson.png" /></div>
EOT;

});

/** Creatives Examples */
$app->get('getcreative', function() {
  return <<< EOT
<a href="http://www.creativebloq.com/design/examples-svg-7112785">Cool SVG examples</a><br/>
<a href="http://www.creativebloq.com/app-design/how-build-app-tutorials-12121473">Build mobile apps for designers</a><br/>
<a href="http://www.creativebloq.com/typography/free-graffiti-fonts-11121160">Graffiti Fonts</a><br/>
<a href="http://www.creativebloq.com/graphic-design/pro-guide-logo-design-21221">Think about logo design</a><br/>
<a href="http://www.creativebloq.com/typography/free-web-fonts-1131610">Some web fonts to use</a><br/>
<a href="http://www.creativebloq.com/graphic-design/flyer-templates-1131645">Cool flyers to make a great marketing campaign</a><br/>
EOT;

});

/** HTML5 Examples */
$app->get('html5', function() {
  return <<< EOT

<div>
<p>First I want to say that HTML5 is definitely pretty cool but not as useful for alot of sites as I had hoped.  The semantic elements like &lt;nav&gt; &lt;footer&gt; &lt;aside&gt; &lt;figure&gt; &lt;header&gt; are nice but if you really want to move towards semantics you have to go the AngularJS route.</p>

<p>The <b>Server Sent Events (SSE)</b> are also nice but it’s for broadcasting information like sports scores, weather, stock quotes etc.  But this really isn’t for real-time chat or messaging.</p>

<p>Next are the <b>form and form attributes</b>.  I’m really a fan of the date/time elements and the calendars they show and the color picker.  But the form validation is limited.  You really can’t get around custom validation for your business.  Granted it’s nice to have client side email and range validation as example, but really this still has to be checked on the server anyhow for those circumventing your JS.</p>

<p><b>Drag&Drop</b> is great but many times there is no practical use for it.</p>

<p>Moving on to <b>&lt;canvas&gt;</b> and SVG.  These are really nice if you’re doing a game but otherwise just the CSS3 animations and transformations will do.  Typically really cool graphics and done by designers using Adobe Illustrator and or Photoshop and not &lt;canvas&gt; / SVG plus JS.  So I think having a designer deliver really great graphics with basic animation from CSS3 is good enough for most sites.</p>

<p><b>App Cache</b> is great cause anything that speeds up the web is a good thing.</p>

<p><b>WebWorkers</b>… hmmm, nice but I don’t need to compute prime numbers without blocking the browser.  I need some more practical use cases to be convinced.</p>

<p><b>Geolocation and WebStorage</b> are probably the most useful additions.  I love showing a user a map of where they are and being able to watch there longitude and latitudinal changes (protip: use this with a good GPS device like your iPhone or Android).  WebStorage is fantastic for obvious reasons.</p>
</div>
<div>
<p>HTML 5 has some cool features like SVG, Drag&Drop and others.</p>
</div>
<a href="http://www.creativebloq.com/design/examples-svg-7112785">Cool SVG examples</a>
<br/>
<a href="http://raphaeljs.com/">RaphaelJS</a>
</div>

<p id="demo">Click the button to get your position:</p>
<button onclick="getLocation()">Try It</button>
<div id="mapholder"></div>
<script>
var x=document.getElementById("demo");
function getLocation()
  {
  if (navigator.geolocation)
    {
    navigator.geolocation.getCurrentPosition(showPosition,showError);
    }
  else{x.innerHTML="Geolocation is not supported by this browser.";}
  }

function showPosition(position)
  {
  var latlon=position.coords.latitude+","+position.coords.longitude;

  var img_url="http://maps.googleapis.com/maps/api/staticmap?center="
  +latlon+"&zoom=14&size=400x300&sensor=false";
  document.getElementById("mapholder").innerHTML="<img src='"+img_url+"'>";
  }

function showError(error)
  {
  switch(error.code)
    {
    case error.PERMISSION_DENIED:
      x.innerHTML="User denied the request for Geolocation."
      break;
    case error.POSITION_UNAVAILABLE:
      x.innerHTML="Location information is unavailable."
      break;
    case error.TIMEOUT:
      x.innerHTML="The request to get user location timed out."
      break;
    case error.UNKNOWN_ERROR:
      x.innerHTML="An unknown error occurred."
      break;
    }
  }
</script>


<p id="demo1">Click the button to get your coordinates:</p>
<button onclick="getLocation1()">Try It</button>
<script>
var x=document.getElementById("demo1");
function getLocation1()
  {
  if (navigator.geolocation)
    {
    navigator.geolocation.watchPosition(showPosition1);
    }
  else{x.innerHTML="Geolocation is not supported by this browser.";}
  }
function showPosition1(position)
  {
  x.innerHTML="Latitude: " + position.coords.latitude +
  "<br>Longitude: " + position.coords.longitude;
  }
</script>


<div>

<p>Could only find the ogg format for this example of HTML5 Video</p>
<video width="320" height="240" controls>
  <source src="http://download.blender.org/peach/trailer/trailer_400p.ogg" type="video/ogg">
Your browser does not support the video tag.
</video>
</div>

<div>
<h2>Data List</h2>
<form action="" method="get">

<input list="browsers" name="browser">
<datalist id="browsers">
  <option value="Internet Explorer">
  <option value="Firefox">
  <option value="Chrome">
  <option value="Opera">
  <option value="Safari">
</datalist>
</form>
</div>

<div class="example">
<h2>Form Attributes</h2>

<p>Now you no longer have to place all your input elements within the form element</p>
<pre><code>
&lt;form action="demo_form.asp" id="form1"&gt;
First name: &lt;input type="text" name="fname"&gt;
&lt;input type="submit" value="Submit"&gt;
&lt;/form&gt;

The "Last name" field below is outside the form element, but still part of the form.
Last name: &lt;input type="text" name="lname" form="form1"&gt;
</code></pre>

<form action="demo_form.asp" id="form1">
First name: <input type="text" name="fname"><br>
<input type="submit" value="Submit">
</form>

<p>The "Last name" field below is outside the form element, but still part of the form.</p>
Last name: <input type="text" name="lname" form="form1">
</div>

<div class="example">
<h2>You can specify the height and width of a submit button if it is an image</h2>
<pre><code>
&lt;form action="#"&gt;
  First name: &lt;input type="text" name="fname"&gt;
  Last name: &lt;input type="text" name="lname"&gt;
  &lt;input type="image" src="img_submit.gif" alt="Submit" width="48" height="48"&gt;
&lt;/form&gt;
</code></pre>
<form action="#">
  First name: <input type="text" name="fname"><br>
  Last name: <input type="text" name="lname"><br>
  <input type="image" src="http://www.w3schools.com/html/img_submit.gif" alt="Submit" width="48" height="48">
</form>
</div>

<div class="example">
<h2>Make an input field required</h2>
<pre>
Username: &lt;input type="text" name="usrname" required&gt;
</pre>
</div>

  <div class="example">
  <h2>Figure element</h2>
  <pre>
  &lt;figure&gt;
  &lt;img src="img_pulpit.jpg" alt="The Pulpit Rock" width="304" height="228"&gt;
  &lt;figcaption>Fig.1 - The Pulpit Rock, Norway.&lt;/figcaption&gt;
  &lt;/figure&gt;
  </pre>
  <figure>
  <img src="img_pulpit.jpg" alt="The Pulpit Rock" width="304" height="228">
  <figcaption>Fig.1 - The Pulpit Rock, Norway.</figcaption>
</figure>
  </div>


EOT;

});

$app->get('phpwebstorm', function () {
  return <<< EOT
  <h2>Live Templates</h2>
  <p>This allows you to use shortcuts for code chunks:
  <a href="http://blog.jetbrains.com/webide/2012/10/high-speed-coding-with-custom-live-templates/">Live Templates</a>
  </p>

EOT;


});


$app->run();

?>


</body>
</html>

