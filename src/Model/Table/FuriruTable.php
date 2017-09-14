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

      $book_model = TableRegistry::get('FrilRules');
      $books = $book_model->get($book_id);

      $key_words = $books["key_words"];
      $category_id = $books["category_id"];
      $book_status = $books["book_status"];
      $delivery_id = $books["delivery_id"];

      $url = "https://fril.jp/s?query={$key_words}&category_id={$category_id}&status={$book_status}&carriage={$delivery_id}" ;
      $html = file_get_html($url);

      $data_array = array();

      $results = $html->find('.item');

      foreach ($results as $result) {

        $temp_array = array();
        $img_src_name = "data-original";
        $temp_array['book_link'] = $result->children[0]->children[0]->children[0]->href;
        $temp_array['book_image'] =  $result->children[0]->children[0]->children[0]->children[1]->$img_src_name;
        $temp_array['book_name'] =  $result->children[0]->children[1]->children[1]->children[0]->children[0]->plaintext;

        if(isset($result->children[0]->children[1]->children[0]->children[2])){
          $temp_array['book_status'] = $result->children[0]->children[1]->children[0]->children[2]->plaintext;
        }else {
          $temp_array['book_status'] = "";
        }
        $temp_array['book_price'] = $result->children[0]->children[1]->children[2]->children[0]->children[1]->plaintext;

        $data_array[] = $temp_array;
      }

      $html->clear();
      return $data_array;
    }
}
?>
