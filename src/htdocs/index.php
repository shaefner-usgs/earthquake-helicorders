<?php

include_once '../conf/config.inc.php'; // app config
include_once '../lib/_functions.inc.php'; // app functions

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

  // importJsonToArray() sets headers -> needs to run before including template
  $stations = importJsonToArray(__DIR__ . '/_getStations.json.php');

  include 'template.inc.php';
}

$height = ceil($stations['count'] / 4) * 32;
$stationsHtml = '<ul class="stations no-style" style="height: '. $height . 'px;">';

foreach ($stations['features'] as $feature) {
  $props = $feature['properties'];
  $name = $props['site'] . ' ' . $props['type'] . ' ' . $props['network'] .
    ' ' . $props['code'];

  $stationsHtml .= sprintf('<li>
      <a href="helicorders/%s/latest" title="View station">%s</a>
    </li>',
    $feature['id'],
    $name
  );
}

$stationsHtml .= '</ul>';

?>

<p>These seismogram displays depict ground motion recorded by seismograph
  stations in real-time, updated every few minutes. Each plot represents 24
  hours of data from one station. <a href="/monitoring/helicorders/about.php">Read
  more</a> &raquo;</p>

<div class="map"></div>

<h3 class="count">
  <?php print $stations['count']; ?> stations on this map
</h3>

<?php print $stationsHtml; ?>

<p>View <a href="helicorders/latest">seismograms for all stations</a> &raquo;</p>
