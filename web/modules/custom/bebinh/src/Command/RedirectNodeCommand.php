<?php

namespace Drupal\bebinh\Command;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Drupal\Console\Core\Command\Command;
use Drupal\Console\Annotations\DrupalCommand;
use Drupal\Component\Utility\UrlHelper;
use Drupal\Core\Entity\ContentEntityForm;
use Drupal\Core\Language\Language;
use Drupal\Core\Language\LanguageInterface;
use Drupal\Core\Routing\MatchingRouteNotFoundException;
use Drupal\Core\Url;
use Drupal\redirect\Entity\Redirect;

/**
 * Class RedirectNodeCommand.
 *
 * @DrupalCommand (
 *     extension="bebinh",
 *     extensionType="module"
 * )
 */
class RedirectNodeCommand extends Command {

  /**
   * {@inheritdoc}
   */
  protected function configure() {
    $this
      ->setName('bebinh:redirect:node')
      ->setDescription($this->trans('commands.bebinh.redirect.node.description'));
  }

  /**
   * {@inheritdoc}
   */
  protected function execute(InputInterface $input, OutputInterface $output) {
    $this->getIo()->info('execute');
    $old_aliases = $this->getAlias();
    $i = 1;

    foreach($old_aliases as $old_alias){
      $nid = str_replace('node/','', $old_alias->source);
      if($pid = $this->getExistProduct($nid)){
        $alias = \Drupal::service('path.alias_manager')->getAliasByPath('/product/'.$pid);
        //save redirect
        $this->createRedirect($old_alias->alias, $alias);
      }
      $i ++;
    }

    $this->getIo()
      ->info($this->trans('commands.bebinh.redirect.node.messages.success'));
  }


  protected function createRedirect($source_url, $redirect_url) {
    /** @var \Drupal\redirect\Entity\Redirect $redirect */
    $redirect = \Drupal\redirect\Entity\Redirect::create();
    // To pass in the query set parameters into GET as follows:
    // source_query[key1]=value1&source_query[key2]=value2
    $source_query = [];

    $redirect_options = [];
    $redirect_query = [];

    $source_url = urldecode($source_url);
    if (!empty($source_url)) {
      $redirect->setSource($source_url, $source_query);
    }

    $redirect_url = urldecode($redirect_url);
    if (!empty($redirect_url)) {
      try {
        $redirect->setRedirect($redirect_url, $redirect_query, $redirect_options);
      } catch (MatchingRouteNotFoundException $e) {
        echo($this->t('Invalid redirect URL ' . $redirect_url . ' provided.'));
      }
    }

    $redirect->setLanguage(Language::LANGCODE_NOT_SPECIFIED);
    try {
      $redirect->save();
    } catch (MatchingRouteNotFoundException $e) {
      echo($this->t('Can not save redirect URL ' . $redirect_url . ' provided with Error:' . $e->getMessage()));
    }

  }

  public function getAlias() {

    $db = \Drupal::database();
    $check = $db->select('url_alias_copy', 'cp');
    $check->fields('cp');
    $check->condition('alias', 'san-pham%', 'like');
    $result = $check->execute()->fetchAll();
    if ($result) {
      return $result;
    }
    else {
      return FALSE;
    }
  }

  public function getExistProduct($sku)
  {
    $db = \Drupal::database();
    $check = $db->select('commerce_product_variation_field_data', 'te');
    $check->fields('te');
    $check->condition('sku', $sku);
    $result = $check->execute()->fetch();
    if ($result) {
      return $result->product_id;
    } else {
      return false;
    }
  }
}
