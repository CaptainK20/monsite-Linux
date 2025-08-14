<?php

namespace Drupal\toc_js\Plugin\Block;

use Drupal\Component\Utility\Html;
use Drupal\Component\Utility\Xss;
use Drupal\Core\Block\BlockBase;
use Drupal\Core\Cache\Cache;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Drupal\Core\Template\Attribute;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Provides a 'Toc.js' block.
 *
 * @Block(
 *  id = "toc_js_block",
 *  category = @Translation("Toc js"),
 *  admin_label = @Translation("Toc.js block"),
 * )
 */
class TocJsBlock extends BlockBase implements ContainerFactoryPluginInterface {

  /**
   * Drupal\Core\Routing\CurrentRouteMatch definition.
   *
   * @var \Drupal\Core\Routing\CurrentRouteMatch
   */
  protected $currentRouteMatch;

  /**
   * Constructs a TocJS block.
   *
   * @param array $configuration
   *   A configuration array containing information about the plugin instance.
   * @param string $plugin_id
   *   The plugin ID for the plugin instance.
   * @param mixed $plugin_definition
   *   The plugin implementation definition.
   * @param \Drupal\Core\Routing\CurrentRouteMatch $current_route_match
   *   The current route match service.
   */
  final public function __construct(array $configuration, $plugin_id, $plugin_definition, $current_route_match) {
    parent::__construct($configuration, $plugin_id, $plugin_definition);
    $this->currentRouteMatch = $current_route_match;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
    $current_route_match = $container->get('current_route_match');
    return new static($configuration, $plugin_id, $plugin_definition, $current_route_match);
  }

  /**
   * {@inheritdoc}
   */
  public function defaultConfiguration() {
    return [
      'title' => $this->t('Table of contents'),
      'title_tag' => 'div',
      'title_classes' => 'toc-title,h2',
      'selectors' => 'h2,h3',
      'selectors_minimum' => 0,
      'container' => '.node',
      'prefix' => 'toc',
      'list_type' => 'ul',
      'list_classes' => '',
      'li_classes' => '',
      'inheritable_classes' => '',
      'classes' => '',
      'heading_classes' => '',
      'skip_invisible_headings' => 0,
      'use_heading_html' => 0,
      'collapsible_items' => 0,
      'collapsible_expanded' => 1,
      'back_to_top' => 0,
      'back_to_top_label' => $this->t('Back to top'),
      'back_to_top_selector' => '',
      'heading_focus' => 0,
      'back_to_toc' => 0,
      'back_to_toc_label' => $this->t('Back to table of contents'),
      'back_to_toc_classes' => 'visually-hidden-focusable',
      'smooth_scrolling' => 1,
      'scroll_to_offset' => '',
      'highlight_on_scroll' => 1,
      'highlight_offset' => 0,
      'sticky' => 0,
      'sticky_offset' => 0,
      'toc_container' => '',
      'ajax_page_updates' => 0,
      'observable_selector' => '',
    ] + parent::defaultConfiguration();
  }

