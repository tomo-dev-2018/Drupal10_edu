<?php

namespace Drupal\hello_world\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Configuration form definition for the salutation message.
 */

 class SalutationConfigurationForm extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames()
  {
    return ['hello_world.custom_salutation'];
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId()
  {
    return 'hello_world_salutation_configuration_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state)
  {
    $config = $this->config('hello_world.custom_salutation');

    $form['salutation'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Salutation'),
      '#description' => $this->t('Please provide the salutation you want to use.'),
      '#default_value' => $config->get('salutation'),
    );
    $form['salutation2'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Salutation2'),
      '#description' => $this->t('Please provide the salutation2 you want to use.'),
      '#default_value' => $config->get('salutation2'),
    );

    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state)
  {
    $salutation = $form_state->getValue('salutation');
    if (strlen($salutation) > 20) {
      $form_state->setErrorByName('salutation', $this->t('This salutation is too long'));
    }
    $salutation2 = $form_state->getValue('salutation2');
    if (strlen($salutation2) > 20) {
      $form_state->setErrorByName('salutation2', $this->t('This salutation2 is too long'));
    }
  }
  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state)
  {
    $this->config('hello_world.custom_salutation')
    ->set('salutation', $form_state->getValue('salutation'))
    ->set('salutation2', $form_state->getValue('salutation2'))
    ->save();

    parent::submitForm($form, $form_state);
  }
 }