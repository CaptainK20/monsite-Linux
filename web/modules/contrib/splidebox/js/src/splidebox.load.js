/**
 * @file
 * Provides Splidebox loader.
 */

(function ($, Drupal, drupalSettings, _ds, _win) {

  'use strict';

  var ID = 'splidebox';
  var ID_ONCE = ID;
  var C_MOUNTED = 'is-' + ID + '-mounted';
  var DATA_ID = 'data-' + ID;
  var S_GALLERY = '[' + DATA_ID + '-gallery]:not(.' + C_MOUNTED + ')';
  var S_TRIGGER = '[' + DATA_ID + '-trigger]';
  var SETTINGS = drupalSettings.splidebox || {};
  var BOXSETTINGS = SETTINGS.lightbox || {};
  var SPLIDESETTINGS = SETTINGS.splide || {};

  /**
   * Splidebox utility functions.
   *
   * @param {HTMLElement} elm
   *   The Splidebox gallery HTML element.
   */
  function process(elm) {

    // Initializes splide.
    function init(el, options) {
      var splide;
      Drupal.detachBehaviors(el);

      _ds.options = $.extend({}, _ds.options, options || {});
      splide = _ds.init(el);

      _win.setTimeout(function () {
        Drupal.attachBehaviors(el);
      });
      return splide;
    }

    var dataAttr = $.attr(elm, 'data-splidebox');
    if (dataAttr) {
      SPLIDESETTINGS = $.extend({}, SPLIDESETTINGS, $.parse(dataAttr));
    }

    var options = {
      template: SETTINGS.template || '',
      trigger: S_TRIGGER,
      dataSplide: SPLIDESETTINGS,
      fsIconOn: _ds.fsIconOn,
      init: init
    };

    // Build Splidebox gallery.
    options = $.extend({}, BOXSETTINGS, options);
    _win.setTimeout(function () {
      Splidebox.init(elm, options);
    });

    $.addClass(elm, C_MOUNTED);
  }

  /**
   * Attaches Splidebox gallery behavior to HTML element.
   *
   * @type {Drupal~behavior}
   */
  Drupal.behaviors.splidebox = {
    attach: function (context) {
      $.once(process, ID_ONCE, S_GALLERY, context);
    },
    detach: function (context, setting, trigger) {
      if (trigger === 'unload') {
        $.once.removeSafely(ID_ONCE, S_GALLERY, context);
      }
    }
  };

})(dBlazy, Drupal, drupalSettings, dSplide, this);
