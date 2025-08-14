<?php

namespace Drupal\splidebox;

use Drupal\blazy\Field\BlazyField;
use Drupal\Component\Utility\UrlHelper;
use Drupal\Core\Url;
use Drupal\splide\Entity\Splide;
use Drupal\splide\Form\SplideAdminInterface;
use Drupal\splide\SplideManager;

/**
 * Adds Splidebox functionality.
 */
class Splidebox extends SplideManager implements SplideboxInterface {

  /**
   * The splide admin service.
   *
   * @var \Drupal\splide\Form\SplideAdminInterface
   */
  protected $admin;

  /**
   * The lightbox dummy template.
   *
   * @var string
   */
  private $template = '';

  /**
   * {@inheritdoc}
   */
  public function setAdmin(SplideAdminInterface $admin): self {
    $this->admin = $admin;
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function attachAlter(array &$load, array $attach = []): void {
    $this->verifySafely($attach);
    $data = $this->toData($load, $attach);

    $this->skinManager->attachCore($load, $data['attach']);
    $load['drupalSettings']['splidebox'] = [
      'lightbox' => $data['lightbox'],
      'splide'   => $data['splide'],
      'template' => $data['template'],
    ];

    $load['library'][] = 'splidebox/load';
    if (!empty($attach['ajax_link'])) {
      $load['library'][] = 'splidebox/ajax';
    }

    $this->moduleHandler->alter('splidebox_attach', $load, $data);
  }

  /**
   * {@inheritdoc}
   */
  public function preprocessBlazy(array &$variables): void {
    $settings = &$variables['settings'];

    // Provides AJAX contents if so configured.
    if (!empty($settings['ajax_link'])) {
      $this->toAjaxUrl($variables);
    }
  }

  /**
   * {@inheritdoc}
   *
   * @todo remove non-object definition post migrations at/by blazy:3.x.
   */
  public function formElementAlter(array &$form, array $definition): void {
    $blazies     = $definition['blazies'] ?? NULL;
    $settings    = $definition['settings'] ?? [];
    $namespaces  = array_keys(self::supportedModules());
    $namespace   = $definition['namespace'] ?? '';
    $field_type  = $definition['field_type'] ?? '';
    $target_type = $definition['target_type'] ?? '';
    $bundles     = $definition['target_bundles'] ?? [];
    $links       = ['link', 'string'];
    $entities    = ['entity_reference', 'entity_reference_revisions'];

    // @todo remove checks post blazy:2.17.
    if ($blazies) {
      $bundles     = $blazies->get('field.target_bundles', []) ?: $bundles;
      $field_type  = $blazies->get('field.type') ?: $field_type;
      $target_type = $blazies->get('target_type') ?: $target_type;
      $namespace   = $blazies->get('namespace') ?: $namespace;
    }

    $supported  = $namespace && in_array($namespace, $namespaces);
    $applicable = $supported && ($field_type && in_array($field_type, $entities));
    if ($applicable && isset($form['media_switch'])) {
      $options = $this->admin->getFieldOptions($bundles, $links, $target_type);
      $form['ajax_link'] = [
        '#type'          => 'select',
        '#title'         => $this->t('Lightbox AJAX link'),
        '#options'       => $options,
        '#empty_option'  => $this->t('- None -'),
        '#default_value' => $settings['ajax_link'] ?? '',
        '#weight'        => -98.99,
        '#states'        => [
          'visible' => [
            'select[name*="[media_switch]"]' => ['value' => 'splidebox'],
          ],
        ],
        '#description'   => $this->t('Choose any single-value link field types which have urls (<code>/node/123</code>) to nodes (other entities or forms are not supported to avoid complications). It will be loaded as the lightbox AJAX contents. Specific for Media, be sure the same link field available for all media types to have a mixed of Media correctly. To replace images/ videos with AJAX contents only, override <code>ajaxOnly</code> option to TRUE via <code>hook_splidebox_attach_alter</code>. Default is FALSE, the non-zoomable lightbox image and video are embedded above AJAX contents as hybrid contents.'),
      ];
    }
  }

  /**
   * {@inheritdoc}
   */
  public function getOptions(Splide $optionset, $count = 1): array {
    $options  = $optionset->getSettings();
    $excludes = ['classes', 'i18n', 'padding'];
    $excludes = array_combine($excludes, $excludes);
    $options  = array_diff_key($options, $excludes);
    $video    = empty($options['video']) ? [] : (array) $options['video'];
    $autoplay = $video['autoplay'] ?? TRUE;

    // Some are hidden module features. Wheel is inherent with Zoom, disable.
    $options['video'] = $video;
    $options['video']['autoplay'] = $autoplay;
    $options['wheel'] = FALSE;

    // @todo recheck 0, since it shouldn't be called nor displayed if 0.
    $options['count'] = $count ?: 1;

    $zoom = [
      'on'          => TRUE,
      'click'       => TRUE,
      'scale'       => TRUE,
      'min'         => 1,
      'max'         => 1.5,
      'root'        => '.splidebox',
      'rootClass'   => 'is-sbox-zoomed',
      'dragClass'   => 'is-sbox-dragging',
      'target'      => '.splidebox__item:not(.is-ajax-item)',
      'targetClass' => 'is-sbox-moved',
    ];

    $zooms = empty($options['zoom']) ? [] : (array) $options['zoom'];
    $options['zoom'] = array_merge($zoom, $zooms);
    return $optionset->toJson($options);
  }

  /**
   * {@inheritdoc}
   */
  public function getOptionset(array $settings): Splide {
    $name = $this->getOptionsetName($settings);

    return Splide::loadSafely($name);
  }

  /**
   * Checks if splidebox is applicable.
   */
  public function isApplicable(array &$settings): bool {
    $blazies = $settings['blazies'] ?? NULL;
    $switch  = $settings['media_switch'] ?? '';

    if ($switch == 'splidebox') {
      // Tell Blazy we are supporting rich box: local video within lightbox.
      if ($blazies) {
        $blazies->set('is.richbox', TRUE)
          ->set('is.encodedbox', TRUE);
      }
      return TRUE;
    }
    return FALSE;
  }

  /**
   * {@inheritdoc}
   */
  public function toAttributes(array &$settings): void {
    $blazies   = $settings['blazies'];
    $optionset = $this->getOptionset($settings);
    $count     = $blazies->get('count', 0);
    $options   = $this->getOptions($optionset, $count);

    $blazies->set('data.splidebox', $options);
  }

  /**
   * Returns the supported modules to have AJAX links.
   */
  public static function supportedModules(): array {
    return [
      'blazy'     => 'Drupal\blazy\BlazyDefault',
      'gridstack' => 'Drupal\gridstack\GridStackDefault',
      'mason'     => 'Drupal\mason\MasonDefault',
      'outlayer'  => 'Drupal\outlayer\OutlayerDefault',
      'splide'    => 'Drupal\splide\SplideDefault',
    ];
  }

  /**
   * Returns the optionset name.
   */
  private function getOptionsetName(array $settings): string {
    return $settings['box_optionset'] ?? $settings['splidebox'] ?? 'splidebox';
  }

  /**
   * Overrides variables for theme_blazy().
   */
  private function toAjaxUrl(array &$variables): void {
    $settings = $variables['settings'];
    $blazies  = $settings['blazies'];
    $langcode = $blazies->get('language.current');
    $box_url  = $blazies->get('lightbox.url');
    $item     = $blazies->get('image.item', $variables['item'] ?? NULL);

    // Node: $node = $blazies->get('entity.instance');
    // Media: $media = $blazies->get('media.instance');
    // Below is a media entity by designed:
    $entity = $blazies->get('media.instance');

    /** @var \Drupal\image\Plugin\Field\FieldType\ImageItem $item */
    if (!$entity && $item) {
      if (method_exists($item, 'getEntity')) {
        $entity = $item->getEntity();
      }
      else {
        $entity = $item->entity ?? NULL;
      }
    }

    if ($entity && method_exists($entity, 'isNew')) {
      if (!$entity->isNew()) {
        $value = NULL;
        if ($link = $settings['ajax_link'] ?? NULL) {
          $value = BlazyField::getString($entity, $link, $langcode, TRUE);
        }

        if (!$value) {
          return;
        }

        if (mb_strpos($value, 'internal:') !== FALSE
          || mb_strpos($value, 'entity:') !== FALSE
          || mb_strpos($value, 'route:') !== FALSE) {
          $url = Url::fromUri($value);
        }
        else {
          $url = Url::fromUserInput($value);
        }

        if ($path = $url->setAbsolute()->toString()) {
          // @todo recheck/remove, the link widget already sanitized its input.
          $old_url = $variables['url'] ?? '';
          $box_url = $box_url ?: $old_url;
          $variables['url'] = UrlHelper::filterBadProtocol($path);
          $variables['url_attributes']['data-b-ajax'] = UrlHelper::filterBadProtocol($value);
          $variables['url_attributes']['data-box-url'] = UrlHelper::filterBadProtocol($box_url);
        }
      }
    }
  }

  /**
   * Returns splidebox data.
   */
  private function toData(array &$load, array $attach): array {
    $blazies   = $attach['blazies'];
    $layout    = $attach['box_layout'] ?? NULL;
    $optionset = $this->getOptionset($attach);
    $count     = $blazies->get('count', 1);
    $options   = $this->getOptions($optionset, $count);
    $skin      = $optionset->getSkin() ?: 'default';

    // Modify attachments.
    $attach['skin']       = $attach['skin_lightbox'] ?? $skin;
    $attach['media']      = $attach['zoom'] = TRUE;
    $attach['fullscreen'] = $options['fullscreen'] = TRUE;

    // box_caption_pos: inline (ala Colorbox), or overlay (ala PhotoSwipe).
    // box_layout: any usual caption layouts, requires theming except bottom.
    // To replace media with AJAX contents only, override ajaxOnly to TRUE.
    $lightbox = [
      'skin'       => $attach['skin'],
      'layout'     => $layout ?: 'bottom',
      'captionPos' => $attach['box_caption_pos'] ?? 'overlay',
      'ajaxOnly'   => $attach['box_ajax_only'] ?? FALSE,
    ];

    $settings = $lightbox;
    $settings['blazies'] = $blazies;

    $build = [
      '#options'   => $options,
      '#optionset' => $optionset,
      '#settings'  => $settings,
    ];

    return [
      'lightbox' => $lightbox,
      'splide'   => Splide::typecast($options, FALSE),
      'load'     => $load,
      'attach'   => $attach,
      'template' => $this->toTemplate($build),
    ];
  }

  /**
   * Returns a dummy lightbox template.
   */
  private function toTemplate(array $build): string {
    if (!$this->template) {
      $data = $build;
      $settings = &$data['#settings'];
      // Prevents dummy complication with navigation for now.
      $settings['dummy_template'] = TRUE;
      $settings['optionset'] = $this->getOptionsetName($settings);

      $items = [];
      foreach (['One', 'Two'] as $key) {
        $items[] = [
          'slide' => ['#markup' => $key],
        ];
      }

      $data['items'] = $items;
      $html = $this->build($data);
      $this->template = $this->renderer->renderPlain($html);
    }

    return $this->template;
  }

}
