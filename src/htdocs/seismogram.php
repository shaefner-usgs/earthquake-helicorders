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
  $HEAD = '<link rel="stylesheet" href="../css/seismogram.css" />';
  $FOOT = '';

  include 'template.inc.php';
}

// Query db to get station details
$rsStation = $db->queryStation($id);

// If station found, create instrument name; otherwise, show error
$row = $rsStation->fetch(PDO::FETCH_ASSOC);
if ($row) {
  $instrument = $row['site'] . ' ' . $row['type'] . ' ' . $row['network'] .
    ' ' . $row['code'];
  $subtitle = $instrument . ' (' . trim($row['name']) . ')';
} else {
  print '<p class="alert info">Station not found</p>';
  return;
}

$header = getHeaderComponents($date);

// Seismogram plot
$imgDateStr = $date;
if ($date === 'latest') {
  $imgDateStr = '22221212'; // 'latest' plots use this date string
}
$file = sprintf('%s/nc.%s_00.%s00.gif',
  $set,
  str_replace(' ', '_', $instrument),
  $imgDateStr
);

// if no image, display 'no data' msg
if (file_exists($CONFIG['DATA_DIR'] . '/' . $file)) {
  $img = '<img src="../data/' . $file . '" alt="seismogram thumbnail" />';
} else {
  $img = '<p class="alert info">No data available</p>';
}

$backLink = '<a href="../' . $id . '">Back to station ' . $instrument . '</a>';

?>

<h2><?php print $subtitle; ?></h2>

<header>
  <h3><?php print $header['title']; ?></h3>
  <ul class="no-style">
    <li><?php print $header['prevLink']; ?></li>
    <li><?php print $header['nextLink']; ?></li>
  </ul>
</header>

<?php print $img; ?>

<p>View <a href="../<?php print $date; ?>">seismograms for all stations</a> &raquo;</p>

<p class="back">&laquo; <?php print $backLink;?></p>
