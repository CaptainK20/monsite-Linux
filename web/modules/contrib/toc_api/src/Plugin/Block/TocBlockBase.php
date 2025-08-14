<?php

namespace Drupal\toc_api\Plugin\Block;

use Drupal\Core\Access\AccessResult;
use Drupal\Core\Access\AccessResultInterface;
use Drupal\Core\Block\BlockBase;
use Drupal\Core\Entity\EntityTypeManagerInterface;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Drupal\Core\Routing\RouteMatchInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\node\NodeInterface;
use Drupal\toc_api\TocInterface;
use Drupal\toc_api\TocManagerInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Provides a base block which displays the current TOC module's TOC in a block.
 */
abstract class TocBlockBase extends BlockBase implements ContainerFactoryPluginInterface {

  /**
   * The route match.
   *
   * @var \Drupal\Core\Routing\RouteMatchInterface
   */
  protected RouteMatchInterface $routeMatch;

  /**
   * The entity type manager.
   *
   * @var \Drupal\Core\Entity\EntityTypeManagerInterface
   */
  protected EntityTypeManagerInterface $entityTypeManager;

  /**
   * The TOC manager.
   *
   * @var \Drupal\toc_api\TocManagerInterface
   */
  protected TocManagerInterface $tocManager;

  /**
   * Creates a LocalActionsBlock instance.
   *
   * @param array $configuration
   *   A configuration array containing information about the plugin instance.
   * @param string $plugin_id
   *   The plugin_id for the plugin instance.
   * @param mixed $plugin_definition
   *   The plugin implementation definition.
   * @param \Drupal\Core\Routing\RouteMatchInterface $route_match
   *   The route match.
   * @param \Drupal\Core\Entity\EntityTypeManagerInterface $entity_type_manager
   *   The entity type manager.
   * @param \Drupal\toc_api\TocManagerInterface $toc_manager
   *   The TOC manager.
   */
  final public function __construct(array $configuration, $plugin_id, $plugin_definition, RouteMatchInterface $route_match, EntityTypeManagerInterface $entity_type_manager, TocManagerInterface $toc_manager) {
    parent::__construct($configuration, $plugin_id, $plugin_definition);
    $this->routeMatch = $route_match;
    $this->entityTypeManager = $entity_type_manager;
    $this->tocManager = $toc_manager;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition): static {
    return new static(
      $configuration,
      $plugin_id,
      $plugin_definition,
      $container->get('current_route_match'),
      $container->get('entity_type.manager'),
      $container->get('toc_api.manager')
    );
  }

  /**
   * {@inheritdoc}
   */
  public function build(): array {
    $toc = $this->getCurrentToc();

    // Build the TOC.
    $options = $toc->getOptions();
    $build = [
      '#theme' => 'toc_' . $options['template'],
      '#toc' => $toc,
    ];

    // Set custom title.
    if ($title = $toc->getTitle()) {
      $build['#title'] = $title;
    }

    return $build;
  }

  /**
   * Get the current request TOC object instance.
   *
   * @return \Drupal\toc_api\TocInterface
   *   A TOC object.
   */
  protected function getCurrentToc(): TocInterface {
    // Get the new TOC instance using the module name.
    return $this->tocManager->getToc($this->getCurrentTocId());
  }

  /**
   * Get the current requests TOC object instance ID.
   *
   * Most TOC modules should use just the the modules name space which
   * can all be used as this block's plugin ID.
   *
   * @return string
   *   The current TOC block's plugin ID.
   */
  protected function getCurrentTocId(): string {
    return $this->pluginId;
  }

  /**
   * {@inheritdoc}
   */
  public function getCacheContexts(): array {
    return ['route'];
  }

  /**
   * {@inheritdoc}
   */
  public function getCacheTags(): array {
    $node = $this->getCurrentNode();
    return ($node) ? ['node:' . $node->id()] : [];
  }

  /**
   * Load the node associated with the current request.
   *
   * @return \Drupal\node\NodeInterface|null
   *   A node entity, or NULL if no node is found.
   */
  protected function getCurrentNode(): ?NodeInterface {
    switch ($this->routeMatch->getRouteName()) {
      // Look at the request's node revision.
      case 'node.revision_show':
        $node_storage = $this->entityTypeManager->getStorage('node');
        $node = $node_storage->loadRevision($this->routeMatch->getParameter('node_revision'));
        return ($node instanceof NodeInterface) ? $node : NULL;

      // Look at the request's node preview.
      case 'entity.node.preview':
        return $this->routeMatch->getParameter('node_preview');

      // Look at the request's node.
      case 'entity.node.canonical':
        return $this->routeMatch->getParameter('node');
    }

    return NULL;
  }

  /**
   * {@inheritdoc}
   */
  protected function blockAccess(AccountInterface $account): AccessResultInterface {
    // Get the new TOC instance and see if it is visible and should be
    // displayed in a block.
    $toc = $this->tocManager->getToc($this->getCurrentTocId());

    if (!$toc || !$toc->isVisible() || !$toc->isBlock()) {
      return AccessResult::forbidden();
    }
    else {
      return AccessResult::allowed();
    }
  }

}
