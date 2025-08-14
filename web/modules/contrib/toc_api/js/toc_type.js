/**
 * @file
 * TOC type options behavior.
 */

(function ($, Drupal, once) {
  function toggleHeaders() {
    const min = parseInt(
      document.querySelector('.js-toc-type-options-header-min')?.value || 1,
      10,
    );
    const max = parseInt(
      document.querySelector('.js-toc-type-options-header-max')?.value || 6,
      10,
    );

    for (let i = 1; i <= 6; i++) {
      const $header = $(`details[id$="-headers-h${i}"]`);
      if (i >= min && i <= max) {
        $header.show();
      } else {
        $header.hide();
      }
    }
  }

  Drupal.behaviors.tocTypeOptions = {
    attach(context) {
      once(
        'toc-type-header-change',
        '.js-toc-type-options-header-min, .js-toc-type-options-header-max',
        context,
      ).forEach((el) => {
        el.addEventListener('change', toggleHeaders);
      });

      toggleHeaders();
    },
  };
})(jQuery, Drupal, once);
