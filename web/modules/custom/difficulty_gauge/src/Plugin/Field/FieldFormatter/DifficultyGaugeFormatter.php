<?php

namespace Drupal\difficulty_gauge\Plugin\Field\FieldFormatter;

use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\FormatterBase;
use Drupal\Core\Render\Markup;
use Drupal\Core\Form\FormStateInterface;
use Drupal\taxonomy\Entity\Term;

/**
 * Defines the Difficulty Gauge field formatter.
 *
 * This formatter renders a taxonomy term field as a visual gauge (dots or bars),
 * based on the weight/order of terms in the vocabulary.
 *
 * @FieldFormatter(
 *   id = "difficulty_gauge",
 *   label = @Translation("Difficulty Gauge"),
 *   field_types = {
 *     "entity_reference"
 *   }
 * )
 */
class DifficultyGaugeFormatter extends FormatterBase {

  /**
   * {@inheritdoc}
   *
   * Default settings: 3 levels, and 'dot' as the symbol type.
   */
  public static function defaultSettings() {
    return [
      'max_level' => 3,
      'symbol_type' => 'dot', // dot or bar
    ] + parent::defaultSettings();
  }

  /**
   * {@inheritdoc}
   *
   * Builds the configuration form for the formatter.
   */
  public function settingsForm(array $form, FormStateInterface $form_state) {
    $form['symbol_type'] = [
      '#type' => 'select',
      '#title' => $this->t('Type de symbole'),
      '#options' => [
        'dot' => $this->t('Rond (par défaut)'),
        'bar' => $this->t('Barre horizontale'),
      ],
      '#default_value' => $this->getSetting('symbol_type'),
    ];

    $form['max_level'] = [
      '#type' => 'number',
      '#title' => $this->t('Nombre de niveaux'),
      '#default_value' => $this->getSetting('max_level'),
      '#min' => 1,
      '#max' => 10,
    ];

    return $form;
  }

  /**
   * {@inheritdoc}
   *
   * Display a quick summary in the admin view mode configuration.
   */
  public function settingsSummary() {
    return [
      $this->t('Type de symbole : @type', [
        '@type' => $this->getSetting('symbol_type'),
      ]),
      $this->t('Niveaux max : @max', ['@max' => $this->getSetting('max_level')]),
    ];
  }

  /**
   * {@inheritdoc}
   *
   * Renders the field value as a gauge (dots or bars), based on the term's weight order.
   */
  public function viewElements(FieldItemListInterface $items, $langcode) {
    $elements = [];
    $max = (int) $this->getSetting('max_level');
    $symbol_type = $this->getSetting('symbol_type');

    foreach ($items as $delta => $item) {
      $term = $item->entity;
      $vocabulary_id = $term->bundle();

      // Charger tous les termes du vocabulaire triés par poids
      $terms = \Drupal::entityTypeManager()
        ->getStorage('taxonomy_term')
        ->loadTree($vocabulary_id);

      $term_ids_ordered = array_map(fn($t) => $t->tid, $terms);
      $level = array_search($term->id(), $term_ids_ordered);
      $level = ($level === false) ? 0 : $level + 1; // niveau commence à 1

      $output = '';
      for ($i = 1; $i <= $max; $i++) {
        $active = $i <= $level ? 'active' : '';
        switch ($symbol_type) {
          case 'bar':
            $output .= "<span class='bar $active'></span>";
            break;
          case 'dot':
          default:
            $output .= "<span class='round $active'></span>";
            break;
        }
      }

      $label = $term->label();
      $elements[$delta] = [
        '#markup' => Markup::create("<div class='difficulty-gauge' title='Niveau : {$label}'>$output</div>"),
        '#attached' => [
          'library' => ['difficulty_gauge/styles'],
        ],
      ];
    }

    return $elements;
  }

}
