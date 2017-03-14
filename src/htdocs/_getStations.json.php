<?php

include_once '../conf/config.inc.php'; // app config
include_once '../lib/_functions.inc.php'; // app functions
include_once '../lib/classes/Db.class.php'; // db connector, queries

$db = new Db;

$now = date(DATE_RFC2822);
$set_dir = 'nca';
$today = date('Ymd');

$rsStations = $db->queryStations();

// Initialize array template for json feed
$output = [
  'generated' => $now,
  'count' => $rsStations->rowCount(),
  'type' => 'FeatureCollection',
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
  $path = "{$CONFIG['DATA_DIR']}/$set_dir";

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

    if (!file_exists("$path/$img")) { // neither plot available
      $img = '';
      $link = '';
    }
  }

  $feature = [
    'geometry' => [
      'coordinates' => [
        floatval($row['lon']),
        floatval($row['lat'])
      ],
      'type' => 'Point'
    ],
    'id' => intval($row['id']),
    'properties' => [
      'code' => $row['code'],
      'img' => $img,
      'link' => $link,
      'name' => $row['name'],
      'network' => $row['network'],
      'site' => $row['site'],
      'type' => $row['type']
    ],
    'type' => 'Feature'
  ];


  array_push ($output['features'], $feature);
}

// Send json stream to browser
showJson($output, $callback);
