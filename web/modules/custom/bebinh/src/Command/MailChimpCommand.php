<?php

namespace Drupal\bebinh\Command;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Drupal\Console\Core\Command\Command;
use Drupal\Console\Annotations\DrupalCommand;

/**
 * Class MailChimpCommand.
 *
 * @DrupalCommand (
 *     extension="bebinh",
 *     extensionType="module"
 * )
 */
class MailChimpCommand extends Command {

  /**
   * {@inheritdoc}
   */
  protected function configure() {
    $this
      ->setName('bebinh:mailChimp')
      ->setDescription($this->trans('commands.bebinh.mailChimp.description'));
  }


  /**
   * {@inheritdoc}
   */
  protected function execute(InputInterface $input, OutputInterface $output) {
    $this->getIo()->info('execute');

    $api_key = 'c544f6fa027b94d061cb30864a4cac1d-us17'; // YOUR API KEY

    // server name followed by a dot.
    // We use us13 because us13 is present in API KEY
    $server = 'us17.';

    $list_id = '12695c1a27'; // YOUR LIST ID

    $auth = base64_encode( 'user:'.$api_key );

    $member = [];
    $file = getcwd() . '/csv/mailchimpnow.xlsx';
    if ($xlsx = \SimpleXLSX::parse($file)) {
      $i = 1;
      if ($rows = $xlsx->rows()) {
        foreach ($rows as $row) {
           if($i > 2496){
             $member[] = ['email_address'=>$row[0],'status'=> 'subscribed'];
           }
           if($i > 2995){
             break;
           }
          $i ++;
        }
      }
    }
    $data = new \stdClass();
    $data->members = $member;
    $data->update_existing = true;
    $json_data = json_encode($data);

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'https://'.$server.'api.mailchimp.com/3.0/lists/'.$list_id);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json',
      'Authorization: Basic '.$auth));
    curl_setopt($ch, CURLOPT_USERAGENT, 'PHP-MCAPI/2.0');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_TIMEOUT, 10);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $json_data);

    $result = curl_exec($ch);

    echo $result;

    $this->getIo()->info($this->trans('commands.bebinh.mailChimp.messages.success'));
  }


}
