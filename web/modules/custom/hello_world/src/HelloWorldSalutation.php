<?php

// namespace Drupal\hello_world;

// use Drupal\Core\StringTranslation\StringTranslationTrait;

// /**
//  * Prepares the salutation to the world.
//  */

//  class HelloWorldSalutation {

//   use StringTranslationTrait;
 

//  /**
//   * Returns the salutation
//   */

//   public function getSalutation() {

//     $time = new \DateTime();
//     if ((int) $time->format('G') >= 00 && (int) $time->format('G') < 12) {
//       return $this->t('Good morning world');
//     }
//     $time = new \DateTime();
//     if ((int) $time->format('G') >= 12 && (int) $time->format('G') < 18) {
//       return $this->t('Good evening world');
//     }
//     $time = new \DateTime();
//     if ((int) $time->format('G') >= 18) {
//       return $this->t('Good night world');
//     }
//   }
//    }


namespace Drupal\hello_world;

use Drupal\Core\StringTranslation\StringTranslationTrait;
use Drupal\Core\Datetime\DateFormatterInterface;
use Drupal\Core\Config\ConfigFactoryInterface;

/**
 * Prepares the salutation to the world.
 */
class HelloWorldSalutation {

  use StringTranslationTrait;

  /**
   * The date formatter service.
   *
   * @var \Drupal\Core\Datetime\DateFormatterInterface
   */
  protected $dateFormatter;

  /**
   * The config factory service.
   *
   * @var \Drupal\Core\Config\ConfigFactoryInterface
   */
  protected $configFactory;

  /**
   * Constructs a HelloWorldSalutation object.
   *
   * @param \Drupal\Core\Config\ConfigFactoryInterface $config_factory
   *   The config factory service.
   * @param \Drupal\Core\Datetime\DateFormatterInterface $date_formatter
   *   The date formatter service.
   */
  public function __construct(ConfigFactoryInterface $config_factory, DateFormatterInterface $date_formatter) {
    $this->configFactory = $config_factory;
    $this->dateFormatter = $date_formatter;
  }

  /**
   * Returns the salutation.
   */
  public function getSalutation() {
    $timezone = $this->configFactory->get('system.date')->get('timezone.default');
    $time = $this->dateFormatter->format(time(), 'custom', 'H', $timezone);
 
    $greeting = '';

    switch ((int) $time) {
      case ($time >= 0 && $time < 12):
        $greeting = $this->t('Good morning world.');
        break;
      case ($time >= 12 && $time < 18):
        $greeting = $this->t('Good afternoon world.');
        break;
      case ($time >= 18):
        $greeting = $this->t('Good evening world.');
        break;
    }
    return $greeting . ' ' . $this->t('The current time is @time', ['@time' => $this->getCurrentTime($timezone)]);

  }

  /**
   * Returns the current time.
   */
  protected function getCurrentTime($timezone) {
    return $this->dateFormatter->format(time(), 'custom', 'h:i A', $timezone);
  }

}

