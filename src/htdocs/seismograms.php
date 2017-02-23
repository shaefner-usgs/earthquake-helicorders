<?php

date_default_timezone_set('America/Los_Angeles');

include_once '../conf/config.inc.php'; // app config
include_once '../lib/_functions.inc.php'; // app functions
include_once '../lib/classes/Db.class.php'; // db connector, queries

$db = new Db;

$date = safeParam('date');
$id = safeParam('id');

// 'hardwire' for now
$set = 'nca';

if (!isset($TEMPLATE)) {
  $TITLE = 'Real-time Seismogram Displays';
  $NAVIGATION = true;
  $HEAD = '<link rel="stylesheet" href="css/seismograms.css" />';
  $FOOT = '';

  include 'template.inc.php';
}

// Query db to get station details
$rsStation = $db->queryStation($id);

// If station found, set subtitle; otherwise, show error
$row = $rsStation->fetch(PDO::FETCH_ASSOC);
if ($row) {
  $instrument = $row['site'] . ' ' . $row['type'] . ' ' . $row['network'] .
    ' ' . $row['code'];
  $subtitle = $instrument . ' (' . trim($row['name']) . ')';
} else {
  print '<p class="alert info">Station Not Found</p>';
  return;
}

$listHtml = '<ul class="stations no-style">';

// loop thru past 15 days, plus latest
for ($i = -1; $i < 15; $i ++) {
  if ($i === -1) { // latest
    $date = '22221212';
    $imgTitle = 'Past 24 hours';
    $path = 'latest';
  } else {
    $date = date('Ymd', strtotime('-' . $i . ' day'));
    $imgTitle = date('M j, Y', strtotime($date));
    $path = $date;
  }

  $file = sprintf('%s/tn-nc.%s_00.%d00.gif',
    $set,
    str_replace(' ', '_', $instrument),
    $date
  );

  // if no image, display 'no data' msg
  if (file_exists($CONFIG['DATA_DIR'] . '/' . $file)) {
    $img = sprintf('<a href="%d/%s">
        <img src="data/%s" alt="seismogram thumbnail" />
      </a>',
      $id,
      $path,
      $file
    );
  } else {
    $img = '<p>No data available</p>';
  }

  $listHtml .= "<li><h3>$imgTitle</h3>$img</li>";
}

$listHtml .= '</ul>';

?>

<h2><?php print $subtitle; ?></h2>

<?php print $listHtml; ?>
