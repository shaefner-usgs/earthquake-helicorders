/* global L */
'use strict';


// Leaflet plugins
require('leaflet-fullscreen');
require('leaflet.label');
require('map/MousePosition');
require('map/RestoreMap');

// Factories for creating map layers
require('map/DarkLayer');
require('map/GreyscaleLayer');
require('map/SatelliteLayer');
require('map/TerrainLayer');


/*
 * Factory for Leaflet map instance
 */
var IndexMap = function (options) {
  var _initialize,
      _this,

      _el,

      _addMarker,
      _getMapLayers,
      _initMap;

  _this = {};


  _initialize = function (options) {
    options = options || {};
    _el = options.el || document.createElement('div');

    _initMap();
  };

  _addMarker = function (map) {
    var marker;

    marker = L.marker([37.78, -122.45]).bindLabel('label');
    marker.addTo(map);
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

    };
    layers.defaults = [terrain];

    return layers;
  };

  /**
   * Create Leaflet map instance
   */
  _initMap = function () {
    var layers,
        map;

    layers = _getMapLayers();

    // Create map
    map = L.map(_el, {
      center: [38, -123],
      zoom: 7,
      layers: layers.defaults,
      scrollWheelZoom: false
    });

    _addMarker(map);

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
      scope: 'appName',
      shareLayers: true
    });
  };

  _initialize(options);
  options = null;
  return _this;
};


module.exports = IndexMap;
