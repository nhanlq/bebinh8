<?php

namespace Drupal\bebinh\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * Provides a 'RelateProductBlock' block.
 *
 * @Block(
 *  id = "relate_product_block",
 *  admin_label = @Translation("Relate product block"),
 * )
 */
class RelateProductBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build() {
    $current_path = \Drupal::service('path.current')->getPath();
    $path_args = explode('/', $current_path);

    $pid = $path_args[2];
    $ids = $this->getRelatePid($pid);

    $build = [];
    $relatedArticles = views_embed_view('products', 'block_1',$ids);

    $build['relate_product_block']['#markup'] = drupal_render($relatedArticles);
    $build['#cache'] = ['max-age' => 0];
    return $build;
  }

  public function getRelatePid($pid){
    $current_product = \Drupal\commerce_product\Entity\Product::load($pid);
    $tid = NULL;
    $prods = $current_product->get('field_category')->getValue();
    if($prods){
      foreach($prods as $prod){
        $child = $terms = \Drupal::entityTypeManager()->getStorage('taxonomy_term')->loadChildren($prod['target_id']);
        if(!$child){
          $tid = $prod['target_id'];
        }
      }
    }
    $proId = [];
    if($tid){
      $products = \Drupal::entityTypeManager()->getStorage('commerce_product')->loadByProperties([
        'field_category' => $tid,
      ]);
      foreach($products as $product){
        if($product->id() != $pid){
          $proId[] = $product->id();
        }
      }
      return implode('+',$proId);
    }
    return false;

  }

}
