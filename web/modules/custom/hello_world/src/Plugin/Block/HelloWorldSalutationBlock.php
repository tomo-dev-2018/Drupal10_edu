<?php

namespace Drupal\hello_world\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\hello_world\HelloWorldSalutation;
/**
 * @Block(
 *   id = "hello_world_salutation_block",
 *   admin_label = @Translation("Hello world salutation"),
 * )
 */

class HelloWorldSalutationBlock extends BlockBase implements ContainerFactoryPluginInterface
{

  /**
   * The salutation service.
   *
   * @var \Drupal\hello_world\HelloWorldSalutation
   */
  protected $salutation;

  /**
   * Constructs a HelloWorldSalutationBlock instance.
   *
   * @param array $configuration
   *   A configuration array containing information about the plugin instance.
   * @param string $plugin_id
   *   The plugin_id for the plugin instance.
   * @param mixed $plugin_definition
   *   The plugin implementation definition.
   * @param \Drupal\hello_world\HelloWorldSalutation $salutation
   *   The salutation service.
   */
  public function __construct(array $configuration, $plugin_id, $plugin_definition, HelloWorldSalutation $salutation)
  {
    parent::__construct($configuration, $plugin_id, $plugin_definition);
    $this->salutation = $salutation;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition)
  {
    return new static(
      // Pass along configuration values from context into our block plugin configuration. 
      // This allows us to have different configurations per block instance. 
      // See https://www.drupal.org/docs/8/api/plugin-api/plugin-contexts-passing-data-into-a-plugin for more info on contexts. 
      // In this case we don't have any context defined so we just pass an empty array. 
      [],
      // The ID of our custom block plugin. 
      'hello_world_salutation_block',
      // The definition array defined by our annotation above. 
      ['label' => t('Hello world salutation')],
      // Pass along any services we want to use in our block plugin as arguments for our constructor. 
      // In this case we only need one service: hello_world.salutation. 
      // See https://www.drupal.org/docs/8/api/services-and-dependency-injection/services-and-dependency-injection-in-drupal-8 for more info on services and dependency injection. 
      // You can find a list of available services at /admin/reports/services on your site or by using drush services:list command. 
      // Alternatively you can use \Drupal::service('service.name') method to get any service inside your class methods but this is not recommended as it makes your code harder to test and maintain. 
      $container->get('hello_world.salutation')
    );
  }

  /**
   * {@inheritdoc}
   */
  public function build()
  {
    return [
      '#markup' => $this->salutation->getSalutation(),
    ];
  }
}