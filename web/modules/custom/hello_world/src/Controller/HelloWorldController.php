<?php

namespace Drupal\hello_world\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\hello_world\HelloWorldSalutation;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Controller for the salutation message.
 */

 class HelloWorldController extends ControllerBase {


  /**
   * @var \Drupal\hello_world\HelloWorldSalutation
   */

  protected $salutation;

  /**
   * HelloWorldController constructor.
   * 
   * @papram \Drupal\hello_world\HelloWorldSalutation $salutation
   */

   public function __construct(HelloWorldSalutation $salutation)
   {
    $this->salutation = $salutation;
   }

   /**
    * {@inheritdoc}
    */

    public static function create(ContainerInterface $container)
    {
      return new static(
        $container->get('hello_world.salutation')
      );
    }

  /**
   * Hello World.
   * 
   * @return array
   * Our message.
   */
  public function helloWorld() {
    return [
      // '#markup' => $this->t('Hello World'),
      '#markup' => $this->salutation->getSalutation(),
      '#theme' => 'image',
      '#uri' => 'public://test.jpeg',
      '#alt' => $this->t('Test image'),
    ];
  }
 }