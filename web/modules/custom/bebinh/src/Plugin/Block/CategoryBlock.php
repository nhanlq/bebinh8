<?php

namespace Drupal\bebinh\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Url;

/**
 * Provides a 'CategoryBlock' block.
 *
 * @Block(
 *  id = "category_block",
 *  admin_label = @Translation("Category block"),
 * )
 */
class CategoryBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build() {
    $current_path = \Drupal::service('path.current')->getPath();
    $arg = explode('/',$current_path);

    if (isset($arg[1]) && $arg[1]=='product') {
      $product = \Drupal\commerce_product\Entity\Product::load($arg[2]);
    //  $catids = $product->get('field_category')->getValues();
      $prod_arr= $product->toArray();
      $catids = $prod_arr['field_category'];
      $tid = false;
      foreach($catids as $catid){
        if(!$this->checkExistParent($catid['target_id'])){
          $tid = $catid['target_id'];
        }
      }
    }
    if(isset($arg[1]) && $arg[1]=='taxonomy'){
      $tid = $this->getParent($arg[3]);
    }
    if($tid){
      $output = $this->bebinh_subcategory_get_by_parent($tid);
    }
    $build = [];
    $build['#cache'] = ['max-age' => 0];
    $build['category_block']['#markup'] = $output;

    return $build;
  }

  public function bebinh_subcategory_get_by_parent($tid) {

    $output = null;
    $active = '';
    $active2 = '';
    $aliasManager = \Drupal::service('path.alias_manager');

    if ($tid) {
      $parent = \Drupal\taxonomy\Entity\Term::load($tid);
      $output .= '<div id="sidebar-menu-wrapper">';
      $output .= '<h3 class="block-title"><span>'.$parent->getName().'</span></h3>';
      $output .= '<ul class="level1">';

      $terms = \Drupal::entityTypeManager()->getStorage('taxonomy_term')->loadChildren($tid);
      $j = 0;
      $class = '';
      foreach ($terms as $term) {
        $child2 = \Drupal::entityTypeManager()->getStorage('taxonomy_term')->loadChildren($term->id());
        if ($j == count($terms) - 1) {
          $class = 'last';
        }

        if ($child2) {
          $output .= '<li class="level1 ' . $class . '"><a ' . $active . ' href="' . $aliasManager->getAliasByPath('/taxonomy/term/' . $term->id()) . '"><span>' . $term->getName() . '</span></a>';
          $output .= '<ul class="level2">';
          foreach ($child2 as $child) {
            $output .= '<li class="level2"><a ' . $active2 . ' href="' . $aliasManager->getAliasByPath('/taxonomy/term/' . $child->id()) . '">' . $child->getName() . '</a></li>';
          }
          $output .= '</ul></li>';
        } else {
          $output .= '<li class="level1 ' . $class . '"><a ' . $active . '  href="' . $aliasManager->getAliasByPath('/taxonomy/term/' . $term->id()) . '"><span>' . $term->getName() . '</span></a></li>';
        }
        $j ++;
      }
      $output .= '</ul></div>';
    }

    return $output;
  }

  public function checkExistParent($tid)
  {

    $db = \Drupal::database();
    $check = $db->select('taxonomy_term__parent', 'te');
    $check->fields('te');
    $check->condition('entity_id', $tid);
    $result = $check->execute()->fetch();
    if ($result) {
      if ($result->parent_target_id == 0) {
        return false;
      } else {
        return true;
      }
    } else {
      return false;
    }
  }

    public function getParent($tid)
  {

    $db = \Drupal::database();
    $check = $db->select('taxonomy_term__parent', 'te');
    $check->fields('te');
    $check->condition('entity_id', $tid);
    $result = $check->execute()->fetch();
    if ($result) {
      if($result->parent_target_id == 0){
        return $result->entity_id;
      }else{
        $db = \Drupal::database();
        $check = $db->select('taxonomy_term__parent', 'te');
        $check->fields('te');
        $check->condition('entity_id', $result->parent_target_id);
        $result = $check->execute()->fetch();
        if ($result) {
          if($result->parent_target_id == 0){
            return $result->entity_id;
          }
          else{
            $db = \Drupal::database();
            $check = $db->select('taxonomy_term__parent', 'te');
            $check->fields('te');
            $check->condition('entity_id', $result->parent_target_id);
            $result = $check->execute()->fetch();
            if($result){
              if($result->parent_target_id == 0){
                return $result->entity_id;
              }else{
                return $tid;
              }
            }
          }
        }
      }
    } else {
      return $tid;
    }
  }

}
