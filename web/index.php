<?php

require_once __DIR__.'/../vendor/autoload.php'; 

$app = new Silex\Application();

$app['debug'] = true;
$app->register(new Silex\Provider\ServiceControllerServiceProvider());

$app->get('/', function() use($app) {
  return 'Hello';
});


/** Example GET Route */
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

$app->run();

?>

<style>
  body
  {
    background: url("../image/lisa_simpson.png"), url("../image/mountain.jpg");
    background-size:50px 50px, 100% 100%;
    background-position: 410px 110px, 0px 0px;
    background-repeat:no-repeat;
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

<div class="roundedCorner">A few rounded corners... to get Lisa and this mountain we added multiple background urls</div>

<div class="gradient roundedCorner">Use this cool gradient builder: <a href="http://www.colorzilla.com/gradient-editor/">gradient editor</a></div>

<h1 class="textEffect">Crazy Text Effect</h1>

<div class="transition">CSS 3 Transition</div>
<div class="transition">Do another CSS 3 transition</div>
<div class="animation">Here is an animation using keyframes<img src="../image/lisa_simpson.png" /></div>


</body>
