/**
 * @file
 * Provides Splidebox, splide within lightbox.
 */

/* global define, module */
(function (root, factory) {

  'use strict';

  var ns = 'Splidebox';
  var db = root.dBlazy;

  // Inspired by https://github.com/addyosmani/memoize.js/blob/master/memoize.js
  if (typeof define === 'function' && define.amd) {
    // AMD. Register as an anonymous module.
    define([ns, db, Drupal, root], factory);
  }
  else if (typeof exports === 'object') {
    // Node. Does not work with strict CommonJS, but only CommonJS-like
    // environments that support module.exports, like Node.
    module.exports = factory(ns, db, Drupal, root);
  }
  else {
    // Browser globals (root is window).
    root[ns] = factory(ns, db, Drupal, root);
  }

}((this || module || {}), function (ns, $, Drupal, _win) {

  'use strict';

  var DOC = document;
  var BASE = 'splide';
  var S_BASE = '.' + BASE;
  var NAME = BASE + 'box';
  var NICK = 'sbox';
  var ARIA_HIDDEN = 'aria-hidden';
  var V_PLAYABLE = 'playable';
  var IS_NICK = 'is-' + NICK;
  var IS_MOUNTED = IS_NICK + '-mounted';
  var IS_MOUNTING = IS_NICK + '-mounting';
  var IS_LOADING = 'is-b-loading is-b-visible';
  var IS_PLAYING = IS_NICK + '-playing';
  var IS_ACTIVE = IS_NICK + '-active';
  var IS_UMOUNTING = IS_NICK + '-umounting';
  var IS_FULLSCREEN = IS_NICK + '-fullscreen';
  var IS_PAGINATED = IS_NICK + '-paginated';
  var IS_MOVED = IS_NICK + '-moved';
  var IS_ZOOMABLE = 'is-zoomable';
  var IS_CENTERED = 'is-centered';
  var C_IS_PLAYABLE = IS_NICK + '-' + V_PLAYABLE;
  var C_IS_VISIBLE = IS_NICK + '-visible';
  var C_IS_CAPTIONED = 'is-captioned'; // @todo rename it: IS_NICK + '-captioned';
  var C_IS_AJAXED = IS_NICK + '-ajaxed';
  var C_VISUALLY_HIDDEN = 'visually-hidden';
  var IS_INITIAL = false;
  var S_SPLIDE_LIST = '.' + BASE + '__list';
  var S_DRAG_OBJ = '.' + NAME + '__item';
  var DATA = 'data-';
  var DATA_NAME = DATA + NAME;
  var V_MEDIA = 'media';
  var S_MEDIA = '.' + V_MEDIA;
  var DATA_MEDIA = DATA + NICK + '-' + V_MEDIA;
  var C_IMG = NAME + '__img';
  var V_IMG = 'img';
  var V_SRC = 'src';
  var V_SRCSET = 'srcset';
  var V_SIZES = 'sizes';
  var V_HTML = 'html';
  var V_TEMPLATE = 'template';
  var V_AUDIO = 'audio';
  var V_IFRAME = 'iframe';
  var V_VIDEO = 'video';
  var S_BLUR = '.b-blur';
  var S_IMG = V_IMG + ':not(' + S_BLUR + ')';
  var E_CLICK = 'click';
  var ADDCLASS = 'addClass';
  var REMOVECLASS = 'removeClass';
  var B_PROVIDER = 'b-provider--';
  var V_PROVIDER;
  var S_TRIGGER;
  var FN_SPLIDE = false;
  var FN_FULLSCREEN = false;
  var FN_MEDIA = false;
  var FN_ZOOM = false;
  var FN_SANITIZER = $.sanitizer;
  var V_OVERLAY = 'overlay';
  var V_WIDTH = 'width';
  var V_HEIGHT = 'height';
  var TRANSITIONEND = 'transitionend.' + NICK;
  var WIN_SIZE = {};
  var SUFFIXES = [
    V_OVERLAY,
    'content',
    'caption',
    'counter',
    'closer',
    'fullscreen'
  ];

  var DEFAULTS = {
    captionPos: V_OVERLAY,
    layout: 'bottom',
    trigger: '[' + DATA_NAME + '-trigger]',
    skin: '',
    fsIconOn: '',
    template: '',
    dataSplide: {},
    init: false
  };

  var ITEM_DEFAULTS = {
    root: null,
    width: 0,
    height: 0,
    i: 0,
    html: '',
    alt: '',
    caption: '',
    msrc: '',
    src: '',
    srcset: '',
    type: '',
    rect: {},
    ajax: ''
  };

  var FN;

  /**
   * Defines Splidebox constructor.
   *
   * @param {HTMLElement} el
   *   The Splidebox HTML element.
   * @param {object} opts
   *   The Splidebox options.
   *
   * @return {Splidebox}
   *   The Splidebox instance.
   *
   * @namespace
   */
  function Splidebox(el, opts) {
    var me = $.extend({}, FN, this);

    me.name = ns;
    me.options = $.extend({}, DEFAULTS, opts);
    me.gallery = el;
    me.isSlider = $.hasClass(el, BASE) && !$.hasClass(el, 'is-carousel');

    // DOM ready fix.
    setTimeout(function () {
      WIN_SIZE = $.windowSize();
      init(me);
    });

    return me;
  }

  FN = Splidebox.prototype;
  FN.constructor = Splidebox;

  // Private Methods
  function root() {
    var me = this;
    var cn = me.root = createElement(V_TEMPLATE, me.template(me.options));

    $.each(SUFFIXES, function (key) {
      me[key] = $.find(cn, '.' + NAME + '__' + key);
    });

    return cn;
  }

  function buildRoot() {
    var me = this;
    var el = root.call(me);
    var frag = DOC.createDocumentFragment();

    append(frag, el);
    append(DOC.body, frag);

    $.addClass(el, IS_MOUNTING);
    $.addClass(me.content, IS_LOADING);
  }

  function buildSplide(resolve, reject) {
    var me = this;
    var opts = me.options;
    var cn = me.content;
    var tmp = createElement(V_TEMPLATE, opts.template);
    var slider = tmp;

    try {
      // Might be wrapped with splide-wrapper when having navigation.
      // Splidebox currently does not support slider with navigation.
      if ($.hasClass(tmp, BASE + '-wrapper')) {
        slider = $.find(tmp, '> ' + S_BASE);
      }

      $.removeClass(slider, BASE + '--main');
      $.attr(slider, 'data-' + BASE, JSON.stringify(opts.dataSplide));
    }
    catch (e) {
      // Ignore.
    }

    append(cn, slider);

    if (opts.dataSplide.pagination) {
      $.addClass(me.root, IS_PAGINATED);
    }

    var list = me.list = $.find(cn, S_SPLIDE_LIST);
    me.slider = $.find(cn, S_BASE);

    if (!$.isElm(list)) {
      reject();
    }
    else {
      list.innerHTML = '';

      $.each(me.items, function (item) {
        me.addSlide(item);
      });

      resolve(list);
    }
  }

  function initSplide(list) {
    var me = this;
    var opts = me.options;
    var el = me.slider;
    var s = {};
    var root = me.root;
    var index = me.index;
    var single = me.count === 1;

    s = $.extend({}, opts.dataSplide || {}, {
      zoomRoot: root
    });

    if (single) {
      $.addClass(root, 'is-sbox-unsplide');
    }

    if (opts.init) {
      s.start = index;
      s.count = me.count;

      // el.dataset.splide = JSON.stringify(s, getCircularReplacer());
      me.splide = FN_SPLIDE = opts.init(el, s);
    }

    IS_INITIAL = IS_INITIAL || $.hasClass(root, IS_MOUNTING);

    setTimeout(function () {
      if (FN_SPLIDE) {
        // FN_SPLIDE.options = s;
        FN_SPLIDE.go(index);
        me.curr = FN_SPLIDE.Components.Slides.getAt(index);
        me.currData = me.items[index];

        buildPreloader.call(me);

        FN_SPLIDE.on('ready.' + NICK, function (slide) {
          $.removeClass(me.content, IS_LOADING);
        });

        FN_SPLIDE.on('active.' + NICK, function (slide) {
          me.index = FN_SPLIDE.index;
          me.curr = slide;
          me.currData = me.items[me.index];

          initPreloader.call(me);
          setCaption.call(me);

          var provider = me.currData.provider;
          $.attr(root, DATA_MEDIA, me.currData.type);

          if (V_PROVIDER) {
            $.removeClass(root, B_PROVIDER + V_PROVIDER);
          }
          if (provider) {
            $.addClass(root, B_PROVIDER + provider);
          }

          $[me.currData.ajax ? ADDCLASS : REMOVECLASS](root, C_IS_AJAXED);
          $[me.currData.display === V_PLAYABLE ? ADDCLASS : REMOVECLASS](root, C_IS_PLAYABLE);

          V_PROVIDER = provider;
        });

        FN_SPLIDE.on('moved.' + NICK, function () {
          clearDragMarkers.call(me);
        });

        // After captions are loaded.
        // @todo use an event after `active` fire instead, if any.
        setTimeout(function () {
          if (single) {
            FN_SPLIDE.destroy();
          }
        }, 100);

      }
    });
    return FN_SPLIDE;
  }

  function buildPreloader() {
    var me = this;
    var root = me.root;
    var data = me.currBox = me.toBox();

    if (data && !data.hasImg) {
      return;
    }

    data.initial = true;

    setClone(me, data);

    me.zoom('off');
    var clone = me.clone;

    if (!clone) {
      me.shouldPreload = false;
      return;
    }

    var called = false;
    var reset = function () {
      var _style = clone.style;
      _style.transform = 'translate3d(0, 0, 0) scale3d(1, 1, 1)';
      _style.opacity = 0;

      $.removeClass(root, IS_MOUNTING);

      IS_INITIAL = false;

      $.off(clone, TRANSITIONEND, reset);
      $.remove(clone);

      me.clone = null;
      me.zoom('on');
      $.addClass(root, IS_ACTIVE);

      called = true;
    };

    $.on(clone, TRANSITIONEND, reset);

    setTimeout(function () {
      if (!called) {
        reset();
      }
    }, 1200);

    me.shouldPreload = true;
  }

  function initPreloader() {
    var me = this;
    var root = me.root;

    setTimeout(function () {
      var box = me.currBox;
      var img = box.img.el;

      if (box.isValid && $.isElm(img)) {
        if ($.equal(img, 'img')) {
          if (img.complete) {
            transformPreloader.call(me);
          }
          else {
            $.on(img, 'load', transformPreloader.bind(me));
          }
        }
      }
      else {
        $.removeClass(root, IS_MOUNTING);
        $.addClass(root, IS_ACTIVE);
      }
    });
  }

  function transformPreloader() {
    var me = this;
    var ws = WIN_SIZE;
    var box = me.currBox;
    var img = box.img.el;
    var ox = 1;
    var oy = 1;
    var margin = 0;
    var sub = 0.5;
    var subWin = 2;
    var rect = $.rect(img);
    var iw = $.outerWidth(img, true);
    var ih = $.outerHeight(img, true);

    box = $.extend({}, box, {
      initial: false,
      img: {
        el: img,
        width: iw,
        height: ih,
        left: rect.left,
        top: rect.top,
        rect: rect
      }
    });

    setClone(me, box);

    var item = box.img;
    var aox = Math.abs(ox);
    var aoy = Math.abs(oy);
    var ix =
      (ox > 0 ? 1 - aox : aox) * ws.width +
      (ox * ws.width) / subWin -
      item.left -
      sub * iw;
    var iy =
      (oy > 0 ? 1 - aoy : aoy) * ws.height +
      (oy * ws.height) / subWin -
      item.top -
      sub * ih;
    var iz = Math.min(
      Math.min(ws.width * aox - margin, item.width - margin) / iw,
      Math.min(ws.height * aoy - margin, item.height - margin) / ih
    );

    ix += 4;

    me.clone.style.transform =
      'translate3d(' +
      ix +
      'px, ' +
      iy +
      'px, 0) scale3d(' +
      iz +
      ', ' +
      iz +
      ', 1)';
  }

  function attachRoot(splide) {
    var me = this;

    /*
    var root = me.root;
    var docFrag = DOC.createDocumentFragment();

    append(docFrag, root);
    append(DOC.body, docFrag);
    */

    setTimeout(function () {
      initPlugins.call(me);
      var splide = me.splide;

      if (splide) {
        splide.refresh();
      }
    });
  }

  function buildOut() {
    var me = this;
    var opts = me.options;

    if (!me.count || !opts.template) {
      return;
    }

    buildRoot.call(me);

    var promise = new Promise(buildSplide.bind(me));
    promise.then(initSplide.bind(me));
    promise.then(attachRoot.bind(me));
  }

  function toggleCaption(e) {
    $.toggleClass(e.target, C_IS_VISIBLE);
  }

  function onPlaying() {
    $.addClass(this.root, IS_PLAYING);
  }

  function onStopped() {
    $.removeClass(this.root, IS_PLAYING);
  }

  function initEvents() {
    var me = this;
    var die = me.close.bind(me);

    $.on(me.closer, E_CLICK, die);
    $.on(me.overlay, E_CLICK, die);
    $.on(me.caption, E_CLICK, toggleCaption);

    $.on(_win, 'blazy:mediaPlaying', onPlaying.bind(me));
    $.on(_win, 'blazy:mediaStopped', onStopped.bind(me));
  }

  function initPlugins() {
    var me = this;
    var splide = me.splide;

    if (splide && splide.Components) {
      var components = splide.Components;

      if (!FN_FULLSCREEN && 'xFullScreen' in components) {
        FN_FULLSCREEN = components.xFullScreen;

        var fsOptions = {
          element: me.root,
          className: IS_FULLSCREEN
        };
        FN_FULLSCREEN.init(fsOptions);
      }

      if (!FN_MEDIA && 'xMedia' in components) {
        FN_MEDIA = components.xMedia;
      }

      if (!FN_ZOOM && 'xZoom' in components) {
        FN_ZOOM = components.xZoom;
      }
    }
  }

  function createElement(tagName, html, className, root, attach) {
    attach = attach || '';
    var el = $.create(tagName || 'div', className, html);

    // @todo replace with dBlazy post Blazy 2.6.
    if (root && attach) {
      if (attach === 'prepend') {
        root.insertBefore(el, root.childNodes[0] || null);
      }
      else if (attach === 'append') {
        append(root, el);
      }
      else if (attach === 'next') {
        root.insertAdjacentElement('afterend', el);
      }
    }
    return el;
  }

  function clearDragMarkers() {
    var root = this.root;

    setTimeout(function () {
      $.removeAttr(root, DATA + 'scale');

      var moves = $.findAll(root, S_DRAG_OBJ);
      if (moves.length) {
        $.each(
          moves,
          function (item) {
            item.style.transform = '';

            $.removeClass(item, IS_MOVED);
          },
          100
        );
      }
    });
  }

  function setClone(me, data) {
    var clone = me.clone;
    var img = data.img;
    var tn = data.tn;
    var height = img.height;
    var width = img.width;
    var left = img.left;
    var top = img.top;

    if (data.initial || !clone) {
      clone = createElement('div', null, NAME + '__clone', me.overlay, 'next');
      height = tn.height;
      width = tn.width;
      left = tn.left;
      top = tn.top;
    }

    if (clone) {
      var _style = clone.style;
      _style.height = height + 'px';
      _style.width = width + 'px';
      _style.left = left + 'px';
      _style.top = top + 'px';

      _style.backgroundImage = 'url(' + tn.src + ')';
      me.clone = clone;
    }
  }

  function setCaption() {
    var me = this;
    var opts = me.options;
    var el = me.caption;
    var data = me.currData;
    var captioned = $.isObj(data) &&
      data.caption &&
      !data.ajax;

    if ($.isElm(el) && opts.captionPos === V_OVERLAY) {
      el.innerHTML = captioned ? FN_SANITIZER.sanitize(data.caption) : '';
      $[captioned ? ADDCLASS : REMOVECLASS](el, C_IS_CAPTIONED);
    }

    if (me.counter) {
      me.counter.innerText = me.index + 1 + '/' + me.splide.length;
    }
  }

  function preload(data) {
    var _ajax = data.ajax ? '' : ' ' + IS_ZOOMABLE;
    var image = createElement(V_IMG, null, C_IMG + _ajax);
    var attrs = ['alt', V_SRC, V_SRCSET, V_SIZES, V_HEIGHT, V_WIDTH];

    image.decoding = 'async';
    image.loading = 'lazy';

    $.each(attrs, function (attr) {
      if (attr in data && data[attr]) {
        image[attr] = data[attr];
      }
    });

    return image;
  }

  // Normally thumbnails, unless a slider, and so the .splide container.
  function projected(timg, iw, src) {
    var ws = WIN_SIZE;
    var ww = ws.width;
    var wh = ws.height;
    var ox = 1;
    var oy = 1;
    var tRect = $.rect(timg);
    var th = $.outerHeight(timg);
    var tw = $.outerWidth(timg);
    var tl = tRect.left;
    var tt = tRect.top;
    var aox = Math.abs(ox);
    var aoy = Math.abs(oy);
    var tminX = (ox > 0 ? 1 - aox : aox) * ww + (ox * ww) / 2;
    var tminY = (oy > 0 ? 1 - aoy : aoy) * wh + (oy * wh) / 2;
    var tx = tl + tw / 2 - tminX;
    var ty = tt + th / 2 - tminY;
    var tz = tw / iw;

    return {
      el: timg,
      src: src,
      x: tx,
      y: ty,
      z: tz,
      height: th,
      width: tw,
      left: tl,
      top: tt,
      rect: tRect
    };
  }

  function stopVideo() {
    if (FN_MEDIA) {
      FN_MEDIA.close();
    }
  }

  function extractAttr(html, attr) {
    return html
      .split(attr + '="')
      .pop()
      .split('"')[0];
  }

  function detach(me) {
    var splide = me.splide;
    var root = me.root;

    if (splide) {
      stopVideo.call(me);

      FN_FULLSCREEN = false;
      FN_MEDIA = false;
      FN_ZOOM = false;
      splide.destroy(true);
      splide = null;
    }

    if ($.isElm(root)) {
      $.attr(root, ARIA_HIDDEN, true);
      $.remove(root);
    }
  }

  function append(parent, el) {
    if ($.isElm(parent)) {
      if ($.isElm(el)) {
        parent.appendChild(el);
      }
      else {
        $.append(parent, el);
      }
    }
  }

  function launch(index) {
    var me = this;
    var root;

    me.index = index;

    buildOut.call(me);
    initEvents.call(me);

    root = me.root;

    if ($.isElm(root)) {
      $.addClass(root, IS_MOUNTED);
      $.attr(root, ARIA_HIDDEN, false);

      setTimeout(function () {
        $.removeClass(me.content, IS_LOADING);
      }, 1200);
    }
  }

  function initials(me) {
    me.root = null;

    $.each(SUFFIXES, function (key) {
      me[key] = null;
    });

    me.index = 0;
    me.count = 0;
    me.items = [];
    me.list = null;
    me.slider = null;
    me.triggers = [];
    me.shouldPreload = false;
    me.splide = null;
    me.curr = null;
    me.currBox = {
      img: {},
      tn: {}
    };
    me.currData = {};
  }

  function init(me) {
    initials(me);

    S_TRIGGER = me.options.trigger;

    var gallery = me.gallery;
    if (gallery && $.isElm(gallery)) {
      $.on(gallery, E_CLICK, S_TRIGGER, me.open.bind(me), false);
    }
  }

  /**
   * Gets the current clicked item index.
   *
   * @param {HTMLElement} link
   *   The link HTML element.
   *
   * @return {Int}
   *   The current clicked link index.
   */
  FN.getIndex = function (link) {
    var me = this;
    var i = 0;
    if (me.items.length) {
      $.each(me.items, function (data, idx) {
        if (data.element && data.element === link) {
          i = idx;
          return i;
        }
      });
    }

    return i;
  };

  FN.toData = function (el) {
    var me = this;
    var opts = me.options;
    var data = $.parse($.attr(el, 'data-b-media data-media'));
    var div = $.find(el, S_MEDIA);
    var href = $.attr(el, 'href');
    var url = $.attr(el, DATA + 'box-url', href, true);
    var img = $.find(el, S_IMG);
    var check = el.nextElementSibling;
    var caption = $.hasClass(check, C_VISUALLY_HIDDEN) ? check : null;
    var rect = $.rect(el);
    var ajax = $.attr(el, DATA + 'b-ajax');
    var html = '';
    var type = data.boxType || '';
    var display = type;
    var alt = $.attr(img, 'alt');
    var isResimage;
    var isPicture;

    if ([V_IFRAME, V_AUDIO, V_VIDEO].includes(type)) {
      display = V_PLAYABLE;
    }
    if (ajax) {
      display = V_HTML;
    }

    var item = {
      element: el,
      width: $.toInt(data.width, 640),
      height: $.toInt(data.height, 360),
      i: me.getIndex(el),
      alt: FN_SANITIZER.sanitize(alt),
      caption: $.isElm(caption) ? caption.innerHTML : '',
      msrc: $.attr(div, 'data-b-thumb data-thumb'),
      provider: data.provider,
      type: type,
      rect: rect,
      isPicture: false,
      ajax: ajax,
      ajaxOnly: (ajax && opts.ajaxOnly) || false,
      display: display
    };

    if (V_HTML in data) {
      html = data.html;

      if (data.encoded) {
        html = atob(html);
      }

      // Only supports non-picture, unfortunately.
      isResimage = $.contains(html, V_SRCSET);
      isPicture = $.contains(html, '<picture');
      item.isPicture = isPicture;

      if (isResimage && !isPicture) {
        item.srcset = extractAttr(html, V_SRCSET);
        item.src = extractAttr(html, V_SRC);
        item.sizes = extractAttr(html, V_SIZES);
      }
      else {
        if ([V_AUDIO, V_VIDEO].includes(type)) {
          item.src = url;
        }
        // Local video and picture.
        item.html = me.htmlWrapper({
          html: html,
          data: item
        });
      }
    }
    else if (type === V_IFRAME) {
      item.html = Drupal.theme('blazyMedia', {
        el: el
      });
    }
    else {
      item.src = url;
    }

    return $.extend({}, ITEM_DEFAULTS, item);
  };

  FN.addSlide = function (data) {
    var me = this;
    var el = me.list;
    var slide = me.toSlide(data);

    if ($.isElm(el)) {
      append(el, slide);

      data.slide = slide;
      $.trigger(me.slider, NAME + ':added', {
        data: data
      });
    }
  };

  FN.toSlide = function (data) {
    var me = this;
    var content;

    if (data.html) {
      content = data.html;
    }
    else {
      if (data.src) {
        var img = preload(data);
        content = img.outerHTML;
      }
    }

    var html = me.slideWrapper({
      html: content,
      data: data
    });

    var el = createElement(V_TEMPLATE, html);
    var picture = $.find(el, 'picture');

    if ($.isElm(picture) && !data.ajax) {
      var dim = WIN_SIZE;
      var img = $.find(picture, 'img');

      $.addClass(picture, IS_CENTERED);
      $.addClass(img, C_IMG + ' ' + IS_ZOOMABLE);
      $.attr(img, 'loading', 'lazy');
      $.attr(img, V_WIDTH, (dim.width - 32));
      $.attr(img, V_HEIGHT, (dim.height - 22));
    }
    return el;
  };

  FN.toBox = function () {
    var me = this;
    var data = me.currData || me.items[me.index];

    if ($.isUnd(data)) {
      return {};
    }

    var link = data.element;
    var slide = $.isEmpty(me.curr) ? data.slide : me.curr.slide;
    var img = $.find(slide, S_IMG);
    var timg = $.find(link, S_IMG);
    var elProjected = me.isSlider ? me.gallery : timg;
    var ih = 0;
    var iw = 0;
    var il = 0;
    var it = 0;
    var iRect = {};
    var isAjax = data.ajax !== '';
    var isIframe = data.type === V_IFRAME;
    var isVideo = data.type === V_VIDEO;
    var projection = {};

    if (!$.isElm(img)) {
      var video = $.find(slide, V_VIDEO);
      var poster = $.attr(video, 'poster');

      if (poster) {
        img = video;
      }
    }

    if ($.isElm(img)) {
      iRect = $.rect(img);
      ih = $.outerHeight(img);
      iw = $.outerWidth(img);
      il = iRect.left;
      it = iRect.top;
    }

    if ($.isElm(elProjected)) {
      projection = projected(elProjected, iw, data.msrc || timg.src);
    }

    var box = {
      hasImg: $.isElm(img),
      hasTn: $.isElm(timg),
      isAjax: isAjax,
      isValid: $.isElm(img) && $.isElm(timg),
      isIframe: isIframe,
      isVideo: isVideo,
      isPlayable: isIframe || isVideo,
      img: {
        el: img,
        height: ih,
        width: iw,
        left: il,
        top: it,
        rect: iRect
      },
      tn: projection
    };

    me.currBox = box;
    return box;
  };

  FN.zoom = function (e) {
    if (FN_ZOOM) {
      FN_ZOOM[e]();
    }
  };

  FN.destroy = function () {
    var me = this;
    var root = me.root;

    $.addClass(root, IS_UMOUNTING);

    var box = me.toBox();

    // || box.isPlayable || box.isAjax
    if (!box || !box.isValid) {
      detach(me);
      return;
    }

    var img = box.img.el;
    if (!img) {
      detach(me);
      return;
    }

    var tn = box.tn;
    var z = tn.z;

    me.zoom('off');

    $.addClass(img, NAME + '__trans');
    img.style.transform =
      'translate3d(' +
      tn.x +
      'px, ' +
      tn.y +
      'px, 0) scale3d(' +
      z +
      ', ' +
      z +
      ', 1)';

    var called = false;
    var onEnded = function (e) {
      img.style.transform = 'translate3d(0,0,0) scale3d(1,1,1)';

      called = true;

      detach(me);
    };

    $.one(img, TRANSITIONEND, onEnded);

    $.off('blazy:mediaPlaying', onPlaying.bind(me));
    $.off('blazy:mediaStopped', onStopped.bind(me));

    // Failsafe with potential screwed-up transition.
    setTimeout(function () {
      if (!called) {
        detach(me);
      }
    }, 800);
  };

  FN.close = function () {
    var me = this;

    if ($.hasClass(me.root, IS_FULLSCREEN)) {
      if (FN_FULLSCREEN) {
        me.fullscreen.click();
      }

      return false;
    }

    me.destroy();
  };

  FN.open = function (e) {
    var me = this;
    e.preventDefault();
    e.stopPropagation();

    IS_INITIAL = true;
    initials(me);

    // With a mix of (non-)lightboxed contents: image, video, Facebook,
    // Instagram, etc., some may not always be lightboxed, so filter em out.
    var target = e.target;
    var parent = $.closest(target, 'a');
    var link = $.attr(parent, 'href') ? parent : $.closest(target, S_TRIGGER);
    var triggers = [];
    var pos;

    if ($.isStr(S_TRIGGER)) {
      triggers = $.findAll(me.gallery, S_TRIGGER);
    }

    me.count = triggers.length;
    me.triggers = triggers;

    if (me.count) {
      $.each(triggers, function (el, i) {
        var clone = $.closest(el, S_BASE + '__slide--clone');
        if (!$.isElm(clone)) {
          var data = me.toData(el);
          data.i = i;
          me.items.push(data);
        }
      });
    }

    pos = me.getIndex(link);
    launch.call(me, pos);
  };

  /**
   * Initializing the HTML element into a Splidebox.
   *
   * @param {HTMLElement} el
   *   The Splidebox HTML element.
   * @param {object} opts
   *   The Splidebox options.
   *
   * @return {function}
   *   The Splidebox instance.
   */
  Splidebox.init = function (el, opts) {
    if (!el.splidebox) {
      el.splidebox = new Splidebox(el, opts);
    }
    return el.splidebox;
  };

  return Splidebox;

}));
