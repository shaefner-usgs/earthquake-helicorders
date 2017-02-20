<?php

include_once '../conf/config.inc.php'; // app config

if (!isset($TEMPLATE)) {
  $TITLE = 'Examples';
  $NAVIGATION = true;
  $HEAD = '<link rel="stylesheet" href="css/example.css" />';
  $FOOT = '';

  include 'template.inc.php';
}

?>

<h2>Foreshock - Main shock - Aftershock Sequence</h2>

<p>The three earthquakes shown below
  occurred at virtually the same location (8 km ENE of Watsonville) and within
  7 minutes of each other on May 9, 2000, as detailed in the table below.</p>

<table>
  <tr>
    <th>Time, PDT</th>
    <th>Magnitude</th>
    <th>Latitude</th>
    <th>Longitude</th>
    <th>Depth</th>
    <th>Designation</th>
  </tr>
  <tr>
    <td>00:59:06</td>
    <td>M=1.7</td>
    <td>36.939</td>
    <td>-121.679</td>
    <td>8</td>
    <td>Foreshock</td>
  </tr>
  <tr>
    <td>01:00:55</td>
    <td>M=3.3</td>
    <td>36.246</td>
    <td>-120.821</td>
    <td>8</td>
    <td>Main shock</td>
  </tr>
  <tr>
    <td>01:06:02</td>
    <td>M=2.9</td>
    <td>36.244 </td>
    <td>-120.829</td>
    <td>8</td>
    <td>Aftershock</td>
  </tr>
</table>

<p>The record from station HFP (Fremont Peak; 9 miles SW of Hollister, 18 miles
  SSE of Gilroy; 36.754, -121.492) is shown below. The closeness in time and location
  of these earthquakes to each other is no coincidence. Earthquakes &quot;interact&quot;,
  meaning that the stress changes produced by one earthquake can encourage others
  to occur nearby, thereby producing clusters of events. The most common form
  of cluster is the main shock and its aftershocks, the main shock being first
  and having the largest magnitude. When an earthquake (like the M=1.7 event here)
  triggers a larger earthquake (the M=3.3 event here), the first is called a &quot;foreshock&quot;.
</p>

<img src="img/Fore_main_aftershock.gif" alt="Helicorder display" />

<h2>Magnitude 1.9 Earthquake</h2>

<figure class="right" style="max-width: 400px;">
  <img src="img/CBR_2000042500.gif" alt="Helicorder for station CBR" />
  <img src="img/JSB_2000042500.gif" alt="Helicorder for station JSB" />
  <figcaption>
    <p>Seismogram recorded by <strong>CBR</strong>, the station closest
    to the earthquake (among those in our web page display) in Bollinger
    Canyon, 6 miles south of Walnut Creek and 10 miles north of Hayward and from
    station <strong>JSB</strong>, located across San Francisco
    Bay on San Bruno Mountain.</p>
  </figcaption>
</figure>

<p>Here we see one earthquake recorded on two stations. The earthquake occurred
        at 19:44 PDT April 24 (02:44 UTC, April 25), 2000, 6 km northeast of Danville,
      Calif, at a depth of 7 km (red dot on map). The magnitude is 1.9. </p>
<img src="img/SF_Bay.1.gif" alt="Map" />

<h2 class="clear">Magnitude 3.1 Earthquake</h2>

<p>Three earthquakes,
  the largest having a magnitude of 3.1, occurred within two hours
  of each other on May 7, 2000, as detailed in the table below.</p>

