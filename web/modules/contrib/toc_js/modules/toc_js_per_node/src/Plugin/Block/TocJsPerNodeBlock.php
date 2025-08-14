<?php

namespace Drupal\toc_js_per_node\Plugin\Block;

use Drupal\Core\Form\FormStateInterface;
use Drupal\node\NodeTypeInterface;
use Drupal\toc_js\Plugin\Block\TocJsBlock;

/**
 * Provides a 'Toc.js' per node block.
 *
 * @Block(
 *  id = "toc_js_per_node_block",
 *  category = @Translation("Toc js"),
 *  admin_label = @Translation("Toc.js per node block"),
 * )
 */
class TocJsPerNodeBlock extends TocJsBlock {

  /**
   * {@inheritdoc}
   */
  public function defaultConfiguration() {
    return [
      'override_nodetype' => 1,
    ] + parent::defaultConfiguration();
  }

  /**
   * {@inheritdoc}
   */
  public function blockForm($form, FormStateInterface $form_state) {

    $form['override_nodetype'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Override node type configuration'),
      '#description' => $this->t('Override the table of contents configuration defined in the node type.'),
      '#default_value' => $this->configuration['override_nodetype'],
    ];

    $form['custom_configuration'] = [
      '#type' => 'details',
      '#title' => $this->t('Custom configuration'),
      '#description' => $this->t('Custom table of contents configuration specific to this block.'),
      '#open' => TRUE,
      '#states' => [
        'visible' => [
          ':input[name="settings[override_nodetype]"]' => ['checked' => TRUE],
        ],
      ],
    ];

    $this->blockFormToc($form['custom_configuration'], 'custom_configuration');

    return $form;
  }

  /**
   * Configuration name array.
   *
   * @param string $name
   *   The name for the configuration item.
   *
   * @return string|array
   *   Array with the custom_configuration parent element name.
   */
  protected function getTocName(string $name): string|array {
    return ['custom_configuration', $name];
  }

  /**
   * {@inheritdoc}
   */
  public function blockSubmit($form, FormStateInterface $form_state) {
    $this->configuration['override_nodetype'] = $form_state->getValue('override_nodetype');
    parent::blockSubmit($form, $form_state);
  }

  /**
   * Get the Toc.js configuration for a specific node type.
   *
   * @param \Drupal\node\NodeTypeInterface $type
   *   The node type to get the configuration from.
   *
   * @return array
   *   The node type Toc.js configuration array.
   */
  protected function getConfigurationFromNodeType(NodeTypeInterface $type):array {
    return [
      'toc_js_active' => $type->getThirdPartySetting('toc_js', 'toc_js_active'),
      'title' => $type->getThirdPartySetting('toc_js', 'title'),
      'title_tag' => $type->getThirdPartySetting('toc_js', 'title_tag'),
      'title_classes' => $type->getThirdPartySetting('toc_js', 'title_classes'),
      'selectors' => $type->getThirdPartySetting('toc_js', 'selectors'),
      'selectors_minimum' => $type->getThirdPartySetting('toc_js', 'selectors_minimum'),
      'container' => $type->getThirdPartySetting('toc_js', 'container'),
      'list_type' => $type->getThirdPartySetting('toc_js', 'list_type'),
      'list_classes' => $type->getThirdPartySetting('toc_js', 'list_classes'),
      'li_classes' => $type->getThirdPartySetting('toc_js', 'li_classes'),
      'inheritable_classes' => $type->getThirdPartySetting('toc_js', 'inheritable_classes'),
      'prefix' => $type->getThirdPartySetting('toc_js', 'prefix'),
      'classes' => $type->getThirdPartySetting('toc_js', 'classes'),
      'heading_classes' => $type->getThirdPartySetting('toc_js', 'heading_classes'),
      'skip_invisible_headings' => $type->getThirdPartySetting('toc_js', 'skip_invisible_headings'),
      'use_heading_html' => $type->getThirdPartySetting('toc_js', 'use_heading_html'),
      'collapsible_items' => $type->getThirdPartySetting('toc_js', 'collapsible_items'),
      'collapsible_expanded' => $type->getThirdPartySetting('toc_js', 'collapsible_expanded'),
      'back_to_top' => $type->getThirdPartySetting('toc_js', 'back_to_top'),
      'back_to_top_label' => $type->getThirdPartySetting('toc_js', 'back_to_top_label'),
      'back_to_top_selector' => $type->getThirdPartySetting('toc_js', 'back_to_top_selector'),
      'heading_focus' => $type->getThirdPartySetting('toc_js', 'heading_focus'),
      'back_to_toc' => $type->getThirdPartySetting('toc_js', 'back_to_toc'),
      'back_to_toc_label' => $type->getThirdPartySetting('toc_js', 'back_to_toc_label'),
      'back_to_toc_classes' => $type->getThirdPartySetting('toc_js', 'back_to_toc_classes'),
      'smooth_scrolling' => $type->getThirdPartySetting('toc_js', 'smooth_scrolling'),
      'scroll_to_offset' => $type->getThirdPartySetting('toc_js', 'scroll_to_offset'),
      'highlight_on_scroll' => $type->getThirdPartySetting('toc_js', 'highlight_on_scroll'),
      'highlight_offset' => $type->getThirdPartySetting('toc_js', 'highlight_offset'),
      'sticky' => $type->getThirdPartySetting('toc_js', 'sticky'),
      'sticky_offset' => $type->getThirdPartySetting('toc_js', 'sticky_offset'),
      'toc_container' => $type->getThirdPartySetting('toc_js', 'toc_container'),
      'ajax_page_updates' => $type->getThirdPartySetting('toc_js', 'ajax_page_updates'),
      'observable_selector' => $type->getThirdPartySetting('toc_js', 'observable_selector'),
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function build() {
    if ($node = $this->currentRouteMatch->getParameter('node')) {
      /** @var \Drupal\node\NodeTypeInterface $node_type */
      $node_type = $node->__get('type')->entity;
      $toc_override = $node_type->getThirdPartySetting('toc_js_per_node', 'override', 0);
      $toc_override_default = $node_type->getThirdPartySetting('toc_js_per_node', 'override_default', 1);

      // Support toc_js per-node feature.
      if ($node->hasField('toc_js_active') && $toc_override) {
        // Use default override value if not set.
        if ($node->toc_js_active->value == NULL) {
          $node->toc_js_active->value = $toc_override_default;
        }
        if (empty($node->toc_js_active->value)) {
          return [];
        }
      }

      $toc_js_settings = $node_type->getThirdPartySettings('toc_js');
      if (empty($toc_js_settings['toc_js_active'])) {
        // Toc has been disabled but the extra field hasn't been disabled.
        return [];
      }

      if ($this->configuration['override_nodetype']) {
        $toc_settings = $this->configuration;
        return $this->buildToc($toc_settings);
      }
      else {
        $toc_settings = $this->getConfigurationFromNodeType($node_type);
        return $this->buildToc($toc_settings);
      }

    }
    return parent::build();
  }

}
