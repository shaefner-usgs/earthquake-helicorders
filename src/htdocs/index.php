<?php

include_once '../conf/config.inc.php'; // app config

if (!isset($TEMPLATE)) {
  $TITLE = 'Real-time Seismogram Displays';
  $NAVIGATION = true;
  $HEAD = '
    <link rel="stylesheet" href="/lib/leaflet-0.7.7/leaflet.css" />
    <link rel="stylesheet" href="helicorders/css/index.css" />
  ';
  $FOOT = '
    <script>
      var MOUNT_PATH = "' . $CONFIG['MOUNT_PATH'] . '",
          SET = "nca";
    </script>
    <script src="/lib/leaflet-0.7.7/leaflet.js"></script>
    <script src="helicorders/js/index.js"></script>
  ';


  include 'template.inc.php';
}

?>

<p>These seismogram displays depict ground motion recorded by seismograph
  stations in real-time, updated every few minutes. Each plot represents 24
  hours of data from one station. <a href="/monitoring/helicorders/about.php">Read
  more</a> &raquo;</p>

<div class="map"></div>

<h3 class="count"></h3>
