<?php

namespace Drupal\bebinh\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Class UserSettings.
 */
class UserSettings extends FormBase {


  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'user_settings';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['header_login'] = [
      '#type' => 'text_format',
      '#title' => $this->t('Header Login'),
      '#weight' => '0',
    ];
    $form['header_register'] = [
      '#type' => 'text_format',
      '#title' => $this->t('Header Register'),
      '#weight' => '0',
    ];
    $form['header_forgot_password'] = [
      '#type' => 'text_format',
      '#title' => $this->t('Header Forgot Password'),
      '#weight' => '0',
    ];
    $form['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('Submit'),
    ];

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    parent::validateForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    // Display result.
    foreach ($form_state->getValues() as $key => $value) {
      drupal_set_message($key . ': ' . $value);
    }

  }

}
