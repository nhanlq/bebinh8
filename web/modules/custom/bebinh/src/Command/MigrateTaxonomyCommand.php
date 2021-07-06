<?php

namespace Drupal\bebinh\Command;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Drupal\Console\Core\Command\Command;
use Drupal\Console\Annotations\DrupalCommand;
use Drupal\taxonomy\Entity\Term;

/**
 * Class MigrateTaxonomyCommand.
 *
 * @DrupalCommand (
 *     extension="bebinh",
 *     extensionType="module"
 * )
 */
class MigrateTaxonomyCommand extends Command
{

    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this->setName('bebinh:migrate:taxonomy')
            ->setDescription($this->trans('commands.bebinh.migrate.taxonomy.description'));
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->getIo()->info('execute');
        $this->getIo()->info($this->trans('commands.bebinh.migrate.taxonomy.messages.success'));
        //@todo Import from CSV

        $categories_vocabulary = 'brand'; // Vocabulary machine name
        $file = getcwd().'/csv/bebinhterm.csv';

        if (($h = fopen($file, "r")) !== FALSE)
        {
            $i = 1;
            // Convert each line into the local $data variable
            while (($data = fgetcsv($h, 1000, ";")) !== FALSE)
            {
             if($i != 1){
               if($this->checkExistTerm($data[2])){
                 $term = Term::load($this->checkExistTerm($data[2])->tid);
                 $term->set('weight', $data[5]);
                 $term->save();
               }

             }

                $i ++;
            }

            // Close the file
            fclose($h);


        }

    }

    public function getAllTerm($p = 0)
    {

        $db = \Drupal::database();
        $check = $db->select('taxonomy_drupal7', 'te');
        $check->fields('te');
        $check->condition('vid', 2);
        $check->condition('parent', $p);
        $result = $check->execute()->fetchAll();
        if ($result) {
            return $result;
        } else {
            return false;
        }
    }
    public function getAllTermSub()
    {

        $db = \Drupal::database();
        $check = $db->select('taxonomy_drupal7', 'te');
        $check->fields('te');
        $check->condition('vid', 2);
        $check->condition('parent', 0, '>');
        $result = $check->execute()->fetchAll();
        if ($result) {
            return $result;
        } else {
            return false;
        }
    }

    public function checkExistTerm($termName)
    {

        $db = \Drupal::database();
        $check = $db->select('taxonomy_term_field_data', 'te');
        $check->fields('te');
        $check->condition('name', $termName);
        $result = $check->execute()->fetch();
        if ($result) {
            return $result;
        } else {
            return false;
        }
    }

    public function checkParen($tid)
    {

        $db = \Drupal::database();
        $check = $db->select('taxonomy_drupal7', 'te');
        $check->fields('te');
        $check->condition('tid', $tid);
        $result = $check->execute()->fetch();
        if($result){
            $nameObj = $this->checkExistTerm($result->name);
            if ($nameObj) {
                return $nameObj;
            } else {
                return false;
            }
        }else{
            return false;
        }

    }


    public function deleteTerm()
    {

        $db = \Drupal::database();
        $check = $db->select('taxonomy_term_field_data', 'te');
        $check->fields('te');
        $result = $check->execute()->fetchAll();
        foreach ($result as $term) {
            $termOn = Term::load($term->tid);
            $termOn->delete();
        }
    }
}
