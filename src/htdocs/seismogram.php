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

// If station found, create station name; otherwise, show error
$row = $rsStation->fetch(PDO::FETCH_ASSOC);
if ($row) {
  $instrument = $row['site'] . ' ' . $row['type'] . ' ' . $row['network'] .
    ' ' . $row['code'];
  $subtitle = $instrument . ' (' . trim($row['name']) . ')';
} else {
  print '<p class="alert info">Station not found</p>';
  return;
}

// Create components for header (date, navigation)
$imgHeader = date('D M j, Y', strtotime($date));
$nextHref = date('Ymd', strtotime('+1 day', strtotime($date)));
$nextLink = '';
$prevHref = date('Ymd', strtotime('-1 day', strtotime($date)));
$prevLink = '';

$cutoffDate = date('Ymd', strtotime('-14 days'));
$today = date('Ymd');

if ($date === 'latest') {
  $date = '22221212'; // 'latest' plots use this date string
  $imgHeader = 'Past 24 hours';
  $nextHref = '';
  $prevHref = date('Ymd', strtotime($today));
} else if ($date === $cutoffDate) {
  $prevHref = '';
} else if ($date === $today) {
  $nextHref = 'latest';
}
if ($nextHref) {
  $nextLink = '<a href="' . $nextHref . '" class="next">Next<i
    class="material-icons">&#xE5CC;</i></a>';
}
if ($prevHref) {
  $prevLink = '<a href="' . $prevHref . '" class="prev"><i
    class="material-icons">&#xE5CB;</i> Prev</a>';
}

// Seismogram plot
$file = sprintf('%s/nc.%s_00.%s00.gif',
  $set,
  str_replace(' ', '_', $instrument),
  $date
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
  <h3><?php print $imgHeader; ?></h3>
  <ul class="no-style">
    <li><?php print $prevLink; ?></li>
    <li><?php print $nextLink; ?></li>
  </ul>
</header>

<?php print $img; ?>

<p class="back">&laquo; <?php print $backLink;?></p>
