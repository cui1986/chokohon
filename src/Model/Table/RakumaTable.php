<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use App\Model\Interfaces\BookInfo;


class RakumaTable extends Table implements BookInfo
{


  //输出数据
  function get_books(int $book_id){
  }

  public function initialize(array $config)
  {

    parent::initialize($config);
    $this->setTable('rakuma_rules');

    $this->hasOne('Books', [
        'foreignKey' => 'id',
        'joinType' => 'INNER'
    ]);
  }

}
?>
