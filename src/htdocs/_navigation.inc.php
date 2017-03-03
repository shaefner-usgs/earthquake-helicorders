<?php

$section = $CONFIG['MOUNT_PATH'];
$url = $_SERVER['REQUEST_URI'];

$matches_index = false;
if (preg_match("@^$section(/index.php)?/?(\d+)?/?(latest|\d+)?$@", $url)) {
  $matches_index = true;
}

$NAVIGATION =
  navGroup('Seismogram Displays',
    navItem("$section", 'Seismograms', $matches_index) .
    navItem("$section/about.php", 'About the Seismograms') .
    navItem("$section/examples.php", 'Examples') .
    navItem("/monitoring/spectrograms", 'Spectrogram Displays')
  );

print $NAVIGATION;
