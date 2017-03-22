<?php

include_once '../conf/config.inc.php'; // app config
include_once '../lib/_functions.inc.php'; // app functions
include_once '../lib/classes/Db.class.php'; // db connector, queries

// Don't cache
$now = date(DATE_RFC2822);
header('Cache-control: no-cache, must-revalidate');
header("Expires: $now");

$db = new Db;

$rsStations = $db->queryStations();
$set = 'nca';
$today = date('Ymd');

// Initialize array template for json feed
$output = [
  'type' => 'FeatureCollection',
  'metadata' => [
    'generated' => $now,
    'count' => $rsStations->rowCount(),
    'title' => 'Earthquake Science Center Helicorders',
    'url' => 'https://earthquake.usgs.gov' . $_SERVER['PHP_SELF']
  ],
  'features' => []
];

while ($row = $rsStations->fetch(PDO::FETCH_ASSOC)) {
  $img = sprintf('tn-nc.%s_%s_%s_%s_00.2222121200.gif',
    $row['site'],
    $row['type'],
    $row['network'],
    $row['code']
  );
  $link = 'latest';
  $path = "{$CONFIG['DATA_DIR']}/$set";

  // Look for today's plot if 'latest' not available
  if (!file_exists("$path/$img")) {
    $img = sprintf('tn-nc.%s_%s_%s_%s_00.%s00.gif',
      $row['site'],
      $row['type'],
      $row['network'],
      $row['code'],
      $today
    );
    $link = $today;

    // Set img / link to empty strings if neither plot is available
    if (!file_exists("$path/$img")) {
      $img = '';
      $link = '';
    }
  }

  $feature = [
    'type' => 'Feature',
    'id' => intval($row['id']),
    'geometry' => [
      'coordinates' => [
        floatval($row['lon']),
        floatval($row['lat'])
      ],
      'type' => 'Point'
    ],
    'properties' => [
      'code' => trim($row['code']),
      'img' => $img,
      'link' => $link,
      'name' => trim($row['name']),
      'network' => trim($row['network']),
      'site' => trim($row['site']),
      'type' => trim($row['type'])
    ]
  ];

  array_push ($output['features'], $feature);
}

// Send json stream to browser
showJson($output, $callback);