<table class="tabular">
  <tr>
    <th>Time, PDT</th>
    <th>Magnitude</th>
    <th>Latitude</th>
    <th>Longitude</th>
    <th>Depth</th>
    <th>Approximate Locaton</th>
    <th>Distance to HFP</th>
    <th>Distance to BBG</th>
  </tr>
  <tr>
    <td>08:05</td>
    <td>M=2.1</td>
    <td>36.866</td>
    <td>-121.597</td>
    <td>6.3 km</td>
    <td>Near San Juan Bautista</td>
    <td>16 km</td>
    <td>60 km</td>
  </tr>
  <tr>
    <td>08:50</td>
    <td>M=2.7</td>
    <td>36.246</td>
    <td>-120.821</td>
    <td>6.4 km</td>
    <td>Near New Idria</td>
    <td>82 km</td>
    <td>42 km</td>
  </tr>
  <tr>
    <td>09:50</td>
    <td>M=3.1</td>
    <td>36.244 </td>
    <td>-120.829</td>
    <td>6.0 km</td>
    <td>Near New Idria</td>
    <td>82 km</td>
    <td>42 km</td>
  </tr>
</table>

<figure class="left">
  <img src="img/M3.1_example.gif" alt="Helicorder display" />
  <figcaption>
    <p>Seismograms from two stations, HFP (Fremont Peak; 9 miles SW of Hollister,
      18 miles SSE of Gilroy) and BBG (Big Mountain; 7 miles ENE of Pinnacles, 26
      miles N of King City) captured all three events. The New Idria events are closer
      to BBG than HFP, while the San Juan Bautista event is closer to HFP than to
      BBG.</p>
    <p>These distance relationships can be seen in two ways. First, the New Idria
      events registered higher amplitudes at BBG than at HFP, while the San Juan Bautista
      event had higher amplitudes at HFP than at BBG. Secondly, if you look closely
      you will see that the first waves from the San Juan Bautista event arrive slightly
      earlier at HFP than at BBG. Conversely, the first waves from the New Idria events
      arrived at BBG first.</p>
  </figcaption>
</figure>

<h2 class="clear">Magnitude 4.0 Earthquake</h2>

<p>Epicenter near near Cloverdale, CA on January 10, 2000</p>
<img src="img/CSU1_VDZ_2000011000.gif" alt="Helicorder display" />

<h2>Magnitude 5.6 Earthquake</h2>

<p>Epicenter near near Punta Gorda, CA on March 16, 2000</p>
<img src="img/CBR_VDZ_2000031600.gif" alt="Helicorder display">

<h2>Teleseisms</h2>

<p>A <strong>teleseism</strong> is a record of an earthquake made by a seismograph at a great distance.</p>
<p>On April 23, 2000, a magnitude 6.9 (Mw) earthquake occurred at 09:27:23.1 (UTC) approximately 600
  km below Santiago del Estero Province, Argentina (<strong>1</strong>). The fastest-traveling
  seismic waves (P-waves) traveled through the earth's mantle and arrived at station PMM
  (located near Parkfield, California) about 11 minutes later, at 09:38:55 UTC
  (<strong>2</strong>). The slower-traveling S-waves also travelled through the mantle,
  and reached Parkfield 21 minutes after the earthquake occurred (<strong>3</strong>). The
  signal arriving at 08:49 (green trace) is from a M=3.4 earthquake (origin time
  08:48:39) in southern California, approximately 200 km ESE of this station.
  The signal at 10:07 (black trace) is an unidentified later arrival from
  the Argentina event.</p>
<p>A second earthquake under Argentina, magnitude 7.0
  (Mw), occurred May 12, 2000, at 18:43:20.2 (UTC), 240 km below Jujuy
  Province. <a href="img/teleseism_PMM2.gif">The record from this earthquake</a>,
  again at station PMM, is similar to that from the April 23rd event because
  the events occurred in roughly the same area and are both relatively deep. </p>
<img src="img/teleseis.PMM.2000042300.gif" alt="Helicorder display" />

<h2>Clipped Records</h2>

<figure class="right">
  <img src="img/ClipMap2.gif" alt="Map" />
</figure>
<p>Clipping occurs when the amount of ground motion exceeds the range that can be recorded by
  an instrument.</p>
