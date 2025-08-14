/**
 * @file
 * Provides Splidebox AJAX.
 */

(function ($, Drupal, _ds) {

  'use strict';

  var ID_ONCE = 'sboxAjax';
  var C_AJAX = 'is-sbox-ajax';
  var S_AJAX = '.' + C_AJAX;

  var SplideboxAjax = function (Splide, Components) {
    var root = Splide.root;

    // @todo refactor or remove post #3031444, #3026636.
    function process(el) {
      var base = el.id;
      var href = el.href;
      var opts = {
        base: base,
        element: el,
        wrapper: base
      };

      if (href) {
        opts.url = href;
        opts.event = 'click';

        Drupal.ajax(opts);
      }
    }

    function onVisible(slide) {
      var el = $.find(slide.slide, S_AJAX);
      if ($.isElm(el)) {

        el.click();
        // @todo use post #3031444, #3026636.
        // $.trigger(el, 'mousedown');
        $.addClass(el, C_AJAX + '-hit');
      }
    }

    return {
      mount: function () {

        Splide.on('visible.sba', onVisible);

        $.once(process, ID_ONCE, S_AJAX, root);

        // @todo remove post #3031444, #3026636.
        $.on(root, 'click', S_AJAX, function (e) {
          e.preventDefault();
          e.stopPropagation();
        }, false);
      }

    };
  };

  _ds.extend({
    SplideboxAjax: SplideboxAjax
  });

})(dBlazy, Drupal, dSplide);