  /**
   * Build a Toc.js configuration form with a parent element.
   *
   * @param array $form
   *   The form to build.
   * @param string|null $name
   *   The name for the parent element.
   */
  protected function blockFormToc(array &$form, ?string $name = NULL): void {

    $parent = empty($name) ? '' : '[' . $name . ']';

    $form['title'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Title'),
      '#description' => $this->t('The text to use as a title for the table of contents.'),
      '#default_value' => $this->configuration['title'],
      '#maxlength' => 255,
    ];

    $form['title_tag'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Title HTML tag'),
      '#description' => $this->t('The HTML tag to use for the table of contents title (defaults to div).'),
      '#default_value' => $this->configuration['title_tag'],
    ];

    $form['title_classes'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Title CSS classes'),
      '#description' => $this->t('List of CSS classes to apply to the table of contents title tag (comma separated).'),
      '#default_value' => $this->configuration['title_classes'],
    ];

    $form['selectors'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Selectors'),
      '#description' => $this->t('Comma-separated list of selectors for elements to be used as headings.'),
      '#default_value' => $this->configuration['selectors'],
      '#maxlength' => 2048,
    ];

    $form['selectors_minimum'] = [
      '#type' => 'number',
      '#title' => $this->t('Minimum elements'),
      '#description' => $this->t('Set a minimum of elements to display the toc. Set 0 to always display the TOC.'),
      '#default_value' => $this->configuration['selectors_minimum'],
    ];

    $form['container'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Container'),
      '#description' => $this->t('Element to find all selectors in.'),
      '#default_value' => $this->configuration['container'],
      '#maxlength' => 2048,
    ];

    $form['prefix'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Prefix'),
      '#description' => $this->t('Prefix for anchor tags and ToC elements default class names.'),
      '#default_value' => $this->configuration['prefix'],
    ];

    $form['list_type'] = [
      '#type' => 'select',
      '#title' => $this->t('List type'),
      '#description' => $this->t('Select the list type to use.'),
      '#default_value' => $this->configuration['list_type'],
      '#options' => [
        'ul' => $this->t('Unordered HTML list (ul)'),
        'ol' => $this->t('Ordered HTML list (ol)'),
      ],
    ];

    $form['list_classes'] = [
      '#type' => 'textfield',
      '#title' => $this->t('ToC list CSS classes'),
      '#description' => $this->t('List of CSS classes to apply to the table of contents list UL/OL tag (space separated).'),
      '#default_value' => $this->configuration['list_classes'],
      '#maxlength' => 2048,
    ];

    $form['li_classes'] = [
      '#type' => 'textfield',
      '#title' => $this->t('ToC list elements CSS classes'),
      '#description' => $this->t('List of CSS classes to apply to the table of contents items LI tags (space separated).'),
      '#default_value' => $this->configuration['li_classes'],
      '#maxlength' => 2048,
    ];

    $form['inheritable_classes'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Inheritable CSS classes from headings'),
      '#description' => $this->t('Comma-separated list of CSS classes from headings that should be applied to the table of contents LI elements.'),
      '#default_value' => $this->configuration['inheritable_classes'],
      '#maxlength' => 2048,
    ];

    $form['classes'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Table of contents CSS classes'),
      '#description' => $this->t('List of CSS classes to apply to the table of contents DIV tag (comma separated).'),
      '#default_value' => $this->configuration['classes'],
    ];

    $form['heading_classes'] = [
      '#type' => 'textfield',
      '#title' => $this->t('CSS classes to add to headings'),
      '#description' => $this->t('List of CSS classes to apply to the page headings (space separated).  Can be used to apply a scroll-top-margin for example.'),
      '#default_value' => $this->configuration['heading_classes'],
    ];

    $form['skip_invisible_headings'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Skip invisible headings'),
      '#description' => $this->t('Do not add invisible headings to the ToC.'),
      '#default_value' => $this->configuration['skip_invisible_headings'],
    ];

    $form['use_heading_html'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Use heading html'),
      '#description' => $this->t('Use the heading html content for the ToC links instead of the text content.'),
      '#default_value' => $this->configuration['use_heading_html'],
    ];

    $form['collapsible_items'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Enable collapsible toc items (experimental)'),
      '#description' => $this->t('Allows toc items with children to be made collapsible.'),
      '#default_value' => $this->configuration['collapsible_items'],
    ];

    $form['collapsible_expanded'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Show collapsible items expanded by default  (experimental)'),
      '#description' => $this->t('Collapsible items will be shown expanded by default, hidden otherwise.'),
      '#default_value' => $this->configuration['collapsible_expanded'],
      '#states' => [
        'visible' => [
          ':input[name="settings' . $parent . '[collapsible_items]"]' => ['checked' => TRUE],
        ],
      ],
    ];

    $form['back_to_top'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Show "back to top" links'),
      '#description' => $this->t('Display "back to top" links next to headings.'),
      '#default_value' => $this->configuration['back_to_top'],
    ];

    $form['back_to_top_label'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Back to top link label'),
      '#description' => $this->t('The label to use for "back to top" links, span HTML tag is allowed.<br>WCAG: remember to define a visually-hidden/sr-only span label if you are using a CSS icon.'),
      '#default_value' => $this->configuration['back_to_top_label'] ?? 'Back to top',
      '#states' => [
        'visible' => [
          ':input[name="settings' . $parent . '[back_to_top]"]' => ['checked' => TRUE],
        ],
      ],
    ];

    $form['back_to_top_selector'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Back to top heading filter selector'),
      '#description' => $this->t('Allows to filter the headings for which we want to display a back to top link.'),
      '#default_value' => $this->configuration['back_to_top_selector'],
      '#maxlength' => 2048,
      '#states' => [
        'visible' => [
          ':input[name="settings' . $parent . '[back_to_top]"]' => ['checked' => TRUE],
        ],
      ],
    ];

    $form['heading_focus'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Heading focus'),
      '#description' => $this->t('Set focus on corresponding heading when selected.'),
      '#default_value' => $this->configuration['heading_focus'],
    ];

    $form['back_to_toc'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Show "back to toc" links'),
      '#description' => $this->t('Display "back to toc" links next to headings.'),
      '#default_value' => $this->configuration['back_to_toc'],
    ];

    $form['back_to_toc_label'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Back to toc link label'),
      '#description' => $this->t('The label to use for "back to toc" links, span HTML tag is allowed.<br>WCAG: remember to define a visually-hidden/sr-only span label if you are using a CSS icon.'),
      '#default_value' => $this->configuration['back_to_toc_label'],
      '#states' => [
        'visible' => [
          ':input[name="settings' . $parent . '[back_to_toc]"]' => ['checked' => TRUE],
        ],
      ],
    ];

    $form['back_to_toc_classes'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Back to toc link CSS classes'),
      '#description' => $this->t('The CSS classes to add to the back to ToC link label (space separated).'),
      '#default_value' => $this->configuration['back_to_toc_classes'],
      '#states' => [
        'visible' => [
          ':input[name="settings' . $parent . '[back_to_toc]"]' => ['checked' => TRUE],
        ],
      ],
    ];

    $form['smooth_scrolling'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Smooth scrolling'),
      '#description' => $this->t('Enable or disable smooth scrolling on click.'),
      '#default_value' => $this->configuration['smooth_scrolling'],
    ];

    $form['scroll_to_offset'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Scroll offset'),
      '#description' => $this->t('Offset in CSS units to apply when scrolling to heading, ex: 10px or 2rem. You can also use the var syntax, ex: var(--toc-scroll-offset, 2rem).'),
      '#default_value' => $this->configuration['scroll_to_offset'],
      '#size' => 50,
    ];

    $form['highlight_on_scroll'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Highlight on scroll'),
      '#description' => $this->t('Add a class to the heading that is currently in focus.'),
      '#default_value' => $this->configuration['highlight_on_scroll'],
    ];

    $form['highlight_offset'] = [
      '#type' => 'number',
      '#title' => $this->t('Highlight offset'),
      '#description' => $this->t('Offset to trigger the next headline.'),
      '#default_value' => $this->configuration['highlight_offset'],
      // Highlight offset is not used anymore.
      '#access' => FALSE,
      '#states' => [
        'visible' => [
          ':input[name="settings' . $parent . '[highlight_on_scroll]"]' => ['checked' => TRUE],
        ],
      ],
    ];

    $form['sticky'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Sticky'),
      '#description' => $this->t('Stick the toc on window scroll.'),
      '#default_value' => $this->configuration['sticky'],
    ];

    $form['sticky_offset'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Sticky offset'),
      '#description' => $this->t('Offset in CSS units to apply when the toc is sticky, ex: 10px or 2rem. You can also use the var syntax, ex: var(--toc-sticky-offset, 2rem).'),
      '#default_value' => $this->configuration['sticky_offset'],
      '#size' => 50,
      '#states' => [
        'visible' => [
          ':input[name="settings' . $parent . '[sticky]"]' => ['checked' => TRUE],
        ],
      ],
    ];

    $form['toc_container'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Toc container selector'),
      '#description' => $this->t('Closest parent of the toc element to use for visibility and stickiness, defaults to using the toc element if empty.'),
      '#default_value' => $this->configuration['toc_container'],
      '#maxlength' => 2048,
    ];

    $form['ajax_page_updates'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Ajax page updates handling (Experimental)'),
      '#description' => $this->t('Refresh the table of contents when the page is being updated using Ajax.'),
      '#default_value' => $this->configuration['ajax_page_updates'],
    ];

    $form['observable_selector'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Custom observable container selector (Experimental)'),
      '#description' => $this->t('The selector of the container we wish to monitor for Ajax page updates, leave empty to use the default container selector.'),
      '#default_value' => $this->configuration['observable_selector'],
      '#maxlength' => 2048,
      '#states' => [
        'visible' => [
          ':input[name="settings' . $parent . '[ajax_page_updates]"]' => ['checked' => TRUE],
        ],
      ],
    ];

  }

