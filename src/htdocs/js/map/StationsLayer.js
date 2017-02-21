/* global L, MOUNT_PATH, SET */
'use strict';


var Util = require('util/Util');

require('leaflet.label');


var _DEFAULTS,
    _OVERLAY_DEFAULTS;

_OVERLAY_DEFAULTS = {
  color: '#c00',
  fillColor: '#c00',
  fillOpacity: 0.3,
  opacity: 0.7,
  radius: 8,
  weight: 1
};
_DEFAULTS = {
  data: {},
  overlayOptions: _OVERLAY_DEFAULTS
};

/**
 * Factory for Stations overlay
 *
 * @param options {Object}
 *     {
 *       data: {String} Geojson data
 *     }
 *
 * @return {L.FeatureGroup}
 */
var StationsLayer = function (options) {
  var _initialize,
      _this,

      _overlayOptions,

      _onEachFeature,
      _pointToLayer,
      _showCount;


  _this = {};

  _initialize = function (options) {
    options = Util.extend({}, _DEFAULTS, options);

    _overlayOptions = Util.extend({}, _OVERLAY_DEFAULTS, options.overlayOptions);

    _showCount(options.data.count);

    _this = L.geoJson(options.data, {
      onEachFeature: _onEachFeature,
      pointToLayer: _pointToLayer
    });
  };

  /**
   * Leaflet GeoJSON option: called on each created feature layer. Useful for
   * attaching events and popups to features.
   *
   * @param feature {Object}
   * @param layer (L.Layer)
   */
  _onEachFeature = function (feature, layer) {
    var data,
        file,
        img,
        imgLink,
        imgSrc,
        props,
        name,
        popup,
        popupTemplate;

    props = feature.properties;
    name = props.site + ' ' + props.type + ' ' + props.network + ' ' +
      props.code;

    //img = '<p class="nodata">No data available</p>'; // default
    file = 'tn-nc.' + name.replace(/ /g, '_') + '_00.2222121200.gif'; // latest
    imgLink = MOUNT_PATH + '/' + feature.id + '/latest';
    imgSrc = MOUNT_PATH + '/data/' + SET + '/' + file;
    img = '<a href="' + imgLink + '"><img src="' + imgSrc + '" /></a>';

    data = {
      description: props.name,
      img: img,
      link: MOUNT_PATH + '/' + feature.id,
      name: name
    };

    popupTemplate = '<div class="popup">' +
        '<h2>{name}</h2>' +
        '<p>{description}</p>' +
        '<h3>Latest Data</h3>' +
        '{img}' +
        '<h3>Archives</h3>' +
        '<p><a href="{link}">Past 15 days</a></p>' +
      '</div>';
    popup = L.Util.template(popupTemplate, data);

    layer.bindPopup(popup, {
      autoPanPadding: L.point(50, 10)
    }).bindLabel(name);
  };

  /**
   * Leaflet GeoJSON option: used for creating layers for GeoJSON points
   *
   * @param feature {Object}
   * @param latlng {L.LatLng}
   *
   * @return marker {L.CircleMarker}
   */
  _pointToLayer = function (feature, latlng) {
    return L.circleMarker(latlng, _overlayOptions);
  };

  /**
   * Show station count on web page
   *
   * @param count {Integer}
   */
  _showCount = function (count) {
    var el;

    el = document.querySelector('.count');
    el.innerHTML = count + ' stations on this map';
  };

  _initialize(options);
  options = null;
  return _this;
};


L.stationsLayer = StationsLayer;

module.exports = StationsLayer;
