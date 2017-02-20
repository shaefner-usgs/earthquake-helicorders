'use strict';

var config = require('./config'),
    fs = require('fs'),
    packageJson;

// read package.json
packageJson = JSON.parse(fs.readFileSync('package.json'));


var copy = {

  build: {
    expand: true,
    cwd: config.src,
    dest: config.build + '/' + config.src,
    src: [
      '**/*',
      '!**/*.js',
      '!**/*.scss',
      '!**/*.orig'
    ],
    filter: 'isFile',
    options: {
      mode: true,
      noProcess: ['**/*.{gif,ico,jpg,png,tif,pdf,mp4,kmz,gz,zip}'],
      process: function (content/*, srcpath*/) {
        // replace {{VERSION}} in php/html with version from package.json
        return content.replace('{{VERSION}}', packageJson.version);
      }
    }
  },

  /*test: {
    expand: true,
    cwd: config.test,
    dest: config.build + '/' + config.test,
    src: [*/
//      '**/*',
//      '!**/*.js'
/*    ],
    filter: 'isFile'
  },*/

  dist: {
    expand: true,
    cwd: config.build + '/' + config.src,
    dest: config.dist,
    src: [
      '**/*',
      '!**/*.js',
      '!**/*.css'
    ],
    filter: 'isFile',
    options: {
      mode: true
    }
  },

  leaflet: {
    expand: true,
    cwd: 'node_modules/leaflet/dist',
    dest: config.build + '/' + config.src + '/htdocs/lib/leaflet-0.7.7',
    rename: function (dest, src) {
      var newName;

      // swap -src version to be default and add -min to compressed version
      // this is nice for debugging but allows production to use default
      // version as compressed
      newName = src.replace('leaflet.js', 'leaflet-min.js');
      newName = newName.replace('leaflet-src.js', 'leaflet.js');

      return dest + '/' + newName;
    },
    src: [
      '**/*'
    ]
  },

  leaflet_fullscreen: {
    cwd: 'node_modules/leaflet-fullscreen/dist',
    dest: config.build + '/' + config.src + '/htdocs/img',
    expand: true,
    src: [
      '*.png'
    ]
  }

};


module.exports = copy;
