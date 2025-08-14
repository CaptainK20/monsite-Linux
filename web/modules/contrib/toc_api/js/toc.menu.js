/**
 * @file
 * TOC API menu behavior.
 */

(function ($, Drupal) {
  Drupal.behaviors.tocMenu = {
    attach(context) {
      $('form.toc-menu > select', context).change(function () {
        const value = this.value;
        if (value) {
          window.location.hash = value;
        }
        this.selectedIndex = 0;
      });
    },
  };
})(jQuery, Drupal);