<p>Most of the instruments in the Northern California Seismic
  Network use analog electronics capable of recording only a limited range
  of ground motion. Gradually, they are being replaced with more modern,
  digital electronics with a larger dynamic recording range. </p>
<p>Here we see one earthquake (yellow square) recorded on two stations
  (red dots), both 45 km away. The earthquake (magnitude = 3.5) occurred
  at 04:48 PDT June 13 (11:48 UTC, June 13), 2000, 19 km east of San Jose,
  Calif, at a depth of 8 km on the Calaveras fault. These two stations use
  identical sensors, but one uses analog electronics, the other digital.
</p>

<div class="container">
  <figure>
    <img src="img/JJR_2000061300.gif" alt="Helicorder for station JSF" />
    <figcaption>Seismogram from an older station (<strong>JJR</strong>), equipped
      with analog electronics having with a limited dynamic range. The record's
      amplitude is limited by the electronics.</figcaption>
  </figure>
  <figure>
    <img src="img/JSF_2000061300.gif" alt="Helicorder for station JJR" />
    <figcaption>Seismogram recorded by a newer station (<strong>JSF</strong>)
      equipped with modern digital electronics. You can see the full range of
      the earthquake ground motion is recorded here.</figcaption>
  </figure>
</div>

<h2>Quarry Blast</h2>

<p>The seismogram below is a portion of the daily record for August 14, 2000 from
  Fremont Peak station HFP. The prominent signature shortly after 20:18:22 UTC
  has many of the characteristics of a small nearby earthquake.
  It has, for instance, an abrupt onset and an exponential decay indicative of an
  earthquake having a duration magnitude of 1.7. Based upon it's magnitude
  (&lt;2.0), location (within a km of a known quarry location),
  and time (mid-day is a common time for quarry blasts), however, this event is
  probably a quarry blast from a quarry near Natividad, CA.</p>

<img src="img/quarry.blast.gif" alt="Helicorder display" />

<h2>High Winds</h2>

<p>The seismogram below documents a windy night at Geyser Peak station (GGP).</a>
  From about 22:30 PDT on April 24 to 02:25 on April 25, the wind blew
  hard in coastal central California as a weather front passed through. Wind can
  produce low-amplitude seismic waves or &quot;microseisms&quot; in the earth
  through the action of trees, which transfer wind-generated forces into the ground
  through their roots. (Ocean waves also generate microseisms by the pounding
  of the surf.) Here, the wind-generated noise appears as an increase in the amplitude
  of the smallest background motions detected by this seismometer. Also, two small
  earthquakes are visible at 22:04 and 22:06, PDT. </p>

<img src="img/GeyserPeakWindstorm.gif" alt="Helicorder display" />

<h2>Calibration Pulse</h2>

<figure class="right">
  <img src="img/calibration.gif" alt="Helicorder display" />
</figure>

<p>Many of the
  seismometers in our network are of the magnet-coil-spring type. This type of
  instrument consists of a permanent magnet and a coil of wire. The coil, which
  is wound around a rather massive core, is suspended by a spring. When the ground
  moves, the coil tends to remain in place due to its mass, while the magnet,
  which is rigidly attached to the seismometer housing, moves relative to the
  coil. The relative motion produces a current in the coil, and it is this electrical
  signal that ends up being recorded as a seismogram. </p>
<p>The mechanical response of the magnet, springs and coil, as well as the electronics
  that amplifies the current, all affect the final signal. If the springs weaken
  or the electronics drifts, for example, the seismogram will not be accurate.
  Since these seismometers are located all over northern California, it is not
  practical to visit each one to check its performance.</p>
<p>Instead, the seismometer is programmed to check itself. Once a day, the electronics
  in the seismometer sends a controlled current through the coil. The response
  of the magnet-spring-coil system to this test signal is sent back as a <b>calibration
  pulse</b>. These pulses can be measured at the central recording site in Menlo
  Park, California, to assure that each seismometer is functioning properly. </p>
