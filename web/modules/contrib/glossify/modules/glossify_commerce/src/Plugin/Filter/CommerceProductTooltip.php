<?php

namespace Drupal\glossify_commerce\Plugin\Filter;

use Drupal\commerce_product\Entity\ProductType;
use Drupal\Core\Database\Connection;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Logger\LoggerChannelFactoryInterface;
use Drupal\Core\Path\CurrentPathStack;
use Drupal\Core\Render\Renderer;
use Drupal\filter\FilterProcessResult;
use Drupal\glossify\GlossifyBase;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Filter to find and process found taxonomy terms in the fields value.
 *
 * @Filter(
 *   id = "glossify_commerce_product",
 *   title = @Translation("Glossify: Tooltips with commerce product"),
 *   type = Drupal\filter\Plugin\FilterInterface::TYPE_TRANSFORM_IRREVERSIBLE,
 *   settings = {
 *     "case_sensitivity" = TRUE,
 *     "first_only" = FALSE,
 *     "ignore_tags" = "",
 *     "glossify_type" = "tooltips",
 *     "tooltip_truncate" = FALSE,
 *     "bundles" = NULL,
 *     "urlpattern" = "/product/[id]",
 *   },
 *   weight = -10
 * )
 */
final class CommerceProductTooltip extends GlossifyBase {

  /**
   * The database connection.
   *
   * @var \Drupal\Core\Database\Connection
   */
  protected $database;

