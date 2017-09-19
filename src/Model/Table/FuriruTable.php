<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use App\Model\Interfaces\BookInfo;
use Cake\ORM\TableRegistry;

class FuriruTable extends Table implements BookInfo
{
    public function initialize(array $config)
    {

      parent::initialize($config);
      $this->setTable('fril_rules');

      $this->hasOne('Books', [
          'foreignKey' => 'id',
          'joinType' => 'INNER'
      ]);
    }

    function get_books(int $book_id){


      }

}
?>
