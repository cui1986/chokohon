<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use App\Model\Interfaces\BookInfo;


class MerukariTable extends Table implements BookInfo
{

  public function initialize(array $config)
  {

    parent::initialize($config);
    $this->setTable('merukari_rules');

    $this->hasOne('Books', [
        'foreignKey' => 'id',
        'joinType' => 'INNER'
    ]);
  }
  public function get_books(int $book_id){

  }

}
?>
