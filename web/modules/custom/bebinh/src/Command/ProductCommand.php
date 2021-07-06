<?php

namespace Drupal\bebinh\Command;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Drupal\Console\Core\Command\Command;
use Drupal\Console\Annotations\DrupalCommand;

/**
 * Class ProductCommand.
 *
 * @DrupalCommand (
 *     extension="bebinh",
 *     extensionType="module"
 * )
 */
class ProductCommand extends Command {

  /**
   * {@inheritdoc}
   */
  protected function configure() {
    $this
      ->setName('bebinh:product')
      ->setDescription($this->trans('commands.bebinh.product.description'));
  }

  /**
   * {@inheritdoc}
   */
  protected function execute(InputInterface $input, OutputInterface $output) {
    $this->getIo()->info('execute');

    $db = \Drupal::database();
    $check = $db->select('field_data_body', 'bd');
    $check->fields('bd');
    $check->condition('bundle', 'product');
    $result = $check->execute()->fetchAll();
    if ($result) {
      foreach ($result as $data) {
        $files = [];
        $product = \Drupal\commerce_product\Entity\Product::load($this->getExistProduct($data->entity_id));
        if ($product) {

          preg_match_all('/src=\"(.+?)\"/', $data->body_value, $matches);
          if (isset($matches[1])) {

            if ($product && $product->get('field_images')) {
              $files[] = [
                'target_id' => $product->get('field_images')->target_id,
                'alt' => $product->getTitle(),
              ];
            }

            foreach ($matches[1] as $match) {
              $url = $match;
              $filename = '';

              if (strpos('http', $url) === FALSE) {
                $url = 'https://bebinhvn.com' . $url;
              }

              $file_temp = file_get_contents($url);
              $filename = str_replace('http://', '', $url);
              $filename = str_replace('https://', '', $filename);
              $file_arr = explode('/', $filename);
              $last_key = key(array_slice($file_arr, -1, 1, TRUE));
              $filename = $file_arr[$last_key];


              if ($file_temp) {
                $file = file_save_data($file_temp, 'public://' . $filename, FILE_EXISTS_RENAME);
                $files[] = [
                  'target_id' => $file->id(),
                  'alt' => $filename,
                  'title' => $filename,
                ];
              }

            }
            if ($product) {
              $product->set('field_images', $files);

            }
          }
          $query = \Drupal::database()->update('commerce_product__body');
          $query->fields([
            'body_value' => $data->body_value,
          ]);
          $query->condition('entity_id', $product->id());
          $query->execute();
          // $product->set('body',$data->body_value);
          $product->save();
        }

      }

    }
    //            $product = \Drupal\commerce_product\Entity\Product::load($this->getExistProduct($data[11]));
    //            $product->set('field_size',$data[7]);
    //            $product->save();


    $this->getIo()
      ->info($this->trans('commands.bebinh.product.messages.success'));
  }

  public function checkExistTerm($termName) {

    $db = \Drupal::database();
    $check = $db->select('taxonomy_term_field_data', 'te');
    $check->fields('te');
    $check->condition('name', $termName);
    $result = $check->execute()->fetch();
    if ($result) {
      return $result->tid;
    }
    else {
      return FALSE;
    }
  }

  public function getParent($tid) {
    $ancestors = \Drupal::service('entity_type.manager')
      ->getStorage("taxonomy_term")
      ->loadAllParents($tid);
    $list = [];
    $list[] = $tid;
    foreach ($ancestors as $term) {
      $list[] = $term->id();
    }
    return $list;
  }

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


}
