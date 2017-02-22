/* global L, MOUNT_PATH */
'use strict';


var Xhr = require('util/Xhr');

// Leaflet plugins
require('leaflet-fullscreen');
require('leaflet.label');
require('map/MousePosition');
require('map/RestoreMap');

// Factories for creating map layers
require('map/DarkLayer');
require('map/GreyscaleLayer');
require('map/SatelliteLayer');
require('map/StationsLayer');
require('map/TerrainLayer');


/*
 * Factory for Leaflet map instance
 */
var IndexMap = function (options) {
  var _initialize,
      _this,

      _el,
      _stations,

      _addEvents,
      _getMapLayers,
      _initMap,
      _loadStationsLayer;

  _this = {};


  _initialize = function (options) {
    options = options || {};
    _el = options.el || document.createElement('div');

    // Load stations layer which calls initMap() when finished
    _loadStationsLayer();

    _addEvents();
  };


  /**
   * Attach handlers for map popups & labels to list of stations below the map
   */
  _addEvents = function () {
    var a, i, li, lis, newA, station,

        hideLabel,
        openPopup,
        showLabel;

    hideLabel = function (e) {
      _stations.hideLabel(e.target.station);
    };

    openPopup = function (e) {
      e.preventDefault();
      _stations.openPopup(e.target.station);
    };

    showLabel = function (e) {
      _stations.showLabel(e.target.station);
    };

    lis = document.querySelectorAll('.stations li');
    for (i = 0; i < lis.length; i ++) {
      li = lis[i];
      // get station name (ignore '*' that indicates high rms value)
      a = li.querySelector('a');
      station = a.textContent.match(/[\w\s-]+/);

      // add label events to station buttons
      a.station = station; // add station prop so it's accessible from event
      a.addEventListener('click', hideLabel);
      a.addEventListener('mouseout', hideLabel);
      a.addEventListener('mouseover', showLabel);

      // add popup icons to station buttons
      newA = document.createElement('a');
      newA.setAttribute('class', 'bubble');
      newA.setAttribute('href', '#');
      newA.setAttribute('title', 'View station popup');
      li.appendChild(newA);

      // add popup, label events to popup icons
      newA.station = station;
      newA.addEventListener('click', openPopup);
      newA.addEventListener('mouseout', hideLabel);
      newA.addEventListener('mouseover', showLabel);
    }
  };

  /**
   * Get all map layers that will be displayed on map
   *
   * @return layers {Object}
   *     {
   *       baseLayers: {Object}
   *       overlays: {Object}
   *       defaults: {Array}
   *     }
   */
  _getMapLayers = function () {
    var dark,
        greyscale,
        layers,
        satellite,
        terrain;

    dark = L.darkLayer();
    greyscale = L.greyscaleLayer();
    satellite = L.satelliteLayer();
    terrain = L.terrainLayer();

    layers = {};
    layers.baseLayers = {
      'Terrain': terrain,
      'Satellite': satellite,
      'Greyscale': greyscale,
      'Dark': dark
    };
    layers.overlays = {
      'Stations': _stations
    };
    layers.defaults = [terrain, _stations];

    return layers;
  };

  /**
   * Create Leaflet map instance
   */
  _initMap = function () {
    var bounds,
        layers,
        map;

    layers = _getMapLayers();

    // Create map
    map = L.map(_el, {
      layers: layers.defaults,
      scrollWheelZoom: false
    });

    // Set intial map extent to contain requested sites overlay
    bounds = _stations.getBounds();
    map.fitBounds(bounds);

    // Add controllers
    L.control.fullscreen({ pseudoFullscreen: true }).addTo(map);
    L.control.layers(layers.baseLayers, layers.overlays).addTo(map);
    L.control.mousePosition().addTo(map);
    L.control.scale().addTo(map);

    // Remember user's map settings (selected layers, map extent)
    map.restoreMap({
      baseLayers: layers.baseLayers,
      id: 'id',
      overlays: layers.overlays,
      scope: 'Helicorders',
      shareLayers: true
    });
  };

  /**
   * Load stations layer from geojson data via ajax
   */
  _loadStationsLayer = function () {
    Xhr.ajax({
      url: MOUNT_PATH + '/_getStations.json.php',
      success: function (data) {
        _stations = L.stationsLayer({
          data: data
        });
        _initMap();
      },
      error: function (status) {
        console.log(status);
      }
    });
  };


  _initialize(options);
  options = null;
  return _this;
};


module.exports = IndexMap;
