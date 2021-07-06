<?php

namespace Drupal\bebinh\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\file\Entity\File;
use Drupal\file\FileInterface;

/**
 * Class UpdateProductForm.
 */
class UpdateProductForm extends FormBase {


  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'update_product_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['xls'] = [
      '#type' => 'managed_file',
      '#title' => $this->t('Excel File'),
      '#weight' => '0',
      '#description' => 'Upload Excel. Ex: xlsx, xls ',
      '#upload_validators' => [
        'file_validate_extensions' => ['xls xlsx'],
      ],
      '#upload_location' => 'public://',
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
    $fid = $form_state->getValue('xls');
    $path = getcwd() . '/sites/default/files';
    $file = File::load($fid[0]);
    $xls = $path . '/' . $file->getFilename();
    $host = \Drupal::request()->getSchemeAndHttpHost();
    $mediaPath = $host.'/sites/default/files/';
    if ($xlsx = \SimpleXLSX::parse($xls)) {
      $i = 1;
      if ($rows = $xlsx->rows()) {
        foreach ($rows as $row) {
          if ($i > 1) {
            if (!empty($row[0])) {
              if ($this->getExistProduct($row[3])) {
                $product = \Drupal\commerce_product\Entity\Product::load($this->getExistProduct($row[3]));
                //category
                if ($row[1]) {
                  $category = [];
                  $cats = explode(',', $row[1]);
                  foreach ($cats as $cat) {
                    if ($cate = $this->checkExistTerm(trim($cat))) {
                      $category[] = $cate->tid;
                    }
                    else {
                      $term = $this->createTerm(trim($cat), 'product_category');
                      $category[] = $term->tid;
                    }
                  }
                  $product->set('field_category', $category);
                }
                //brand
                $brand = [];
                if ($row[2]) {
                  if ($br = $this->checkExistTerm(trim($row[2]))) {
                    $brand[] = $br->tid;
                  }
                  else {
                    $bra = $this->createTerm(trim($row[2]), 'product_category');
                    $brand[] = $bra->tid;
                  }
                  $product->set('field_brand', $category);
                }
                //field images

                if ($row[6]) {
                  $images = [];
                  $folder = \Drupal::state()->get('folder_name');
                  $imgDir = $path . '/' . $folder;

                    for ($im = 1; $im <= 7; $im++ ) {
                        if (getimagesize($imgDir . '/' . $row[6].'-'.$im.'.jpg')) {
                          $file_temp = file_get_contents($mediaPath.$folder . '/' . $row[6].'-'.$im.'.jpg');
                          if ($file_temp) {
                            $fileImg = file_save_data($file_temp, 'public://' . $row[6].'-'.$im.'.jpg', FILE_EXISTS_RENAME);
                            if ($fileImg) {
                              $images[] = [
                                'target_id' => $fileImg->id(),
                                'alt' => $row[6].'-'.$im.'.jpg',
                                'title' => $row[6].'-'.$im.'.jpg',
                              ];
                            }
                          }
                        }
                    }
                    $product->set('field_images', $images);

                }
                //check size
                $size = '';
                if ($row[8]) {
                  $size = $row[8];
                  $product->set('field_size', $size);
                }
                //check content
                $content = '';
                if ($row[10]) {
                  $content = $row[10];
                  $product->set('body', $content);
                }
                //check madein
                $madein = '';
                if ($row[11]) {
                  $madein = $row[11];
                  $product->set('field_madein', $madein);
                }
                //status
                $status = 1;
                if ($row[12] && !empty($row[2])) {
                  $status = $row[12];
                  $product->set('status', $status);
                }

                $product->save();
              }
              else {
                $variation = \Drupal\commerce_product\Entity\ProductVariation::create([
                  'type' => 'default',
                  'sku' => $row[3],
                  'status' => 1,
                  'price' => new \Drupal\commerce_price\Price($row[4], 'VND'),
                ]);
                $variation->save();

                $variation->save();
                $store = \Drupal\commerce_store\Entity\Store::load(1);
                $category = [];
                if ($row[1]) {
                  $cats = explode(',', $row[1]);
                  foreach ($cats as $cat) {
                    if ($cate = $this->checkExistTerm($cat)) {
                      $category[] = $cate->tid;
                    }
                    else {
                      $term = $this->createTerm($cat, 'product_category');
                      $category[] = $term->tid;
                    }

                  }
                }
                $brand = [];
                if ($row[2]) {
                  if ($br = $this->checkExistTerm($row[2])) {
                    $brand[] = $br->tid;
                  }
                  else {
                    $bra = $this->createTerm($row[2], 'product_category');
                    $brand[] = $bra->tid;
                  }
                }
                $images = [];

                if ($row[6]) {

                  $folder = \Drupal::state()->get('folder_name');
                  $imgDir = $path . '/' . $folder;
                  for ($im = 1; $im <= 7; $im++ ) {
                    if (getimagesize($imgDir . '/' . $row[6].'-'.$im.'.jpg')) {
                      $file_temp = file_get_contents($mediaPath.$folder . '/' . $row[6].'-'.$im.'.jpg');
                      if ($file_temp) {
                        $fileImg = file_save_data($file_temp, 'public://' . $row[6].'-'.$im.'.jpg', FILE_EXISTS_RENAME);
                        if ($fileImg) {
                          $images[] = [
                            'target_id' => $fileImg->id(),
                            'alt' => $row[6].'-'.$im.'.jpg',
                            'title' => $row[6].'-'.$im.'.jpg',
                          ];
                        }
                      }
                    }
                  }
                }
                //check size
                $size = '';
                if ($row[8]) {
                  $size = $row[8];
                }
                //check content
                $content = '';
                if ($row[10]) {
                  $content = $row[10];
                }
                //check madein
                $madein = '';
                if ($row[11]) {
                  $madein = $row[11];
                }
                //status
                $status = 1;
                if ($row[12] && !empty($row[2])) {
                  $status = $row[12];
                }
                $product = \Drupal\commerce_product\Entity\Product::create([
                  'uid' => 1,
                  // The user id that created the product.
                  'type' => 'default',
                  // Just like variation, the default product type is 'default'.
                  'title' => $row[0],
                  'status' => $status,
                  'field_category' => $category,
                  'field_brand' => $brand,
                  'field_images' => $images,
                  'field_size' => $size,
                  'body' => $content,
                  'field_madein' => $madein,
                  'stores' => [$store],
                  // The store we created/loaded above.
                  'variations' => [$variation],
                  // The variation we created above.
                ]);
                $product->save();

              }

            }
          }

          $i++;
        }
      }
    }

  }

  /**
   * @param $sku
   *
   * @return bool
   */
  public
  function getExistProduct($sku) {
    $db = \Drupal::database();
    $check = $db->select('commerce_product_variation_field_data', 'te');
    $check->fields('te');
    $check->condition('sku', $sku);
    $result = $check->execute()->fetch();
    if ($result) {
      return $result->product_id;
    }
    else {
      return FALSE;
    }
  }

  /**
   * @param $termName
   *
   * @return bool
   */
  public
  function checkExistTerm($termName) {

    $db = \Drupal::database();
    $check = $db->select('taxonomy_term_field_data', 'te');
    $check->fields('te');
    $check->condition('name', $termName);
    $result = $check->execute()->fetch();
    if ($result) {
      return $result;
    }
    else {
      return FALSE;
    }
  }

  /**
   * @param $name
   *
   * @return int
   */
  public
  function createTerm($name, $vid = 'product_category') {
    $term = \Drupal\taxonomy\Entity\Term::create([
      'name' => $name,
      'vid' => $vid,
    ])->save();
    return $this->checkExistTerm($name);
  }

}