  /**
   * Class constructor.
   *
   * @param array $configuration
   *   A configuration array containing information about the plugin instance.
   * @param string $plugin_id
   *   The plugin ID for the plugin instance.
   * @param mixed $plugin_definition
   *   The plugin implementation definition.
   * @param \Drupal\Core\Logger\LoggerChannelFactoryInterface $logger_factory
   *   The logger factory.
   * @param \Drupal\Core\Render\Renderer $renderer
   *   The renderer service.
   * @param \Drupal\Core\Path\CurrentPathStack $currentPath
   *   The current path service.
   * @param \Drupal\Core\Database\Connection $database
   *   The database connection.
   */
  public function __construct(
    array $configuration,
    $plugin_id,
    $plugin_definition,
    LoggerChannelFactoryInterface $logger_factory,
    Renderer $renderer,
    CurrentPathStack $currentPath,
    Connection $database,
  ) {
    parent::__construct(
      $configuration,
      $plugin_id,
      $plugin_definition,
      $logger_factory,
      $renderer,
      $currentPath
    );

    $this->database = $database;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(
    ContainerInterface $container,
    array $configuration,
    $plugin_id,
    $plugin_definition,
  ) {
    return new static(
      $configuration,
      $plugin_id,
      $plugin_definition,
      $container->get('logger.factory'),
      $container->get('renderer'),
      $container->get('path.current'),
      $container->get('database')
    );
  }

  /**
   * {@inheritdoc}
   */
  public function settingsForm(array $form, FormStateInterface $form_state) {
    $productTypeOptions = [];

    // Get all Product types:
    $productTypes = ProductType::loadMultiple();
    foreach ($productTypes as $id => $productType) {
      $productTypeOptions[$id] = $productType->label();
    }

    $form['case_sensitivity'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Case sensitive'),
      '#description' => $this->t('Whether or not the match is case sensitive.'),
      '#default_value' => $this->settings['case_sensitivity'],
    ];
    $form['first_only'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('First match only'),
      '#description' => $this->t('Match and link only the first occurance per field.'),
      '#default_value' => $this->settings['first_only'],
    ];
    $form['ignore_tags'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Ignore tags'),
      '#description' => $this->t('A comma-separated list of tags to ignore (e.g.: <code>h1,h2,div,strong</code>).'),
      '#default_value' => $this->settings['ignore_tags'] ?? "",
    ];
    $form['glossify_type'] = [
      '#type' => 'radios',
      '#title' => $this->t('Type'),
      '#required' => TRUE,
      '#options' => [
        'tooltips' => $this->t('Tooltips'),
        'links' => $this->t('Links'),
        'tooltips_links' => $this->t('Tooltips and links'),
      ],
      '#description' => $this->t('How to show matches in content. Description as HTML5 tooltip (abbr element), link to description or both.'),
      '#default_value' => $this->settings['glossify_type'],
    ];
    $form['tooltip_truncate'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Truncate tooltip'),
      '#description' => $this->t('Whether to truncate tooltip after 300 characters.'),
      '#default_value' => $this->settings['tooltip_truncate'],
      '#states' => [
        'visible' => [
          ':input[name="filters[glossify_commerce][settings][type]"]' => [
            ['value' => 'tooltips'],
            'or',
            ['value' => 'tooltips_links'],
          ],
        ],
      ],
    ];
    $form['bundles'] = [
      '#type' => 'checkboxes',
      '#multiple' => TRUE,
      '#element_validate' => [
        [
          get_class($this),
          'validateProductBundles',
        ],
      ],
      '#title' => $this->t('Commerce Product types'),
      '#description' => $this->t('Select the source node types you want to use titles from to link to their node page.'),
      '#options' => $productTypeOptions,
      '#default_value' => explode(';', $this->settings['bundles'] ?? ''),
    ];
    $form['urlpattern'] = [
      '#type' => 'textfield',
      '#title' => $this->t('URL pattern'),
      '#description' => $this->t('Url pattern, used for linking matched words. Accepts "[id]" as token. Example: "/node/[id]"'),
      '#default_value' => $this->settings['urlpattern'],
    ];
    return $form;
  }

  /**
   * Validation callback for bundles.
   *
   * Make the field required if the filter is enabled.
   *
   * @param array $element
   *   The element being processed.
   * @param \Drupal\Core\Form\FormStateInterface $form_state
   *   The current state of the form.
   * @param array $complete_form
   *   The complete form structure.
   */
  public static function validateProductBundles(array &$element, FormStateInterface $form_state, array &$complete_form) {
    $values = $form_state->getValues();
    // Make node_bundles required if the filter is enabled.
    if (!empty($values['filters']['glossify_commerce_product']['status'])) {
      $field_values = array_filter($values['filters']['glossify_commerce_product']['settings']['bundles']);
      if (empty($field_values)) {
        $element['#required'] = TRUE;
        $form_state->setError($element, t('%field is required.', ['%field' => $element['#title']]));
      }
    }
  }

  /**
   * {@inheritdoc}
   */
  public function process($text, $langcode) {
    $cacheTags = [];

    // Get node types.
    $productBundles = explode(';', $this->settings['bundles']);

    if (count($productBundles)) {
      $terms = [];

      // Get node data.
      $query = $this->database->select('commerce_product_field_data', 'cpfd');
      $query->leftJoin('commerce_product__body', 'cpb', 'cpb.entity_id = cpfd.product_id');
      $query->addField('cpfd', 'product_id', 'id');
      $query->addField('cpfd', 'title', 'name');
      $query->addField('cpfd', 'title', 'name_norm');
      $query->addField('cpb', 'body_value', 'tip');
      $query->condition('cpfd.type', $productBundles, 'IN');
      $query->condition('cpfd.status', 1);
      $query->condition('cpfd.langcode', $langcode);
      $query->condition('cpb.langcode', $langcode);
      $query->orderBy('name_norm', 'DESC');
      // Let other modules alter the current query.
      $query->addTag('glossify_commerce_product_tooltip');
      $results = $query->execute()->fetchAllAssoc('name_norm');

      // Build terms array.
      foreach ($results as $result) {
        // Make name and name_suffix lowercase, it seems not possible in PDO
        // query?
        if (!$this->settings['case_sensitivity']) {
          $result->name_norm = mb_strtolower($result->name_norm);
        }
        $terms[$result->name_norm] = $result;
        $cacheTags[] = 'commerce_product:' . $result->id;
      }

      // Process text.
      if (count($terms) > 0) {
        $text = $this->parseTooltipMatch(
          $text,
          $terms,
          $this->settings['case_sensitivity'],
          $this->settings['first_only'],
          $this->settings['glossify_type'],
          $this->settings['tooltip_truncate'],
          $this->settings['urlpattern'],
          $this->settings['ignore_tags'],
          $langcode
        );
      }
    }

    // Prepare result.
    $result = new FilterProcessResult($text);

    // Add cache tag dependency.
    $result->setCacheTags($cacheTags);
    return $result;
  }

  /**
   * {@inheritdoc}
   */
  public function setConfiguration(array $configuration) {
    if (isset($configuration['status'])) {
      $this->status = (bool) $configuration['status'];
    }
    if (isset($configuration['weight'])) {
      $this->weight = (int) $configuration['weight'];
    }
    if (isset($configuration['settings'])) {
      // Workaround for not accepting arrays in config schema.
      if (is_array($configuration['settings']['bundles'])) {
        $bundles = array_filter($configuration['settings']['bundles']);
        $configuration['settings']['bundles'] = implode(';', $bundles);
      }
      $this->settings = (array) $configuration['settings'];
    }
    return $this;
  }

}
