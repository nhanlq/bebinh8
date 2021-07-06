<?php

namespace Drupal\bebinh\Command;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Drupal\Console\Core\Command\Command;
use Drupal\Console\Annotations\DrupalCommand;

/**
 * Class ImportExcelCommand.
 *
 * @DrupalCommand (
 *     extension="bebinh",
 *     extensionType="module"
 * )
 */
class ImportExcelCommand extends Command {

  /**
   * {@inheritdoc}
   */
  protected function configure() {
    $this
      ->setName('bebinh:ImportExcel')
      ->setDescription($this->trans('commands.bebinh.ImportExcel.description'));
  }

  /**
   * {@inheritdoc}
   */
  protected function execute(InputInterface $input, OutputInterface $output) {
    $this->getIo()->info('execute');
    $file = getcwd() . '/csv/BeBinh_product_update.xlsx';
    if ($xlsx = \SimpleXLSX::parse($file)) {
      $i = 1;
      if ($rows = $xlsx->rows()) {
        foreach ($rows as $row) {
          if ($i != 1) {
            if(!empty($row[2])){
              $product = \Drupal\commerce_product\Entity\Product::load($this->getExistProduct($row[3]));
              if($product){
                if ($exist_brand = $this->checkExistTerm($row[2])) {
                  $product->set('field_brand', $exist_brand->tid);
                  $product->save();
                }
                else {
                  $brand = $this->createTerm($row[2]);
                  $product->set('field_brand', $brand->tid);
                  $product->save();
                }
              }

            }
          }
        $i ++;
        }
      }
    }
    else {
      echo \SimpleXLSX::parseError();
    }


    $this->getIo()
      ->info($this->trans('commands.bebinh.ImportExcel.messages.success'));
  }

  /**
   * @param $sku
   *
   * @return bool
   */
  public function getExistProduct($sku) {
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
  public function checkExistTerm($termName) {

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
  public function createTerm($name) {
    $term = \Drupal\taxonomy\Entity\Term::create([
      'name' => $name,
      'vid' => 'brand',
    ])->save();
    return $this->checkExistTerm($name);
  }
}
