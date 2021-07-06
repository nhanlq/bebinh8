<?php

namespace Drupal\bebinh\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Archiver\Zip;
use Drupal\file\Entity\File;
use Drupal\file\FileInterface;

/**
 * Class UploadImageForm.
 */
class UploadImageForm extends FormBase {


  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'upload_image_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['media'] = [
      '#type' => 'managed_file',
      '#title' => $this->t('Media'),
      '#description' => $this->t('Upload Image to Website. Ex: .zip'),
      '#weight' => '0',
      '#upload_validators' => array(
        'file_validate_extensions' => array('zip'),
      ),
      '#upload_location' => 'public://'
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
    $fid = $form_state->getValue('media');
    $path = getcwd().'/sites/default/files';

    $file = File::load($fid[0]);
    $url = file_create_url($file->getFileUri());
    $zip = new \ZipArchive();
    $zip->open($path.'/'.$file->getFilename());
    $extract = $zip->extractTo($path);
    if($extract){
      drupal_set_message('Folder name Just Extract is:' .str_replace('.zip','',$file->getFilename()));
      \Drupal::state()->delete('folder_name');
      \Drupal::state()->set('folder_name',str_replace('.zip','',$file->getFilename()));
    }

  }

}
