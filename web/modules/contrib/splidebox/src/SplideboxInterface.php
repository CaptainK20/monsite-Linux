<?php

namespace Drupal\splidebox;

use Drupal\splide\Entity\Splide;
use Drupal\splide\Form\SplideAdminInterface;
use Drupal\splide\SplideManagerInterface;

/**
 * Defines re-usable services and functions for splidebox plugins.
 */
interface SplideboxInterface extends SplideManagerInterface {

  /**
   * Returns the admin service.
   */
  public function setAdmin(SplideAdminInterface $admin): self;

  /**
   * Implements hook_blazy_attach_alter().
   */
  public function attachAlter(array &$load, array $attach = []): void;

  /**
   * Modifies the splidebox options.
   */
  public function getOptions(Splide $optionset, $count = 0): array;

  /**
   * Returns splide optionset.
   */
  public function getOptionset(array $settings): Splide;

  /**
   * Overrides variables for theme_blazy().
   */
  public function preprocessBlazy(array &$variables): void;

  /**
   * Implements hook_blazy_form_element_alter().
   */
  public function formElementAlter(array &$form, array $definition): void;

  /**
   * Checks if splidebox is applicable.
   */
  public function isApplicable(array &$settings): bool;

  /**
   * Sets splidebox attributes to get the correct gallery either field or views.
   */
  public function toAttributes(array &$settings): void;

}
