<?php

$section = $CONFIG['MOUNT_PATH'];
$url = $_SERVER['REQUEST_URI'];

$matches_index = false;
if (preg_match("@^$section(/index.php)?$@", $url)) {
  $matches_index = true;
}

$NAVIGATION =
  navGroup('Seismogram Displays',
    navItem("$section", 'Seismograms', $matches_index) .
    navItem("$section/examples.php", 'Examples') .
    navItem("$section/about.php", 'About the Seismograms') .
    navItem("/monitoring/spectrograms/", 'Spectrogram Displays')
  );

print $NAVIGATION;