  /**
   * {@inheritdoc}
   */
  public function blockForm($form, FormStateInterface $form_state) {
    $this->blockFormToc($form);
    return $form;
  }

  /**
   * Get the ToC configuration name to use with form state.
   *
   * @param string $name
   *   The name of the configuration item.
   *
   * @return string|array
   *   The name to use with form state.
   */
  protected function getTocName(string $name): string|array {
    return $name;
  }

  /**
   * Process block Toc.js configuration submit.
   *
   * @param array $form
   *   The form to process.
   * @param \Drupal\Core\Form\FormStateInterface $form_state
   *   The form state to get the submitted values from.
   */
  protected function blockSubmitToc($form, FormStateInterface $form_state): void {
    $this->configuration['title'] = $form_state->getValue($this->getTocName('title'));
    $this->configuration['title_tag'] = $form_state->getValue($this->getTocName('title_tag'));
    $this->configuration['title_classes'] = $form_state->getValue($this->getTocName('title_classes'));
    $this->configuration['selectors'] = $form_state->getValue($this->getTocName('selectors'));
    $this->configuration['selectors_minimum'] = $form_state->getValue($this->getTocName('selectors_minimum'));
    $this->configuration['container'] = $form_state->getValue($this->getTocName('container'));
    $this->configuration['prefix'] = $form_state->getValue($this->getTocName('prefix'));
    $this->configuration['list_type'] = $form_state->getValue($this->getTocName('list_type'));
    $this->configuration['list_classes'] = $form_state->getValue($this->getTocName('list_classes'));
    $this->configuration['li_classes'] = $form_state->getValue($this->getTocName('li_classes'));
    $this->configuration['inheritable_classes'] = $form_state->getValue($this->getTocName('inheritable_classes'));
    $this->configuration['classes'] = $form_state->getValue($this->getTocName('classes'));
    $this->configuration['heading_classes'] = $form_state->getValue($this->getTocName('heading_classes'));
    $this->configuration['skip_invisible_headings'] = $form_state->getValue($this->getTocName('skip_invisible_headings'));
    $this->configuration['use_heading_html'] = $form_state->getValue($this->getTocName('use_heading_html'));
    $this->configuration['collapsible_items'] = $form_state->getValue($this->getTocName('collapsible_items'));
    $this->configuration['collapsible_expanded'] = $form_state->getValue($this->getTocName('collapsible_expanded'));
    $this->configuration['back_to_top'] = $form_state->getValue($this->getTocName('back_to_top'));
    $this->configuration['back_to_top_label'] = $form_state->getValue($this->getTocName('back_to_top_label'));
    $this->configuration['back_to_top_selector'] = $form_state->getValue($this->getTocName('back_to_top_selector'));
    $this->configuration['heading_focus'] = $form_state->getValue($this->getTocName('heading_focus'));
    $this->configuration['back_to_toc'] = $form_state->getValue($this->getTocName('back_to_toc'));
    $this->configuration['back_to_toc_label'] = $form_state->getValue($this->getTocName('back_to_toc_label'));
    $this->configuration['back_to_toc_classes'] = $form_state->getValue($this->getTocName('back_to_toc_classes'));
    $this->configuration['smooth_scrolling'] = $form_state->getValue($this->getTocName('smooth_scrolling'));
    $this->configuration['scroll_to_offset'] = $form_state->getValue($this->getTocName('scroll_to_offset'));
    $this->configuration['highlight_on_scroll'] = $form_state->getValue($this->getTocName('highlight_on_scroll'));
    $this->configuration['highlight_offset'] = $form_state->getValue($this->getTocName('highlight_offset'));
    $this->configuration['sticky'] = $form_state->getValue($this->getTocName('sticky'));
    $this->configuration['sticky_offset'] = $form_state->getValue($this->getTocName('sticky_offset'));
    $this->configuration['toc_container'] = $form_state->getValue($this->getTocName('toc_container'));
    $this->configuration['ajax_page_updates'] = $form_state->getValue($this->getTocName('ajax_page_updates'));
    $this->configuration['observable_selector'] = $form_state->getValue($this->getTocName('observable_selector'));
  }

