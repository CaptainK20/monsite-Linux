/**
 * @file
 * Provides Splidebox UI.
 */

(function ($) {

  'use strict';

  var _name = 'splidebox';
  var _overlay = _name + '__overlay';
  var _inner = _name + '__inner';
  var _content = _name + '__content';
  var _caption = _name + '__caption';
  var _nav = _name + '__nav';
  var _closer = _name + '__closer';
  var _counter = _name + '__counter';
  var _fullscreen = _name + '__fullscreen';
  var _slide = 'slide';
  var _slideContent = _slide + '__content';
  var _ajaxClass = 'is-sbox-ajax';
  var _hide = 'aria-hidden="true"';
  var _polite = 'aria-live="polite"';
  var _divStart = '<div class=';
  var _divEnd = '</div>';
  var _btn = 'button';
  var _btnStart = '<' + _btn + ' class=';
  var _btnEnd = '</' + _btn + '>';

  var fn = Splidebox.prototype;
  fn.constructor = Splidebox;

  /**
   * The main lightbox HTML template.
   *
   * @param {Object} opts
   *   An object with the following keys: skin, fsIconOn.
   *
   * @return {String}
   *   Returns a html string.
   */
  fn.template = function (opts) {
    var html;
    var skin = opts.skin ? ' ' + _name + '--skin--' + opts.skin : '';

    html = _divStart + '"$name $skin" tabindex="-1" aria-label="$name" $hide>';
    html += _divStart + '"$overlay">' + _divEnd;
    html += _divStart + '"$inner">';
    html += _divStart + '"$content">' + _divEnd;
    html += _divStart + '"$nav">';
    html += _divStart + '"$counter" $polite>' + _divEnd;
    html += _btnStart + '"$closer" type="$btn" $hide>&times;' + _btnEnd;
    html += _btnStart + '"$fullscreen" type="$btn" data-fs-trigger $hide>$icon' + _btnEnd;
    html += _divEnd;

    if (opts.captionPos === 'overlay') {
      html += _divStart + '"$caption is-caption">' + _divEnd;
    }
    html += _divEnd + _divEnd;

    return $.template(html, {
      btn: _btn,
      name: _name,
      skin: skin,
      overlay: _overlay,
      inner: _inner,
      content: _content,
      nav: _nav,
      counter: _counter,
      closer: _closer,
      fullscreen: _fullscreen,
      icon: opts.fsIconOn,
      hide: _hide,
      polite: _polite,
      caption: _caption
    });
  };

  /**
   * Template for a slide.
   *
   * @param {Object} settings
   *   An object with the following keys: data, html.
   *
   * @return {String}
   *   Returns a html string.
   */
  fn.slideWrapper = function (settings) {
    var me = this;
    var opts = me.options;
    var data = settings.data;
    var content = settings.html;
    var caption = data.caption;
    var ajaxUrl = data.ajax;
    var captioned = caption && opts.captionPos === 'inline';
    var layout = captioned && opts.layout ? ' ' + _slide + '--caption--' + opts.layout : '';
    var ajaxSlide = ajaxUrl ? ' is-ajax-slide' : '';
    var ajaxItem = ajaxUrl ? ' is-ajax-item' : '';
    var ajaxId = _ajaxClass + '-' + data.i;
    var html;

    html = '<li class="splide__slide $slideClass $layout $ajaxSlide">';
    html += _divStart + '"$slideContent">';
    html += _divStart + '"$name__item is-flex $ajaxItem">';

    if (!data.ajaxOnly) {
      if (captioned && content && !ajaxUrl) {
        html += _divStart + '"$slideClass__media is-flex">$content' + _divEnd;
        html += _divStart + '"$slideClass__caption is-centered is-caption" aria-live="polite">$caption' + _divEnd;
      }
      else {
        html += content;
      }
    }

    if (ajaxUrl) {
      // @todo use use-ajax post #3031444, #3026636.
      var link = '<a href="$ajaxUrl" class="$ajaxClass visually-hidden" data-ajax-wrapper="$ajaxId" id="$ajaxId">$ajaxUrl</a>';
      html += _divStart + '"$name__ajax">' + link + _divEnd;
    }

    html += _divEnd;
    html += _divEnd + '</li>';

    return $.template(html, {
      slideContent: _slideContent,
      layout: layout,
      ajaxSlide: ajaxSlide,
      name: _name,
      ajaxItem: ajaxItem,
      content: content,
      caption: caption,
      ajaxUrl: ajaxUrl,
      ajaxClass: _ajaxClass,
      ajaxId: ajaxId,
      slideClass: _slide
    });
  };

  /**
   * Template for a (remote|local) video.
   *
   * @param {Object} settings
   *   An object with the following keys: data, html.
   *
   * @return {String}
   *   Returns a html string.
   */
  fn.htmlWrapper = function (settings) {
    var data = settings.data;
    var content = settings.html;
    var wrapper = 'media-wrapper';

    if (data.isPicture) {
      return content;
    }

    // @todo  style="width:$widthpx"
    var html = _divStart + '"$wrapper $wrapper--box">$content' + _divEnd;

    return $.template(html, {
      // width: data.width,
      content: content,
      wrapper: wrapper
    });
  };

})(dBlazy);