  /**
   * {@inheritdoc}
   */
  public function blockSubmit($form, FormStateInterface $form_state) {
    $this->blockSubmitToc($form, $form_state);
  }

  /**
   * List of configuration items to add as attributes in the toc element.
   *
   * The switch from exclude to include was required as some external modules
   * were modifying the settings by adding some custom options we didn't want
   * to see in the generated HTML.
   *
   * @return string[]
   *   The list of configuration item names to not add as attributes.
   */
  protected function getSettingsToIncludeAsAttributes(): array {
    return [
      'selectors',
      'selectors_minimum',
      'container',
      'prefix',
      'list_type',
      'list_classes',
      'li_classes',
      'heading_classes',
      'skip_invisible_headings',
      'use_heading_html',
      'collapsible_items',
      'collapsible_expanded',
      'back_to_top',
      'back_to_top_selector',
      'heading_focus',
      'back_to_toc',
      'back_to_toc_classes',
      'smooth_scrolling',
      'scroll_to_offset',
      'highlight_on_scroll',
      'highlight_offset',
      'sticky',
      'sticky_offset',
      'toc_container',
      'ajax_page_updates',
      'observable_selector',
    ];
  }

  /**
   * Build the render array for the toc element.
   *
   * @param array $settings
   *   The configuration of the toc to render.
   *
   * @return array
   *   The resulting render array.
   */
  protected function buildToc(array $settings) {
    $build = [];

    // Lambda function to clean css identifiers.
    $cleanCssIdentifier = function ($value) {
      return Html::cleanCssIdentifier(trim($value));
    };

    // toc-js class is used to initialize the toc. Additional classes are added
    // from the configuration.
    $classes = array_map($cleanCssIdentifier, array_merge(['toc-js'], explode(',', $settings['classes'])));
    $attributes = new Attribute(['class' => $classes]);
    $toc_id = Html::getUniqueId($cleanCssIdentifier($this->pluginId));
    $attributes->setAttribute('id', $toc_id);
    $title_id = $toc_id . '__title';
    $titleClasses = empty($settings['title_classes']) ? 'h2' : $settings['title_classes'];
    $titleClassesArray = array_map($cleanCssIdentifier, array_merge(['toc-title'], explode(',', $titleClasses)));
    $title_attributes = new Attribute([
      'id' => $title_id,
      'class' => $titleClassesArray,
    ]);

    $include_as_data_attributes = $this->getSettingsToIncludeAsAttributes();
    foreach ($settings as $name => $setting) {
      if (!in_array($name, $include_as_data_attributes)) {
        continue;
      }
      $data_name = 'data-' . $cleanCssIdentifier($name);
      $attributes->setAttribute($data_name, Xss::filter((string) $setting, []));
    }

    // Provide some entity context if available.
    $entity = NULL;
    if ($node = $this->currentRouteMatch->getParameter('node')) {
      $entity = $node;
    }
    /** @var \Drupal\taxonomy\TermInterface $taxonomy_term */
    elseif ($taxonomy_term = $this->currentRouteMatch->getParameter('taxonomy_term')) {
      $entity = $taxonomy_term;
    }

    $build['toc_js'] = [
      '#theme' => 'toc_js',
      '#title' => Xss::filter($settings['title'], ['span']),
      '#tag' => Xss::filter($settings['title_tag'] ?: 'div', []),
      '#title_attributes' => $title_attributes,
      '#attributes' => $attributes,
      '#entity' => $entity,
      '#attached' => [
        'library' => [
          'toc_js/toc',
        ],
        'drupalSettings' => [
          'toc_js' => [
            $toc_id => [
              'back_to_top_label' => Xss::filter((string) $settings['back_to_top_label'] ?? '', ['span']),
              'back_to_toc_label' => Xss::filter((string) $settings['back_to_toc_label'] ?? '', ['span']),
            ],
          ],
        ],
      ],
    ];

    return $build;
  }

  /**
   * {@inheritdoc}
   */
  public function build() {
    $toc_settings = $this->configuration;
    return $this->buildToc($toc_settings);
  }

  /**
   * {@inheritdoc}
   */
  public function getCacheTags() {
    /** @var \Drupal\node\NodeInterface $node */
    if ($node = $this->currentRouteMatch->getParameter('node')) {
      return Cache::mergeTags(parent::getCacheTags(), $node->getCacheTags());
    }
    /** @var \Drupal\taxonomy\TermInterface $taxonomy_term */
    elseif ($taxonomy_term = $this->currentRouteMatch->getParameter('taxonomy_term')) {
      return Cache::mergeTags(parent::getCacheTags(), $taxonomy_term->getCacheTags());
    }
    else {
      return parent::getCacheTags();
    }
  }

  /**
   * {@inheritdoc}
   */
  public function getCacheContexts() {
    return Cache::mergeContexts(parent::getCacheContexts(), ['url.path']);
  }

}
